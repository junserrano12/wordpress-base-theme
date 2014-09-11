<?php
	/*Template Name: Sitemap Template*/
	get_header(); 
?>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<?php get_template_part('content', 'header');?>
		</header>
		<div class="entry-content">
			<?php if ( have_posts() ) : ?>				
				<?php while ( have_posts() ) : the_post(); ?>
					<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'basetheme' ) ); ?>
					<div id="sitemap-container" class="row-fluid">
						<div class="span12">
							<ul>
							<?php 
								$pagesitemap = get_page_by_title('Sitemap');
								$excludeids = array($pagesitemap->ID);
							?>
							<?php $the_query = new WP_Query(array('posts_per_page' => -1, 'post_type'=> 'page', 'orderby'=> 'menu_order', 'order'=> 'ASC', 'post_status' => 'publish', 'post__not_in' => $excludeids)); ?>
							<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
								<?php $child_query = new WP_Query(array('posts_per_page' => -1, 'post_parent' => $post->ID, 'post_type'=>'page', 'orderby'=> 'menu_order',  'order'=> 'ASC', 'post__not_in' => $excludeids)); ?>
								<?php if($child_query->have_posts()) : ?>
									<ul>
									<?php while ( $child_query->have_posts() ) : $child_query->the_post(); ?>
										<li class=""><a href="<?php echo get_permalink(); ?>"><?php the_title(); /* echo get_value($alttitle = get_post_meta( $post->ID, 'title_field', true ), get_the_title()); */ ?></a></li>
									<?php endwhile; wp_reset_postdata(); ?>
									</ul>
								<?php else : ?>
									<li class=""><a href="<?php echo get_permalink(); ?>"><?php the_title(); /* echo get_value($alttitle = get_post_meta( $post->ID, 'title_field', true ), get_the_title()); */ ?></a></li>
								<?php endif; ?>
							<?php endwhile; wp_reset_postdata(); ?>
							</ul>
						</div>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
			
		</div>
			
		<footer class="entry-footer">
			<?php get_template_part('content', 'footer'); ?>
			<?php edit_post_link( 'edit', '<span class="edit-link">', '</span>' ); ?>
		</footer>
	</div>
<?php get_footer(); ?>