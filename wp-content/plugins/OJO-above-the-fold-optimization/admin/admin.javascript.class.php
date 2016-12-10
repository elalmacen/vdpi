<?php

/**
 * Javascript admin controller
 *
 * @since      2.5.4
 * @package    abovethefold
 * @subpackage abovethefold/admin
 * @author     PageSpeed.pro <info@pagespeed.pro>
 */

class Abovethefold_Admin_Javascript {

	/**
	 * Above the fold controller
	 */
	public $CTRL;

	/**
	 * Options
	 */
	public $options;

	/**
	 * Initialize the class and set its properties.
	 */
	public function __construct( &$CTRL ) {

		$this->CTRL =& $CTRL;
		$this->options =& $CTRL->options;

		/**
		 * Admin panel specific
		 */
		if (is_admin()) {

			/**
			 * Handle form submissions
			 */
			$this->CTRL->loader->add_action('admin_post_abtf_javascript_update', $this,  'update_settings');

		}

	}

    /**
	 * Update settings
	 */
	public function update_settings() {

		check_admin_referer('abovethefold');

		// @link https://codex.wordpress.org/Function_Reference/stripslashes_deep
		$_POST = array_map( 'stripslashes_deep', $_POST );

		$options = get_option('abovethefold');
		if (!is_array($options)) { $options = array(); }

		// input
		$input = (isset($_POST['abovethefold']) && is_array($_POST['abovethefold'])) ? $_POST['abovethefold'] : array();

		// Lazy Load Scripts
		$options['lazyscripts_enabled'] = (isset($input['lazyscripts_enabled']) && intval($input['lazyscripts_enabled']) === 1) ? true : false;

		// update settings
		$this->CTRL->admin->save_settings($options, 'Javascript optimization settings saved.');

		wp_redirect( add_query_arg( array( 'page' => 'abovethefold', 'tab' => 'javascript' ), admin_url( 'admin.php' ) ) );
		exit;
    }

}