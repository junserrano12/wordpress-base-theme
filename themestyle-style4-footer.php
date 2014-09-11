							</div><!-- .content -->
						</div><!-- #primary-main -->	
						<div id="primary-footer"></div>
					</div><!-- #primary -->		
				</div><!-- #main-container -->
			</section><!-- #main -->
			<footer id="footer">
				<div id="footer-container">
					<div id="footer-main">
						<div class="content">
							<?php if ( is_active_sidebar( 'footer-container-content-widget-container' ) ) { dynamic_sidebar( 'footer-container-content-widget-container' ); } ?>
						</div>
					</div>
					<div id="footer-bottom">
						<div class="content">
							<div id="copyright-container">		
								<?php get_template_part('template', 'footer-address'); ?>
								<?php get_template_part('template', 'copyright'); ?>
							</div>								
						</div>
					</div>
				</div>
			</footer>
		</div><!-- #main-footer-container -->