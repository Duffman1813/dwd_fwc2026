<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package dwd_fwc2026
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses dwd_fwc2026_header_style()
 */
function dwd_fwc2026_custom_header_setup() {
	add_theme_support(
		'custom-header',
		apply_filters(
			'dwd_fwc2026_custom_header_args',
			array(
				'default-image'      => '',
				'default-text-color' => '000000',
				'width'              => 1000,
				'height'             => 250,
				'flex-height'        => true,
				'wp-head-callback'   => 'dwd_fwc2026_header_style',
			)
		)
	);
}
add_action( 'after_setup_theme', 'dwd_fwc2026_custom_header_setup' );

if ( ! function_exists( 'dwd_fwc2026_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see dwd_fwc2026_custom_header_setup().
	 */
	function dwd_fwc2026_header_style() {
		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
			?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
				}
			<?php
			// If the user has set a custom color for the text use that.
		else :
			?>
			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;
