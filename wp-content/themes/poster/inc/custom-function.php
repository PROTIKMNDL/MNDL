<?php
/* ----------------------------------------------------------------------------------- */
/* Social Icons
/*----------------------------------------------------------------------------------- */
if ( ! function_exists( 'poster_socialprofiles' ) ) :
	function poster_socialprofiles(){		
			/*
			** Template to Render Social Icons on Top Bar
			*/
				echo '<div class="socials">';
				for ($i = 1; $i < 8; $i++) : 
				$social = esc_attr(get_theme_mod('poster_social_'.$i));
				if ( ($social != 'none') && ($social != '') ) : ?>
				<a class="hvr-ripple-out" href="<?php echo esc_url( get_theme_mod('poster_social_url'.$i) ); ?>"><i class="fa fa-<?php echo esc_attr($social); ?>"></i></a>
				<?php endif; endfor;
				echo '</div>';
	}
endif;


/* ----------------------------------------------------------------------------------- */
/* Category Top
/*----------------------------------------------------------------------------------- */
function poster_featuredtopcate(){
	echo '<div class="mylanguage"> ';
	//get all categories of current post

global $post;
$topchildof = absint(get_theme_mod('topcateid'));
$taxonomy = 'category';
// Get the term IDs assigned to post.
$post_terms = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) );
// Separator between links.
$separator = ', ';
	if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ) {
		 $term_ids = implode( ',' , $post_terms );
		 $terms = wp_list_categories( array(
			'title_li' => '',
			'style'    => 'none',
			'show_option_none'    => '',		
			'child_of' => $topchildof,
			'echo'     => false,
			'taxonomy' => $taxonomy,
			'include'  => $term_ids
		) );
		$terms = rtrim( trim( str_replace( '<br />',  $separator, $terms ) ), $separator );
		// Display post categories.
		echo  wp_kses_post($terms);
	}
	echo '</div>';
}

function poster_featuredright(){
	$topchildof = absint(get_theme_mod('rightcateid'));
global $post;
$taxonomy = 'category';
// Get the term IDs assigned to post.
$post_terms = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) );
// Separator between links.
$separator = ', ';
	if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ) {
		 $term_ids = implode( ',' , $post_terms );
		 $terms = wp_list_categories( array(
			'title_li' => '',
			'style'    => 'none',
			'show_option_none'    => '',		
			'child_of' => $topchildof,
			'echo'     => false,
			'taxonomy' => $taxonomy,
			'include'  => $term_ids
		) );
		$terms = rtrim( trim( str_replace( '<br />',  $separator, $terms ) ), $separator );
		// Display post categories.
		echo  wp_kses_post($terms);
	}
}

function poster_featuredleft(){
	$topchildof = absint(get_theme_mod('leftcateid'));
global $post;
$taxonomy = 'category';
// Get the term IDs assigned to post.
$post_terms = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) );
// Separator between links.
$separator = ', ';
	if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ) {
		 $term_ids = implode( ',' , $post_terms );
		 $terms = wp_list_categories( array(
			'title_li' => '',
			'style'    => 'none',
			'show_option_none'    => '',		
			'child_of' => $topchildof,
			'echo'     => false,
			'taxonomy' => $taxonomy,
			'include'  => $term_ids
		) );
		$terms = rtrim( trim( str_replace( '<br />',  $separator, $terms ) ), $separator );
		// Display post categories.
		echo  wp_kses_post($terms);
	}
}

/* ----------------------------------------------------------------------------------- */
/* Suggested Plugin Jetpack
/*----------------------------------------------------------------------------------- */
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'poster_register_required_plugins' );
function poster_register_required_plugins() {
	$plugins = array(
	array(
			'name'      => __('Jetpack by WordPress.com','poster'),
			'slug'      => 'jetpack',
			'required'  => false,
		),
		);
		$config = array(
		'id'           => 'poster',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
);

	tgmpa( $plugins, $config );
}	
/* ----------------------------------------------------------------------------------- */
/* Customize Comment Form
/*----------------------------------------------------------------------------------- */
add_filter( 'comment_form_default_fields', 'poster_comment_form_fields' );
function poster_comment_form_fields( $fields ) {
    $commenter = wp_get_current_commenter();
    
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
    
    $fields   =  array(
        'author' => '<div class="large-6 columns"><div class="row collapse prefix-radius"><div class="small-2 columns"><label for="middle-label" class="text-right middle">' . '<span class="prefix"><i class="fa fa-user"></i>'. ( $req ? ' <span class="required">* </span>' : '' ) . '</span></label></div>' .
                    '<div class="small-10 columns"><input class="form-control" placeholder="'. __( 'Name','poster' ) .'" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="20"' . $aria_req . ' /></div></div></div>',
        'email'  => '<div class="large-6 columns"><div class="row collapse prefix-radius"><div class="small-2 columns">' . ' <label for="middle-label" class="text-right middle"><span class="prefix"><i class="fa fa-envelope-o"></i>' . ( $req ? ' <span class="required">* </span>' : '' ) . '</span></label></div> ' .
                    '<div class="small-10 columns"><input class="form-control" placeholder="'. __( 'Email','poster' ) .'" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="20"' . $aria_req . ' /></div></div></div>',
        'url'    => '<div class="large-6 columns"><div class="row collapse prefix-radius"><div class="small-2 columns">' . ' <label for="middle-label" class="text-right middle"><span class="prefix"><i class="fa fa-external-link"></i>'  . '</span></label></div>' .
                    '<div class="small-10 columns"><input class="form-control" placeholder="'. __( 'Website','poster' ) .'" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div></div></div>'        
    );
    
    return $fields;
    
    
}

add_filter( 'comment_form_defaults', 'poster_comment_form' );
function poster_comment_form( $argsbutton ) {
        $argsbutton['class_submit'] = 'float-center button'; 
    
    return $argsbutton;
}



/* ----------------------------------------------------------------------------------- */
/* Custom CSS Output
/*----------------------------------------------------------------------------------- */

function poster_custom_css_output(){
    
    echo '<style type="text/css">';	
    //echo esc_html(get_theme_mod('custom_css'));    

    echo '.floatingmenu #primary-menu > li.menu-item > ul{background: '.esc_html(get_theme_mod('topnavbgcolorsub','#20598a')).' !important;}';
    echo '.floatingmenu,.floatingmenu div.large-8.columns{background-color: '.esc_html(get_theme_mod('topnavbgcolor','#40ACEC')).' !important;}';
    echo '.floatingmenu li.page_item a, .floatingmenu li.menu-item a{color: '.esc_html(get_theme_mod('topnavbgcolorfont','#ffffff')).' !important;}';
    echo '.floatingmenu{position: '.esc_attr(get_theme_mod('radio_menu','fixed')).' !important;}';

	if ( get_theme_mod('poster_body_font') ) :
		echo "body { font-family: ".esc_attr(get_theme_mod('poster_body_font'))."; }";
	endif;
	if ( get_theme_mod('poster_title_font') ) :
		echo "h1.site-title, h1.entry-title, h2.entry-title { font-family: ".esc_attr(get_theme_mod('poster_title_font'))."; }";
	endif;
    echo '</style>';
    
}
add_action('wp_head','poster_custom_css_output');

if ( function_exists('yoast_breadcrumb') ) { 
function poster_breadcrumb_support(){		
		yoast_breadcrumb('<p id="breadcrumbs">','</p>');		
}
add_action('poster_before_single_post_title','poster_breadcrumb_support');
}

// Install notice
if ( ! defined( 'WPINC' ) ) {
	die;
}

function poster_notice() {
	if ( isset( $_GET['activated'] ) ) {
		$return = '<div class="notice updated activation is-dismissible"><p>';
		$my_theme = wp_get_theme();	
		$return .= ' <a class="button button-primary theme-options" href="' . esc_url(admin_url( 'customize.php' )) . '">' . __( 'Theme Options', 'poster' ) . '</a>';
		$return .= ' <a class="button button-primary help" href="https://www.insertcart.com/poster-theme-setup-guide/">' . __( 'Need Help?', 'poster' ) . '</a>';
		$return .= '</p></div>';
		echo wp_kses_post($return);
	}
}
add_action( 'admin_notices', 'poster_notice' );


/* ------------------------------------------------------------------------------ */
/* Woocommerce account infobar
/*------------------------------------------------------------------------------- */
function poster_woocommerce_header_add_to_cart_fragment( $fragments ) {
	ob_start(); global $woocommerce;
	?>
	<a class="cart-contents" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>" title="<?php _e( 'View your shopping cart' ,'poster'); ?>"><?php echo sprintf (_n( '%d item', '%d items','poster'), WC()->cart->cart_contents_count, WC()->cart->cart_contents_count ); ?> - <?php echo wp_kses_post(WC()->cart->get_cart_total()); ?></a> 
	<?php
	
	$fragments['a.cart-contents'] = ob_get_clean();
	
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'poster_woocommerce_header_add_to_cart_fragment' );


/* ------------------------------------------------------------------------------ */
/* My Account/ Login
/*------------------------------------------------------------------------------- */
if(get_theme_mod('poster_woo_myaccount')!=='disable'){
if (class_exists('woocommerce')) {
	function poster_myaccount(){
        if ( is_user_logged_in() ) {
		echo '<a class="myacc" href="';
		echo esc_url(get_permalink( get_option('woocommerce_myaccount_page_id') ));
		echo '" title="'.__('My Account','poster').'">'.__('My Account','poster').'</a>';
		}
	else {

		echo '<div class="postercart"><a class="myacclo" href="';
		echo esc_url(get_permalink( get_option('woocommerce_myaccount_page_id')) ); 
		echo '" title="'.__('Login / Register','poster').'">'.__('Login / Register','poster').'</a>';
		}
	}
	add_action('poster_after_logo','poster_myaccount');
}
}
if(get_theme_mod('poster_woo_cart')!=='disable'){
if (class_exists('woocommerce')) {
	function poster_woocart(){
		global $woocommerce;
		$carturl = WC() ->cart->get_cart_url();
		echo '<a class="cart-contents" href="' . esc_url($carturl) . '" title="'.__('View your shopping cart','poster').'">';
		echo esc_html(sizeof( WC()->cart->get_cart()));
		echo _e(' items - ','poster');
		$wcsubcart = WC()->cart->get_cart_subtotal();
		$wcsubcart = preg_replace('/<(span).*?class="\s*(?:.*\s)?target(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $wcsubcart);
		echo $wcsubcart;
		echo '</a>';
	}
add_action('poster_after_logo','poster_woocart');
}
 }