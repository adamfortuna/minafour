<?php


// Reposition the breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_before_content_sidebar_wrap', 'genesis_do_breadcrumbs' );

// Remove "You are here"
add_filter( 'genesis_breadcrumb_args', 'minafour_breadcrumb' );
function minafour_breadcrumb( $args ) {
  $args['labels']['prefix'] = '';
  return $args;
}

// Remove the separator
function minafour_change_breadcrumb_separator( $args ) {
  $args['sep'] = '';
  return $args;
}
add_filter( 'genesis_breadcrumb_args', 'minafour_change_breadcrumb_separator' );


//* Change the breadcrumb separator
function b3m_change_breadcrumb_separator( $args ) {
  $args['sep'] = ' &rsaquo; ';
  return $args;
}
add_filter( 'genesis_breadcrumb_args', 'minafour_change_breadcrumb_separator' );

//* Change the 'Home' link to point to a different URL
function minafour_breadcrumb_home_link( $crumb ) {
  return preg_replace('/href="[^"]*"/', 'href="/blog"', $crumb);
}
add_filter ( 'genesis_home_crumb', 'minafour_breadcrumb_home_link' );


// function minafour_breadcrumb_home( $crumb ) {
//   return "Asdfsa";
// }
// add_filter ( 'genesis_home_crumb', 'minafour_breadcrumb_home' );