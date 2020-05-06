<div class="row small-up-2 medium-up-4 large-up-6">
<?php
$topchildof = absint(get_theme_mod('profile_featuredcate'));
	$poster_popularposts = array( 
	'ignore_sticky_posts' => true,
	'showposts' => 6,
	'cat' => $topchildof,	
			);
		$the_query = new WP_Query( $poster_popularposts );
		if ( $the_query->have_posts() ) :
		while ( $the_query->have_posts() ) : $the_query->the_post();
	?>
	<div class="columns postbox">

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
	<?php the_post_thumbnail('poster-featured-image'); ?>
	<?php else : ?>
	 <img src="<?php echo esc_url(get_template_directory_uri().'/images/thumb.jpg');?>"/>
	</a>
	<?php  endif; ?>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<?php if ( 'post' === get_post_type() ) : ?>
		<?php endif; ?>
	</header><!-- .entry-header -->
			</div>	
		<?php endwhile;  endif; wp_reset_postdata(); ?>

	</article><!-- #post-## -->
</div>