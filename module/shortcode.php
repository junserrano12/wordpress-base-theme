<?php 

/*[get_bpgtag]*/
function get_bpgtag_shortcode( $atts ){
	global $post;
	get_settings_option('hotelid','general_option');

	$link = isset($atts['link']) ? $atts['link'] : 'http://reservations.directwithhotels.com/reservation/selectDates/'.get_settings_option('hotelid', 'general_option').'/campaign/';
	$idname = isset($atts['name']) ? $atts['name'] : 'bpgtag-container';
	$ctalabel = isset($atts['label']) ? $atts['label'] : 'Check availability and prices';
	$listclass = isset($atts['listclass']) ? $atts['listclass'] : 'list-check';
	$listitems = isset($atts['listitems']) ? $atts['listitems'] : null;
	$addlistitems = isset($atts['addlistitems']) ? $atts['addlistitems'] : null;
	$bpgbadge = isset($atts['bpgbadge']) ? $atts['bpgbadge'] : get_template_directory_uri().'/images/bpg-badge.png';
	$breaklist = isset($atts['breaklist']) ? $atts['breaklist'] : false;
	$style = isset($atts['style']) ? $atts['style'] : null;


	$output .= '<style>';
	$output .= '#bpgtag-container{text-align:center;}';
	$output .= '#bpgtag-container .control-wrapper{display:inline-block; vertical-align:middle;}';
	$output .= '#bpgtag-container .list-check{list-style-image:url('.get_template_directory_uri().'/images/check-icon.png); margin:0 0 0 2.2em;}';
	$output .= '#bpgtag-container .list-check li{vertical-align:top; text-align:left;}';
	$output .= '#bpgtag-container .bpgcta-container a{padding:2em 20px; text-align:center; width:180px;}';
	$output .= '</style>';
	
	$output .= '<div id="'.$idname.'">';
	$output	.= '	<div class="control-wrapper bpgbadge-container">';
	$output	.= '		<img src="'.$bpgbadge.'" alt="" title="">';
	$output	.= '	</div>';
	$output	.= '	<div class="control-wrapper bpglistitem-container">';
	$output .= '		<ul class="'.$listclass.'">';

	if ($listitems != null) {
		$listitems = explode(',', $listitems);
		foreach ($listitems as $listitem) {
			$output .= '<li>'.$listitem.'</li>';
		}
	} else {

	$output .= '			<li>No prepayment required</li>';
	$output .= '			<li>Get instant confirmation</li>';

	if($breaklist){
	$output .= '</ul></div><div class="control-wrapper bpglistitem-container"><ul class="'.$listclass.'">';
	}
	
	$output .= '			<li>Secured booking engine</li>';
	$output .= '			<li>4-step booking process</li>';
	$output .= '			<li>free cancelation</li>';

	if($addlistitems != null){

		if($breaklist){
		$output .= '</ul></div><div class="control-wrapper bpglistitem-container"><ul class="'.$listclass.'">';
		}

		$addlistitems = explode(',', $addlistitems);
		foreach ($addlistitems as $addlistitem) {
			$item = explode('|link|', $addlistitem);
			if($item[1] != null) {
				$output .= '<li><a href="'.$item[1].'">'.$item[0].'</a></li>';
			}
			else{
				$output .= '<li>'.$item[0].'</li>';
			}
		}
	}

	}

	$output .= '		</ul>';
	$output	.= '	</div>';
	$output	.= '	<div class="control-wrapper bpgcta-container">';
	$output	.= '		<a class="ctalink button" href="'.$link.'">'.$ctalabel.'</a>';
	$output	.= '	</div>';
	$output .= '</div>';
	
	return $output;
}
add_shortcode( 'get_bpgtag', 'get_bpgtag_shortcode' );

/*[get_testimonials]*/
function get_testimonial_shortcode( $atts ){
	global $post;
	
	$idname = isset($atts['name']) ? $atts['name'] : 'testimonial-container';
	$testimonials = get_post_meta($post->ID, 'testimonials', false);	
	$output  = '<div id="'.$idname.'">';
	$output .= '<h3>Testimonails</h3>';
	
	foreach($testimonials as $testimonial){
	$output .= '	<div class="testimonial-content">';
	$output .= '		<blockquote>';
	$output .= $testimonial;
	$output .= '		</blockquote>';
	$output .= '	</div>';
	}	
	
	$output .= '</div>';	
	
	return $output;
}
add_shortcode( 'get_testimonials', 'get_testimonial_shortcode' );

/*[get_iframe]*/
function get_iframe_shortcode( $atts ){
	$idname = isset($atts['name']) ? $atts['name'] : 'iframe-container';
	$src	= isset($atts['src']) ? $atts['src'] : null;
	$style	= isset($atts['style']) ? $atts['style'] : null;
	$param 	= isset($atts['param']) ? $atts['param'] : null;
	$iframe  = "<div id=\"$idname\">";
	$iframe .= "	<iframe $param style=\"$style\" src=\"$src\" class=\"iframe-content\"></iframe>";
	$iframe .= "</div>";
	
	return $iframe;
}
add_shortcode( 'get_iframe', 'get_iframe_shortcode' );

/*[get_fblike]*/
function get_fblike_shortcode( $atts ){
	$defaulturl = 'http://'.get_mapped_domain();
	$fblikehref = get_value($atts['url'], $defaulturl);
	$fblayout = get_value($atts['layout'], 'standard');
	$fblikecolorshceme = get_value($atts['colorscheme'], 'light');
	$fbcontainer = '<div id="fb-like-container"><div class="fb-like" data-href="'.$fblikehref.'" data-layout="'.$fblayout.'" data-action="like" data-show-faces="false" data-share="false" data-colorshceme="'.$fblikecolorshceme.'"></div></div>';
	return $fbcontainer;
}
add_shortcode( 'get_fblike', 'get_fblike_shortcode' );

function add_fblike_jscode(){ ?>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
<?php }
add_action('insert_fblike_jscode', 'add_fblike_jscode');

/*[get_map]*/
function get_map_shortcode( $atts ){
	$locationiframe = get_settings_option('locationiframe','general_option');
	$style = isset($atts['style']) ? 'style="'.$atts['style'].'"' : null;

	if($locationiframe != null){
		$mapcontainer = $locationiframe;	
	} else {
		$mapcontainer = '<div id="map-canvas" '.$style.'></div>';
	}
	return $mapcontainer;
}
add_shortcode( 'get_map', 'get_map_shortcode' );

/*[get_address]*/
function get_address_shortcode( $atts ){
	if($atts != null){
		$param = $atts;
	} else {
		$param = array('isnotinline'=>true);	
	}
	return get_address($param);
}
add_shortcode( 'get_address', 'get_address_shortcode' );

/*[gallery_tab]*/
function get_gallery_tab_shortcode( $atts ){
	$imageids = explode(',', $atts['ids']);	
	$tabcontainername = ($atts['name'] != null) ? '-'.$atts['name'] : 'tab-container';
	$output	 = '<div id="'.$tabcontainername.'" class="gallery-container">';
	$output .= '<ul class="tab-menu">';
	$first = true;
	foreach($imageids as $imageid){
		$attachment = get_post($imageid);
		$customlink = get_post_meta($imageid, '_rt-image-link', true); 
		if($first) {
			$output .= '<li><a href="#tabmenucontainer'.$imageid.'" class="active">'.$attachment->post_title.'</a></li>';
			$first = false;
		} else {
			$output .= '<li><a href="#tabmenucontainer'.$imageid.'">'.$attachment->post_title.'</a></li>';
		}
	}
	$first=true;
	$output .= '</ul>';
	foreach($imageids as $imageid){
		$attachment = get_post($imageid);
		$customlink = get_post_meta($imageid, '_rt-image-link', true);		
		$titletext = get_value(get_post_meta($imageid, '_rt-image-title-text', true), $attachment->post_title);
		$alttext = get_value(get_post_meta($imageid, '_rt-image-alt-text', true), $attachment->post_title);	

		if($first) {
			$output .= '<div id="tabmenucontainer'.$imageid.'" class="tab-container show">';
			$output .= '	<div class="tab-content">';
			$output .= '		<div class="row-fluid">';
			$output .= '			<div class="span4">';
			$output .= '				<div class="image-container">';
			$output .= '					<a class="colorbox" href="'.wp_get_attachment_image_src($imageid, 'full')[0].'"><img src="'.wp_get_attachment_image_src($imageid, 'medium')[0].'" alt="'.$alttext.'" title="'.$titletext.'"/></a>';
			$output .= '				</div>';
			$output .= '			</div>';
			$output .= '			<div class="span8">';
			$output .= '				<p class="sub-title">'.$attachment->post_title.'</p>';
			$output .= '				<div>'.$attachment->post_content.'</div>';
			$output .= '			</div>';
			$output .= '		</div>';
			$output .= '	</div>';
			$output .= '</div>';
			$first = false;
		} else {
			$output .= '<div id="tabmenucontainer'.$imageid.'" class="tab-container">';
			$output .= '	<div class="tab-content">';
			$output .= '		<div class="row-fluid">';
			$output .= '			<div class="span4">';
			$output .= '				<div class="image-container">';
			$output .= '					<a class="colorbox" href="'.wp_get_attachment_image_src($imageid, 'full')[0].'"><img src="'.wp_get_attachment_image_src($imageid, 'medium')[0].'" /></a>';
			$output .= '				</div>';
			$output .= '			</div>';
			$output .= '			<div class="span8">';
			$output .= '				<p class="sub-title">'.$attachment->post_title.'</p>';
			$output .= '				<div>'.$attachment->post_content.'</div>'; 
			$output .= '			</div>';
			$output .= '		</div>';
			$output .= '	</div>';
			$output .= '</div>';
		}
	}
	$output	 .= '</div>';
	
	return $output;
}
add_shortcode( 'gallery_tab', 'get_gallery_tab_shortcode' );

/*[gallery_teaser]*/
function get_gallery_teaser_shortcode( $atts ){
	$imageids = explode(',', $atts['ids']);	
	$columns = 12 / get_value($atts['columns'], 3);
	$spandiv = get_value($atts['columns'], 3);
	$readmore = get_value($atts['readmore'], 'Read More');
	$imagesize = get_value($atts['imagesize'], 'medium');
	$teaserlink = get_value($atts['teaserlink'], 'Read More');
	$teaserlinktext = isset($atts['teaserlinktext']) ? $atts['teaserlinktext'] : $teaserlink;
	$titleontop = get_value($atts['titleontop'], false);
	
	$output  = '<div id="teaser-container">';
	$output .= '	<div class="row-fluid">';
	
	foreach($imageids as $key=>$imageid){
		$ctr = $key+1;	
		$attachment = get_post($imageid);
		$customlink = get_post_meta($imageid, '_rt-image-link', true); 
		$titletext = get_post_meta($imageid, '_rt-image-title-text', true);		
		$alttext = get_post_meta($imageid, '_rt-image-alt-text', true);		
		
		$output .= '<div class="span'.$columns.'">';
		if($titleontop) {
		$output .= '	<p class="sub-title">'.$attachment->post_title.'</p>';
		}
		$output .= '	<div class="teaser-box">';
		$output .= '		<div class="image-container">';
		$output .= '			<a href="'.$customlink.'"><img src="'.wp_get_attachment_image_src($imageid, $imagesize)[0].'" alt="'.$alttext.'" title="'.$titletext.'" /></a>';
		$output .= '		</div>';
		$output .= '		<div class="teaser-details">';
		if(!$titleontop) {
		$output .= '			<p class="sub-title">'.$attachment->post_title.'</p>';
		}		
		if($attachment->post_excerpt != null)
		$output .= '			<p>'.$attachment->post_excerpt.'</p>';

		if($teaserlink != 'false' || !$teaserlink)
		$output .= '			<a class="teaserlink link" href="'.$customlink.'">'.$teaserlinktext.'</a>';

		$output .= '		</div>';
		$output .= '	</div>';
		$output .= '	<div class="teaser-content">';
		$output .= '		<p>'.$attachment->post_content.'</p>';
		
		if($readmore != 'false')
		$output .= '		<a class="readmore link" href="'.$customlink.'">'.$readmore.'</a>';		
		
		$output .= '	</div>';
		$output .= '</div>';

		if( ( $ctr % $spandiv ) === 0 ){
			if( $ctr !== count($imageids) ){
				$output .= '</div>';
				$output .= '<div class="row-fluid">';							
			} 
		}		
	}
	$output	 .= '	</div>';
	$output	 .= '</div>';
	
	return $output;
}
add_shortcode( 'gallery_teaser', 'get_gallery_teaser_shortcode' );

/*[gallery_accordion]*/
function get_gallery_accordion_shortcode( $atts ){
	$imageids = explode(',', $atts['ids']);	
	$accordioncontainername = ($atts['name'] != null) ? '-'.$atts['name'] : 'accordion-container';
	$ctabuttonlink = get_value($atts['ctabuttonlink'], 'Check availability and price');
	$class = get_value($atts['class'], 'button ctapackage');
	$ctabutton = get_value($atts['ctabutton'], false);
	$imageiscolorbox = get_value($atts['iscolorbox'], true);
	$isfirst = 'active';

	$output	 = '<div id="'.$accordioncontainername.'">';
	$output .= '<ul class="list-accordion">';
	foreach($imageids as $key=>$imageid){
		$attachment = get_post($imageid);
		$customlink = get_value(get_post_meta($imageid, '_rt-image-link', true), 'http://reservations.directwithhotels.com/reservation/selectDates/'.get_settings_option('hotelid', 'general_option').'/campaign/');
		$titletext = get_value(get_post_meta($imageid, '_rt-image-title-text', true), $attachment->post_title);
		$alttext = get_value(get_post_meta($imageid, '_rt-image-alt-text', true), $attachment->post_title);
		$iscolorbox = ($imageiscolorbox) ? 'colorbox' : 'accordion-link';
		$imagelink = ($imageiscolorbox) ? wp_get_attachment_image_src($imageid, 'full')[0] : $customlink;		

		$output .= '<li class="accordion-item">';
		$output .= '	<div class="accordion-caption"><a href="#accordion-content-'.$key.'" class="'.$isfirst.'">'.$attachment->post_title.'</a></div>';
		$output .= '	<div id="accordion-content-'.$key.'" class="accordion-content">';
		$output .= '		<div class="row-fluid">';
		$output .= '			<div class="span3">';
		$output .= '				<div class="image-container">';
		$output .= '					<a class="'.$iscolorbox.'" href="'.$imagelink.'"><img src="'.wp_get_attachment_image_src($imageid, 'medium')[0].'" alt="'.$alttext.'" title="'.$titletext.'"/></a>';
		$output .= '				</div>';
		$output .= '			</div>';
		$output .= '			<div class="span9">';
		$output .= '				<p class="sub-title">'.$attachment->post_title.'</p>';
		$output .= '				<p>'.$attachment->post_content.'</p>';
		if($ctabutton){
		$output .= '				<a href="'.$customlink.'" class="'.$class.'">'.$ctabuttonlink.'</a>';
		}
		$output .= '			</div>';
		$output .= '		</div>';
		$output .= '	</div>';
		$output .= '</li>';
		
		$isfirst = null;
	}
	$output .= '</ul>';
	
	return $output;
}
add_shortcode( 'gallery_accordion', 'get_gallery_accordion_shortcode' );

/*[gallery_grid]*/
function get_gallery_grid_shortcode( $atts ){
	$imageids = explode(',', $atts['ids']);	
	$gridcontainername = ($atts['name'] != null) ? '-'.$atts['name'] : 'gallery-grid-container';
	$caption = get_value($atts['caption'], false);
	$title = get_value($atts['title'], false);
	$titleontop = get_value($atts['titleontop'], false);
	$textalign = get_value($atts['textalign'], 'center');
	$columns = 12 / get_value($atts['columns'], 4);
	$spandiv = get_value($atts['columns'], 4);
	$rel = get_value($atts['rel'], 'group');
	$colorbox = get_value($atts['colorbox'], 'colorbox-group');
	$imagesize = isset($atts['imagesize']) ? $atts['imagesize'] : 'medium';
	
	$output	 = '<div id="'.$gridcontainername.'">';
	$output .= '	<div class="row-fluid">';	
	foreach($imageids as $key=>$imageid){
		$ctr = $key+1;
		$attachment = get_post($imageid);
		$customlink = get_post_meta($imageid, '_rt-image-link', true);		
		$titletext = get_value(get_post_meta($imageid, '_rt-image-title-text', true), $attachment->post_title);
		$alttext = get_value(get_post_meta($imageid, '_rt-image-alt-text', true), $attachment->post_title);
		$imagelink = get_value($customlink, wp_get_attachment_image_src($imageid, array(800, 800))[0]);
		
		$output .= '<div id="grid-item-'.$key.'" class="span'.$columns.'">';
		if($titleontop){
		$output .= '	<p class="align-'.$textalign.' '.$caption.'">'.$attachment->post_title.'</p>';  
		}
		$output .= '	<div class="image-container">';
		$output .= '		<a class="'.$colorbox.'" rel="'.$rel.'" href="'.$imagelink.'"><img src="'.wp_get_attachment_image_src($imageid, $imagesize)[0].'" alt="'.$alttext.'" title="'.$titletext.'"/></a>';
		$output .= '	</div>';
		if($caption || $title && !$titleontop){ 
		$output .= '	<p class="align-'.$textalign.' '.$caption.'">'.$attachment->post_title.'</p>';  
		}
		$output .= '</div>';
		
		if( ( $ctr % $spandiv ) === 0 ){
			if( $ctr !== count($imageids) ){
				$output .= '</div>';
				$output .= '<div class="row-fluid">';							
			} 
		}		
		
	}
	$output .= '	</div>';
	$output .= '</div>';
	
	return $output;
}
add_shortcode( 'gallery_grid', 'get_gallery_grid_shortcode' );

/*****************************************************************/
/*administrator shortcode										 */
/*****************************************************************/

/*[get_wordpress_data]*/
function get_wordpress_data_shortcode(){
	global $wpdb;
	$prefix = $wpdb->base_prefix;
	$table = $prefix.'blogs';
	$query = $wpdb->get_results( "SELECT * From $table" );
	$ctr = 0;
	$output  = '<style>';
	$output .= '.dwh_wp_data_table{margin:1em 0; padding:1em 0; background:#333; font-family:sans-serif; width:100%;}';
	$output .= '.dwh_wp_data_table a{text-decoration:none;}';
	$output .= '.dwh_wp_data_table tr:nth-child(odd){background:#252525;}';
	$output .= '.dwh_wp_data_table tr:hover{background:#F67921;}';
	$output .= '.dwh_wp_data_table th{background:#555; padding:6px;}';
	$output .= '.dwh_wp_data_table td{padding:6px;}';
	$output .= '</style>';
	
	$output .= '<table class="dwh_wp_data_table" cellpadding="0" cellspacing="0">';
	$output .= '	<tr>';
	$output .= '		<th></th>';
	$output .= '		<th>Blog ID</th>';
	$output .= '		<th>Domain</th>';
	$output .= '		<th>Theme Template</th>';
	$output .= '		<th>Map Domain</th>';
	$output .= '		<th>BPG</th>';
	$output .= '		<th>Hotel ID</th>';
	$output .= '		<th>WP Registered</th>';
	$output .= '		<th>Status</th>';
	$output .= '	</tr>';
	foreach($query as $value){
		$blogid = $value->blog_id;
		$date = new DateTime($value->registered);
		$blogregister = $date->format('M j, Y, g:i a');
		$blogdomain = $value->domain;
		$deactivated = ($value->deleted) ? 'Deactivated' : '';
		$blogoptiontemplate = get_blog_option($blogid, 'template');		
		$blogoptionstyleoption = get_blog_option($blogid, 'style_option');
		$blogoptiongeneraloption = get_blog_option($blogid, 'general_option');
		$isbpg = ($blogoptionstyleoption['bpgisenable'])? 'true' : '';
		
		if($blogoptiontemplate === 'AW_v4.0' || $blogoptiontemplate === 'AW_Testing_v4.0' ){
			$ctr++;
			$output .= '<tr>';
			$output .= '	<td>'.$ctr.'</td>'; 
			$output .= '	<td>'.$blogid.'</td>'; 
			$output .= '	<td><a target="_blank" href="http://'.$blogdomain.'">'.$blogdomain.'</a></td>'; 
			$output .= '	<td>'.$blogoptiontemplate.'</td>'; 
			$output .= '	<td>'.$blogoptiongeneraloption['hoteldomain'].'</td>';
			$output .= '	<td>'.$isbpg.'</td>'; 
			$output .= '	<td>'.$blogoptiongeneraloption['hotelid'].'</td>'; 
			$output .= '	<td>'.$blogregister.'</td>';			
			$output .= '	<td>'.$deactivated.'</td>';			
			$output .= '</tr>';
		} 
	}
	$output .= '</table>';

	$output .= '<hr />';
	
	$ctr = 0;
	$output .= '<table class="dwh_wp_data_table" cellpadding="0" cellspacing="0">';
	$output .= '	<tr>';
	$output .= '		<th></th>';
	$output .= '		<th>Blog ID</th>';
	$output .= '		<th>Domain</th>';
	$output .= '		<th>Theme Template</th>';
	$output .= '		<th>Map Domain</th>';
	$output .= '		<th>BPG</th>';
	$output .= '		<th>Hotel ID</th>';
	$output .= '		<th>WP Registered</th>';
	$output .= '		<th>Status</th>';
	$output .= '	</tr>';
	foreach($query as $value){
		$blogid = $value->blog_id;
		$blogdomain = $value->domain;
		$date = new DateTime($value->registered);
		$blogregister = $date->format('M j, Y, g:i a');
		$deactivated = ($value->deleted) ? 'Deactivated' : '';
		$blogoptiontemplate = get_blog_option($blogid, 'template');		
		$blogoptionstyleoption = get_blog_option($blogid, 'style_option');
		$blogoptiongeneraloption = get_blog_option($blogid, 'general_option');
		$isbpg = ($blogoptionstyleoption['bpgisenable'])? 'true' : '';
		$iscorptsite = ($blogoptionstyleoption['ctaiscalendarcorpsite'])? 1 : 0;
		if(!$iscorptsite){
			if($blogoptiontemplate === 'NW_v3.0'){
				$ctr++;
				$output .= '<tr>';
				$output .= '	<td>'.$ctr.'</td>'; 
				$output .= '	<td>'.$blogid.'</td>'; 
				$output .= '	<td><a target="_blank" href="http://'.$blogdomain.'">'.$blogdomain.'</a></td>'; 
				$output .= '	<td>'.$blogoptiontemplate.'</td>'; 
				$output .= '	<td>'.$blogoptiongeneraloption['hoteldomain'].'</td>';
				$output .= '	<td>'.$isbpg.'</td>'; 
				$output .= '	<td>'.$blogoptiongeneraloption['hotelid'].'</td>';
				$output .= '	<td>'.$blogregister.'</td>';			
				$output .= '	<td>'.$deactivated.'</td>';			
				$output .= '</tr>';
			} 
		}
	}
	$output .= '</table>';

	$output .= '<hr />';
	
	$ctr = 0;
	$output .= '<table class="dwh_wp_data_table" cellpadding="0" cellspacing="0">';
	$output .= '	<tr>';
	$output .= '		<th></th>';
	$output .= '		<th>Blog ID</th>';
	$output .= '		<th>Domain</th>';
	$output .= '		<th>Theme Template</th>';
	$output .= '		<th>Map Domain</th>';
	$output .= '		<th>BPG</th>';
	$output .= '		<th>Hotel ID</th>';
	$output .= '		<th>WP Registered</th>';
	$output .= '	</tr>';
	foreach($query as $value){
		$blogid = $value->blog_id;
		$blogdomain = $value->domain;
		$date = new DateTime($value->registered);
		$blogregister = $date->format('M j, Y, g:i a');
		$blogoptiontemplate = get_blog_option($blogid, 'template');		
		$blogoptionstyleoption = get_blog_option($blogid, 'style_option');
		$blogoptiongeneraloption = get_blog_option($blogid, 'general_option');
		$isbpg = ($blogoptionstyleoption['bpgisenable'])? 'true' : '';
		$iscorptsite = ($blogoptionstyleoption['ctaiscalendarcorpsite']);
		
		if($iscorptsite || $blogoptiontemplate === 'avilla-hotels'){
			$ctr++;
			$output .= '<tr>';
			$output .= '	<td>'.$ctr.'</td>'; 
			$output .= '	<td>'.$blogid.'</td>'; 
			$output .= '	<td><a target="_blank" href="http://'.$blogdomain.'">'.$blogdomain.'</a></td>'; 
			$output .= '	<td>'.$blogoptiontemplate.'</td>'; 
			$output .= '	<td>'.$blogoptiongeneraloption['hoteldomain'].'</td>';
			$output .= '	<td>'.$isbpg.'</td>'; 
			$output .= '	<td>'.$blogoptiongeneraloption['hotelid'].'</td>';
			$output .= '	<td>'.$blogregister.'</td>';			
			$output .= '</tr>';
		} 
	}
	$output .= '</table>';

	$output .= '<hr />';
	
	$ctr = 0;
	$output .= '<table class="dwh_wp_data_table" cellpadding="0" cellspacing="0">';
	$output .= '	<tr>';
	$output .= '		<th></th>';
	$output .= '		<th>Blog ID</th>';
	$output .= '		<th>Domain</th>';
	$output .= '		<th>Theme Template</th>';
	$output .= '		<th>Map Domain</th>';
	$output .= '		<th>BPG</th>';
	$output .= '		<th>Hotel ID</th>';
	$output .= '		<th>WP Registered</th>';
	$output .= '	</tr>';
	foreach($query as $value){
		$blogid = $value->blog_id;
		$blogdomain = $value->domain;
		$date = new DateTime($value->registered);
		$blogregister = $date->format('M j, Y, g:i a');
		$blogoptiontemplate = get_blog_option($blogid, 'template');		
		$blogoptionstyleoption = get_blog_option($blogid, 'style_option');
		$blogoptiongeneraloption = get_blog_option($blogid, 'general_option');
		$isbpg = ($blogoptionstyleoption['bpgisenable'])? 'true' : '';
				
		if($blogoptiontemplate !== 'NW_v3.0' && $blogoptiontemplate !== 'AW_v4.0' && $blogoptiontemplate !== 'AW_Testing_v4.0' && $blogoptiontemplate !== 'avilla-hotels'){
			$ctr++;
			$output .= '<tr>';
			$output .= '	<td>'.$ctr.'</td>'; 
			$output .= '	<td>'.$blogid.'</td>'; 
			$output .= '	<td><a target="_blank" href="http://'.$blogdomain.'">'.$blogdomain.'</a></td>'; 
			$output .= '	<td>'.$blogoptiontemplate.'</td>'; 
			$output .= '	<td>'.$blogoptiongeneraloption['hoteldomain'].'</td>';
			$output .= '	<td>'.$isbpg.'</td>'; 
			$output .= '	<td>'.$blogoptiongeneraloption['hotelid'].'</td>';
			$output .= '	<td>'.$blogregister.'</td>';
			$output .= '</tr>';
		} 
	}
	$output .= '</table>';	
	return $output;
}
add_shortcode( 'get_wordpress_data', 'get_wordpress_data_shortcode' );

/*end of shortcode*/
?>