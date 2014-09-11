<?php if ( is_active_sidebar( 'google-translate-top-widget-container' ) ) : ?>
	<?php dynamic_sidebar( 'google-translate-top-widget-container' ); ?>
<?php endif; ?>	
<div class="content">
	<?php if ( is_active_sidebar( 'google-translate-content-top-widget-container' ) ) : ?>
		<?php dynamic_sidebar( 'google-translate-content-top-widget-container' ); ?>
	<?php endif; ?>	
	<div id="google_translate_element" class="translate"></div>
	<?php if ( is_active_sidebar( 'google-translate-content-bottom-widget-container' ) ) : ?>
		<?php dynamic_sidebar( 'google-translate-content-bottom-widget-container' ); ?>
	<?php endif; ?>
</div>
<?php if ( is_active_sidebar( 'google-translate-bottom-widget-container' ) ) : ?>
	<?php dynamic_sidebar( 'google-translate-bottom-widget-container' ); ?>
<?php endif; ?>