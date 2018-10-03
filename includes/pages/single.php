<?php

function updated_after_some_time() {
  $u_time = get_the_time('U');
  $u_modified_time = get_the_modified_time('U');
  $custom_content = '';
  if($u_modified_time <= $u_time + 604800) {
    return "is-hidden";
  }
}
add_filter( 'genesis_post_info', 'minafour_post_meta_filter' );
function minafour_post_meta_filter($post_meta) {
  return '<div class="single--meta">
      <figure class="image is-pulled-left">
        <img itemprop="image" src="'.get_avatar_url(get_the_author_meta("user_email")).'" class="image is-48x48 is-rounded" height="48" width="48" />
      </figure>
      <p class="has-text-center">
        Written by [post_author_posts_link] on [post_date].
        <time class="'.updated_after_some_time().'" datetime="'.get_the_modified_date( DATE_W3C ).'" itemprop="dateModified">Updated '.get_the_modified_date( get_option('date_format') ).'.</time>
        <br/>
        [reading_time label="" postfix="min read." postfix_singular="min read."]
        [post_categories before="" after="."]
        [post_comments]
      </p>
    </div>';
}

genesis_register_sidebar( array(
	'id'		=> 'minafibeforefooter',
	'name'		=> __( 'Post Footer', 'minafour' ),
	'description'	=> __( 'This is the before footer section', 'minafour' ),
) );

add_action( 'genesis_before_comments', 'minafour_add_post_widget', 15 );
function minafour_add_post_widget() {
	genesis_widget_area( 'minafibeforefooter', array(
		'before' => '<div class="beforefooter">',
		'after'  => '</div>',
	) );
}

remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

//* Remove the entry meta in the entry footer (requires HTML5 theme support)
remove_action( 'genesis_entry_footer', 'genesis_post_meta' ); 