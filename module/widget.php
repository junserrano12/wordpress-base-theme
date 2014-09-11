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

	public function widget( $args, $instance ) {
		
		echo '<div id="cta-container">';		
		get_template_part('template','cta');		
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

/* Register and load the widget */
function basetheme_load_widget() {
	register_widget( 'basetheme_content_widget' );	
	register_widget( 'basetheme_splash_screen_widget' );
	register_widget( 'basetheme_cta_widget' );
	register_widget( 'basetheme_gatranslate_widget' ); 
	register_widget( 'basetheme_main_menu_widget' ); 
	register_widget( 'basetheme_bpg_widget' );
	register_widget( 'basetheme_social_media_widget' );	
}
add_action( 'widgets_init', 'basetheme_load_widget' );

/*end of widget*/
?>