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
						<div class="row-fluid">
							<div class="span4">
								<div id="footer-logo-container">
									<?php get_template_part('template', 'logo'); ?>
								</div>
							</div>
							<div class="span2">
								<div id="secondary-menu-container">
									<h4>Quick Links</h4>
									<?php get_template_part('template', 'secondary'); ?>
								</div>
							</div>
							<div class="span4">
								<div id="copyright-container">		
									<h4>Contact</h4>
									<?php get_template_part('template', 'footer-address'); ?>
									<?php get_template_part('template', 'copyright'); ?>
								</div>
							</div>
							<div class="span2">
								<div id="social-media-container">
									<h4>Follow Us</h4>
									<?php get_template_part('template', 'social'); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</footer>
		</div><!-- #main-footer-container -->