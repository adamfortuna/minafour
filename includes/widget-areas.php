<?php
/**
 * Register widget areas
 *
 * @package      Minafour
 * @author       Adam Fortuna
 * @link         https://minafi.com
 * @copyright    Copyright (c) 2018, Adam Fortuna
 * @license      GPL-2.0+
 */

// Todo: Add Widgets here

unregister_sidebar( 'header-right' );

// Register front page widget areas
// genesis_register_sidebar( array(
// 	'id'            => 'home-welcome',
// 	'name'          => __( 'Home Welcome', 'scratch' ),
// 	'description'   => __( 'This is a home widget area that will show on the front page', 'scratch' ),
// ) );
// genesis_register_sidebar( array(
// 	'id'            => 'call-to-action',
// 	'name'          => __( 'Call to Action', 'scratch' ),
// 	'description'   => __( 'This is a call to action widget area that will show on the front page', 'scratch' ),
// ) );