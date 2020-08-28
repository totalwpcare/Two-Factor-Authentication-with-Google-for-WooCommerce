<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit 

function totalwpcareGoogleAuthValidation() {
  if(!is_admin())
    include( TOTALWPCARE__PLUGIN_DIR . 'front/totalwpcare_google-auth-validation.php' );
}
add_shortcode('GOOGLE_AUTH_VALIDATION', 'totalwpcareGoogleAuthValidation');
?>