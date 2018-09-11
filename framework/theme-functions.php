<?php
/*
 * @package revive, Copyright Rohit Tripathi, rohitink.com
 * This file contains Custom Theme Related Functions.
 */
//Import Admin Modules
require get_template_directory() . '/framework/admin_modules/register_styles.php';
require get_template_directory() . '/framework/admin_modules/register_widgets.php';
require get_template_directory() . '/framework/admin_modules/theme_setup.php';
require get_template_directory() . '/framework/admin_modules/admin_styles.php';
/*
** Walkers for Navigation menus
*/ 


/*
 * Pagination Function. Implements core paginate_links function.
 */
function revive_pagination() {
	global $wp_query;
	$big = 12345678;
	$page_format = paginate_links( array(
	    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	    'format' => '?paged=%#%',
	    'current' => max( 1, get_query_var('paged') ),
	    'total' => $wp_query->max_num_pages,
	    'type'  => 'array'
	) );
	if( is_array($page_format) ) {
	            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
	            echo '<div class="pagination"><div><ul>';
	            echo '<li><span>'.$paged . esc_html(' of ','revive') . $wp_query->max_num_pages.'</span></li>';
	            foreach ( $page_format as $page ) {
	                    echo "<li>$page</li>";
	            }
	           echo '</ul></div></div>';
	 }
}

/*
** Customizer Controls 
*/
if (class_exists('WP_Customize_Control')) {
	class Revive_WP_Customize_Category_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         */
        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => '_customize-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( '&mdash; Select &mdash;', 'revive' ),
                    'option_none_value' => '0',
                    'selected'          => $this->value(),
                )
            );
 
            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
 
            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $dropdown
            );
        }
    }

    class Revive_Skin_Chooser extends WP_Customize_Control{
        public $type = 'skins';

        public function render_content(){
            ?>

            <span class="customize-control-title">
            <?php echo esc_html( $this->label ); ?>
            </span>

            <?php if($this->description){ ?>
                <span class="description customize-control-description">
            	<?php echo wp_kses_post($this->description); ?>
            </span>
            <?php } ?>

            <?php $name = '_customize-skin-' . $this->id;
            foreach ($this->choices as $key=>$value) { ?>
                <label>
                    <input type="radio" class="custom_skin_control" style="background: <?php echo $key; ?>"  value="<?php echo esc_attr($value); ?>" <?php $this->link(); ?> name="<?php echo esc_attr( $name ); ?>" <?php checked( $this->value(), $value ); ?>/>
                </label>
            <?php }
        }
    }
}  

if (class_exists('WP_Customize_Control')) {
	class WP_Customize_Upgrade_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         */
        public function render_content() {
             printf(
                '<label class="customize-control-upgrade"><span class="customize-control-title">%s</span> %s</label>',
                 $this->label, $this->description
            );
        }
    }
}

if ( class_exists('WP_Customize_Control')) {
	class Revive_Posts_Live_Search_Control extends WP_Customize_Control {
		/**
		 *	Render the Control's Content
		**/
		public function render_content() { ?>
			
			 <span class="customize-control-title">
            <?php echo esc_html( $this->label ); ?>
            </span>

            <?php if($this->description){ ?>
                <span class="description customize-control-description">
            	<?php echo wp_kses_post($this->description); ?>
            </span>
            <?php } ?>
            <input type="text" id="post_search" autocomplete="off" <?php $this->link(); ?> value="<?php echo $this->value(); ?>">
            <div id="search-results"></div>
		<?php
		}
	}
}
  
/*
** Function to check if Sidebar is enabled on Current Page 
*/

function revive_load_sidebar() {
	$load_sidebar = true;
	if ( get_theme_mod('revive_disable_sidebar') ) :
		$load_sidebar = false;
	elseif( get_theme_mod('revive_disable_sidebar_home') && is_home() )	:
		$load_sidebar = false;
	elseif( get_theme_mod('revive_disable_sidebar_front') && is_front_page() ) :
		$load_sidebar = false;
	endif;
	
	return  $load_sidebar;
}

/*
**	Determining Sidebar and Primary Width
*/
function revive_primary_class() {
	$sw = esc_html( get_theme_mod('revive_sidebar_width',4) );
	$class = "col-md-".(12-$sw);
	
	if ( !revive_load_sidebar() ) 
		$class = "col-md-12";
	
	echo $class;
}
add_action('revive_primary-width', 'revive_primary_class');

function revive_secondary_class() {
	$sw = esc_html( get_theme_mod('revive_sidebar_width',4) );
	$class = "col-md-".$sw;
	
	echo $class;
}
add_action('revive_secondary-width', 'revive_secondary_class');


/*
**	Helper Function to Convert Colors
*/
function revive_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);
   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return implode(",", $rgb); // returns the rgb values separated by commas
   //return $rgb; // returns an array with the rgb values
}
function revive_fade($color, $val) {
	return "rgba(".revive_hex2rgb($color).",". $val.")";
}


/*
** Function to Get Theme Layout 
*/
function revive_get_blog_layout(){
	$ldir = 'framework/layouts/content';
	if (get_theme_mod('revive_blog_layout') ) :
		get_template_part( $ldir , get_theme_mod('revive_blog_layout') );
	else :
		get_template_part( $ldir ,'grid');	
	endif;	
}
add_action('revive_blog_layout', 'revive_get_blog_layout');

/** Load WooCommerce Compatibility FIle
*/
if ( class_exists('woocommerce') ) :
    require get_template_directory() . '/framework/woocommerce.php';
endif;

/*
** Load Custom Widgets
*/

require get_template_directory() . '/framework/widgets/recent-posts.php';


/**
 *	JS for the Customizer Controls
**/
function revive_customize_control_js() {
	
	wp_enqueue_script( 'revive_customizer_control_js', get_template_directory_uri() . '/js/customize-control.js', array(), 93846712, true );
	
	
}
add_action( 'customize_controls_enqueue_scripts', 'revive_customize_control_js', 99);


/**
 *	AJAX Functionality for Mega Post Search in Customizer
**/

add_action( 'wp_ajax_post_title_list', 'revive_ajax_post_title_list');

function revive_ajax_post_title_list() {
	
	$string	=	$_POST['post_title'];
	
	$args	=	array(
					'post_type'			=> 'post',
					'posts_per_page'	=> -1
				);
				
	$posts_array	=	get_posts( $args );
	$title_array	=	wp_list_pluck($posts_array, 'post_title'); ?>
	
		<ul id="post-title-dropdown">
			<?php
				foreach( $title_array as $title ) { ?>
					<?php 
					if ( stripos( $title, $string ) !== false ) { ?>
					
						<li><?php echo $title; ?></li>
						
					<?php
					} 
				}
			?>
		</ul>
	
	<?php
	die();
}


/**
 *	Slider Functions
**/

add_filter( 'attachment_fields_to_edit', 'applyFilter', 99, 2 );
		

function applyFilter( $form_fields, $post ) {
		
	$form_fields['post_title']	=	array(
		'label'	=> __('Title', 'revive'),
		'html'	=> 	"<input type='text' class='text slide_title' value='" . get_the_title( $post->ID ) . "' /><br />",
		'input'	=> 'text',
	);
	
	$form_fields['post_content']	=	array(
		'label'	=> __('Description', 'revive'),
		'html'	=> "<textarea style='width: 100%'></textarea>",
		'value'	=> $post->post_content
	);
	
	$form_fields['revive_link']	=	array(
		'label'	=>	__( 'Slide link', 'revive' ),
		'helps'	=> __('Add the URL for the Slide <b>(Used only in Main Slider)</b>', 'revive' ),
		'input'	=> 'text',
		'value'	=> get_post_meta( $post->ID, 'revive_link', true ),
		'html'	=> "<input type='text' class='text revive_link' value='" . get_post_meta( $post->ID, 'revive_link', true ) . "' /><br />",
	);
	
	$form_fields['cta_button']	=	array(
		'label'	=> __( 'CTA Button', 'revive'),
		'helps'	=> __( 'Enter the text to be displayed in Call To Action Button <b>(Used only in Main Slider)</b>', 'revive' ),
		'input'	=> 'text',
		'html'	=> "<input type='text' class='text cta_button' value='" . get_post_meta( $post->ID, 'cta_button', true ) . "' /><br />",
		'value'	=> get_post_meta( $post->ID, 'cta_button', true )
	);
 
    // We return the completed $form_fields array
    return $form_fields;
}
	
add_filter( 'attachment_fields_to_save', 'saveFields', 11, 2 );
	
function saveFields( $post, $attachment ) {
	
	if ( isset( $attachment['revive_link'] ) )
		update_post_meta( $post['ID'], 'revive_link', $attachment['revive_link'] );
	
	if ( isset( $attachment['cta_button'] ) )
		update_post_meta( $post['ID'], 'cta_button', $attachment['cta_button'] );
		
	return $post;
}
	
/**
 * Save values of Author Name and URL in media uploader modal via AJAX
 */

add_action('wp_ajax_save-attachment-compat', 'revive_meta_save_ajax', 0, 1);

function revive_meta_save_ajax() {

    $post_id = $_POST['id'];

    if( isset( $_POST['attachments'][$post_id]['revive_link'] ) )
        update_post_meta( $post_id, 'revive_link', $_POST['attachments'][$post_id]['revive_link'] );

    if( isset( $_POST['attachments'][$post_id]['cta_button'] ) )
        update_post_meta( $post_id, 'cta_button', $_POST['attachments'][$post_id]['cta_button'] );

    clean_post_cache($post_id);

}


/**
 *	Setting up a PHP constant for use in WP Forms Lite Plugin
**/


if ( ! defined( 'WPFORMS_SHAREASALE_ID' ) ) {
	define( 'WPFORMS_SHAREASALE_ID', '1802605' );
}

