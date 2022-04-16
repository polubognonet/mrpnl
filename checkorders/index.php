<?php

ignore_user_abort(true);
set_time_limit(0);

session_start();
$dbServername = "localhost";
$dbUsername = "mrpnebka_wordpress";
$dbPassword = "Polubognonet!";
$dbName = "mrpnebka_wordpress";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

require 'vendor/autoload.php';
$api = new Binance\API("khIlwP8nFIHdySoLeRR1uPjBGvP1LyWfSEo4pio307oc7FhgipVdmsFzw4OIb57V","AwmjVWVJgXa2TpgrWLDUUaxngM1AEIWPXJSGO9LmBPI45ZokIVyRki1Zze4fMHAr");
	/*
$balance_update = function($api, $balances) {
	echo "Balance update".PHP_EOL;
	print_r($balances);
};
*/
$pid = getmypid();
$sql = "UPDATE ordershelp SET pid = ? WHERE username = 'sororoka';";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $pid);
$stmt->execute();

$order_update = function($api, $report) {
	$orderType = $report['orderType'];
	$orderStatus = $report['orderStatus'];
	if ($orderType == "LIMIT" && $orderStatus == "FILLED") {
		$orderId = $report['orderId'];
		echo $orderId.PHP_EOL;
	}
	/*
	$price = $report['price'];
	$quantity = $report['quantity'];
	$symbol = $report['symbol'];
	$side = $report['side'];
	$orderType = $report['orderType'];
	$orderId = $report['orderId'];
	$orderStatus = $report['orderStatus'];
	$executionType = $report['orderStatus'];
	if ( $executionType == "NEW" ) {
		if ( $executionType == "REJECTED" ) {
			echo "Order Failed! Reason: {$report['rejectReason']}".PHP_EOL;
		}
		echo "{$symbol} {$side} {$orderType} ORDER #{$orderId} ({$orderStatus})".PHP_EOL;
		echo "..price: {$price}, quantity: {$quantity}".PHP_EOL;
		return;
	}
	//NEW, CANCELED, REPLACED, REJECTED, TRADE, EXPIRED
	echo "{$symbol} {$side} {$executionType} {$orderType} ORDER #{$orderId}".PHP_EOL;
 if ( $orderStatus == "FILLED" && $orderType == "LIMIT" ) {
	 echo "dalbajobu";
	 $usernamik = "sororoka";
	 $orderidd = $orderId;
	 $sql_u = "SELECT * FROM orders WHERE username='sororoka'";
		 $result = $conn->query($sql_u);
		 if ($result->num_rows > 0) {
			 while($row = $result->fetch_assoc()) {
				 echo $row;
				 print_r($row);
				 if ($arrayresult['orderId'] == $orderidd) {
					 $sql_a = "SELECT * FROM ordershelp WHERE username ='sororoka'";
 					  $result = $conn->query($sql_a);
 					  if ($result->num_rows > 0) {
 					    while($row = $result->fetch_assoc()) {
								$newtotalqt = $row['totalqt'] + $quantity;
								$sql = "UPDATE ordershelp SET totalqt = ? WHERE username = 'sororoka';";
								$stmt = $conn->prepare($sql);
								$stmt->bind_param("s", $newtotalqt);
								$stmt->execute();
								echo "order filled";
		 }
		}
	 }


 }
}
}
*/
};
$api->userData($balance_update, $order_update);
//

 ?>
