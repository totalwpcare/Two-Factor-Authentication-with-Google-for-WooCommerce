<?php
/**
Plugin Name: Two Factor Authentication with Google for WooCommerce
Plugin URI: http://totalwpcare.com/
Description:  This plugin provides Google Authenticator as an additional layer of security to Woocommerce login. 
Version: 1.0.0
Author: the TotalWPCare Team
Author URI: http://totalwpcare.com
License: GPLv2 or later
Text Domain: totalwpcare
**/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit 

if ( ! class_exists( 'TotalWPCare_google_authenticator' ) ) :
class TotalWPCare_google_authenticator {
  /**
  * Construct the plugin.
  */
  public function __construct() {
    add_action( 'plugins_loaded', array( $this, 'init' ) );
  }
  /**
  * Initialize the plugin.
  */
  public function init() {
  	global $wp;
    // Checks if WooCommerce is installed.
    if ( class_exists( 'WC_Integration' ) ) {
      // Include our integration class.
    	define( 'TOTALWPCARE_VERSION', '1.0.0' ); // Version of Plugin
		define( 'TOTALWPCARE__PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		define( 'TOTALWPCARE__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

		include(TOTALWPCARE__PLUGIN_DIR . 'core/totalwpcare_GoogleAuthenticator.php');
		include(TOTALWPCARE__PLUGIN_DIR . 'core/totalwpcare_google-auth-js.php');
		include(TOTALWPCARE__PLUGIN_DIR . 'core/totalwpcare_ajax-api.php');
		include(TOTALWPCARE__PLUGIN_DIR . 'shortcodes/totalwpcare_google-auth-configuration.php');
		include(TOTALWPCARE__PLUGIN_DIR . 'shortcodes/totalwpcare_google-auth-validation.php');
		include(TOTALWPCARE__PLUGIN_DIR . 'customer/totalwpcare_wc-account-end-point.php');
		include(TOTALWPCARE__PLUGIN_DIR . 'customer/totalwpcare_wc-logout.php');
		
		// include(TOTALWPCARE__PLUGIN_DIR . 'shortcodes/google-authentication.php');
      // Register the integration.
    // add_filter( 'woocommerce_integrations', array( $this, 'add_integration' ) );

      add_action('init','TotalWPCare_redirect_user');
		function TotalWPCare_redirect_user(){
		if (!wp_doing_ajax()) {
		  if(is_user_logged_in()){
			  	if(empty(get_user_meta(get_current_user_id(), 'TotalWPCare_google_auth_secret', true)))
			  	{
			  		$url = parse_url($_SERVER['REQUEST_URI']);
				 	if($url['path'] != '/my-account/twc-google-authenticator/')
				 	{
				 		$google_auth_url = wc_get_account_endpoint_url('twc-google-authenticator');
				    	die(wp_redirect($google_auth_url));
				    	// die; // You have to die here
				 	}
			  	}
			  	else
			  	{

			  		$twc_check = isset($_COOKIE['TotalWPCareDotCom']) ? sanitize_key($_COOKIE['TotalWPCareDotCom']) : '';
			  		if(empty($twc_check))
			  		{
			  			$url = parse_url($_SERVER['REQUEST_URI']);
			  			$google_validator_url = wc_get_account_endpoint_url('twc-google-validator');
			  			if($url['path'] != '/my-account/twc-google-validator/')
			  			{
			  				die(wp_redirect($google_validator_url));
			  				// die; // You have to die here
			  			}
			  		}
			  	}
		  	}
		  }
		}
    }
  }
  /**
   * Add a new integration to WooCommerce.
   */
  public function add_integration( $integrations ) {
    $integrations[] = 'TotalWPCare_google_authenticator';
    return $integrations;
  }
}
$TotalWPCare_google_authenticator = new TotalWPCare_google_authenticator( __FILE__ );
endif;

function TotalWPCare_check_woocommerce()
{

    if (!is_plugin_active('woocommerce/woocommerce.php')) {
        ob_start();
        ?><div class="error">
            <p><strong><?php _e('WARNING', 'totalwpcare'); ?></strong>: <?php _e('WooCommerce not installed or not active, therefore, WooCommerce Google Authenticator will not work!', 'totalwpcare'); ?></p>
        </div><?php
        ob_get_clean();
    }
}

    add_action('admin_notices', 'TotalWPCare_check_woocommerce');