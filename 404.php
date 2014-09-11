<?php get_header(); ?>
	<div id="page-404" <?php post_class(); ?>>
		<header class="entry-header">
			<?php get_template_part('content', 'header'); ?>
		</header>
			
		<div class="entry-content">
			<?php get_search_form(); ?>
		</div>
			
		<footer class="entry-footer">
			<?php get_template_part('content', 'footer'); ?>
		</footer>
	</div>
<?php get_footer(); ?>