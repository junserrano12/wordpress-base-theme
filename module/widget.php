<?php 

class basetheme_content_widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'basetheme_content_widget', 
			__('Content', 'basetheme'),
			array( 'description' => __( 'Add Content', 'basetheme' ), )
		);
	}

	public function widget( $args, $instance ) {
		$content = isset($instance['content']) ? $instance['content'] : '';
		
		echo the_secondary_content($content);	
	}
			
	public function form( $instance ) {
		
		$content = isset($instance['content']) ? $instance['content'] : '';
		?>
		<label for="<?php echo $this->get_field_id( 'content' ); ?>"><?php _e( 'Content:' ); ?></label> 
		<textarea class="textarea-editor widefat" rows="5" id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>"><?php echo esc_attr( $content ); ?></textarea>
		<a href="#<?php echo $this->get_field_id( 'content' ); ?>" class="button button-upload-media-item">Add/Upload Media</a>
		<?php 

	}
		
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['content'] = ( ! empty( $new_instance['content'] ) ) ? $new_instance['content'] : '';
		return $instance;
	}
}


class basetheme_splash_screen_widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'basetheme_splash_screen_widget', 
			__('Splash Page', 'basetheme'),
			array( 'description' => __( 'Add Splash Page', 'basetheme' ), ) 
		);
	}

	public function widget( $args, $instance ) {
		$title = isset($instance['title']) ? $instance['title'] : '';
		$content = isset($instance['content']) ? $instance['content'] : '';
		
		if (is_front_page() || is_home()){
			echo '<div class="hide">';		
			echo '	<div id="splash-container">';
			echo '		<div class="splash-content">';
			echo '			<h2 class="align-center title">'.$title.'</h2>';
			echo the_secondary_content($content);
			echo '		</div>';
			echo '	</div>';
			echo '</div>';
			echo '<script>';
			echo '	var jq = jQuery.noConflict();';	
			echo '	jq(document).ready(function(){';
			echo ' 		jq.colorbox({inline:true, width:"auto", href:"#splash-container"});';
			echo '	});';
			echo '</script>';
		}
	}
			
	public function form( $instance ) {
		
		$title = isset($instance['title']) ? $instance['title'] : 'Title';
		$content = isset($instance['content']) ? $instance['content'] : '';
		?>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">

		<label for="<?php echo $this->get_field_id( 'content' ); ?>"><?php _e( 'Content:' ); ?></label> 
		<textarea class="textarea-editor widefat" rows="5" id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>"><?php echo $content; ?></textarea>
		<a href="#<?php echo $this->get_field_id( 'content' ); ?>" class="button button-upload-media-item">Add/Upload Media</a>
		<?php 

	}
		
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? $new_instance['title'] : '';
		$instance['content'] = ( ! empty( $new_instance['content'] ) ) ? $new_instance['content'] : '';
		return $instance;
	}
}

class basetheme_social_media_widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'basetheme_social_media_widget', 
			__('Social Media', 'basetheme'),
			array( 'description' => __( 'Add Social Media Icons', 'basetheme' ), ) 
		);
	}

	public function widget( $args, $instance ) {
		
		echo '<div id="social-media-container">';		
		get_template_part('template','social');		
		echo '</div>';

	}
			
	public function form( $instance ) {
	}
		
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
}

class basetheme_cta_widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'basetheme_cta_widget', 
			__('Cta', 'basetheme'),
			array( 'description' => __( 'Add Cta Button', 'basetheme' ), ) 
		);
	}

	public function widget( $args, $instance ) { ?>
		<div id="cta-container">
			<?php if ( is_active_sidebar( 'cta-container-top-widget-container' ) ) { dynamic_sidebar( 'cta-container-top-widget-container' ); } ?>
			<div class="content">
				<div class="cta">				
				<?php if(get_settings_option('ctaiscalendar', 'style_option')){ ?>
				
					<form id="booking" class="courier" method="POST" action="http://reservations.directwithhotels.com/reservation/processDates/<?php echo get_settings_option('hotelid', 'general_option'); ?>/">
						<?php if(!get_settings_option('removectaheader', 'style_option')){ ?>
						<div class="control-wrapper cta-title-container">
							<?php if(get_settings_option('bpgisenable', 'style_option')){ ?>
							<h3>
								<a class="colorbox-inline bpglinksmall" href="#bpgmodal"><span class="bpgcheck"></span>Best Price Guarantee</a>
								<a class="bpgtip"><div id="bpgtipcontent"><span><?php echo get_settings_option('hotelname', 'general_option'); ?> promises its customers that by booking directly, you are getting the best deal online. If you have a confirmed direct online booking with <?php echo get_settings_option('hotelname', 'general_option'); ?> and find a cheaper price for the same offer within 24 hours on another website, we will match that price.</span></div></a>
							</h3>					
							<?php } else { ?>
								<h3>Easy Booking at Low Rates</h3>
							<?php } ?>
						</div>
						<?php } ?>
						<?php if(get_settings_option('ctaiscalendarcorpsite', 'style_option')){ ?>
						<div class="control-wrapper cta-calendar-container">
							<div class="calendar-select">
								<select id="select-hotel" class="text_reserve">
									<option value="select"><?php echo 'Choose a Property'; ?></option>
									<?php 
									$hotelnames = explode("\n", get_settings_option('hotelnames', 'general_option'));
									$hotelids = explode("\n", get_settings_option('hotelids', 'general_option'));
									foreach($hotelnames as $key=>$hotelname){
										echo '<option value="'.trim($hotelids[$key], "\r").'">'.trim($hotelname, "\r").'</option>';
									}						
									?>
								</select>
							</div>
						</div>
						<?php } ?>
						<div class="control-wrapper cta-calendar-container">
							<span class="calendar-label">Check In:</span>
							<div class="calendar-input">
								<input gtbfieldid="5" class="text_reserve inputDate" id="inputDate" name="arrival" value="" type="text" readonly>
								<input class="text_reserve" id="arrival_date" name="arrival_date" value="" type="hidden">
							</div>
						</div>

						<div class="control-wrapper cta-calendar-container">
							<span class="calendar-label">Check Out:</span>
							<div class="calendar-input">
								<input gtbfieldid="6" class="text_reserve inputDate2" id="inputDate" name="departure" value="" type="text" readonly>
								<input class="text_reserve" id="departure_date" name="departure_date" value="" type="hidden">
							</div>
						</div>

						<div class="control-wrapper cta-button-container">
							<input class="button ctabutton" type="submit" value="Check availability and prices">
						</div>
						<?php if(!get_settings_option('ctaiscalendarcorpsite', 'style_option')){ ?>
						<div class="control-wrapper cta-moc-container">
							<p><a class="ctamodify" href="http://reservations.directwithhotels.com/reservation/modifyCancelPage/<?php echo get_settings_option('hotelid', 'general_option'); ?>">Modify or Cancel</a> your reservation</p>
						</div>
						<?php } ?>
					</form>

				<?php } else { ?>

					<?php if(!get_settings_option('removectaheader', 'style_option')){ ?>
					<div class="control-wrapper cta-title-container">
						<?php if(get_settings_option('bpgisenable', 'style_option')){ ?>
							<h3>
								<a class="colorbox-inline bpglinksmall" href="#bpgmodal"><span class="bpgcheck"></span>Best Price Guarantee</a>
								<a class="bpgtip"><div id="bpgtipcontent"><span><?php echo get_settings_option('hotelname', 'general_option'); ?> promises its customers that by booking directly, you are getting the best deal online. If you have a confirmed direct online booking with <?php echo get_settings_option('hotelname', 'general_option'); ?> and find a cheaper price for the same offer within 24 hours on another website, we will match that price.</span></div></a>
							</h3>
						<?php } else { ?>
							<h3>Easy Booking at Low Rates</h3>
						<?php } ?>
					</div>
					<?php } ?>
					
					<div class="control-wrapper cta-button-container">
						<a class="button ctabutton" href="http://reservations.directwithhotels.com/reservation/selectDates/<?php echo get_settings_option('hotelid', 'general_option'); ?>">Check availability and prices</a>
					</div>
					
					<?php if(!get_settings_option('ctaiscalendarcorpsite', 'style_option')){ ?>
					<div class="control-wrapper cta-moc-container">
						<p><a class="ctamodify" href="http://reservations.directwithhotels.com/reservation/modifyCancelPage/<?php echo get_settings_option('hotelid', 'general_option'); ?>">Modify or Cancel</a> your reservation</p>
					</div>
					<?php } ?>

				<?php } ?>

				</div>
			</div>
			<?php if ( is_active_sidebar( 'cta-container-bottom-widget-container' ) ) { dynamic_sidebar( 'cta-container-bottom-widget-container' ); } ?>	
		</div> 

	<?php /*end of cta*/
	}
			
	public function form( $instance ) {
	}
		
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
}

class basetheme_gatranslate_widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'basetheme_gatranslate_widget', 
			__('Google Translate', 'basetheme'),
			array( 'description' => __( 'Add Google Translate', 'basetheme' ), ) 
		);
	}

	public function widget( $args, $instance ) {
		
		echo '<div id="google-translate-container">';
		get_template_part('template','gatranslate');
		echo '</div>';

	}
			
	public function form( $instance ) {
	}
		
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
	
}  

class basetheme_main_menu_widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'basetheme_main_menu_widget', 
			__('Main Menu', 'basetheme'),
			array( 'description' => __( 'Add Main Menu Navigation', 'basetheme' ), ) 
		);
	}

	public function widget( $args, $instance ) {
		
		echo '<div id="main-menu-container">';
		get_template_part('template','menu');
		echo '</div>';

	}
			
	public function form( $instance ) {
	}
		
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
	
}  

class basetheme_bpg_widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'basetheme_bpg_widget', 
			__('Best Price Guarantee', 'basetheme'),
			array( 'description' => __( 'Add Best Price Guarantee Logo', 'basetheme' ), )
		);
	}

	public function widget( $args, $instance ) {
		
		echo '<div id="bpg-container">';
		echo ' <a class="colorbox-inline bpglink" href="#bpgmodal"></a>'; 
		echo '</div>';

	}
			
	public function form( $instance ) {
	}
		
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
	
}  

class basetheme_dynamic_cta_widget extends WP_Widget {
	function __construct() {

		parent::__construct(
			'basetheme_dynamic_cta_widget', 
			__('Dynamic Cta', 'basetheme'),
			array( 'description' => __( 'Add Dynamic Cta Button', 'basetheme' ) )
		);
	}

	public function widget( $args, $instance ) {
		$title = $instance['title']; 
		$ctalabel = $instance['ctalabel']; 
		$isbpg = $instance['isbpg'];
		$iscalendar = $instance['iscalendar'];
		$iscorpsite = $instance['iscorpsite']; ?>

		<div id="cta-container">
			<?php if ( is_active_sidebar( 'cta-container-top-widget-container' ) ) { dynamic_sidebar( 'cta-container-top-widget-container' ); } ?>
			<div class="content">
				<div class="cta">				
				<?php if($iscalendar){ ?>

					<form id="booking" class="courier" method="POST" action="http://reservations.directwithhotels.com/reservation/processDates/<?php echo get_settings_option('hotelid', 'general_option'); ?>/">
						
						<?php if(!$title != '' || $title != null){ ?>
						<div class="control-wrapper cta-title-container">
							<?php if($isbpg){ ?>
							<h3>
								<a class="colorbox-inline bpglinksmall" href="#bpgmodal"><span class="bpgcheck"></span><?php echo $title; ?></a>
								<a class="bpgtip"><div id="bpgtipcontent"><span><?php echo get_settings_option('hotelname', 'general_option'); ?> promises its customers that by booking directly, you are getting the best deal online. If you have a confirmed direct online booking with <?php echo get_settings_option('hotelname', 'general_option'); ?> and find a cheaper price for the same offer within 24 hours on another website, we will match that price.</span></div></a>
							</h3>					
							<?php } else { ?>
								<h3><?php echo $title; ?></h3>
							<?php } ?>
						</div>
						<?php } ?>

						<?php if($iscorpsite){ ?>
						<div class="control-wrapper cta-calendar-container">
							<div class="calendar-select">
								<select id="select-hotel" class="text_reserve">
									<option value="select"><?php echo 'Choose a Property'; ?></option>
									<?php 
									$hotelnames = explode("\n", get_settings_option('hotelnames', 'general_option'));
									$hotelids = explode("\n", get_settings_option('hotelids', 'general_option'));
									foreach($hotelnames as $key=>$hotelname){
										echo '<option value="'.trim($hotelids[$key], "\r").'">'.trim($hotelname, "\r").'</option>';
									}						
									?>
								</select>
							</div>
						</div>
						<?php } ?>

						<div class="control-wrapper cta-calendar-container">
							<span class="calendar-label">Check In:</span>
							<div class="calendar-input">
								<input gtbfieldid="5" class="text_reserve inputDate" id="inputDate" name="arrival" value="" type="text" readonly>
								<input class="text_reserve" id="arrival_date" name="arrival_date" value="" type="hidden">
							</div>
						</div>

						<div class="control-wrapper cta-calendar-container">
							<span class="calendar-label">Check Out:</span>
							<div class="calendar-input">
								<input gtbfieldid="6" class="text_reserve inputDate2" id="inputDate" name="departure" value="" type="text" readonly>
								<input class="text_reserve" id="departure_date" name="departure_date" value="" type="hidden">
							</div>
						</div>

						<div class="control-wrapper cta-button-container">
							<input class="button ctabutton" type="submit" value="<?php echo $ctalabel; ?>">
						</div>

						<?php if(!$iscorpsite){ ?>
						<div class="control-wrapper cta-moc-container">
							<p><a class="ctamodify" href="http://reservations.directwithhotels.com/reservation/modifyCancelPage/<?php echo get_settings_option('hotelid', 'general_option'); ?>">Modify or Cancel</a> your reservation</p>
						</div>
						<?php } ?>

					</form>

				<?php } else { ?>

					<?php if($title != '' || $title != null){ ?>
					<div class="control-wrapper cta-title-container">
						<?php if($isbpg){ ?>
							<h3>
								<a class="colorbox-inline bpglinksmall" href="#bpgmodal"><span class="bpgcheck"></span><?php echo $title; ?></a>
								<a class="bpgtip"><div id="bpgtipcontent"><span><?php echo get_settings_option('hotelname', 'general_option'); ?> promises its customers that by booking directly, you are getting the best deal online. If you have a confirmed direct online booking with <?php echo get_settings_option('hotelname', 'general_option'); ?> and find a cheaper price for the same offer within 24 hours on another website, we will match that price.</span></div></a>
							</h3>
						<?php } else { ?>
							<h3><?php echo $title; ?></h3>
						<?php } ?>
					</div>
					<?php } ?>
					
					<div class="control-wrapper cta-button-container">
						<a class="button ctabutton" href="http://reservations.directwithhotels.com/reservation/selectDates/<?php echo get_settings_option('hotelid', 'general_option'); ?>"><?php echo $ctalabel; ?></a>
					</div>
					
					<?php if(!$iscorpsite){ ?>
					<div class="control-wrapper cta-moc-container">
						<p><a class="ctamodify" href="http://reservations.directwithhotels.com/reservation/modifyCancelPage/<?php echo get_settings_option('hotelid', 'general_option'); ?>">Modify or Cancel</a> your reservation</p>
					</div>
					<?php } ?>

				<?php } ?>

				</div>
			</div>
			<?php if ( is_active_sidebar( 'cta-container-bottom-widget-container' ) ) { dynamic_sidebar( 'cta-container-bottom-widget-container' ); } ?>	
		</div> 

		<?php if($isbpg){ ?>
		<div id="bpgmodal-container" class="hide">
			<div id="bpgmodal">
				<div class="content">
					<h2 class="align-center">Best Price Guarantee Terms &amp; Conditions</h2>
					<div class="bpgmodal-content">
						<?php echo get_bpg_content(get_settings_option('termsandcondition', 'general_option')); ?>
					</div>
					<div class="align-center"><a class="button ctalink" href="http://reservations.directwithhotels.com/reservation/selectDates/<?php echo get_settings_option('hotelid', 'general_option'); ?>/campaign/">Check availability and prices</a></div>
				</div>
			</div>	
		</div>
		<?php } ?>

	<?php /*end of cta*/
	}
			
	public function form( $instance ) {
		$title = isset($instance['title']) ? $instance['title'] : 'Easy Booking at Low Rates';
		$ctalabel = isset($instance['ctalabel']) ? $instance['ctalabel'] : 'Check availability and prices';
		$isbpg = isset($instance['isbpg']) ? $instance['isbpg'] : 0;
		$iscalendar = isset($instance['iscalendar']) ? $instance['iscalendar'] : 0;
		$iscorpsite = isset($instance['iscorpsite']) ? $instance['iscorpsite'] : 0;
		?>
		<div class="control-wrapper">
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</div>
		<div class="control-wrapper">
			<label for="<?php echo $this->get_field_id( 'ctalabel' ); ?>"><?php _e( 'Cta Label' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'ctalabel' ); ?>" name="<?php echo $this->get_field_name( 'ctalabel' ); ?>" type="text" value="<?php echo esc_attr( $ctalabel ); ?>">
		</div>
		<div class="control-wrapper">
			<input class="checkbox" id="<?php echo $this->get_field_id( 'isbpg' ); ?>" name="<?php echo $this->get_field_name( 'isbpg' ); ?>" type="checkbox" value="<?php echo esc_attr($isbpg); ?>" <?php echo ($isbpg) ? 'checked' : null; ?>>
			<label for="<?php echo $this->get_field_id( 'isbpg' ); ?>"><?php _e( 'Best Price Guarantee' ); ?></label> 
		</div>
		<div class="control-wrapper">
			<input class="checkbox" id="<?php echo $this->get_field_id( 'iscalendar' ); ?>" name="<?php echo $this->get_field_name( 'iscalendar' ); ?>" type="checkbox" value="<?php echo esc_attr($iscalendar); ?>" <?php echo ($iscalendar) ? 'checked' : null; ?>>
			<label for="<?php echo $this->get_field_id( 'iscalendar' ); ?>"><?php _e( 'Calendar' ); ?></label> 
		</div>
		<div class="control-wrapper">
			<input class="checkbox" id="<?php echo $this->get_field_id( 'iscorpsite' ); ?>" name="<?php echo $this->get_field_name( 'iscorpsite' ); ?>" type="checkbox" value="<?php echo esc_attr($iscorpsite); ?>" <?php echo ($iscorpsite) ? 'checked' : null; ?>>
			<label for="<?php echo $this->get_field_id( 'iscorpsite' ); ?>"><?php _e( 'Corporate Site' ); ?></label> 
		</div>
		<?php 
	}
		
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? $new_instance['title'] : 'Easy Booking at Low Rates';
		$instance['ctalabel'] = ( ! empty( $new_instance['ctalabel'] ) ) ? $new_instance['ctalabel'] : 'Check availability and prices';
		$instance['isbpg'] = ( ! empty( $new_instance['isbpg'] ) ) ? $new_instance['isbpg'] : 0;
		$instance['iscalendar'] = ( ! empty( $new_instance['iscalendar'] ) ) ? $new_instance['iscalendar'] : 0;
		$instance['iscorpsite'] = ( ! empty( $new_instance['iscorpsite'] ) ) ? $new_instance['iscorpsite'] : 0;
		return $instance;
	}
}



/* Register and load the widget */
function basetheme_load_widget() {
	register_widget( 'basetheme_content_widget' );	
	register_widget( 'basetheme_splash_screen_widget' );
	register_widget( 'basetheme_cta_widget' );
	register_widget( 'basetheme_dynamic_cta_widget' );
	
	register_widget( 'basetheme_gatranslate_widget' ); 
	register_widget( 'basetheme_main_menu_widget' ); 
	register_widget( 'basetheme_bpg_widget' );
	register_widget( 'basetheme_social_media_widget' );	
}
add_action( 'widgets_init', 'basetheme_load_widget' );

/*end of widget*/
?>