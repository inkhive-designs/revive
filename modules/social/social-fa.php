<?php
/*
** Template to Render Social Icons on Top Bar
*/
$social_style = get_theme_mod('revive_social_icon_style_set','hvr-ripple-out');
for ($i = 1; $i < 8; $i++) :
	$social = esc_html( get_theme_mod('revive_social_'.$i) );
    $social_url = esc_html( get_theme_mod('revive_social_url'.$i) );
	if ( ($social != 'none') && ($social_url != '') ) : ?>
	<a class="social-icon <?php echo $social_style; ?>" href="<?php echo $social_url; ?>"><i class="fab fa-<?php echo $social; ?>"></i></a>
	<?php endif;

endfor; ?>