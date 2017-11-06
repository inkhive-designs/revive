<?php

// SLIDER PANEL
function revive_customize_register_slider( $wp_customize ) {
$wp_customize->add_panel( 'revive_slider_panel', array(
    'priority'       => 35,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __('Main Slider','revive'),
) );

$wp_customize->add_section(
    'revive_sec_slider_options',
    array(
        'title'     => __('Enable/Disable','revive'),
        'priority'  => 0,
        'panel'     => 'revive_slider_panel'
    )
);


$wp_customize->add_setting(
    'revive_main_slider_enable',
    array( 'sanitize_callback' => 'revive_sanitize_checkbox' )
);

$wp_customize->add_control(
    'revive_main_slider_enable', array(
        'settings' => 'revive_main_slider_enable',
        'label'    => __( 'Enable Slider.', 'revive' ),
        'section'  => 'revive_sec_slider_options',
        'type'     => 'checkbox',
    )
);

$wp_customize->add_setting(
    'revive_main_slider_count',
    array(
        'default' => '0',
        'sanitize_callback' => 'revive_sanitize_positive_number'
    )
);

// Select How Many Slides the User wants, and Reload the Page.
$wp_customize->add_control(
    'revive_main_slider_count', array(
        'settings' => 'revive_main_slider_count',
        'label'    => __( 'No. of Slides(Min:0, Max: 3)' ,'revive'),
        'section'  => 'revive_sec_slider_options',
        'type'     => 'number',
        'description' => __('Save the Settings, and Reload this page to Configure the Slides.','revive'),

    )
);




if ( get_theme_mod('revive_main_slider_count') > 0 ) :
    $slides = get_theme_mod('revive_main_slider_count');

    for ( $i = 1 ; $i <= $slides ; $i++ ) :
        //Create the settings Once, and Loop through it.
        if ($i >= 4) {
            break;
        }
        $wp_customize->add_setting(
            'revive_slide_img'.$i,
            array( 'sanitize_callback' => 'esc_url_raw' )
        );

        $wp_customize->add_control(
            new WP_Customize_Image_Control(
                $wp_customize,
                'revive_slide_img'.$i,
                array(
                    'label' => '',
                    'section' => 'revive_slide_sec'.$i,
                    'settings' => 'revive_slide_img'.$i,
                )
            )
        );


        $wp_customize->add_section(
            'revive_slide_sec'.$i,
            array(
                'title'     => __('Slide ','revive').$i,
                'priority'  => $i,
                'panel'     => 'revive_slider_panel'
            )
        );

        $wp_customize->add_setting(
            'revive_slide_title'.$i,
            array( 'sanitize_callback' => 'sanitize_text_field' )
        );

        $wp_customize->add_control(
            'revive_slide_title'.$i, array(
                'settings' => 'revive_slide_title'.$i,
                'label'    => __( 'Slide Title','revive' ),
                'section'  => 'revive_slide_sec'.$i,
                'type'     => 'text',
            )
        );

        $wp_customize->add_setting(
            'revive_slide_desc'.$i,
            array( 'sanitize_callback' => 'sanitize_text_field' )
        );

        $wp_customize->add_control(
            'revive_slide_desc'.$i, array(
                'settings' => 'revive_slide_desc'.$i,
                'label'    => __( 'Slide Description','revive' ),
                'section'  => 'revive_slide_sec'.$i,
                'type'     => 'text',
            )
        );



        $wp_customize->add_setting(
            'revive_slide_CTA_button'.$i,
            array( 'sanitize_callback' => 'sanitize_text_field' )
        );

        $wp_customize->add_control(
            'revive_slide_CTA_button'.$i, array(
                'settings' => 'revive_slide_CTA_button'.$i,
                'label'    => __( 'Custom Call to Action Button Text(Optional)','revive' ),
                'section'  => 'revive_slide_sec'.$i,
                'type'     => 'text',
            )
        );

        $wp_customize->add_setting(
            'revive_slide_url'.$i,
            array( 'sanitize_callback' => 'esc_url_raw' )
        );

        $wp_customize->add_control(
            'revive_slide_url'.$i, array(
                'settings' => 'revive_slide_url'.$i,
                'label'    => __( 'Target URL','revive' ),
                'section'  => 'revive_slide_sec'.$i,
                'type'     => 'url',
            )
        );

    endfor;


endif;

}
add_action( 'customize_register', 'revive_customize_register_slider' );