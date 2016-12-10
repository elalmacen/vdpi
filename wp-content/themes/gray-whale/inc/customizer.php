<?php
/**
 * graywhale Theme Customizer
 *
 * @package graywhale
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function graywhale_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->default = '#ffffff';

	class graywhale_Customize_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';

		public function render_content() {
		?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
		<?php
		}
	}

	//BIG IMAGE FOR THE FRONT PAGE SPLASH - SETTING
	$wp_customize->add_setting( 'graywhale_theme_settings[frontpage_img]' , array(
	    'default'			=> get_template_directory_uri() . '/images/header-default-big.jpg',
	    'type'				=> 'option',
	    'transport' 		=> 'postMessage',
	    'sanitize_callback' => 'sanitize_null'
	) );
	//BACKGROUND COLOR FOR HEADER TEXT - SETTING
	$wp_customize->add_setting( 'graywhale_theme_settings[header_bg_color]' , array(
	    'default'			=> '#99a6bf',
	    'type'				=> 'option',
	    'transport' 		=> 'postMessage',
	    'sanitize_callback' => 'sanitize_null'
	) );
	//DESCRIPTION INSIDE THE PAGE SPLASH - SETTING
	$wp_customize->add_setting( 'graywhale_theme_settings[frontpage_description]' , array(
	    'default'			=> '',
	    'type'				=> 'option',
	    'sanitize_callback' => 'sanitize_textbox',
	) );
	//EXCERPT OR FULL TEXT ON BLOG PAGES - SETTING
	$wp_customize->add_setting( 'graywhale_theme_settings[excerpt_or_full]' , array(
	    'default'			=> 'excerpt',
	    'type'				=> 'option',
	    'sanitize_callback' => 'sanitize_null',
	    // 'transport' 		=> 'postMessage'
	) );
	//SITE LICENSE INFORMATION - SETTING
	$wp_customize->add_setting( 'graywhale_theme_settings[site_license]' , array(
	    'default'			=> '',
	    'type'				=> 'option',
	    'sanitize_callback' => 'sanitize_textbox',
	    'transport' 		=> 'postMessage'
	) );
	//CONTACT INFORMATION - SETTING
	$wp_customize->add_setting( 'graywhale_theme_settings[contact_info]' , array(
	    'default'			=> '',
	    'type'				=> 'option',
	    'sanitize_callback' => 'sanitize_textbox',
	    /*'transport' 		=> 'postMessage'*/
	) );
	//SOCIAL MEDIA / RSS - SETTING
	$wp_customize->add_setting( 'graywhale_theme_settings[rss]' , array(
	    'default'			=> '1',
	    'type'				=> 'option',
	    'sanitize_callback' => 'sanitize_null'
	) );
	//SOCIAL MEDIA / FACEBOOK - SETTING
	$wp_customize->add_setting( 'graywhale_theme_settings[facebook]' , array(
	    'default'			=> '',
	    'type'				=> 'option',
	    'sanitize_callback' => 'sanitize_social_url',
	    /*'transport' 		=> 'postMessage'*/
	) );
	//SOCIAL MEDIA / TWITTER - SETTING
	$wp_customize->add_setting( 'graywhale_theme_settings[twitter]' , array(
	    'default'			=> '',
	    'type'				=> 'option',
	    'sanitize_callback' => 'sanitize_social_url',
	    /*'transport' 		=> 'postMessage'*/
	) );
	//SOCIAL MEDIA / GOOGLE PLUS - SETTING
	$wp_customize->add_setting( 'graywhale_theme_settings[google_plus]' , array(
	    'default'			=> '',
	    'type'				=> 'option',
	    'sanitize_callback' => 'sanitize_social_url',
	    /*'transport' 		=> 'postMessage'*/
	) );
	//SOCIAL MEDIA / LINKEDIN - SETTING
	$wp_customize->add_setting( 'graywhale_theme_settings[linkedin]' , array(
	    'default'			=> '',
	    'type'				=> 'option',
	    'sanitize_callback' => 'sanitize_social_url',
	    /*'transport' 		=> 'postMessage'*/
	) );
	//SOCIAL MEDIA / YOUTUBE - SETTING
	$wp_customize->add_setting( 'graywhale_theme_settings[youtube]' , array(
	    'default'			=> '',
	    'type'				=> 'option',
	    'sanitize_callback' => 'sanitize_social_url',
	    /*'transport' 		=> 'postMessage'*/
	) );
	//SOCIAL MEDIA / PINTEREST - SETTING
	$wp_customize->add_setting( 'graywhale_theme_settings[pinterest]' , array(
	    'default'			=> '',
	    'type'				=> 'option',
	    'sanitize_callback' => 'sanitize_social_url',
	    /*'transport' 		=> 'postMessage'*/
	) );
	//SOCIAL MEDIA / INSTAGRAM - SETTING
	$wp_customize->add_setting( 'graywhale_theme_settings[instagram]' , array(
	    'default'			=> '',
	    'type'				=> 'option',
	    'sanitize_callback' => 'sanitize_social_url',
	    /*'transport' 		=> 'postMessage'*/
	) );

	//FEATURED IMAGES SECTION
	$wp_customize->add_section( 'graywhale_custom_header_options' , array(
		'title'      => __('Custom Gray Whale Options', 'graywhale'),
		'priority'   => 70,
		'description' => __('Further customize the site\'s header and layout; especially the front page.', 'graywhale')
	) );
	//CUSTOM FOOTER SECTION
	$wp_customize->add_section( 'graywhale_custom_footer' , array(
		'title'      => __('Custom Footer', 'graywhale'),
		'priority'   => 130,
	) );
	//SOCIAL MEDIA Buttons SECTION
	$wp_customize->add_section( 'graywhale_social_media' , array(
		'title'      => __('Social Media Buttons', 'graywhale'),
		'priority'   => 131,
		'description' => __('For each of these services, enter a URL for your account page and a social media button will appear in the theme\'s footer. Blank entries will not appear.', 'graywhale')
	) );

	//BACKGROUND COLOR FOR HEADER TEXT - CONTROL
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'graywhale_bg_color', array(
		'label'        => __('Background color for header text', 'graywhale'),
		'section'    => 'colors',
		'settings'   => 'graywhale_theme_settings[header_bg_color]',
	) ) );
	//BIG IMAGE FOR THE FRONT PAGE SPLASH - CONTROL
	$wp_customize->add_control( new WP_Customize_Image_Control(
		$wp_customize, 'graywhale_frontpage_img_control', array(
				'label'    => __('Front Page Image (1920 x 1080)', 'graywhale'),
				'settings' => 'graywhale_theme_settings[frontpage_img]',
				'section'  => 'graywhale_custom_header_options'
	) ) );
	//DESCRIPTION INSIDE THE PAGE SPLASH - CONTROL
	$wp_customize->add_control( new graywhale_Customize_Textarea_Control( $wp_customize, 'graywhale_frontpage_site_description', array(
		'label'   => __('Site Description (One Short Paragraph)', 'graywhale'),
		'section' => 'graywhale_custom_header_options',
		'settings'   => 'graywhale_theme_settings[frontpage_description]',
	) ) );
	//EXCERPT OR FULL TEXT ON BLOG PAGES - CONTROL
	$wp_customize->add_control('graywhale_excerpt_or_full', array(
		'type'		=> 'select',
		'label'   => __('Excerpt or full text on blog pages?', 'graywhale'),
		'section' => 'graywhale_custom_header_options',
		'choices' => array (
			'excerpt' => __('Excerpt', 'graywhale'),
			'full' => __('Full', 'graywhale') ),
		'settings'   => 'graywhale_theme_settings[excerpt_or_full]',
	) );
	//SITE LICENSE INFORMATION - CONTROL
	$wp_customize->add_control( new graywhale_Customize_Textarea_Control( $wp_customize, 'graywhale_site_license', array(
		'label'   => __('Site License (We recommend Creative Commons)', 'graywhale'),
		'section' => 'graywhale_custom_footer',
		'settings'   => 'graywhale_theme_settings[site_license]',
	) ) );
	//CONTACT INFORMATION - CONTROL
	$wp_customize->add_control( new graywhale_Customize_Textarea_Control( $wp_customize, 'graywhale_contact_info', array(
		'label'   => __('Contact Information as You Would Like It To Appear', 'graywhale'),
		'section' => 'graywhale_custom_footer',
		'settings'   => 'graywhale_theme_settings[contact_info]',
	) ) );
	//SOCIAL MEDIA BUTTONS / RSS - CONTROL
	$wp_customize->add_control('graywhale_rss', array(
		'type'		=> 'checkbox',
		'label'		=> __('RSS Feed', 'graywhale'),
		'section'   => 'graywhale_social_media',
		'settings'  => 'graywhale_theme_settings[rss]',
		'priority'   => 10,
	) );
	//SOCIAL MEDIA BUTTONS / FACEBOOK - CONTROL
	$wp_customize->add_control('graywhale_facebook', array(
		'type'		=> 'url',
		'label'		=> __('Facebook', 'graywhale'),
		'section'   => 'graywhale_social_media',
		'settings'  => 'graywhale_theme_settings[facebook]',
		'priority'   => 20,
	) );
	//SOCIAL MEDIA BUTTONS / TWITTER - CONTROL
	$wp_customize->add_control('graywhale_twitter', array(
		'type'		=> 'url',
		'label'		=> __('Twitter', 'graywhale'),
		'section'   => 'graywhale_social_media',
		'settings'  => 'graywhale_theme_settings[twitter]',
		'priority'   => 30,
	) );
		//SOCIAL MEDIA BUTTONS / GOOGLE PLUS - CONTROL
	$wp_customize->add_control('graywhale_google_plus', array(
		'type'		=> 'url',
		'label'		=> __('Google Plus', 'graywhale'),
		'section'   => 'graywhale_social_media',
		'settings'  => 'graywhale_theme_settings[google_plus]',
		'priority'   => 40,
	) );
	//SOCIAL MEDIA BUTTONS / LINKEDIN - CONTROL
	$wp_customize->add_control('graywhale_linkedin', array(
		'type'		=> 'url',
		'label'		=> __('LinkedIn', 'graywhale'),
		'section'   => 'graywhale_social_media',
		'settings'  => 'graywhale_theme_settings[linkedin]',
		'priority'   => 50,
	) );
	//SOCIAL MEDIA BUTTONS / YOUTUBE - CONTROL
	$wp_customize->add_control('graywhale_youtube', array(
		'type'		=> 'url',
		'label'		=> __('YouTube', 'graywhale'),
		'section'   => 'graywhale_social_media',
		'settings'  => 'graywhale_theme_settings[youtube]',
		'priority'   => 60,
	) );
	//SOCIAL MEDIA BUTTONS / PINTEREST - CONTROL
	$wp_customize->add_control('graywhale_pinterest', array(
		'type'		=> 'url',
		'label'		=> __('Pinterest', 'graywhale'),
		'section'   => 'graywhale_social_media',
		'settings'  => 'graywhale_theme_settings[pinterest]',
		'priority'   => 70,
	) );
	//SOCIAL MEDIA BUTTONS / INSTAGRAM - CONTROL
	$wp_customize->add_control('graywhale_instagram', array(
		'type'		=> 'url',
		'label'		=> __('Instagram', 'graywhale'),
		'section'   => 'graywhale_social_media',
		'settings'  => 'graywhale_theme_settings[instagram]',
		'priority'   => 80,
	) );
}
add_action( 'customize_register', 'graywhale_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function graywhale_customize_preview_js() {
	$loc = array( 	'copyrightDefault' => '&#169; ' . date("Y") . ' ' . get_bloginfo('name'),
						'frontImageDefault' => get_template_directory_uri() . '/images/header-default-big.jpg');

	wp_enqueue_script( 'graywhale_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', false );

	wp_localize_script(	'graywhale_customizer', 'gwOptions', $loc );
}
add_action( 'customize_preview_init', 'graywhale_customize_preview_js' );


/**
 * Sanitizes textboxes by adding <br> tags between lines, running wptexturize
 */
function sanitize_textbox($i) {
	$i = str_replace( array("\n", "\r", "\r\n", "\n\r"), '<br />', $i );
	$i = wptexturize( $i );

	return $i;
}
/**
 * Sanitizes URLs for Social Media Buttons
 */
function sanitize_social_url($i) {
	$i = esc_url_raw( $i, array('http', 'https') );

	return $i;
}
/**
 * Passthrough function for settings that don't require sanitizing
 */
function sanitize_null($i) {
	return $i;
}