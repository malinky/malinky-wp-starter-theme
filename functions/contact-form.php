<?php
/* ------------------------------------------------------------------------ *
 * Contact Form Plugin
 * ------------------------------------------------------------------------ */

/**
 * Shortcode to display the contact form.
 *
 * [malinky-contact-form]
 */
add_shortcode( 'malinky-contact-form', 'malinky_contact_form' );

function malinky_contact_form()
{

	global $malinky_error_messages;

	$name 		= isset( $_POST['malinky_name'] ) ? $_POST['malinky_name'] : '';
	$company	= isset( $_POST['malinky_company'] ) ? $_POST['malinky_company'] : '';
	$email 		= isset( $_POST['malinky_email'] ) ? $_POST['malinky_email'] : '';
	$phone 		= isset( $_POST['malinky_phone'] ) ? $_POST['malinky_phone'] : '';	
	$message 	= isset( $_POST['malinky_message'] ) ? $_POST['malinky_message'] : '';
	?>

	<?php ob_start(); ?>

		<div class="col col--align-center contact-form">
			<div class="col-item">

				<?php if ( isset( $_GET['contact'] ) && $_GET['contact'] == 'success' ) { ?>

					<?php $contacted_message = get_field( 'contacted_message', 'option' ); ?>

					<div class="box success" id="contact-success" name="#contact-success">
						<?php echo empty( $contacted_message ) ? 'Thanks for contacting us, we will be in touch as soon as possible.' : $contacted_message; ?>
					</div>

				<?php } ?>
				
				<form action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>#contact-form" id="contact-form" name="#contact-form" method="post" role="form">

					<div class="col col--wide col--align-center">
						<div class="col-item col-item-half--large col-item-half--xlarge">
							<div class="col col--align-center">
								<div class="col-item col-item-9-10 col-item-half--medium col-item-full--large col-item-full--xlarge">

									<label for="malinky_name">Name*</label>
									<input type="text" name="malinky_name" id="malinky_name" placeholder="" value="<?php echo esc_attr( wp_unslash( $name ) ); ?>" required>
									<?php if (isset($malinky_error_messages['name_error'][0])) echo '<p class="box error">' . $malinky_error_messages['name_error'][0] . '</p>'; ?>

									<label for="malinky_company">Company</label>
									<input type="text" name="malinky_company" id="malinky_company" placeholder="" value="<?php echo esc_attr( wp_unslash( $company ) ); ?>">
								
								</div><!--
								--><div class="col-item col-item-9-10 col-item-half--medium col-item-full--large col-item-full--xlarge">

									<label for="malinky_email">Email*</label>
									<input type="email" name="malinky_email" id="malinky_email" placeholder="" value="<?php echo esc_attr( wp_unslash( $email ) ); ?>" required email>
									<?php if (isset($malinky_error_messages['email_error'][0])) echo '<p class="box error">' . $malinky_error_messages['email_error'][0] . '</p>'; ?>
									
									<label for="malinky_phone">Phone</label>
									<input type="text" name="malinky_phone" id="malinky_phone" value="<?php echo esc_attr( wp_unslash( $phone ) ); ?>" malinkyPhone pattern="[0-9 ]+">
									<?php if (isset($malinky_error_messages['phone_error'][0])) echo '<p class="box error">' . $malinky_error_messages['phone_error'][0] . '</p>'; ?>

								</div>
							</div><!-- .col nested -->
						</div><!--
						--><div class="col-item col-item-9-10 col-item-full--medium col-item-half--large col-item-half--xlarge">

							<label for="malinky_message">Message*</label>
							<textarea name="malinky_message" id="malinky_message" rows="13" required><?php echo esc_textarea( wp_unslash( $message ) ); ?></textarea>
							<?php if (isset($malinky_error_messages['message_error'][0])) echo '<p class="box error">' . $malinky_error_messages['message_error'][0] . '</p>'; ?>
							<?php wp_nonce_field( 'malinky_process_contact_form', 'malinky_process_contact_form_nonce' ); ?>
							
							<!--<div class="malinky-captcha">
							<label for="malinky_captcha" class="malinky-captch__label">Are you human?</label>
							<?php //if ( function_exists( 'cptch_display_captcha_custom' ) ) { ?>
								<input type="hidden" name="cntctfrm_contact_action" value="true" />
								<?php //echo cptch_display_captcha_custom();
							//} ?>
							</div>-->

						</div>
						<div class="col-item col-item-9-10 col-item-full--medium col-item-full--large col-item-full--xlarge">
							<input type="submit" value="Send Your Message" name="submit_contact">
						</div>
					</div><!-- .col -->
				</form>

			</div>
		</div>

	<?php return ob_get_clean(); ?>
	
<?php
}


/**
 * Called from header.php to check if on the selected contact form page for form processing.
 */
function malinky_contact_form_header()
{

	$contact_form_page = get_field( 'contact_form_page', 'option' );
	
	/*
	 * Check it exists (isn't false) then if on the correct page.
	 */
	if ( ! isset( $contact_form_page['contact_form_page'] ) && is_page( $contact_form_page['contact_form_page'] ) ) {
	
		$error_messages 	= array();
		$name 				= isset( $_POST['malinky_name'] ) ? $_POST['malinky_name'] : '';
		$company			= isset( $_POST['malinky_company'] ) ? $_POST['malinky_company'] : '';
		$email 				= isset( $_POST['malinky_email'] ) ? $_POST['malinky_email'] : '';
		$phone 				= isset( $_POST['malinky_phone'] ) ? $_POST['malinky_phone'] : '';	
		$message 			= isset( $_POST['malinky_message'] ) ? $_POST['malinky_message'] : '';

		if ( ! empty( $_POST['submit_contact'] ) ) {	
			$errors = malinky_contact_form_process( $name, $company, $email, $phone, $message );
			if ( is_wp_error( $errors ) ) {
				global $malinky_error_messages;
				$malinky_error_messages = $errors->errors;
			} else {
				$success = $errors;
			}
		}

	}

}


/**
 * Process the contact form and error checking.
 * 
 * @param string $name 
 * @param string $company
 * @param string $phone
 * @param string $email  
 * @param string $message     
 * @return void
 */
function malinky_contact_form_process( $name, $company, $email, $phone, $message )
{

	//check form submit and nonce
	if ( ( empty($_POST['submit_contact'] ) ) || ( ! isset( $_POST['malinky_process_contact_form_nonce'] ) ) || ( ! wp_verify_nonce( $_POST['malinky_process_contact_form_nonce'], 'malinky_process_contact_form' ) ) )
		wp_die( __( 'There was a fatal error with your form submission' ) );

	$errors = new WP_Error();
	$contact_error_messages = malinky_contact_form_error_messages();

	$sanitized_name 		= sanitize_text_field( $name );
	$sanitized_company 		= sanitize_text_field( $company );
	$sanitized_email 		= sanitize_email( $email );	
	$sanitized_phone 		= sanitize_text_field( $phone );	
	$sanitized_message 		= sanitize_text_field( $message );			

	//check the first_name
	if ( $sanitized_name == '' ) {
		$errors->add( 'name_error', __( $contact_error_messages['name_error'] ) );
	}

	//check the email
	if ( $sanitized_email == '' ) {
		$errors->add( 'email_error', __( $contact_error_messages['email_error'] ) );
	} elseif ( ! is_email( $sanitized_email ) ) {
		$errors->add('email_error', __( $contact_error_messages['email_error'] ) );
	}

	//check the phone
	if ( $sanitized_phone != '' ) {
		if ( ! preg_match( '/[0-9 ]+$/', $sanitized_phone ) ) {		
			$errors->add( 'phone_error', __( $contact_error_messages['phone_error_2'] ) );
		}
	}		

	//check the message
	if ( $sanitized_message == '' ) {
		$errors->add( 'message_error', __( $contact_error_messages['message_error'] ) );
	}

	//check the captcha
 	/*if ( function_exists( 'cptch_check_custom_form' ) && cptch_check_custom_form() !== true ) {
 		$errors->add( 'message_error', __( $contact_error_messages['captcha_error'] ) );
 	}*/

	//if validation errors
	if ( $errors->get_error_code() )
		return $errors;

	//send registration email
	malinky_contact_form_email( $sanitized_name, $sanitized_company, $sanitized_email, $sanitized_phone, $sanitized_message );

	global $post;
	wp_safe_redirect( $post->post_name . '?contact=success#contact-success', 303 );

}


/**
 * Contact form errors.
 */
function malinky_contact_form_error_messages()
{

	return array(
		'name_error'		=> 'Please enter your name.',
		'email_error'		=> 'Please enter a valid email address.',		
		'phone_error'		=> 'Please enter your phone number.',
		'phone_error_2'		=> 'Please enter a valid phone number.',
		'message_error'		=> 'Please enter a message.',
		//'captcha_error'	=> 'Please enter the correct value.',
	);

}


/**
 * Send the contact form email.
 * 
 * @param string $sanitized_name  
 * @param string $sanitized_company  
 * @param string $sanitized_email  
 * @param string $sanitized_phone
 * @param string $sanitized_message      
 * @return void   
 */
function malinky_contact_form_email( $sanitized_name, $sanitized_company, $sanitized_email, $sanitized_phone, $sanitized_message )
{

	include_once( ABSPATH . WPINC . '/class-phpmailer.php' );
	
	$mail = new PHPMailer();

	$mail->IsSMTP();
	$mail->Host 		= get_field( 'email_host', 'option' );
	$mail->SMTPAuth   	= true;
	$mail->Port       	= get_field( 'email_port', 'option' );
	$mail->Username   	= get_option( 'admin_email' );
	$mail->Password   	= get_field( 'email_password', 'option' );
	$mail->SMTPSecure 	= 'ssl';	

	$mail->AddAddress( get_field( 'malinky_settings_contact_email_address', 'option' ), get_bloginfo( 'name' ) );

	$mail->SetFrom( get_field( 'malinky_settings_contact_email_address', 'option' ), get_bloginfo( 'name' ) );

	$mail->IsHTML(true);

	$mail->CharSet = 'UTF-8';

	$mail->Subject 	= get_bloginfo( 'name' ) . ' Contact Form Message';
	$mail->Body    	= '<p>Name: ' . $sanitized_name . '</p>';
	$mail->Body    .= '<p>Company: ' . $sanitized_company . '</p>';
	$mail->Body    .= '<p>Email: ' . $sanitized_email . '</p>';
	$mail->Body    .= '<p>Phone: ' . $sanitized_phone . '</p>';
	$mail->Body    .= '<p>Message: ' . $sanitized_message . '</p>';			

	if( ! $mail->Send() ) {
		error_log( $mail->ErrorInfo, 0 );
    }

}