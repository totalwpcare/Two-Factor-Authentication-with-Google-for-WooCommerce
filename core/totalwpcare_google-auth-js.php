<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit 

function TotalWPCare_google_auth_js() { ?>
<script type="text/javascript">
    jQuery("#google_auth_step_1").click( function(e) {
      e.preventDefault(); 

      jQuery.ajax({
         type : "POST",
         url : "<?php echo admin_url('admin-ajax.php'); ?>",
        dataType: 'text',
         data : {action: 'TotalWPCare_google_auth_step_1', 'nonce': "<?php echo wp_create_nonce("google_auth_step_1"); ?>"},
         success: function(response) {
          jQuery('#google_auth_data').html(response);
         }
      });   

   });

    jQuery("#google_auth_validate").click( function(e) {
      e.preventDefault(); 
      var verification_code = jQuery('#verification_code').val();
      jQuery.ajax({
         type : "POST",
         url : "<?php echo admin_url('admin-ajax.php'); ?>",
        dataType: 'text',
         data : {action: 'TotalWPCare_validate_google_auth', verification_code: verification_code, 'nonce': "<?php echo wp_create_nonce("validate_google_auth"); ?>"},
         success: function(response) {
          if(response.trim() === 'ok')
          {
            window.location.href = "<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>";
          }
          else
          {
            alert('Invalid Code. Please Try Again');
          }
         }
      });   

   });
</script>
<?php }
add_action( 'wp_footer', 'TotalWPCare_google_auth_js' );
?>