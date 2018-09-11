<?php
// Social Icons
function revive_customize_register_social( $wp_customize ) {
$wp_customize->add_section('revive_social_section', array(
    'title' => __('Social Icons','revive'),
    'priority' => 44 ,
));

$social_networks = array( //Redefinied in Sanitization Function.
    'none' => __('-','revive'),
    'facebook-f' => __('Facebook','revive'),
    'twitter' => __('Twitter','revive'),
    'google-plus-g' => __('Google Plus','revive'),
    'instagram' => __('Instagram','revive'),
    'vimeo-v' => __('Vimeo','revive'),
    'youtube' => __('Youtube','revive'),
    'flickr' => __('Flickr','revive'),
);

    $wp_customize->add_setting(
        'revive_disable_social_sticky',
        array(
            'sanitize_callback' => 'revive_sanitize_checkbox',
            'transport'     => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'revive_disable_social_sticky', array(
            'settings' => 'revive_disable_social_sticky',
            'label'    => __( 'Enable Sticky Social Icons.','revive' ),
            'section'  => 'revive_social_section',
            'type'     => 'checkbox',
            'default'  => false
        )
    );





//social icons style
    $social_style = array(
        'hvr-ripple-out'  => __('Default', 'revive'),
        'hvr-rectangle-out'   => __('Style 1', 'revive'),
        'hvr-glow'   => __('Style 2', 'revive'),
        'hvr-bounce-in'   => __('Style 3', 'revive'),


    );
    $wp_customize->add_setting(
        'revive_social_icon_style_set', array(
        'sanitize_callback' => 'revive_sanitize_social_style',
        'default' => 'hvr-ripple-out',
        'transport'	=> 'postMessage'
    ));

    function revive_sanitize_social_style( $input ) {
        if ( in_array($input, array('hvr-bounce-in','hvr-ripple-out','hvr-rectangle-out','hvr-glow') ) )
            return $input;
        else
            return '';
    }

    $wp_customize->add_control( 'revive_social_icon_style_set', array(
        'settings' => 'revive_social_icon_style_set',
        'label' => __('Social Icon Style ','revive'),
        'description' => __('You can choose your icon style. Please select a style and hover on the social icons to see.','revive'),
        'section' => 'revive_social_section',
        'type' => 'select',
        'choices' => $social_style,
    ));


$social_count = count($social_networks);

for ($x = 1 ; $x <= ($social_count - 2) ; $x++) :

    $wp_customize->add_setting(
        'revive_social_'.$x, array(
        'sanitize_callback' => 'revive_sanitize_social',
        'default' => 'none',
        'transport'	=> 'postMessage'
    ));

    $wp_customize->add_control( 'revive_social_'.$x, array(
        'settings' => 'revive_social_'.$x,
        'label' => __('Icon ','revive').$x,
        'section' => 'revive_social_section',
        'type' => 'select',
        'choices' => $social_networks,
    ));

    $wp_customize->add_setting(
        'revive_social_url'.$x, array(
        'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control( 'revive_social_url'.$x, array(
        'settings' => 'revive_social_url'.$x,
        'description' => __('Icon ','revive').$x.__(' Url','revive'),
        'section' => 'revive_social_section',
        'type' => 'url',
        'choices' => $social_networks,
    ));

endfor;

function revive_sanitize_social( $input ) {
    $social_networks = array(
        'none' ,
        'facebook-f',
        'twitter',
        'google-plus-g',
        'instagram',
        'vimeo-v',
        'youtube',
        'flickr'
    );
    if ( in_array($input, $social_networks) )
        return $input;
    else
        return '';
}
}
add_action( 'customize_register', 'revive_customize_register_social' );

