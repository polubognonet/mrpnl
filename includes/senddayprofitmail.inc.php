<?php

require_once '/var/www/mrpnl.com/myaccount/checkorders/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$phpMailer = new PHPMailer(true);

include "/var/www/mrpnl.com/myaccount/includes/dbh.inc.php";



$sql_u = "SELECT * FROM wptj_users";
  $result = $conn->query($sql_u);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

      $todayprofit = $row['todayprofita'];
      $username = $row['user_nicename'];
      $activebot = $row['activebot'];
      $tgchat = $row['telegramchat'];
      $email = $row['user_email'];


      if ($row["user_profitemails"] == "1" && $activebot == "2" && $todayprofit !== "0") {

        $phpMailer = new PHPMailer(true);
        $phpMailer->isSMTP();
        $phpMailer->Host = "smtppro.zoho.eu";
        $phpMailer->SMTPAuth = true;
        $phpMailer->Username = "nfyz228@gmail.com";
        $phpMailer->Password = "Polubognonet1!";
        $phpMailer->SMTPSecure = "tls"; // or PHPMailer::ENCRYPTION_STARTTLS
        $phpMailer->Port = 587;
        $phpMailer->isHTML(true);
        $phpMailer->CharSet = "UTF-8";
        $phpMailer->setFrom("notify@mrpnl.com", "MR.PNL");
        $phpMailer->addAddress($email);
        $phpMailer->Subject = "MR.PNL daily report";
        $phpMailer->Body = "Hello. <br>Here is your daily MR.PNL profit report. <br><br>Today profit: $".$todayprofit."<br><br>You can disable these notifications in your personal account settings.";
        $phpMailer->send();

      }

      if ($tgchat !== "0" && $activebot == "2" && $todayprofit !== "0") {
        $token = '5085832702:AAEfkoomATttW-kmhVkZrHc8U3owKpm4H60';
        $text1 = urlencode("Hello! \nHere is your daily MR.PNL profit report. \n \nToday profit: $".$todayprofit." \n \nYou can disable these notifications in your account.");
        file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$tgchat&text=$text1");
      }

  }
}

$new = "0";

$sql = "UPDATE wptj_users SET todayprofita = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $new);
$stmt->execute();


 ?>
