<?php

include '../includes/dbh.inc.php';

$input = file_get_contents('php://input');
$update = json_decode($input);
$message = $update->message;
$chat_id = $message->chat->id;
$text = $message->text;
if (filter_var($text, FILTER_VALIDATE_EMAIL)) {
  $sqla = "UPDATE wptj_users SET telegramchat = ? WHERE user_email = ?;";
  $stmt = $conn->prepare($sqla);
  $stmt->bind_param("ss", $chat_id, $text);
  $stmt->execute();
  $token = '5085832702:AAEfkoomATttW-kmhVkZrHc8U3owKpm4H60';
  $text1 = 'Your Telegram account is verified now! You will receive your notifications here from now.';
  file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=$text1");
} else {
$sql = "SELECT * FROM wptj_users WHERE telegramchat = '{$chat_id}'";
$result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $token = '5085832702:AAEfkoomATttW-kmhVkZrHc8U3owKpm4H60';
    $text1 = 'Your Telegram account is verified. You may check more details here: https://mrpnl.com .';
    file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=$text1");
    } else {
  $token = '5085832702:AAEfkoomATttW-kmhVkZrHc8U3owKpm4H60';
  $text2 = 'Your Telegram account is not verified. Please insert your MR.PNL email address in order to link your Telegram with MR.PNL account.';
  file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=$text2");
}
}



 ?>
