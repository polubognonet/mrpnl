<?php

session_start();
include '../includes/dbh.inc.php';
include '../includes/dbhstrategy.inc.php';
include '../includes/dbhhistory.inc.php';
include '../includes/dbhapi.inc.php';
include '../includes/userparsing.inc.php';


if (!isset($user['user_login'])) {
  header("Location: https://mrpnl.com/login/");
  exit();

}

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/input.css">
    <link rel="stylesheet" href="../css/icons.css">
    <link rel="stylesheet" href="css/stylestat.css">
    <link rel="stylesheet" href="../css/mobilestyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link
  rel="stylesheet" type="text/css"
  href="//cdn.jsdelivr.net/gh/loadingio/ldbutton@v1.0.1/dist/ldbtn.min.css"
/>
    <link rel="icon" type="image/png" href="../favicon32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="../favicon16.png" sizes="16x16" />
    <script type="text/javascript" src="../js/functions.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
    <script src="https://cdn.statically.io/gh/kswedberg/jquery-smooth-scroll/3948290d/jquery.smooth-scroll.min.js"></script>
  </head>

  <body>
    <div class="loader-wrapper">
      <div class="loader"></div>
    </div>
  <div class="wwrapper">
    <?php include "popupswin.php"; ?>
    <?php
    include "../header.php";
     ?>
    <div class="wrapper">
      <?php include "currencyinfo1.php"; ?>
      <?php include "../helloworld.php"; ?>
      <div class="banners">
        <img src="img/topupbanner.png" alt="">
      </div>
      <div class="hellomobile">
        <p>TOP UP</p>
      </div>
      <div class="profilewrap">
                <div class="basicinformation">
                  <div class="basicinformationHeader">
                    <p>ACCOUNT</p>
                  </div>
                  <div class="infodetails">
                    <form class="" action="includes/detailschange.inc.php" method="post">
                    <div class="helpdiv">
                      <p>Name:</p>
                      <?php echo "<p>" . $user['display_name'] . "</p>" ?>
                    </div>
                    <div class="helpdiv">
                      <p>Username:</p>
                      <?php echo "<p>" . $user['user_nicename'] . "</p>" ?>
                    </div>
                    <div class="helpdiv">
                      <p>Email:</p>
                      <?php echo "<p>" . $user['user_email'] . "</p>" ?>
                    </div>
                    <div class="helpdiv">
                      <p>Verification:</p>
                      <?php
                      if ($user['phoneverified']!="0" || $user['telegramchat']!="0") {
                          echo "<p>VERIFIED</p>";
                      } else {
                        echo "<a href='https://mrpnl.com/myaccount/pverify.php' target='_blank'><button type='button' name='button' target='_blank'>Verify Now</button></a>";
                      }
                      ?>
                    </div>
                    <div class="helpdiv">
                      <p>Phone number:</p>
                      <?php
                      if ($user['phonenumber']!="0") {
                        echo "<p>" . $user['phonenumber'] . "</p>";
                      } else {
                        echo "<a href='https://mrpnl.com/myaccount/pverify.php' target='_blank'>NOT ENTERED</a>";
                      }
                      ?>
                    </div>
                    <div class="helpdiv">
                      <p>Telegram:</p>
                      <?php
                      if ($user['telegramchat']!="0") {
                        echo "<p>" . $user['telegramchat'] . "</p>";
                      } else {
                        echo "<a href='https://mrpnl.com/myaccount/pverify.php' target='_blank'>NOT LINKED</a>";
                      }
                      ?>
                    </div>
                    <div class="helpdiv">
                      <p>Trial:</p>
                      <?php
                      if ($user['trialdays']!="0") {
                        echo "<p>" . $user['trialdays'] . " DAYS</p>";
                      } else {
                        echo "<p>ENDED</p>";
                      }
                      ?>
                    </div>
                    <div class="helpdiv2">
                      <div class="resetWrap">
                        <button type="button" id="passwordReset" name="passwordReset">Reset Password</button></a>
                      </div>
                      <div class="resetWrap">
                        <button type="button" id="emailReset" name="emailReset">Change Email</button></a>
                      </div>
                    </div>
                  </form>
                  </div>
                </div>
                <div class="basicinformation">
                  <div class="basicinformationHeader">
                    <p>NOTIFICATIONS</p>
                  </div>
                  <div class="infodetails">
                  <form class="" action="../includes/changenotification.inc.php" method="post">
                    <div class="helpdiv">
                      <p>Send me daily profit reports via email:</p>
                      <div class="helpdivchoice">
                        <div class="profileValueWrapEd">
                          <div class="block">
                            <input data-index="0" name="dailyprofit" id="1" type="checkbox" name="liveadd" <?php if ($user['user_profitemails'] == "1") {
                              echo "checked";
                            } ?>/>
                            <label for="1"></label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="helpdiv">
                      <p>Notify me if balance should be added:</p>
                      <div class="helpdivchoice">
                        <div class="profileValueWrapEd">
                          <div class="block">
                            <input data-index="0" name="probemails" id="2" type="checkbox" name="liveadd" <?php if ($user['user_probemails'] == "1") {
                              echo "checked";
                            } ?>/>
                            <label for="2"></label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="helpdiv">
                      <p>Send me closing deal reports via Telegram:</p>
                      <div class="helpdivchoice">
                         <div class="profileValueWrapEd">
                           <div class="block">
                             <input data-index="0" name="telegramdeals" id="3" type="checkbox" name="liveadd" <?php if ($user['user_telegramdeals'] == "1") {
                               echo "checked";
                             } ?>/>
                             <label for="3"></label>
                           </div>
                         </div>
                      </div>
                    </div>
                    <div class="helpdiv">
                      <p>Send me daily profit reports via Telegram</p>
                      <div class="helpdivchoice">
                        <div class="profileValueWrapEd">
                          <div class="block">
                            <?php echo "<input type='hidden' name='username' value='".$user['user_nicename']."'>"; ?>
                            <input data-index="0" name="tgdailyp" id="4" type="checkbox" name="liveadd" <?php if ($user['user_tgdailyp'] == "1") {
                              echo "checked";
                            } ?>/>
                            <label for="4"></label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="helpdiv">
                      <p>Send me advertisement emails:</p>
                      <div class="helpdivchoice">
                          <div class="profileValueWrapEd">
                            <div class="block">
                              <input data-index="0" name="adveremails" id="5" type="checkbox" name="liveadd" <?php if ($user['user_adveremails'] == "1") {
                                echo "checked";
                              } ?>/>
                              <label for="5"></label>
                            </div>
                          </div>
                      </div>
                    </div>
                    <div class="helpdiv2" style="justify-content: center;">
                      <button class="notifyButton" type="submit" name="notifyButton">Save Changes</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

    <?php include "../footer.php"; ?>
  </div>
</body>

<script>

$('#passwordReset').click(
   function() {
      $('#blackWrap').removeClass('dissapearWrapper')
      $('#changeInfoWrap').removeClass('dissapearWrapper')
      $('#blackWrap').addClass('appearWrapper')
      $('#changeInfoWrap').addClass('appearWrapper')
   }
)

$('#passwordReset').click(
   function() {
      $('#blackWrap').removeClass('dissapearWrapper')
      $('#changeInfoWrap').removeClass('dissapearWrapper')
      $('#blackWrap').addClass('appearWrapper')
      $('#changeInfoWrap').addClass('appearWrapper')
   }
)

</script>

</html>
