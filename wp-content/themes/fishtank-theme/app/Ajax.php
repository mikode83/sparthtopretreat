<?php

/**
 * Theme Ajax Functions
 */

namespace App;

/**
 * Add Ajax URL to head
 */
add_action('wp_head', function () {
	echo '<script>var ajaxurl = "' . admin_url('admin-ajax.php') . '"; </script>';
});

class Ajax
{
	public function __construct()
	{
		// Example Form
		add_action('wp_ajax_example_form', [$this, 'exampleForm']);
		add_action('wp_ajax_nopriv_example_form', [$this, 'exampleForm']);
	}

	/* public static function getCaptcha($captcha_response)
	{
	$secret_key = '';
	$response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret_key . '&response=' . $_REQUEST['g-recaptcha-response']);
	$return = json_decode($response);
	return $return;
	} */

	public function exampleForm()
	{
		// Set vars
		$errors = array();
		$response = array();

		// Get recaptcha response
		//$recaptcha = self::getCaptcha($_POST['g-recaptcha-response']);

		if (wp_verify_nonce($_POST['example_form_nonce'], 'example_form_ajax_nonce')) {
			if ($_POST['your_name'] == '') {
				$errors[] = 'Please enter your name.';
			}

			if ($_POST['email'] == '') {
				$errors[] = 'Please enter your email address.';
			}

			if ($_POST['message'] == '') {
				$errors[] = 'Please enter a message.';
			}

			if (empty($_POST['marketing_consent'])) {
				$errors[] = 'Please agree to the terms and conditions.';
			}

			/* if ($recaptcha->success == false) {
			$errors[] = 'reCAPTCHA has failed.';
			} */

			if (empty($errors)) {
				// Clean up your form fields: https://developer.wordpress.org/themes/theme-security/data-sanitization-escaping/
				$form_fields = [
					'your_name' => sanitize_text_field($_POST['your_name']),
					'company' => sanitize_text_field($_POST['company']),
					'email' => sanitize_email($_POST['email']),
					'telephone' => sanitize_text_field($_POST['telephone']),
					'message' => sanitize_textarea_field($_POST['message']),
					'sent_from' => esc_url_raw($_POST['sent_from']),
				];

				// Create an empty string to add HTML to;
				$body = '';

				// Loop through the fields array and create the HTML for your email:
				foreach ($form_fields as $key => $value) {
					// transform the key to a readable label/name
					$label = ucfirst(str_replace('_', ' ', $key));
					$body .= sprintf('<p><strong style="display: inline-block; width: 140px;">%s: </strong>%s</p>', $label, $value);
				}

				// Email setup
				$to = sanitize_email($_POST['send_to']);
				$subject = 'Website Enquiry: General Enquiry';
				$headers[] = 'Reply-To: ' . $form_fields["your_name"] . ' <' . $form_fields["email"] . '>' . "\r\n";
				$headers[] = 'From: ' . $form_fields["your_name"] . ' <' . $form_fields["email"] . '>' . "\r\n";
				$headers[] = 'Content-Type: text/html; charset=UTF-8';

				// Send the contact form through WP
				$send_email = wp_mail($to, $subject, $body, $headers);

				// Set a response if the email is sent
				if ($send_email) {
					$response['status'] = 'success';
				} else {
					$response['status'] = 'error';
					$errors[] = 'Failed to send message.';
					$response['errors'] = $errors;
				}
			} else {
				$response['status'] = 'error';
				$response['errors'] = $errors;
			}
		} else {
			$response['status'] = 'error';
			$errors[] = 'Nonce Check Failed';
			$response['errors'] = $errors;
		}

		// Send $response back
		wp_send_json($response);
		wp_die();
	}
}

new Ajax();
