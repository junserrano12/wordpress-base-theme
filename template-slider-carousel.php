<div id="slider-main" class="flexslider">
	<ul class="slides">
		<?php 
		$customheader = get_post_meta($post->ID, 'header', true);
		$customheadercount = count($customheader);

		$page = get_page_by_title( 'Home' );
		$defaultheader = get_post_meta($page->ID, 'header', true);
		
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
		} elseif($defaultheader != null) { 
			if( $defaultheader[1]['gallery'] != null ) { 
				$arrayimagesrcid = explode(',', $defaultheader[1]['gallery']);
				$imgsrcid = $arrayimagesrcid[0];
			} else {
				$imgsrcid = $defaultheader[1]['imgid'];
			}
		?>
			<li>
				<div class="slider-image-container">
					<img src="<?php echo wp_get_attachment_image_src($imgsrcid, 'full')[0]; ?>" title="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>" alt="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>" />
				</div>
			</li>				
		<?php } else { ?>
			<li>
				<div class="slider-image-container">
					<img src="<?php echo get_template_directory_uri(); ?>/images/banner.jpg" title="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>" alt="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>" />
				</div>
				<div class="slider-image-caption">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
				</div>
			</li>
			<li>
				<div class="slider-image-container">
					<img src="<?php echo get_template_directory_uri(); ?>/images/banner.jpg" title="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>" alt="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>" />
				</div>
				<div class="slider-image-caption">

				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
				</div>
			</li>
			<li>
				<div class="slider-image-container">
					<img src="<?php echo get_template_directory_uri(); ?>/images/banner.jpg" title="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>" alt="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>" />
				</div>
				<div class="slider-image-caption">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
				</div>
			</li>
		<?php }	?>
	</ul>
</div>
<div id="carousel-content">
	<div id="slider-carousel" class="flexslider">
		<?php if($customheader != null) {
		
				if($header['gallery'] != null){ ?>
						<ul class="slides">
						<?php foreach($arrayimagesrcid as $imagesrcid){
							$attachment = get_post($imagesrcid); ?>
							<li>
								<div class="image-container">
									<img src="<?php echo wp_get_attachment_image_src($imagesrcid, 'carousel-thumbnail')[0]; ?>" title="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>" alt="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>"/>
								</div>
								<span><?php echo $attachment->post_title; ?></span>
							</li>
						<?php } ?>
						
						</ul>

				<?php } else {
			
					if($customheadercount > 1) { ?>
						<ul class="slides">
							<?php foreach( $customheader as $ctr => $header ) { 
								if($header['imgid'] != null || $header['imgid'] != '') { 
									$attachment = get_post($header['imgid']);
									$image_attributes = wp_get_attachment_image_src( $header['imgid'], 'carousel-thumbnail' ); ?>
									<li>
										<div class="image-container">
											<img src="<?php echo $image_attributes[0]; ?>" title="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>" alt="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>"/>
										</div>
										<span><?php echo $attachment->post_title; ?></span>
									</li>
								<?php }
							} ?>
						</ul>
					<?php } ?>
				<?php }
		} elseif($defaultheader != null) { 
			/*dont insert carousel*/
		} else { ?>
			<ul class="slides">
				<li>
					<div class="image-container">
						<img src="<?php echo get_template_directory_uri(); ?>/images/banner.jpg" title="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>" alt="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>" />
					</div>
				</li>
				<li>
					<div class="image-container">
						<img src="<?php echo get_template_directory_uri(); ?>/images/banner.jpg" title="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>" alt="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>" />
					</div>
				</li>
				<li>
					<div class="image-container">
						<img src="<?php echo get_template_directory_uri(); ?>/images/banner.jpg" title="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>" alt="<?php echo get_settings_option('hotelname', 'general_option').' in '.get_settings_option('hotellocation', 'general_option'); ?>" />
					</div>
				</li>
			</ul>
		<?php }	?>
	</div>
</div>