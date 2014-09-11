<?php
	/*Template Name: Home Full Page Background Template*/
?>
<!DOCTYPE html>
<!--[if IE 7]><html class="ie ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="ie ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 9]><html class="ie ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!--><html <?php language_attributes(); ?>><!--<![endif]-->

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php echo basetheme_get_meta_robots(); ?>

	<meta name="keywords" content="<?php echo get_post_meta( $post->ID, 'meta_keywords', true ); ?> ">
	<meta name="description" content="<?php echo get_post_meta( $post->ID, 'meta_description', true ); ?> ">
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta property="og:title" content="<?php echo get_settings_option('hotelname','general_option'); ?>" />
	<meta property="og:type" content="hotel" /><!--do not change the property-->
	<meta property="og:description" content="<?php echo get_post_meta( $post->ID, 'meta_description', true ); ?>" /><!--do not change the property-->
	<meta property="og:url" content="http://www.<?php echo get_mapped_domain(); ?>" />
	<meta property="og:site_name" content="<?php echo get_settings_option('hotelname','general_option'); ?>" />
	<meta property="fb:admins" content="1076987014" /><!--do not change the property-->

	<?php if ( get_settings_option( 'googleverification', 'general_option' ) != null ) : echo get_settings_option('googleverification', 'general_option'); endif; ?>
	<?php if ( get_settings_option( 'faviconid', 'general_option' ) != null ) : $faviconid = get_settings_option( 'faviconid', 'general_option'); ?>
	<link rel="shortcut icon" href="<?php echo wp_get_attachment_image_src($faviconid, 'full')[0]; ?>" type="image/x-icon">
	<link rel="icon" href="<?php echo wp_get_attachment_image_src($faviconid, 'full')[0]; ?>" type="image/x-icon"> 
	<?php else : ?>
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" /> 
	<?php endif; ?>
	<?php if ( get_settings_option('publisher', 'general_option') != null || get_settings_option('publisher', 'general_option') != '' ) : ?>
	<link rel="publisher" href="<?php echo get_settings_option( 'publisher', 'general_option'); ?>" >
	<?php endif; ?>
	<?php if ( get_settings_option('getfontfamily', 'style_option') != null || get_settings_option('getfontfamily', 'style_option') != '' ) : ?>
	<?php echo get_settings_option( 'getfontfamily', 'style_option'); ?>
	<?php endif; ?>
	<!--[if IE]><link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico"><![endif]-->
	<link rel="profile" href="http://gmpg.org/xfn/11"/>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<script type="text/javascript">	
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', '<?php echo get_settings_option('gacode', 'general_option'); ?>']);
	_gaq.push(['_setDomainName', '<?php echo get_settings_option('hoteldomain', 'general_option'); ?>']);
	_gaq.push(['_setAllowLinker', true]);
	_gaq.push(['_trackPageview']);
	<?php if(get_settings_option('gacode2', 'general_option') != '' || get_settings_option('gacode2', 'general_option') != null) { ?>
	_gaq.push(['b._setAccount', '<?php echo get_settings_option('gacode2', 'general_option'); ?>'], ['b._trackPageview']);
	<?php } ?>
	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;	
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
	</script>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if ( has_shortcode( $post->post_content, 'get_fblike' ) ) { do_action('insert_fblike_jscode'); } ?>
<?php if ( is_active_sidebar( 'body-top-widget-container' ) ) { dynamic_sidebar( 'body-top-widget-container' ); } ?>
<div id="wrapper-full-page">
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

	<div id="main-footer-container">
		<section id="main">
			<div id="main-container">
				<div class="content">
					<div id="primary">
						<div id="primary-main"> 						
							<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<header class="entry-header">
									<?php get_template_part('content', 'header');?>
								</header>
							
								<div class="entry-content">
									<?php if ( have_posts() ) : ?>				
										<?php while ( have_posts() ) : the_post(); ?>
											<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'basetheme' ) ); ?>
										<?php endwhile; ?>
									<?php endif; ?>
								</div>
									
								<footer class="entry-footer">
									<?php get_template_part('content', 'footer'); ?>
									<?php edit_post_link( 'edit', '<span class="edit-link">', '</span>' ); ?>
								</footer>
							</div>
						</div><!-- #primary-main -->
					</div><!-- #primary -->
				</div><!-- .content -->
			</div><!-- #main-container -->
		</section><!-- #main -->
		<footer id="footer">
			<div id="footer-container">
				<div class="content">
					<div id="secondary-menu-container">
						<?php get_template_part('template', 'secondary')?>
					</div>
					<div id="social-media-container">
						<?php get_template_part('template', 'social')?>
					</div>
				</div>					
				<div class="content">
					<div id="copyright-container">		
						<?php get_template_part('template', 'footer-address'); ?>
						<?php get_template_part('template', 'copyright')?>					
					</div>
				</div>
			</div>
		</footer>
	</div><!-- #main-footer-container -->
</div><!-- #wrapper -->
<?php if(get_settings_option('bpgisenable', 'style_option')){ ?>	
<div id="bpgmodal-container" class="hide">
	<?php get_template_part('template', 'bpgcontent'); ?>
</div>
<?php } ?>	
<?php wp_footer(); ?>
<?php get_template_part('template', 'script'); ?>
</body>
</html>