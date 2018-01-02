<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package revive
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
$sidebar_style = get_theme_mod('revive_sidebar_style', 'default');
//var_dump($sidebar_style);
if ( revive_load_sidebar() ) : ?>
<div id="secondary" class="widget-area <?php echo esc_html($sidebar_style); ?> <?php do_action('revive_secondary-width') ?>" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
<?php endif; ?>
