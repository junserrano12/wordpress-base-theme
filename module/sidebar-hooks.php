<?php 

/*REGISTER SIDEBAR*/
function basetheme_register_sidebars() {
    register_sidebar(array(
    	'id' => 'left-sidebar',
    	'name' => 'Left Sidebar',
    	'description' => 'Left Sidebar',
    ));
	
    register_sidebar(array(
    	'id' => 'right-sidebar',
    	'name' => 'Right Sidebar',
    	'description' => 'Right Sidebar',
    ));

	register_sidebar(array(
    	'id' => 'body-top-widget-container',
    	'name' => 'Body Top',
    	'description' => 'Body Top',
    ));
	
    register_sidebar(array(
    	'id' => 'body-bottom-widget-container',
    	'name' => 'Body Bottom',
    	'description' => 'Body Bottom',
    ));	
	
    register_sidebar(array(
    	'id' => 'google-translate-top-widget-container',
    	'name' => 'Google Translate Container Top',
    	'description' => 'Google Translate Container Top',
    ));
	
    register_sidebar(array(
    	'id' => 'google-translate-bottom-widget-container',
    	'name' => 'Google Translate Container Bottom',
    	'description' => 'Google Translate Container Bottom',
    ));
	
	register_sidebar(array(
    	'id' => 'google-translate-content-top-widget-container',
    	'name' => 'Google Translate Content Top',
    	'description' => 'Google Translate Content Top',
    ));
	
    register_sidebar(array(
    	'id' => 'google-translate-content-bottom-widget-container',
    	'name' => 'Google Translate Content Bottom',
    	'description' => 'Google Translate Content Bottom',
    ));

	register_sidebar(array(
		'id' => 'header-container-top-widget-container',
    	'name' => 'Header Container Top',
    	'description' => 'Header Container Top',
    ));
	
	register_sidebar(array(
		'id' => 'header-container-bottom-widget-container',
    	'name' => 'Header Container Bottom',
    	'description' => 'Header Container Bottom',
    ));
	
	register_sidebar(array(
		'id' => 'header-container-content-top-widget-container',
    	'name' => 'Header Content top',
    	'description' => 'Header Content Top',
    ));
	
	register_sidebar(array(
		'id' => 'header-container-content-bottom-widget-container',
    	'name' => 'Header Content Bottom',
    	'description' => 'Header Content Bottom',
    ));


	register_sidebar(array(
		'id' => 'logo-container-top-widget-container',
    	'name' => 'Logo Container Top',
    	'description' => 'Logo Container Top',
    ));
	
	register_sidebar(array(
		'id' => 'logo-container-bottom-widget-container',
    	'name' => 'Logo Container Bottom',
    	'description' => 'Logo Container Bottom',
    ));
	
	register_sidebar(array(
		'id' => 'cta-container-top-widget-container',
    	'name' => 'Cta Container Top',
    	'description' => 'Cta Container Top',
    ));
	
	register_sidebar(array(
		'id' => 'cta-container-bottom-widget-container',
    	'name' => 'Cta Container Bottom',
    	'description' => 'Cta Container Bottom',
    ));
	
	register_sidebar(array(
		'id' => 'slider-container-top-widget-container',
    	'name' => 'Slider Container Top',
    	'description' => 'Slider Container Top',
    ));
	
	register_sidebar(array(
		'id' => 'slider-container-bottom-widget-container',
    	'name' => 'Slider Container Bottom',
    	'description' => 'Slider Container Bottom',
    ));
	
	register_sidebar(array(
		'id' => 'main-container-top-widget-container',
    	'name' => 'Main Container Top',
    	'description' => 'Main Container Top',
    ));
	
	register_sidebar(array(
		'id' => 'main-container-bottom-widget-container',
    	'name' => 'Main Container Bottom',
    	'description' => 'Main Container Bottom',
    ));	

    register_sidebar(array(
        'id' => 'footer-container-content-widget-container',
        'name' => 'Footer Main Content',
        'description' => 'Footer Main Content',
    )); 
}

?>