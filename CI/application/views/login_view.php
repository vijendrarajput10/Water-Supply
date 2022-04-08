<?php include("loginheader.php");?>
<main style="margin: 0px; padding: 0px;">
      <div id="content" style="margin: 0px;">
        <div class="innertube" style="margin: 0px; padding: 0px; text-align: -webkit-center;">
              <div class="login-page">
                <div class="form">
                  <div class="error">
                  <?php echo validation_errors(); ?>
                  </div>                  
            <form action="<?php echo base_url() ?>verifylogin" method="post" accept-charset="utf-8" class="login-form">
                    <input type="text" size="20" id="username" name="username" placeholder="username" required/>
                    <input type="password" size="20" id="passowrd" name="password" placeholder="password" required/>
                    <input id="button" type="submit" value="Login"/>                    
            </form>
                </div>
              </div>
          </div>
      </div>
  </main>
<?php include("loginfooter.php");?>