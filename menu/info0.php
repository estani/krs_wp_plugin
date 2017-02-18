<?php


add_action( 'init', 'setup_buttons' );
function setup_buttons() {
    add_filter( "mce_external_plugins", "add_buttons" );
    add_filter( 'mce_buttons', 'register_buttons' );
}

function add_buttons( $plugin_array ) {
    $plugin_array['kunstraum'] = KRS_PLUGIN_URL . '/menu/js/info_plugin.js';
    return $plugin_array;
}
function register_buttons( $buttons ) {
    array_push( $buttons, 'dropcap', 'showrecent' ); // dropcap', 'recentposts
    return $buttons;
}
