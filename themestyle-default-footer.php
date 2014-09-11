						</div><!-- #primary-main -->
						<div id="primary-footer">
						</div>
					</div><!-- #primary -->
				</div><!-- .content -->
				<?php if ( is_active_sidebar( 'main-container-bottom-widget-container' ) ) { dynamic_sidebar( 'main-container-bottom-widget-container' ); } ?>
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
					<?php if ( is_active_sidebar( 'footer-container-content-widget-container' ) ) { dynamic_sidebar( 'footer-container-content-widget-container' ); } ?>
				</div>
			</div>
		</footer>