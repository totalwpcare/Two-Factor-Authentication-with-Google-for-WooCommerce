<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit 
?>
<div class="wrap">
   <div class="search">
      <p class="desc">Please enter the validation code displayed in Google Authenticator App.</p>
      <div id="divOuter">
        <div id="divInner">
          <input class="" type="text" id="verification_code" placeholder="000000" maxlength="6" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  onKeyPress="if(this.value.length==6) return false;">
        </div>
      </div>
      <button class="btn-setup-ga" id="google_auth_validate">Validate</button>
      <a class="button" href="<?php echo wc_logout_url() ?>">Logout</a>
   </div>
</div>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap');
  .ga-img{
    width:auto;
    height:120px !important;
    margin: 0 auto;
    margin-bottom:2rem;
  }
  .wrap{
    width:500px;
    margin:20px auto;
    background-color: #ffffff;
    padding: 20px;
    transition: background 0.3s, border 0.3s, border-radius 0.3s, box-shadow 0.3s;
    text-align: center;
    font-family: 'Nunito', sans-serif;
    border: 1px solid #e4e4e4;
  }
  .wrap .desc{
    font-size: 16px;
    margin-bottom:1.5rem;
    font-weight: 600;
    font-family: 'Nunito', sans-serif;
  }
  .btn-setup-ga{
    display: inline-flex;
    align-items: center;
    justify-content: center;
    position: relative;
    padding: 12px 30px;
    margin: .3125rem 1px;
    font-weight: 700;
    font-family: 'Nunito', sans-serif;
    line-height: 1.5;
    text-decoration: none;
    text-transform: capitalize;
    cursor: pointer;
    background-color: #e5f1ff;
    color: #1565C0;
    border: 0;
    border-radius: .2rem;
    outline: 0;
    transition: box-shadow .2s cubic-bezier(.4, 0, 1, 1), background-color .2s cubic-bezier(.4, 0, .2, 1);
    will-change: box-shadow, transform;
  }
  .btn-setup-ga:hover{
    background-color: #d4e6fb;
    -webkit-box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
  }
  .ga-qr_code{
    width:auto;
    height:120px !important;
    margin: 32px auto;
  }
  input.ga-vericode-input[type="text"], input.ga-vericode-input[type="number"]{
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    display: block;
    width: 100%;
    height:auto;
    font-size: 16px;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    padding: 18px 12px 12px;
    background: #f5f5f5 no-repeat;
    background-image: -webkit-gradient(linear,left top,left bottom,from(#4285f4),to(#4285f4)),-webkit-gradient(linear,left top,left bottom,from(#ced4da),to(#ced4da));
    background-image: linear-gradient(to bottom,#4285f4,#4285f4),linear-gradient(to bottom,#ced4da,#ced4da);
    background-position: 50% 100%,50% 100%;
    background-size: 0 2px,100% 1px;
    border: 0;
    border-radius: 0;
    outline: 0;
    border-top-left-radius: .3rem;
    border-top-right-radius: .3rem;
    -webkit-transition: background-size .3s cubic-bezier(0.64,0.09,0.08,1);
    transition: background-size .3s cubic-bezier(0.64,0.09,0.08,1);
    margin: 0 0 32px 0;
  }
  input.ga-vericode-input[type="text"]:focus,  input.ga-vericode-input[type="number"]:focus {
    background-color: #dcdcdc;
    background-size: 100% 2px,100% 1px;
    outline: 0;
  }
  .ga-setup-success{
    font-size: 20px;
    font-weight: bold;
    background: #e2f9e0;
    color: #4CAF50;
    padding: 15px;
    border-radius: 10px;
  }
  .ga-setup-error{
    font-size: 20px;
    font-weight: bold;
    background: #fbedec;
    color: #F44336;
    padding: 15px;
    border-radius: 10px;
  }
  #divInner{
  left: 0;
  position: sticky;
}
#divOuter{
  width: 384px; 
  margin: 0 auto;
  overflow: hidden;
}
#verification_code{
    padding: 0px;
    padding-left: 15px;
    letter-spacing: 52px;
    font-size: 20px;
    font-weight: 700;
    border: 0;
    background-image: linear-gradient(to left, #464646 70%, rgba(255, 255, 255, 0) 0%);
    background-position: bottom;
    background-size: 64px 2px;
    background-repeat: repeat-x;
    background-position-x: 45px;
    width: 435px;
    min-width:435px;
    margin-bottom: 1rem;
}
  @media (max-width:575px){
    .wrap{
    width:90%;
    margin:20px auto;
  }
  }
</style>
<script type="text/javascript">
  jQuery('.woocommerce-MyAccount-navigation').remove();
  jQuery("div").removeClass("woocommerce-MyAccount-content");
</script>
<?php
// include( TOTALWPCARE__PLUGIN_DIR . 'api/search_process.php' );
?>