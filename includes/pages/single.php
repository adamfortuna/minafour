<?php


// Add featured image on single post
add_action( 'genesis_before_entry_content', 'minafour_featured_image', 1 );
function minafour_featured_image() {
	$image = genesis_get_image( array( // more options here -> genesis/lib/functions/image.php
			'format'  => 'html',
			'size'    => 'large',
			'context' => '',
			'attr'    => array ( 'class' => 'aligncenter' ), // set a default WP image class
			
    ) );
	if (is_singular()) {
		if ( $image ) {
			printf( '<div class="article--featured-image has-text-centered">%s</div>', $image );
		}
	}
}

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
  return '<div>
      <figure class="image is-48x48">
        <img itemprop="image" src="'.get_avatar_url(get_the_author_meta("user_email")).'" class="is-rounded is-48x48" height="48" width="48" />
      </figure>
      <p>
        Written by [post_author_posts_link] on [post_date].
        <time class="'.updated_after_some_time().'" datetime="'.get_the_modified_date( DATE_W3C ).'" itemprop="dateModified">Updated '.get_the_modified_date( get_option('date_format') ).'.</time>
        <br/>
        [reading_time label="" postfix="min read." postfix_singular="min read."]
        [post_categories before="" after="."]
        <br>
        [post_comments]
      </p>
    </div>';
  
/*

  <p class="article--header-meta-date mb-0">
          
          <span>
            Written by
            <span class="article--author-name" itemprop="name" rel="author"><a href="/about"><?php echo get_the_author_meta('display_name') ?></a></span>
            <time datetime="<?php echo get_the_date( DATE_W3C ) ?>" itemprop="datePublished">
               on <?php the_time( get_option('date_format') ); ?></time>.
            <time class="<?php updated_after_some_time(); ?>" datetime="<?php echo the_modified_date( DATE_W3C ) ?>" itemprop="dateModified">Updated <?php the_modified_date( get_option('date_format') ); ?>.</time>
            <br/>
            <?php echo do_shortcode('[rt_reading_time label="" postfix="min read." postfix_singular="min read."]') ?>
            <span class="article--header-categories">
              <?php echo get_the_category_list(', '); ?>.
            </span>
          </span>
        </p>

  return $post_meta;
  */


}