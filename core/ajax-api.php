<?php
global $current_user;
function google_auth_step_1() {
  $ga = new GoogleAuthenticator();
 $secret = $ga->createSecret();
// $secret = '2EYTTAJCCMWCCA32';
// echo $secret;
 $site_title = get_bloginfo( 'name' );
$qrCodeUrl = $ga->getQRCodeGoogleUrl("TWC:".$site_title.":".$current_user->display_name, $secret);
$admin_ajax = admin_url('admin-ajax.php');
$google_auth_step_2_nonce = wp_create_nonce("google_auth_step_2");
$html = '<p class="desc">Please scan this QR code in Google Authenticator and Enter the Code Displayed in Google Authenticator App.</p>';
$html .= '<img class="ga-qr_code" src="'.$qrCodeUrl.'">'; 
$html .= '<input type="hidden" id="google_auth_secret" value="'.$secret.'">'; 
$html .= '<input class="ga-vericode-input" type="text" id="verification_code" placeholder="Enter Code">';
$html .= '<button class="btn-setup-ga" id="google_auth_step_2">Proceed</button>';
$html .= '<script type="text/javascript">jQuery("#google_auth_step_2").click( function(e) {
     // e.preventDefault(); 
      var google_auth_secret = jQuery("#google_auth_secret").val();
      var verification_code = jQuery("#verification_code").val();
      jQuery.ajax({
         type : "POST",
         url : "'.$admin_ajax.'",
        dataType: "text",
         data : {action: "google_auth_step_2", verification_code: verification_code, google_auth_secret: google_auth_secret, nonce: "'.$google_auth_step_2_nonce.'"},
         success: function(response) {
          jQuery("#google_auth_data").html(response);
         }
      });   

   });</script>';
echo $html;
die();
}

add_action("wp_ajax_google_auth_step_1", "google_auth_step_1");
add_action("wp_ajax_nopriv_google_auth_step_1", "google_auth_step_1");

function google_auth_step_2() {
   if(!empty($_POST['google_auth_secret']) && !empty($_POST['verification_code']))
   {
      $ga = new GoogleAuthenticator();
      $google_auth_secret = $_POST['google_auth_secret'];
      $verification_code = $_POST['verification_code'];
      $current_user_id = get_current_user_id();
      $secret_code = $ga->getCode($google_auth_secret);
      
      if($ga->verifyCode($google_auth_secret, $verification_code, 3))
      {
         if(update_user_meta($current_user_id, 'google_auth_secret', $google_auth_secret))
         {
            $html = '<p class="ga-setup-success">Google Authenticator Setup Successfully</p>';
         }
         else
         {
            $html = '<p class="ga-setup-error">Something Went Wrong!!</p>';
         }
      }
      else
      {
         $html = '<p class="ga-setup-error">Invalid Verification Code. Please try again!!</p>';
      }
   }
   else
   {
      $html = '<p class="ga-setup-error">Something Went Wrong!!</p>';
   }
echo $html;
die();
}

add_action("wp_ajax_google_auth_step_2", "google_auth_step_2");
add_action("wp_ajax_nopriv_google_auth_step_2", "google_auth_step_2");

function validate_google_auth() {
   if(!empty($_POST['verification_code']))
   {
      $ga = new GoogleAuthenticator();
      $current_user_id = get_current_user_id();
      $google_auth_secret = get_user_meta($current_user_id, 'google_auth_secret', true);
      $verification_code = $_POST['verification_code'];
      $secret_code = $ga->getCode($google_auth_secret);
      
      if($ga->verifyCode($google_auth_secret, $verification_code, 3))
      {
         setcookie('TotalWPCareDotCom', '1', time()+3000, '/');
         sleep(2);
         $html = 'ok';
      }
      else
      {
         $html = 'error';
      }
   }
   else
   {
      $html = 'error';
   }
echo $html;
die();
}

add_action("wp_ajax_validate_google_auth", "validate_google_auth");
add_action("wp_ajax_nopriv_validate_google_auth", "validate_google_auth");
?>