<?php
/*GET Page Title*/
function basetheme_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}
	
	global $page, $paged, $post;
 	$pageid = get_page_by_title('Home');
	$site_default_description = get_post_meta($pageid->ID, 'page_title_field', true);
	
	/* Add the blog name */
	$title .= get_value($site_default_description, get_bloginfo( 'name', 'display' ));

	/* Add the blog description for the home/front page. */
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	/* Add a page number if necessary: */
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );
	}

	/* If page has meta page title */
	if ( get_post_meta($post->ID, 'page_title_field', true) != null || get_post_meta($post->ID, 'page_title_field', true) !='' ) {	
		$title = get_post_meta($post->ID, 'page_title_field', true);
	}
	
	return $title;
}

/*Get Robots Meta Data*/
function basetheme_get_meta_robots(){
	global $post;
	
	/* If page has meta robot no index no follow*/
	if ( get_post_meta($post->ID, 'meta_nfni', true) != null || get_post_meta($post->ID, 'meta_nfni', true) !='' ) {	
		$metarobot = '<meta name="robots" content="noindex, nofollow">';
	}
	
	/* If general settings meta robot no index no follow*/
	if( get_settings_option('nofollow', 'general_option') ) { 
		$metarobot = '<meta name="robots" content="noindex, nofollow">';
	}

	/* if page is archive */	
	if ( is_archive() ) {
		$metarobot = '<meta name="robots" content="noindex, follow">';
	}
		
	return $metarobot;
}

/*Process shortcode of secondary-content-container custom field*/
function the_secondary_content($content){
	$pattern = get_shortcode_regex();
    if ( preg_match_all( '/'. $pattern .'/s', $content, $matches ) ) {
		foreach($matches as $key=>$match){
			foreach($match as $m){
				$content = str_replace($m, do_shortcode($m), $content);
			}
		}
    }
	echo $content;
}

/*ADD ADDITIONAL UPLOAD FILETYPE*/
function basetheme_custom_upload_mimes( $existing_mimes ) {
	$existing_mimes['ico'] = 'image/x-icon';
	$existing_mimes['pdf'] = 'application/pdf'; 
	$existing_mimes['css'] = 'text/css'; 
	return $existing_mimes;
}

/*WRAP IMAGES IN DIV*/
function basetheme_wrap_image($html, $id, $caption, $title, $align, $url, $size, $alt){
	if(is_admin()){
    return '<div class="image-container">'.$html.'</div>';
  }
}

/*ADD CONTENT TO PAGES*/
function get_init_content($pagetitle){
	if($pagetitle == 'Home'){
		$content = '
			<div class="row-fluid">
				<div class="span12">
					<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>
				</div>
			</div>			
	   ';
	} else if($pagetitle == 'Sitemap') {
		$content = '<div class="row-fluid">
				<div class="span12">
					<p>Sitemap Links</p>
				</div>
			</div>
		';
	} else {
		$content = '
			<div class="row-fluid">
				<div class="span12">
					<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>
				</div>
			</div>
		';
	}
	return $content;
}

/*AUTO GENERATE PAGES AND DELETE DEFAULT WORDPRESS POST AND PAGE*/
function basetheme_setup_pages(){
	/*Add Base Pages*/
	$pagetitles = array('Home', 'Sitemap');
	
	foreach($pagetitles as $key=>$pagetitle) {
		if (!get_page_by_title($pagetitle, 'OBJECT', 'page') ){
			
			$new_page = array(
				'menu_order' => $key,
				'post_title' => $pagetitle,
				'post_status' => 'publish',
				'post_date' => date('Y-m-d H:i:s'),
				'post_type' => 'page',
				'comment_status' => 'closed',
				'page_template' => ($pagetitle === 'Home') ? 'page-home.php' : '',
				'post_content'  => get_init_content($pagetitle)
			);		
			$post_id = wp_insert_post($new_page);
		} 
	}
	
	/*Remove Sample Page*/
	if (get_page_by_title('Sample Page', 'OBJECT', 'page') ){
		$page = get_page_by_title('Sample Page');
		wp_delete_post($page->ID, true);
	}

	/*Remove Hello World Post*/
	if (get_page_by_title('Hello World!', 'OBJECT', 'post') ){
		$post = get_page_by_title('Hello World!', 'OBJECT', 'post');
		wp_delete_post($post->ID, true);
	}
}

/*AUTO GENERATE NAVIGATION MENU AND SET TO MENU PLACEHODLER*/
function basetheme_navigation_menus() {
	$locations = array(
		'primary' => __('Primary Menu', 'primary'),
		'secondary' => __('Secondary Menu', 'secondary')
	);
	register_nav_menus( $locations );
	
	$menu_name = "Primary Menu";
	$menu_location = "primary";
	$menu_exists = wp_get_nav_menu_object($menu_name);
	
	if( !$menu_exists){
		$menu_id = wp_create_nav_menu($menu_name);
		$pagetitles = array('Home', 'Reservation');
		foreach($pagetitles as $key=>$pagetitle) {
			if($pagetitle == 'Reservation') {
				wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-title' =>  $pagetitle,
				'menu-item-classes' => 'ctareservation',
				'menu-item-status' => 'publish'));
			} else {
				wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-title' => $pagetitle,
				'menu-item-object' => 'page',
				'menu-item-object-id' => get_page_by_path(strtolower($pagetitle))->ID,
				'menu-item-type' => 'post_type',
				'menu-item-status' => 'publish'));	
			}
		}
	}

	if( !has_nav_menu( $menu_location ) ){
		$locations = get_theme_mod('nav_menu_locations');
		$locations[$menu_location] = $menu_id;
        set_theme_mod( 'nav_menu_locations', $locations );
    }
	
	$menu_name_2 = "Secondary Menu";
	$menu_location_2 = "secondary";
	$menu_exists_2 = wp_get_nav_menu_object($menu_name_2);
	
	if( !$menu_exists_2){
		$menu_id = wp_create_nav_menu($menu_name_2);
		$pagetitles = array('Home', 'Reservation', 'Sitemap');
		foreach($pagetitles as $key=>$pagetitle) {
			if($pagetitle == 'Reservation') {
				wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-title' =>  $pagetitle,
				'menu-item-classes' => 'ctareservation',
				'menu-item-status' => 'publish'));
			} else {
				wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-title' => $pagetitle,
				'menu-item-object' => 'page',
				'menu-item-object-id' => get_page_by_path(strtolower($pagetitle))->ID,
				'menu-item-type' => 'post_type',
				'menu-item-status' => 'publish'));	
			}
		}
	}

	if( !has_nav_menu( $menu_location_2 ) ){
		$locations = get_theme_mod('nav_menu_locations');
		$locations[$menu_location_2] = $menu_id;
        set_theme_mod( 'nav_menu_locations', $locations );
    }
}

/*CLEAN UP HEADER META AND LINK DATA*/
function basetheme_head_cleanup() {
	remove_action('wp_head', 'feed_links_extra', 3 );                    
	remove_action('wp_head', 'feed_links', 2 );                          
	remove_action('wp_head', 'rsd_link' );                               
	remove_action('wp_head', 'wlwmanifest_link' );                       
	remove_action('wp_head', 'index_rel_link' );                         
	remove_action('wp_head', 'parent_post_rel_link', 10, 0 );            
	remove_action('wp_head', 'start_post_rel_link', 10, 0 ); 
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); 
	remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );
	remove_action('wp_head', 'rel_canonical' );
	remove_action('wp_head', 'wp_generator' );
}

/* UNREGISTER ALL WIDGETS */
function basetheme_unregister_default_widgets() {
    unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Archives');
    unregister_widget('WP_Widget_Links');
    unregister_widget('WP_Widget_Meta');
    unregister_widget('WP_Widget_Search');
	/*unregister_widget('WP_Widget_Text');*/
    unregister_widget('WP_Widget_Categories');
    unregister_widget('WP_Widget_Recent_Posts');
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_RSS');
    unregister_widget('WP_Widget_Tag_Cloud');
    /*unregister_widget('WP_Nav_Menu_Widget');*/
}

/*SET SETTINGS OPTION MENU
function basetheme_update_options(){
	if (get_page_by_title('Home', 'OBJECT', 'page') ){
		$home = get_page_by_title( 'Home' );
		update_site_option( 'show_on_front', 'page' );
		update_site_option( 'page_on_front', $home->ID );
	}
	
	update_site_option('rss_use_excerpt', 1);	
	update_site_option('default_ping_status', 'closed');
	update_site_option('default_pingback_flag', 0);
	update_site_option('comment_registration', 1);	
	update_site_option('comment_moderation', 1);	
	update_site_option('default_comment_status', 'closed');	
	update_site_option('show_avatars', 0);	
	update_site_option('avatar_default', 'Blank');
	update_site_option('permalink_structure', '/%postname%/');
	update_site_option('image_default_link_type','none');
}
*/
/*REMOVE RSS VERSION*/
function basetheme_rss_version() { return ''; }

/*REMOVE COMMENT STYLE*/
function basetheme_remove_wp_widget_recent_comments_style() {
   if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
      remove_filter('wp_head', 'wp_widget_recent_comments_style' );
   }
}

function basetheme_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }
}

/*REMOVE GALLERY STYLE*/
function basetheme_gallery_style($css) {
  return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}

/*CUSTOMIZE SEARCHBAR*/
function basetheme_wpsearch($form) {
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <label class="screen-reader-text" for="s">' . __('Search for:', 'bonestheme') . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="'.esc_attr__('Search the Site...','bonestheme').'" />
    <input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
    </form>';
    return $form;
}

function basetheme_filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

/*EDIT READ MORE ON EXCERPT*/
function basetheme_excerpt_more($more) {
	global $post;
	return '...  <a href="'. get_permalink($post->ID) . '" title="Read '.get_the_title($post->ID).'">Read more &raquo;</a>';
}

/*DISABLE THE USER ADMIN BAR ON PUBLIC SIDE ON REGISTRATION*/
function basetheme_trash_public_admin_bar($user_ID) {
    update_user_meta( $user_ID, 'show_admin_bar_front', 'false' );
}

/*TAXONOMY NAVIGATION */
function basetheme_content_nav( $html_id ) {
    global $wp_query;
    $html_id = esc_attr( $html_id );
    if ( $wp_query->max_num_pages > 1 ) : ?>
        <nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
            <h3 class="assistive-text"><?php _e( 'Post navigation', 'basetheme' ); ?></h3>
            <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'basetheme' ) ); ?></div>
            <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'basetheme' ) ); ?></div>
        </nav>
    <?php endif;
}

/*CUSTOM IMAGE SIZE*/
function basetheme_custom_image_size() {
	if ( function_exists( 'add_image_size' ) ) { 
		add_image_size( 'slider-thumbnail', 40, 40, true );		
		add_image_size( 'carousel-thumbnail', 180, 100, true );
		add_image_size( 'colorbox-image', 800, 800 );
	}
}

/*DISPLAY CUSTOM IMAGE SIZE ON MENU*/
function basetheme_display_custom_image_size( $sizes ) {
  
	$new_sizes = array();
	
	$added_sizes = get_intermediate_image_sizes();
	
	foreach( $added_sizes as $key => $value) {
		$new_sizes[$value] = $value;
	}
	
	$new_sizes = array_merge( $new_sizes, $sizes );
	
	return $new_sizes;
}

/* ADD CUSTOM FIELD TO MEDIA */
function rt_image_attachment_fields_to_edit($form_fields, $post) {
	$form_fields["rt-image-link"] = array("label" => __("Custom Link"), "input" => "text", "value" => get_post_meta($post->ID, "_rt-image-link", true), );
	$form_fields["rt-image-title-text"] = array("label" => __("Img Title Text"), "input" => "text", "value" => get_post_meta($post->ID, "_rt-image-title-text", true), );
	$form_fields["rt-image-alt-text"] = array("label" => __("Img Alt Text"), "input" => "text", "value" => get_post_meta($post->ID, "_rt-image-alt-text", true), );
	return $form_fields;
}

/* NOW ATTACH OUR FUNCTION TO THE HOOK */
add_filter("attachment_fields_to_edit", "rt_image_attachment_fields_to_edit", null, 2);
function rt_image_attachment_fields_to_save($post, $attachment) {
    if( isset($attachment['rt-image-link']) ){ update_post_meta($post['ID'], '_rt-image-link', $attachment['rt-image-link']); }
    if( isset($attachment['rt-image-title-text']) ){ update_post_meta($post['ID'], '_rt-image-title-text', $attachment['rt-image-title-text']); }
    if( isset($attachment['rt-image-alt-text']) ){ update_post_meta($post['ID'], '_rt-image-alt-text', $attachment['rt-image-alt-text']); }
    return $post;
}

/* get settings option value */
function get_settings_option($parameter, $field){
	$options = get_option($field);
	return $options[$parameter];
}

/* get mapped domain */
function get_mapped_domain(){
	global $wpdb;
	/*$prefix = 'dwh_hwp_';*/ 
	$prefix = $wpdb->base_prefix;
	$blogid = get_current_blog_id();
	$table = $prefix.'domain_mapping';	
	$mapdomain = $wpdb->get_row( "SELECT domain FROM $table WHERE blog_id = $blogid" );	
	$stored_domain = (get_settings_option('hoteldomain', 'general_option') != null) ? get_settings_option('hoteldomain', 'general_option') : preg_replace('/^www\./','',$_SERVER['SERVER_NAME']);
	$domain = ( $mapdomain->domain != null ) ? $mapdomain->domain : $stored_domain;	
	return $domain;
}

/* get default value */
function get_value($parameter, $defaultvalue){
	if($parameter != '' || $parameter != null){
		return $parameter;
	} else {
		return $paramater = $defaultvalue;
	}
}

/* get sidebar theme*/
function get_sidebar_themestyle(){
	$themestyle = get_value(get_settings_option('themestyle','style_option'), 'default');
	get_template_part('themestyle', $themestyle.'-sidebar');
}

/* get header theme*/
function get_header_themestyle(){
	$themestyle = get_value(get_settings_option('themestyle','style_option'), 'default');
	get_template_part('themestyle', $themestyle.'-header');
}

/* get footer theme*/
function get_footer_themestyle(){
	$themestyle = get_value(get_settings_option('themestyle','style_option'), 'default');
	get_template_part('themestyle', $themestyle.'-footer');
}

/* get default themestyle css */
function get_default_style(){
	$themestyle = get_value(get_settings_option('themestyle','style_option'), 'default');
	return get_default_css($themestyle);			
}

/* get mediaquery themestyle css */
function get_media_query_themestyle(){
	$themestyle = get_value(get_settings_option('themestyle','style_option'), 'default');
	return get_mediaquery_css($themestyle);		
}

/* get mediaquery style */
function get_media_query_style($mediaquerystyle){
	if($mediaquerystyle != '' || $mediaquerystyle != null){
		return $mediaquerystyle;
	} else {
		$themestyle = get_value(get_settings_option('themestyle','style_option'), 'default');
		return get_mediaquery_css($themestyle);		
	}
}

/* get bpg content */
function get_bpg_content($bpgcontent){
	if($bpgcontent != '' || $bpgcontent != null){
		return $bpgcontent;
	} else {
		if(get_settings_option('hotelname', 'general_option') == null){
			$bpgcontent = null;
		} else {
			$bpgcontent = '<div>';
			$bpgcontent .= '<p>'.get_settings_option('hotelname', 'general_option').' will make available the best guest room price for the hotel (the "Best Price Guarantee"). "'.get_settings_option("hotelname", "general_option").' Website" are the websites owned or operated by or on behalf of '. get_settings_option("hotelname", "general_option").' bearing the logo and branding of '. get_settings_option("hotelname", "general_option").'.</p>';
			$bpgcontent .= '<p>In the unlikely event that a lower price at '. get_settings_option("hotelname", "general_option").' is made available on a non-'.get_settings_option("hotelname", "general_option").' website (the "Competing Price"), upon its receipt of a claim that satisfies these Best Price Guarantee terms and conditions (the "BPG Terms"), '.get_settings_option("hotelname", "general_option").' will honor that Competing Price and provide the individual that submitted the valid claim one of the following: (1) an additional 10% discount off the Competing Price per room per night; or (2) a voucher that the guest can use during their stay, the amount of the voucher will be equal to the difference between the original reservation rate and the competing price.</p>';
			$bpgcontent .= '<h3>Terms and Conditions</h3>';
			$bpgcontent .= '<ul class="list-bullet">';
			$bpgcontent .= '	<li>';
			$bpgcontent .= '		<span>For a claim to be eligible under the Best Price Guarantee:</span>';
			$bpgcontent .= '		<ul class="list-bullet">';
			$bpgcontent .= '			<li>The claim must be submitted prior to, or within 24 hours after, making a reservation through a '.get_settings_option("hotelname", "general_option").' Website, and at least 24 hours before the standard check-in time at '.get_settings_option("hotelname", "general_option").'.</li>';
			$bpgcontent .= '			<li>';
			$bpgcontent .= '				<span>The claim must include:</span>';
			$bpgcontent .= '				<ul class="list-bullet">';
			$bpgcontent .= '					<li>Booking Confirmation Number</li>';
			$bpgcontent .= '					<li>Full Name on the reservation</li>';
			$bpgcontent .= '					<li>Lower rate found (with currency)</li>';
			$bpgcontent .= '					<li>Room type/ Rate plan (i.e Deluxe Room with Buffet Breakfast)</li>';
			$bpgcontent .= '					<li>Url of the website where the lower price was found</li>';
			$bpgcontent .= '					<li>Reservation date</li>';
			$bpgcontent .= '					<li>Stay dates</li>';
			$bpgcontent .= '				</ul>';
			$bpgcontent .= '			</li>';
			$bpgcontent .= '			<li>A claim may be rejected by '.get_settings_option("hotelname", "general_option").' if it is incomplete or concerns a non-'.get_settings_option("hotelname", "general_option").' website.</li>';
			$bpgcontent .= '		</ul>';
			$bpgcontent .= '		<p><strong>PLEASE NOTE:</strong> You don\'t need to make a booking on the competitor website, just email the complete details of your claim to reservations@directwithhotels.com. We will get in touch with you within 48 hours from the receipt of the claim to verify its validity.</p>';
			$bpgcontent .= '	</li>';
			$bpgcontent .= '	<li>';
			$bpgcontent .= '		<span>For the Competing Price to be valid, it must be a currently available lower published online room price for <?php echo get_settings_option("hotelname", "general_option"); ?>, the same stay dates, the same number of guests, the same room type, with a similar view and room size, and include similar or additional value-added amenities (e.g., free breakfast).</span>';
			$bpgcontent .= '		<ul class="list-bullet">';
			$bpgcontent .= '			<li>'. get_settings_option("hotelname", "general_option").' will compare the total room cost of a stay, and multiple claims for a stay consisting of two or more nights in the same week at the same '. get_settings_option("hotelname", "general_option").'.</li>';
			$bpgcontent .= '			<li>'. get_settings_option("hotelname", "general_option").' will convert any Competing Price offered in a different currency than the price made available through the '. get_settings_option("hotelname", "general_option").' Website, and may deny claims where it determines that the difference between the price is due to exchange rate fluctuations.</li>';
			$bpgcontent .= '			<li>Taxes, Surcharges, Booking fees, extra adult fees, fees for children, rollaway charges will be included in the price comparison.</li>';
			$bpgcontent .= '			<li>The estimated value of value-added amenities (e.g.,free breakfast, use of Wifi, vouchers) offered as part of a Competing Price will be excluded from the price comparison, and will not be provided by '. get_settings_option("hotelname", "general_option").' when honoring a lower price.</li>';
			$bpgcontent .= '			<li>'. get_settings_option("hotelname", "general_option").' may deny claims where the difference between the Competing Price and the price on the '. get_settings_option("hotelname", "general_option").' Website is less than one percent.</li>';
			$bpgcontent .= '		</ul>';
			$bpgcontent .= '	</li>';
			$bpgcontent .= '	<li>';
			$bpgcontent .= '		<span>The Best Price Guarantee does not apply to:</span>';
			$bpgcontent .= '		<ul class="list-bullet">';
			$bpgcontent .= '			<li>Unpublished or negotiated prices (e.g., corporate discount rates, group rates, meeting rates);</li>';
			$bpgcontent .= '			<li>Rates requiring membership in a club or other organization, offered pursuant to direct mail or email solicitations, requiring discount codes or coupons, or otherwise not intended for the general public;</li>';
			$bpgcontent .= '			<li>Package prices (e.g., prices that include a combination of a room and airfare, an overnight cruise, car rental);</li>';
			$bpgcontent .= '			<li>Prices offered by opaque providers (e.g., Hotwire, Priceline) that do not provide the name or location of the hotel until after a reservation has been made; and</li>';
			$bpgcontent .= '			<li>Prices offered on on-request websites that do not provide immediate hotel confirmations (e.g., Asiaweb).</li>';
			$bpgcontent .= '		</ul>';
			$bpgcontent .= '	</li>';				
			$bpgcontent .= '	<li>The Best Price Guarantee does not apply to existing reservations that are not booked through a '. get_settings_option("hotelname", "general_option").' Website, and '. get_settings_option("hotelname", "general_option").' is not responsible for any fees associated with cancelling a reservation made through a different channel (e.g., a call center, a non-'. get_settings_option("hotelname", "general_option").' website).</li>';
			$bpgcontent .= '	<li>If a valid Best Price Guarantee claim is submitted without an existing reservation, the individual making the valid claim will be contacted by '. get_settings_option("hotelname", "general_option").' and must make a reservation in the manner communicated by '. get_settings_option("hotelname", "general_option").' within 24 hours from receipt of the communication or local check-in time at '. get_settings_option("hotelname", "general_option").' Hotel. Failure to make a reservation in the required time period will invalidate the claim.</li>';
			$bpgcontent .= '	<li>The Best Price Guarantee will be suspended during times where the '. get_settings_option("hotelname", "general_option").' Websites or certain prices are not available due to an outage, a technical issue or a circumstance beyond '. get_settings_option("hotelname", "general_option").'\'s reasonable control.</li>';
			$bpgcontent .= '	<li>A Best Price Guarantee reward will only be provided if the individual making the valid claim stays in the reserved guest room.</li>';
			$bpgcontent .= '	<li>'. get_settings_option("hotelname", "general_option").' has the sole right and discretion to determine the validity of any claim and will not review documentation provided by the individual submitting a claim as part of its validation process. '. get_settings_option("hotelname", "general_option").' reserves the right to deny a claim, if it cannot independently verify the availability of a Competing Price at the time it processes the claim.</li>';
			$bpgcontent .= '	<li>'. get_settings_option("hotelname", "general_option").' may at any time and without notice terminate or restrict a person\'s ability to submit a claim under or otherwise benefit from the Best Price Guarantee, if in its sole discretion '. get_settings_option("hotelname", "general_option").' determines that such person has: (1) acted in a manner inconsistent with applicable laws or ordinances; (2) acted in a fraudulent or abusive manner, (3) submitted multiple invalid Best Price Guarantee claims; (4) failed to stay at '. get_settings_option("hotelname", "general_option").' Hotels after receiving approved Best Price Guarantee Claims; or (5) breached any of these BPG Terms.</li>';
			$bpgcontent .= '	<li>Any disputes arising out of or related to the Best Price Guarantee or these BPG Terms shall be handled individually without any class action, and shall be governed by, construed and enforced in accordance with the laws of '.get_settings_option("country", "general_option").'.</li>';
			$bpgcontent .= '	<li>Void where prohibited by law. '. get_settings_option("hotelname", "general_option").' reserves the right to amend, revise, supplement, suspend or discontinue the Best Price Guarantee or these BPG Terms at anytime in its sole discretion and without prior notice.</li>';
			$bpgcontent .= '</ul>';
			$bpgcontent .= '</div>';
		}
		return $bpgcontent;
	}
}

/* Get Address */
function get_address($parameter) {
	$telephone		 = (get_settings_option('countrycode', 'general_option') != '') ? get_settings_option('countrycode', 'general_option').'-' : '';
	$telephone		.= (get_settings_option('areacode', 'general_option') != '') ? get_settings_option('areacode', 'general_option').'-': '';
	$telephone		.= (get_settings_option('tel', 'general_option') != '') ? get_settings_option('tel', 'general_option') : '';
	$telephone1		 = (get_settings_option('countrycode1', 'general_option') != '') ? get_settings_option('countrycode1', 'general_option').'-' : '';
	$telephone1 	.= (get_settings_option('areacode1', 'general_option') != '') ? get_settings_option('areacode1', 'general_option').'-': '';
	$telephone1 	.= (get_settings_option('tel1', 'general_option') != '') ? get_settings_option('tel1', 'general_option') : '';
	$telephone2 	 = (get_settings_option('countrycode2', 'general_option') != '') ? get_settings_option('countrycode2', 'general_option').'-' : '';
	$telephone2		.= (get_settings_option('areacode2', 'general_option') != '') ? get_settings_option('areacode2', 'general_option').'-': '';
	$telephone2		.= (get_settings_option('tel2', 'general_option') != '') ? get_settings_option('tel2', 'general_option') : '';
	$phonelabel		= ($telephone != '' && $telephone1 != '') ? 'Phone Numbers' : 'Phone Number';

	if($parameter['isnotinline']) {
		$address = '<div id="address-container"><span class="vcard">';
		if(!$parameter['hotelname']) $address .= (get_settings_option('hotelname', 'general_option') != '') ? '<h4 class="fn org">'.get_settings_option('hotelname', 'general_option').'</h4>' : '';
		$address .= '<span class="adr">';
		if(!$parameter['street1']) $address .= (get_settings_option('street1', 'general_option') != '') ? '<span class="street-address">'.get_settings_option('street1', 'general_option').'</span>,' : '';
		if(!$parameter['street2']) $address .= (get_settings_option('street2', 'general_option') != '') ? '<br><span class="street-address">'.get_settings_option('street2', 'general_option').'</span>,' : '';
		if(!$parameter['city']) $address .= (get_settings_option('citytown', 'general_option') != '') ? '<br><span class="locality">'.get_settings_option('citytown', 'general_option').'</span>, ' : '';
		if(!$parameter['region']) $address .= (get_settings_option('stateprovinceregion', 'general_option') != '') ? '<span class="region">'.get_settings_option('stateprovinceregion', 'general_option').'</span> ' : '';
		if(!$parameter['zippostal']) $address .= (get_settings_option('zippostal', 'general_option') != '') ? '<span class="postal-code">'.get_settings_option('zippostal', 'general_option').'</span>' : '';
		if(!$parameter['country']) $address .= (get_settings_option('country', 'general_option') != '') ? '<br><span class="country">'.get_settings_option('country', 'general_option').'</span>' : '';
		$address .= '</span>';
		if(!$parameter['telephone']) $address .= (get_settings_option('tel', 'general_option') != '') ? '<br>'.$phonelabel.':<br><span class="tel">'.$telephone.'</span>' : '';
		if(!$parameter['telephone1']) $address .= (get_settings_option('tel1', 'general_option') != '') ? '<br><span class="tel">'.$telephone1.'</span>' : '';
		if(!$parameter['telephone2']) $address .= (get_settings_option('tel2', 'general_option') != '') ? '<br><span class="tel">'.$telephone2.'</span>' : '';
		$address .= '</span></div>';
	} else {
		$address = '<span class="vcard">';
		if(!$parameter['hotelname']) $address .= (get_settings_option('hotelname', 'general_option') != '') ? '<span class="fn org">'.get_settings_option('hotelname', 'general_option').'</span> ' : '';
		if(!$parameter['seperator']) $address .= '| ';
		$address .= '<span class="adr">';
		if(!$parameter['street1']) $address .= (get_settings_option('street1', 'general_option') != '') ? '<span class="street-address">'.get_settings_option('street1', 'general_option').'</span>, ' : '';
		if(!$parameter['street2']) $address .= (get_settings_option('street2', 'general_option') != '') ? '<span class="street-address">'.get_settings_option('street2', 'general_option').'</span>, ' : '';
		if(!$parameter['city']) $address .= (get_settings_option('citytown', 'general_option') != '') ? '<span class="locality">'.get_settings_option('citytown', 'general_option').'</span>, ' : '';
		if(!$parameter['region']) $address .= (get_settings_option('stateprovinceregion', 'general_option') != '') ? '<span class="region">'.get_settings_option('stateprovinceregion', 'general_option').'</span>, ' : '';
		if(!$parameter['zippostal']) $address .= (get_settings_option('zippostal', 'general_option') != '') ? '<span class="postal-code">'.get_settings_option('zippostal', 'general_option').'</span>, ' : '';
		if(!$parameter['country']) $address .= (get_settings_option('country', 'general_option') != '') ? '<span class="country">'.get_settings_option('country', 'general_option').'</span> ' : '';
		$address .= '</span> ';
		if(!$parameter['seperator']) $address .= (get_settings_option('tel', 'general_option') != '') ? '| ' : null;
		if(!$parameter['telephone']) $address .= (get_settings_option('tel', 'general_option') != '') ? $phonelabel.': <span class="tel">'.$telephone.'</span>' : '';
		if(!$parameter['seperator']) $address .= (get_settings_option('tel1', 'general_option') != '') ? ', ' : null;
		if(!$parameter['telephone1']) $address .= (get_settings_option('tel1', 'general_option') != '') ? '<span class="tel">'.$telephone1.'</span>' : '';
		if(!$parameter['seperator']) $address .= (get_settings_option('tel2', 'general_option') != '') ? ', ' : null;
		if(!$parameter['telephone2']) $address .= (get_settings_option('tel2', 'general_option') != '') ? '<span class="tel">'.$telephone2.'</span>' : '';
		$address .= '</span>';
	}
	
	return $address;
}

/* Add Custom Box */
function settings_add_custom_box() {
    $screens = array( 'post', 'page' );
    add_meta_box('custom_section_id', 'Page Custom Field', 'page_inner_custom_box', $screen);
 	add_meta_box('header_section_id', 'Header Slider', 'header_inner_custom_box', 'page');
}
	
/* Init plugin options to white list our options */
function settings_init(){
	register_setting( 'general_option_settings', 'general_option', 'settings_validate' );
	register_setting( 'style_option_settings', 'style_option', 'settings_validate' );
}

/* Add menu page */
function settings_add_page() {
	add_menu_page('DWH Settings', 'DWH Settings', 'manage_options', 'general_settings', '', '', 4.9);
	add_submenu_page('general_settings', 'General Settings', 'General Settings', 'manage_options', 'general_settings', 'general_options_do_page');
	add_submenu_page('general_settings', 'Styles Settings', 'Style Settings', 'manage_options', 'style_settings', 'style_options_do_page');
}

/* Validate Settings Input */
function settings_validate($input) {
	$input['hotelname'] =  wp_filter_nohtml_kses($input['hotelname']);
	$input['hotellocation'] =  wp_filter_nohtml_kses($input['hotellocation']);
	$input['hotelid'] = (is_numeric($input['hotelid']) ? $input['hotelid'] : '000000');
	$input['gacode'] = ($input['gacode'] != null ? $input['gacode'] : '');			
	$input['gacode2'] = ($input['gacode2'] != null ? $input['gacode2'] : '');			
	return $input;
}

/* Insert Inline Style */
function style_inline_hook(){
	$options = get_option('style_option');
	if($options['stylesheetid'] != '' || $options['stylesheetid'] != null){
		echo "<link rel='stylesheet' id='custom-style-css'  href='".wp_get_attachment_url($options['stylesheetid'])."?ver=".$options['stylesheetver']."' type='text/css' media='all' />";
	}
 	echo "<style> ";
	echo get_value($options['customstyle'], get_default_style()).' ';
	echo get_media_query_style($options['mediaquerystyle']);
	echo "</style> ";
}

/*add style sheet for admin and front page*/
function basetheme_add_style(){
	if (!is_admin()) {
		$themestyle = get_value(get_settings_option('themestyle','style_option'), 'default');
		wp_enqueue_style( 'base-style', get_stylesheet_uri(), false, '2.1.0' );
		wp_enqueue_style( 'theme-style', get_template_directory_uri() . '/css/themestyle-'.$themestyle.'.css', false, '2.1.24' );
		wp_enqueue_style( 'default-style', get_template_directory_uri().'/css/default.css', false, '1.1.6' );
	} else {
		wp_enqueue_style( 'base-admin-style', get_template_directory_uri() . '/css/base-admin.css' );
	}
}

/*add script for admin and front page*/
function basetheme_add_scripts(){ 
	if (!is_admin()) {
		wp_register_script('googletranslate', '//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit','1.0',true);
		wp_register_script('googlemap', 'https://maps.googleapis.com/maps/api/js?sensor=false','1.0',true);
		wp_register_script('flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js',array('jquery'),'1.0',true);
		wp_register_script('colorbox', get_template_directory_uri() . '/js/jquery.colorbox-min.js',array('jquery'),'1.0',true);
		wp_register_script('slimscroll', get_template_directory_uri() . '/js/jquery.slimscroll.min.js',array('jquery'),'1.0',true);
		wp_register_script('script', get_template_directory_uri() . '/js/script.js',array('jquery'),'1.19',true); 
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('flexslider');
		wp_enqueue_script('colorbox');
		wp_enqueue_script('slimscroll');
		wp_enqueue_script('googletranslate');
		wp_enqueue_script('googlemap');
		wp_enqueue_script('script');
		wp_localize_script('ajax-script', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );	
	}
}

/* Encqueue Scripts */
function settings_enqueue_scripts() {
	if (is_admin()) {
		wp_enqueue_media();
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');        
	}
}
	
function settings_script(){ 
?>
	<script type="text/javascript">
	var $ = jQuery.noConflict();
	$(document).ready(function() {
		$('body').delegate('.button-upload', 'click', function( e ) {
			var id = $(this).attr('href');
			var send_attachment_bkp = wp.media.editor.send.attachment;
			wp.media.editor.send.attachment = function(props, attachment) {
				$(id+' .image-preview').attr('src', attachment.url);
				$(id+' .logo-image-preview').attr('src', attachment.url);
				$(id+' .favicon-image-preview').attr('src', attachment.url);
				$(id+' .image-src').val(attachment.url);
				$(id+' .image-id').val(attachment.id);
				wp.media.editor.send.attachment = send_attachment_bkp;
			}
			wp.media.editor.open();
			e.preventDefault();
		});
		
		$('body').delegate('.button-upload-media-item', 'click', function( e ) {
			var id = $(this).attr('href');
			var caretpos = $(id).prop('selectionStart');
			var textareacontent = $(id).val();
			var send_attachment_bkp = wp.media.editor.send.attachment;
			wp.media.editor.send.attachment = function(props, attachment) {
				$(id).val(textareacontent.substr(0, caretpos) + attachment.url + textareacontent.substr(caretpos));
				wp.media.editor.send.attachment = send_attachment_bkp;
			}
			wp.media.editor.open();
			e.preventDefault();
		});

		/* remove */
		$('body').delegate('.button-remove', 'click', function(e){
			var id = $(this).attr('href');
			$(id+' .image-preview').attr('src', '<?php echo get_template_directory_uri(); ?>/images/default-noimage.png');
			$(id+' .logo-image-preview').attr('src', '<?php echo get_template_directory_uri(); ?>/images/logo.png');
			$(id+' .favicon-image-preview').attr('src', '<?php echo get_template_directory_uri(); ?>/images/favicon.ico');
			$(id+' .image-src').val('');
			$(id+' .image-id').val('');
			e.preventDefault();
		});
		
		/* Tab Menu */
		$('body').delegate('.tab-menu a', 'click', function(e){
			id = $(this).attr('href');
			$('.tab-menu a').removeClass('active');
			$('.tab-container').removeClass('show');
			$(this).addClass('active');
			$(id).addClass('show');
			e.preventDefault();
		});
		
		/* Checkbox */
		$('body').delegate('.checkbox', 'change', function( e ) { 
			id = $(this).val();
			if( $(this).is(':checked') ){
				$(this).val(1).attr('checked', true);
				$(id).val(1);
			} else {
				$(this).val(0).attr('checked', false);
				$(id).val(0);			
			}
		});
		
		/* page header slider */
		$('body').delegate('.galleryheader', 'click', function( e ){
			alert('upload gallery');
		});

		
		$('body').delegate('.deleteheader', 'click', function(e){
			id = $(this).attr('href');
			$(id+'-item').html('<img src="<?php echo get_template_directory_uri(); ?>/images/default-noimage-150x150.jpg" />');
			$(id+'-id').val('');
			$(id+'-link').val('');
			$(id+'-iframe').val('');
			$(id+'-gallery').val('');
			e.preventDefault();
		});
		
		$('body').delegate('.addheader', 'click', function(e) {
			$('.header-loading').show();
			$('.addheader').attr('disabled', true);
			var data = {
				action: 'header_form_content',	
				ctr: $(".header").length
			};
			
			$.post(
				ajaxurl, 
				data,
				function(output){
					$('#headerlist').append(output);
					uploadfile();
					$('.header-loading').hide();
					$('.addheader').attr('disabled', false);
				}
			);					
			e.preventDefault();
		});
		
		$('body').delegate('.removeheader', 'click', function() {
			$(this).parent().remove();
		});
		
		/*tab for textarea content*/
		$('body').delegate('.textarea-editor', 'keydown', function(e) {
			var keyCode = e.keyCode || e.which;
			if (keyCode == 9) {
				e.preventDefault();
				var start = $(this).get(0).selectionStart;
				var end = $(this).get(0).selectionEnd;
				$(this).val($(this).val().substring(0, start) + "\t" + $(this).val().substring(end));
				$(this).get(0).selectionStart =	$(this).get(0).selectionEnd = start + 1;
			}
		});
		
		/*Display Widget containers that has active contents*/
		jQuery('.widgets-holder-wrap').each(function(){
			var widgetContent = jQuery(this).find('.widget');
			if(!widgetContent.attr('id')==""){
				jQuery(this).removeClass('closed');
			}
		});

		uploadfile();
		
	});
	
	function uploadfile(){
		$('body').delegate('.upload-media-button', 'click', function( e ) {
			var id = $(this).attr('href');
			var send_attachment_bkp = wp.media.editor.send.attachment;
			var clone = wp.media.gallery.shortcode;

			wp.media.editor.send.attachment = function(props, attachment) {
				$(id+'-id').val(attachment.id);
				$(id+'-item').html('<img src="'+attachment.url+'" />');
				wp.media.editor.send.attachment = send_attachment_bkp;
			}
			
			wp.media.gallery.shortcode = function(attachments) {
				images = attachments.pluck('id');
				$(id+'-gallery').val(images);
				$(id+'-item').html('<img src="<?php echo get_template_directory_uri(); ?>/images/default-gallery-150x150.jpg" />');				
				wp.media.gallery.shortcode = clone;
				var shortcode = new Object();
				shortcode.string = function() {return ''};
				return shortcode;
			}

			wp.media.editor.open();
			e.preventDefault();
		});
	}	
	</script>
<?php }

/* end settings */
?>