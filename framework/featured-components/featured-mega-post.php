<div id="featured-mega-post">
    <div id="fm-title" class="section-title title-font">
        <div class="container">
            <?php echo esc_html( get_theme_mod('revive_fm_post_title','Mega Post') ); ?>
        </div>
    </div>
    <div id="fm-post-wrapper">
        <?php
        $args = array(
            'ignore_sticky_posts' => true,
            'post_type' => 'post',
            'posts_per_page' => 1,
            'category' => get_theme_mod('revive_fm_post_cat'),
            //'post__in' => array(get_theme_mod('store_fp_post_id')),
        );
        $loop = new WP_Query( $args );

        while( $loop -> have_posts() ):
            $loop->the_post();
            ?>


            <?php if (has_post_thumbnail()) : ?>
            <div class="col-md-6 col-sm-6 col-xs-12 out-thumb">
                <h1 class="title">
                    <?php the_title(); ?>
                </h1>
                <div class="excerpt">
                    <?php  echo substr(get_the_content(), 0, 250)."..."; ?>
                </div>
                <div class="readmore">
                    <a href="<?php the_permalink(); ?>"><?php _e('Read More', 'revive'); ?></a>
                </div>
            </div> <!--#out-thumb-->

            <div class="col-md-6 col-sm-6 col-xs-12 featured-thumb">
                <div class="layer"></div>
                <a href="<?php the_permalink(); ?>"><img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>"></a>
                <div class="catname">
                    <?php echo get_cat_name(get_theme_mod('revive_fm_post_cat')); ?>
                </div>
            </div> <!--#featured-thumb-->
        <?php endif; ?>

        <?php
        endwhile; ?>
        <?php wp_reset_postdata(); ?>
    </div>
</div>
