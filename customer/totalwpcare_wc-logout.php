<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit 

function TotalWPCare_logout_remove_cookie() {
    setcookie("TotalWPCareDotCom", "", time()-3600);
}
add_action( 'wp_logout', 'TotalWPCare_logout_remove_cookie' );
?>