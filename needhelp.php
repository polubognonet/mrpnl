<div class="needhelp">
  <img onclick="myFunction1()" src="img/needhelp1.png"  style="display: none; padding-left: 43%;" alt="">
</div>

<div class="needhelp1">
  <img src="img/51.png" alt="">
  <li>
    <a href="https://mrpnl.com/myaccount/howto.php" target="_blank"><ul>
      <p> Yes, please!</p>
    </ul></a>
    <ul onclick="myFunction()" style="display: none; border-top: 1px solid grey;">
        <p>No, thank you.</p>
    </ul>
  </li>
</div>

<script type="text/javascript">


function myFunction() {
  const element = document.querySelector(".needhelp");
  element.classList.add("mystyleneedhelp");
  const delement = document.querySelector(".needhelp1");
  delement.classList.add("mystyleneedhelp1");
}

function myFunction1() {
  const element = document.querySelector(".needhelp");
  element.classList.remove("mystyleneedhelp");
  const delement = document.querySelector(".needhelp1");
  delement.classList.remove("mystyleneedhelp1");
}


</script>
