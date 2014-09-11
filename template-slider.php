<div id="slider" class="flexslider">
	<ul class="slides">
		<?php 
		$customheader = get_post_meta($post->ID, 'header', true);
		$customheadercount = count($customheader);

		if(get_settings_option('defaultbannerimageid', 'style_option') != null || get_settings_option('defaultbannerimageid', 'style_option') != ''){
			$imgsrcid = get_settings_option('defaultbannerimageid', 'style_option');
		} else {
			$page = get_page_by_title( 'Home' );
			$imgsrcidfield = get_post_meta($page->ID, 'header', true);
			if( $imgsrcidfield[1]['gallery'] != null ) { 
				$imgsrcids = explode(',', $imgsrcidfield[1]['gallery']);
				$imgsrcid = $imgsrcids[0];
			} else {
				$imgsrcid = $imgsrcidfield[1]['imgid'];
			}		
		}
		
		$defaultheader = get_value(wp_get_attachment_image_src($imgsrcid, 'full'), null);

		if($customheader != null) {
			foreach( $customheader as $ctr => $header ) { 
				if($header['iframe'] != null || $header['iframe'] != ''){ ?>
					<li>
						<div class="slider-iframe-container">
							<?php echo $header['iframe']; ?>
						</div>
					</li>
				<?php } else {
		
					if($header['gallery'] != null){
					
						$arrayimagesrcid = explode(',', $header['gallery']);
						foreach($arrayimagesrcid as $imagesrcid){
							$attachment = get_post($imagesrcid);
							$customlink = get_post_meta($imagesrcid, '_rt-image-link', true); ?>
							<li>
								<div class="slider-image-container">
									<?php if($customlink != null || $customlink != '') : ?>
										<a href="<?php echo $customlink; ?>"><img src="<?php echo wp_get_attachment_image_src($imagesrcid, 'full')[0]; ?>" class="header-image" title="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>" alt="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>"/></a>
									<?php else : ?>
										<img src="<?php echo wp_get_attachment_image_src($imagesrcid, 'full')[0]; ?>" class="header-image" title="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>" alt="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>"/>
									<?php endif;?>
								</div>
								<?php if($attachment->post_excerpt != null || $attachment->post_excerpt != '') { ?>
									<div class="slider-image-caption">
										<p><?php echo $attachment->post_excerpt; ?></p>
									</div>
								<?php } ?>
							</li>
						<?php }
						
					} else {
						if($header['imgid'] != null || $header['imgid'] != ''){ 
							$image_attributes = wp_get_attachment_image_src( $header['imgid'], 'full' );
							$attachment = get_post($header['imgid']); 
							$customlink = get_post_meta($header['imgid'], '_rt-image-link', true);	?>							
							<li>
								<div class="slider-image-container">
									<?php if($customlink != null || $customlink != '') : ?>
										<a href="<?php echo $customlink; ?>"><img src="<?php echo $image_attributes[0]; ?>" class="header-image" title="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>" alt="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>"/></a>
									<?php else : ?>
										<img src="<?php echo $image_attributes[0]; ?>" class="header-image" title="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>" alt="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>"/>
									<?php endif;?>
								</div>
								<?php if($attachment->post_excerpt != null || $attachment->post_excerpt != '') { ?>
									<div class="slider-image-caption">
										<p><?php echo $attachment->post_excerpt; ?></p>
									</div>
								<?php } ?>
							</li>
						<?php }
					}
				}
			}
		} elseif($defaultheader != null) { ?>
			<li>
				<div class="slider-image-container">
					<img src="<?php echo $defaultheader[0]; ?>" title="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>" alt="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>" />
				</div>
			</li>		
		<?php } else { ?>
			<li>
				<div class="slider-image-container">
					<img src="<?php echo get_template_directory_uri(); ?>/images/banner.jpg" title="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>" alt="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>" />
				</div>
			</li>
			<li>
				<div class="slider-image-container">
					<img src="<?php echo get_template_directory_uri(); ?>/images/banner.jpg" title="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>" alt="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>" />
				</div>
			</li>
			<li>
				<div class="slider-image-container">
					<img src="<?php echo get_template_directory_uri(); ?>/images/banner.jpg" title="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>" alt="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>" />
				</div>
			</li>
		<?php }	?>
	</ul>
</div>

	