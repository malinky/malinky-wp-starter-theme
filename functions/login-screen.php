<?php
/* ------------------------------------------------------------------------ *
 * Login Screen
 * ------------------------------------------------------------------------ */

/**
 * Change login screen logo url.
 *
 * @return string
 */
function malinky_login_logo_url()
{
	return esc_url ( home_url( '', 'http' ) );
}

add_filter( 'login_headerurl', 'malinky_login_logo_url' );


/**
 * Remove shake on login.
 */
function malinky_login_shake()
{
    remove_action( 'login_head', 'wp_shake_js', 12 );
}

add_action( 'login_head', 'malinky_login_shake' );


/**
 * Style login logo and page.
 */
function malinky_login_screen()
{ ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo get_template_directory_uri(); ?>/img/logo-black.png);
            background-size: 200px;
            width: auto;
        }
        body.login form {
			border: 1px solid #e5e5e5;
			box-shadow: none;
        }
        body.login form .input {
        	background: none;
        }
        body.login h1 a {
        	background-size: auto;
        }
        html.lt-ie9 body.login div#login h1 a {
            background-image: url(<?php echo get_template_directory_uri(); ?>/img/logo-black.png);
        }
        body.login .button.button-large {
        	height: auto;
        	line-height: normal;
		    padding: 10px;
        }        
        body.login .button-primary {
		    width: auto;
		    height: auto;
		    display: inline-block;
		    background: #8f3b45;
		    border: none;
		    border-radius: 0;
		    box-shadow: none;
            text-shadow: none;
        }
        body.login .button-primary:hover,
        body.login .button-primary:focus,
        body.login .button-primary:active {
    		background: #8f3b45;
    		text-shadow: none;
    		box-shadow: none;
        }        
        body.login #nav {
        	text-shadow: none;
			padding: 26px 24px;
			background: #FFFFFF;
			border: 1px solid #e5e5e5;
			box-shadow: none;
			text-align: center;
		}
		body.login #nav a {
		    width: auto;
		    height: auto;
		    display: block;
		    padding: 10px;
		    background: #8f3b45;
		    border: none;
		    color: #fff;
		    border-radius: none;
		}
		body.login #nav a:hover,
		body.login #nav a:focus,
		body.login #nav a:active {
			color: #fff;
			background: #8f3b45;
    		text-shadow: none;
    		box-shadow: none;
		}
		body.login #login #backtoblog a:hover {
			color: #999;
		}
    </style>
<?php }

add_action( 'login_enqueue_scripts', 'malinky_login_screen' );
