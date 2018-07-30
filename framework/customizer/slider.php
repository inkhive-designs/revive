<?php
function revive_customize_register_slider($wp_customize) {
	
	class RT_Slider_Custom_Control_Class extends WP_Customize_Control {
		
		public $type	=	'slider';
		
		public function render_content() {
			?>
			<div class="slider-container">
				<?php if ( $this->label) { ?>
					<span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
				<?php } ?>
				
				<?php if($this->description){ ?>
					<span class="description customize-control-description">
						<?php echo wp_kses_post($this->description); ?>
					</span>
				<?php } ?>
				
				<div class="slide_thumbs">
					
						<?php
							

								if ( $this->value() ) : 
									$ids	=	json_decode( $this->value(), TRUE );
								else :
									$ids	=	[];
								endif;
								
								foreach ( $ids as $attachment_id ) {
									if ($attachment_id	!= '' ) :
										
										$edit_fields	=	get_attachment_fields_to_edit( get_post( $attachment_id['id'] ) );
										
						            	$img = wp_get_attachment_image_src( $attachment_id['id'], 'large' ); ?>
						            	<div class="slide-image">

							            	<h2>
								            	<span>
									            	<?php
										            	_e( 'Slide', 'revive' );
									            	?>
								            	</span>
								            	<span class="dashicons dashicons-arrow-down-alt2"></span>
							            	</h2>

							            	<div class="img-container">
								            	<img src=" <?php echo esc_url( $img[0] ); ?> " data-id=" <?php echo $attachment_id['id'] ?> ">
								            </div>
							            	<div class="slide-title">
								            	<h3>
									            	<?php echo $edit_fields['post_title']['label']; ?>
								            	</h3>
												<?php echo $edit_fields['post_title']['html']; ?>
											</div>
											<div class="slide-description">
								            	<h3>
									            	<?php echo $edit_fields['post_content']['label']; ?>
								            	</h3>
												<?php echo $edit_fields['post_content']['html']; ?>
											</div>
											<div class="slide-url">
								            	<h3>
									            	<?php echo $edit_fields['revive_link']['label']; ?>
								            	</h3>
												<?php echo $edit_fields['revive_link']['html']; ?>
											</div>
											<div class="slide-url">
								            	<h3>
									            	<?php echo $edit_fields['cta_button']['label']; ?>
								            	</h3>
												<?php echo $edit_fields['cta_button']['html']; ?>
											</div>
											
							            	
							            	<button type="button" class="button remove_slide_button">Remove Slide</button>
						            	</div>
					            	<?php endif;
						            	
					        	}

						?>
						
					</div>
					
					<button type="button" class="button button-primary add_slide_button">Add Slide</button>
					<button type="button" class="button button-primary reset_slide_button">Reset</button>
					
					<input type="hidden" class="slide_values" <?php echo esc_attr($this->link()) ?> value="<?php echo esc_attr( $this->value() ); ?>">
			</div>
			<?php
		}
	}
	
    // SLIDER PANEL
    $wp_customize->add_panel( 'revive_slider_panel', array(
        'priority'       => 35,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => 'Main Slider',
    ) );
    
    $wp_customize->add_section(
	    'revive_upload_section',
	    array(
	        'title'     => __('Upload Images','revive'),
	        'priority'  => 30,
	        'panel'		=> 'revive_slider_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'revive_upload_slides',
		array(
			'default'	=> '',
			'sanitize_callback'	=> 'sanitize_text_field'
			
		)
	);

	$wp_customize->add_control(
		new RT_Slider_Custom_Control_Class( $wp_customize,
			'revive_upload_slides', array(
				'label'		=> __('Upload Images in the Slider', 'revive'),
				'settings'	=> 'revive_upload_slides',
				'section'	=> 'revive_upload_section',
				'priority'	=> 20,
			)
		)
	);

    $wp_customize->add_section(
        'revive_sec_slider_options',
        array(
            'title'     => 'Enable/Disable',
            'priority'  => 0,
            'panel'     => 'revive_slider_panel'
        )
    );


    $wp_customize->add_setting(
        'revive_main_slider_enable',
        array( 
        'default'			=> false,
        'sanitize_callback' => 'revive_sanitize_checkbox' )
    );

    $wp_customize->add_control(
        'revive_main_slider_enable', array(
            'settings' => 'revive_main_slider_enable',
            'label'    => __( 'Enable Slider on Home/Blog.', 'revive' ),
            'section'  => 'revive_sec_slider_options',
            'type'     => 'checkbox',
        )
    );

    $wp_customize->add_setting(
        'revive_main_slider_enable_front',
        array( 
        'default'			=> false,
        'sanitize_callback' => 'revive_sanitize_checkbox' )
    );

    $wp_customize->add_control(
        'revive_main_slider_enable_front', array(
            'settings' => 'revive_main_slider_enable_front',
            'label'    => __( 'Enable Slider on front page.', 'revive' ),
            'section'  => 'revive_sec_slider_options',
            'type'     => 'checkbox',
        )
    );

    $wp_customize->add_setting(
        'revive_main_slider_enable_posts',
        array( 
        'default'			=> false,
        'sanitize_callback' => 'revive_sanitize_checkbox' )
    );

    $wp_customize->add_control(
        'revive_main_slider_enable_posts', array(
            'settings' => 'revive_main_slider_enable_posts',
            'label'    => __( 'Enable Slider on All Posts.', 'revive' ),
            'section'  => 'revive_sec_slider_options',
            'type'     => 'checkbox',
        )
    );

    $wp_customize->add_setting(
        'revive_main_slider_enable_pages',
        array( 
        'default'			=> false,
        'sanitize_callback' => 'revive_sanitize_checkbox' )
    );

    $wp_customize->add_control(
        'revive_main_slider_enable_pages', array(
            'settings' => 'revive_main_slider_enable_pages',
            'label'    => __( 'Enable Slider on All Pages.', 'revive' ),
            'section'  => 'revive_sec_slider_options',
            'type'     => 'checkbox',
        )
    );

    


    $wp_customize->add_setting(
        'revive_main_slider_priority',
        array(
            'default' => 10,
            'sanitize_callback' => 'revive_sanitize_positive_number',
        )
    );

    $wp_customize->add_control(
        'revive_main_slider_priority', array(
            'settings' => 'revive_main_slider_priority',
            'label'    => __( 'Priority' ,'revive'),
            'section'  => 'revive_sec_slider_options',
            'type'     => 'number',
            'description' => __('Elements with Low Value of Priority will appear first.','revive'),

        )
    );



    //Slider Config
    $wp_customize->add_section(
        'revive_slider_config',
        array(
            'title'     => __('Configure Slider','revive'),
            'priority'  => 0,
            'panel'     => 'revive_slider_panel'
        )
    );

    $wp_customize->add_setting(
        'revive_slider_pause',
        array(
            'default' => 5000,
            'sanitize_callback' => 'revive_sanitize_positive_number'
        )
    );

    $wp_customize->add_control(
        'revive_slider_pause', array(
            'settings' => 'revive_slider_pause',
            'label'    => __( 'Time Between Each Slide.' ,'revive'),
            'section'  => 'revive_slider_config',
            'type'     => 'number',
            'description' => __('Value in Milliseconds. Set to 0, to disable Autoplay. Default: 5000.','revive'),

        )
    );

    $wp_customize->add_setting(
        'revive_slider_speed',
        array(
            'default' => 500,
            'sanitize_callback' => 'revive_sanitize_positive_number'
        )
    );

    $wp_customize->add_control(
        'revive_slider_speed', array(
            'settings' => 'revive_slider_speed',
            'label'    => __( 'Animation Speed.' ,'revive'),
            'section'  => 'revive_slider_config',
            'type'     => 'number',
            'description' => __('Value in Milliseconds. Default: 500.','revive'),

        )
    );


    $wp_customize->add_setting(
        'revive_slider_pager',
        array(
            'default' => false,
            'sanitize_callback' => 'revive_sanitize_checkbox'
        )
    );

    $wp_customize->add_control(
        'revive_slider_pager', array(
            'settings' => 'revive_slider_pager',
            'label'    => __( 'Enable Pager.' ,'revive'),
            'section'  => 'revive_slider_config',
            'type'     => 'checkbox',
            'description' => __('Pager is the Circles at the bottom, which represent current slide.','revive'),
        )
    );

    $wp_customize->add_setting(
        'revive_slider_arrow',
        array(
            'default' => false,
            'sanitize_callback' => 'revive_sanitize_checkbox'
        )
    );

    $wp_customize->add_control(
        'revive_slider_arrow', array(
            'settings' => 'revive_slider_arrow',
            'label'    => __( 'Enable Right/Left Navigation Arrows.' ,'revive'),
            'section'  => 'revive_slider_config',
            'type'     => 'checkbox',
        )
    );

    $wp_customize->add_setting(
        'revive_slider_autoplay',
        array(
            'default' => false,
            'sanitize_callback' => 'revive_sanitize_checkbox'
        )
    );

    $wp_customize->add_control(
        'revive_slider_autoplay', array(
            'settings' => 'revive_slider_autoplay',
            'label'    => __( 'Disable Slider Autoplay.' ,'revive'),
            'section'  => 'revive_slider_config',
            'type'     => 'checkbox',
        )
    );

    $wp_customize->add_setting(
        'revive_slider_fullwidth',
        array(
            'default' => false,
            'sanitize_callback' => 'revive_sanitize_checkbox'
        )
    );

    $wp_customize->add_control(
        'revive_slider_fullwidth', array(
            'settings' => 'revive_slider_fullwidth',
            'label'    => __( 'Enable Full-Width Slider.' ,'revive'),
            'section'  => 'revive_slider_config',
            'type'     => 'checkbox',
        )
    );


    $wp_customize->add_setting(
        'revive_slider_effect',
        array(
            'default' => 'fade',
            'sanitize_callback' => 'revive_sanitize_text'
        )
    );

    $earray=array('fade','slide', 'coverflow', 'flip');
    $earray = array_combine($earray, $earray);

    $wp_customize->add_control(
        'revive_slider_effect', array(
        'settings' => 'revive_slider_effect',
        'label'    => __( 'Slider Animation Effect.' ,'revive'),
        'section'  => 'revive_slider_config',
        'type'     => 'select',
        'choices' => $earray,
    ) );
    
}
add_action('customize_register', 'revive_customize_register_slider');