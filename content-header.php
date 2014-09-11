<?php if( is_search() ) { 
	if ( have_posts() ) : ?>
		<h1><?php printf( __( 'Search Results for: %s', 'basetheme' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
	<?php else : ?>
		<h1><?php _e( 'Nothing Found', 'basetheme' ); ?></h1>	
	<?php endif; ?>
<?php } else if( is_archive() ){ ?>
	<h1 class="entry-title">
	<?php 
	if ( is_day() ) :
		printf( __( 'Daily Archives: %s', 'basetheme' ), get_the_date() );
	elseif ( is_month() ) :
		printf( __( 'Monthly Archives: %s', 'basetheme' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'basetheme' ) ) );
	elseif ( is_year() ) :
		printf( __( 'Yearly Archives: %s', 'basetheme' ), get_the_date( _x( 'Y', 'yearly archives date format', 'basetheme' ) ) );
	else :
		_e( 'Archives', 'basetheme' );
	endif;
	?>
	</h1>
<?php } else if( is_404() ) { ?>
	<h1 class="entry-title">404 Page</h1>
<?php } else if( is_author() ) { ?>
	<h1 class="entry-title"><?php the_author(); ?></h1>
<?php } else if( is_category() ) { ?>
	<h1 class="entry-title"><?php echo single_cat_title( '', false ); ?></h1>
<?php } else { 
	$alttitle = get_post_meta( $post->ID, 'title_field', true );
	$hotelname = get_settings_option('hotelname','general_option'); 
	$address = get_post_meta( $post->ID, 'address_field', true);
	if( $alttitle != '' || $alttitle != null ) : ?>
		<h1 class="entry-title <?php echo ($address != null || $address != '') ? "no-margin" : null; ?>"><?php echo $alttitle; ?></h1>
	<?php else : ?>
		<h1 class="entry-title <?php echo ($address != null || $address != '') ? "no-margin" : null; ?>"><?php the_title($hotelname.' - '); ?></h1>
	<?php endif; ?>
	<?php echo ($address) ? get_address(array('hotelname'=>true,'telephone'=>true, 'telephone1'=>true, 'telephone2'=>true, 'seperator'=>true)) : null; ?>
<?php } ?>