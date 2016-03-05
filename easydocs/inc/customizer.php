<?php
/**
 * easydocs Theme Customizer.
 *
 * @package easydocs
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function easydocs_customize_register( $wp_customize ) {

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
	$skins = easydocs_get_all_skins();
	$wp_customize->add_section(
		'skin_select',
		array(
			'title' => __('Skin Selection', 'easydocs'),
			'description' => __('Select a different skin to style your site. After changing the skin, please click the Save & Publish button then reload the page to make sure you get the correct options within the customizer.', 'easydocs'),
			'priority' => 0
		)
	);
	$wp_customize->add_setting(
		'skin',
		array(
			'default' => "default",
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control(
		'skin',
		array(
			'label' => __('Available Skins', 'easydocs'),
			'section' => 'skin_select',
			'type' => 'radio',
			'choices' => $skins,
			'priority' => 10
		)
	);
	
	
	
	/** Home Page Section **/
	$wp_customize->add_section(
		'home_page',
		array(
		  'title' => __('Home Page', 'easydocs'),
		  'description' => __('Customize the home page. Note that not all settings may be available for all skins.', 'easydocs'),
		  'priority' => 30,
		)
	);
	$wp_customize->add_setting(
		'browse_title',
		array(
			'default' => __("Browse Help Content", 'easydocs'),
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control(
		'browse_title',
		array(
			'label' => __('Browse Content Title', 'easydocs'),
			'description' => __('Set the title for your content.', 'easydocs'),
			'section' => 'home_page',
			'type' => 'text',
			'priority' => 10
		)
	);
	
	/** Main Color Section **/
	$wp_customize->add_section(
		'custom_colors',
		array(
		  'title' => __('Colors', 'easydocs'),
		  'description' => __('Set the colors of the theme. Note that not all settings may be available for all skins.', 'easydocs'),
		  'priority' => 25,
		)
	);
	$wp_customize->add_setting(
		'main_color',
		array(
			'default' => "#20a332",
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'main_color', 
		array(
			'label'      => __('Main Accent Color', 'easydocs'),
			'section'    => 'custom_colors',
			'settings'   => 'main_color',
			'priority'=>10
		) ) 
	);
	$wp_customize->add_setting(
		'search_header_text_color',
		array(
			'default' => "#ffffff",
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'search_header_text_color', 
		array(
			'label'      => __('Search Header Text Color', 'easydocs'),
			'section'    => 'custom_colors',
			'settings'   => 'search_header_text_color',
			'priority'   => 20
		) ) 
	);
	$wp_customize->add_setting(
		'footer_background_color',
		array(
			'default' => "#000000",
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'footer_background_color', 
		array(
			'label'      => __('Footer Background Color', 'easydocs'),
			'section'    => 'custom_colors',
			'settings'   => 'footer_background_color',
			'priority'   => 30
		) ) 
	);
	$wp_customize->add_setting(
		'footer_text_color',
		array(
			'default' => "#808080",
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'footer_text_color', 
		array(
			'label'      => __('Footer Text Color', 'easydocs'),
			'section'    => 'custom_colors',
			'settings'   => 'footer_text_color',
			'priority'   => 40
		) ) 
	);
	
	/** Search Info Section **/
	$wp_customize->add_section(
		'search_info',
		array(
		  'title' => __('Search Info', 'easydocs'),
		  'description' => __('Customization for the Search Header and Text. Note that not all settings may be available for all skins.', 'easydocs'),
		  'priority' => 40,
		)
	);
	$wp_customize->add_setting(
		'search_placeholder',
		array(
		  'default' => __('Have a question? Ask or enter a search term.', 'easydocs'),
		  'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control(
		'search_placeholder',
		array(
			'label'=>__('Search Placeholder', 'easydocs'),
			'description'=>__('Set the placeholder for the search bar.', 'easydocs'),
			'section'=>'search_info',
			'type'=>'text',
			'priority'=>10
		)
	);
	$wp_customize->add_setting(
		'search_header',
		array(
		  'default' => __('How can we help?', 'easydocs'),
		  'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control(
		'search_header',
		array(
			'label'=>__('Search Header', 'easydocs'),
			'description'=>__('Set the Title for the Search Header on the main page.', 'easydocs'),
			'section'=>'search_info',
			'type'=>'text',
			'priority'=>20
		)
	);
	$wp_customize->add_setting(
		'search_header_text',
		array(
		  'default' => '',
		  'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control(
		new Example_Customize_Textarea_Control( $wp_customize, 'search_header_text', array(
		    'label'   => __('Search Header Text', 'easydocs'),
		    'description' => __('Set the description text for the search header on the main page.', 'easydocs'),
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
		  'title' => __('TOC Info', 'easydocs'),
		  'description' => __('Customization for the Table of Contents. Note that not all settings may be available for all skins.', 'easydocs'),
		  'priority' => 50,
		)
	);
	$wp_customize->add_setting(
		'toc_title',
		array(
		  'default' => __('TOC', 'easydocs'),
		  'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control(
		'toc_title',
		array(
			'label'=>__('Title', 'easydocs'),
			'description'=>__('Set the Title for the TOC', 'easydocs'),
			'section'=>'toc_info',
			'type'=>'text',
			'priority'=>10
		)
	);
	/*$wp_customize->add_setting(
		'child_pages_title',
		array(
		  'default' => 'Child Pages',
		  'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control(
		'child_pages_title',
		array(
			'label'=>__( 'Child Pages Title' , 'easydocs'),
			'description'=>__( 'Set the Title for the child pages listed within the content' , 'easydocs'),
			'section'=>'toc_info',
			'type'=>'text'
		)
	);*/
	
	
	/** Footer Content **/
	$wp_customize->add_section(
		'footer_info',
		array(
		  'title' => __('Footer Info', 'easydocs'),
		  'description' => __('Set the content for your footer. Note that not all settings may be available for all skins.', 'easydocs'),
		  'priority' => 60,
		)
	);
	$wp_customize->add_setting(
		'footer_html',
		array(
		  'default' => __('Copyright 2016', 'easydocs'),
		  'sanitize_callback' => 'strip_tags'
		)
	);
	$wp_customize->add_control(
		new Example_Customize_Textarea_Control( $wp_customize, 'textarea_setting', array(
		    'label'   => __('Contact Info', 'easydocs'),
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
		  'sanitize_callback' => 'esc_url'
		)
	);
	$wp_customize->add_control(
		'facebook_link',
		array(
			'label'=>__('Facebook', 'easydocs'),
			'description'=>__('Set the URL to navigate to when the user clicks on the Facebook icon (if shown)', 'easydocs'),
			'section'=>'footer_info',
			'type'=>'text',
			'priority'=>20
		)
	);
	$wp_customize->add_setting(
		'facebook_enabled',
		array(
			'default' => 1,
			'sanitize_callback' => 'easydocs_is_boolean'
		)
	);
	$wp_customize->add_control(
		'facebook_enabled',
		array(
			'label'=>__('Display link to Facebook?', 'easydocs'),
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
		  'sanitize_callback' => 'esc_url'
		)
	);
	$wp_customize->add_control(
		'twitter_link',
		array(
			'label'=>__('Twitter', 'easydocs'),
			'description'=>__('Set the URL to navigate to when the user clicks on the Twitter icon (if shown)', 'easydocs'),
			'section'=>'footer_info',
			'type'=>'text',
			'priority'=>30
		)
	);
	$wp_customize->add_setting(
		'twitter_enabled',
		array(
			'default' => 1,
			'sanitize_callback' => 'easydocs_is_boolean'
		)
		
	);
	$wp_customize->add_control(
		'twitter_enabled',
		array(
			'label'=>__('Display link to Twitter?', 'easydocs'),
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
		  'sanitize_callback' => 'esc_url'
		)
	);
	$wp_customize->add_control(
		'google_link',
		array(
			'label'=>__('Google+', 'easydocs'),
			'description'=>__('Set the URL to navigate to when the user clicks on the Google+ icon (if shown)', 'easydocs'),
			'section'=>'footer_info',
			'type'=>'text',
			'priority'=>40
		)
	);
	$wp_customize->add_setting(
		'google_enabled',
		array(
			'default' => 1,
			'sanitize_callback' => 'easydocs_is_boolean'
		)
	);
	$wp_customize->add_control(
		'google_enabled',
		array(
			'label'=>__('Display link to Google+?', 'easydocs'),
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
		  'sanitize_callback' => 'esc_url'
		)
	);
	$wp_customize->add_control(
		'linkedin_link',
		array(
			'label'=>__('LinkedIn', 'easydocs'),
			'description'=>__('Set the URL to navigate to when the user clicks on the LinkedIn icon (if shown)', 'easydocs'),
			'section'=>'footer_info',
			'type'=>'text',
			'priority'=>50
		)
	);
	$wp_customize->add_setting(
		'linkedin_enabled',
		array(
			'default' => 1,
			'sanitize_callback' => 'easydocs_is_boolean'
		)
	);
	$wp_customize->add_control(
		'linkedin_enabled',
		array(
			'label'=>__('Display link to LinkedIn?', 'easydocs'),
			'section'=>'footer_info',
			'type'=>'checkbox',
			'priority'=>55
		)
	);
	
	/** 404 Page Info **/
	$wp_customize->add_section(
		'404_page',
		array(
		  'title' => __('404 Page Text', 'easydocs'),
		  'description' => __('Customization for the text shown on the 404 error page not found page.', 'easydocs'),
		  'priority' => 70,
		)
	);
	$wp_customize->add_setting(
		'404_header',
		array(
		  'default' => __("Oops! That page can't be found.", 'easydocs'),
		  'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control(
		'404_header',
		array(
			'label'=>__('Header Text', 'easydocs'),
			'description'=>__('Set the text for the header of the 404 page.', 'easydocs'),
			'section'=>'404_page',
			'type'=>'text',
			'priority'=>10
		)
	);
	$wp_customize->add_setting(
		'404_text',
		array(
		  'default' => __("It looks like nothing was found at this location. Maybe try a search or one of the popular pages below? Or you can always escape back to the home page by clicking the logo in the top left.", 'easydocs'),
		  'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control(
		new Example_Customize_Textarea_Control( $wp_customize, '404_text', array(
		    'label'   => __('Body Text', 'easydocs'),
		    'description' => __('Set the text for the body of the 404 page.', 'easydocs'),
		    'section' => '404_page',
		    'settings'   => '404_text',
			'priority' => 20
			)
		)
	);
}
add_action( 'customize_register', 'easydocs_customize_register' );

/*
 * Sanitization functions
 */
function easydocs_is_boolean($value) {
	if ($value == 0) {
		return 0;
	} else {
		return 1;
	}
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function easydocs_customize_preview_js() {
	wp_enqueue_script( 'easydocs_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'easydocs_customize_preview_js' );

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