<?php

// REMOVE WP EMOJI
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// Disable Dashicons
// add_action( 'wp_print_styles',     'my_deregister_styles', 100 );
function my_deregister_styles()    {
  wp_deregister_style( 'dashicons' );
}

// Disable the superfish script
// add_action( 'wp_enqueue_scripts', 'sp_disable_superfish' );
function sp_disable_superfish() {
	wp_deregister_script( 'superfish' );
	wp_deregister_script( 'superfish-args' );
}

// Disable Megamenu loading font awesome
add_action( 'wp_print_styles', 'megamenu_dequeue_icons', 5 );
function megamenu_dequeue_icons() {
	wp_dequeue_style( 'megamenu-fontawesome' );
	wp_dequeue_style( 'megamenu-genericons' );
	wp_dequeue_style( 'megamenu-fontawesome-css');
	wp_dequeue_style( 'megamenu-genericons-css');
}
