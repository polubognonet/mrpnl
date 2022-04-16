<div class="blackWrap" id="blackWrap">
</div>
  <div class="changeInfoWrap" id="changeInfoWrap">
    <div class="changeInfoHeaderWrap">
      <?php echo "<p>RESET PASSWORD</p>" ?>
    </div>
    <form class="changeInfoBodyWrap" action="index.html" method="post">
      <div class="changeInfoBodyWrap2">
      <div class="passwordWrapHolder">
        <div class="passwordWrapHolderP">
          <p>Current Password:</p>
        </div>
        <div class="passwordWrapHolderInput">
          <div class="col-3">
                <input id="depositInput" class="effect-8" type="password" name="prevpwd" autocomplete="off">
                    <span class="focus-border">
                      <i></i>
                    </span>
            </div>
        </div>
      </div>
      <div class="passwordWrapHolder">
        <div class="passwordWrapHolderP">
          <p>New Password:</p>
        </div>
        <div class="passwordWrapHolderInput">
          <div class="col-3">
                <input id="depositInput" class="effect-8" type="password" name="newpwd" autocomplete="off">
                    <span class="focus-border">
                      <i></i>
                    </span>
            </div>
        </div>
      </div>
      <div class="passwordWrapHolder">
        <div class="passwordWrapHolderP">
          <p>Confirm Password:</p>
        </div>
        <div class="passwordWrapHolderInput">
          <div class="col-3">
                <input id="depositInput" class="effect-8" type="password" name="confirmpwd" autocomplete="off">
                    <span class="focus-border">
                      <i></i>
                    </span>
            </div>
        </div>
      </div>
      <div class="passwordWrapHolder">

      </div>
      </div>
    </form>
  </div>


<script>

$('#blackWrap').click(
   function() {
      $('#blackWrap').removeClass('appearWrapper')
      $('#changeInfoWrap').removeClass('appearWrapper')
      $('#blackWrap').addClass('dissapearWrapper')
      $('#changeInfoWrap').addClass('dissapearWrapper')
   }
)

</script>
