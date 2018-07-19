<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package revive
 */
?>

		</div><!-- #content -->
	
	</div><!--.mega-container-->

<div class="footer-menu">
    <div class="container">
        <div id="footer-menu">
            <?php wp_nav_menu( array( 'theme_location' => 'bottom' ) ); ?>
        </div>
    </div>
</div>






	<?php get_sidebar('footer'); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info container">
			<span class="credit-line">
                <?php printf( esc_html('Theme Designed by %1$s.', 'revive' ), '<a target ="blank" href="'.esc_url("http://inkhive.com/").'" rel="designer">InkHive.com</a>' ); ?>
            </span>
			<span class="sep">
                <?php echo ( esc_html(get_theme_mod('revive_footer_text')) == '' ) ? ('&copy; '.date('Y').' '.get_bloginfo('name').esc_html('. All Rights Reserved. ','revive')) : esc_html( get_theme_mod('revive_footer_text') ); ?>
            </span>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	
</div><!-- #page -->


<?php wp_footer(); ?>

</body>
</html>
