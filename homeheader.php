<li class="activeli" style="border-top: none;"><a class="activea" href="https://mrpnl.com/myaccount/">Home</a></li>
<li><a href="#">Statistic</a></li>
<li><a href="https://mrpnl.com/myaccount/topup.php">Top up</a></li>
<li><a href="https://mrpnl.com/myaccount/profile.php">Profile</a></li>
<li style="border-bottom: none;"><a href="https://mrpnl.com/myaccount/howto.php">FAQ</a></li>
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
