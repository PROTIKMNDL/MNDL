<?php
/**
 * poster Theme Customizer.
 *
 * @package poster
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
 
if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

/**
 * A class to create a dropdown for all categories in your wordpress site
 */
 class Category_Dropdown_Custom_Control extends WP_Customize_Control
 {
    private $cats = false;

    public function __construct($manager, $id, $args = array(), $options = array())
    {
        $this->cats = get_categories($options);

        parent::__construct( $manager, $id, $args );
    }

    /**
     * Render the content of the category dropdown
     *
     * @return HTML
     */
    public function render_content()
       {
            if(!empty($this->cats))
            {
                ?>
                    <label>
                      <span class="customize-category-select-control"><?php echo esc_html( $this->label ); ?></span>
                      <select <?php $this->link(); ?>>
                           <?php
                                foreach ( $this->cats as $cat )
                                {
                                    printf('<option value="%s" %s>%s</option>', $cat->term_id, selected($this->value(), $cat->term_id, false), $cat->name);
                                }
                           ?>
                      </select>
                    </label>
                <?php
            }
       }
 }
 
function poster_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';	
	$wp_customize->get_section( 'title_tagline'  )->title		= __('Site Titles & Logo','poster');
	$wp_customize->get_control( 'header_text'  )->label			= __('Display Site Title','poster');
	$wp_customize->get_section( 'title_tagline'  )->priority	= 10;
	$wp_customize->get_section( 'colors'  )->title				= __('Logo Text & Background Color','poster');
	$wp_customize->get_section( 'colors'  )->panel				= 'poster_panel_design';
	$wp_customize->get_section( 'background_image'  )->panel	= 'poster_panel_design';

	// Theme important links started
   class poster_Important_Links extends WP_Customize_Control {

      public $type = "poster-important-links";

      public function render_content() {
         //Add Theme instruction
		 $poster_features = array(
		 'Features' => array(
               'text' => __('Features 1', 'poster'),
               'text' => __('Features 2', 'poster'),
               'text' => __('Features 3', 'poster'),
               'text' => __('Features 4', 'poster'),
            ), 
		 
		 );
		 echo '<ul><b>
			<li>' . esc_attr__( '* Fully Mobile Responsive', 'poster' ) . '</li>
			<li>' . esc_attr__( '* Dedicated Option Panel', 'poster' ) . '</li>
			<li>' . esc_attr__( '* Customize Theme Color', 'poster' ) . '</li>
			<li>' . esc_attr__( '* WooCommerce & bbPress Support', 'poster' ) . '</li>
			<li>' . esc_attr__( '* SEO Optimized', 'poster' ) . '</li>
			<li>' . esc_attr__( '* Control Individual Meta Option like: Category, date, Author, Tags etc. ', 'poster' ) . '</li>
			<li>' . esc_attr__( '* Full Support', 'poster' ) . '</li>
			<li>' . esc_attr__( '* Google Fonts', 'poster' ) . '</li>
			<li>' . esc_attr__( '* Theme Color Customization', 'poster' ) . '</li>
			<li>' . esc_attr__( '* Custom CSS', 'poster' ) . '</li>
			<li>' . esc_attr__( '* Website Layout', 'poster' ) . '</li>
			<li>' . esc_attr__( '* Select Number of Columns', 'poster' ) . '</li>
			<li>' . esc_attr__( '* Website Width Control', 'poster' ) . '</li>
			<li>' . esc_attr__( '* News Ticker with category control', 'poster' ) . '</li>
			<li>' . esc_attr__( '* Much more', 'poster' ) . '</li>
			</b></ul>
		 ';
         $important_links = array(
		 
            'theme-info' => array(
               'link' => esc_url('https://www.insertcart.com/product/poster-pro-wordpress-theme/'),
               'text' => __('Poster Pro', 'poster'),
            ),
            'support' => array(
               'link' => esc_url('https://www.insertcart.com/contact-us/'),
               'text' => __('Contact us', 'poster'),
            ),         
			'Documentation' => array(
               'link' => esc_url('https://www.insertcart.com/poster-theme-setup-guide/'),
               'text' => __('Documentation', 'poster'),
            ),			 
         );
         foreach ($important_links as $important_link) {
            echo '<p><a target="_blank" href="' . esc_url($important_link['link']) . '" >' . esc_attr($important_link['text']) . ' </a></p>';
         }
               }

   }
      $wp_customize->add_section('poster_important_links', array(
      'priority' => 1,
      'title' => __('Upgrade to Pro', 'poster'),
   ));

   $wp_customize->add_setting('poster_important_links', array(
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'poster_links_sanitize'
   ));

   $wp_customize->add_control(new poster_Important_Links($wp_customize, 'important_links', array(
      'section' => 'poster_important_links',
      'settings' => 'poster_important_links'
   )));
	
// create an empty array
$cats = array();
 
// we loop over the categories and set the names and
// labels we need
foreach ( get_categories() as $categoriesi => $categoryy ){
    $cats[$categoryy->term_id] = $categoryy->name;
}
	
	// Top Navigation Color
	$wp_customize->add_section( 'top_navi_colorbg' , array(
    'title'      => __( 'Top Navigation Color', 'poster' ),
	'panel'			=> 'poster_panel_design',
    'priority'   => 64,
) );


/**************************************************
* Settings
***************************************************/

$wp_customize->add_setting('radio_menu',
    array(
        'default'			=> 'fixed',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'poster_sanitize_select'
    )
);
$wp_customize->add_setting( 'topnavbgcolor' , array(
    'default'     => '#40ACEC',
    'transport'   => 'refresh',
	'sanitize_callback'	=> 'sanitize_hex_color',
) );
$wp_customize->add_setting( 'topnavbgcolorsub' , array(
    'default'     => '#20598a',
    'transport'   => 'refresh',
	'sanitize_callback'	=> 'sanitize_hex_color',
) );
$wp_customize->add_setting( 'topnavbgcolorfont' , array(
    'default'     => '#ffffff',
    'transport'   => 'refresh',
	'sanitize_callback'	=> 'sanitize_hex_color',
) );
$wp_customize->add_setting('search_setting',
    array(
        'default'			=> 'show',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'poster_sanitize_select'
    )
);
/**************************************************
* Layout
***************************************************/
// Post Settings
	$wp_customize->add_section( 'poster_panel_layout' , array(
    'title'      => __( 'Layout', 'poster' ),
	'panel'			=> 'poster_panel_design',
    'priority'   => 2,
) );


//Author Profile
 $wp_customize->add_setting('website_layout',	
	array(
		'default'			=> 'rightside',
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'poster_sanitize_select'
	));
$wp_customize->add_control('website_layout',
                         array (                             
							'type' => 'radio',
							'label' => __('Post and Page Layout','poster'),
							'settings'   => 'website_layout',
							'section' => 'poster_panel_layout',
							'choices' => array(          
							'rightside' => __('Right Sidebar','poster'),
							'left' => __('Left Sidebar','poster'),
							'full' => __('Full Width [No sidebar]','poster'),
                         )
						 ));	
	
/**************************************************
* Fonts
***************************************************/
$font_array = array('Raleway','Khula','Open Sans','Indie Flower','Droid Sans','Droid Serif','Roboto','Roboto Condensed','Lato','Bree Serif','Oswald','Slabo','Lora','Source Sans Pro','PT Sans','Ubuntu','Lobster','Arimo','Bitter','Noto Sans','Fjalla One','PT Sans Narrow','Poiret One','Passion One','Arvo','Inconsolata','Shadows Into Light','Pacifico','Dancing Script','Architects Daughter','Sigmar One','Righteous','Amatic SC','Orbitron','Chewy','Lobster Two','Gloria Hallelujah','Lekton','Almendra Display','Swanky and Moo Moo','Hanalei Fill','Uncial Antiqua','Rouge Script','Engagement','Bonbon','Caesar Dressing','Kenia','Lemon','Stardos Stencil','Bilbo','Macondo','Delius Unicase','Butcherman','Monoton','Nosifer','Codystar','Fontdiner Swanky','Diplomata SC','Snowburst One','Faster One','Rock Salt','Eater');
$fonts = array_combine($font_array, $font_array);
// Body Fonts
	$wp_customize->add_section( 'poster_panel_bodyfonts' , array(
    'title'      => __( 'Body Fonts', 'poster' ),
	'panel'			=> 'poster_panel_advance',
    'priority'   => 1,
) );	
$wp_customize->add_setting(
	'poster_title_font',
	array(
		'default'=> 'Open Sans',
		'sanitize_callback' => 'poster_sanitize_gfont' 
		)
);
$wp_customize->add_control(
	'poster_title_font',array(
			'label' => __('Title','poster'),
			'settings' => 'poster_title_font',
			'section'  => 'poster_panel_bodyfonts',
			'type' => 'select',
			'choices' => $fonts,
		)
);
$wp_customize->add_setting(
		'poster_body_font',
			array(	'default'=> 'Open Sans',
					'sanitize_callback' => 'poster_sanitize_gfont' )
	);

$wp_customize->add_control(
		'poster_body_font',array(
				'label' => __('Body','poster'),
				'settings' => 'poster_body_font',
				'section'  => 'poster_panel_bodyfonts',
				'type' => 'select',
				'choices' => $fonts
			)
	);
/**************************************************
* Post Settings
***************************************************/
// Post Settings
	$wp_customize->add_section( 'poster_panel_postsettings' , array(
    'title'      => __( 'Post Settings', 'poster' ),
	//'panel'			=> 'poster_panel_advance',
    'priority'   => 2,
) );


$wp_customize->add_setting('random_post',	
	array(
		'default'			=> 'enable',
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'poster_sanitize_select'
	));
$wp_customize->add_control('random_post',
                         array (                             
							'type' => 'radio',
							'label' => __('Random Post Below Post','poster'),
							'settings'   => 'random_post',
							'section' => 'poster_panel_postsettings',
							'choices' => array(
							'enable' => __('Enable','poster'),
							'disable' => __('Disable','poster'),
                         )
						 ));						
$wp_customize->add_setting('poster_author_profile',	
	array(
		'default'			=> 'enable',
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'poster_sanitize_select'
	));
$wp_customize->add_control('poster_author_profile',
                         array (                             
							'type' => 'radio',
							'label' => __('Show Author Profile in Post and Pages','poster'),
							'settings'   => 'poster_author_profile',
							'section' => 'poster_panel_postsettings',
							'choices' => array(
							'enable' => __('Enable','poster'),
							'disable' => __('Disable','poster'),
                         )
						 ));
	
$wp_customize->add_setting('singlepost_thumb',	
	array(
		'default'			=> 'enable',
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'poster_sanitize_select'
	));
$wp_customize->add_control('singlepost_thumb',
                         array (                             
							'type' => 'radio',
							'label' => __('Thumbnail in Single Post','poster'),
							'settings'   => 'singlepost_thumb',
							'section' => 'poster_panel_postsettings',
							'choices' => array(
							'enable' => __('Enable','poster'),
							'disable' => __('Disable','poster'),
                         )
						 ));
						 
						 
						 
/**************************************************
* WooCommerce
***************************************************/
// Woocommerce
	$wp_customize->add_section( 'poster_woo_section' , array(
    'title'      => __( 'WooCommerce', 'poster' ),
	//'panel'			=> 'poster_panel_design',
    'priority'   => 67,
) );
$wp_customize->add_setting('poster_woo_myaccount',	
	array(
		'default'			=> '',
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'transport'   => 'post',
		'sanitize_callback'	=> 'poster_sanitize_select'
	));
$wp_customize->add_control('poster_woo_myaccount', array (                             
				'type' => 'radio',
				'label' => __('My Account/ Login','poster'),
				'settings'   => 'poster_woo_myaccount',
				'section' => 'poster_woo_section',
				'choices' => array(
				'enable' => __('Enable','poster'),
				'disable' => __('Disable','poster'),
			 )
			 ));
$wp_customize->add_setting('poster_woo_cart',	
	array(
		'default'			=> '',
		'type'				=> 'theme_mod',
		'transport'   => 'post',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'poster_sanitize_select'
	));
$wp_customize->add_control('poster_woo_cart', array (                             
				'type' => 'radio',
				'label' => __('Cart','poster'),
				'settings'   => 'poster_woo_cart',
				'section' => 'poster_woo_section',
				'choices' => array(
				'enable' => __('Enable','poster'),
				'disable' => __('Disable','poster'),
			 )
			 ));
// Woocommerce Settings
$wp_customize->add_setting('poster_woo_lightbox',	
	array(
		'default'			=> '',
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'poster_sanitize_select'
	));
$wp_customize->add_control('poster_woo_lightbox', array (                             
				'type' => 'radio',
				'label' => __('LightBox Open Images','poster'),
				'settings'   => 'poster_woo_lightbox',
				'section' => 'poster_woo_section',
				'choices' => array(
				'enable' => __('Enable','poster'),
				'disable' => __('Disable','poster'),
			 )
			 ));
$wp_customize->add_setting('poster_woo_zoom',	
	array(
		'default'			=> '',
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'poster_sanitize_select'
	));
$wp_customize->add_control('poster_woo_zoom', array (                             
				'type' => 'radio',
				'label' => __('Zoom Product Images','poster'),
				'settings'   => 'poster_woo_zoom',
				'section' => 'poster_woo_section',
				'choices' => array(
				'enable' => __('Enable','poster'),
				'disable' => __('Disable','poster'),
			 )
			 ));	
$wp_customize->add_setting('poster_woo_slider',	
	array(
		'default'			=> '',
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'poster_sanitize_select'
	));
$wp_customize->add_control('poster_woo_slider', array (                             
				'type' => 'radio',
				'label' => __('Slide Product Images','poster'),
				'settings'   => 'poster_woo_slider',
				'section' => 'poster_woo_section',
				'choices' => array(
				'enable' => __('Enable','poster'),
				'disable' => __('Disable','poster'),
			 )
			 ));	
/**************************************************
* Footer Copyright
***************************************************/
	$wp_customize-> add_section(
    'poster_custom_footer',
    array(
    	'title'			=> __('Custom Footer Text','poster'),
    	'description'	=> __('Enter your Own Copyright Text.','poster'),
    	'priority'		=> 3,
    	'panel'			=> 'poster_panel_advance'
    	)
    );
    
	$wp_customize->add_setting(
	'poster_footer_text',
	array(
		'default'		=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
		)
	);
	
	$wp_customize->add_control(	 
	       'poster_footer_text',
	        array(
	            'section' => 'poster_custom_footer',
	            'settings' => 'poster_footer_text',
	            'type' => 'text'
	        )
	);
	
/**************************************************
* Social
***************************************************/
	// Social Icons
	$wp_customize->add_section('poster_social_section', array(
			'title' => __('Social Icons','poster'),
			'priority' => 44 ,
				'panel'	=> 'poster_panel_advance'
	));
	
	$social_networks = array( //Redefinied in Sanitization Function.
					'none' => __('-','poster'),
					'facebook-square' => __('Facebook','poster'),
					'twitter-square' => __('Twitter','poster'),
					'google-plus-square' => __('Google Plus','poster'),
					'instagram' => __('Instagram','poster'),
					'rss' => __('RSS Feeds','poster'),
					'vine' => __('Vine','poster'),
					'vimeo-square' => __('Vimeo','poster'),
					'youtube-square' => __('Youtube','poster'),
					'flickr' => __('Flickr','poster'),
				);
				
	$social_count = count($social_networks);
				
	for ($x = 1 ; $x <= ($social_count - 3) ; $x++) :
			
		$wp_customize->add_setting(
			'poster_social_'.$x, array(
				'sanitize_callback' => 'poster_sanitize_social',
				'default' => 'none'
			));

		$wp_customize->add_control( 'poster_social_'.$x, array(
					'settings' => 'poster_social_'.$x,
					'label' => __('Icon ','poster').$x,
					'section' => 'poster_social_section',
					'type' => 'select',
					'choices' => $social_networks,			
		));
		
		$wp_customize->add_setting(
			'poster_social_url'.$x, array(
				'sanitize_callback' => 'esc_url_raw'
			));

		$wp_customize->add_control( 'poster_social_url'.$x, array(
					'settings' => 'poster_social_url'.$x,
					'description' => __('Icon ','poster').$x.__(' Url','poster'),
					'section' => 'poster_social_section',
					'type' => 'url',
					'choices' => $social_networks,			
		));
		
	endfor;
	
	function poster_sanitize_social( $input ) {
		$social_networks = array(
					'none' ,
					'facebook-square',
					'twitter-square',
					'google-plus-square',
					'instagram',
					'rss',
					'vine',
					'vimeo-square',
					'youtube-square',
					'flickr'
				);
		if ( in_array($input, $social_networks) )
			return $input;
		else
			return '';	
	}	
	
	
/**************************************************
* Control
***************************************************/

	$wp_customize->add_control('radio_menu',
    array(
        'type' => 'radio',
        'label' => __('Top Navigation Position','poster'),
		'settings'   => 'radio_menu',
        'section' => 'top_navi_colorbg',
        'choices' => array(
            'fixed' => __('Float','poster'),
            'relative' => __('Fixed','poster'),
        ) ));		
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topnavbgcolor', array(
	'label'        => __( 'Top Navigation Color', 'poster' ),
	'section'    => 'top_navi_colorbg',
	'settings'   => 'topnavbgcolor',
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topnavbgcolorsub', array(
	'label'        => __( 'Sub Menu Color', 'poster' ),
	'section'    => 'top_navi_colorbg',
	'settings'   => 'topnavbgcolorsub',
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topnavbgcolorfont', array(
	'label'        => __( 'Top Menu Font Color', 'poster' ),
	'section'    => 'top_navi_colorbg',
	'settings'   => 'topnavbgcolorfont',
	) ) );
$wp_customize->add_control('search_setting',
    array(
        'type' => 'radio',
        'label' => __('Search Bar','poster'),
		'settings'   => 'search_setting',
        'section' => 'top_navi_colorbg',
        'choices' => array(
            'show' => __('Show','poster'),
            'hide' => __('Hide','poster'),
        ) ));
		

/**************************************************
* Customizer Panels
***************************************************/	
	$wp_customize->add_panel('poster_panel_design',
		array(
			'priority' 			=> 12,
			'capability' 		=> 'edit_theme_options',
			'theme_supports'	=> '',
			'title' 			=> __( 'Color, Design', 'poster' ),
			'description' 		=> __( 'Configure color and layout settings for the poster Theme', 'poster' ),
		)
	);
	$wp_customize->add_panel('poster_panel_advance',
		array(
			'priority' 			=> 13,
			'capability' 		=> 'edit_theme_options',
			'theme_supports'	=> '',
			'title' 			=> __( 'Advance Settings', 'poster' ),
			'description' 		=> __( 'Advance Settings related to footer copyright and Enable options', 'poster' ),
		)
	);
		
	$wp_customize->add_section( 'profile_panel_featured' , array(
	'title'      => __( 'Featured Posts', 'poster' ),
	'description' 		=> __( 'Top Header featured posts section, Select Category for featured post to display', 'poster' ),
	'priority'   => 9,
	) );  

$wp_customize->add_setting('poster_featured_section',	
	array(
		'default'			=> 'enable',
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'poster_sanitize_select'
	));
$wp_customize->add_control('poster_featured_section',
                         array (                             
							'type' => 'radio',
							'label' => __('Enable or Disable Featured Section','poster'),
							'settings'   => 'poster_featured_section',
							'section' => 'profile_panel_featured',
							'choices' => array(
							'enable' => __('Enable','poster'),
							'disable' => __('Disable','poster'),
                         )
						 ));	
	$wp_customize->add_setting( 'profile_featuredcate', array(
	'default' => 1,
	'sanitize_callback' => 'absint'
	) );

	$wp_customize->add_control( 'profile_featurecat_control', array(
	'settings' => 'profile_featuredcate',
	'label' => __('Select Category','poster'),
	'type' => 'select',
	'choices' => $cats,
	'section' => 'profile_panel_featured',  // depending on where you want it to be
	) );


	$wp_customize->add_section( 'profile_panel_tabs' , array(
    'title'      => __( 'Info Post Listing', 'poster' ),
	'description' 		=> __( 'This Setting allow you to display post label on thumbnail, Must be in Sub category eg : Language -> English, French, Spanish </br> Year -> 2015, 2016 etc..  ', 'poster' ),
    'priority'   => 8,
) );   

	$wp_customize->add_setting('topcateid_hide',
    array(
        'default'			=> 'show',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'poster_sanitize_select'
    ));
$wp_customize->add_control('topcateid_hide',
    array(
        'type' => 'radio',
    'label' => __('Top Parent Category Select','poster'),
		'settings'   => 'topcateid_hide',
        'section' => 'profile_panel_tabs',
        'choices' => array(
            'show' => __('Show','poster'),
            'hide' => __('Hide','poster'),
        ) ));	
$wp_customize->add_setting( 'topcateid', array(
    'default' => 1,
    'sanitize_callback' => 'absint'
) );
 
$wp_customize->add_control( 'cat_contlr_top', array(
    'settings' => 'topcateid',
    'type' => 'select',
    'choices' => $cats,
    'section' => 'profile_panel_tabs',  // depending on where you want it to be
) );
$wp_customize->add_setting('leftcateid_hide',
    array(
			'default'			=> 'show',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'poster_sanitize_select'
    ));
$wp_customize->add_control('leftcateid_hide',
    array(
        'type' => 'radio',
        'label' => __('Left Parent Category Select','poster'),
		'settings'   => 'leftcateid_hide',
        'section' => 'profile_panel_tabs',
        'choices' => array(
            'show' => __('Show','poster'),
            'hide' => __('Hide','poster'),
        ) ));
$wp_customize->add_setting( 'leftcateid', array(
    'default' => 1,
    'sanitize_callback' => 'absint'
) );
 
$wp_customize->add_control( 'cat_contlr_left', array(
    'settings' => 'leftcateid',
    'type' => 'select',
    'choices' => $cats,
    'section' => 'profile_panel_tabs',  // depending on where you want it to be
) );
$wp_customize->add_setting('rightcateid_hide',
    array(
        'default'			=> 'show',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'poster_sanitize_select'
    ));
$wp_customize->add_control('rightcateid_hide',
    array(
        'type' => 'radio',
		'label' => __('Right Parent Category Select','poster'),
		'settings'   => 'rightcateid_hide',
        'section' => 'profile_panel_tabs',
        'choices' => array(
            'show' => __('Show','poster'),
            'hide' => __('Hide','poster'),
        ) ));
$wp_customize->add_setting( 'rightcateid', array(
    'default' => 1,
    'sanitize_callback' => 'absint'
) );
 
$wp_customize->add_control( 'cat_contlr_right', array(
    'settings' => 'rightcateid',
    'type' => 'select',
    'choices' => $cats,
    'section' => 'profile_panel_tabs',  // depending on where you want it to be
) );
}
add_action( 'customize_register', 'poster_customize_register' );




/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function poster_customize_preview_js() {
	wp_enqueue_script( 'poster_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'poster_customize_preview_js' );

/************************************
 * sanitization callback.
 ***********************************/
function poster_sanitize_css( $css ) {
	return wp_strip_all_tags( $css );
}
function poster_sanitize_hex_color( $hex_color, $setting ) {
	// Sanitize $input as a hex value without the hash prefix.
	$hex_color = sanitize_hex_color( $hex_color );
	
	// If $input is a valid hex value, return it; otherwise, return the default.
	return ( ! null( $hex_color ) ? $hex_color : $setting->default );
}
function poster_sanitize_select( $input, $setting ) {
	
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
function poster_sanitize_gfont( $input ) {
		if ( in_array($input, array('Helvetica Neue','Helvetica','Raleway','Khula','Open Sans','Indie Flower','Droid Sans','Droid Serif','Roboto','Roboto Condensed','Lato','Bree Serif','Oswald','Slabo','Lora','Source Sans Pro','PT Sans','Ubuntu','Lobster','Arimo','Bitter','Noto Sans','Fjalla One','PT Sans Narrow','Poiret One','Passion One','Arvo','Inconsolata','Shadows Into Light','Pacifico','Dancing Script','Architects Daughter','Sigmar One','Righteous','Amatic SC','Orbitron','Chewy','Lobster Two','Gloria Hallelujah','Lekton','Almendra Display','Swanky and Moo Moo','Hanalei Fill','Uncial Antiqua','Rouge Script','Engagement','Bonbon','Caesar Dressing','Kenia','Lemon','Stardos Stencil','Bilbo','Macondo','Delius Unicase','Butcherman','Monoton','Nosifer','Codystar','Fontdiner Swanky','Diplomata SC','Snowburst One','Faster One','Rock Salt','Eater') ) )
			return $input;
		else
			return '';	
	}