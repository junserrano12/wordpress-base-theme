<div id="sidebar-container">
	<div id="cta-container">
		<?php get_template_part('template', 'cta'); ?>
	</div>
	<div id="widget-container">
		<?php if ( is_active_sidebar( 'right-sidebar' ) ) { dynamic_sidebar( 'right-sidebar' ); } ?>
	</div>
</div>
