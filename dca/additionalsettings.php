<?php

if (isset($_SESSION['idstr'])) {

  $buttonValue = "editStrategyButton";

  $idstr = $_SESSION['idstr'];
  $working = $_SESSION['working'];
  $name = $_SESSION['name'];
  $coinsamount = $_SESSION['coinsamount'];
  $ordersamount = $_SESSION['ordersamount'];
  $takeprofit = $_SESSION['takeprofit'];
  $martingale = $_SESSION['martingale'];
  $firstorderdev = $_SESSION['firstorderdev'];
  $pricemartin = $_SESSION['pricemartin'];
  $liveadd = $_SESSION['liveadd'];
  $smartdca = $_SESSION['smartdca'];
  $dynamictp = $_SESSION['dynamictp'];
  $pullupgrid = $_SESSION['pullupgrid'];

} else {
  $idstr = 0;
  $buttonValue = "startStrategyButton";
  $name = "";
  $working = 0;
  $coinsamount = "1";
  $ordersamount = "5";
  $takeprofit = "0.9";
  $martingale = "1.25";
  $firstorderdev = "0.5";
  $pricemartin = "1.1";
  $liveadd = "0";
  $smartdca = "0";
  $dynamictp = "0";
  $pullupgrid = "0.9";
} ?>



<div class="aditionalset" id="apiid">
  <div class="aditinformation">
    <div class="aditheader">
      <p align = "center">CREATE STRATEGY</p>
    </div>
    <form class="strategyForm" action="../includes/checkstrategy.inc.php" method="post">
      <div class="strategyDiv">
        <div class="strategyName">
          <p>STRATEGY NAME:</p>
        </div>
        <div class="strategyNameValue">
          <div class="col-3">
              <input class="effect-1" type="text" name="strategyName" placeholder="My Strategy" autocomplete="off" maxlength="20" <?php echo "value = '".$name."'"; ?>>
                <span class="focus-border"></span>
            </div>
        </div>
      </div>
      <div class="strategyDiv">
        <div class="strategyCoins">
          <p>COINS AMOUNT:</p>
        </div>
        <div class="strategyCoinsValue">
          <?php echo "<input type = 'hidden' name = 'username' value = '".$user['user_login']."'>"; ?>
          <?php echo "<input type = 'hidden' name = 'idstr' value = '".$idstr."'>"; ?>
          <?php echo "<input type = 'hidden' name = 'working' value = '".$working."'>"; ?>

          <input type="range" name="strategyCoins" id="rng" min="1" max="3" <?php echo "value = '".$coinsamount."'"; ?>><span id="rngOutput"></span>
        </div>
      </div>
      <div class="strategyDiv">
        <div class="strategyOrders">
          <p>ORDERS AMOUNT:</p>
        </div>
        <div class="strategyOrdersValue">
          <input type="range" name="strategyOrders" id="rng1" min="3" max="14" <?php echo "value = '".$ordersamount."'"; ?>><span id="rngOutput1"></span>
        </div>
      </div>
      <div class="strategyDiv">
        <div class="strategyPrice">
          <p>VOLUME MARTINGALE:</p>
        </div>
        <div class="strategyPriceValue">
          <input type="range" name="strategyMartin" id="rng4" min="1.01" max="1.6" <?php echo "value = '".$martingale."'"; ?> step="0.01"><span id="rngOutput4"></span>
        </div>
      </div>
      <div class="strategyDiv">
        <div class="strategyFirstorder">
          <p>FIRST ORDER DEVIATION:</p>
        </div>
        <div class="strategyOrdersValue">
          <input type="range" name="strategyFirstorder" id="rng5" min="0.3" max="1" <?php echo "value = '".$firstorderdev."'"; ?> step="0.1"><span id="rngOutput5"></span>
        </div>
      </div>
      <div class="strategyDiv">
        <div class="strategyFirstorder">
          <p>ORDERS STEP SCALE:</p>
        </div>
        <div class="strategyOrdersValue">
          <input type="range" name="strategyStepScale" id="rng6" min="1.01" max="1.65" <?php echo "value = '".$pricemartin."'"; ?> step="0.01"><span id="rngOutput6"></span>
        </div>
      </div>
      <div class="strategyDiv">
        <div class="strategyPrice">
          <p>TAKE PROFIT DEVIATION:</p>
        </div>
        <div class="strategyPriceValue">
          <input type="range" name="strategyProfit" id="rng3" min="0.3" max="5" <?php echo "value = '".$takeprofit."'"; ?> step="0.1"><span id="rngOutput3"></span>
        </div>
      </div>
      <div class="strategyDiv">
        <div class="strategyPrice">
          <p>PULLING-UP THE ORDERS:</p>
        </div>
        <div class="strategyPriceValue">
          <input type="range" name="strategyPullup" id="rng8" min="1" max="2" <?php echo "value = '".$pullupgrid."'"; ?> step="0.1"><span id="rngOutput8"></span>
        </div>
      </div>
      <div class="strategyDiv">
        <div class="strategyLivaAdd">
          <p>ENABLE <strong>LIVEADD</strong>:</p>
        </div>
        <div class="strategyLivaAddValue">
          <div class="block">
            <input data-index="0" name="strategyLiveadd" id="cheap" type="checkbox" name="liveadd" <?php if ($liveadd == "1") {
              echo "checked";
            } ?>/>
            <label for="cheap"></label>
          </div>
        </div>
      </div>
      <div class="strategyDiv">
        <div class="strategyLivaAdd">
          <p>ENABLE <strong>SMART DCA</strong>:</p>
        </div>
        <div class="strategyLivaAddValue">
          <div class="block">
            <input data-index="1" name="strategySmartdca" id="fast" type="checkbox" name="smartdca" <?php if ($smartdca == "1") {
              echo "checked";
            } ?>/>
            <label for="fast"></label>
          </div>
        </div>
      </div>
      <div class="strategyDiv">
        <div class="strategyLivaAdd">
          <p>DYNAMIC TAKE PROFIT:</p>
        </div>
        <div class="strategyLivaAddValue">
          <div class="block">
            <input data-index="2" name="strategyDynamicTP" id="low" type="checkbox" name="dynamictp" <?php if ($dynamictp == "1") {
              echo "checked";
            } ?>/>
            <label for="low"></label>
          </div>
        </div>
      </div>
      <div class="strategyDiv">
        <div class="strategyDeviation">
          <p>PRICE DEVIATION:</p>
        </div>
        <div class="strategyDeviationValue">
          <input type="hidden" name="strategyDeviation" id="rng2"><span id="rngOutput2"></span>
        </div>
      </div>
      <div class="strategyDiv">
        <div class="strategyMindep">
          <p>MINIMUM DEPOSIT:</p>
        </div>
        <div class="strategyDeviationValue">
          <input type="hidden" name="strategyMindep" id="rng7"><span id="rngOutput7"></span>
        </div>
      </div>
      <div class="strategyDivFinal">
        <div class="strategyButton">
          <button id = "strategyButtonId" class="strategyCreateButton" type="submit" <?php echo "name = '".$buttonValue."'"; ?>>Create Strategy</button>

        </div>
      </div>
    </form>
</div>

<?php if (isset($_SESSION['idstr'])) {
  unset($_SESSION['idstr']);
  unset($_SESSION['working']);
  unset($_SESSION['name']);
  unset($_SESSION['coinsamount']);
  unset($_SESSION['ordersamount']);
  unset($_SESSION['takeprofit']);
  unset($_SESSION['martingale']);
  unset($_SESSION['firstorderdev']);
  unset($_SESSION['pricemartin']);
  unset($_SESSION['liveadd']);
  unset($_SESSION['smartdca']);
  unset($_SESSION['dynamictp']);
  unset($_SESSION['pullupgrid']);
}
 ?>
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

var percent = document.createTextNode("%");
var button = document.getElementById("strategyButtonId");

var rng = document.getElementById("rng");
var ro = document.getElementById("rngOutput");

function updateRange(){
   ro.textContent = rng.value;
};

window.addEventListener("DOMContentLoaded", updateRange);
rng.addEventListener("input", updateRange);

var rng1 = document.getElementById("rng1");
var ro1 = document.getElementById("rngOutput1");

function updateRange1(){
   ro1.textContent = rng1.value;
};

window.addEventListener("DOMContentLoaded", updateRange1);
rng1.addEventListener("input", updateRange1);

var rng2 = document.getElementById("rng2");
var ro2 = document.getElementById("rngOutput2");

var rng3 = document.getElementById("rng3");
var ro3 = document.getElementById("rngOutput3");

function updateRange3(){
   ro3.textContent = rng3.value;
   ro3.textContent += "%";
};

window.addEventListener("DOMContentLoaded", updateRange3);
rng3.addEventListener("input", updateRange3);

var rng4 = document.getElementById("rng4");
var ro4 = document.getElementById("rngOutput4");

function updateRange4(){
   ro4.textContent = rng4.value;
   ro4.textContent += "%";
};

window.addEventListener("DOMContentLoaded", updateRange4);
rng4.addEventListener("input", updateRange4);

var rng5 = document.getElementById("rng5");
var ro5 = document.getElementById("rngOutput5");

function updateRange5(){
   ro5.textContent = rng5.value;
   ro5.textContent += "%";
};

window.addEventListener("DOMContentLoaded", updateRange5);
rng5.addEventListener("input", updateRange5);

var rng6 = document.getElementById("rng6");
var ro6 = document.getElementById("rngOutput6");

function updateRange6(){
   ro6.textContent = rng6.value;
   ro6.textContent += "%";
};

window.addEventListener("DOMContentLoaded", updateRange6);
rng6.addEventListener("input", updateRange6);

var rngpullup = document.getElementById("rng8");
var ropullup = document.getElementById("rngOutput8");

function updateRangePullup(){

   ropullup.textContent = rngpullup.value;
   if (ropullup.textContent == "1") {
     ropullup.textContent = "OFF";
   } else {
     ropullup.textContent += "%";
   }

   if ( rng5.value > rngpullup.value ) {
     ro5.style.color = "#E3853F";
   } else if ( rng5.value < rngpullup.value ) {
     ro5.style.color = "#7e7e7e";
   }
};

window.addEventListener("DOMContentLoaded", updateRangePullup);
rngpullup.addEventListener("input", updateRangePullup);
rng5.addEventListener("input", updateRangePullup);


function updateDeviation(){
   var rng9 = rng5.value * (Math.pow(rng6.value, rng1.value) - 1) / (rng6.value - 1) ;
   var rng10 = rng9.toFixed(2);
   ro2.textContent = rng10;
   ro2.textContent += "%";
   console.log(rng10);
   rng2.value = rng10;
   if (rng2.value > 65) {
     ro2.style.color = "#E3853F";
   } else if (rng2.value < 65) {
     ro2.style.color = "#7e7e7e";
   }
   console.log(rng2.value);
};

window.addEventListener("DOMContentLoaded", updateDeviation);
rng6.addEventListener("input", updateDeviation);
rng5.addEventListener("input", updateDeviation);
rng1.addEventListener("input", updateDeviation);

var rng10 = document.getElementById("rng7");
var ro10 = document.getElementById("rngOutput7");
var rng20 = document.getElementById("strategyDepositId");

function updateMartingale(){
   var val10 = 11;
   var rng11 = (val10 * (Math.pow(rng4.value, rng1.value) - 1) / (rng4.value - 1))*rng.value;
   var rng123 = rng11.toFixed(2);
   console.log(rng123);
   rng10.value = rng123;
   var rng12 = parseInt(rng123);
   var rng15 = parseInt(rng20.value);
   if (rng12 > rng15) {
     ro10.style.color = "#E3853F";
   } else if (rng12 < rng15) {
     ro10.style.color = "#7e7e7e";
   }
   ro10.textContent = "$";
   ro10.textContent += rng12;
   console.log(rng10.value);
};

window.addEventListener("DOMContentLoaded", updateMartingale);
rng4.addEventListener("input", updateMartingale);
rng1.addEventListener("input", updateMartingale);
rng.addEventListener("input", updateMartingale);

var busd = document.getElementById("busdchecker");
var usdt = document.getElementById("usdtchecker");



function sendFormButton(){
    var button = document.getElementById("strategyButtonId");
    var depositAmount = rng10.value;
    var priceDeviation = rng2.value;
    var rng16 = parseInt(rng20.value);
    var rng17 = parseInt(depositAmount);
    var rng18 = parseInt(priceDeviation);
    console.log(rng16);
    console.log(rng17);
    console.log(rng18);

    if (rng17 > rng16 || rng18 > 65) {
      button.disabled = true;
      document.querySelector("#strategyButtonId").innerHTML = "Incorrect Strategy";
    } else {
      button.disabled = false;
      document.querySelector("#strategyButtonId").innerHTML = "Create Strategy";
    }
};

window.addEventListener("DOMContentLoaded", sendFormButton);
rng20.addEventListener('input', sendFormButton);
rng2.addEventListener("input", sendFormButton);
rng4.addEventListener("input", sendFormButton);
rng1.addEventListener("input", sendFormButton);
rng.addEventListener("input", sendFormButton);
rng6.addEventListener("input", sendFormButton);
rng5.addEventListener("input", sendFormButton);
busd.addEventListener('input', sendFormButton);
usdt.addEventListener("input", sendFormButton);

</script>
<script>
$('input[type=checkbox]').change(function(){
  counter = 0;
  clicked = $(this).data('index');
  $('input[type=checkbox]').each(function(){
    if($(this)[0].checked){
      counter++;
    }
  });
  if(counter==3){
    toDisable = clicked;
    while(toDisable==clicked){
      toDisable=Math.round(Math.random()*2);
    }
    $("input:eq("+toDisable+")")[0].checked = false;
  }
});
</script>
