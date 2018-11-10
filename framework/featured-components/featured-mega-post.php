<?php if ( get_theme_mod('revive_fm_post_enable') && is_front_page() ) : ?>
	<div id="featured-mega-post">
	    <div id="fm-title" class="section-title title-font">
	        <div class="container">
	            <?php echo esc_html( get_theme_mod('revive_fm_post_title','Mega Post') ); ?>
	        </div>
	    </div>
	    <div id="fm-post-wrapper">
		    
		    <?php 
			    $post_title		=	get_theme_mod('revive_fm_post_cat');
				$current_post	=	get_page_by_title( $post_title, OBJECT, 'post' );
			?>
		    
	        	<?php $class = has_post_thumbnail( $current_post ) ? 'col-md-6 col-sm-6 col-xs-12' : 'col-md-12 col-sm-12 col-xs-12 centered' ?>
		        <div class="<?php echo $class; ?> out-thumb">
		            <h1 class="title">
		                <?php echo $current_post->post_title; ?>
		            </h1>
		            <div class="excerpt">
		                <?php  echo substr($current_post->post_content, 0, 150)."..."; ?>
		            </div>
		            <div class="readmore">
		                <a href="<?php the_permalink( $current_post ); ?>"><?php _e('Read More', 'revive'); ?></a>
		            </div>
		        </div> <!--#out-thumb-->
		
				<?php if (has_post_thumbnail( $current_post )) : ?>
			        <div class="col-md-6 col-sm-6 col-xs-12 featured-thumb">
			            <div class="layer"></div>
			            	<a href="<?php the_permalink( $current_post ); ?>"><?php echo get_the_post_thumbnail( $current_post ); ?></a>
			            
			            
			            <?php $category	= get_the_category( $current_post->ID ); ?>
			            <div class="catname">
			                <?php echo $category[0]->name; ?>
			            </div>
			        </div> <!--#featured-thumb-->
		        <?php endif; ?>
	    </div>
	</div>
<?php endif; ?>