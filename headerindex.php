
<?php

session_start();
include_once 'includes/dbh.inc.php';
include_once 'includes/userparsing.inc.php';

 ?>


<header id="header">
<div class="mrpnldiv">
<a href="https://mrpnl.com/myaccount/index.php"> <p align="center" class="mrpnlp">MR.PNL</p></a>
<img src="img/hidelogo2.png" alt="">
</div>
<div class="mrpnldivmobile">
  <a href="https://mrpnl.com/myaccount/index.php"> <p align="center" class="mrpnlp">MR.PNL</p></a>
</div>

<div class="changelanguagemob">
  <a href="#" style="align-items:center;">
    <img src="img/changelanguagemob.png" alt="">
  </a>
</div>

<input type="checkbox" id="check">
<label for="check" class="checkbtn">
  <img class="wowimage" src="img/11.png" alt="">
</label>
<ul class="topDeskNavigation">
  <?php
  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  if ($actual_link=="http://mrpnl.com/myaccount/") {
    include "headers/homeheader.php";
  } elseif ($actual_link=="http://mrpnl.com/myaccount/profile/") {
    include "headers/profileheader.php";
  } elseif ($actual_link=="http://mrpnl.com/myaccount/topup/") {
    include "headers/topupheader.php";
  } elseif ($actual_link=="http://mrpnl.com/myaccount/howto/") {
    include "headers/howtoheader.php";
  } elseif ($actual_link=="http://mrpnl.com/myaccount/statistic/") {
    include "headers/statisticheader.php";
  } elseif ($actual_link=="http://mrpnl.com/myaccount/api/") {
    include "headers/apiheader.php";
  } elseif ($actual_link=="http://mrpnl.com/myaccount/dca/" && $actual_link=="http://mrpnl.com/myaccount/candle") {
    include "headers/configurationheader.php";
  } else {
    include "headers/defaultheader.php";
  }
   ?>
</ul>



  <div class="changelanguage">
    <div class="clientinfos">
      <a href="https://t.me/mrpnl_bot" target="_blank" class="clientinfoswrapmain" id="wrap1">
        <div class="clientinfoswrap">
          <img src="img/telegramimg.png" id="imgone" alt="">  <?php if ($user['telegramchat'] == "0") {
            echo "<p id='pone' >NOT LINKED</p>";
          } else {
            echo "<p id='pone' >LINKED</p>";
          }
          ?>
        </div>
      </a>
      <a  href="https://mrpnl.com/myaccount/topup.php" target="_blank" class="clientinfoswrapmain" id="wrap2">
        <div class="clientinfoswrap">
          <img src="img/balanceimg.png" id="imgtwo" alt=""> <?php echo "<p id='ptwo' >$".$user['balance']."</p>"; ?>
        </div>
      </a>
    </div>
    <div class="faqnavdiv">
      <a href="http://mrpnl.com/myaccount/howto.php"> <img src="img/questionmark.png" alt=""> </a>
    </div>
    <div class="socialmedia">
      <img id="twitterimg" src="img/twitter.png" alt="">
      <img id="instimg" src="img/inst.png" alt="">
      <img id="linkedinimg" src="img/linkedin.png" alt="">
    </div>
    <div class="changelanguagee">
      <a href="#" style="align-items:center;">
        <img src="img/changelanguagemob.png" alt="">
      </a>
    </div>
  </div>

</header>

<script>

$('#wrap1').hover(
   function() {
      $('#imgone').addClass('activeheaderhover')
      $('#pone').addClass('activeheaderhover')
   },
   function() {
     $('#imgone').removeClass('activeheaderhover')
     $('#pone').removeClass('activeheaderhover')
   }
)

$('#wrap2').hover(
   function() {
      $('#imgtwo').addClass('activeheaderhover')
      $('#ptwo').addClass('activeheaderhover')
   },
   function() {
     $('#imgtwo').removeClass('activeheaderhover')
     $('#ptwo').removeClass('activeheaderhover')
   }
)

$('#li1').hover(
   function() {
      $('#li1 a p').addClass('phoverclass')
      $('#img1').addClass('activeheaderhover')
      $('#p1').addClass('activeheaderhover')
   },
   function() {
     $('#li1 a p').removeClass('phoverclass')
     $('#img1').removeClass('activeheaderhover')
     $('#p1').removeClass('activeheaderhover')
   }
)

$('#li2').hover(
   function() {
      $('#li2 a p').addClass('phoverclass')
   },
   function() {
     $('#li2 a p').removeClass('phoverclass')
   }
)
$('#li3').hover(
   function() {
      $('#li3 a p').addClass('phoverclass')
   },
   function() {
     $('#li3 a p').removeClass('phoverclass')
   }
)

$('#li4').hover(
   function() {
      $('#li4 a p').addClass('phoverclass')
   },
   function() {
     $('#li4 a p').removeClass('phoverclass')
   }
)
$('#li5').hover(
   function() {
      $('#li5 a p').addClass('phoverclass')
   },
   function() {
     $('#li5 a p').removeClass('phoverclass')
   }
)
$('#li6').hover(
   function() {
      $('#li6 a p').addClass('phoverclass')
   },
   function() {
     $('#li6 a p').removeClass('phoverclass')
   }
)
$('#li7').hover(
   function() {
      $('#li7 a p').addClass('phoverclass')
   },
   function() {
     $('#li7 a p').removeClass('phoverclass')
   }
)

$('#li1, #li2, #li3, #li4, #li5, #li6, #li7').click(
  function() {
  preloaderFadeInTime = 1000;
  var preloader = $('.loader-wrapper');
  preloader.fadeIn(preloaderFadeInTime);
  });

</script>
