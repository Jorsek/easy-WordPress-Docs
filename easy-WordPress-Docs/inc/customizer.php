<?php
/**
 * _s Theme Customizer.
 *
 * @package _s
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function _s_customize_register( $wp_customize ) {

	class Example_Customize_Textarea_Control extends WP_Customize_Control {
	    public $type = 'textarea';
	 
	    public function render_content() {
	        ?>
	        <label>
	        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	        <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
	        <textarea rows="4" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	        </label>
	        <?php
	    }
	}

	/*
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_backgroundcolor' )->transport = 'postMessage';
	*/
	
	// Remove defaults
	$wp_customize->remove_section('colors');
	$wp_customize->remove_section('background_image');
	$wp_customize->remove_section('static_front_page');
	
	/** Skin Selection **/
	$skins = easy_wordpress_docs_get_all_skins();
	$wp_customize->add_section(
		'skin_select',
		array(
			'title' => 'Skin Selection',
			'description' => 'Select a different skin to style your site. After changing the skin, please click the Save & Publish button then reload the page to make sure you get the correct options within the customizer.',
			'priority' => 0
		)
	);
	$wp_customize->add_setting(
		'skin',
		array(
			'default' => "default"
		)
	);
	$wp_customize->add_control(
		'skin',
		array(
			'label'=>__( 'Available Skins' ),
			'section'=>'skin_select',
			'type'=>'radio',
			'choices'=>$skins,
			'priority'=>10
		)
	);
	
	
	
	/** Home Page Section **/
	$wp_customize->add_section(
		'home_page',
		array(
		  'title' => 'Home Page',
		  'description' => 'Customize the home page. Note that not all settings may be available for all skins.',
		  'priority' => 30,
		)
	);
	$wp_customize->add_setting(
		'browse_title',
		array(
			'default' => "Browse Help Content"
		)
	);
	$wp_customize->add_control(
		'browse_title',
		array(
			'label'=>__( 'Browse Content Title' ),
			'description'=>__( 'Set the title for your content.' ),
			'section'=>'home_page',
			'type'=>'text',
			'priority'=>10
		)
	);
	
	/** Main Color Section **/
	$wp_customize->add_section(
		'custom_colors',
		array(
		  'title' => 'Colors',
		  'description' => 'Set the colors of the theme. Note that not all settings may be available for all skins.',
		  'priority' => 25,
		)
	);
	$wp_customize->add_setting(
		'main_color',
		array(
			'default' => "#20a332"
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'main_color', 
		array(
			'label'      => __( 'Main Accent Color', 'easyDocs' ),
			'section'    => 'custom_colors',
			'settings'   => 'main_color',
			'priority'=>10
		) ) 
	);
	$wp_customize->add_setting(
		'search_header_text_color',
		array(
			'default' => "#ffffff"
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'search_header_text_color', 
		array(
			'label'      => __( 'Search Header Text Color', 'easyDocs' ),
			'section'    => 'custom_colors',
			'settings'   => 'search_header_text_color',
			'priority'=>20
		) ) 
	);
	$wp_customize->add_setting(
		'footer_background_color',
		array(
			'default' => "#000000"
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'footer_background_color', 
		array(
			'label'      => __( 'Footer Background Color', 'easyDocs' ),
			'section'    => 'custom_colors',
			'settings'   => 'footer_background_color',
			'priority'=>30
		) ) 
	);
	$wp_customize->add_setting(
		'footer_text_color',
		array(
			'default' => "#808080"
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'footer_text_color', 
		array(
			'label'      => __( 'Footer Text Color', 'easyDocs' ),
			'section'    => 'custom_colors',
			'settings'   => 'footer_text_color',
			'priority'=>40
		) ) 
	);
	
	/** Search Info Section **/
	$wp_customize->add_section(
		'search_info',
		array(
		  'title' => 'Search Info',
		  'description' => 'Customization for the Search Header and Text. Note that not all settings may be available for all skins.',
		  'priority' => 40,
		)
	);
	$wp_customize->add_setting(
		'search_placeholder',
		array(
		  'default' => 'Have a question? Ask or enter a search term.',
		)
	);
	$wp_customize->add_control(
		'search_placeholder',
		array(
			'label'=>__( 'Search Placeholder' ),
			'description'=>__( 'Set the placeholder for the search bar.' ),
			'section'=>'search_info',
			'type'=>'text',
			'priority'=>10
		)
	);
	$wp_customize->add_setting(
		'search_header',
		array(
		  'default' => 'How can we help?',
		)
	);
	$wp_customize->add_control(
		'search_header',
		array(
			'label'=>__( 'Search Header' ),
			'description'=>__( 'Set the Title for the Search Header on the main page.' ),
			'section'=>'search_info',
			'type'=>'text',
			'priority'=>20
		)
	);
	$wp_customize->add_setting(
		'search_header_text',
		array(
		  'default' => '',
		)
	);
	$wp_customize->add_control(
		new Example_Customize_Textarea_Control( $wp_customize, 'search_header_text', array(
		    'label'   => 'Search Header Text',
		    'description' => 'Set the description text for the search header on the main page.',
		    'section' => 'search_info',
		    'settings'   => 'search_header_text',
			'priority'=>30
			)
		)
	);
	
	/** TOC Title **/
	$wp_customize->add_section(
		'toc_info',
		array(
		  'title' => 'TOC Info',
		  'description' => 'Customization for the Table of Contents. Note that not all settings may be available for all skins.',
		  'priority' => 50,
		)
	);
	$wp_customize->add_setting(
		'toc_title',
		array(
		  'default' => 'TOC',
		)
	);
	$wp_customize->add_control(
		'toc_title',
		array(
			'label'=>__( 'Title' ),
			'description'=>__( 'Set the Title for the TOC' ),
			'section'=>'toc_info',
			'type'=>'text',
			'priority'=>10
		)
	);
	/*$wp_customize->add_setting(
		'child_pages_title',
		array(
		  'default' => 'Child Pages',
		)
	);
	$wp_customize->add_control(
		'child_pages_title',
		array(
			'label'=>__( 'Child Pages Title' ),
			'description'=>__( 'Set the Title for the child pages listed within the content' ),
			'section'=>'toc_info',
			'type'=>'text'
		)
	);*/
	
	
	/** Footer Content **/
	$wp_customize->add_section(
		'footer_info',
		array(
		  'title' => 'Footer Info',
		  'description' => 'Set the content for your footer. Note that not all settings may be available for all skins.',
		  'priority' => 60,
		)
	);
	$wp_customize->add_setting(
		'footer_html',
		array(
		  'default' => 'Copyright 2016',
		)
	);
	$wp_customize->add_control(
		new Example_Customize_Textarea_Control( $wp_customize, 'textarea_setting', array(
		    'label'   => 'Contact Info',
		    'section' => 'footer_info',
		    'settings'   => 'footer_html',
			'priority'=>10
			)
		)
	);
	// Facebook
	$wp_customize->add_setting(
		'facebook_link',
		array(
		  'default' => '#',
		)
	);
	$wp_customize->add_control(
		'facebook_link',
		array(
			'label'=>__( 'Facebook' ),
			'description'=>__( 'Set the URL to navigate to when the user clicks on the Facebook icon (if shown)' ),
			'section'=>'footer_info',
			'type'=>'text',
			'priority'=>20
		)
	);
	$wp_customize->add_setting(
		'facebook_enabled'
	);
	$wp_customize->add_control(
		'facebook_enabled',
		array(
			'label'=>__( 'Display link to Facebook?' ),
			'section'=>'footer_info',
			'type'=>'checkbox',
			'priority'=>25
		)
	);
	// Twitter
	$wp_customize->add_setting(
		'twitter_link',
		array(
		  'default' => '#',
		)
	);
	$wp_customize->add_control(
		'twitter_link',
		array(
			'label'=>__( 'Twitter' ),
			'description'=>__( 'Set the URL to navigate to when the user clicks on the Twitter icon (if shown)' ),
			'section'=>'footer_info',
			'type'=>'text',
			'priority'=>30
		)
	);
	$wp_customize->add_setting(
		'twitter_enabled'
	);
	$wp_customize->add_control(
		'twitter_enabled',
		array(
			'label'=>__( 'Display link to Twitter?' ),
			'section'=>'footer_info',
			'type'=>'checkbox',
			'priority'=>35
		)
	);
	// Google Plus
	$wp_customize->add_setting(
		'google_link',
		array(
		  'default' => '#',
		)
	);
	$wp_customize->add_control(
		'google_link',
		array(
			'label'=>__( 'Google+' ),
			'description'=>__( 'Set the URL to navigate to when the user clicks on the Google+ icon (if shown)' ),
			'section'=>'footer_info',
			'type'=>'text',
			'priority'=>40
		)
	);
	$wp_customize->add_setting(
		'google_enabled'
	);
	$wp_customize->add_control(
		'google_enabled',
		array(
			'label'=>__( 'Display link to Google+?' ),
			'section'=>'footer_info',
			'type'=>'checkbox',
			'priority'=>45
		)
	);
	// LinkedIn
	$wp_customize->add_setting(
		'linkedin_link',
		array(
		  'default' => '#',
		)
	);
	$wp_customize->add_control(
		'linkedin_link',
		array(
			'label'=>__( 'LinkedIn' ),
			'description'=>__( 'Set the URL to navigate to when the user clicks on the LinkedIn icon (if shown)' ),
			'section'=>'footer_info',
			'type'=>'text',
			'priority'=>50
		)
	);
	$wp_customize->add_setting(
		'linkedin_enabled'
	);
	$wp_customize->add_control(
		'linkedin_enabled',
		array(
			'label'=>__( 'Display link to LinkedIn?' ),
			'section'=>'footer_info',
			'type'=>'checkbox',
			'priority'=>55
		)
	);
	
	/** 404 Page Info **/
	$wp_customize->add_section(
		'404_page',
		array(
		  'title' => '404 Page Text',
		  'description' => 'Customization for the text shown on the 404 error page not found page.',
		  'priority' => 70,
		)
	);
	$wp_customize->add_setting(
		'404_header',
		array(
		  'default' => "Oops! That page can't be found.",
		)
	);
	$wp_customize->add_control(
		'404_header',
		array(
			'label'=>__( 'Header Text' ),
			'description'=>__( 'Set the text for the header of the 404 page.' ),
			'section'=>'404_page',
			'type'=>'text',
			'priority'=>10
		)
	);
	$wp_customize->add_setting(
		'404_text',
		array(
		  'default' => "It looks like nothing was found at this location. Maybe try a search or one of the popular pages below? Or you can always escape back to the home page by clicking the logo in the top left.",
		)
	);
	$wp_customize->add_control(
		new Example_Customize_Textarea_Control( $wp_customize, '404_text', array(
		    'label'   => __( 'Body Text' ),
		    'description' => __( 'Set the text for the body of the 404 page.' ),
		    'section' => '404_page',
		    'settings'   => '404_text',
			'priority'=>20
			)
		)
	);
}
add_action( 'customize_register', '_s_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function _s_customize_preview_js() {
	wp_enqueue_script( '_s_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', '_s_customize_preview_js' );

/**
 * Generates live CSS
 **/
function build_customize_css()
{
    ?>
         <style type="text/css">
             .widget-container .widget-title,
             .child-page-entry .entry-header a,
             #masthead > div[class*="menu-"] ul.menu li a:hover,
             .site-footer .social i,
             .widget_popular_pages_widget .popular-link,
             .search-result .entry-header a,
             .search-result .entry-url a,
             .faq-title,
             .faq.open .faq-icon:before,
             .topic-section > .topic-title,
             .content-title,
             .toc .parent-item .parent-item > a,
             h1.topic-title,
             .posts-navigation a:hover {
             	color:<?php echo get_theme_mod('main_color', '#20a332'); ?>;
             }
             
             footer.site-footer .social a {
             	border-color:<?php echo get_theme_mod('main_color','#20a332'); ?>;
             }
             
             .home-search,
             .small-search {
             	background-color:<?php echo get_theme_mod('main_color', '#20a332'); ?>;
             }
             
             .home-search {
             	color:<?php echo get_theme_mod('search_header_text_color', '#ffffff'); ?>;
             }
             
             .site-footer, .site-footer .user-text {
             	background-color:<?php echo get_theme_mod('footer_background_color', '#000000'); ?>;
             	color:<?php echo get_theme_mod('footer_text_color', '#808080'); ?>;
             }
             
         </style>
    <?php
}
add_action( 'wp_head', 'build_customize_css');
