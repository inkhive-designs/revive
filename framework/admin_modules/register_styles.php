<?php
/**
 * Enqueue scripts and styles.
 */
function revive_scripts() {
    wp_enqueue_style( 'revive-style', get_stylesheet_uri(),array(),1231 );

    wp_enqueue_style('revive-title-font', '//fonts.googleapis.com/css?family='.str_replace(" ", "+", esc_html(get_theme_mod('revive_title_font', 'Bree Serif')) ).':100,300,400,700' );

    wp_enqueue_style('revive-body-font', '//fonts.googleapis.com/css?family='.str_replace(" ", "+", esc_html(get_theme_mod('revive_body_font', 'Slabo 27px')) ).':100,300,400,700' );

    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/fontawesome-all.min.css' );

    wp_enqueue_style( 'nivo-slider', get_template_directory_uri() . '/assets/css/nivo-slider.css' );

    wp_enqueue_style( 'nivo-slider-skin', get_template_directory_uri() . '/assets/css/nivo-default/default.css' );

    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css' );

    wp_enqueue_style( 'flex-image', get_template_directory_uri() . '/assets/css/jquery.flex-images.css' );

    wp_enqueue_style( 'hover', get_template_directory_uri() . '/assets/css/hover.min.css' );

    wp_enqueue_style( 'revive-main-theme-style', get_template_directory_uri() . '/assets/theme-styles/css/'.get_theme_mod('revive_skins', 'default').'.css', array(), null );

    wp_enqueue_script( 'revive-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

    wp_enqueue_script( 'revive-externaljs', get_template_directory_uri() . '/js/external.js', array('jquery'), '20120206', true );

    wp_enqueue_script('revive-sticky-sidebar-js', get_template_directory_uri()."/js/jquery-scrolltofixed-min.js");

    wp_enqueue_script( 'revive-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    wp_enqueue_script( 'revive-custom-js', get_template_directory_uri() . '/js/custom.js' );
}
add_action( 'wp_enqueue_scripts', 'revive_scripts' );
