<?php

include "../includes/dbh.inc.php";
$userd = $user['user_login'];

$sql_u = "SELECT * FROM wptj_users WHERE user_nicename ='{$userd}'";
  $result = $conn->query($sql_u);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $newbusdavailable = $row['botdeposit'];
      $newusdtavailable = $row['api_key'];
      $currentdepo = $row['api_secret'];
      if ($currentdepo == "0") {
        $currentdepo = 100;
      }
    }
  }

 ?>


<div class="setDepositWrap" id="setdepositid">
  <div class="setDeposit">
    <div class="setDepositHeader">
      <p align = "center">SET DEPOSIT</p>
    </div>
    <form class="setDepositForm" action="../includes/changedeposit.inc.php" method="post">
      <div class="setDepositMainWrap">
        <div class="strategySelectCoin">
          <div class="list-choice">
  <div class="list-choice-title">Currency</div>
  <div class="list-choice-objects">
    <label>
      <input id="busdchecker" type="radio" name="strategyCurrency" value="busd"/>                         <span>BUSD</span>
    </label>
    <label>
      <input id="usdtchecker" type="radio" name="strategyCurrency" value="usdt"/>                         <span>USDT</span>
    </label>
  </div>
</div>
        </div>
        <div class="strategyEnterAmount">
          <div class="col-3">
            <?php echo "<input id='strategyDepositId' class='effect-1' type='text' name='strategyDeposit' value = '".$currentdepo."' placeholder='$' autocomplete='off' onkeypress='validate(event)' maxlength='5'>"; ?>
                <span class="focus-border"></span>
            </div>
        </div>
        <?php echo "<input type='hidden' value='".$userd."' name='username'>"; ?>
      </div>
      <div class="bottomWrap">
        <div class="availableBalances">
          <div class="minBalanceWrap">
            <p>BUSD:</p>
            <?php echo "<input type='hidden' id='inpbusd' value='".$newbusdavailable."'>"; ?>
            <?php echo "<p>" . $newbusdavailable . "</p>"; ?>
          </div>
          <div class="minBalanceWrap">
            <p>USDT:</p>
            <?php echo "<input type='hidden' id='inpusdt' value='".$newusdtavailable."'>"; ?>
          <?php echo "<p>" . $newusdtavailable . "</p>"; ?>
          </div>
          <div class="minBalanceWrap">
            <p>BNB:</p>
            <?php echo "<input type='hidden' id='inpbnb' value='".$newbnbavailable."'>"; ?>
          <?php echo "<p>" . $newbnbavailable . "</p>"; ?>
          </div>

        </div>
        <div class="setButton">
          <button id = "setDepositButtonID" class="setDepositButton" type="submit" name="setDepositButton">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script type="text/javascript">

var enteramount = document.getElementById("strategyDepositId");

var button12 = document.getElementById("setDepositButtonID");
var busdava = document.getElementById("inpbusd");
var usdtava = document.getElementById("inpusdt");
var bnbava = document.getElementById("inpbnb");


function depositSet(){

    var busdchecker = document.getElementById("busdchecker");
    var usdtchecker = document.getElementById("usdtchecker");

    var enteramountfin = parseFloat(enteramount.value);
    var busdavafin = parseFloat(busdava.value);
    var usdtavafin = parseFloat(usdtava.value);
    var bnbavafin = parseFloat(bnbava.value);

    console.log(busdavafin);
    console.log(enteramountfin);

    if (!busdchecker.checked && !usdtchecker.checked) {
      button12.disabled = true;
      document.querySelector("#setDepositButtonID").innerHTML = "Choose Currency";
    } else if (busdchecker.checked && busdavafin < enteramountfin) {
      button12.disabled = true;
      document.querySelector("#setDepositButtonID").innerHTML = "Not Enough BUSD";
    } else if (usdtchecker.checked && usdtavafin < enteramountfin) {
      button12.disabled = true;
      document.querySelector("#setDepositButtonID").innerHTML = "Not Enough USDT";
    } else {
      button12.disabled = false;
      document.querySelector("#setDepositButtonID").innerHTML = "Update";
    }

}

window.addEventListener("DOMContentLoaded", depositSet);
enteramount.addEventListener('input', depositSet);
busdchecker.addEventListener("input", depositSet);
usdtchecker.addEventListener("input", depositSet);

</script>
