<?php
function logout_remove_cookie() {
    setcookie("TotalWPCareDotCom", "", time() - 3600);
}
add_action( 'wp_logout', 'logout_remove_cookie' );
?>