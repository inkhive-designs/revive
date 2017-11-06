<?php
//Select the Default Theme Skin
function revive_customize_register_skin( $wp_customize ) {


    $wp_customize->get_section('colors')->panel = "revive_design_panel";
    $wp_customize->get_section('background_image')->panel = "revive_design_panel";
    $wp_customize->get_section('custom_css')->panel = "revive_design_panel";

    $wp_customize->add_section(
        'revive_skin_options',
        array(
            'title'     => __('Choose Skin','revive'),
            'priority'  => 39,
            'panel'     => 'revive_design_panel'
        )
    );

    $wp_customize->add_setting(
        'revive_skin',
        array(
            'default'=> 'default',
            'sanitize_callback' => 'revive_sanitize_skin'
        )
    );

    $skins = array( 'default' => __('Default(blue)','revive'),
        'orange' =>  __('Orange','revive'),
        'green' => __('Green','revive'),
        'rosy' => __('Rosy','revive'),
        'purple' => __('Purple','revive'),
    );

    $wp_customize->add_control(
        'revive_skin',array(
            'settings' => 'revive_skin',
            'section'  => 'revive_skin_options',
            'type' => 'select',
            'choices' => $skins,
        )
    );

    function revive_sanitize_skin( $input ) {
        if ( in_array($input, array('default','orange','green','rosy','purple') ) )
            return $input;
        else
            return '';
    }
}
add_action( 'customize_register', 'revive_customize_register_skin' );