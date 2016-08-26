<?php

namespace Roots\Sage\Customizer;

use Roots\Sage\Assets;

/**
 * Add postMessage support
 */
function customize_register($wp_customize) {
  $wp_customize->get_setting('blogname')->transport = 'postMessage';
}
add_action('customize_register', __NAMESPACE__ . '\\customize_register');

/**
 * Customizer JS
 */
function customize_preview_js() {
  wp_enqueue_script('sage/customizer', Assets\asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
}
add_action('customize_preview_init', __NAMESPACE__ . '\\customize_preview_js');


/**
* Create Logo Setting and Upload Control
*/
function add_header_logo_settings($wp_customize) {
	// add a setting for the site logo
	$wp_customize->add_setting('header_logo');
	// Add a control to upload the logo
	$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'header_logo',
		array(
			'label' => 'Upload Logo',
			'section' => 'title_tagline',
			'settings' => 'header_logo',
		) ) );
}
add_action('customize_register', __NAMESPACE__ . '\\add_header_logo_settings');