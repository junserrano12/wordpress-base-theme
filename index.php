<?php get_header(); ?>
	<div id="page-index" <?php post_class(); ?>>
		<header class="entry-header">
			<h1 class="entry-title"><?php echo get_settings_option('hotelname', 'general_option'); ?></h1>
		</header>
		
		<div class="entry-content">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
				<?php endwhile; ?>
			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>
		</div>
		
		<footer class="entry-footer">
			<?php get_template_part('content', 'footer'); ?>
		</footer>
	</div>
<?php get_footer(); ?>