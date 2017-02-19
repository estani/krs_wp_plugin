<?php
/**
 * Plugin Name: Kunst Raum Steglitz
 * Description: This plugin adds special functions for Kunst Raum Steglitz
 * Version: 1.0.0
 * License: GPL2
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

define( 'KRS_PLUGIN', __FILE__ );
define( 'KRS_PLUGIN_BASENAME', plugin_basename( KRS_PLUGIN ) );
define( 'KRS_PLUGIN_NAME', trim( dirname( KRS_PLUGIN_BASENAME ), '/' ) );
define( 'KRS_PLUGIN_DIR', untrailingslashit( dirname( KRS_PLUGIN ) ) );
define( 'KRS_PLUGIN_URL', plugins_url('', KRS_PLUGIN) );
define( 'KRS_PLUGIN_IMAGES_URL', KRS_PLUGIN_URL . '/images' );

define( 'KRS_LOGO',  KRS_PLUGIN_IMAGES_URL . "/logo.png");
define( 'KRS_PINK_COLOR', '#ec048c');
define( 'KRS_A_LETTER_STYLE','font-style:italic;color:' . KRS_PINK_COLOR);


//[logo] - show KRS logo (default floating right)
function logo_func( $atts ) {
	$a = shortcode_atts( array(
        	'position' => 'right'
    		), $atts );
	$style = "float:{$a['position']};";
	return "<div><img style=\"$style\"; src=\"" . KRS_LOGO . "\"/></div>";
}
add_shortcode( 'logo', 'logo_func' );

//wirtes
function krs_func( $attrs ) {
	return "<span>KUNST.R<span style=" . KRS_A_LETTER_STYLE . ">A</span>UM.STEGLITZ</span>";
}
add_shortcode( 'krs', 'krs_func');


require_once KRS_PLUGIN_DIR . '/menu/editor_info.php';
require_once KRS_PLUGIN_DIR . '/menu/settings.php';
