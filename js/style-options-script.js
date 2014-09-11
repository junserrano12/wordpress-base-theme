var $ = jQuery.noConflict();$(document).ready(function() {
	//upload
	$('.button-upload').live('click', function( e ) {
		var id = $(this).attr('href');
		var send_attachment_bkp = wp.media.editor.send.attachment;
		wp.media.editor.send.attachment = function(props, attachment) {
			$(id+' .image-container img').attr('src', attachment.url);
			$(id+' .text-upload').val(attachment.url);
			wp.media.editor.send.attachment = send_attachment_bkp;
		}
		wp.media.editor.open();
		e.preventDefault();
	});

	//remove
	$('.button-remove').live('click', function(e){
		var id = $(this).attr('href');
		$(id+' .image-container img').attr('src', './wp-content/themes/awtemplate/images/default-noimage.png');
		$(id+' .text-upload').val('none');
		e.preventDefault();
	});
	
	// Tab Menu
	$('.tab-menu a').click(function(e){
		id = $(this).attr('href');
		$('.tab-menu a').removeClass('active');
		$('.tab-container').removeClass('show');
		$(this).addClass('active');
		$(id).addClass('show');
		e.preventDefault();
	});
	
	//Checkbox
	$('.checkbox').live('change', function( e ) {
		if( $(this).is(':checked') ){
			$(this).val('true').attr('checked', true);
			$('.bpgisenablevalue').val('true');
		} else {
			$(this).val('false').attr('checked', false);
			$('.bpgisenablevalue').val('false');			
		}
	});
});