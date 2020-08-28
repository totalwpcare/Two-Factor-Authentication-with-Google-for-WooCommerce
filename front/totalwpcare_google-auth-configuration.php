<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit 
?>
<div class="d-flex flex-wrap justify-content-between mt-4">
<div class="wrap">
   <div class="search" id="google_auth_data">
      <?php if(!empty(get_user_meta(get_current_user_id(), 'TotalWPCare_google_auth_secret', true))) { ?>
        <img src="<?php echo TOTALWPCARE__PLUGIN_URL ?>public/img/google-authenticator.png" class="ga-img"/>
        <p class="desc">Please scan this QR code in Google Authenticator and Create account to access this Account Again.</p>
        <button class="btn-setup-ga" id="google_auth_step_1">Update Google Authenticator</button>
      <?php } else { ?>
        <h3 class="ga-setup-error">You are not setup your google authenticator Yet! Please configure it to access this website.</h3>
        <img src="<?php echo TOTALWPCARE__PLUGIN_URL ?>public/img/google-authenticator.png" class="ga-img"/>
        <p class="desc">Please setup google authenticator to access all features of this account.</p>
      <button class="btn-setup-ga" id="google_auth_step_1">Setup Google Authenticator Now</button>
    <?php } ?>
    <?php
?>
   </div>
</div>
      <div class="faq-question">
                  <div class="accordion">
                          <div class="option">
                            <input type="checkbox" id="toggle1" class="toggle"/>
                            <label class="title" for="toggle1">How to setup if QR code scanner is not there in your Google Authenticator app ?</label>
                            <div class="content">
                              <p>Use manual keys</p>
                            </div>
                          </div>

                          <div class="option">
                            <input type="checkbox" id="toggle2" class="toggle" />
                            <label class="title" for="toggle2">
                              What happens when I loose the device ?
                            </label>
                            <div class="content">
                              <p>At the time of configuration, please copy the setup key and save it securely. In future you can use the same key in to your phone. But please update the google authenticator immediately.  </p>
                            </div>
                          </div>

                          <div class="option">
                            <input type="checkbox" id="toggle3" class="toggle" />
                            <label class="title" for="toggle3">
                              How to Update Google authenticator ?
                            </label>
                            <div class="content">
                              <p>After first setup complete, there are one button called 'Update Google Authenticator', You can use and update the google authenticator. </p>
                            </div>
                          </div>

                          <div class="option">
                            <input type="checkbox" id="toggle4" class="toggle" />
                            <label class="title" for="toggle4">
                              Why should i setup this ?
                            </label>
                            <div class="content">
                              <p>This is a security feature and it is required thing. </p>
                            </div>
                          </div>

                          <!-- <div class="option">
                            <input type="checkbox" id="toggle5" class="toggle" />
                            <label class="title" for="toggle5">
                              Read the documentation
                            </label>
                            <div class="content">
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                            </div>
                          </div> -->
                  </div>
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
  .faq-question{
    width:49%;
    padding-left:15px;
    padding-right:15px;
  }
  .wrap{
    /* width:500px;
    margin:20px auto;
    border: 1px solid #eef4fb;
    background-color: #ffffff;
    box-shadow: 10px 0px 60px 0px rgba(0, 0, 0, 0.08);
    padding: 40px 40px 40px 40px;
    transition: background 0.3s, border 0.3s, border-radius 0.3s, box-shadow 0.3s;
    border-radius: 20px 20px 20px 20px;
    text-align:center;
    font-family: 'Nunito', sans-serif; */
    width: 49%;
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
    margin: 0px auto;
    margin-bottom:20px;
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
    /* padding: 15px; */
    border-radius: 10px;
  }
  .mission-section .mission-content p.desc{
    letter-spacing:0px;
  }
  .mission-section .mission-content p.or-text{
  font-size: 23px;
    font-weight: 800;
}
.code__verify{
  background-color: #e6e4e4;
    letter-spacing: 1px;
    width: auto;
    padding: 10px;
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
/* Accordion css starts */
.accordion {
  max-width: 100%;
}

.toggle {
  display: none;
}

.option {
  position: relative;
  margin-bottom: 1em;
}

.title,
.content {
  -webkit-backface-visibility: hidden;
          backface-visibility: hidden;
  -webkit-transform: translateZ(0);
          transform: translateZ(0);
  -webkit-transition: all 0.2s;
  transition: all 0.2s;
}

.title {
  background: #fff;
  padding: 1em;
  display: block;
  color: #7A7572;
  font-weight: bold;
  cursor:pointer;
  border: 1px solid #e4e4e4;
}

.title:after, .title:before {
  content: '';
  position: absolute;
  right: 1.25em;
  top: 1.25em;
  width: 2px;
  height: 0.75em;
  background-color: #7A7572;
  -webkit-transition: all 0.2s;
  transition: all 0.2s;
}

.title:after {
  -webkit-transform: rotate(90deg);
          transform: rotate(90deg);
}

.content {
  max-height: 0;
  overflow: hidden;
  background-color: #fff;
}
.content p {
  margin: 0;
  padding: 0.5em 1em 1em;
  font-size: 0.9em;
  line-height: 1.5;
}

.toggle:checked + .title, .toggle:checked + .title + .content {
  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}
.toggle:checked + .title + .content {
  max-height: 500px;
}
.toggle:checked + .title:before {
  -webkit-transform: rotate(90deg) !important;
          transform: rotate(90deg) !important;
}


@media (max-width:767px){
    .wrap{
    width:98%;
    margin:20px auto;
  }
  .faq-question{
    width:98%;
    margin:20px auto;
  }
  }
</style>