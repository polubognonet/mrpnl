<?php


    $userid = $_SESSION['currentUser'];
    $sql = "SELECT * FROM wptj_users WHERE ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();


 ?>
