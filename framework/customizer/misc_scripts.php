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
    'revive_important_links',
    array( 'sanitize_callback' => 'esc_textarea' )
);

$wp_customize->add_control(
    new WP_Customize_Upgrade_Control(
        $wp_customize,
        'revive_important_links',
        array(
            'settings'		=> 'revive_important_links',
            'section'		=> 'revive_sec_upgrade',
            'description'	=> '<a class="revive-important-links" href="https://inkhive.com/contact-us/" target="_blank">'.__('InkHive Support Forum', 'revive').'</a>
                                    <a class="revive-important-links" href="https://demo.inkhive.com/revive-plus/" target="_blank">'.__('Revive Live Demo', 'revive').'</a>
                                    <a class="revive-important-links" href="https://www.facebook.com/inkhivethemes/" target="_blank">'.__('We Love Our Facebook Fans', 'revive').'</a>
                                    <a class="revive-important-links" href="https://wordpress.org/support/theme/revive/reviews" target="_blank">'.__('Review Us', 'revive').'</a>'
        )
    )
);

}
add_action( 'customize_register', 'revive_customize_register_misc' );