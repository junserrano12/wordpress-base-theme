<?php
function general_options_do_page() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2>General Information</h2>
		<form method="post" action="options.php">
			<?php 
			settings_fields('general_option_settings'); 
			$options = get_option('general_option');

			$iscorpsite				= get_value(get_settings_option('ctaiscalendarcorpsite', 'style_option'), 0);
			$hotelnames				= get_value($options['hotelnames'], null);
			$hotelids				= get_value($options['hotelids'], null);
			$hotelname 				= get_value($options['hotelname'], 'Hotel Name');
			$hotellocation			= get_value($options['hotellocation'], 'City, Country');
			$hotelid 				= get_value($options['hotelid'], '000000');
			$hoteldomain 			= get_mapped_domain();
			$gacode 				= get_value($options['gacode'], '');			
			$gacode2 				= get_value($options['gacode2'], '');			
			$nofollow 				= get_value($options['nofollow'], 0);
			$logoid					= get_value($options['logoid'], null);
			$logo					= wp_get_attachment_image_src($logoid, 'full');
			$faviconid				= get_value($options['faviconid'], null);
			$favicon				= wp_get_attachment_image_src($faviconid, 'full');				
			$country				= get_value($options['country'], null);
			$street1				= get_value($options['street1'], null);
			$street2				= get_value($options['street2'], null);
			$zippostal				= get_value($options['zippostal'], null);
			$citytown				= get_value($options['citytown'], null);
			$stateprovinceregion	= get_value($options['stateprovinceregion'], null);
			$countrycode			= get_value($options['countrycode'], null);
			$areacode				= get_value($options['areacode'], null);
			$tel					= get_value($options['tel'], null);
			$countrycode1			= get_value($options['countrycode1'], null);
			$areacode1				= get_value($options['areacode1'], null);
			$tel1					= get_value($options['tel1'], null);
			$countrycode2			= get_value($options['countrycode2'], null);
			$areacode2				= get_value($options['areacode2'], null);
			$tel2					= get_value($options['tel2'], null);
			$emailaddress			= get_value($options['emailaddress'], null);
			$longtitude				= get_value($options['longtitude'], null);
			$latitude				= get_value($options['latitude'], null);
			$locationiframe			= get_value($options['locationiframe'], null);
			$zoom					= get_value($options['zoom'], 16);
			$facebook				= get_value($options['facebook'], null);
			$twitter				= get_value($options['twitter'], null);
			$googleplus				= get_value($options['googleplus'], null);
			$tripadvisor			= get_value($options['tripadvisor'], null);
			$instagram				= get_value($options['instagram'], null);
			$tumblr					= get_value($options['tumblr'], null);
			$pinterest				= get_value($options['pinterest'], null);
			$foursquare				= get_value($options['foursquare'], null);
			$youtube				= get_value($options['youtube'], null);
			$linkedin				= get_value($options['linkedin'], null);
			$termsandcondition		= get_bpg_content($options['termsandcondition']);
			$customscript			= get_value($options['customscript'], null);
			$googleverification		= get_value($options['googleverification'], null);

			?>
			<ul class="tab-menu">
				<li><a href="#generalcontent" class="active">General Settings</a></li>
				<li><a href="#seocontent">Seo Settings</a></li>
				<li><a href="#termsandconditioncontent">Terms and Condition</a></li>
				<li><a href="#customscriptcontent">Custom Script</a></li>				
			</ul>
			
			<div id="generalcontent" class="tab-container show">
				<h3>General Settings</h3>
				<table class="form-table">
					<tr valign="top"><th scope="row">Hotel Logo</th>
						<td>
							<table id="logo" class="simple-table">
								<tr>
									<td>
										<div id="logo-preview" class="custom-image-container">
											<img class="logo-image-preview" src="<?php echo $imgsrc = ($logoid == null)? get_template_directory_uri().'/images/logo.png' : $logo[0]; ?>" />
										</div>
									</td>
									<td>
										<div class="uploader">
											<input type="hidden" class="image-id" name="general_option[logoid]" value="<?php echo $logoid; ?>"/>
											<a href="#logo" class="button button-upload">Upload Image</a>
											<a href="#logo" class="link button-remove">Remove Image</a>
										</div>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr valign="top"><th scope="row">Hotel Favicon</th>
						<td>
							<table id="favicon" class="simple-table">
								<tr>
									<td>
										<div id="faviocn-preview" class="custom-image-container" style="width:16px; height:16px;">
											<img class="favicon-image-preview" src="<?php echo $imgsrc = ($faviconid == null)? get_template_directory_uri().'/images/favicon.ico' : $favicon[0]; ?>" />
										</div>
									</td>
									<td>
										<div class="uploader">
											<input type="hidden" class="image-id" name="general_option[faviconid]" value="<?php echo $faviconid; ?>"/>
											<a href="#favicon" class="button button-upload">Upload Image</a>
											<a href="#favicon" class="link button-remove">Remove Image</a>
										</div>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<?php if( $iscorpsite ){ ?>
					<tr valign="top"><th scope="row">Hotels</th>
						<td>
							<table>
								<tr>
									<td>
										<p>Hotel Name</p>
										<textarea rows="5" name="general_option[hotelnames]"><?php echo $hotelnames; ?></textarea>
									</td>
									<td>
										<p>Hotel ID</p>
										<textarea rows="5" name="general_option[hotelids]"><?php echo $hotelids; ?></textarea>
									</td>
								</tr>
							</table>							
						</td>
					</tr>					
					<tr valign="top"><th scope="row">Hotel Corpsite Name</th>
						<td><input type="text" name="general_option[hotelname]" value="<?php echo $hotelname; ?>" /></td>
					</tr>
					<tr valign="top"><th scope="row">Hotel Corpsite Location</th>
						<td><input type="text" name="general_option[hotellocation]" value="<?php echo $hotellocation; ?>" /></td>
					</tr>					
					<?php } else { ?>
					<tr valign="top"><th scope="row">Hotel Name</th>
						<td><input type="text" name="general_option[hotelname]" value="<?php echo $hotelname; ?>" /></td>
					</tr>
					<tr valign="top"><th scope="row">Hotel Location</th>
						<td><input type="text" name="general_option[hotellocation]" value="<?php echo $hotellocation; ?>" /></td>
					</tr>
					<tr valign="top"><th scope="row">Hotel ID</th>
						<td><input type="text" name="general_option[hotelid]" value="<?php echo $hotelid; ?>" /></td>
					</tr>
					<?php } ?>
					<tr valign="top"><th scope="row">Hotel Domain</th>
						<td>
							<input type="text" name="general_option[hoteldomain]" value="<?php echo $hoteldomain; ?>" />
							<?php if ( strcmp($hoteldomain, $options['hoteldomain']) !== 0 ) { ?>
							<p style="font-size:0.8em; border:1px solid red;">Please Save General Settings to Update Hoteldomain In Database</p>
							<?php } ?>
						</td>
					</tr>
				</table>
			</div>
			
			<div id="seocontent" class="tab-container">
				<h3>SEO Settings</h3>
				<table class="form-table">
					<tr valign="top"><th scope="row">Google Analytic Code</th>
						<td> 
							<input placeholder="UA-XXXXX-1" type="text" name="general_option[gacode]" value="<?php echo trim($gacode); ?>" /><br>
							<input placeholder="UA-XXXXX-2" type="text" name="general_option[gacode2]" value="<?php echo trim($gacode2); ?>" />
						</td>
					</tr>
					<tr valign="top"><th scope="row">Google Publisher</th>
						<td><input type="text" name="general_option[gpublisher]" value="<?php echo $gpublisher; ?>" /></td>
					</tr>
					<tr valign="top"><th scope="row">No Index, No Follow</th>
						<td>
							<input type="checkbox" class="checkbox" name="general_option[nofollow]" value="<?php echo $nofollow; ?>" <?php echo $result = ($nofollow) ? 'checked="checked"' : null; ?> />
						</td>
					</tr>
					<tr valign="top"><th scope="row">Google Verification Code</th>
						<td><input type="text" name="general_option[googleverification]" value="<?php echo esc_html($googleverification); ?>" /></td>
					</tr>					
				</table>
				<h3>Address</h3>
				<table class="form-table">
					<tr valign="top"><th scope="row">Country</th>
						<td><input type="text" name="general_option[country]" value="<?php echo $country; ?>" /></td>
					</tr>		
					<tr valign="top"><th scope="row">Street Address 1</th>
						<td><input type="text" name="general_option[street1]" value="<?php echo $street1; ?>" /></td>
					</tr>		
					<tr valign="top"><th scope="row">Street Address 2</th>
						<td><input type="text" name="general_option[street2]" value="<?php echo $street2; ?>" /></td>
					</tr>		
					<tr valign="top"><th scope="row">Zip/Postal Code</th>
						<td><input type="text" name="general_option[zippostal]" value="<?php echo $zippostal; ?>" /></td>
					</tr>		
					<tr valign="top"><th scope="row">City/Town</th>
						<td><input type="text" name="general_option[citytown]" value="<?php echo $citytown; ?>" /></td>
					</tr>		
					<tr valign="top"><th scope="row">State/Province/Region</th>
						<td><input type="text" name="general_option[stateprovinceregion]" value="<?php echo $stateprovinceregion; ?>" /></td>
					</tr>		
				</table>
				<h3>Contact</h3>
				<table class="form-table">
					<tr><th scope="row"></th>
						<td>Country Code</td>
						<td>Area Code</td>
						<td>Telephone Number</td>
					</tr>
					<tr valign="top"><th scope="row">Phone Number 1</th>
						<td><input placeholder="Country Code" type="text" name="general_option[countrycode]" value="<?php echo $countrycode; ?>" /></td>
						<td><input placeholder="Area Code" type="text" name="general_option[areacode]" value="<?php echo $areacode; ?>" /></td>
						<td><input placeholder="Telephone Number" type="text" name="general_option[tel]" value="<?php echo $tel; ?>" /></td>
					</tr>		
					<tr valign="top"><th scope="row">Phone Number 2</th>
						<td><input placeholder="Country Code" type="text" name="general_option[countrycode1]" value="<?php echo $countrycode1; ?>" /></td>
						<td><input placeholder="Area Code" type="text" name="general_option[areacode1]" value="<?php echo $areacode1; ?>" /></td>
						<td><input placeholder="Telephone Number" type="text" name="general_option[tel1]" value="<?php echo $tel1; ?>" /></td>
					</tr>		
					<tr valign="top"><th scope="row">Phone Number 3</th>
						<td><input placeholder="Country Code" type="text" name="general_option[countrycode2]" value="<?php echo $countrycode2; ?>" /></td>
						<td><input placeholder="Area Code" type="text" name="general_option[areacode2]" value="<?php echo $areacode2; ?>" /></td>
						<td><input placeholder="Telephone Number" type="text" name="general_option[tel2]" value="<?php echo $tel2; ?>" /></td>
					</tr>		
				</table>
				<table class="form-table">
					<tr valign="top"><th scope="row">Email Address</th>
						<td><input type="email" name="general_option[emailaddress]" value="<?php echo $emailaddress; ?>" /></td>
					</tr>		
				</table>			
				<h3>Map</h3>
				<table class="form-table">
					<tr valign="top"><th scope="row">Latitude</th>
						<td><input type="text" name="general_option[latitude]" value="<?php echo $latitude; ?>" /></td>
					</tr>
					<tr valign="top"><th scope="row">Longtitude</th>
						<td><input type="text" name="general_option[longtitude]" value="<?php echo $longtitude; ?>" /></td>
					</tr>		
					<tr valign="top"><th scope="row">Zoom</th>
						<td><input type="text" name="general_option[zoom]" value="<?php echo $zoom; ?>" /></td>
					</tr>
					<tr valign="top"><th scope="row">Iframe</th>
						<td><input type="text" name="general_option[locationiframe]" value="<?php echo esc_html($locationiframe); ?>" /></td>
					</tr>
				</table>
				<h3>Social Media</h3>
				<table class="form-table">
					<tr valign="top"><th scope="row">Facebook</th>
						<td><input type="text" name="general_option[facebook]" value="<?php echo $facebook; ?>" /></td>
					</tr>		
					<tr valign="top"><th scope="row">Twitter</th>
						<td><input type="text" name="general_option[twitter]" value="<?php echo $twitter; ?>" /></td>
					</tr>		
					<tr valign="top"><th scope="row">Google+</th>
						<td><input type="text" name="general_option[googleplus]" value="<?php echo $googleplus; ?>" /></td>
					</tr>		
					<tr valign="top"><th scope="row">Trip Advisor</th>
						<td><input type="text" name="general_option[tripadvisor]" value="<?php echo $tripadvisor; ?>" /></td>
					</tr>		
					<tr valign="top"><th scope="row">Instagram</th>
						<td><input type="text" name="general_option[instagram]" value="<?php echo $instagram; ?>" /></td>
					</tr>
					<tr valign="top"><th scope="row">pinterest</th>
						<td><input type="text" name="general_option[pinterest]" value="<?php echo $pinterest; ?>" /></td>
					</tr>
					<tr valign="top"><th scope="row">tumblr</th>
						<td><input type="text" name="general_option[tumblr]" value="<?php echo $tumblr; ?>" /></td>
					</tr>
					<tr valign="top"><th scope="row">foursquare</th>
						<td><input type="text" name="general_option[foursquare]" value="<?php echo $foursquare; ?>" /></td>
					</tr>
					<tr valign="top"><th scope="row">youtube</th>
						<td><input type="text" name="general_option[youtube]" value="<?php echo $youtube; ?>" /></td>
					</tr>
					<tr valign="top"><th scope="row">linkedin</th>
						<td><input type="text" name="general_option[linkedin]" value="<?php echo $linkedin; ?>" /></td>
					</tr>
				</table>
			</div>
			
			<div id="termsandconditioncontent" class="tab-container">
				<h3>Terms and Condition</h3>
				<table class="form-table" height="350">
					<tr valign="top">
						<td>
							<?php
							$settings = array( 'media_buttons' => false, 'wpautop' => false, 'textarea_rows' => get_option('default_post_edit_rows', 10));
							wp_editor( get_bpg_content($termsandcondition), 'general_option[termsandcondition]', $settings );
							?>
						</td>
					</tr>
				</table>				
			</div>
			
			<div id="customscriptcontent" class="tab-container">
				<h3>Custom Script</h3>
				<table class="form-table">
					<tr valign="top">
						<td><textarea style="min-height:350px; width:100%;" name="general_option[customscript]" class="textarea-editor"><?php echo $customscript; ?></textarea></td>
					</tr>
				</table>				
			</div>
			
		    <?php submit_button(); ?>
		</form>
	</div>
	<?php	
}
?>