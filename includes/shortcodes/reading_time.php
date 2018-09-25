<?php

class readingTimeWP {

	// Add label option using add_option if it does not already exist
	public $readingTime;

	public function __construct() {
		$defaultSettings = array(
			'label' => 'Reading Time: ',
			'postfix' => 'minutes',
			'postfix_singular' => 'minute',
			'wpm' => 300,
			'before_content' => 'true',
			'before_excerpt' => 'true',
			'exclude_images' => false
		);

		add_shortcode( 'reading_time', array($this, 'rt_reading_time') );
	}

	public function rt_calculate_reading_time($rtPostID, $rtOptions) {
		$rtContent = get_post_field('post_content', $rtPostID);
		$number_of_images = substr_count(strtolower($rtContent), '<img ');
		$strippedContent = strip_shortcodes($rtContent);
		$stripTagsContent = strip_tags($strippedContent);
		$wordCount = str_word_count($stripTagsContent);

		if ( isset($rtOptions['exclude_images'] ) && $rtOptions['exclude_images'] ) {
			// Don't calculate images if they've been set to be excluded
		} else {
			// Calculate additional time added to post by images
			$additional_words_for_images = $this->rt_calculate_images( $number_of_images, $rtOptions['wpm'] );
			$wordCount += $additional_words_for_images;
		}

		$this->readingTime = ceil($wordCount / $rtOptions['wpm']);

		// If the reading time is 0 then return it as < 1 instead of 0.
		if ( $this->readingTime < 1 ) {
			$this->readingTime = __('< 1', 'reading-time-wp');
		}

		return $this->readingTime;

	}

	/**
	 * Adds additional reading time for images
	 *
	 * Calculate additional reading time added by images in posts. Based on calculations by Medium. https://blog.medium.com/read-time-and-you-bc2048ab620c
	 *
	 * @since 1.1.0
	 *
	 * @param int $total_images number of images in post
	 * @param array $wpm words per minute
	 * @return int Additional time added to the reading time by images
	 */
	public function rt_calculate_images( $total_images, $wpm ) {
		$additional_time = 0;
		// For the first image add 12 seconds, second image add 11, ..., for image 10+ add 3 seconds
		for ( $i = 1; $i <= $total_images; $i++ ) {
			if ( $i >= 10 ) {
				$additional_time += 3 * (int) $wpm / 60;
			} else {
				$additional_time += (12 - ($i - 1) ) * (int) $wpm / 60;
			}
		}

		return $additional_time;
	}

	public function rt_reading_time($atts, $content = null) {

		extract (shortcode_atts(array(
			'label' => '',
			'postfix' => '',
			'postfix_singular' => '',
		), $atts));

		$rtReadingOptions = get_option('rt_reading_time_options');

		$rtPost = get_the_ID();

		$this->rt_calculate_reading_time($rtPost, $rtReadingOptions);

		if($this->readingTime > 1) {
			$calculatedPostfix = $postfix;
		} else {
			$calculatedPostfix = $postfix_singular;
		}

		return "
		<span class='span-reading-time'>$label $this->readingTime $calculatedPostfix</span>
		";
	}

    // Calculate reading time by running it through the_content
	public function rt_add_reading_time_before_content($content) {
		$rtReadingOptions = get_option('rt_reading_time_options');

		$originalContent = $content;
		$rtPost = get_the_ID();

		$this->rt_calculate_reading_time($rtPost, $rtReadingOptions);

		$label = $rtReadingOptions['label'];
		$postfix = $rtReadingOptions['postfix'];
		$postfix_singular = $rtReadingOptions['postfix_singular'];

		if(in_array('get_the_excerpt', $GLOBALS['wp_current_filter'])) {
			return $content;
		}

		if($this->readingTime > 1) {
			$calculatedPostfix = $postfix;
		} else {
			$calculatedPostfix = $postfix_singular;
		}

		$content = '<span class="rt-reading-time" style="display: block;">'.'<span class="rt-label">'.$label.'</span>'.'<span class="rt-time">'.$this->readingTime.'</span>'.'<span class="rt-label"> '.$calculatedPostfix.'</span>'.'</span>';
		$content .= $originalContent;
		return $content;
	}

	public function rt_add_reading_time_before_excerpt($content) {
		$rtReadingOptions = get_option('rt_reading_time_options');

		$originalContent = $content;
		$rtPost = get_the_ID();

		$this->rt_calculate_reading_time($rtPost, $rtReadingOptions);

		$label = $rtReadingOptions['label'];
		$postfix = $rtReadingOptions['postfix'];
		$postfix_singular = $rtReadingOptions['postfix_singular'];

		if($this->readingTime > 1) {
			$calculatedPostfix = $postfix;
		} else {
			$calculatedPostfix = $postfix_singular;
		}


		$content = '<span class="rt-reading-time" style="display: block;">'.'<span class="rt-label">'.$label.'</span>'.'<span class="rt-time">'.$this->readingTime.'</span>'.'<span class="rt-label"> '.$calculatedPostfix.'</span>'.'</span>';
		$content .= $originalContent;
		return $content;
	}

}

$readingTimeWP = new readingTimeWP();

?>
