<?php
function revive_customize_register_header( $wp_customize ) {
    $wp_customize->add_panel('revive_header_panel', array(
        'priority' => 20,
        'title' => __('Header Settings','revive')
    ));

    $wp_customize->get_section('header_image')->panel = 'revive_header_panel';
    $wp_customize->get_section('title_tagline')->panel = 'revive_header_panel';

//Logo Settings
$wp_customize->add_setting( 'revive_logo' , array(
    'default'     => '',
    'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'revive_logo',
        array(
            'label' => __('Upload Logo','revive'),
            'section' => 'title_tagline',
            'settings' => 'revive_logo',
            'priority' => 5,
        )
    )
);

$wp_customize->add_setting( 'revive_logo_resize' , array(
    'default'     => 100,
    'sanitize_callback' => 'revive_sanitize_positive_number',
) );
$wp_customize->add_control(
    'revive_logo_resize',
    array(
        'label' => __('Resize & Adjust Logo','revive'),
        'section' => 'title_tagline',
        'settings' => 'revive_logo_resize',
        'priority' => 6,
        'type' => 'range',
        'active_callback' => 'revive_logo_enabled',
        'input_attrs' => array(
            'min'   => 100,
            'max'   => 350,
            'step'  => 5,
        ),
    )
);

function revive_logo_enabled($control) {
    $option = $control->manager->get_setting('revive_logo');
    return $option->value() == true;
}



//Settings for Nav Area
$wp_customize->add_setting( 'revive_disable_active_nav' , array(
    'default'     => true,
    'sanitize_callback' => 'revive_sanitize_checkbox',
) );

$wp_customize->add_control(
    'revive_disable_active_nav', array(
    'label' => __('Disable Highlighting of Current Active Item on the Menu.','revive'),
    'section' => 'nav',
    'settings' => 'revive_disable_active_nav',
    'type' => 'checkbox'
) );

//Settings for Header Image
$wp_customize->add_setting( 'revive_himg_style' , array(
    'default'     => true,
    'sanitize_callback' => 'revive_sanitize_himg_style'
) );

/* Sanitization Function */
function revive_sanitize_himg_style( $input ) {
    if (in_array( $input, array('contain','cover') ) )
        return $input;
    else
        return '';
}

$wp_customize->add_control(
    'revive_himg_style', array(
    'label' => __('Header Image Arrangement','revive'),
    'section' => 'header_image',
    'settings' => 'revive_himg_style',
    'type' => 'select',
    'choices' => array(
        'contain' => __('Contain','revive'),
        'cover' => __('Cover Completely','revive'),
    )
) );

$wp_customize->add_setting( 'revive_himg_align' , array(
    'default'     => true,
    'sanitize_callback' => 'revive_sanitize_himg_align'
) );

/* Sanitization Function */
function revive_sanitize_himg_align( $input ) {
    if (in_array( $input, array('center','left','right') ) )
        return $input;
    else
        return '';
}

$wp_customize->add_control(
    'revive_himg_align', array(
    'label' => __('Header Image Alignment','revive'),
    'section' => 'header_image',
    'settings' => 'revive_himg_align',
    'type' => 'select',
    'choices' => array(
        'center' => __('Center','revive'),
        'left' => __('Left','revive'),
        'right' => __('Right','revive'),
    )

) );

$wp_customize->add_setting( 'revive_himg_repeat' , array(
    'default'     => true,
    'sanitize_callback' => 'revive_sanitize_checkbox'
) );

$wp_customize->add_control(
    'revive_himg_repeat', array(
    'label' => __('Repeat Header Image','revive'),
    'section' => 'header_image',
    'settings' => 'revive_himg_repeat',
    'type' => 'checkbox',
) );


//Settings For Logo Area

$wp_customize->add_setting(
    'revive_hide_title_tagline',
    array(
        'sanitize_callback' => 'revive_sanitize_checkbox',
        'transport'     => 'postMessage',
    )
);

$wp_customize->add_control(
    'revive_hide_title_tagline', array(
        'settings' => 'revive_hide_title_tagline',
        'label'    => __( 'Hide Title and Tagline.', 'revive' ),
        'section'  => 'title_tagline',
        'type'     => 'checkbox',
    )
);

$wp_customize->add_setting(
    'revive_branding_below_logo',
    array(
        'sanitize_callback' => 'revive_sanitize_checkbox',
        'transport'     => 'postMessage'
    )
);

$wp_customize->add_control(
    'revive_branding_below_logo', array(
        'settings' => 'revive_branding_below_logo',
        'label'    => __( 'Display Title and Tagline Below Logo.', 'revive' ),
        'description'	=> __('NOTE: Irrespective of the settings, Site Title will display below the logo for mobile screens for large logo sizes', 'revive'),
        'section'  => 'title_tagline',
        'type'     => 'checkbox',
        'active_callback' => 'revive_title_visible'
    )
);

function revive_title_visible( $control ) {
    $option = $control->manager->get_setting('revive_hide_title_tagline');
    return $option->value() == false ;
}

$wp_customize->add_setting(
    'revive_center_logo',
    array(
        'sanitize_callback' => 'revive_sanitize_checkbox',
        'default' => true,
        'transport'     => 'postMessage',
    )
);

$wp_customize->add_control(
    'revive_center_logo', array(
        'settings' => 'revive_center_logo',
        'label'    => __( 'Center Align.', 'revive' ),
        'section'  => 'title_tagline',
        'type'     => 'checkbox',
    )
);
}
add_action( 'customize_register', 'revive_customize_register_header' );
