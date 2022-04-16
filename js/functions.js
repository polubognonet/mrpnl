
function verificationAlert() {
  swal("Verification Needed!", "Your account is not verified yet. Please verify it first", {
  buttons: {
    cancel: "Okay!",
    verify: {
      text: "Verify it now!",
      value: "verify",
    },
  },
})
.then((value) => {
switch (value) {

  case "verify":
    window.location.href=`https://mrpnl.com/myaccount/pverify.php`;
    break;

  default:
    break;
}
});
}

function areyousure() {
  swal("Remove API", "Are you sure that you would like to remove this API key?", {
  buttons: {
    cancel: {
      text: "No!",
      value: "cancel",
    },
    verify: {
      text: "Yes!",
    },
  },
})
.then((value) => {
switch (value) {

  case "cancel":
    window.location.href=`https://mrpnl.com/myaccount/api.php`;
    break;
}
});
}

function accountStopped() {
  swal("Account disabled!", "Please top up your account balance in order to proceed.", "error");
}

function apiAlert() {
  swal("API error!", "Please enter API information for your bot. You may do it in the 'API settings' section.", "warning");
}

function depositAlert() {
  swal("Deposit error!", "Please enter Deposit information for your bot. You may do it in the 'Deposit and Referrals' section.", "warning");
}

function littleDepositAlert() {
  swal("Deposit error!", "Please note that the bot deposit should be more than 200$. You may change it in the 'Deposit and Referrals' section.", "warning");
}

function confirmStart() {
  swal("Success!", "Enabled properly.", "success");
}

function confirmDisable() {
  swal("Success!", "Disabled properly.", "success");
}

function changeDepositImp() {
  swal("Oops!", "It is not possible to change your deposit when the bot is active. Please disable it first.", "error");
}

function changeDepositImpApi() {
  swal("Oops!", "Please enter the API details first. You can do it in the 'API settings' section.", "error");
}

function changeDepositSuccess() {
  swal("Success!", "Changing your Deposit information", "success");
}

function changeBotStrategy() {
  swal("Oops!", "It is not possible to change your strategy when the bot is active. Please disable it first.", "error");
}

function changeApi() {
  swal("Oops!", "It is not possible to change your API information when the bot is active. Please disable it first.", "error");
}

function changeApiSuccess() {
  swal("Success!", "Changing your API information", "success");
}

function fiveTimesNumber() {
  swal("Oops!", "You have tried to validate your phone number for 5 times already. Please contact us in Telegram in order to verify your account manualy.", "error");
}

function tenTimesOTP() {
  swal("Oops!", "You have tried to validate the code for 10 times without success. Please contact us in Telegram in order to verify your account manualy.", "error");
}

function badinputTopUP() {
  swal("Oops!", "Please note that minimum deposit is $5.", "error");
}

function verifiedotp() {
  swal("Great!", "Your phone is verified now.", "success");
}
