<?php
/* The Template to Render the Slider
*
*/

//Define all Variables.
if ( get_theme_mod('revive_fposts_slider_enable' ) && is_front_page() ) :
    $count_x = $count = get_theme_mod('revive_posts_slider_count');
    ?>
    <div id="post-slider" class="container">
        <?php if(get_theme_mod('revive_posts_slider_title')):?>
            <div class="section-title">
                <?php echo esc_html(get_theme_mod('revive_posts_slider_title',__('Popular Articles','revive'))); ?>
            </div>
        <?php endif;?>
        <div class="slider-wrapper theme-default">
        <?php
            $args = array(
                'ignore_sticky_posts' => true,
                'posts_per_page' => $count_x,
            );
            $lastposts = get_posts( $args ); ?>



                <div id="nivoSliderPosts" class="nivoSliderPosts">
                    <?php
                    $loop = new WP_Query( $args );
                    while ( $loop->have_posts() ) :

                    $loop->the_post();
                    ?>
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink() ?>" alt="<?php  the_title() ?>" title="<?php the_title() ?>"><?php the_post_thumbnail( 'revive-pop-thumb', array(  'alt' => trim(strip_tags( $post->post_title ))) ); ?></a>
                    <?php else : ?>
                        <a href="<?php the_permalink() ?>" alt="<?php  the_title() ?>" title="<?php the_title() ?>"><img alt= "<?php the_title() ?>" src="<?php echo esc_url(get_template_directory_uri()."/assets/images/placeholder2.jpg"); ?>"></a>
                    <?php endif; ?>
                    <?php endwhile; ?>
                    <?php wp_reset_query(); ?>
                </div>


                <?php
                $loop = new WP_Query( $args );

                $count = 1;
                while ( $loop->have_posts() ) :
                $loop->the_post();
                ?>
                <div id="captionPost_<?php echo $count; ?>" class="nivo-html-caption">

                    <a href="<?php echo esc_url ( the_permalink() ); ?>"> caption me title and excerpt ni dikha ra
                        <div class="slide-title"><?php echo esc_html( the_title() ); ?></div>
                        <div class="slide-desc"><span><?php echo esc_html( the_excerpt() ); ?></span></div>
                    </a>
                    <a href="<?php echo esc_url ( the_permalink() ); ?>"><?php _e('Read More', 'revive'); ?></a>

                </div>
                    <?php $count++; ?>
                <?php endwhile; ?>
            <?php wp_reset_query(); ?>
        </div>
    </div>

<?php

endif;	?>