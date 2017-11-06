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
    array( 'sanitize_callback' => 'revive_sanitize_checkbox' )
);

$wp_customize->add_control(
    'revive_box_enable', array(
        'settings' => 'revive_box_enable',
        'label'    => __( 'Enable Featured Area 1.', 'revive' ),
        'section'  => 'revive_fc_boxes',
        'type'     => 'checkbox',
    )
);


$wp_customize->add_setting(
    'revive_box_title',
    array( 'sanitize_callback' => 'sanitize_text_field' )
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
    array( 'sanitize_callback' => 'revive_sanitize_checkbox' )
);

$wp_customize->add_control(
    'revive_fa2_enable', array(
        'settings' => 'revive_fa2_enable',
        'label'    => __( 'Enable Featured Area 2.', 'revive' ),
        'section'  => 'revive_fc_fa2',
        'type'     => 'checkbox',
    )
);


$wp_customize->add_setting(
    'revive_fa2_title',
    array( 'sanitize_callback' => 'sanitize_text_field' )
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
    array( 'sanitize_callback' => 'revive_sanitize_category' )
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
}
add_action( 'customize_register', 'revive_customize_register_fp_areas' );
