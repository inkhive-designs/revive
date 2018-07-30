<?php
// Layout and Design
function revive_customize_register_layouts( $wp_customize ) {
$wp_customize->add_panel( 'revive_design_panel', array(
    'priority'       => 40,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __('Design & Layout','revive'),
) );

$wp_customize->add_section(
    'revive_design_options',
    array(
        'title'     => __('Blog Layout','revive'),
        'priority'  => 0,
        'panel'     => 'revive_design_panel'
    )
);


$wp_customize->add_setting(
    'revive_blog_layout',
    array( 
    'default'			=> 'revive',
    'sanitize_callback' => 'revive_sanitize_blog_layout'
    )
);

function revive_sanitize_blog_layout( $input ) {
    if ( in_array($input, array('grid','grid_2_column','grid_3_column','revive') ) )
        return $input;
    else
        return '';
}

$wp_customize->add_control(
    'revive_blog_layout',array(
        'label' => __('Select Layout','revive'),
        'settings' => 'revive_blog_layout',
        'section'  => 'revive_design_options',
        'type' => 'select',
        'choices' => array(
            'grid' => __('Basic Blog Layout','revive'),
            'revive' => __('Revive Default Layout','revive'),
            'grid_2_column' => __('Grid - 2 Column','revive'),
            'grid_3_column' => __('Grid - 3 Column','revive'),
        )
    )
);

$wp_customize->add_section(
    'revive_sidebar_options',
    array(
        'title'     => __('Sidebar Layout','revive'),
        'priority'  => 0,
        'panel'     => 'revive_design_panel'
    )
);


//sidebar style start
    $wp_customize->add_setting(
        'revive_sidebar_style',
        array(
            'default' => 'default',
            'sanitize_callback' => 'revive_sanitize_sidebar_style'
        )
    );

    $wp_customize->add_control(
        'revive_sidebar_style',
        array(
            'setting' => 'revive_sidebar_style',
            'section' => 'revive_sidebar_options',
            'label' => __('Sidebar Style', 'revive'),
            'type' => 'select',
            'choices' => array(
                'default' => __('Default', 'revive'),
                'sticky-sidebar' => __('Sticky', 'revive'),
            )
        )
    );
    function revive_sanitize_sidebar_style( $input ) {
        if ( in_array($input, array('default','sticky-sidebar') ) )
            return $input;
        else
            return '';
    }
    $wp_customize->add_setting(
        'revive_disable_sidebar',
        array( 'sanitize_callback' => 'revive_sanitize_checkbox', 'default'  => true )
    );


//sidebar style end



$wp_customize->add_setting(
    'revive_disable_sidebar',
    array( 'sanitize_callback' => 'revive_sanitize_checkbox' )
);

$wp_customize->add_control(
    'revive_disable_sidebar', array(
        'settings' => 'revive_disable_sidebar',
        'label'    => __( 'Disable Sidebar Everywhere.','revive' ),
        'section'  => 'revive_sidebar_options',
        'type'     => 'checkbox',
        'default'  => false
    )
);

$wp_customize->add_setting(
    'revive_disable_sidebar_home',
    array( 'sanitize_callback' => 'revive_sanitize_checkbox' )
);

$wp_customize->add_control(
    'revive_disable_sidebar_home', array(
        'settings' => 'revive_disable_sidebar_home',
        'label'    => __( 'Disable Sidebar on Home/Blog.','revive' ),
        'section'  => 'revive_sidebar_options',
        'type'     => 'checkbox',
        'active_callback' => 'revive_show_sidebar_options',
        'default'  => false
    )
);

$wp_customize->add_setting(
    'revive_disable_sidebar_front',
    array( 'sanitize_callback' => 'revive_sanitize_checkbox' )
);

$wp_customize->add_control(
    'revive_disable_sidebar_front', array(
        'settings' => 'revive_disable_sidebar_front',
        'label'    => __( 'Disable Sidebar on Front Page.','revive' ),
        'section'  => 'revive_sidebar_options',
        'type'     => 'checkbox',
        'active_callback' => 'revive_show_sidebar_options',
        'default'  => false
    )
);


$wp_customize->add_setting(
    'revive_sidebar_width',
    array(
        'default' => 4,
        'sanitize_callback' => 'revive_sanitize_positive_number' )
);

$wp_customize->add_control(
    'revive_sidebar_width', array(
        'settings' => 'revive_sidebar_width',
        'label'    => __( 'Sidebar Width','revive' ),
        'description' => __('Min: 25%, Default: 33%, Max: 40%','revive'),
        'section'  => 'revive_sidebar_options',
        'type'     => 'range',
        'active_callback' => 'revive_show_sidebar_options',
        'input_attrs' => array(
            'min'   => 3,
            'max'   => 5,
            'step'  => 1,
            'class' => 'sidebar-width-range',
            'style' => 'color: #0a0',
        ),
    )
);

/* Active Callback Function */
function revive_show_sidebar_options($control) {

    $option = $control->manager->get_setting('revive_disable_sidebar');
    return $option->value() == false ;

}

function revive_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

$wp_customize-> add_section(
    'revive_custom_footer',
    array(
        'title'			=> __('Custom Footer Text','revive'),
        'priority'		=> 11,
        'panel'			=> 'revive_design_panel'
    )
);

$wp_customize->add_setting(
    'revive_fc_line_disable',
    array(
        'sanitize_callback' => 'revive sanitize_checkbox',
        'transport' => 'postMessage'
    )
);

$wp_customize->add_control(
    'revive_fc_line_disable',
    array(
        'settings' => 'revive_fc_line_disable',
        'section'   => 'revive_custom_footer',
        'label'     => __('Disable Footer Credit Line', 'revive'),
        'type'  =>   'checkbox'
    )
);

$wp_customize->add_setting(
    'revive_footer_text',
    array(
        'default'		=> '',
        'sanitize_callback'	=> 'sanitize_text_field',
        'transport'     => 'postMessage'
    )
);

$wp_customize->add_control(
    'revive_footer_text',
    array(
        'section' => 'revive_custom_footer',
        'description'	=> __('Enter your Own Copyright Text.','revive'),
        'settings' => 'revive_footer_text',
        'type' => 'text'
    )
);

//menu alignment
      $wp_customize->add_section(
        'revive_menu_alignment_sec',
        array(
            'title'     => __('Menu Settings','revive'),
            'priority'  => 1,
            'panel'			=> 'nav_menus'
        )
    );


    $wp_customize->add_setting(
        'revive_menu_alignment',
        array( 'sanitize_callback' => 'revive_sanitize_menu_align',
            'default' => 'left')
    );

    function revive_sanitize_menu_align( $input ) {
        if ( in_array($input, array('right','left','center') ) )
            return $input;
        else
            return '';
    }

    $wp_customize->add_control(
        'revive_menu_alignment',array(
            'label' => __('Select Menu Alignment','revive'),
            'settings' => 'revive_menu_alignment',
            'section'  => 'revive_menu_alignment_sec',
            'type' => 'select',
            'choices' => array(
                'left' => __('Left','revive'),
                'center' => __('Center','revive'),
                'right' => __('Right','revive'),
            )
        )
    );
//disable footer menu
    $wp_customize->add_setting(
        'revive_disable_footer_menu',
        array(
            'sanitize_callback' => 'revive_sanitize_checkbox',
            'transport'     => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'revive_disable_footer_menu', array(
            'settings' => 'revive_disable_footer_menu',
            'label'    => __( 'Disable Footer Menu.','revive' ),
            'section'  => 'revive_menu_alignment_sec',
            'type'     => 'checkbox',
            'default'  => false
        )
    );
}
add_action( 'customize_register', 'revive_customize_register_layouts' );
