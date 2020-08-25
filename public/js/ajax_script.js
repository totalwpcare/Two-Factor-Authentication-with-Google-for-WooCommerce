  // jQuery(document).ready( function() {

   jQuery("#google_auth_step_1").click( function(e) {
      e.preventDefault(); 

      jQuery.ajax({
         type : "post",
         dataType : "json",
         url : myAjax.ajaxurl,
         data : {action: "google_auth_step_1"},
         success: function(response) {
            if(response.type == "success") {
               alert('Hi');
            }
            else {
               alert("Your vote could not be added")
            }
         }
      })   

   })

// });