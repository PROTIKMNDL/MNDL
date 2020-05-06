<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package poster
 */

?>

<div class="columns postbox">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if(get_theme_mod('topcateid_hide')!=='hide'){ poster_featuredtopcate();} ?> 

<?php if ( has_post_thumbnail() ) : ?>
<div class="mylabels">
<?php 
if(get_theme_mod('leftcateid_hide')!=='hide'){	echo '<div class="leftyear"> '; poster_featuredleft(); echo '</div>';}
	if(get_theme_mod('rightcateid_hide')!=='hide'){ echo '<div class="rightrip"> '; poster_featuredright(); echo '</div>';} ?>  
</div>
	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
	<?php the_post_thumbnail('poster-featured-image'); ?>
	</a>
<?php else : ?>

<div class="mylabels">
	<?php 
	echo '<div class="leftyear-thumb"> '; poster_featuredleft(); echo '</div>';
echo '<div class="rightrip-thumb"> ';	poster_featuredright(); echo '</div>'; ?> 
</div>
<?php endif; ?>
<footer class="entry-footer">
		<?php 
		/* translators: used between list items, there is a space after the comma */
	$separate_meta = __( ', ', 'poster' );

	// Get Categories for posts.
	$categories_list = get_the_category_list( $separate_meta );
		
		if ( 'post' === get_post_type() ) {			
			
				if ( $categories_list && poster_categorized_blog() ) {
							echo '<span class="cat-links">' . wp_kses_post($categories_list) . '</span>';
						}
				
		} 
		?>
	</footer><!-- .entry-footer -->
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

</article><!-- #post-## -->
</div>