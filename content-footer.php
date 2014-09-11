<?php
$displayctabutton = true;
if (get_settings_option('removectabuttonincontent', 'style_option')) $displayctabutton = false;
if (get_settings_option('ctaiscalendarcorpsite', 'style_option')) $displayctabutton = false;
if (get_settings_option('themestyle', 'style_option') === 'style4' && is_front_page()) $displayctabutton = false;
?>
<?php if($displayctabutton){ ?>
<a class="ctalink button" href="http://reservations.directwithhotels.com/reservation/selectDates/<?php echo get_settings_option('hotelid', 'general_option'); ?>/campaign/">Check availability and prices</a>
<?php } ?>