<?php
function totalwpcareGoogleAuthValidation() {
  if(!is_admin())
    include( TOTALWPCARE__PLUGIN_DIR . 'front/google-auth-validation.php' );
}
add_shortcode('GOOGLE_AUTH_VALIDATION', 'totalwpcareGoogleAuthValidation');
?>