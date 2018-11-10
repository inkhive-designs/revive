<?php
/* The Template to Render the Slider
*
*/

//Define all Variables.
if ( get_theme_mod('revive_main_slider_enable' ) && is_front_page() ) : 

	//$count_x = $count = get_theme_mod('revive_main_slider_count');
	
	$slides		=	json_decode( get_theme_mod( 'revive_upload_slides', TRUE ) );

		
		?>
		<div class="container">
			<div class="slider-wrapper theme-default">
		            <div id="nivoSlider" class="nivoSlider">
		            <?php
			        $count = 1;
		            foreach( $slides as $slide ) :

						$url 	= esc_url ( $slide->url );
						$img 	= esc_url ( wp_get_attachment_image_src( $slide->id, 'full' )[0] );
						
						?>
			            <a href="<?php echo $url; ?>"><img alt= "<?php echo esc_html( get_theme_mod('revive_slide_title'.$count) ); ?>" src="<?php echo $img ?>" title="#caption_<?php echo esc_html($count) ?>" /></a>
			            
			            <?php $count++; ?>
		             <?php endforeach; ?>
		               
		            </div>
		            
		            <?php
			            $count = 1;
		            foreach ( $slides as $slide ) :
						
						$url 	=	esc_url ( $slide->url );
						$button	=	esc_html( $slide->cta );
						$title 	=	esc_html( $slide->title );
						$desc 	=	esc_html( $slide->description );
					
						
						?>
                    <div id="caption_<?php echo $count ?>" class="nivo-html-caption">
			                <a href="<?php echo $url ?>">
				                 <?php if ($title != "") { ?><div class="slide-title"><?php echo $title ?></div><?php } ?>
				                 <?php if ($desc != "") { ?><div class="slide-desc"><span><?php echo $desc ?></span></div><?php  } ?>
				                <?php if ($button != "") { ?><div class="slide-cta"><span><?php echo $button?></span></div><?php } ?>
			                </a>
			            </div>
			            <?php $count++; ?>
		            <?php endforeach; ?>
		            
		        </div>
		</div> 
	
	<?php	
	
endif;	?>	   