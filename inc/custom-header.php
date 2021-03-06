<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...

	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>

 *
 * @package revive
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses revive_header_style()
 * @uses revive_admin_header_style()
 * @uses revive_admin_header_image()
 */
function revive_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'revive_custom_header_args', array(
		'default-image'          => get_template_directory_uri().'/assets/images/header.jpg',
		'default-text-color'     => '#fff',
		'height'				 => 721,
		'width'					 => 1920,
		'flex-height'            => true,
		'wp-head-callback'       => 'revive_header_style',
		'admin-head-callback'    => 'revive_admin_header_style',
		'admin-preview-callback' => 'revive_admin_header_image',
	) ) );
    register_default_headers( array(
            'default-image'    => array(
                'url'            => '%s/assets/images/header.jpg',
                'thumbnail_url'    => '%s/assets/images/header.jpg',
                'description'    => __('Default Header Image', 'revive')
            )
        )
    );
}
add_action( 'after_setup_theme', 'revive_custom_header_setup' );

if ( ! function_exists( 'revive_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see revive_custom_header_setup().
 */
function revive_header_style() {
	?>
	<style>
	#masthead {
			background-image: url(<?php header_image(); ?>);
			background-size: <?php echo esc_html(get_theme_mod('revive_himg_style','cover')); ?>;
			background-position-x: <?php echo esc_html(get_theme_mod('revive_himg_align','center')); ?>;
			background-repeat: <?php echo esc_html(get_theme_mod('revive_himg_repeat')) ? "repeat" : "no-repeat" ?>;
		}
	</style>	
	<?php
}
endif; // revive_header_style

if ( ! function_exists( 'revive_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see revive_custom_header_setup().
 */
function revive_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		#headimg h1,
		#desc {
		}
		#headimg h1 {
		}
		#headimg h1 a {
		}
		#desc {
		}
		#headimg img {
		}
	</style>
<?php
}
endif; // revive_admin_header_style

if ( ! function_exists( 'revive_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see revive_custom_header_setup().
 */
function revive_admin_header_image() {
	$style = sprintf( ' style="color:#%s;"', get_header_textcolor() );
?>
	<div id="headimg">
		<h1 class="displaying-header-text"><a id="name"<?php echo esc_html($style); ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div class="displaying-header-text" id="desc"<?php echo esc_html($style); ?>><?php bloginfo( 'description' ); ?></div>
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="<?php the_title() ?>">
		<?php endif; ?>
	</div>
<?php
}
endif; // revive_admin_header_image