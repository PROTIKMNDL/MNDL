<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package poster
 */

if ( ! function_exists( 'poster_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function poster_posted_on() {

	// Get the author name; wrap it in a link.
	$byline = sprintf(
		/* translators: %s: post author */
		__( 'by %s', 'poster' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>'
	);

	// Finally, let's write all of this to the page.
	echo '<span class="posted-on">' . poster_time_link() . '</span><span class="byline"> ' . $byline . '</span>';
}
endif;

if ( ! function_exists( 'poster_time_link' ) ) :
/**
 * Gets a nicely formatted string for the published date.
 */
function poster_time_link() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		get_the_date( DATE_W3C ),
		get_the_date(),
		get_the_modified_date( DATE_W3C ),
		get_the_modified_date()
	);

	// Wrap the time string in a link, and preface it with 'Posted on'.
	return sprintf(
		/* translators: %s: post date */
		__( '<span class="screen-reader-text">Posted on</span> %s', 'poster' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);
}
endif;

if ( ! function_exists( 'poster_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function poster_entry_footer() {
		/* translators: used between list items, there is a space after the comma */
	$separate_meta = __( ', ', 'poster' );

	// Get Categories for posts.
	$categories_list = get_the_category_list( $separate_meta );
	// Get Tags for posts.
	$tags_list = get_the_tag_list( '', $separate_meta );

		
		if ( 'post' === get_post_type() ) {			
			
				if ( $categories_list && poster_categorized_blog() ) {
							echo '<span class="cat-links meta"><span class="screen-reader-text">' . __( 'Categories', 'poster' ) . '</span>' . wp_kses_post($categories_list) . '</span>';
						}
					

		if ( $tags_list ) {
							echo '<span class="tags-links"><span class="screen-reader-text">' . __( 'Tags', 'poster' ) . '</span>' . wp_kses_post($tags_list) . '</span>';
						}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'poster' ), esc_html__( '1 Comment', 'poster' ), esc_html__( '% Comments', 'poster' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'poster' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function poster_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'poster_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'poster_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so poster_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so poster_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in poster_categorized_blog.
 */
function poster_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'poster_categories' );
}
add_action( 'edit_category', 'poster_category_transient_flusher' );
add_action( 'save_post',     'poster_category_transient_flusher' );

if ( ! function_exists( 'poster_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 */
function poster_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
	}
endif;
