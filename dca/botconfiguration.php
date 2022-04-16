<?php

if ($user['botdeposit']<300) {
  echo "<div class='statsdeposit' style='color:darkred;'>
    <p><img src='../img/crossicon.png' alt=''>Deposit:</p>";
    if ($user['botdeposit']!=0) {
      echo "<p>" . $user['botdeposit'] . " " . $user['currentcurrency'] . "</p>";
    } else {
      echo "<p>not entered</p>";
    }
  echo "</div>";
} else {
  echo "<div class='statsdeposit'>
    <p><img src='../img/goodicon.png' alt=''>Deposit:</p>";
    if ($user['botdeposit']!=0) {
      echo "<p>" . $user['botdeposit'] . " " . $user['currentcurrency'] . "</p>";
    } else {
      echo "<p>not entered</p>";
    }
  echo "</div>";
}

?>

<div class="statsstrategy">
  <p><img src='../img/goodicon.png' alt=''>Strategy:</p>
  <?php if ($user['botentered']=="0") {
    echo "<p>Stable</p>";
  } else {
    echo "<p>Aggressive</p>";
  } ?>
</div>

<?php

if ($user['api_key']=="0") {
  echo "<div class='statsapi' style='color:darkred;'>
    <p><img src='../img/crossicon.png' alt=''>API:</p>";
    echo "<p>not entered</p>";
  echo "</div>";
} else {
  echo "<div class='statsapi'>
    <p><img src='../img/goodicon.png' alt=''>API:</p>";
    if ($user['botdeposit']!=0) {
      echo "<p>" . $user['hiddenapi'] . "</p>";
    } else {
      echo "<p>not entered</p>";
    }
  echo "</div>";
}

?>
