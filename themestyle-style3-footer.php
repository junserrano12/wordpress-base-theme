								</div><!-- #primary-main -->							
							</div><!-- #primary -->							
						</div><!-- #primary-sidebar-container -->
						<div id="secondary">
							<div id="secondary-main">
								<?php the_secondary_content(get_post_meta($post->ID, 'secondary-content-container', true)); ?>
							</div>
						</div>
					</div><!-- .content -->
				</div><!-- #main-container -->
			</section><!-- #main -->
			<footer id="footer">
				<div id="footer-container">
					<div class="content">
						<?php if ( is_active_sidebar( 'footer-container-content-widget-container' ) ) { dynamic_sidebar( 'footer-container-content-widget-container' ); } ?>
					</div>
				</div>
			</footer>
		</div><!-- #main-footer-container -->