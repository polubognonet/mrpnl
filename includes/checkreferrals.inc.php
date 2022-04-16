<?php


$userreferal = $user['referralcode'];
$dataref=array();
$total=0;
$sql = "SELECT * FROM wptj_usermeta WHERE meta_value=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userreferal);
$stmt->execute();
$result = $stmt->get_result();
while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        foreach ($row as $r) {
            if ($r==$userreferal) {
              $total = $total+1;
            }
        }
    }

$sql = "UPDATE wptj_users SET referral_num = ? WHERE ID = ?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $total, $userid);
$stmt->execute();



/*

$userreferal = $user['referralcode'];
$dataref=array();
$total=0;
$sql = "SELECT * FROM wptj_usermeta WHERE meta_value=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userreferal);
$stmt->execute();
$result = $stmt->get_result();
while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        foreach ($row as $r) {
            if ($r==$userreferal) {
              $total = $total+1;
            }
        }
    }

$sql = "UPDATE wptj_users SET referral_num = ? WHERE ID = ?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $total, $userid);
$stmt->execute();

*/



 ?>
