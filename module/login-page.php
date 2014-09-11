<?php
	add_action( 'login_enqueue_scripts', 'my_login_logo' );
	function my_login_logo() { 
		if ( get_settings_option( 'logoid', 'general_option' ) != null ) : $logoid = get_settings_option( 'logoid', 'general_option' ); ?>
			<style type="text/css">
				body.login {height:100%;}
				body.login div#login {padding:5% 0 0;}
				body.login div#login h1 {}
				body.login div#login h1 a {background-image: url(<?php echo wp_get_attachment_image_src($logoid, 'full')[0]; ?>); padding-bottom: 30px; margin:0 auto; width: auto; height:<?php echo wp_get_attachment_image_src($logoid, 'full')[2]; ?>px; background-size: 200px; overflow: visible;}
				body.login div#login form#loginform {border:1px solid #F67921; margin:0;-webkit-box-shadow: 0 0 10px 1px rgba(0,0,0,0.5); box-shadow: 0 0 10px 1px rgba(0,0,0,0.5); color:#fff;}
				body.login div#login form#loginform p {}
				body.login div#login form#loginform p label {}
				body.login div#login form#loginform input {}
				body.login div#login form#loginform input#user_login {}
				body.login div#login form#loginform input#user_pass {}
				body.login div#login form#loginform p.forgetmenot {}
				body.login div#login form#loginform p.forgetmenot input#rememberme {}
				body.login div#login form#loginform p.submit {}
				body.login div#login form#loginform p.submit input#wp-submit {color:#ffffff !important;}
				body.login div#login p#nav {}
				body.login div#login p#nav a {}
				body.login div#login p#backtoblog {}
				body.login div#login p#backtoblog a {}				
			</style>
		<?php endif; 
	}	
?>