
<div class="calculprofitdiv">
  <div class="profitheaderpc">
    <img src="img/calculprofit.png" alt="">
    <p>CALCULATE YOUR PROFIT</p>
  </div>
  <div class="profitmainpc">
    <form action="includes/profitcalculator.inc.php" method="post">
      <div class="notnumbersss">
    <div class="entermonthspc">
      <div class="col-3">
          <input class="effect-1" type="text" name="months" placeholder="Months" autocomplete="off">
            <span class="focus-border"></span>
        </div>
    </div>
    <div class="enterdepositpc">
      <div class="col-3">
          <input class="effect-1" type="text" name="deposit" placeholder="Deposit in $" autocomplete="off">
            <span class="focus-border"></span>
        </div>
    </div>
    <div class="choosebotpc">
      <select name="choosebot">
        <option value="stableprofit">Stable</option>
        <option value="aggresiveprofit">Aggresive</option>
      </select>
    </div>
    <div class="calculateprofit">
      <button class="button-22" type="submit" name="profitbutton" style="width: 80%; font-size: 12px;">Calculate!</button>
    </div>
    </div>
    <div class="numbersss">
    <div class="profitresults">
      <p>Estimated result:</p>
      <?php if (isset($_GET['result'])) {
        $profit = $_GET['result'];
        echo "<p>$" . $profit . "</p>";
      } else {
        echo "<p>$0</p>";
      }?>
    </div>
    <?php if (isset($_GET['result'])) {
      $profit = $_GET['result'];
      $revenue = $profit - $user['lastdepositcalc'];
      ?>
      <div class="profitrevenue">
        <?php echo "<p style='color:darkgreen;'>+$" . $revenue . "</p>"; ?>
      </div>
      <?php  } ?>
    </div>
    </form>
  </div>
</div>
