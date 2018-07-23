<?php
/* The Template to Render the Slider
*
*/

//Define all Variables.
if ( get_theme_mod('revive_fposts_slider_enable' ) && is_front_page() ) :
    $count_x = get_theme_mod('revive_posts_slider_count');
    
    ?>
    <div id="post-slider" class="container">'
	    
        <?php if ( get_theme_mod('revive_posts_slider_title' ) ):?>
        
            <div class="section-title">
                <?php echo esc_html(get_theme_mod('revive_posts_slider_title',__('Popular Articles','revive'))); ?>
            </div>
            
        <?php endif;?>
        
        <div class="slider-wrapper theme-default">
        <?php
	        
	        global $post;
	        
            $args = array(
                'ignore_sticky_posts' => true,
                'posts_per_page' => $count_x,
            );
            $lastposts = get_posts( $args );
            $count	=	1;
            ?>
            
                <div id="nivoSliderPosts" class="nivoSlider">
                    <?php
                    
                    foreach($lastposts as $post):
                    
                    	setup_postdata( $post );
                    	
						if (has_post_thumbnail()) : ?>
						
                        	<a href="<?php the_permalink() ?>" alt="<?php  the_title() ?>" title="<?php the_title() ?>"><?php the_post_thumbnail( 'revive-pop-thumb', array(  'alt' => trim(strip_tags( $post->post_title ) ), 'title'	=>	'#captionPost_' . $count ) ); ?></a>
                        	
						<?php else : ?>
						
                        	<a href="<?php the_permalink() ?>" alt="<?php  the_title() ?>" title="<?php the_title() ?>"><img alt= "<?php the_title() ?>" src="<?php echo esc_url(get_template_directory_uri()."/assets/images/placeholder2.jpg"); ?>"></a>
                        	
						<?php endif; ?>
						<?php $count++; ?>
						
                    <?php endforeach; ?>
                </div>
                
                <?php $count = 1; ?>

                <?php
                foreach($lastposts as $post):
                    
                	setup_postdata( $post ); ?>
                	
	                <div id="captionPost_<?php echo $count; ?>" class="nivo-html-caption">
	
	                    <a href="<?php echo esc_url ( the_permalink() ); ?>">
	                        <div class="slide-title"><?php echo esc_html( the_title() ); ?></div><br>
	                        <a href="<?php echo esc_url ( the_permalink() ); ?>" class="readmore"><?php _e('Read More', 'revive'); ?></a>
	                    </a>
	                    
	
	                </div>
	                
                <?php 
                $count++;
				endforeach;
				wp_reset_postdata(); ?>
        </div>
    </div>

<?php

endif;	?>