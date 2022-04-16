<div class="apidetailso">
  <div class="apidetwrap">
    <div class="apiheader2wrap">
      <div class="apiheadip">
        <p>ID</p>
      </div>
      <div class="apiheadexchange">
        <p>EXCH.</p>
      </div>
      <div class="apiheadapikey">
        <p>API NAME</p>
      </div>
      <div class="apiheadapikey1">
        <p>API KEY</p>
      </div>
      <div class="apiheadactions">
        <p>ACTIONS</p>
      </div>
    </div>
    <div class="apibodysettings">
  <?php
  $sql_ud = "SELECT * FROM `$usernamee`";
    $resultd = $connapi->query($sql_ud);
    if ($resultd->num_rows > 0) {
      foreach ($resultd as $resultkeyd) {
        $id = $resultkeyd['id'];
        $apikey = $resultkeyd['apikey'];
        $apinicename = $resultkeyd['apinicename'];
        $apisecret = $resultkeyd['apisecret'];
        $hiddenform = $resultkeyd['hiddenform'];
        $working = $resultkeyd['working'];
        ?>


        <?php
        if ($working == "1") {
          echo "<div class='eachvalue' style='background: #3dfc061a;'>";
        } else {
          echo "<div class='eachvalue'>";
        }
         ?>

          <form class="" action="../includes/updateapi2.inc.php" method="post">
          <div class="apiid">
            <?php
            echo "<p>".$id."</p>";
            ?>
          </div>
          <div class="exchangemain">
            <img src="img/binance512.png" alt="">
          </div>
          <?php
          echo "<div class = 'apinicenamemain'><p>".$apinicename."</p></div>";
          echo "<div class = 'hiddenapimain'><p>".$hiddenform."</p></div>";
          echo "<input type='hidden' name='apikey' value='$apikey'>";
          echo "<input type='hidden' name='apiid' value='$id'>";
          echo "<input type='hidden' name='apisecret' value='$apisecret'>";
          echo "<input type='hidden' name='working' value='$working'>";
          echo "<input type='hidden' name='apinicename' value='$apinicename'>";
          echo "<input type='hidden' name='hiddenform' value='$hiddenform'>";
          echo "<input type='hidden' name='username' value='$usernamee'>";
           ?>
           <div class="apiactions">
             <input class="button-30" style="height: 43%; width: 38%; font-size:10px;" type="submit" name="chooseapi" value="USE">
             <input class="button-25" style="height: 43%; width: 38%; font-size:9px;" id="removebutton" type="submit" name="removeapi" value="REMOVE">
           </div>
        </form>
        </div>


  <?php
      }
    }
   ?>
   </div>
   </div>
</div>

<script>
</script>
