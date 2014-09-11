<?php
/*Draw the menu page itself*/
function style_options_do_page() {
	?>
	<div id="style-settings" class="wrap">
		<?php screen_icon(); ?>
		<h2>Style Settings</h2>
		<form method="post" action="options.php">
			<?php 
			settings_fields('style_option_settings');  
			$options = get_option('style_option');
			/*Style Sheet*/
			$stylesheetid							= get_value($options['stylesheetid'], null);
			$stylesheeturl							= wp_get_attachment_url($stylesheetid);
			$stylesheetver							= get_value($options['stylesheetver'], '1.1.1');
			/*Insert Image*/
			$imageid								= get_value($options['imageid'], null);
			$imageurl								= wp_get_attachment_image_src($imageid, 'full')[0];
			$imagelist								= get_value($options['imagelist'], null);
			/*external font*/
			$getfontfamily							= get_value($options['getfontfamily'], '');
			/*cta isCalendar*/
			$ctaiscalendar							= get_value($options['ctaiscalendar'], 0);
			$ctaiscalendarcorpsite					= get_value($options['ctaiscalendarcorpsite'], 0);
			$removectabuttonincontent				= get_value($options['removectabuttonincontent'], 0);
			$removectaheader						= get_value($options['removectaheader'], 0);
			/*bpg*/
			$bpgisenable 							= get_value($options['bpgisenable'], 0);
			/*default banner*/
			$defaultbannerimageid					= get_value($options['defaultbannerimageid'], null);
			$defaultbannerimage						= wp_get_attachment_image_src($defaultbannerimageid, 'full');
			/*Default Style*/
			$defaultstyle							= get_default_style();
			/*Custom Style*/
			$customstyle							= get_value($options['customstyle'], '');
			/*Media Query Style*/
			$mediaquerythemestyle					= get_media_query_themestyle();
			$mediaquerystyle						= get_media_query_style($options['mediaquerystyle']);
			/*Theme*/
			$themestyle								= get_value($options['themestyle'], 'default');			
			$themeoptions							= array('default', 'style1', 'style2');
			$themedetails							= get_themedetails();
			?>
			
			<ul class="tab-menu">
				<li><a href="#customstyle" class="active">Custom Style</a></li>
				<li><a href="#mediaquerystyle">Media Query / Responsive</a></li>
				<li><a href="#ctastyle">Cta</a></li>
				<li><a href="#bestpricestyle">Best Price Guarantee</a></li>
				<li><a href="#bannerstyle">Banner</a></li>
				<li><a href="#fontstyle">Font</a></li>
				<li><a href="#themestyle">Theme Style</a></li>
			</ul>
			
			<div id="customstyle" class="tab-container show">			
				<h3>Custom Style</h3>						
				<table class="form-table">
					<tr valign="top">
						<td>
							<a href="#customstylecontent" class="button button-upload-media-item">Add/Upload Media</a>
							<textarea id="customstylecontent" class="textarea-editor" style="min-height:350px; width:100%;" name="style_option[customstyle]"><?php echo $customstyle; ?></textarea>
						</td>
					</tr>
				</table>				
				<h3>Custom Stylesheet</h3>
				<table id="custmstylesheet" class="simple-table">
					<tr valign="top">
						<td>
							<div class="uploader">
								<input type="text" class="regular-text image-src" value="<?php echo $stylesheeturl; ?>" readonly />
								<input type="text" class="regular-text" name="style_option[stylesheetver]" value="<?php echo $stylesheetver; ?>"/>
								<input type="hidden" class="image-id" name="style_option[stylesheetid]" value="<?php echo $stylesheetid; ?>"/>
								<a href="#custmstylesheet" class="button button-upload">Upload Css</a>
								<a href="#custmstylesheet" class="link button-remove">Remove Css</a>
							</div>
						</td>
					</tr>					
				</table>	
			</div>
			<div id="mediaquerystyle" class="tab-container">			
				<h3>Media Query Style</h3>						
				<table class="form-table">
					<tr valign="top">
						<td>
							<a href="#mediaquerystylecontent" class="button button-upload-media-item">Add/Upload Media</a>
							<textarea id="mediaquerystylecontent" class="textarea-editor" style="min-height:500px; width:100%;"  name="style_option[mediaquerystyle]"><?php echo $mediaquerystyle; ?></textarea>
						</td>
					</tr>
				</table>				
			</div>			
			<div id="ctastyle" class="tab-container">
				<h3>Cta Button Type</h3>
				<table class="form-table">
					<tr valign="top"><th scope="row">Calendar</th>
						<td>
							<input type="checkbox" class="checkbox" name="style_option[ctaiscalendar]" value="<?php echo $ctaiscalendar; ?>" <?php echo $result = ($ctaiscalendar) ? 'checked="checked"' : null; ?> />
						</td>
					</tr>
					<tr valign="top"><th scope="row">Corpsite</th>
						<td>
							<input type="checkbox" class="checkbox" name="style_option[ctaiscalendarcorpsite]" value="<?php echo $ctaiscalendarcorpsite; ?>" <?php echo $result = ($ctaiscalendarcorpsite) ? 'checked="checked"' : null; ?> />
						</td>
					</tr>
					<tr valign="top"><th scope="row">Remove Cta Button In Content</th>
						<td>
							<input type="checkbox" class="checkbox" name="style_option[removectabuttonincontent]" value="<?php echo $removectabuttonincontent; ?>" <?php echo $result = ($removectabuttonincontent) ? 'checked="checked"' : null; ?> />
						</td>
					</tr>
					<tr valign="top"><th scope="row">Remove Cta Header</th>
						<td>
							<input type="checkbox" class="checkbox" name="style_option[removectaheader]" value="<?php echo $removectaheader; ?>" <?php echo $result = ($removectaheader) ? 'checked="checked"' : null; ?> />
						</td>
					</tr>
				</table>				
			</div>

			<div id="bestpricestyle" class="tab-container">
				<h3>Best Price Guarantee</h3>
				<table class="form-table">
					<tr valign="top"><th scope="row">Enable Best Price Guarantee</th>
						<td>
							<input type="checkbox" class="checkbox" name="style_option[bpgisenable]" value="<?php echo $bpgisenable; ?>" <?php echo $result = ($bpgisenable) ? 'checked="checked"' : null; ?> />
						</td>
					</tr>					
				</table>
			</div>
			
			<div id="bannerstyle" class="tab-container">
				<h3>Default Banner</h3>
				<table id="defaultbanner" class="simple-table">
					<tr valign="top">
						<td>
							<div id="defaultbanner-preview" class="custom-image-container">
								<img class="image-preview" src="<?php echo $imgsrc = ($defaultbannerimageid == null)? get_template_directory_uri().'/images/default-noimage-150x150.jpg' : $defaultbannerimage[0]; ?>" />
							</div>
						</td>
						<td>
							<div class="uploader">
								<input type="hidden" class="regular-text image-src" value="<?php echo $defaultbannerimage[0]; ?>" readonly />
								<input type="hidden" class="image-id" name="style_option[defaultbannerimageid]" value="<?php echo $defaultbannerimageid; ?>"/>
								<a href="#defaultbanner" class="button button-upload">Upload Image</a>
								<a href="#defaultbanner" class="link button-remove">Remove Image</a>
							</div>
						</td>
					</tr>					
				</table>
			</div>
			
			<div id="fontstyle" class="tab-container">
				<h3>External Font URL</h3>
				<table class="form-table">
					<tr valign="top"><th scope="row">External Font Url</th>
						<td><input type="text" name="style_option[getfontfamily]" value="<?php echo $getfontfamily; ?>" /></td>
					</tr>	
				</table>
			</div>			
			
			<div id="themestyle" class="tab-container">			
				<h3>Theme Style</h3>						
				<table class="form-table">
					<tr valign="top">
						<td style="vertical-align:top">
							<label>Select Theme</label>
							<select style="width:100%;" name="style_option[themestyle]">
								<option value="<?php echo $themestyle; ?>"><?php echo $themedetails[$themestyle]['title']; ?></option>
								<?php 
									foreach($themedetails  as $key=>$themedetail){
										if( $themestyle != $key){
											echo '<option value="'.$key.'">'.$themedetails[$key]['title'].'</option>';
										} 
									}
								?>
							</select>							
						</td>
						<td>
							<label style="text-transform:uppercase"><?php echo $themestyle; ?> - DEFAULT</label>
							<div><?php echo $themedetails[$themestyle]['description']; ?></div>
							
							<textarea readonly id="defaultstylecontent" style="min-height:350px; width:100%;"><?php echo $defaultstyle; ?></textarea>

							<label style="text-transform:uppercase"><?php echo $themestyle; ?> - MEDIA QUERY</label>
							<textarea readonly id="mediaquerystylecontent" style="min-height:350px; width:100%;"><?php echo $mediaquerythemestyle; ?></textarea>
						</td>
					</tr>	
				</table>				
			</div>
			<?php submit_button(); ?>
		</form>
		
		<div class="tab-container" style="display:block !important;">
			<h3>Tools</h3>
			<table class="form-table">
				<tr valign="top">
					<td>
						<ul style="margin:0;">
							<li><a target="_blank" href="http://concepts.directwithhotels.com/olp/plugins/addons/">Plugins / Guide</a>
							<li><a target="_blank" href="http://tools.arantius.com/tabifier">Tabifier</a>
							<li><a target="_blank" href="http://cleancss.com/">Clean CSS</a>
						</ul>
					</td>
				</tr>	
			</table>
		</div>
	</div>
	<?php	
}

?>