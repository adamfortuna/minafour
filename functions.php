<?php

/**
 * Theme customizations
 *
 * @package      Minafour
 * @author       Adam Fortuna
 * @link         https://minafi.com
 * @copyright    Copyright (c) 2018, Adam Fortuna
 * @license      GPL-2.0+
 */

// Load child theme textdomain.
load_child_theme_textdomain('minafour');

add_action('genesis_setup', 'minafour_setup', 15);
/**
 * Theme setup.
 *
 * Attach all of the site-wide functions to the correct hooks and filters. All
 * the functions themselves are defined below this setup function.
 *
 * @since 1.0.0
 */
function minafour_setup() {
  // Define theme constants.
  define( 'CHILD_THEME_NAME', 'Minafour' );
  define( 'CHILD_THEME_URL', 'https://minafi.com' );
  define( 'CHILD_THEME_VERSION', '1.0.0' );

  // Add HTML5 markup structure.
  add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption'  ) );

  // Add viewport meta tag for mobile browsers.
  add_theme_support( 'genesis-responsive-viewport' );

  // Add theme support for accessibility.
  add_theme_support( 'genesis-accessibility', array(
    '404-page',
    'drop-down-menu',
    'headings',
    'rems',
    'search-form',
    'skip-links',
  ) );

  // Add theme support for footer widgets.
  // Todo: See how many footer widget areas I need
  add_theme_support('genesis-footer-widgets', 1);


	// Unregister layouts that use secondary sidebar.
	genesis_unregister_layout( 'sidebar-content-sidebar' );
  genesis_unregister_layout( 'sidebar-sidebar-content' );
  
  // Add theme widget areas.
  include_once( get_stylesheet_directory() . '/includes/widget-areas.php' );
  
  // Optimize Wordpress
  include_once( get_stylesheet_directory() . '/includes/optimizations.php' );

  // Specific page updates
  include_once( get_stylesheet_directory() . '/includes/pages/single.php' );
  include_once( get_stylesheet_directory() . '/includes/pages/footer.php' );


  include_once( get_stylesheet_directory() . '/includes/shortcodes/reading_time.php' );
}

