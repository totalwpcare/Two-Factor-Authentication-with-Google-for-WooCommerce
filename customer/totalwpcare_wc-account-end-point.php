<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit 

/**
  * Register new endpoints to use inside My Account page.
  */

 add_action( 'init', 'TotalWPCare_add_twc_google_authenticator_endpoint' );

 function TotalWPCare_add_twc_google_authenticator_endpoint() {
 	add_rewrite_endpoint( 'twc-google-authenticator', EP_ROOT | EP_PAGES );
 }

 function TotalWPCare_google_authenticator_query_vars( $vars ) {
    $vars[] = 'twc-google-authenticator';
    return $vars;
}
   
add_filter( 'query_vars', 'TotalWPCare_google_authenticator_query_vars', 10, 1 );

// ------------------
// 3. Insert the new endpoint into the My Account menu
   
function TotalWPCare_add_google_authenticator_my_account( $items ) {
    $items['twc-google-authenticator'] = 'Google Authenticator';
    $items = array_slice( $items, 0, 5, true ) 
	+ array( 'twc-google-authenticator' => 'Google Authenticator' )
	+ array_slice( $items, 5, NULL, true );
    return $items;
}
   
add_filter( 'woocommerce_account_menu_items', 'TotalWPCare_add_google_authenticator_my_account' );


// ------------------
// 4. Add content to the new endpoint
   
function TotalWPCare_google_authenticator_content() {
	?>
	<h3 style="text-align: center;">TWC Google Authenticator Setup</h3>
	<?php
	echo do_shortcode( '[GOOGLE_AUTH_CONFIGURATION]' );

}  
add_action( 'woocommerce_account_twc-google-authenticator_endpoint', 'TotalWPCare_google_authenticator_content' );
// Note: add_action must follow 'woocommerce_account_{your-endpoint-slug}_endpoint' format

 add_action( 'init', 'TotalWPCare_add_twc_google_auth_validator_endpoint' );

 function TotalWPCare_add_twc_google_auth_validator_endpoint() {
 	add_rewrite_endpoint( 'twc-google-validator', EP_ROOT | EP_PAGES );
 }

 function TotalWPCare_google_validator_content() {
 	?>
	<h3 style="text-align: center;">TWC Google Authenticator Validator</h3>
	<?php
	echo do_shortcode( '[GOOGLE_AUTH_VALIDATION]' );

}
add_action( 'woocommerce_account_twc-google-validator_endpoint', 'TotalWPCare_google_validator_content' );

?>