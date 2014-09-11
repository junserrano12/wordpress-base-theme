<nav id="social-media">
	<ul class="list-social-media">
		<?php if ( get_settings_option('facebook', 'general_option') != null ) { ?>
		<li><a target="_blank" href="<?php echo get_settings_option('facebook', 'general_option'); ?>" class="facebook-icon"></a></li>		
		<?php } ?>

		<?php if ( get_settings_option('twitter', 'general_option') != null ) { ?>
		<li><a target="_blank" href="<?php echo get_settings_option('twitter', 'general_option'); ?>" class="twitter-icon"></a></li>
		<?php } ?>

		<?php if ( get_settings_option('googleplus', 'general_option') != null ) { ?>
		<li><a target="_blank" href="<?php echo get_settings_option('googleplus', 'general_option'); ?>" class="googleplus-icon"></a></li>
		<?php } ?>

		<?php if ( get_settings_option('tripadvisor', 'general_option') != null ) { ?>
		<li><a target="_blank" href="<?php echo get_settings_option('tripadvisor', 'general_option'); ?>" class="tripadvisor-icon"></a></li>
		<?php } ?>

		<?php if ( get_settings_option('instagram', 'general_option') != null ) { ?>
		<li><a target="_blank" href="<?php echo get_settings_option('instagram', 'general_option'); ?>" class="instagram-icon"></a></li>
		<?php } ?>

		<?php if ( get_settings_option('pinterest', 'general_option') != null ) { ?>
		<li><a target="_blank" href="<?php echo get_settings_option('pinterest', 'general_option'); ?>" class="pinterest-icon"></a></li>
		<?php } ?>
		
		<?php if ( get_settings_option('tumblr', 'general_option') != null ) { ?>
		<li><a target="_blank" href="<?php echo get_settings_option('tumblr', 'general_option'); ?>" class="tumblr-icon"></a></li>
		<?php } ?>

		<?php if ( get_settings_option('foursquare', 'general_option') != null ) { ?>
		<li><a target="_blank" href="<?php echo get_settings_option('foursquare', 'general_option'); ?>" class="foursquare-icon"></a></li>
		<?php } ?>
		
		<?php if ( get_settings_option('youtube', 'general_option') != null ) { ?>
		<li><a target="_blank" href="<?php echo get_settings_option('youtube', 'general_option'); ?>" class="youtube-icon"></a></li>
		<?php } ?>

		<?php if ( get_settings_option('linkedin', 'general_option') != null ) { ?>
		<li><a target="_blank" href="<?php echo get_settings_option('linkedin', 'general_option'); ?>" class="linkedin-icon"></a></li>
		<?php } ?>


	</ul>
</nav>
