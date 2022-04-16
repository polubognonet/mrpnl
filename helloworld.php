<?php

$username = $user['user_login'];
$apiexists = 0;

$newbusdavailable = 0;
$newusdtavailable = 0;
$newbnbavailable = 0;

$sql_u = "SELECT * FROM wptj_users WHERE user_nicename='{$username}'";
  $result = $conn->query($sql_u);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $apikey = $row['api_key'];
      $apisec = $row['api_secret'];
      if ($apikey !== "0" && $apisec !== "0") {
        $apiexists = 1;
        require "checkorders/vendor/autoload.php";
        $api = new Binance\API("{$apikey}", "{$apisec}");

        try {
          $ticker = $api->prices(); // Make sure you have an updated ticker object for this to work
        } catch (\Exception $e) {
          $apiexists = 0;
          break;
        }
        $balances = $api->balances($ticker);
        $busdavailable = $balances['BUSD']['available'].PHP_EOL;
        $usdtavailable = $balances['USDT']['available'].PHP_EOL;
        $bnbavailable = $balances['BNB']['available'].PHP_EOL;

        $newbusdavailable = number_format($busdavailable, 2, '.', '');
        $newusdtavailable = number_format($usdtavailable, 2, '.', '');
        $newbnbavailable = number_format($bnbavailable, 5, '.', '');
      }
    }
  }


 ?>

<div class="helloworld">
  <?php include "currencyinfo.php"; ?>
  <div class="helloworld2">
  <div class="hellome">
    <img class="additarrow" id="additarrow" src="../img/additinfoarrow.png" alt="">
    <?php

    echo "<p>" . $user['user_login'] . "</p>";

    ?>
  </div>

  <div class="additinfo">
    <div class="additinfowrap">
      <div class="additinfolil">
        <div class="additinfolilwr">
          <img src="../img/binanceusd.png" alt="">
          <p>BUSD</p>
        </div>
        <div class="additinfolilwr2">
          <?php echo "<p>" . $newbusdavailable . "</p>"; ?>
        </div>

      </div>
      <div class="additinfolil">
        <div class="additinfolilwr">
          <img src="../img/tether.png" alt="" style="margin-right: 0%;">
          <p>USDT</p>
        </div>
        <div class="additinfolilwr2">
          <?php echo "<p>" . $newusdtavailable . "</p>"; ?>

        </div>
      </div>
      <div class="additinfolil" style="border-bottom: none;">
        <div class="additinfolilwr">
          <img src="../img/bnb.png" alt="">
          <p>BNB</p>
        </div>
        <div class="additinfolilwr2">
          <?php echo "<p>" . $newbnbavailable . "</p>"; ?>

        </div>

      </div>
    </div>
  </div>

  <div class="divstatuses">
    <div class="divstatuses1">
    <div class="divtrialdays">
      <p>Verification:</p>
      <?php
      if ($user['phoneverified']=="0") {
        echo "<p><a href = 'https://mrpnl.com/myaccount/pverify.php'>NOT VERIFIED</a></p>";
      } elseif ($user['phoneverified']=="1") {
        echo "<p>VERIFIED</p>";
      }
      ?>
    </div>
    <div class="divtrialdays">
      <p>Trial:</p>
      <?php
      if ($user['trialstarted']=="0") {
        echo "<p>NOT STARTED</p>";
      } elseif ($user['trialstarted']=="1" && $user['trialdays']!="0") {
        echo "<p>" . $user['trialdays'] . " DAYS.</p>";
      } elseif ($user['trialdays']=="0") {
        echo "<p>ENDED</p>";
      }
       ?>
    </div>
    </div>
    <div class="divstatuses1">
    <div class="divtrialdays">
      <p>Account:</p>
      <?php if ($user['accountstopped']=="1") {
        echo "<a href = 'https://mrpnl.com/myaccount/topup.php' target='_blank'><p>STOPPED!</a></p>";
      } elseif ($user['probstarted']=="1") {
          echo "<a href = 'https://mrpnl.com/myaccount/topup.php' target='_blank'><p>" . $user['daystostop'] . " DAYS LEFT!</a></p>";
      } else {
        echo "<p>ACTIVE</p>";
      } ?>
    </div>
    <div class="divtrialdays">
      <p>System Status:</p>
      <?php
        if ($user['systemstatus']=="0") {
        echo "<p>OK</p>";
      } elseif ($user['systemstatus']=="1") {
        echo "<p>BAD</p>";
      }
       ?>
    </div>
    </div>
  </div>
  </div>
</div>
<div class="hideheader" id="hideheader1">
  <div class="hideheaderarrow">
    <img class = "hideheaderarrowimg" src="../img/hideheaderarrow.png" alt="">
  </div>
</div>

<script>

var images = [];
function preload() {
    for (var i = 0; i < arguments.length; i++) {
        images[i] = new Image();
        images[i].src = preload.arguments[i];
    }
}

preload(
    "https://mrpnl.com/myaccount/img/statisticimg.png"
)


  var cookieValue = parseInt(localStorage.getItem('x'));
  console.log(cookieValue);


  if (cookieValue==0) {
    x = 0;
    $('.wrapper').removeClass('hideHeaderClass');
    $('.helloworld').removeClass('hideHeaderClass');
    $('#header').removeClass('hideHeaderClass1');
    $('.liwrap').removeClass('liwrapClass');
    $('.liwrap p').removeClass('liwrapClassP');
    $('.mrpnldiv a p').removeClass('liwrapClassP');
    $('.clientinfoswrap p').removeClass('liwrapClassP');
    $('.clientinfoswrap').removeClass('liwrapClass');
    $('.hideheader').removeClass('hideHeaderNewClass');
    $('.hideheaderarrowimg').removeClass('hideHeaderNewImg');
    $('.mrpnldiv img').removeClass('liwrapClassP');
    $('#instimg').removeClass('liwrapClassP');
    $('#linkedinimg').removeClass('liwrapClassP');
  } else {
    x = 1;
    $('.wrapper').addClass('hideHeaderClass');
    $('.helloworld').addClass('hideHeaderClass');
    $('.prefooter').addClass('hideHeaderClass2');
    $('.divfooter').addClass('hideHeaderClass2');
    $('.rightsreserved').addClass('hideHeaderClass');
    $('#header').addClass('hideHeaderClass1');
    $('.liwrap').addClass('liwrapClass');
    $('.liwrap p').addClass('liwrapClassP');
    $('.mrpnldiv a p').addClass('liwrapClassP');
    $('.clientinfoswrap p').addClass('liwrapClassP');
    $('.clientinfoswrap').addClass('liwrapClass');
    $('.hideheader').addClass('hideHeaderNewClass');
    $('.hideheaderarrowimg').addClass('hideHeaderNewImg');
    $('.mrpnldiv img').addClass('liwrapClassP');
    $('#instimg').addClass('liwrapClassP');
    $('#linkedinimg').addClass('liwrapClassP');

  }

  $( document ).ready(function() {
    if (cookieValue==0) {
    x = 0;
    $('.prefooter').removeClass('hideHeaderClass2');
    $('.divfooter').removeClass('hideHeaderClass2');
    $('.rightsreserved').removeClass('hideHeaderClass');
  } else {
    x = 1;
    $('.prefooter').addClass('hideHeaderClass2');
    $('.divfooter').addClass('hideHeaderClass2');
    $('.rightsreserved').addClass('hideHeaderClass');
  }
  });

  $('#hideheader1').click(
     function() {
       if (x==0) {
         $('.wrapper').addClass('hideHeaderClass');
         $('.helloworld').addClass('hideHeaderClass');
         $('.prefooter').addClass('hideHeaderClass2');
         $('.divfooter').addClass('hideHeaderClass2');
         $('.rightsreserved').addClass('hideHeaderClass');
         $('#header').addClass('hideHeaderClass1');
         $('.liwrap').addClass('liwrapClass');
         $('.liwrap p').addClass('liwrapClassP');
         $('.mrpnldiv a p').addClass('liwrapClassP');
         $('.clientinfoswrap p').addClass('liwrapClassP');
         $('.clientinfoswrap').addClass('liwrapClass');
         $('.hideheader').addClass('hideHeaderNewClass');
         $('.hideheaderarrowimg').addClass('hideHeaderNewImg');
         $('.mrpnldiv img').addClass('liwrapClassP');
         $('#instimg').addClass('liwrapClassP');
         $('#linkedinimg').addClass('liwrapClassP');
         x = 1;
       } else {
         $('.wrapper').removeClass('hideHeaderClass');
         $('.helloworld').removeClass('hideHeaderClass');
         $('.prefooter').removeClass('hideHeaderClass2');
         $('.divfooter').removeClass('hideHeaderClass2');
         $('.rightsreserved').removeClass('hideHeaderClass');
         $('#header').removeClass('hideHeaderClass1');
         $('.liwrap').removeClass('liwrapClass');
         $('.liwrap p').removeClass('liwrapClassP');
         $('.mrpnldiv a p').removeClass('liwrapClassP');
         $('.clientinfoswrap p').removeClass('liwrapClassP');
         $('.clientinfoswrap').removeClass('liwrapClass');
         $('.hideheader').removeClass('hideHeaderNewClass');
         $('.hideheaderarrowimg').removeClass('hideHeaderNewImg');
         $('.mrpnldiv img').removeClass('liwrapClassP');
         $('#instimg').removeClass('liwrapClassP');
         $('#linkedinimg').removeClass('liwrapClassP');
         x = 0;
       }
       localStorage.setItem('x', x);
     });

     $('#hideheader1').hover(
        function() {
           $('.hideheaderarrowimg').addClass('hideHeaderImgHover')
        },
        function() {
          $('.hideheaderarrowimg').removeClass('hideHeaderImgHover')
        }
     )

     $('.hellome').hover(
        function() {
          $('#additarrow').addClass('additarrowup')
          $('.additinfo').addClass('additinfoshow')
        },
        function() {
          $('#additarrow').removeClass('additarrowup')
          $('.additinfo').removeClass('additinfoshow')
        }
     )


</script>
