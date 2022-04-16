<?php

session_start();
include 'includes/dbh.inc.php';
include 'includes/userparsing.inc.php';

if (!isset ($user['user_login'])) {
  header("Location: https://mrpnl.com/en/login-2/");
  exit();

}
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/input.css">
    <link rel="stylesheet" href="css/icons.css">
    <link rel="stylesheet" href="css/mobilestyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="favicon32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="favicon16.png" sizes="16x16" />
    <script type="text/javascript" src="js/functions.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
   <script
 src="https://code.jquery.com/jquery-3.6.0.js"
 integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
 crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
  </head>
    <body>
      <div class="loader-wrapper">
        <div class="loader"></div>
      </div>
    <div class="wwrapper">
      <?php
      include "header.php";
       ?>
      <div class="wrapper" style = "height: 1450px">
        <?php include "currencyinfo1.php"; ?>
        <?php
        if ($_GET['email']=="used") {
          echo "<script type='text/javascript'>swal('Email in use!', 'It appears that this email is already used, unfortunately. Try another one.', 'error');</script>";
        } elseif ($_GET['email']=="bad") {
          echo "<script type='text/javascript'>swal('Wrong email address!', 'It appears that you have tried to use the wrong email address. Try something like qwerty@mail.com. Thank you for your understanding!', 'error');</script>";
        } elseif (isset($_GET['changes'])) {
          echo "<script type='text/javascript'>swal('Success!', 'Changes has been made. Thank you!', 'success');</script>";
        }
         ?>
        <?php include "helloworld.php"; ?>
        <div class="hellomobile">
          <p>PROFILE</p>
        </div>
        <?php include "accountinformation.php"; ?>
        <div class="phverify" style="height: 55%;">
          <div class="phonenumberheader">
            <a href="https://mrpnl.com/myaccount/"><img src="img/back.png" alt=""></a>
            <div class="mainheader">
              <h3>Profile</h3>
            </div>
          </div>
          <div class="profilecontainer">
            <div class="mainpanel">
              <div class="basicinformation">
                <div class="infoimage">
                  <img src="img/profileinfo.png" alt="">
                </div>
                <div class="infodetails">
                  <form class="" action="includes/detailschange.inc.php" method="post">
                  <div class="helpdiv">
                    <p>Name:</p>
                    <?php echo "<p>" . $user['display_name'] . "</p>" ?>
                  </div>
                  <div class="helpdiv">
                    <p>Change name:</p>
                    <div class="changeemaildiv" style="height: 100%; width: 30%;">
                        <div class="col-3" style="height: 100%; width: 100%;">
                            <input class="effect-1" type="text" name="newname" placeholder="new name" autocomplete="off" style="height: 100%; text-align: right;">
                              <span class="focus-border"></span>
                          </div>
                    </div>
                  </div>
                  <div class="helpdiv">
                    <p>Username:</p>
                    <?php echo "<p>" . $user['user_nicename'] . "</p>" ?>
                  </div>
                  <div class="helpdiv1">
                    <p>Phone number:</p>
                    <?php
                    if ($user['phoneverified']!="0") {
                      echo "<p>" . $user['phonenumber'] . "</p>";
                    } else {
                      echo "<a href='https://mrpnl.com/myaccount/pverify.php' target='_blank'><button type='button' name='button' target='_blank'>Verify Now</button></a>";
                    }
                    ?>
                  </div>
                  <div class="helpdiv">
                    <p>Email:</p>
                    <?php echo "<p>" . $user['user_email'] . "</p>" ?>
                  </div>
                  <div class="helpdiv">
                    <p>Change email:</p>
                    <div class="changeemaildiv" style="height: 100%; width: 30%;">
                        <div class="col-3" style="height: 100%; width: 100%;">
                            <input class="effect-1" type="text" name="newemail" placeholder="new email" autocomplete="off" style="height: 100%; text-align: right;">
                              <span class="focus-border"></span>
                          </div>
                    </div>
                  </div>
                  <div class="helpdiv1">
                    <p>Change password:</p>
                    <a href="https://mrpnl.com/en/resetpassword/" target="_blank"><button type="button" name="button" target="_blank">Reset Password</button></a>
                  </div>
                  <div class="helpdiv" style="border-bottom: none;">
                    <button type="submit" name="submitbutton" style="margin-top: 5%;">Save Changes</button></a>
                  </div>
                </form>
                </div>
              </div>
              <div class="changenotifications">
                <div class="notificationimage">
                  <img src="img/notification.png" alt="">
                </div>
                <div class="notificationdetails">
                <form class="" action="includes/changenotification.inc.php" method="post">
                  <div class="helpdiv">
                    <p>Send me daily profit reports:</p>
                    <div class="helpdivchoice">
                      <?php
                      if ($user['user_profitemails']=="1") {
                        echo "<select class='' name='dailyprofit'>
                          <option value='yes' selected>Yes</option>
                          <option value='no'>No</option>
                        </select>";
                      } elseif ($user['user_profitemails']=="0") {
                        echo "<select class='' name='dailyprofit'>
                          <option value='yes' >Yes</option>
                          <option value='no' selected>No</option>
                        </select>";
                      }
                       ?>
                    </div>
                  </div>
                  <div class="helpdiv">
                    <p>Notify me if balance should be added:</p>
                    <div class="helpdivchoice">
                      <?php
                      if ($user['user_probemails']=="1") {
                        echo "<select class='' name='probemails'>
                          <option value='yes' selected>Yes</option>
                          <option value='no'>No</option>
                        </select>";
                      } elseif ($user['user_probemails']=="0") {
                        echo "<select class='' name='probemails'>
                          <option value='yes' >Yes</option>
                          <option value='no' selected>No</option>
                        </select>";
                      }
                       ?>
                    </div>
                  </div>
                  <div class="helpdiv">
                    <p>Send me advertisement emails:</p>
                    <div class="helpdivchoice">
                      <?php
                      if ($user['user_adveremails']=="1") {
                        echo "<select class='' name='adveremails'>
                          <option value='yes' selected>Yes</option>
                          <option value='no'>No</option>
                        </select>";
                      } elseif ($user['user_adveremails']=="0") {
                        echo "<select class='' name='adveremails'>
                          <option value='yes' >Yes</option>
                          <option value='no' selected>No</option>
                        </select>";
                      }
                       ?>
                    </div>
                  </div>
                  <div class="helpdiv" style="border-bottom: none;">
                    <button type="submit" name="submitbutton" style="margin-top: 5%;">Save Changes</button></a>
                  </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include "footer.php"; ?>
    </div>
  </body>
</html>
