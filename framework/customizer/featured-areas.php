<?php
function revive_customize_register_fp_areas( $wp_customize ){
//FEATURED AREA 1
$wp_customize->add_section(
    'revive_fc_boxes',
    array(
        'title'     => __('Featured Area 1','revive'),
        'priority'  => 10,
        'panel'     => 'revive_fca_panel'
    )
);

$wp_customize->add_setting(
    'revive_box_enable',
    array(
        'sanitize_callback' => 'revive_sanitize_checkbox',
        'transport'     => 'postMessage',
    )
);

$wp_customize->add_control(
    'revive_box_enable', array(
        'settings' => 'revive_box_enable',
        'label'    => __( 'Enable Featured Area 1 on Front Page.', 'revive' ),
        'section'  => 'revive_fc_boxes',
        'type'     => 'checkbox',
    )
);


$wp_customize->add_setting(
    'revive_box_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'     => 'postMessage',
    )
);

$wp_customize->add_control(
    'revive_box_title', array(
        'settings' => 'revive_box_title',
        'label'    => __( 'Title for the Boxes','revive' ),
        'section'  => 'revive_fc_boxes',
        'type'     => 'text',
    )
);

$wp_customize->add_setting(
    'revive_box_cat',
    array( 'sanitize_callback' => 'revive_sanitize_category' )
);

$wp_customize->add_control(
    new Revive_WP_Customize_Category_Control(
        $wp_customize,
        'revive_box_cat',
        array(
            'label'    => __('Category For Square Boxes.','revive'),
            'settings' => 'revive_box_cat',
            'section'  => 'revive_fc_boxes'
        )
    )
);

//FEATURED AREA 2
$wp_customize->add_section(
    'revive_fc_fa2',
    array(
        'title'     => __('Featured Area 2','revive'),
        'priority'  => 10,
        'panel'     => 'revive_fca_panel'
    )
);

$wp_customize->add_setting(
    'revive_fa2_enable',
    array(
        'sanitize_callback' => 'revive_sanitize_checkbox',
        'transport'     => 'postMessage',
    )
);

$wp_customize->add_control(
    'revive_fa2_enable', array(
        'settings' => 'revive_fa2_enable',
        'label'    => __( 'Enable Featured Area 2 on Front Page.', 'revive' ),
        'section'  => 'revive_fc_fa2',
        'type'     => 'checkbox',
    )
);


$wp_customize->add_setting(
    'revive_fa2_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'     => 'postMessage'
    )
);

$wp_customize->add_control(
    'revive_fa2_title', array(
        'settings' => 'revive_fa2_title',
        'label'    => __( 'Title for the Featured Area 2','revive' ),
        'section'  => 'revive_fc_fa2',
        'type'     => 'text',
    )
);

$wp_customize->add_setting(
    'revive_fa2_cat',
    array(
        'sanitize_callback' => 'revive_sanitize_category',
    )
);

$wp_customize->add_control(
    new Revive_WP_Customize_Category_Control(
        $wp_customize,
        'revive_fa2_cat',
        array(
            'label'    => __('Category For Featured Area 2.','revive'),
            'settings' => 'revive_fa2_cat',
            'section'  => 'revive_fc_fa2'
        )
    )
);

//Featured Posts Slider
    $wp_customize->add_section(
        'revive_fposts_slider_sec',
        array(
            'title'     => __('Featured Posts Slider','revive'),
            'description'	=> __('<i>Selected number of Latest Posts are displayed in the Slider with Featured Image as Slide</i>', 'revive'),
            'priority'  => 10,
            'panel'     => 'revive_fca_panel'
        )
    );

    $wp_customize->add_setting(
        'revive_fposts_slider_enable',
        array(
            'sanitize_callback' => 'revive_sanitize_checkbox',
            'transport'     => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'revive_fposts_slider_enable', array(
            'settings' => 'revive_fposts_slider_enable',
            'label'    => __( 'Enable Featured Posts Slider.', 'revive' ),
            'section'  => 'revive_fposts_slider_sec',
            'type'     => 'checkbox',
        )
    );

    $wp_customize->add_setting(
        'revive_posts_slider_count',
        array(
            'default' => '0',
            'sanitize_callback' => 'revive_sanitize_positive_number'
        )
    );

// Select How Many Slides the User wants, and Reload the Page.
    $wp_customize->add_control(
        'revive_posts_slider_count', array(
            'settings' => 'revive_posts_slider_count',
            'label'    => __( 'No. of Posts(Min:0, Max: 3)' ,'revive'),
            'section'  => 'revive_fposts_slider_sec',
            'type'     => 'number',
        )
    );

    $wp_customize->add_setting(
        'revive_posts_slider_title',
        array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'     => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'revive_posts_slider_title', array(
            'settings' => 'revive_posts_slider_title',
            'label'    => __( 'Title for the Featured Posts Slider','revive' ),
            'section'  => 'revive_fposts_slider_sec',
            'type'     => 'text',
        )
    );

    //Featured Mega Post
    $wp_customize->add_section(
        'revive_fm_post',
        array(
            'title'     => __('Featured Mega Post','revive'),
            'priority'  => 10,
            'panel'     => 'revive_fca_panel'
        )
    );

    $wp_customize->add_setting(
        'revive_fm_post_enable',
        array(
            'sanitize_callback' => 'revive_sanitize_checkbox',
            'transport'     => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'revive_fm_post_enable', array(
            'settings' => 'revive_fm_post_enable',
            'label'    => __( 'Enable Featured Mega Post.', 'revive' ),
            'section'  => 'revive_fm_post',
            'type'     => 'checkbox',
        )
    );


    $wp_customize->add_setting(
        'revive_fm_post_title',
        array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'     => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'revive_fm_post_title', array(
            'settings' => 'revive_fm_post_title',
            'label'    => __( 'Title for the mega Post','revive' ),
            'section'  => 'revive_fm_post',
            'type'     => 'text',
        )
    );

    $wp_customize->add_setting(
        'revive_fm_post_cat',
        array( 'sanitize_callback' => 'sanitize_text_field' )
    );

    $wp_customize->add_control(
        new Revive_Posts_Live_Search_Control(
            $wp_customize,
            'revive_fm_post_cat',
            array(
                'label'    => __('Select the Post','revive'),
                'description'	=> __('Enter the Post Title in the Text Field below', 'revive'),
                'settings' => 'revive_fm_post_cat',
                'section'  => 'revive_fm_post'
            )
        )
    );
}
add_action( 'customize_register', 'revive_customize_register_fp_areas' );
