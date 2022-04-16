
<?php


include "../includes/dbhstrategy.inc.php";


 ?>



<div class="choosebot" id="botsid">
  <div class="botsinformation">
    <div class="botsheader">
      <p align = "center">AVAILABLE STRATEGIES</p>
    </div>
    <div class="availablebots">
      <?php
      $userd = $user['user_login'];
      $sql_ud = "SELECT * FROM `$userd`";
        $resultd = $connstr->query($sql_ud);
        if ($resultd->num_rows > 0) {
          foreach ($resultd as $resultkeyd) {
            $id = $resultkeyd["id"];
            $working = $resultkeyd["working"];
            $name = $resultkeyd["name"];
            $coins = $resultkeyd["coinsamount"];
            $orders = $resultkeyd["ordersamount"];
            $deviation = $resultkeyd["pricedeviation"];
            $profit = $resultkeyd["takeprofit"];
            $martin = $resultkeyd["martingale"];
            $firstOrder = $resultkeyd["firstorderdev"];
            $stepScale = $resultkeyd["pricemartin"];
            $minDep = $resultkeyd["mindep"];
            $liveadd1 = $resultkeyd["liveadd"];
            $smartdca1 = $resultkeyd["smartdca"];
            $dynamictp = $resultkeyd["dynamictp"];

            if ($working == "1") {
              echo "<div class='strategyWrap' style='background: #dff2d970;'>";
            } else {
              echo "<div class='strategyWrap'>";
            }
      ?>
      <form id = "strategyactionsform" class="" action="../includes/strategyactions.inc.php" method="post">
        <?php echo "<input type='hidden' name='strategyid' value='".$id."'>" ;?>
        <?php echo "<input type='hidden' name='username' value='".$userd."'>" ;?>
        <div class="strategyNameWrap">
          <?php echo "<p>".strtoupper($name)."</p>"; ?>
        </div>
        <div class="firstBigValueWrapper">
        <div class="bigValueWrapper">
          <div class="valueWrapper">
            <?php echo "<p>COINS AMOUNT:</p><p>".$coins."</p>"; ?>
          </div>
          <div class="valueWrapper">
            <?php echo "<p>ORDERS AMOUNT:</p><p>".$orders."</p>"; ?>
          </div>
          <div class="valueWrapper">
            <?php echo "<p>ORDERS STEP SCALE:</p><p>".$stepScale."</p>"; ?>
          </div>
          <div class="valueWrapper">
            <?php echo "<p>TAKE PROFIT DEVIATION:</p><p>".$profit."</p>"; ?>
          </div>
          <div class="valueWrapper">
            <?php echo "<p>VOLUME MARTINGALE:</p><p>".$martin."</p>"; ?>
          </div>
          <div class="valueWrapper">
            <?php if ($botdeposit < $minDep) {
              echo "<p style = 'color: #d6323b;'>MINIMUM DEPOSIT:</p><p style = 'color: #d6323b;'>".$minDep."</p>";
            } else {
              echo "<p>MINIMUM DEPOSIT:</p><p>".$minDep."</p>";
            } ?>
          </div>
          <div class="valueWrapper">
            <?php if ($liveadd1 == "0") {
              echo "<p>LIVEADD:</p><p>NO</p>";
            } else {
              echo "<p>LIVEADD</p><p>YES</p>";
            }
            ?>
          </div>
          <div class="valueWrapper">
            <?php
            if ($smartdca1 == "0") {
              echo "<p>SMARTDCA:</p><p>NO</p>";
            } else {
              echo "<p>SMARTDCA</p><p>YES</p>";
            }
            ?>
          </div>
          <div class="valueWrapper">
            <?php
            if ($dynamictp == "0") {
              echo "<p>DYNAMIC TP:</p><p>NO</p>";
            } else {
              echo "<p>DYNAMIC TP</p><p>YES</p>";
            }
            ?>
          </div>
        </div>
        </div>
        <div class="strategyActions">
            <div class="strategyActionsWrap">
              <button id="use" type="submit" name="use"><img src="img/usestrategy.png"> <span class="tooltiptext">Choose</span> </button>
              <button id="remove" type="submit" name="remove"><img src="img/crossstrategy.png"> <span class="tooltiptext">Remove</span> </button>
              <button id="edit" type="submit" name="edit"><img src="img/editstrategy.png"> <span class="tooltiptext">Edit</span> </button>
              <button id="clone" type="submit" name="clone"><img src="img/clonestrategy.png"> <span class="tooltiptext">Clone</span> </button>
            </div>


        </div>
      </form>
      </div>
      <?php
    }
  }?>
    </div>
  </div>
</div>

<script>

$('#use, #remove, #edit, #clone').click(
  function() {
  preloaderFadeInTime = 1000;
  var preloader = $('.loader-wrapper');
  preloader.fadeIn(preloaderFadeInTime);
  });

</script>
