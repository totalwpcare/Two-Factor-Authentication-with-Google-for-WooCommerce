<?php
function totalwpcareGoogleAuthConfiguration() {
	if(!is_admin())
		include( TOTALWPCARE__PLUGIN_DIR . 'front/google-auth-configuration.php' );
}
add_shortcode('GOOGLE_AUTH_CONFIGURATION', 'totalwpcareGoogleAuthConfiguration');
?>