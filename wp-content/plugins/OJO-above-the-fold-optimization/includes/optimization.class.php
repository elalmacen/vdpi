<?php

/**
 * Abovethefold optimization functions and hooks.
 *
 * This class provides the functionality for optimization functions and hooks.
 *
 * @since      1.0
 * @package    abovethefold
 * @subpackage abovethefold/includes
 * @author     PageSpeed.pro <info@pagespeed.pro>
 */


class Abovethefold_Optimization {

	/**
	 * Above the fold controller
	 */
	public $CTRL; 

	/**
	 * CSS buffer started
	 */
	public $css_buffer_started = false;

	/**
	 * Optimize CSS delivery
	 */
	public $optimize_css_delivery = false;

	/**
	 * Critical CSS replacement string
	 */
	public $criticalcss_replacement_string = 'ABTF_CRITICALCSS';

	/**
	 * Initialize the class and set its properties
	 */
	public function __construct( &$CTRL ) {

		$this->CTRL =& $CTRL;

		if ($this->CTRL->disabled) {
			return; // above the fold optimization disabled for area / page
		}

		/**
		 * Optimize CSS delivery
		 */
		$this->optimize_css_delivery = (isset($this->CTRL->options['cssdelivery']) && intval($this->CTRL->options['cssdelivery']) === 1) ? true : false;

		/**
		 * Extract Full CSS view
		 */
		if ($this->CTRL->view === 'extract-css') {

			// load optimization controller
			$this->CTRL->extractcss = new Abovethefold_ExtractFullCss( $this->CTRL );

		} else if ($this->CTRL->view === 'compare-abtf') {

			/**
			 * Compare Critical CSS view
			 */
			$this->CTRL->compare = new Abovethefold_CompareABTF( $this->CTRL );
			
		} else {

			/**
			 * Standard view
			 */

			/**
			 * Check if an optimization module offers an output buffer hook
			 */
			if (!$this->CTRL->plugins->html_output_hook($this)) {

				/**
				 * Use Above The Fold Optimization standard output buffer
				 */
				$this->CTRL->loader->add_action('init', $this, 'start_output_buffer',99999);

				/**
				 * Move output buffer to front of other buffers
				 * /
				$this->CTRL->loader->add_action('template_redirect', $this, 'move_ob_to_front',99999);
				*/
			}

		}

		// wordpress header
		$this->CTRL->loader->add_action('wp_head', $this, 'header', 1);

		// wordpress footer
		$this->CTRL->loader->add_action('wp_print_footer_scripts', $this, 'footer',99999);

	}

	/**
	 * Init output buffering
	 */
	public function start_output_buffer( ) {

		/**
		 * Re-check if an optimization module offers an output buffer hook, the buffer may be started in the init hook
		 */
		if (!$this->CTRL->plugins->html_output_hook($this)) {

			// set output buffer
			ob_start(array($this, 'process_output_buffer'));
		}
	}

	/**
	 * Move Above The Fold Optimization output buffer to front
	 */
	public function move_ob_to_front() {

		// get active output buffers
		$ob_callbacks = ob_list_handlers();

		// check if Above The Fold Optimization is last output buffer
		// try to move to front
		if (
			!empty($ob_callbacks) 
			&& in_array('Abovethefold_Optimization::process_output_buffer',$ob_callbacks)
		 	&& $ob_callbacks[(count($ob_callbacks) - 1)] !== 'Abovethefold_Optimization::process_output_buffer'
		 ) {

			$callbacks_to_move = array();

			$n = count($ob_callbacks) - 1;
			while ($ob_callbacks[$n] && $ob_callbacks[$n] !== 'Abovethefold_Optimization::process_output_buffer') {

				if ($ob_callbacks[$n] === 'default output handler') {
					$callbacks_to_move[] = false;
				} else {
					if (strpos($ob_callbacks[$n],'::') !== false) {
						$callback = explode('::',$ob_callbacks[$n]);

						// check if singleton
						if (is_callable($callback[0].'::getInstance')) {
							$callbacks_to_move[] = array( call_user_func( array( $callback[0], 'getInstance' ) ), $callback[1]);
						} else if (is_callable($callback[0].'::singleton')) {
							$callbacks_to_move[] = array( call_user_func( array( $callback[0], 'singleton' ) ), $callback[1]);
						} else {
							$callbacks_to_move[] = $ob_callbacks[$n];
						}
					} else {
						$callbacks_to_move[] = $ob_callbacks[$n];
					}
				}
				
				$n--;
			}

			// end output buffers in front of Above The Fold output buffer
			foreach ($callbacks_to_move as $callback) {
				ob_end_clean();
			}

			// end above the fold output buffer
			ob_end_clean();

			// restore output buffers
			$callbacks_to_restore = array_reverse($callbacks_to_move);
			foreach ($callbacks_to_restore as $callback) {
				if ($callback) {
					@ob_start($callback);
				} else {
					// ignore output buffers without callback
					// @todo
				}
			} 

			// restore Above The Fold Optimization output buffer in front
			ob_start(array($this, 'process_output_buffer'));

			$ob_callbacks = ob_list_handlers();
		}
	}

	/**
	 * Extract stylesheets from HTML
	 */
	public function extract_stylesheets($HTML) {

		$stylesheets = array();

		// stylesheet regex
		$stylesheet_regex = '#(<\!--\[if[^>]+>\s*)?<link[^>]+>#is';

		if (preg_match_all($stylesheet_regex,$HTML,$out)) {

			foreach ($out[0] as $n => $stylesheet) {

				/**
				 * Conditional, skip
				 */
				if (trim($out[1][$n]) != '') {
					continue 1;
				}

				/**
				 * No href or rel="stylesheet", skip
				 */
				if (strpos($stylesheet,'href') === false || strpos($stylesheet,'stylesheet') === false || !preg_match( '#href\s*=\s*["\']([^"\']+)["\']#i', $stylesheet, $hrefOut )) {
					continue 1;
				}

				$stylesheets[] = array($hrefOut[1],$out[0][$n]);
			}
		}

		return $stylesheets;
	}

	/**
	 * Extract scripts from HTML
	 */
	public function extract_scripts($HTML) {

		$scripts = array();

		// script regex
		$script_regex = '#(<\!--\[if[^>]+>\s*)?<script[^>]+>#is';

		if (preg_match_all($script_regex,$HTML,$out)) {

			foreach ($out[0] as $n => $script) {

				/**
				 * Conditional, skip
				 */
				if (trim($out[1][$n]) != '') {
					continue 1;
				}

				/**
				 * No src, skip
				 */
				if (strpos($script,'src') === false|| !preg_match( '#src\s*=\s*["\']([^"\']+)["\']#i', $script, $srcOut )) {
					continue 1;
				}

				$scripts[] = array($srcOut[1],$out[0][$n]);
			}
		}

		return $scripts;
	}

	/**
	 * Rewrite callback
	 */
	public function process_output_buffer($buffer) {

		// disabled, do not process buffer
		if (!$this->CTRL->is_enabled()) {
			return $buffer;
		}

		// search / replace 
		$search = array();
		$replace = array();

		// search / replace regex
		$search_regex = array();
		$replace_regex = array();

		// apply pre HTML filters
		$buffer = apply_filters('abtf_html_pre', $buffer);

		/**
		 * CSS Delivery Optimization
		 */
		if ($this->optimize_css_delivery) {

			/**
			 * Ignore List
			 *
			 * Matching files will be ignored / left untouched in the HTML
			 */
			if (isset($this->CTRL->options['cssdelivery_ignore']) && !empty($this->CTRL->options['cssdelivery_ignore'])) {
				$ignorelist = array();
				foreach ($this->CTRL->options['cssdelivery_ignore'] as $row) {
					$ignorelist[] = $row;
				}
			}

			/**
			 * Delete List
			 *
			 * Matching files will be deleted from the HTML
			 */
			if (isset($this->CTRL->options['cssdelivery_remove']) && !empty($this->CTRL->options['cssdelivery_remove'])) {
				$deletelist = array();
				foreach ($this->CTRL->options['cssdelivery_remove'] as $row) {
					$deletelist[] = $row;
				}
			}

			/**
			 * Parse CSS links
			 */
			$async_styles = array();

			$stylesheets = $this->extract_stylesheets($buffer);
			if (!empty($stylesheets)) {

				foreach ($stylesheets as $stylesheet) {

					list($file,$matchedTag) = $stylesheet;
					if (empty($file)) { continue 1; }

					$originalFile = $file;

					// apply css file filter pre processing
					$filterResult = apply_filters('abtf_cssfile_pre', $file);

					// ignore file
					if ($filterResult === 'ignore') {
						continue;
					}

					// delete file
					if ($filterResult === 'delete') {

						// delete from HTML
						//$search_regex[] = '|<link[^>]+'.preg_quote($originalFile).'[^>]+>|is';
						$search[] = $matchedTag;
						$replace[] = '';
						continue;
					}

					// replace url
					if ($filterResult && $filterResult !== $file) {
						$file = $filterResult;
					}

					// match file against ignore list
					if (!empty($ignorelist)) {
						$ignore = false;
						foreach ($ignorelist as $_file) {
							if (strpos($file,$_file) !== false) {
								$ignore = true;
								break 1;
							}
						}
						if ($ignore) {
							continue;
						}
					}

					// match file against delete list
					if (!empty($deletelist)) {
						$delete = false;
						foreach ($deletelist as $_file) {
							if (strpos($file,$_file) !== false) {
								$delete = true;
								break 1;
							}
						}
						if ($delete) {
							//$search_regex[] = '|<link[^>]+'.preg_quote($originalFile).'[^>]+>|is';
							$search[] = $matchedTag;
							$replace[] = '';
							continue;
						}
					}

					// Detect media for file
					$media = false;
					if (strpos($out[0][$n],'media=') !== false) {
	                    $el = (array)simplexml_load_string($out[0][$n]);
						$media = trim($el['@attributes']['media']);
					}
					if (!$media) {
						$media = 'all';
					}

					/**
					 * Convert HTML entities
					 */
					$media = html_entity_decode($media,ENT_COMPAT,'utf-8');
					$file = html_entity_decode($file,ENT_COMPAT,'utf-8');

					// convert media to array
					$media = explode(',',$media);

					// add file to style array to be processed
					$async_styles[] = array($media,$file);

					// remove file from HTML
					$search_regex[] = '|<link[^>]+'.preg_quote($originalFile).'[^>]+>|is';
					$replace_regex[] = '';
				}
			}

		} else {

			/**
			 * Filter CSS files
			 */
			if ($this->CTRL->options['gwfo'] || $this->CTRL->options['css_proxy']) {

				$stylesheets = $this->extract_stylesheets($buffer);
				if (!empty($stylesheets)) {

					foreach ($stylesheets as $file) {

						list($file,$matchedTag) = $stylesheet;
						if (empty($file)) { continue 1; }

						$originalFile = $file;

						// apply filter for css file pre processing
						$filterResult = apply_filters('abtf_cssfile_pre', $file);

						// ignore file
						if ($filterResult === 'ignore') {
							continue;
						}

						// delete file
						if ($filterResult === 'delete') {

							// delete from HTML
							//$search_regex[] = '|<link[^>]+'.preg_quote($originalFile).'[^>]+>|is';
							$search[] = $matchedTag;
							$replace[] = '';
							continue;
						}

						// replace url
						if ($filterResult && $filterResult !== $file) {
							
							$search_regex[] = '|(<link[^>]+)'.preg_quote($originalFile).'([^>]+>)|is';
							$replace_regex[] = '$1'.$filterResult.'$2';
						}
					}
				}
			}
		}

		/**
		 * Filter Javascript files
		 */
		if ($this->CTRL->options['js_proxy']) {

			$scripts = $this->extract_scripts($buffer);
			if (!empty($scripts)) {

				foreach ($scripts as $script) {

					list($file,$matchedTag) = $script;
					if (empty($file)) { continue 1; }

					$originalFile = $file;

					// apply filter for css file pre processing
					$filterResult = apply_filters('abtf_jsfile_pre', $file);

					// ignore file
					if ($filterResult === 'ignore') {
						continue;
					}

					// delete file
					if ($filterResult === 'delete') {

						// delete from HTML
						//$search_regex[] = '|<script[^>]+'.preg_quote($originalFile).'[^>]+>([^<]+</script>)?|is';
						$search[] = $matchedTag;
						$replace[] = '';
						continue;
					}

					// replace url
					if ($filterResult && $filterResult !== $file) {
						
						$search_regex[] = '|(<script[^>]+)'.preg_quote($originalFile).'([^>]+>)|is';
						$replace_regex[] = '$1'.$filterResult.'$2';
					}
				}
			}
		}

		/**
		 * CSS Delivery Optimization
		 */
		if ($this->optimize_css_delivery) {

			/**
			 * Remove full CSS and show critical CSS only
			 */
			if ($this->CTRL->view === 'abtf-critical-only') {

				// do not render the stylesheet files
				$styles_json = 'false';

			} else {

				/**
				 * Remove duplicate CSS files
				 */
				$reflog = array();
				$styles = array();
				if (isset($async_styles) && !empty($async_styles)) {
					foreach ($async_styles as $link) {
						if (isset($reflog[$link[1]])) {
							continue 1;
						}
						$reflog[$link[1]] = 1;
						$styles[] = $link;
					}
				}

				if (defined('JSON_UNESCAPED_SLASHES')) {
					$styles_json = json_encode($styles, JSON_UNESCAPED_SLASHES);
				} else {
					$styles_json = str_replace('\\/','/',json_encode($styles));
				}
			}
		
			/**
			 * Update CSS JSON configuration
			 */
			//$search_regex[] = '#[\'|"]'.preg_quote($this->criticalcss_replacement_string).'[\'|"]#Ui';
			$search[] = '"'.$this->criticalcss_replacement_string	.'"';
			$replace[] = $styles_json;
		}

		// apply search replace filter
		$searchreplace = apply_filters('abtf_html_replace', array($search,$replace,$search_regex,$replace_regex));
		if (is_array($searchreplace) && count($searchreplace) === 4) {
			list($search,$replace,$search_regex,$replace_regex) = $searchreplace;
		}

		// update buffer
		if (!empty($search)) {
			$buffer = str_replace($search,$replace,$buffer);
		}
		if (!empty($search_regex)) {
			$buffer = preg_replace($search_regex,$replace_regex,$buffer);
		}

		// apply HTML filters
		$buffer = apply_filters('abtf_html', $buffer);

		return $buffer;
	}

	/**
	 * WordPress Header hook
	 */
    public function header() {

		if ($this->CTRL->disabled) { return; }

		/**
		 * Add noindex meta to prevent indexing in Google
		 */
		if ($this->CTRL->view === 'abtf-critical-only' || $this->CTRL->view === 'abtf-critical-verify') {
			print '<meta name="robots" content="noindex, nofollow" />';
		}

		/**
		 * Global Critical CSS file
		 */
		$criticalcss_file = $this->CTRL->cache_path() . 'criticalcss_global.css';
		$criticalcss_name = 'global';
		$criticalcss_conditional = false;

		/**
		 * Verify if page matches conditional critical CSS
		 */
		$conditionalcss_enabled = (isset($this->CTRL->options['conditionalcss_enabled']) && intval($this->CTRL->options['conditionalcss_enabled']) === 1) ? true : false;
		
		if ($conditionalcss_enabled && !empty($this->CTRL->options['conditional_css'])) {

			foreach ($this->CTRL->options['conditional_css'] as $conditionhash => $conditional) {
				if (empty($conditional['conditions']) || !is_array($conditional['conditions'])) { continue 1; }

				foreach ($conditional['conditions'] as $condition) {

					if ($condition === 'frontpage') {

						if (is_front_page()) {

							// condition matches
							$criticalcss_file = $this->CTRL->cache_path() . 'criticalcss_'.$conditionhash.'.css';
							$criticalcss_name = $conditional['name'];
							break 2;
						}

					} else if (substr($condition,0,3) === 'pt_') {

						/**
						 * Page Template Condition
						 */
						if (substr($condition,0,7) === 'pt_tpl_') {

							if (is_page_template( substr($condition,7) )) {

								// condition matches
								$criticalcss_file = $this->CTRL->cache_path() . 'criticalcss_'.$conditionhash.'.css';
								$criticalcss_name = $conditional['name'];
								break 2;
							}

						} else {

							/**
							 * Post Type Condition
							 */
							$posttype = substr($condition,3);
							if (is_singular($posttype)) {

								// condition matches
								$criticalcss_file = $this->CTRL->cache_path() . 'criticalcss_'.$conditionhash.'.css';
								$criticalcss_name = $conditional['name'];
								break 2;
							}
						}
					} else if (class_exists( 'WooCommerce' ) && substr($condition,0,3) === 'wc_') {

						/**
						 * WooCommerce page type
						 */
						$wcpage = substr($condition,3);
						$match = false;
						switch($wcpage) {
							case "shop":
								if (is_shop()) {
									$match = true;
								}
							break;
							case "product_category":
								if (is_product_category()) {
									$match = true;
								}
							break;
							case "product_tag":

								if (is_product_tag()) {
									$match = true;
								}
							break;
							case "product":
								if (is_product()) {
									$match = true;
								}
							break;
							case "cart":
								if (is_cart()) {
									$match = true;
								}
							break;
							case "checkout":
								if (is_checkout()) {
									$match = true;
								}
							break;
							case "account_page":
								if (is_account_page()) {
									$match = true;
								}
							break;

						}
						if ($match) {

							// condition matches
							$criticalcss_file = $this->CTRL->cache_path() . 'criticalcss_'.$conditionhash.'.css';
							$criticalcss_name = $conditional['name'];
							break 2;
						}

					} else if (substr($condition,0,3) === 'tax') {

						/**
						 * Taxonomy page
						 */
						$tax = substr($condition,3);
						if (is_tax( $tax )) {

							// condition matches
							$criticalcss_file = $this->CTRL->cache_path() . 'criticalcss_'.$conditionhash.'.css';
							$criticalcss_name = $conditional['name'];
							break 2;
						}

					} else if (substr($condition,0,3) === 'cat') {

						/**
						 * Posts with categories
						 */
						if (is_single()) {

							$cat = substr($condition,3);
							if (has_category( $cat )) {

								// condition matches
								$criticalcss_file = $this->CTRL->cache_path() . 'criticalcss_'.$conditionhash.'.css';
								$criticalcss_name = $conditional['name'];
								break 2;
							}
						}

					} else if (substr($condition,0,4) === 'page') {

						/**
						 * Individual pages
						 */
						$pageid = intval(substr($condition,4));
						if (is_page($pageid)) {

							// condition matches
							$criticalcss_file = $this->CTRL->cache_path() . 'criticalcss_'.$conditionhash.'.css';
							$criticalcss_name = $conditional['name'];
							break 2;
						}

					} else if (substr($condition,0,4) === 'post') {

						/**
						 * Individual posts
						 */
						$postid = intval(substr($condition,4));
						if (is_single($postid)) {

							// condition matches
							$criticalcss_file = $this->CTRL->cache_path() . 'criticalcss_'.$conditionhash.'.css';
							$criticalcss_name = $conditional['name'];
							break 2;
						}
					}
				}
			}
		}

		// Inline js
		$inlineJS = '';

		/**
		 * Load Critical CSS from file
		 */
		$inlineCSS = trim((file_exists($criticalcss_file)) ? file_get_contents($criticalcss_file) : '');

		// debug enabled?
		$debug = (current_user_can('administrator') && intval($this->CTRL->options['debug']) === 1) ? true : false;

		// javascript debug extension
		$jsdebug = ($debug) ? '.debug' : '';

		/**
		 * Inline settings JSON
		 */
		$jssettings = array();
		
		/**
		 * Javascript client files to combine
		 */
		$jsfiles = array();

		/**
		 * Google Web Font Loader Inline
		 */
		if (isset($this->CTRL->options['gwfo']) && $this->CTRL->options['gwfo']) {

			// get web font loader client
			$this->CTRL->gwfo->client_jssettings($jssettings, $jsfiles, $inlineJS, $jsdebug);

		}

		/** main client controller */
		$jsfiles[] = WPABTF_PATH . 'public/js/abovethefold'.$jsdebug.'.min.js';

		// Proxy external files
		if ((isset($this->CTRL->options['js_proxy']) && $this->CTRL->options['js_proxy']) || (isset($this->CTRL->options['css_proxy']) && $this->CTRL->options['css_proxy'])) {

			// get proxy client
			$this->CTRL->proxy->client_jssettings($jssettings, $jsfiles, $jsdebug);
		}

		/**
		 * Javascript for CSS delivery optimization
		 */
		if ($this->optimize_css_delivery) {

			$jsfiles[] = WPABTF_PATH . 'public/js/abovethefold-css'.$jsdebug.'.min.js';

			/** Async CSS controller */
			if (intval($this->CTRL->options['loadcss_enhanced']) === 1) {
				$jsfiles[] = WPABTF_PATH . 'public/js/abovethefold-loadcss-enhanced'.$jsdebug.'.min.js';
			} else {
				

				$jsfiles[] = WPABTF_PATH . 'public/js/abovethefold-loadcss'.$jsdebug.'.min.js';
			}
		}

		/**
		 * Combine javascript files into inline code
		 */
		foreach ($jsfiles as $file) {
			if (!file_exists($file)) { continue 1; }
			$js = trim(file_get_contents($file));
			if (substr($js,-1) !== ';') {
				$js .= ' ';
			}
			$inlineJS .= $js;
		}

		/**
		 * Optimize CSS delivery
		 */
		if ($this->optimize_css_delivery) {

			$jssettings['css'] = $this->criticalcss_replacement_string;

			if (isset($this->CTRL->options['cssdelivery_renderdelay']) && intval($this->CTRL->options['cssdelivery_renderdelay']) > 0) {
				$jssettings['delay'] = intval($this->CTRL->options['cssdelivery_renderdelay']);
			}

			$headCSS = ($this->CTRL->options['cssdelivery_position'] === 'header') ? true : false;
		} else {

			// do not load CSS
			$headCSS = false;
		}

		// Hide PageSpeed.pro reference in browser console
		if (defined('ABTF_NOREF') || current_user_can('manage_options')) {
			$jssettings['noref'] = true;
		}

		$inlineJS .= 'Abtf.h(' . json_encode($jssettings) . ');';
		print '<script rel="abtf">' . $inlineJS . '</script>';

		print '<style type="text/css" rel="abtf" id="AbtfCSS">';

		/**
		 * Hide Critical CSS for verification view
		 */
		if ($this->CTRL->view === 'abtf-critical-verify') {
			if ($debug) {
				print '
/*!
 * Above The Fold Optimization ' . $this->CTRL->get_version() . '
 * Full CSS View
 * No Critical CSS
 */
';
			}
		}

		/**
		 * Include inline CSS
		 */
		 else if ($inlineCSS !== '') {

			/**
			 * Debug header
			 */
			if ($debug) {
				print '
/*!
 * Above The Fold Optimization ' . $this->CTRL->get_version() . '
 * Debug enabled (admin only)
 * Critical CSS: ' . htmlentities($criticalcss_name, ENT_COMPAT, 'utf-8') . (($criticalcss_conditional) ? ' (conditional)': '') . '
 */
';
			}

			print $inlineCSS;

		} else {

			/**
			 * Print warning for admin users that critical CSS is empty
			 */
			if (current_user_can('administrator') || current_user_can('editor')) {
				print '
/*!
 * Above The Fold Optimization ' . $this->CTRL->get_version() . '
 * 
 * ------------------------------------
 *    WARNING: CRITICAL CSS IS EMPTY     
 * ------------------------------------
 * 
 * This message is displayed for admins only.
 *
 */
';
			} else {
				print '
/*!
 * Above The Fold Optimization ' . $this->CTRL->get_version() . ' // EMPTY
 */
';
			}

		}

		print '</style>';

		/**
		 * Start async loading of CSS
		 */
		if ($this->optimize_css_delivery && $headCSS) {
			print '<script rel="abtf">Abtf.css();</script>';
		}

	}

	/**
	 * WordPress Footer hook
	 */
	public function footer() {
		if ($this->CTRL->disabled) { return; }

		// CSS delivery in footer
		$footCSS = ($this->optimize_css_delivery && (empty($this->CTRL->options['cssdelivery_position']) || $this->CTRL->options['cssdelivery_position'] === 'footer')) ? true : false;

		if (

			$footCSS

			// google web font loader in footer
			|| ($this->CTRL->options['gwfo'] && $this->CTRL->options['gwfo_loadposition'] === 'footer')

		) {

			// start loading CSS from footer position
			
			print "<script rel=\"abtf\">Abtf.f(".json_encode($footCSS).");</script>";
		}

	}


}