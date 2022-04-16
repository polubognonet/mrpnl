const phoneInputField = document.querySelector("#phone");
const phoneInput = window.intlTelInput(phoneInputField, {
  preferredCountries: ["us", "ru", "ua"],
  utilsScript:
    "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
});
const info = document.querySelector(".alert-info");

function process(event) {
  event.preventDefault();

  const phoneNumber = phoneInput.getNumber();
  var correctphone = phoneNumber.toString();

  var rcorrectphone = correctphone.substring(1);
  window.location.href=`https://mrpnl.com/myaccount/verify/psms.php?pn=${rcorrectphone}`;
}
