<div class="depositstart" id="depositid">
  <div class="depositinformation">
    <div class="depositheader">
      <p align = "center">BOT STATUS</p>
    </div>
    <div class="todayprofit">


    </div>
    <div class="historyprofit">
      <div class="statisticheader">
        <div class="estimatedprofitdiv">
          <div class="profitdescription">
            <div class="statsheader">
              <p>Current configurations:</p>
            </div>
            <div class="statsinfo">
              <?php include "botconfiguration.php"; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="currentstatistic">
        <div class="statsheader">
          <p>Statistic:</p>
        </div>
        <div class="statsinfo">
          <!--
          <div class="statsstrategy">
            <p> - Weekly profit:</p> <?php // echo "<p>$" . $user['weeklyprofit'] . "</p>"; ?>
          </div>
        -->
          <div class="statsstrategy">
          <p> - Monthly profit: </p> <?php echo "<p>$" . $user['monthlyprofit'] . "</p>"; ?>
          </div>
        </div>
      </div>
    </div>
    <div class="startdisable">
      <div class="botstatus">
        <?php
        if ($user['activebot']=="0") {
            echo "<p><img src='img/stopped.png' alt=''><strong>DISABLED</strong></p>";
        } elseif ($user['activebot']=="1") {
            echo "<p><img src='img/inprogress.png' alt=''><strong>IN PROGRESS</strong></p>";
        } elseif ($user['activebot']=="2") {
            echo "<p><img src='img/active.png' alt=''><strong>ACTIVE</strong></p>";
        }
         ?>
      </div>
      <div class="startbutton">
        <form class="startbuttonform" action="../includes/startbot2.php" method="post">
          <?php
          if ($user['phoneverified']=="0") {
            echo "<button class = 'button-24' type='button' onclick='verificationAlert()'>Start bot</button>";
          } elseif ($user['api_key']=="0" || $user['api_secret']=="0" || $user['api_key']=="" || $user['api_secret']=="") {
              echo "<button class = 'button-24' type='button' onclick='apiAlert()'>Start bot</button>";
          } elseif ($user['botdeposit']=="0") {
              echo "<button class = 'button-24' type='button' onclick='depositAlert()'>Start bot</button>";
          } elseif ($user['botdeposit']<200) {
              echo "<button class = 'button-24' type='button' onclick='littleDepositAlert()'>Start bot</button>";
          } elseif ($user['activebot']=="0" && $user['accountstopped']=="0") {
              echo "<button id = 'startBotButton' class = 'button-24' type='submit' name='startbutton'>Start bot</button>";
          } elseif ($user['accountstopped']=="1") {
              echo "<button class = 'button-24' type='button' onclick='accountStopped()' name='startbutton'>Start bot</button>";
          } elseif ($user['activebot']=="1" || $user['activebot']=="2") {
              echo "<button id = 'startBotButton' class = 'button-24' type='submit' name='disablebutton'>Disable bot</button>";
          }
           ?>
        </form>
      </div>

    </div>
  </div>
</div>
