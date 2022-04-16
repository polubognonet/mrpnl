<div class="balancereferals" id="balanceid">
  <div class="accountinformation">
    <div class="accountheader">
      <p align = "center">DEPOSIT AND REFERRALS</p>
    </div>
    <div class="yourdeposit">
      <div class="divdepositnumber">
        <div class="botdepositdiv">
          <div class="botdepositp">
            <img src="img/deposit.png" alt="">  <p>Bot deposit:</p>
          </div>
            <div class="actualmoney">
          <?php
          echo "<p>$" . $user['botdeposit'] . "</p>";

          if ($user['currentcurrency']=="0") {
            echo "<p></p>";
          } elseif ($user['currentcurrency']=="usdt") {
            echo "<p style='margin-left: 4px;'>USDT</p>";
          } elseif ($user['currentcurrency']=="busd") {
            echo "<p style='margin-left: 4px;'>BUSD</p>";
          }
            ?>
          </div>
        </div>
      </div>
      <div class="depositdisclaimer">
        <div class="botdepositp">
          <img src="img/dayprofit.png" alt="">  <p>Estimated day profit:</p>
        </div>
        <div class="actualestim">
          <?php
          if ($user['botentered']=="0") {
            $estimatedprofit = $user['botdeposit'] * 0.1 / 30;
            $newestimatedprofit = number_format($estimatedprofit, 2, ',', '');
            echo "<p>$" . $newestimatedprofit . "</p>";
          } elseif ($user['botentered']=="1") {
            $estimatedprofit = $user['botdeposit'] * 0.15 / 30;
            $newestimatedprofit = number_format($estimatedprofit, 2, ',', '');
            echo "<p>$" . $newestimatedprofit . "</p>";
          }

           ?>
        </div>
      </div>
    </div>

    <div class="yourreferrals">
      <div class="profitnumber">
        <p><img src="img/profiticon.png" alt="">Today profit:</p>
        <?php echo "<p>$" . $user['todayprofita'] . "</p>" ?>
      </div>
      <div class="refferalstatistic">
      <div class="yourrefferalsamount">
        <div class="referalsdescription">
          <p>Referrals:</p>
          <div class="referalsamount">
          <?php
          if ($user['referral_num']>800) {
            echo "<p>Please refresh this page.</p>";
          } elseif ($user['referralcode']!="0") {
            echo "<p><strong>" . $user['referral_num'] . "</strong></p>";
          } else {
            echo "<p>0</p>";
          }
           ?>
           </div>
        </div>
      </div>
      <div class="referralprofit">
        <p>Profit:</p>
        <?php echo "<p>$" . $user['refferalprofita']. "</p>"; ?>
      </div>
        <div class="yourrefferalcode">
        <p>Referral code:</p>
      <?php
                if ($user['referralcode']!="0") {
                  echo "<div class='referalcode'>
                     <p>" . $user['referralcode'] . "</p>
                  </div>";
                } else {
                  echo "<div class='generatecode'>
                    <form action='includes/randomnum.inc.php' method='post'>
                      <button class = 'button-26' type='submit' name='codegenerator'>Generete the code</button>
                    </form>
                  </div>";
                }
      ?>
      </div>
    </div>
    </div>
    <div class="changedeposit">
      <form action="../includes/changedeposit.inc.php" method="post">
      <div class="choosecurrency">
        <select id="selectcurrency" name="currency">
          <option value="usdt">USDT</option>
          <option value="busd">BUSD</option>
        </select>
      </div>
      <div class="col-3">
          <input class="effect-8" type="text" name="deposit" placeholder="Deposit in $" autocomplete="off">
              <span class="focus-border">
                <i></i>
              </span>
        </div>
      <?php if ($user['api_key']=="0" AND $user['api_secret']=="") {
        echo "<button class = 'button-25' type='button' onclick='changeDepositImpApi()'>Submit</button>";
      } elseif ($user['activebot']=="0") {
        echo "<button class = 'button-25' type='submit' name='depositbutton'>Submit</button>";
      } else {
        echo "<button class = 'button-25' type='button' onclick='changeDepositImp()'>Submit</button>";
      }
      ?>
      </form>
    </div>
  </div>
</div>
