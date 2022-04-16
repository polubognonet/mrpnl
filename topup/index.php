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
      <div class="topupwrap">
        <div class="depositoptions">
          <div class="topupheader">
            <p>WE ACCEPT</p>
          </div>
          <div class="topupbody">
          <div class="topupspacer2">
          </div>
          <div class="coinswrap">
            <div id="coin1" class="coinwrapper">
              <div class="coinimg">
                <img src="img/usdtimg.png" alt="">
              </div>
              <p>USDT</p>
            </div>
            <div id="coin2" class="coinwrapper">
              <div class="coinimg">
                <img src="img/btcimg.png" alt="">
              </div>
              <p>BTC</p>
            </div>
            <div id="coin3" class="coinwrapper">
              <div class="coinimg">
                <img src="img/ethimg.png" alt="">
              </div>
              <p>ETH</p>
            </div>
            <div id="coin4" class="coinwrapper">
              <div class="coinimg">
                <img src="img/ltcimg.png" alt="">
              </div>
              <p>LTC</p>
            </div>
          </div>
          <div class="topupspacer1">
          </div>
          <div class="coinswrapdesk">
              <p>We are not using your personal information. You can be sure that any data entered is absolutely safe. Click here to check our <strong><a href="https://mrpnl.com/en/privacypolicy/">Privacy Policy</a></strong>.</p>
          </div>
          <div class="mrpnllogotopup">
            <p>MR.PNL</p>
          </div>
          </div>
        </div>
          <div class="containertopup">
            <div class="containerheader">
              <p>ENTER DEPOSIT</p>
            </div>
            <div class="containerbody">
              <form class = "topupform" action="confirm.php" method="post">
                  <div class="col-3">
                        <input id="depositInput" class="effect-8" type="text" name="amount" placeholder="MIN. DEPOSIT IS $5" autocomplete="off" onkeypress='validate(event)' maxlength="5" value="5">
                            <span class="focus-border">
                              <i></i>
                            </span>
                    </div>
                <input id="depositButton" type="submit" value="PAY" class='btn'>
              </form>
              <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
              <div class="animationtop">
                <lottie-player src="https://assets3.lottiefiles.com/packages/lf20_jlbcllvd.json"  background="transparent"  speed="1"  style="width: 30%; height: 100%;"  loop  autoplay></lottie-player>
              </div>
            </div>
          </div>
      </div>
    </div>
    <?php include "../footer.php"; ?>
  </div>
</body>
<script type="text/javascript" src="js/phonenumber.js"></script>

<script>
function validate(evt) {
var theEvent = evt || window.event;

// Handle paste
if (theEvent.type === 'paste') {
    key = event.clipboardData.getData('text/plain');
} else {
// Handle key press
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode(key);
}
var regex = /[0-9]|\./;
if( !regex.test(key) ) {
  theEvent.returnValue = false;
  if(theEvent.preventDefault) theEvent.preventDefault();
}
}
</script>

<script type="text/javascript">

var rng = document.getElementById("depositInput");

function inputButton(){

  var button = document.getElementById("depositButton");
  var depositAmount = rng.value;
  var rng17 = parseInt(depositAmount);

  console.log(rng17);

  if (rng17 < 5) {
    button.disabled = true;
    document.querySelector("#depositButton").style.background = "#eabcbc";
    document.querySelector("#depositButton").style.border = "2px solid #eabcbc";
  } else if (rng17 > 5) {
    button.disabled = false;
    document.querySelector("#depositButton").style.background = "#dff2d9";
    document.querySelector("#depositButton").style.border = "2px solid #dff2d9";

  }

};

window.addEventListener("DOMContentLoaded", inputButton);
rng.addEventListener('input', inputButton);

</script>


<script>

$('#coin1').hover(
   function() {
      $('#coin1 p').addClass('pcoinhover')
      $('#coin1').addClass('coindivhover')
      $('#coin1 .coinimg img').addClass('changeimgcolor')
   },
   function() {
     $('#coin1 p').removeClass('pcoinhover')
     $('#coin1').removeClass('coindivhover')
     $('#coin1 .coinimg img').removeClass('changeimgcolor')
   }
)

$('#coin2').hover(
   function() {
      $('#coin2 p').addClass('pcoinhover')
      $('#coin2').addClass('coindivhover')
      $('#coin2 .coinimg img').addClass('changeimgcolor')
   },
   function() {
     $('#coin2 p').removeClass('pcoinhover')
     $('#coin2').removeClass('coindivhover')
     $('#coin2 .coinimg img').removeClass('changeimgcolor')
   }
)

$('#coin3').hover(
   function() {
      $('#coin3 p').addClass('pcoinhover')
      $('#coin3').addClass('coindivhover')
      $('#coin3 .coinimg img').addClass('changeimgcolor')
   },
   function() {
     $('#coin3 p').removeClass('pcoinhover')
     $('#coin3').removeClass('coindivhover')
     $('#coin3 .coinimg img').removeClass('changeimgcolor')
   }
)

$('#coin4').hover(
   function() {
      $('#coin4 p').addClass('pcoinhover')
      $('#coin4').addClass('coindivhover')
      $('#coin4 .coinimg img').addClass('changeimgcolor')
   },
   function() {
     $('#coin4 p').removeClass('pcoinhover')
     $('#coin4').removeClass('coindivhover')
     $('#coin4 .coinimg img').removeClass('changeimgcolor')
   }
)

</script>

</html>
