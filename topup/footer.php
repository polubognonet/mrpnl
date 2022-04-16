<?php include "accountinformation.php"; ?>

<div class="prefooter">
            <div class="gethelp">
              <a href="https://mrpnl.com/myaccount/howto.php" target="_blank"><button class="button-31" type="button" name="button" target="_blank">Need help?</button></a>
            </div>
            <div class="gethelp">
              <a href="https://mrpnl.com/terms/" target="_blank"><button class="button-31" type="button" name="button" target="_blank">Terms and Rules</button></a>
            </div>
</div>
<div class="divfooter">
  <div class="divfooterr">
    <p class="mrpnl">MR.PNL</p>
  </div>
  <div class="contactdetails">
    <a href="support@mrpnl.com" target="_blank"><p>support@mrpnl.com</p></a>
    <a style="margin-left: 10%;" href="https://t.me/mrpnl" target="_blank"><p>@mrpnl</p></a>
  </div>
  <h3>
    <a href="https://mrpnl.com/privacy-policy/" target="_blank">Privacy Policy</a>
  </h3>
  <form class="" action="logout.inc.php" method="post">
    <button  class = "button-27" type="submit" name="button">Logout</button></a>
  </form>
</div>
<div class="rightsreserved">
  <p>All Rights Reserved © 2021 MR.PNL</p>
</div>
</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script>
$(document).ready(function() {
  preloaderFadeOutTime = 1000;
  function hidePreloader() {
  var preloader = $('.loader-wrapper');
  preloader.fadeOut(preloaderFadeOutTime);
  }
hidePreloader();
});
</script>
