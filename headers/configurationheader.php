<li id="li1" style="border-top: none;"><a href="https://mrpnl.com/myaccount/"> <div class="liwrap"><img src="img/homeimg.png" alt=""> <p>Home</p></div> </a></li>
<li id="li2" class="activelik" ><a href="https://mrpnl.com/myaccount/dca/" class="activea"><div class="liwrap"><img src="img/confimg.png" style="height: 18px; width: 18px;" alt=""> <p>Configure</p></div> </a>
  <div class="configurepan">
    <div class="confwrap1">
      <a href="https://mrpnl.com/myaccount/configuration/dca">DCA bot</a>
    </div>
    <div class="confwrap1">
      <a href="https://mrpnl.com/myaccount/configuration/smart">Smart bot</a>
    </div>
  </div>
</li>
<li id="li3"><a href="https://mrpnl.com/myaccount/statistic/"><div class="liwrap"><img src="img/statisticimg.png" alt=""> <p>Statistic</p></div> </a></li>
<li id="li4"><a href="https://mrpnl.com/myaccount/api/"><div class="liwrap"><img src="img/apiimgg.png" alt=""> <p>API</p></div> </a></li>
<li id="li5"><a href="https://mrpnl.com/myaccount/topup/"><div class="liwrap"><img src="img/walletimg.png" alt=""> <p>Top up</p></div> </a></li>
<li id="li6"><a href="https://mrpnl.com/myaccount/topup/"><div class="liwrap"><img src="img/referalimg.png" alt=""> <p>Referrals</p></div> </a></li>
<li id="li7"><a href="https://mrpnl.com/myaccount/profile/"><div class="liwrap"><img src="img/profileimg.png" alt=""> <p>Profile</p></div> </a></li>
<li class="clientinfo">
  <div class="clientinfodiv">
<div class="mobdivinfo">
  <p>User:</p>
  <?php echo "<p>" . $user['user_nicename'] . "</p>";?>
</div>
<div class="mobdivinfo">
  <p>Balance:</p>
  <?php echo "<p>$" . $user['balance'] . "</p>";?>
</div>
<div class="mobdivinfo">
  <p>Verification:</p>
  <?php
  if ($user['phoneverified']=="0") {
    echo "<p>NOT VERIFIED</p>";
  } elseif ($user['phoneverified']=="1") {
    echo "<p>VERIFIED</p>";
  }
  ?>
</div>
<div class="mobdivinfo">
  <p>Trial:</p>
  <?php
  if ($user['trialstarted']=="0") {
    echo "<p>NOT STARTED</p>";
  } elseif ($user['trialstarted']=="1" && $user['trialdays']!="0") {
    echo "<p>" . $user['trialdays'] . " days left!</p>";
  } elseif ($user['trialdays']=="0") {
    echo "<p>ENDED</p>";
  }
   ?>
</div>
<div class="mobdivinfo">
  <p>Account:</p>
  <?php if ($user['accountstopped']=="1") {
    echo "<p class = 'verifiedheader'>STOPPED</p>";
  } elseif ($user['probstarted']=="1") {
      echo "<p class = 'verifiedheader'>" . $user['daystostop'] . " days left!</p>";
  } else {
    echo "<p class = 'verifiedheader'>ACTIVE</p>";
  } ?>
</div>
  </div>
</li>
<li class="logoutli">
  <div class="logoutdiv">
    <a href="https://mrpnl.com/en/trash/?redirect_to=https://mrpnl.com/en/homepage/"><button  class = "button-27" type="submit" name="button">Logout</button></a>
  </div>
</li>
