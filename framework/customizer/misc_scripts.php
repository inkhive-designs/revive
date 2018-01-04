<?php
//upgrade
function revive_customize_register_misc( $wp_customize ) {
$wp_customize->add_section(
    'revive_sec_upgrade',
    array(
        'title'     => __('Discover Revive Pro','revive'),
        'priority'  => 1,
    )
);

$wp_customize->add_setting(
    'revive_upgrade',
    array( 'sanitize_callback' => 'esc_textarea' )
);

$wp_customize->add_control(
    new WP_Customize_Upgrade_Control(
        $wp_customize,
        'revive_upgrade',
        array(
            'label' => __('More of Everything','revive'),
            'description' => __('Revive Pro has more of Everything. More New Features, More Options, Unlimited Slides, More Colors, More Fonts, More Layouts, Configurable Slider, Inbuilt Advertising Options, Multiple Skins, More Widgets, and a lot more options and comes with Dedicated Support. To Know More about the Pro Version, click here: <a href="http://inkhive.com/product/revive-pro/">Upgrade to Pro</a>.','revive'),
            'section' => 'revive_sec_upgrade',
            'settings' => 'revive_upgrade',
        )
    )
);

}
add_action( 'customize_register', 'revive_customize_register_misc' );