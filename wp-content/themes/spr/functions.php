<?php
require('functions/_init.php');
require('functions/enqueue.php');
require('functions/svg.php');

if( function_exists('acf_add_options_page') ) {

	$option_page = acf_add_options_page(array(
		'page_title' 	=> 'Globals',
		'menu_title' 	=> 'Globals',
		'menu_slug' 	=> 'theme-global-conent',
        'capability' 	=> 'edit_posts',
        'icon_url'      =>'dashicons-admin-site',
        'redirect' 	=> false,
        'position'  => 4
	));
}

function yoasttobottom() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');

add_action( 'admin_footer', function () {
	?>
	<script>
		if ( typeof commonL10n === 'undefined' ) {
			var commonL10n = { dismiss : 'Dismiss' };
		}
	</script>
	<?php
}, 100 );

function wpse27856_set_content_type(){
    return "text/html";
}
add_filter( 'wp_mail_content_type','wpse27856_set_content_type' );

function booking_form_ajax(){

    $errors = array();
    $return = array();

    if (filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)) {
        $from = $_REQUEST['email'];
    } else {
        $errors[] = 'Please enter a valid email address.';
    }

    if(isset($_REQUEST['fname']) && !empty($_REQUEST['fname'])) {
        $fname = $_REQUEST['fname'];
    } else {
        $errors[] = 'Please enter your first name.';
    }

	if(isset($_REQUEST['lname']) && !empty($_REQUEST['lname'])) {
        $lname = $_REQUEST['lname'];
    } else {
        $errors[] = 'Please enter your last name.';
    }

	$phone       	= $_REQUEST['telephone'];
	$arrival_date   = $_REQUEST['arrival_date'];
	$nights   		= $_REQUEST['nights'];
    $message       	= $_REQUEST['comments'];
	
	$arrival_date   = date('l jS \of F Y', strtotime($arrival_date));

    if (empty($errors) ) {

		$to = 'sparthtopretreat@outlook.com';

        $body = '<h1>Booking Request</h1><table cellpadding="5" border="1" cellspacing="0">';
            $body .= '<tr>';
                $body .= '<td width="200">Name</td>';
                $body .= '<td>'.$fname.' '.$lname.'</td>';
            $body .= '</tr>';
            $body .= '<tr>';
                $body .= '<td>Email</td>';
                $body .= '<td>'.$from.'</td>';
            $body .= '</tr>';
            $body .= '<tr>';
                $body .= '<td>Telephone</td>';
                $body .= '<td>'.$phone.'</td>';
			$body .= '</tr>';
			$body .= '<tr>';
                $body .= '<td>Booking request:</td>';
                $body .= '<td>'.$arrival_date.' for '.$nights.' nights</td>';
			$body .= '</tr>';
			if (!empty($message) || $message != '') {
				$body .= '<tr>';
	                $body .= '<td>Message/Questions</td>';
	                $body .= '<td>'.$message.'</td>';
	            $body .= '</tr>';
			}
        $body .= '</table>';

        $body .= "<p style='color:#999;'><em><small>This form was sent from: ".home_url('/bookings/').'</small></em></p>';

        $subject = 'Website Booking Request';
        $headers = "Reply-To: ". $from . "\r\n";

        $send = wp_mail( $to, $subject, $body, $headers);

        if ($send) {
            $return['status'] = 'success';
        } else {
            $return['status'] = 'fail';
            $errors[] = 'WP Mail didnt send';
            $return['errors'] = $errors;
        }

    } else {
        $return['status'] = 'fail';
        $return['errors'] = $errors;
    }

    $return['original_request'] = $_REQUEST;

    echo json_encode($return);
	die;
}

add_action('wp_ajax_booking_form_ajax', 'booking_form_ajax');
add_action('wp_ajax_nopriv_booking_form_ajax', 'booking_form_ajax');
