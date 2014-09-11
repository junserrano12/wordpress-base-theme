	<header id="header">
		<div id="header-container">
			<?php if ( is_active_sidebar( 'header-container-top-widget-container' ) ) { dynamic_sidebar( 'header-container-top-widget-container' ); } ?>
			<div class="content">
				<?php if ( is_active_sidebar( 'header-container-content-top-widget-container' ) ) { dynamic_sidebar( 'header-container-content-top-widget-container' ); } ?>
				<div id="logo-container">
					<?php get_template_part('template', 'logo'); ?>
				</div>
				<?php if ( is_active_sidebar( 'header-container-content-bottom-widget-container' ) ) { dynamic_sidebar( 'header-container-content-bottom-widget-container' ); } ?>
			</div>
			<?php if ( is_active_sidebar( 'header-container-bottom-widget-container' ) ) { dynamic_sidebar( 'header-container-bottom-widget-container' ); } ?>
		</div>
	</header>
	<div id="slider-container">
		<?php if ( is_active_sidebar( 'slider-container-top-widget-container' ) ) { dynamic_sidebar( 'slider-container-top-widget-container' ); } ?>
		<div class="slider-content">
			<?php get_template_part('template', 'slider'); ?>
		</div>
		<?php if ( is_active_sidebar( 'slider-container-bottom-widget-container' ) ) { dynamic_sidebar( 'slider-container-bottom-widget-container' ); } ?>
	</div>	
	<section id="main">
		<div id="main-container">
			<?php if ( is_active_sidebar( 'main-container-top-widget-container' ) ) { dynamic_sidebar( 'main-container-top-widget-container' ); } ?>
			<div class="content">
				<div id="primary">
					<div id="primary-header">
					</div>
					<div id="primary-main">