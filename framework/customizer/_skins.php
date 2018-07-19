<?php
//Select the Default Theme Skin
function revive_customize_register_skin( $wp_customize ) {


    $wp_customize->get_section('colors')->panel = "revive_design_panel";
    $wp_customize->get_section('colors')->title = __('Theme Skins & Colors', 'revive');
    $wp_customize->get_section('background_image')->panel = "revive_design_panel";
    $bgcolor_transport = (object)$wp_customize->get_section('background_color');
    $bgcolor_transport->transport = "postMessage";

    //Replace Header Text Color with, separate colors for Title and Description
//Override revive_site_titlecolor
    $wp_customize->remove_control('display_header_text');
    $wp_customize->remove_setting('header_textcolor');
    $wp_customize->add_setting('revive_site_titlecolor', array(
        'default'     => '#FFF',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'     => 'postMessage'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'revive_site_titlecolor', array(
            'label' => __('Site Title Color','revive'),
            'section' => 'colors',
            'settings' => 'revive_site_titlecolor',
            'type' => 'color'
        ) )
    );

    $wp_customize->add_setting('revive_header_desccolor', array(
        'default'     => '#FFF',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'     => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'revive_header_desccolor', array(
            'label' => __('Site Tagline Color','revive'),
            'section' => 'colors',
            'settings' => 'revive_header_desccolor',
            'type' => 'color'
        ) )
    );

    function revive_sanitize_skin( $input ) {
        if ( in_array($input, array('default','orange','green','rosy','purple') ) )
            return $input;
        else
            return '';
    }


    //Skins
    $wp_customize->add_setting(
        'revive_skins',
        array(
            'default'	=> 'default',
            'sanitize_callback' => 'revive_sanitize_skin',
            'transport'	=> 'refresh'
        )
    );

    if(!function_exists('revive_skin_array')){
        function revive_skin_array(){
            return array(
                '#bcd8dd' => 'default',
                '#e48d48' => 'orange',
                '#34c94a' => 'green',
                '#FEA09B' => 'rosy',
                '#D19AD6' => 'purple',
            );
        }
    }

    $revive_skin_array = revive_skin_array();


    $wp_customize->add_control(
        new Revive_Skin_Chooser(
            $wp_customize,
            'revive_skins',
            array(
                'settings'		=> 'revive_skins',
                'section'		=> 'colors',
                'label'			=> __( 'Select Skins', 'revive' ),
                'type'			=> 'skins',
                'choices'		=> $revive_skin_array,
            )
        )
    );

}
add_action( 'customize_register', 'revive_customize_register_skin' );