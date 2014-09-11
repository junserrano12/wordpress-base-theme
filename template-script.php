<script type="text/javascript">
	/*Google Translate*/
	function googleTranslateElementInit() {
		new google.translate.TranslateElement({
		pageLanguage: 'en',
		layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
		gaTrack: true,
		gaId: '<?php echo get_settings_option('gacode', 'general_option'); ?>'}, 'google_translate_element');
	}
	
	/*Google Map*/
	function initializemap() {
		var myLatlng = new google.maps.LatLng(<?php echo (double)get_settings_option('latitude', 'general_option'); ?>, <?php echo (double)get_settings_option('longtitude', 'general_option'); ?>);
        var map_canvas = document.getElementById('map-canvas');
        var map_options = {
			center: myLatlng,
			zoom: <?php echo get_settings_option('zoom', 'general_option'); ?>,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		var map = new google.maps.Map(map_canvas, map_options)
		var marker = new google.maps.Marker({
			position: myLatlng,
			map: map,
			title: '<?php echo get_settings_option('hotelname', 'general_option'); ?>'
		});
	}
    google.maps.event.addDomListener(window, 'load', initializemap);

	/*Google Event Tracker*/
	<?php if(!get_settings_option('ctaiscalendarcorpsite', 'style_option')){ ?>
	document.querySelector(".ctareservation a").onclick = function(){ _gaq.push(['_trackEvent', 'organic-clickers', 'go-to-select-dates', 'reservation-menu',, false]); _gaq.push(['_link', 'http://reservations.directwithhotels.com/reservation/selectDates/<?php echo get_settings_option('hotelid', 'general_option'); ?>/campaign/']); return true; }
	<?php } ?>
	var cta = document.getElementsByTagName('a');
	for (var i = 0; i < cta.length; i++) {
		if(cta[i].className === 'ctalink' || cta[i].className === 'button ctalink') {
			cta[i].onclick = function(){
				_gaq.push(['_trackEvent', 'organic-clickers', 'go-to-select-dates', 'text-link',, false]); _gaq.push(['_link', 'http://reservations.directwithhotels.com/reservation/selectDates/<?php echo get_settings_option('hotelid', 'general_option'); ?>/campaign/']); return true;				
			};
		}
		else if(cta[i].className === 'button ctabutton') {
			cta[i].onclick = function(){
				_gaq.push(['_trackEvent', 'organic-clickers', 'go-to-select-dates', 'cta-button',, false]); _gaq.push(['_link', 'http://reservations.directwithhotels.com/reservation/selectDates/<?php echo get_settings_option('hotelid', 'general_option'); ?>/campaign/']); return true;
			};	
		}
		else if(cta[i].className === 'ctamodify') { 
			cta[i].onclick = function() {
				_gaq.push(['_trackEvent', 'organic-clickers', 'modify-cancel', 'text-link',, false]); _gaq.push(['_link', 'http://reservations.directwithhotels.com/reservation/modifyCancelPage/<?php echo get_settings_option('hotelid', 'general_option'); ?>/campaign/']); return true;
			};				
		}
	}
	
	/*customscript*/
	<?php echo get_settings_option('customscript', 'general_option'); ?>
	</script>