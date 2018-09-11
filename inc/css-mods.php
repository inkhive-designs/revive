<?php
/* 
**   Custom Modifcations in CSS depending on user settings.
*/

function revive_custom_css_mods() {

	echo "<style id='custom-css-mods'>";
	
	//If Highlighting Nav active item is disabled
	if ( get_theme_mod('revive_disable_active_nav') ) :
		echo "#site-navigation ul .current_page_item > a, #site-navigation ul .current-menu-item > a, #site-navigation ul .current_page_ancestor > a { border:none; background: inherit; }"; 
	endif;
	
	//If Title and Desc is set to Show Below the Logo
	if (  get_theme_mod('revive_branding_below_logo') ) :
		echo "#masthead #text-title-desc { display: block; } ";
	endif;

	//Exception: When Logo is Centered, and Title Not Set to display in next line.
	if ( get_theme_mod('revive_center_logo') && !get_theme_mod('revive_branding_below_logo') ) :
		echo ".site-branding { text-align: center; }";
	endif;
	
	//Exception: When Logo is centered, but there is no logo.
	if ( get_theme_mod('revive_center_logo') && get_theme_mod('revive_branding_below_logo') ) :
        echo ".site-branding { text-align: center; }";
        echo ".site-branding #text-title-desc { text-align: center; }";
    endif;
	
	//Exception: IMage transform origin should be left on Left Alignment, i.e. Default
	if ( !get_theme_mod('revive_center_logo') ) :
		echo "#masthead #site-logo img { transform-origin: center; }";
	endif;	
	
	
	if ( get_theme_mod('revive_title_font') ) :
		echo ".title-font, h1, h2, .section-title { font-family: ".esc_html(get_theme_mod('revive_title_font','Bree Serif'))."; }";
	endif;
	
	if ( get_theme_mod('revive_body_font') ) :
		echo "body { font-family: ".esc_html(get_theme_mod('revive_body_font','Slabo 27px'))."; }";
	endif;
	
	if ( get_theme_mod('revive_site_titlecolor') ) :
		echo "#masthead h1.site-title a { color: ".esc_html(get_theme_mod('revive_site_titlecolor', '#FFF'))."; }";
	endif;
	
	
	if ( get_theme_mod('revive_header_desccolor','#777') ) :
		echo "#masthead h2.site-description { color: ".esc_html(get_theme_mod('revive_header_desccolor','#FFF'))."; }";
	endif;
	
	
	if ( get_theme_mod('revive_hide_title_tagline') ) :
		echo "#masthead .site-branding #text-title-desc { display: none; }";
	endif;
	
	if ( get_theme_mod('revive_logo_resize') ) :
		$val = esc_html(get_theme_mod('revive_logo_resize'));
		echo "#masthead #site-logo img, #masthead #site-logo {width:" . $val . "px;}";
		endif;

    // page & post fontsize
    if(get_theme_mod('revive_content_page_post_fontsize_set')):
        $pp_size_val = get_theme_mod('revive_content_page_post_fontsize_set');
        if($pp_size_val=='small'):
            echo "#primary-mono .entry-content{ font-size:16px;}";
        elseif ($pp_size_val=='medium'):
            echo "#primary-mono .entry-content{ font-size:20px;}";
        elseif ($pp_size_val=='large'):
            echo "#primary-mono .entry-content{ font-size:22px;}";
        elseif ($pp_size_val=='extra-large'):
            echo "#primary-mono .entry-content{ font-size:24px;}";
        elseif ($pp_size_val=='default'):
            echo "#primary-mono .entry-content{ font-size:18px;}";
        endif;
    endif;

    //site title font size
    //var_dump(get_theme_mod('revive_content_site_fontsize_set'));
    if(get_theme_mod('revive_content_site_title_fontsize_set')):
        $site_title_size_val=get_theme_mod('revive_content_site_title_fontsize_set');
        $site_title_size_val=get_theme_mod('revive_content_site_title_fontsize_set');
        if($site_title_size_val != 'default'):
            echo "#masthead h1.site-title {font-size:".esc_html($site_title_size_val)."px !important;}";
        else:
            echo "#masthead h1.site-title {font-size:42"."px;}";
        endif;
    endif;

    //site desc font size
    //var_dump(get_theme_mod('revive_content_site_desc_fontsize_set'));
    if(get_theme_mod('revive_content_site_desc_fontsize_set')):
        $site_desc_size_val=get_theme_mod('revive_content_site_desc_fontsize_set');
        if($site_desc_size_val != 'default'):
            echo "#masthead h2.site-description {font-size:".esc_html($site_desc_size_val)."px !important;}";
        else:
            echo "#masthead h2.site-description {font-size:18"."px;}";
        endif;
    endif;

//contact us page
    if(!is_home()):
        if( get_theme_mod('revive_contact_page_title', true)):
            echo "#primary-mono .contact-us .entry-header { display:none; }";
        endif;
    endif;

    if (!is_home() && is_front_page()) :
        if ( get_theme_mod('revive_content_font_size') ) :
            $size = (get_theme_mod('revive_content_font_size'));
            echo "#primary-mono .entry-content { font-size:".esc_html($size).";}";
        endif;
    endif;

    //menu alignment
    if( get_theme_mod('revive_menu_alignment')=='right'):
        echo "#top-menu{ float:right; }
               #footer-menu{float:right;}";

    elseif( get_theme_mod('revive_menu_alignment')=='center'):
        echo "#top-menu{
                   float: none;
                   text-align: center;
                   }
                  #menu-my-menu ul{
                   text-align:left;
                   }
                   #footer-menu{
                   float: none;
                   text-align: center;
                   }
                 ";
    endif;
    //disable footer menu
    if ( get_theme_mod('revive_disable_footer_menu') ) :
        echo "#site-navigation { display:none;}";
    endif;

    if(get_theme_mod('revive_menu_alignment')=='right'):
        echo ".footer-menu #site-navigation ul {
           float: right;
            overflow: hidden;}";
        endif;
    echo "</style>";
}

add_action('wp_head', 'revive_custom_css_mods');