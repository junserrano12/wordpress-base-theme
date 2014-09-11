<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<header class="post-entry-header">
		<h2><?php the_title(); ?></h2>
	</header><!-- .entry-header -->
	
	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	
	<div class="post-entry-content post-entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	
	<?php else : ?>
	
	<div class="post-entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'basetheme' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'basetheme' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	
	<?php endif; ?>
	
	<footer class="post-entry-footer">
		<?php edit_post_link( 'edit', '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
		
</div><!-- #post -->
