<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package poster
 */

?>

	</div><!-- #content -->
	</div><!-- #content -->

<div id="footer-widget">
<div class="row">
<div class="large-3 columns">
	<?php dynamic_sidebar( 'footer-1' ); ?></div>
<div class="large-3 columns">
	<?php dynamic_sidebar( 'footer-2' ); ?></div>
<div class="large-3 columns">
	<?php dynamic_sidebar( 'footer-3' ); ?></div> 
<div class="large-3 columns">
	<?php dynamic_sidebar( 'footer-4' ); ?></div>
	</div>
</div>


	<footer id="colophon" role="contentinfo">
	<div class="site-footer">
		<div class="small-12 medium-6 large-6 columns">
		<div class="site-info">			
			<a href="<?php echo esc_url( __( 'https://www.insertcart.com/poster-theme-setup-guide/', 'poster' ) ); ?>"><?php printf( __( 'Theme: %s', 'poster' ), 'Poster' ); ?></a>
			<span class="sep"> | </span>
			<?php echo ( get_theme_mod('poster_footer_text') == '' ) ? ('&copy; '.date_i18n('Y').' '.get_bloginfo('name').__('. All Rights Reserved. ','poster')) : esc_attr(get_theme_mod('poster_footer_text')); ?>
		</div><!-- .site-info -->
		</div>
		<div class="small-12 medium-6 large-6 columns social">
		<?php echo wp_kses_post( poster_socialprofiles() ); ?>  
		</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>
</div></div>
</body>
</html>