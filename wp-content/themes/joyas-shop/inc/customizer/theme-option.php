<?php 

/**
 * Theme Options Panel.
 *
 * @package joyas-shop
 */

$default = joyas_shop_get_default_theme_options();
global $wp_customize;



// Add Theme Options Panel.
$wp_customize->add_panel( 'theme_option_panel',
	array(
		'title'      => esc_html__( 'Theme Options', 'joyas-shop' ),
		'priority'   => 2,
		'capability' => 'edit_theme_options',
	)
);


$wp_customize->add_section( 'topbar_section_settings',
	array(
		'title'      => esc_html__( 'Top Bar', 'joyas-shop' ),
		'priority'   => 10,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

/*Social Profile*/
$wp_customize->add_setting( '__dialogue',
	array(
		'default'           => $default['__dialogue'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( '__dialogue',
	array(
		'label'    => esc_html__( 'Dialogue', 'joyas-shop' ),
		'section'  => 'topbar_section_settings',
		'type'     => 'text',
		
	)
);

/*Social Profile*/
$wp_customize->add_setting( '__fb_pro_link',
	array(
		'default'           => $default['__fb_pro_link'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control( '__fb_pro_link',
	array(
		'label'    => esc_html__( 'Facebook', 'joyas-shop' ),
		'description' => esc_html__( 'Leave empty to hide', 'joyas-shop' ),
		'section'  => 'topbar_section_settings',
		'type'     => 'text',
		
	)
);	



$wp_customize->add_setting( '__tw_pro_link',
	array(
		'default'           => $default['__tw_pro_link'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control( '__tw_pro_link',
	array(
		'label'    => esc_html__( 'Twitter', 'joyas-shop' ),
		'description' => esc_html__( 'Leave empty to hide', 'joyas-shop' ),
		'section'  => 'topbar_section_settings',
		'type'     => 'text',
		
	)
);


$wp_customize->add_setting( '__you_pro_link',
	array(
		'default'           => $default['__you_pro_link'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control( '__you_pro_link',
	array(
		'label'    => esc_html__( 'Youtube', 'joyas-shop' ),
		'description' => esc_html__( 'Leave empty to hide', 'joyas-shop' ),
		'section'  => 'topbar_section_settings',
		'type'     => 'text',
		
	)
);	


// Styling Options.*/

$wp_customize->add_section( 'styling_section_settings',
	array(
		'title'      => esc_html__( 'Styling Options', 'joyas-shop' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

	
/*Posts management section start */
$wp_customize->add_section( 'theme_option_section_settings',
	array(
		'title'      => esc_html__( 'Blog Management', 'joyas-shop' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

		/*Posts Layout*/
		$wp_customize->add_setting( 'blog_layout',
			array(
				'default'           => $default['blog_layout'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'joyas_shop_sanitize_select',
			)
		);
		$wp_customize->add_control( 'blog_layout',
			array(
				'label'    => esc_html__( 'Blog Layout Options', 'joyas-shop' ),
				'description' => esc_html__( 'Choose between different layout options to be used as default', 'joyas-shop' ),
				'section'  => 'theme_option_section_settings',
				'choices'   => array(
					'sidebar-content'  => esc_html__( 'Primary Sidebar - Content', 'joyas-shop' ),
					'content-sidebar' => esc_html__( 'Content - Primary Sidebar', 'joyas-shop' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'joyas-shop' ),
					),
				'type'     => 'select',
				
			)
		);
		
		
		$wp_customize->add_setting( 'single_post_layout',
			array(
				'default'           => $default['single_post_layout'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'joyas_shop_sanitize_select',
			)
		);
		$wp_customize->add_control( 'single_post_layout',
			array(
				'label'    => esc_html__( 'Blog Layout Options', 'joyas-shop' ),
				'description' => esc_html__( 'Choose between different layout options to be used as default', 'joyas-shop' ),
				'section'  => 'theme_option_section_settings',
				'choices'   => array(
					'sidebar-content'  => esc_html__( 'Primary Sidebar - Content', 'joyas-shop' ),
					'content-sidebar' => esc_html__( 'Content - Primary Sidebar', 'joyas-shop' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'joyas-shop' ),
					),
				'type'     => 'select',
				
			)
		);
		
		
		/*Blog Loop Content*/
		$wp_customize->add_setting( 'blog_loop_content_type',
			array(
				'default'           => $default['blog_loop_content_type'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'joyas_shop_sanitize_select',
			)
		);
		$wp_customize->add_control( 'blog_loop_content_type',
			array(
				'label'    => esc_html__( 'Archive Content Type', 'joyas-shop' ),
				'description' => esc_html__( 'Choose Archive, Blog Page Content type as default', 'joyas-shop' ),
				'section'  => 'theme_option_section_settings',
				'choices'               => array(
					'excerpt' => __( 'Excerpt', 'joyas-shop' ),
					'content' => __( 'Content', 'joyas-shop' ),
					),
				'type'     => 'select',
				
			)
		);
		
		/*Social Profile*/
		$wp_customize->add_setting( 'read_more_text',
			array(
				'default'           => $default['read_more_text'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control( 'read_more_text',
			array(
				'label'    => esc_html__( 'Read more text', 'joyas-shop' ),
				'description' => esc_html__( 'Leave empty to hide', 'joyas-shop' ),
				'section'  => 'theme_option_section_settings',
				'type'     => 'text',
				
			)
		);
		
		
		$wp_customize->add_setting( 'blog_meta_hide',
			array(
				'default'           => $default['blog_meta_hide'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'joyas_shop_sanitize_checkbox',
			)
		);
		$wp_customize->add_control( 'blog_meta_hide',
			array(
				'label'    => esc_html__( 'Hide Blog Archive Meta Info?', 'joyas-shop' ),
				'section'  => 'theme_option_section_settings',
				'type'     => 'checkbox',
				
			)
		);
		
		$wp_customize->add_setting( 'signle_meta_hide',
			array(
				'default'           => $default['signle_meta_hide'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'joyas_shop_sanitize_checkbox',
			)
		);
		$wp_customize->add_control( 'signle_meta_hide',
			array(
				'label'    => esc_html__( 'Hide Single post Meta Info ?', 'joyas-shop' ),
				'section'  => 'theme_option_section_settings',
				'type'     => 'checkbox',
				
			)
		);
		
/*Posts management section start */
$wp_customize->add_section( 'page_option_section_settings',
	array(
		'title'      => esc_html__( 'Page Management', 'joyas-shop' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

	
		/*Home Page Layout*/
		$wp_customize->add_setting( 'page_layout',
			array(
				'default'           => $default['blog_layout'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'joyas_shop_sanitize_select',
			)
		);
		$wp_customize->add_control( 'page_layout',
			array(
				'label'    => esc_html__( 'Page Layout Options', 'joyas-shop' ),
				'section'  => 'page_option_section_settings',
				'description' => esc_html__( 'Choose between different layout options to be used as default', 'joyas-shop' ),
				'choices'   => array(
					'sidebar-content'  => esc_html__( 'Primary Sidebar - Content', 'joyas-shop' ),
					'content-sidebar' => esc_html__( 'Content - Primary Sidebar', 'joyas-shop' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'joyas-shop' ),
					),
				'type'     => 'select',
				'priority' => 170,
			)
		);


		// Footer Section.
		$wp_customize->add_section( 'footer_section',
			array(
			'title'      => esc_html__( 'Copyright', 'joyas-shop' ),
			'priority'   => 130,
			'capability' => 'edit_theme_options',
			'panel'      => 'theme_option_panel',
			)
		);
		
		// Setting copyright_text.
		$wp_customize->add_setting( 'copyright_text',
			array(
			'default'           => $default['copyright_text'],
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control( 'copyright_text',
			array(
			'label'    => esc_html__( 'Footer Copyright Text', 'joyas-shop' ),
			'section'  => 'footer_section',
			'type'     => 'textarea',
			'priority' => 120,
			)
		);
		


					
		
		
		
	


		