<?php

require_once 'vendor/autoload.php';
$api = new Binance\API("XCLEsx8ZKh5Dy3oDUlTW7K1UB3ShvUsnYSGMPrpFQK44QZ3I1DPcbh27IBc0v4MI", "skXCO4C9HMNpAGj2szTHJwD1SnG8HOqG3J4LRHe9k1LxW8CoTle5JMDHXU7wngZb");

$orderstatus = $api->orderStatus("LUNABUSD", $orderrr);
