<?php
/**
 * @package Revive
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-4 col-md-6 grid grid_2_column grid_3_column'); ?>>

		<div class="featured-thumb col-md-12">
			<?php if (has_post_thumbnail()) : ?>	
				<a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><?php the_post_thumbnail('revive-pop-thumb',array(  'alt' => get_the_title(),'title' => get_the_title() )); ?></a>
			<?php else: ?>
				<a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><img alt= "<?php the_title()?>" src="<?php echo esc_url(get_template_directory_uri()."/assets/images/placeholder2.jpg"); ?>"></a>
			<?php endif; ?>
		</div><!--.featured-thumb-->
			
		<div class="out-thumb col-md-12">
			<header class="entry-header">
				<h1 class="entry-title title-font"><a class="hvr-underline-reveal" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
				<div class="postedon"><?php revive_posted_on(); ?></div>
				<span class="entry-excerpt"><?php echo esc_html(substr(get_the_excerpt(),0,200).(get_the_excerpt() ? "..." : "" )); ?></span>
				<span class="readmore"><a class="hvr-underline-from-center" href="<?php the_permalink() ?>"><?php esc_html_e('Read More','revive'); ?></a></span>
			</header><!-- .entry-header -->
		</div><!--.out-thumb-->
			
		
		
</article><!-- #post-## -->