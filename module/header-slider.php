<?php 
function header_inner_custom_box($post) {
    wp_nonce_field( 'header_inner_custom_box', 'header_meta_noncename' );
    ?>
    <div id="headerlist">
		<?php
		$headers = get_post_meta($post->ID,'header',true);
		if ( is_array($headers) ) {
			foreach( $headers as $key => $header ) {
				echo header_content($key, $header);
			}
		}
		?>
	</div>	
	<div>
		<input type="button" class="addheader button-primary" value="<?php _e('Add header'); ?>" />
		<img src="<?php echo admin_url('/images/wpspin_light.gif'); ?>" class="header-loading" style="display:none;" >
	</div>
	<?php
}

/* Ajax Callback */
function header_form_content_callback(){
	$ctr = isset($_POST['ctr']) ? $_POST['ctr']+1 : null;
	$output = header_content($ctr, null);
	wp_send_json($output);
	die();
}

/* Ajax Callback Content */
function header_content($ctr, $header){
	$header['imgid'] = isset($header['imgid'])? $header['imgid'] : null;
	$header['iframe'] = isset($header['iframe'])? $header['iframe'] : null;
	$header['gallery'] = isset($header['gallery'])? $header['gallery'] : null;
	$headersrc = ($header['imgid'] != null)? wp_get_attachment_image_src($header['imgid'], 'full')[0] : get_template_directory_uri().'/images/default-noimage-150x150.jpg';
	
	$headerformcontent  = '<div class="header">';
	$headerformcontent .= '	<h2>Header '.$ctr.'</h2>';
	/* remove */
	$headerformcontent .= '	<a style="display:block; position:relative; margin:10px 2px;" href="#?" class="removeheader deletion">Remove Header</a>';

	/* upload image */
	$headerformcontent .= '	<table>';
	$headerformcontent .= '		<tr class="header-input-container">';
	$headerformcontent .= '			<td valign="top">';
	$headerformcontent .= '				<div id="header-media-url-image-'.$ctr.'-item" class="custom-image-container">';
	if($header['gallery'] != null){
		$images = explode(',', $header['gallery']);
		foreach($images as $imagesrcid){
			$headerformcontent .= '				<img src="'.wp_get_attachment_image_src($imagesrcid, 'thumbnail')[0].'" style="width:33%; height:33%; overflow:hidden; float:left">';
		}
	} else {
		$headerformcontent .= '					<img src="'.$headersrc.'" />';	
	}
	$headerformcontent .= '				</div>';
	$headerformcontent .= '			</td>';
	$headerformcontent .= '			<td valign="top">';
	/* $headerformcontent .= '				<label class="label">URL: </label><input id="header-media-url-image-'.$ctr.'-link" type="text" name="header['.$ctr.'][link]" value="'.$header['link'].'" />'; */
	$headerformcontent .= '				<input id="header-media-url-image-'.$ctr.'-iframe" type="text" name="header['.$ctr.'][iframe]" value="'.esc_html($header['iframe']).'" placeholder="IFRAME" style="width:100%;"/>';
	$headerformcontent .= '				<a href="#header-media-url-image-'.$ctr.'" class="upload-media-button button">Upload Media</a>';
	$headerformcontent .= '				<a href="#header-media-url-image-'.$ctr.'" class="deleteheader delete-image">Clear</a><br>';
	$headerformcontent .= '				<input id="header-media-url-image-'.$ctr.'-gallery" type="hidden" name="header['.$ctr.'][gallery]" value="'.$header['gallery'].'" />';
	$headerformcontent .= '				<input id="header-media-url-image-'.$ctr.'-id" type="hidden" name="header['.$ctr.'][imgid]" value="'.$header['imgid'].'" />';
	$headerformcontent .= '			</td>';
	$headerformcontent .= '		</tr>';
	$headerformcontent .= '	</table>';
	$headerformcontent .= '	<hr class="seperator">';
	$headerformcontent .= '</div>';
	
	return $headerformcontent;
}

/* Save Edit Update Custom Field */
function header_save_postdata( $post_id ) {

	if ( ! isset( $_POST['header_meta_noncename'] ) )
		return $post_id;

	$nonce = $_POST['header_meta_noncename'];

	if ( ! wp_verify_nonce( $nonce, 'header_inner_custom_box' ) )
		return $post_id;

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return $post_id;

	if ( 'page' == $_POST['post_type'] ) {

	if ( ! current_user_can( 'edit_page', $post_id ) )
			return $post_id;
  
	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) )
			return $post_id;
	}

	$header = $_POST['header'];
	update_post_meta( $post_id, 'header', $header );

} 

?>