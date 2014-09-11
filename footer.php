		<?php get_footer_themestyle(); ?>
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