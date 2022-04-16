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
  </head>

  <body>
    <div class="loader-wrapper">
      <div class="loader"></div>
    </div>

    <?php if ($_GET['api']=="success") {
          echo "<script type='text/javascript'>swal('Great!', 'API seetings has been changed.', 'success');</script>";
        } elseif ($_GET['api']=="bad") {
          echo "<script type='text/javascript'>swal('Error!', 'It appears that your API details are not correct. Feel free to check our guide on the How to page if you have any questions.', 'error');</script>";
        }
    ?>

    <div class="wwrapper">
      <?php include "needhelp.php"; ?>
    <?php
    include "../header.php";
     ?>
    <div class="wrapper">

    <?php include "currencyinfo1.php"; ?>

      <?php include "../helloworld.php"; ?>
      <div class="hellomobile">
        <p>HOME</p>
      </div>
        <div class="banners">
          <img src="img/banner11.png" alt="">
        </div>
        <div class="apipanel">

          <?php include "apisettings0.php";  ?>
          <?php include "apidetails.php";  ?>


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
