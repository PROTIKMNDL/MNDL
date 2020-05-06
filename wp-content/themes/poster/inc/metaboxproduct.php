<?php
/**
 * Add meta box
 *
 */
function posterproduct_add_meta_boxes( $post ){
	add_meta_box( 'poster_meta_box', __( '<span class="dashicons dashicons-layout"></span> Product Layout Select [Pro Only]', 'poster' ), 'posterproduct_build_meta_box', 'product', 'side', 'high' );
}
add_action( 'add_meta_boxes', 'posterproduct_add_meta_boxes' );
/**
 * Build custom field meta box
 *
 * @param post $post The post object
 */
function posterproduct_build_meta_box( $post ){
	// make sure the form request comes from WordPress
	wp_nonce_field( basename( __FILE__ ), 'posterproductmeta_meta_box_nonce' );
	// retrieve the _poster_posterproductmeta current value
	$current_posterproductmeta = get_post_meta( $post->ID, '_poster_posterproductmeta', true );
	
	$upgradetopro = 'Layout Select for current Page only - for website layout please choose from theme options <a href="' . esc_url('https://www.insertcart.com/product/poster-pro-wordpress-theme/','poster') . '" target="_blank">' . esc_attr__( 'Get Poster Pro', 'poster' ) . '</a>';
	
	?>
	<div class='inside'>

		<h4><?php echo $upgradetopro; ?></h4>
		<p>
			<input type="radio" name="posterproductmeta" value="ls" <?php checked( $current_posterproductmeta, 'ls' ); ?> /> <?php _e('Left Sidebar - Default','poster'); ?><br/>
			<input type="radio" name="posterproductmeta" value="rsd" <?php checked( $current_posterproductmeta, 'rsd' ); ?> /> <?php _e('Right Sidebar','poster'); ?><br />
			<input type="radio" name="posterproductmeta" value="fc" <?php checked( $current_posterproductmeta, 'fc' ); ?> /> <?php _e('Full Content - No Sidebar','poster'); ?>
		</p>
	</div>
	<?php
}
/**
 * Store custom field meta box data
 *
 * @param int $post_id The post ID.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/save_post
 */
function poster_product_save_meta_box_data( $post_id ){
	// verify meta box nonce
	if ( !isset( $_POST['posterproductmeta_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['posterproductmeta_meta_box_nonce'], basename( __FILE__ ) ) ){
		return;
	}
	// return if autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
		return;
	}
  // Check the user's permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ){
		return;
	}
	// store custom fields values
	// posterproductmeta string
	if ( isset( $_REQUEST['posterproductmeta'] ) ) {
		update_post_meta( $post_id, '_poster_posterproductmeta', sanitize_text_field( $_POST['posterproductmeta'] ) );
	}

}
add_action( 'save_post', 'poster_product_save_meta_box_data' );