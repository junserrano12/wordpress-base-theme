<?php
function page_inner_custom_box( $post ) {

	wp_nonce_field( 'page_inner_custom_box', 'page_inner_custom_box_nonce' );
	
	$h1title = get_post_meta( $post->ID, 'title_field', true );
	$address = get_post_meta( $post->ID, 'address_field', true );
	$pagetitle = get_post_meta( $post->ID, 'page_title_field', true );
	$metakeywords = get_post_meta( $post->ID, 'meta_keywords', true );
	$metadescription = get_post_meta( $post->ID, 'meta_description', true );
	$secondarycontent = get_post_meta($post->ID, 'secondary-content-container', true);
	
	echo '<div class="box" style="padding-bottom:2em; margin-bottom:1em; border-bottom:1px solid #ccc;">';
	echo '<p><strong>Copy Custom Fields</strong></p>';
	echo '<div class="control-wrapper" style="margin-bottom:1em;">';
	echo '<label for="title_field">';
		_e( "H1", 'basetheme' );
	echo '</label> ';
	echo '<input type="text" id="title_field" name="title_field" value="' . esc_attr( $h1title ) . '" style="width:100%" />';
	echo '</div>';

	echo '<div class="control-wrapper" style="margin-bottom:1em;">';
	echo '<label for="address_field">';
		_e( "Address", 'basetheme' );
	echo '</label> ';
	echo '<input type="checkbox" id="address_field" class="checkbox" name="address_field" value="'.$address.'" '.$result = ($address) ? 'checked="checked"' : null .' />';
	echo '</div>';
	
	echo '<div class="control-wrapper" style="margin-bottom:1em;">';
	echo '<label>';
		_e( "Secondary Content", 'basetheme' );
	echo '</label> ';
	$settings = array( 'media_buttons' => true, 'wpautop' => false, 'textarea_rows' => get_option('default_post_edit_rows', 10));
	wp_editor( $secondarycontent, 'secondary-content-container', $settings );
	echo '</div>';

	echo '</div>';
	
	echo '<div class="box">';
	echo '<p><strong>SEO Custom Fields</strong></p>';
	
	echo '<div class="control-wrapper" style="margin-bottom:1em;">';
	echo '<label for="page_title_field">';
       _e( "Meta Title", 'basetheme' );
	echo '</label> ';
	echo '<input type="text" id="page_title_field" name="page_title_field" value="' . esc_attr( $pagetitle ) . '" style="width:100%" />';
	echo '</div>';
  
	echo '<div class="control-wrapper" style="margin-bottom:1em;">';
    echo '<label for="meta_keywords">';
       _e( "Meta Keywords", 'basetheme' );
	echo '</label> ';
	echo '<input type="text" id="meta_keywords" name="meta_keywords" value="' . esc_attr( $metakeywords ) . '" style="width:100%" />';
	echo '</div>';
  
	echo '<div class="control-wrapper" style="margin-bottom:1em;">';
    echo '<label for="meta_description">';
       _e( "Meta Description", 'basetheme' );
	echo '</label> ';
	echo '<input type="text" id="meta_description" name="meta_description" value="' . esc_attr( $metadescription ) . '" style="width:100%" />';  
	echo '</div>';

	echo '</div>';
}

function page_save_postdata( $post_id ) {

	if ( ! isset( $_POST['page_inner_custom_box_nonce'] ) )
		return $post_id;
    
	$nonce = $_POST['page_inner_custom_box_nonce'];
    
	if ( ! wp_verify_nonce( $nonce, 'page_inner_custom_box' ) )
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
    
	$mydatatitle = $_POST['title_field'];
	$mydataaddress = $_POST['address_field'];
	$mydatapagetitle = $_POST['page_title_field'];
	$mydatakeywords = $_POST['meta_keywords'];
	$mydatadescription = $_POST['meta_description'];
	$mydatasecondarycontent = $_POST['secondary-content-container'];
    
	update_post_meta( $post_id, 'title_field', $mydatatitle );
	update_post_meta( $post_id, 'address_field', $mydataaddress );
	update_post_meta( $post_id, 'page_title_field', $mydatapagetitle );
	update_post_meta( $post_id, 'meta_keywords', $mydatakeywords );
	update_post_meta( $post_id, 'meta_description', $mydatadescription );
	update_post_meta( $post_id, 'secondary-content-container', $mydatasecondarycontent );

}

?>