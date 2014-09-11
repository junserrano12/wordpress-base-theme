<?php if ( is_active_sidebar( 'logo-container-top-widget-container' ) ) { dynamic_sidebar( 'logo-container-top-widget-container' ); } ?>

<?php if ( get_settings_option( 'logoid', 'general_option' ) != null ) : $logoid = get_settings_option( 'logoid', 'general_option' ); ?>
	<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php echo wp_get_attachment_image_src($logoid, 'full')[0]; ?>" title="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>" alt="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>" >
	</a>				
<?php else : ?>
	<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
		<img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" >
	</a>
<?php endif; ?>

<?php if ( is_active_sidebar( 'logo-container-bottom-widget-container' ) ) { dynamic_sidebar( 'logo-container-bottom-widget-container' ); } ?>
