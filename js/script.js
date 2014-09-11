(function(a){(jQuery.browser=jQuery.browser||{}).mobile=/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))})(navigator.userAgent||navigator.vendor||window.opera);
jQuery(document).ready(function(){
	/*responsive menu*/	
	jQuery('#rmenu').click(function(e){		
		jQuery('#main-menu > ul').toggleClass('visible-layer');		
		e.preventDefault();	
	});
	/*dropdownmenu*/
	jQuery('.sub-menu').hide();
	jQuery('.menu-item-has-children').hover(function(e){
		jQuery(this).children('.sub-menu').show();
	}, function(){
		jQuery('.sub-menu').hide();
	});	
	/*Back to top*/	
	jQuery('body').append('<a href="#?" id="toTop" style="display:none;"></a>');
	jQuery(window).scroll(function() {
		if (jQuery(this).scrollTop() > 250) {
			jQuery('#toTop').fadeIn(300);
		} else {
			jQuery('#toTop').fadeOut(300);
		}	
	});
	jQuery('#toTop').click(function(e){
		scrollposition = jQuery('#header').offset().top;
		scrollposition = scrollposition;
		jQuery('html,body').animate({scrollTop: scrollposition}, 'slow');
		e.preventDefault();
	});
	/*slider*/
	jQuery('#slider').flexslider({ animation: "fade", prevText: "", nextText: "", animationLoop: "true", animationSpeed: 600, slideshowSpeed: 7000 });
	/*slider-carousel*/
	jQuery('#slider-main').flexslider({	animation: "fade", controlNav: false, animationLoop: false, slideshow: false, prevText: "", nextText: "", sync: "#slider-carousel"	});
	jQuery('#slider-carousel').flexslider({animation: "slide", controlNav: false, animationLoop: false, slideshow: false, itemWidth: 180, prevText: "", nextText: "", asNavFor: '#slider-main'});
	/*Packages*/
	jQuery('.accordion-content').hide();
	jQuery('.accordion-content:first').show();
	jQuery('body').delegate('.accordion-caption a', 'click', function(e){
		id = jQuery(this).attr('href');
		jQuery(this).toggleClass('active');
		jQuery(id).slideToggle('fast');
		e.preventDefault();
	});
	/*tabmenu*/
	jQuery('body').delegate('.tab-menu a', 'click', function(e){
		tabparent = jQuery(this).parent().parent().parent('.gallery-container').attr('id');
		tabid = jQuery(this).attr('href');
		jQuery('#'+tabparent+' .tab-menu a').removeClass('active');
		jQuery('#'+tabparent+' .tab-container').removeClass('show');
		jQuery(this).addClass('active');
		jQuery(tabid).addClass('show');
		e.preventDefault();
	});
	/*calendar*/
	jQuery('#arrival_date').datepicker({
		showOn: "both",
		buttonImageOnly: false,
		buttonText: '...',		
		onSelect: update_arrival_selects,	
		constrainInput: true,	
		changeMonth: true,		
		changeYear: true,		
		showTime:false,		
		showHour: false,	
		showMinute: false,	
		showSecond: false,		
		yearRange: "0:+3",		
		minDate: 0	
	});

	jQuery('#departure_date').datepicker({		
		showOn: "both",	
		buttonImageOnly: false,
		buttonText: '...',			
		onSelect: update_departure_selects,	
		constrainInput: true,			
		changeMonth: true,		
		changeYear: true,	
		showTime:false,		
		showHour: false,		
		showMinute: false,
		showSecond: false,	
		yearRange: "0:+3",	 
		defaultDate: +1,
		minDate: 0	
	});	

	set_now_date(new Date());	
	
	/*ismobiie*/
	if(jQuery(this).width() < 520 || jQuery.browser.mobile){
		jQuery('body').delegate('.colorbox', 'click', function(e){ jQuery(this).colorbox({ width:'80%'}); });	
		jQuery('body').delegate('.colorbox-inline', 'click', function(e){ jQuery(this).colorbox({inline:true, fixed:true, width:'80%'}); });	
		jQuery('body').delegate('.colorbox-group', 'click', function(e){
			rel = jQuery(this).attr('rel');
			jQuery('a.colorbox-group[rel='+rel+']').colorbox({ width:'80%' });				
		});	
	} else {
		jQuery('body').delegate('.colorbox', 'click', function(e){ jQuery(this).colorbox();	});
		jQuery('body').delegate('.colorbox-inline', 'click', function(e){ jQuery(this).colorbox({inline:true, fixed:true}); });	
		jQuery('body').delegate('.colorbox-group', 'click', function(e){
			rel = jQuery(this).attr('rel');
			jQuery('a.colorbox-group[rel='+rel+']').colorbox();				
		});	
	}
});

/*calendar functions*/
function update_departure_selects(date) {
	var date = jQuery('#departure_date').datepicker('getDate'); var datearrival = jQuery('#arrival_date').datepicker('getDate'); $month = date.getMonth()+1; $day = date.getDate(); $year = date.getFullYear(); if(date > datearrival){
		jQuery('input[name=departure]').val(date ? $year+'-'+$month+'-'+$day : ''); jQuery('#departure_date').datepicker('hide');
	}else{
		alert('please change selection');
	}
}function update_arrival_selects(date) {
	var date = jQuery('#arrival_date').datepicker('getDate'); $month = date.getMonth();	$day = date.getDate();	$year = date.getFullYear();	if($month == 3 || $month == 5 || $month == 8 || $month == 10){
		switch($day){
			case 30:{
				$amonth = $month; $aday = $day; $ayear = $year; $dmonth = $month+1; $dday = 1; $dyear = $year;
			}; break; default:{
				$amonth = $month; $aday = $day; $ayear = $year; $dmonth = $month; $dday = $day+1; $dyear = $year;
			}; break;
		}
	}else if($month == 0 || $month == 2 || $month == 4 || $month == 6 || $month == 7 || $month == 9){
		switch($day){
			case 31:{
				$amonth = $month; $aday = $day; $ayear = $year; $dmonth = $month+1; $dday = 1; $dyear = $year;
			}; break; default:{
				$amonth = $month; $aday = $day; $ayear = $year; $dmonth = $month; $dday = $day+1; $dyear = $year;
			}; break;
		}
	}else if($month == 11){
		switch($day){
			case 31:{
				$amonth = $month; $aday = $day; $ayear = $year; $dmonth = 0; $dday = 1; $dyear = $year+1;
			}; break; default:{
				$amonth = $month; $aday = $day; $ayear = $year; $dmonth = $month; $dday = $day+1; $dyear = $year;
			}; break;
		}
	}else if($month == 1) {
		if($year%4 == 0){
			switch($day){
				case 29:{
					$amonth = $month; $aday = $day; $ayear = $year; 	$dmonth = $month+1; $dday = 1; $dyear = $year;
				}; break; default:{
					$amonth = $month; $aday = $day; $ayear = $year; 	$dmonth = $month; $dday = $day+1; $dyear = $year;
				}; break;
			}
		}else {
			switch($day){
				case 28:{
					$amonth = $month; $aday = $day; $ayear = $year; $dmonth = $month+1; $dday = 1; $dyear = $year;
				}; break; default:{
					$amonth = $month; $aday = $day; $ayear = $year; $dmonth = $month; $dday = $day+1; $dyear = $year;
				}; break;
			}
		}
	} $amonth = $amonth+1; $dmonth = $dmonth+1; jQuery('input[name=arrival]').val(date ? $ayear+'-'+$amonth+'-'+$aday : ''); jQuery('input[name=departure]').val(date ? $dyear+'-'+$dmonth+'-'+$dday : ''); jQuery('#departure_date').datepicker( "setDate", $dmonth+'/'+$dday+'/'+$dyear ); jQuery('#arrival_date').datepicker('hide');
}function set_now_date(date) {
	$month = date.getMonth();	$day = date.getDate();	$year = date.getFullYear(); if($month == 3 || $month == 5 || $month == 8 || $month == 10){
		switch($day){
			case 30:{
				$amonth = $month; $aday = $day; $ayear = $year; $dmonth = $month+1; $dday = 1; $dyear = $year;
			}; break; default:{
				$amonth = $month; $aday = $day; $ayear = $year; $dmonth = $month; $dday = $day+1; $dyear = $year;
			}; break;
		}
	}else if($month == 0 || $month == 2 || $month == 4 || $month == 6 || $month == 7 || $month == 9){
		switch($day){
			case 31:{
				$amonth = $month; $aday = $day; $ayear = $year; $dmonth = $month+1; $dday = 1; $dyear = $year;
			}; break; default:{
				$amonth = $month; $aday = $day; $ayear = $year; $dmonth = $month; $dday = $day+1; $dyear = $year;
			}; break;
		}
	}else if($month == 11){
		switch($day){
			case 31:{
				$amonth = $month; $aday = $day; $ayear = $year; $dmonth = 0; $dday = 1; $dyear = $year+1;
			}; break; default:{
				$amonth = $month; $aday = $day; $ayear = $year; $dmonth = $month; $dday = $day+1; $dyear = $year;
			}; break;
		}
	}else if($month == 1) {
		if($year%4 == 0){
			switch($day){
				case 29:{
					$amonth = $month; $aday = $day; $ayear = $year; $dmonth = $month+1; $dday = 1; $dyear = $year;
				}; break; default:{
					$amonth = $month; $aday = $day; $ayear = $year; $dmonth = $month; $dday = $day+1; $dyear = $year;
				}; break;
			}
		}else {
			switch($day){
				case 28:{
					$amonth = $month; $aday = $day; $ayear = $year; $dmonth = $month+1; $dday = 1; $dyear = $year;
				}; break; default:{
					$amonth = $month; $aday = $day; $ayear = $year; $dmonth = $month; $dday = $day+1; $dyear = $year;
				}; break;
			}
		}
	} $amonth = $amonth+1; $dmonth = $dmonth+1;	jQuery('input[name=arrival]').val(date ? $ayear+'-'+$amonth+'-'+$aday : ''); jQuery('input[name=departure]').val(date ? $dyear+'-'+$dmonth+'-'+$dday : ''); jQuery('#arrival_date').datepicker('hide');
}