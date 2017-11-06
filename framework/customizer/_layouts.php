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
    array( 'sanitize_callback' => 'revive_sanitize_blog_layout' )
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

class Revive_Custom_CSS_Control extends WP_Customize_Control {
    public $type = 'textarea';

    public function render_content() {
        ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <textarea rows="8" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
        </label>
        <?php
    }
}

$wp_customize-> add_section(
    'revive_custom_codes',
    array(
        'title'			=> __('Custom CSS','revive'),
        'description'	=> __('Enter your Custom CSS to Modify design.','revive'),
        'priority'		=> 11,
        'panel'			=> 'revive_design_panel'
    )
);

$wp_customize->add_setting(
    'revive_custom_css',
    array(
        'default'		=> '',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'wp_filter_nohtml_kses',
        'sanitize_js_callback' => 'wp_filter_nohtml_kses'
    )
);

$wp_customize->add_control(
    new Revive_Custom_CSS_Control(
        $wp_customize,
        'revive_custom_css',
        array(
            'section' => 'revive_custom_codes',
            'settings' => 'revive_custom_css'
        )
    )
);

function revive_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

$wp_customize-> add_section(
    'revive_custom_footer',
    array(
        'title'			=> __('Custom Footer Text','revive'),
        'description'	=> __('Enter your Own Copyright Text.','revive'),
        'priority'		=> 11,
        'panel'			=> 'revive_design_panel'
    )
);

$wp_customize->add_setting(
    'revive_footer_text',
    array(
        'default'		=> '',
        'sanitize_callback'	=> 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    'revive_footer_text',
    array(
        'section' => 'revive_custom_footer',
        'settings' => 'revive_footer_text',
        'type' => 'text'
    )
);

}
add_action( 'customize_register', 'revive_customize_register_layouts' );
