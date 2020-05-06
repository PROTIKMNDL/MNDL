<div class="row small-up-2 medium-up-2 large-up-4 postbox">
<?php 
	$args = array(
	'ignore_sticky_posts' => true,
	'showposts' => 8,
	'orderby' => 'rand'	);
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) :
	while ( $the_query->have_posts() ) : $the_query->the_post();
?>
<div class="columns rand">

<a title="<?php esc_attr(the_title()); ?>" href="<?php esc_url(the_permalink()); ?>" rel="bookmark">
<?php if ( has_post_thumbnail() ) { ?>
<a href="<?php esc_url(the_permalink());?>" rel="bookmark"><?php the_post_thumbnail('poster-random-image'); ?></a>
<?php } else { ?>
<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url(get_template_directory_uri() ); ?>/images/thumb.jpg" class="blog-post-img"></a>
<?php } ?>

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
<h4><a title="<?php esc_attr(the_title()); ?>" href="<?php esc_url(the_permalink()); ?>" rel="bookmark"><?php esc_attr(the_title()); ?></a></h4>
</div>
<?php endwhile; ?>	
<?php endif; ?>		 <?php wp_reset_postdata(); ?>
</div>