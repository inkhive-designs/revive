<?php
function revive_customize_register_static_page($wp_customize) {
	
    //Static Page
    if ( class_exists('WPForms') ) {
	    $wp_customize->add_section('revive_custom_page_section',
	        array(
	            'title' => __('Contact Us', 'revive'),
	            'priority'	=> 45
	        )
	    );
	
	    //Info on how to use this
	    $wp_customize->add_setting(
	        'revive_cpw',
	        array( 'sanitize_callback' => 'esc_textarea' )
	    );
	
	    $wp_customize->add_control(
	        new WP_Customize_Upgrade_Control(
	            $wp_customize,
	            'revive_cpw',
	            array(
	                'label' => __('How to Create a Beautiful Contact us Page?','revive'),
	                'description' => __('To do so, go to your Dashboard - Pages - Add New. <br/> 
		            In the Add New Page, Give the Page a title and add some content to it if you want to. And then Set the template of the page to <strong>Contact Us</strong> from <b>Default Template</b>. <br/><br/>
		            Once you have done so, open the contact us page in your browser and click on Customize from the Admin Bar. Once you are in the Customizer you can Comeback to this section and finish designing your custom page.','revive'),
	                'section' => 'revive_custom_page_section',
	                'settings' => 'revive_cpw',
	            )
	        )
	    );
	}


    //Page Title Enable/Disable
    $wp_customize->add_setting('revive_contact_page_title',
        array(
            'sanitize_callback' => 'revive_sanitize_checkbox'
        ));
    $wp_customize->add_control('revive_contact_page_title',
        array(
            'setting' => 'revive_contact_page_title',
            'section' => 'revive_custom_page_section',
            'label' => __('Disable Page Title', 'revive'),
            'description' => __('Default: Enabled. Check to Disable Page Title.', 'revive'),
            'type' => 'checkbox'
        )
    );

    //From Shortcode
    $wp_customize->add_setting('revive_form_shortcode_set',
        array(
            'sanitize_callback' => 'sanitize_textarea_field'
        )
    );

    $wp_customize->add_control('revive_form_shortcode_set',
        array(
            'setting' => 'revive_form_shortcode_set',
            'section' => 'revive_custom_page_section',
            'label' => __('Shortcode', 'revive'),
            'description' => __('Paste Embed Code/Shortcode here to display form.', 'revive'),
            'type' => 'textarea',
        )
    );

    //Contact Us Details
    $wp_customize->add_setting('revive_select_contact_page',
        array(
            'sanitize_callback' => 'absint'
        )
    );

    $wp_customize->add_control('revive_select_contact_page',
        array(
            'setting' => 'revive_select_contact_page',
            'section' => 'revive_custom_page_section',
            'label' => __('Contact Page', 'revive'),
            'description' => __('Select a Page to display Address Details', 'revive'),
            'type' => 'dropdown-pages',
        )
    );

    //Page Text
    $wp_customize->add_setting('revive_static_selectpage',
        array(
            'sanitize_callback' => 'absint'
        )
    );

    $wp_customize->add_control('revive_static_selectpage',
        array(
            'setting' => 'revive_static_selectpage',
            'section' => 'revive_custom_page_section',
            'label' => __('More Details Box', 'revive'),
            'description' => __('Fetch more details from following page', 'revive'),
            'type' => 'dropdown-pages',
        )
    );

    //Page Button Text
    $wp_customize->add_setting('revive_static_button',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control('revive_static_button',
        array(
            'setting' => 'revive_static_button',
            'section' => 'revive_custom_page_section',
            'label' => __('Button Name', 'revive'),
            'type' => 'text',
        )
    );


    //Map Image
    $wp_customize->add_setting('revive_map_set',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize, 'revive_map_set',
            array (
                'setting' => 'revive_map_set',
                'section' => 'revive_custom_page_section',
                'label' => __('Map Location Image', 'revive'),
                'description' => __('Upload an image to display location in MAP. Image should be 788 X 414', 'revive'),
            )
        )
    );

    //Button Text
    $wp_customize->add_setting('revive_button_text',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control('revive_button_text',
        array(
            'setting' => 'revive_button_text',
            'section' => 'revive_custom_page_section',
            'label' => __('Button ', 'revive'),
            'description' => __('Enter button name', 'revive'),
            'type' => 'text',
        )
    );

    //Button Url
    $wp_customize->add_setting('revive_button_url',
        array(
            'sanitize_callback' => 'esc_url'
        )
    );

    $wp_customize->add_control('revive_button_url',
        array(
            'setting' => 'revive_button_url',
            'section' => 'revive_custom_page_section',
            'label' => __('Button URL', 'revive'),
            'description' => __('Enter button URL with http://', 'revive'),
            'type' => 'url',
        )
    );
}
add_action('customize_register', 'revive_customize_register_static_page');