<?php
/**
 * Understrap Child Theme functions and definitions
 *
 * @package UnderstrapChild
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;



/**
 * Removes the parent themes stylesheet and scripts from inc/enqueue.php
 */
function understrap_remove_scripts() {
	wp_dequeue_style( 'understrap-styles' );
	wp_deregister_style( 'understrap-styles' );

	wp_dequeue_script( 'understrap-scripts' );
	wp_deregister_script( 'understrap-scripts' );
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );



/**
 * Enqueue our stylesheet and javascript files
 */
function theme_enqueue_styles() {

	// Get the theme data.
	$the_theme = wp_get_theme();

	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	// Grab asset urls.
	$theme_styles  = "/css/child-theme{$suffix}.css";
	$theme_scripts = "/js/child-theme{$suffix}.js";

	wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $the_theme->get( 'Version' ) );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . $theme_scripts, array(), $the_theme->get( 'Version' ), true );

	$go_directory_custom = array( 'stylesheet_directory_uri' => get_stylesheet_directory_uri() );
	wp_localize_script( 'child-understrap-scripts', 'directory_uri', $go_directory_custom );

	//google maps JS
	wp_enqueue_script('gmaps-scripts', 'https://maps.googleapis.com/maps/api/js?key='.GO_GMAPS_KEY.'&callback=initMap&v=weekly', '', '', true);

	//drag and drop JS
	wp_enqueue_script( 'go-filedrop-scripts', get_stylesheet_directory_uri() . '/js/file_drop.js', $the_theme->get( 'Version' ), false);

	//copy clipboard
	wp_enqueue_script( 'go-clipboard-scripts', get_stylesheet_directory_uri() . '/js/copy_clipboard.js', $the_theme->get( 'Version' ), false );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );



/**
 * Load the child theme's text domain
 */
function add_child_theme_textdomain() {
	load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );



/**
 * Overrides the theme_mod to default to Bootstrap 5
 *
 * This function uses the `theme_mod_{$name}` hook and
 * can be duplicated to override other theme settings.
 *
 * @param string $current_mod The current value of the theme_mod.
 * @return string
 */
function understrap_default_bootstrap_version( $current_mod ) {
	return 'bootstrap5';
}
add_filter( 'theme_mod_understrap_bootstrap_version', 'understrap_default_bootstrap_version', 20 );



/**
 * Loads javascript for showing customizer warning dialog.
 */
function understrap_child_customize_controls_js() {
	wp_enqueue_script(
		'understrap_child_customizer',
		get_stylesheet_directory_uri() . '/js/customizer-controls.js',
		array( 'customize-preview' ),
		'20130508',
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'understrap_child_customize_controls_js' );

/**
 * Remove understrap footer info
 **/
function understrap_site_info() {
	echo '';
}

/**
 * Include ACF
 **/
// Define path and URL to the ACF plugin.
define( 'GO_ACF_PATH', get_stylesheet_directory() . '/inc/plugins/advanced-custom-fields/' );
define( 'GO_ACF_URL', get_stylesheet_directory_uri() . '/inc/plugins/advanced-custom-fields/' );

// Include the ACF plugin.
include_once( GO_ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'go_acf_settings_url');
function go_acf_settings_url( $url ) {
    return GO_ACF_URL;
}

// Hide the ACF admin menu item.
//add_filter('acf/settings/show_admin', 'go_acf_settings_show_admin');
function go_acf_settings_show_admin( $show_admin ) {
    return false;
}


/**
 * Include Submissions CPT
 **/
require_once( get_stylesheet_directory() . '/inc/cpt/submission.php');

