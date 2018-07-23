<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package revive
 */
?>
<?php get_template_part('modules/header/head'); ?>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'revive' ); ?></a>

    <?php get_template_part('modules/header/jumbosearch'); ?>

    <?php get_template_part('modules/header/top','bar'); ?>

    <?php get_template_part('modules/header/masthead'); ?>
	
	<div id="social-icons">
		<?php get_template_part('modules/social/social', 'fa'); ?>
	</div>

    <?php if(get_theme_mod('revive_disable_social_sticky',true)):?>
        <div id="social-icons-sticky">
            <?php get_template_part('modules/social/social', 'fa'); ?>
        </div>
    <?php endif;?>

    <?php get_template_part('framework/featured-components/featured', 'area1'); ?>
    <?php get_template_part('framework/featured-components/featured-posts', 'slider'); ?>
    <?php get_template_part('framework/featured-components/featured-mega', 'post'); ?>
    <?php get_template_part('framework/featured-components/featured', 'area2'); ?>
    

	<div class="mega-container">
		
		<?php get_template_part('slider', 'nivo' ); ?>
	
		<div id="content" class="site-content container">