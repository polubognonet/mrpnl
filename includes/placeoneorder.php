<?php


require 'vendor/autoload.php';
$api = new Binance\API("khIlwP8nFIHdySoLeRR1uPjBGvP1LyWfSEo4pio307oc7FhgipVdmsFzw4OIb57V","AwmjVWVJgXa2TpgrWLDUUaxngM1AEIWPXJSGO9LmBPI45ZokIVyRki1Zze4fMHAr");

$quantity = 0.1;
$price = 120;
$order = $api->buy("SOLBUSD", $quantity, $price);

$finalorder = serialize($order);
$sql = "UPDATE orders SET order1 = ? WHERE username = 'sororoka';";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $finalorder);
$stmt->execute();
mysqli_stmt_close($stmt);

 ?>
