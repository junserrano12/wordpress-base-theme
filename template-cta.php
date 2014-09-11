<?php if ( is_active_sidebar( 'cta-container-top-widget-container' ) ) { dynamic_sidebar( 'cta-container-top-widget-container' ); } ?>
<div class="content">
	<div class="cta">
	<?php if(get_settings_option('ctaiscalendar', 'style_option')){ ?>
		<form id="booking" class="courier" method="POST" action="http://reservations.directwithhotels.com/reservation/processDates/<?php echo get_settings_option('hotelid', 'general_option'); ?>/">
			<?php if(!get_settings_option('removectaheader', 'style_option')){ ?>
			<div class="control-wrapper cta-title-container">
				<?php if(get_settings_option('bpgisenable', 'style_option')){ ?>
				<h3>
					<a class="colorbox-inline bpglinksmall" href="#bpgmodal"><span class="bpgcheck"></span>Best Price Guarantee</a>
					<a class="bpgtip"><div id="bpgtipcontent"><span><?php echo get_settings_option('hotelname', 'general_option'); ?> promises its customers that by booking directly, you are getting the best deal online. If you have a confirmed direct online booking with <?php echo get_settings_option('hotelname', 'general_option'); ?> and find a cheaper price for the same offer within 24 hours on another website, we will match that price.</span></div></a>
				</h3>					
				<?php } else { ?>
					<h3>Easy Booking at Low Rates</h3>
				<?php } ?>
			</div>
			<?php } ?>
			<?php if(get_settings_option('ctaiscalendarcorpsite', 'style_option')){ ?>
			<div class="control-wrapper cta-calendar-container">
				<div class="calendar-select">
					<select id="select-hotel" class="text_reserve">
						<option value="select"><?php echo 'Choose a Property'; ?></option>
						<?php 
						$hotelnames = explode("\n", get_settings_option('hotelnames', 'general_option'));
						$hotelids = explode("\n", get_settings_option('hotelids', 'general_option'));
						foreach($hotelnames as $key=>$hotelname){
							echo '<option value="'.trim($hotelids[$key], "\r").'">'.trim($hotelname, "\r").'</option>';
						}						
						?>
					</select>
				</div>
			</div>
			<?php } ?>
			<div class="control-wrapper cta-calendar-container">
				<span class="calendar-label">Check In:</span>
				<div class="calendar-input">
					<input gtbfieldid="5" class="text_reserve inputDate" id="inputDate" name="arrival" value="" type="text" readonly>
					<input class="text_reserve" id="arrival_date" name="arrival_date" value="" type="hidden">
				</div>
			</div>

			<div class="control-wrapper cta-calendar-container">
				<span class="calendar-label">Check Out:</span>
				<div class="calendar-input">
					<input gtbfieldid="6" class="text_reserve inputDate2" id="inputDate" name="departure" value="" type="text" readonly>
					<input class="text_reserve" id="departure_date" name="departure_date" value="" type="hidden">
				</div>
			</div>

			<div class="control-wrapper cta-button-container">
				<input class="button ctabutton" type="submit" value="Check availability and prices">
			</div>
			<?php if(!get_settings_option('ctaiscalendarcorpsite', 'style_option')){ ?>
			<div class="control-wrapper cta-moc-container">
				<p><a class="ctamodify" href="http://reservations.directwithhotels.com/reservation/modifyCancelPage/<?php echo get_settings_option('hotelid', 'general_option'); ?>">Modify or Cancel</a> your reservation</p>
			</div>
			<?php } ?>
		</form>
	<?php } else { ?>
		<?php if(!get_settings_option('removectaheader', 'style_option')){ ?>
		<div class="control-wrapper cta-title-container">
			<?php if(get_settings_option('bpgisenable', 'style_option')){ ?>
				<h3>
					<a class="colorbox-inline bpglinksmall" href="#bpgmodal"><span class="bpgcheck"></span>Best Price Guarantee</a>
					<a class="bpgtip"><div id="bpgtipcontent"><span><?php echo get_settings_option('hotelname', 'general_option'); ?> promises its customers that by booking directly, you are getting the best deal online. If you have a confirmed direct online booking with <?php echo get_settings_option('hotelname', 'general_option'); ?> and find a cheaper price for the same offer within 24 hours on another website, we will match that price.</span></div></a>
				</h3>
			<?php } else { ?>
				<h3>Easy Booking at Low Rates</h3>
			<?php } ?>
		</div>
		<?php } ?>
		<div class="control-wrapper cta-button-container">
			<a class="button ctabutton" href="http://reservations.directwithhotels.com/reservation/selectDates/<?php echo get_settings_option('hotelid', 'general_option'); ?>">Check availability and prices</a>
		</div>
		<?php if(!get_settings_option('ctaiscalendarcorpsite', 'style_option')){ ?>
		<div class="control-wrapper cta-moc-container">
			<p><a class="ctamodify" href="http://reservations.directwithhotels.com/reservation/modifyCancelPage/<?php echo get_settings_option('hotelid', 'general_option'); ?>">Modify or Cancel</a> your reservation</p>
		</div>
		<?php } ?>
	<?php } ?>
	</div>
</div>

<?php if ( is_active_sidebar( 'cta-container-bottom-widget-container' ) ) { dynamic_sidebar( 'cta-container-bottom-widget-container' ); } ?>
