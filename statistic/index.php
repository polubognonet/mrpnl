<?php

session_start();
include '../includes/dbh.inc.php';
include '../includes/dbhstrategy.inc.php';
include '../includes/dbhhistory.inc.php';
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
    <link rel="stylesheet" href="css/stylestat.css">
    <link rel="stylesheet" href="../css/input.css">
    <link rel="stylesheet" href="../css/icons.css">
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
    <script src="../js/cookie.js"></script>
  </head>

    <body>

      <?php include "popup.php"; ?>

      <div class="loader-wrapper">
        <div class="loader"></div>
      </div>

      <div class="wwrapper">
        <?php include "needhelp.php"; ?>
      <?php
      include "../header.php";
       ?>
      <div class="wrapper">

      <?php include "../currencyinfo1.php"; ?>

        <?php include "../helloworld.php";
        $username = $user['user_login'];?>

        <div class="hellomobile">
          <p>HOME</p>
        </div>
          <div class="banners">
            <img src="../img/banner11.png" alt="">
          </div>
          <div class="accountpanel2">
             <div class="bottomStat">
               <div class="bottomStatLeft">
                 <div class="historyStatWrap">
                   <div class="historyStatWrapHeader">
                     <div class="historyStatWrapHeaderValue">
                       <p>DEAL ID</p>
                     </div>
                     <div class="historyStatWrapHeaderValue">
                       <p>COIN</p>
                     </div>
                     <div class="historyStatWrapHeaderValue">
                       <p>ORDERS</p>
                     </div>
                     <div class="historyStatWrapHeaderValue">
                       <p>EX. PRICE</p>
                     </div>
                     <div class="historyStatWrapHeaderValue">
                       <p>DATE</p>
                     </div>
                     <div class="historyStatWrapHeaderValue">
                       <p>PROFIT</p>
                     </div>
                   </div>
                   <div class="historyStatWrapBody">
                     <?php   $sql_ds = "SELECT * FROM `$username` ORDER BY id DESC LIMIT 100";
                         $resultds = $connhistory->query($sql_ds);
                         if ($resultds->num_rows > 0) {
                           foreach ($resultds as $resultdskey) {
                             $execcprice = $resultdskey['execprice'];
                             $finalexeccprice = round($execcprice, 2);
                             ?>
                             <div class="historyStatOff">
                               <div class="historyStatOffValue">
                                 <?php echo "<p>".$resultdskey['dealid']."</p>"; ?>
                               </div>
                               <div class="historyStatOffValue">
                                 <?php echo "<p>".$resultdskey['coin']."</p>"; ?>
                               </div>
                               <div class="historyStatOffValue">
                                 <?php echo "<p>".$resultdskey['orders']."</p>"; ?>
                               </div>
                               <div class="historyStatOffValue">
                                 <?php echo "<p>".$finalexeccprice."</p>"; ?>
                               </div>
                               <div class="historyStatOffValue">
                                 <?php echo "<p>".$resultdskey['datecurr']."</p>"; ?>
                               </div>
                               <div class="historyStatOffValue">
                                 <?php echo "<p>$".$resultdskey['profit']."</p>"; ?>
                               </div>
                             </div>
                             <?php
                           }
                        }?>
                   </div>
                 </div>
               </div>
               <div class="bottomStatRight">
                 <div class="bottomStatRightWrap">
                   <div class="profitStat">
                     <div class="profitStatHeader">
                       <p>TODAY PROFIT</p>
                     </div>
                     <div class="profitStatBody">
                       <?php
                       $finalprice = 0;
                       $sql_u = "SELECT * FROM `$username` WHERE `datecurr` >= DATE_SUB(NOW(), INTERVAL 1 DAY)";
                         $result = $connhistory->query($sql_u);
                         if ($result->num_rows > 0) {
                           while($row = $result->fetch_assoc()) {
                             $profit = $row['profit'];
                             $finalprice = $finalprice + $profit;
                           }
                       }
                       echo "<p>$". $finalprice . "</p>";
                        ?>
                     </div>
                   </div>
                   <div class="profitStat">
                     <div class="profitStatHeader">
                       <p>WEEKLY PROFIT</p>
                     </div>
                     <div class="profitStatBody">
                       <?php
                       $finalprice = 0;
                       $sql_u = "SELECT * FROM `$username` WHERE `datecurr` >= DATE_SUB(NOW(), INTERVAL 7 DAY)";
                         $result = $connhistory->query($sql_u);
                         if ($result->num_rows > 0) {
                           while($row = $result->fetch_assoc()) {
                             $profit = $row['profit'];
                             $finalprice = $finalprice + $profit;
                           }
                       }
                       echo "<p>$". $finalprice . "</p>";
                        ?>
                     </div>
                   </div>
                   <div class="profitStat">
                     <div class="profitStatHeader">
                       <p>MONTHLY PROFIT</p>
                     </div>
                     <div class="profitStatBody">
                       <?php
                       $finalprice = 0;
                       $sql_u = "SELECT * FROM `$username` WHERE `datecurr` >= DATE_SUB(NOW(), INTERVAL 30 DAY)";
                         $result = $connhistory->query($sql_u);
                         if ($result->num_rows > 0) {
                           while($row = $result->fetch_assoc()) {
                             $profit = $row['profit'];
                             $finalprice = $finalprice + $profit;
                           }
                       }
                       echo "<p>$". $finalprice . "</p>";
                        ?>
                     </div>
                 </div>
                 </div>
               </div>
             </div>
             <?php
               $sql_ud = "SELECT * FROM wptj_users WHERE user_nicename = '{$username}'";
                 $resultd = $conn->query($sql_ud);
                 if ($resultd->num_rows > 0) {
                   while($row = $resultd->fetch_assoc()) {
                     $coinsnum = $row['coinsnum'];
                     $activebot = $row['activebot'];
                   }
                 }
                 $sql_da = "SELECT * FROM `$username` WHERE working = '1'";
                   $resultda = $connstr->query($sql_da);
                   if ($resultda->num_rows > 0) {
                     while($rowas = $resultda->fetch_assoc()) {
                       $ordersnum = $rowas['ordersamount'];
                     }
                   }
                 for ($i=1; $i <= $coinsnum; $i++) {
                   if ($activebot == "2") {
                   echo "<div class = 'coinStatWrap'>";
                   $tableName = "orders" . $i;
                   $coinnumber = "COIN " . $i;
                   $sql = "SELECT * FROM `$tableName` WHERE username = '{$username}'";
                     $resultdd = $conn->query($sql);
                     if ($resultdd->num_rows > 0) {
                       while($rowa = $resultdd->fetch_assoc()) {
                         $coin = $rowa['coin'];
                         $coinname = substr($coin, 0, -4);
                         $coinnamelength = strlen($coinname);
                         $currname = substr($coin, $coinnamelength);
                         $newFinalCoin = $coinname . "-" . $currname;
                         ${"startprice" . $i} = $rowa['startprice'];
                         ${"closeprice" . $i} = $rowa['closeprice'];
                         ${"onumber" . $i} = $rowa['onumber'];
                         $filledOrders = ${"onumber" . $i} . "/" . $ordersnum;
                         for ($d=1; $d <= $ordersnum; $d++) {
                           $orderName = "order" . $d;
                           $fullOrder = $rowa[$orderName];
                           $result  = unserialize($fullOrder);
                           ${"price" . $i . $d}  = $result['price'];
                         }
                       }
                     }
                   ?>
                   <div class="coinWrapNumber">
                     <?php echo "<p class = 'coinWrapNumberP'>".$coinnumber."</p>"; ?>
                   </div>
                   <div class="coinStat">
                     <div class="coinStatName">
                       <?php echo "<p class = 'coinWrapStatP'>".$newFinalCoin."</p>" ; ?>
                     </div>
                     <div class="coinStatValue">
                       <?php echo "<p class = 'coinWrapStatP'> ORDERS: ".$filledOrders."</p>"; ?>
                     </div>
                     <div class="coinStatRange">

                     </div>
                   </div>
                   <?php
                   echo "</div>";
                   }
                 }
              ?>
          </div>
      </div>
      </div>
      <?php include "../footer.php"; ?>

      <script>
      $('.choosediv').on('click', function(e) {
var el = $( e.target.getAttribute('href') );
var elOffset = el.offset().top;
var elHeight = el.height();
var windowHeight = $(window).height();
var offset;

if (elHeight < windowHeight) {
offset = elOffset - ((windowHeight / 2) - (elHeight / 2));
}
else {
offset = elOffset;
}
var speed = 400;
$('html, body').animate({scrollTop:offset}, speed);
});

$('#strategyButtonId, #startBotButton').click(
  function() {
  preloaderFadeInTime = 1000;
  var preloader = $('.loader-wrapper');
  preloader.fadeIn(preloaderFadeInTime);
  });

    </script>
<script type="text/javascript">
    const list = document.querySelectorAll('.choosediv');
    function activeLink() {
      list.forEach((item) =>
      item.classList.remove('active'));
      this.classList.add('active');
    }
    list.forEach((item) =>
    item.addEventListener('click',activeLink));

    const list = document.querySelectorAll('.needhelp');
    function activeLink() {
      list.forEach((item) =>
      item.classList.remove('mystyleneedhelp'));
      this.classList.add('mystyleneedhelp');
    }
    list.forEach((item) =>
    item.addEventListener('click',activeLink));

</script>

    </body>
</html>
