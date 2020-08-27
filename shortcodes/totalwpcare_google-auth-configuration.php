<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit 

function totalwpcareGoogleAuthConfiguration() {
	if(!is_admin())
		include( TOTALWPCARE__PLUGIN_DIR . 'front/TotalWPCare_google-auth-configuration.php' );
}
add_shortcode('GOOGLE_AUTH_CONFIGURATION', 'totalwpcareGoogleAuthConfiguration');
?>