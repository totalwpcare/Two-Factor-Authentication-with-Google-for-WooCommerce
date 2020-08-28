<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit 

function TotalWPCare_google_auth_step_1() {
   global $current_user; wp_get_current_user(); 
   $ga = new TotalWPCare_GoogleAuthenticator();
   $secret = $ga->createSecret();
   $site_title = get_bloginfo( 'name' );
   $qrCodeUrl = $ga->getQRCodeGoogleUrl("TWC:".$site_title.":".$current_user->user_login, $secret);
   $admin_ajax = admin_url('admin-ajax.php');
   $google_auth_step_2_nonce = wp_create_nonce("google_auth_step_2");
   ?>
   <p id="error_msg" class="ga-setup-error"></p>
   <p class="">Open Google Authenticator App on your phone. Click on the Add button (+).</p>
   <p class="desc mb-3">Please scan this QR code in Google Authenticator</p>
   <img class="ga-qr_code" src="<?php echo $qrCodeUrl ?>">
   <p class="or-text">===OR===</p>
   <p class="desc">Click on the option "Enter a provided key". <br> Enter "Account name" as "TWC:<?php echo $site_title ?>:<?php echo $current_user->user_login ?> and enter "Your key" as shown below. </p>
   <h4 class="code__verify mb-2 mt-3"><?php echo $secret ?></h4>
   <p class="desc">Enter the Code Displayed in Google Authenticator App.</p>
   <div id="divOuter">
   <div id="divInner">
      <input type="hidden" id="google_auth_secret" value="<?php echo $secret ?>">
      <input class="" type="text" id="verification_code" placeholder="000000" maxlength="6" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  onKeyPress="if(this.value.length==6) return false;">
   </div>
   </div>
   <button class="btn-setup-ga" id="google_auth_step_2">Proceed</button>
   <script type="text/javascript">jQuery("#google_auth_step_2").click( function(e) {
     // e.preventDefault(); 
      var google_auth_secret = jQuery("#google_auth_secret").val();
      var verification_code = jQuery("#verification_code").val();

      jQuery.ajax({
         type : "POST",
         url : "<?php echo $admin_ajax ?>",
        dataType: "text",
         data : {action: "TotalWPCare_google_auth_step_2", verification_code: verification_code, google_auth_secret: google_auth_secret, nonce: "<?php echo $google_auth_step_2_nonce ?>"},
         success: function(response) {
            if(response.trim() === "success")
            {
               jQuery("#google_auth_data").html("<p class=\"ga-setup-success\">Google Authenticator Setup Successfully</p>");
            }
            else
            {
               jQuery("#error_msg").html(response);
            }
         }
      });   

   });</script>
   <?php
die();
}

add_action("wp_ajax_TotalWPCare_google_auth_step_1", "TotalWPCare_google_auth_step_1");
add_action("wp_ajax_nopriv_TotalWPCare_google_auth_step_1", "TotalWPCare_google_auth_step_1");

function TotalWPCare_google_auth_step_2() {
   if(!empty($_POST['google_auth_secret']) && !empty($_POST['verification_code']))
   {
      $google_auth_secret = sanitize_text_field($_POST['google_auth_secret']);
      $verification_code = sanitize_text_field($_POST['verification_code']);
      if(is_numeric($verification_code))
      {
         $ga = new TotalWPCare_GoogleAuthenticator();
         $current_user_id = get_current_user_id();
         $secret_code = $ga->getCode($google_auth_secret);
         
         if($ga->verifyCode($google_auth_secret, $verification_code, 3))
         {
            if(update_user_meta($current_user_id, 'TotalWPCare_google_auth_secret', $google_auth_secret))
            {
               setcookie('TotalWPCareDotCom', '1', time()+3000, '/');
               $html = 'success';
              // $html = '<p class="ga-setup-success">Google Authenticator Setup Successfully</p>';
            }
            else
            {
               $html = 'Something Went Wrong!!';
            }
         }
         else
         {
            $html = 'Invalid Verification Code. Please try again!!';
         }
      }
      else
      {
         $html = 'Please enter valid Number.';
      }
   }
   else
   {
      $html = 'Something Went Wrong!!';
   }
echo esc_html($html);
die();
}

add_action("wp_ajax_TotalWPCare_google_auth_step_2", "TotalWPCare_google_auth_step_2");
add_action("wp_ajax_nopriv_TotalWPCare_google_auth_step_2", "TotalWPCare_google_auth_step_2");

function TotalWPCare_validate_google_auth() {
   if(!empty($_POST['verification_code']))
   {
      $verification_code = sanitize_text_field($_POST['verification_code']);
      if(is_numeric($verification_code))
      {
         $ga = new TotalWPCare_GoogleAuthenticator();
         $current_user_id = get_current_user_id();
         $google_auth_secret = get_user_meta($current_user_id, 'TotalWPCare_google_auth_secret', true);
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
         $html = 'validation_failed';
      }
   }
   else
   {
      $html = 'error';
   }
echo esc_html($html);
die();
}

add_action("wp_ajax_TotalWPCare_validate_google_auth", "TotalWPCare_validate_google_auth");
add_action("wp_ajax_nopriv_TotalWPCare_validate_google_auth", "TotalWPCare_validate_google_auth");
?>
