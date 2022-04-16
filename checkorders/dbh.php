<?php

$dbServername = "199.188.200.15";
$dbUsername = "mrpnebka_wordpress";
$dbPassword = "Polubognonet!";
$dbName = "mrpnebka_wordpress";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if(!$conn){
        die ("Connection Terminated! by Die() function". mysqLi_connect_error());

    }
    else {
        echo "Connection Succefully Happened! <br>";
    }


 ?>
