<?php
function poster_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'poster_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1284,
		'height'                 => 250,    
		'header-text'            => false,        
		'flex-height'            => true,
		'flex-width'            => true,
		'wp-head-callback'       => 'poster_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'poster_custom_header_setup' );

function poster_header_style() {
	$header_image = get_header_image();
	$text_color   = get_header_textcolor();

	// If no custom options for text are set, let's bail.
	if ( empty( $header_image ) && $text_color == get_theme_support( 'custom-header', 'default-text-color' ) )
		return;

	// If we get this far, we have custom styles.
	?>
	<style type="text/css" id="poster-header-css">
	<?php
		// Has the text been hidden?
		if ( 'blank' === $text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php endif; ?>
	<?php
		if ( ! empty( $header_image ) ) :
	?>
		.header-area {
			background-image: url(<?php header_image(); ?>) ;
			background-size: cover;
		}
		@media (max-width: 767px) {
			.header-area {
				background-size: 768px auto;
			}
		}
		@media (max-width: 359px) {
			.header-area {
				background-size: 360px auto;
			}
		}
	<?php endif; ?>
	</style>
	<?php
}