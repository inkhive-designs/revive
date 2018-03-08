<?php
//Fonts
function revive_customize_register_fonts( $wp_customize ) {
$wp_customize->add_section(
    'revive_typo_options',
    array(
        'title'     => __('Google Web Fonts','revive'),
        'priority'  => 41,
        'panel'     => 'revive_design_panel'
    )
);

$font_array = array('Lato','Khula','Open Sans','Droid Sans','Droid Serif','Roboto Condensed','Bree Serif','Oswald','Slabo 27px','Lora');
$fonts = array_combine($font_array, $font_array);

$wp_customize->add_setting(
    'revive_title_font',
    array(
        'default'=> 'Bree Serif',
        'sanitize_callback' => 'revive_sanitize_gfont'
    )
);

function revive_sanitize_gfont( $input ) {
    if ( in_array($input, array('Lato','Khula','Open Sans','Droid Sans','Droid Serif','Roboto Condensed','Bree Serif','Oswald','Slabo 27px','Lora') ) )
        return $input;
    else
        return '';
}

$wp_customize->add_control(
    'revive_title_font',array(
        'label' => __('Title','revive'),
        'settings' => 'revive_title_font',
        'section'  => 'revive_typo_options',
        'type' => 'select',
        'choices' => $fonts,
    )
);

$wp_customize->add_setting(
    'revive_body_font',
    array(
        'default'=> 'Slabo 27px',
        'sanitize_callback' => 'revive_sanitize_gfont' )
);

$wp_customize->add_control(
    'revive_body_font',array(
        'label' => __('Body','revive'),
        'settings' => 'revive_body_font',
        'section'  => 'revive_typo_options',
        'type' => 'select',
        'choices' => $fonts
    )
);


    //Page and Post content Font size start
    $wp_customize->add_setting(
        'revive_content_page_post_fontsize_set',
        array(
            'default' => 'default',
            'sanitize_callback' => 'revive_sanitize_content_size'
        )
    );
    function revive_sanitize_content_size( $input ) {
        if ( in_array($input, array('default','small','medium','large','extra-large') ) )
            return $input;
        else
            return '';
    }

    $wp_customize->add_control(
        'revive_content_page_post_fontsize_set', array(
            'settings' => 'revive_content_page_post_fontsize_set',
            'label'    => __( 'Page/Post Font Size','revive' ),
            'description' => __('Choose your font size. This is only for Posts and Pages. It wont affect your blog page.','revive'),
            'section'  => 'revive_typo_options',
            'type'     => 'select',
            'choices' => array(
                'default'   => 'Default',
                'small' => 'Small',
                'medium'   => 'Medium',
                'large'  => 'Large',
                'extra-large' => 'Extra Large',
            ),
        )
    );

    //Page and Post content Font size end


    //site title Font size start
    $wp_customize->add_setting(
        'revive_content_site_title_fontsize_set',
        array(
            'default' => '42',
            'sanitize_callback' => 'absint',
        )
    );

    $wp_customize->add_control(
        'revive_content_site_title_fontsize_set', array(
            'settings' => 'revive_content_site_title_fontsize_set',
            'label'    => __( 'Site Title Font Size','revive' ),
            'description' => __('Choose your font size. This is only for Site Title.','revive'),
            'section'  => 'revive_typo_options',
            'type'     => 'number',
        )
    );
    //site title Font size end

    //site description Font size start
    $wp_customize->add_setting(
        'revive_content_site_desc_fontsize_set',
        array(
            'default' => '15',
            'sanitize_callback' => 'absint',
        )
    );

    $wp_customize->add_control(
        'revive_content_site_desc_fontsize_set', array(
            'settings' => 'revive_content_site_desc_fontsize_set',
            'label'    => __( 'Site Description Font Size','revive' ),
            'description' => __('Choose your font size. This is only for Site Description.','revive'),
            'section'  => 'revive_typo_options',
            'type'     => 'number',
        )
    );
    //site description Font size end
}
add_action( 'customize_register', 'revive_customize_register_fonts' );