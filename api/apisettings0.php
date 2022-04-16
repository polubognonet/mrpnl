<div class="apisettings" id="apiid">
  <div class="apiinformation1">
    <div class="apiheader">
      <p align = "center">API SETTINGS</p>
    </div>
    <div class="apibody">
    <form class="apiform" action="../includes/updateapi.inc.php" method="post">
    <div class="apikeys">
      <div class="apidetails">
        <div class="col-3">
              <input class="effect-8" type="text" name="apinicename" placeholder="Give your API a name" autocomplete="off">
                  <span class="focus-border">
                    <i></i>
                  </span>
        </div>
        <div class="col-3">
              <input class="effect-8" type="text" name="apiname" placeholder="API Key" autocomplete="off">
                  <span class="focus-border">
                    <i></i>
                  </span>
          </div>
          <div class="col-3">
                <input class="effect-8" type="text" name="apisecret" placeholder="Secret Key" autocomplete="off">
                    <span class="focus-border">
                      <i></i>
                    </span>
                    <?php
                    $usernamee = $user['user_nicename'];
                     echo "<input type='hidden' name='username' value='$usernamee'>"; ?>
            </div>
          </div>
      <div class="bottompanel">
        <div class="whatisapi1">
          <p class="whatisapi"><a href="https://mrpnl.com/myaccount/faq/whatisapi.php">What is API?*</a></p>
        </div>
        <div class="submitbutton">
        <button class = 'button-22' style="width: 60%;"type='submit' name='apibutton'>Add API</button>
        </div>
      </div>

      <!--
      <div class="apistatus">
        <p align = "center">*Please make sure to create "Write only" API key. You do not need to allow money withdrawal by using your API key. In this way, your funds will be safe.</p>
      </div>
      -->
    </div>
    </form>
    </div>
  </div>
  <div class="apijsonlottie">
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
  <lottie-player src="https://assets5.lottiefiles.com/packages/lf20_u5e1lplj.json"  background="transparent"  speed="1"  style="width: 100%; height: 100%;"  loop  autoplay></lottie-player>
  </div>
</div>
