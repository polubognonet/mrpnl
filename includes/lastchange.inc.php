<?php


$lastchange = 0;
$sql_u = "SELECT * FROM wptj_users WHERE ID ='1'";
  $result = $conn->query($sql_u);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $lastchange = $row["lastchange"];
    }
    $sql_a = "SELECT * FROM wptj_users";
    $result = $conn->query($sql_a);
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
      $useridnew = $row["ID"];
      $sql = "UPDATE wptj_users SET lastchange = ? WHERE ID = ?;";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("si", $lastchange, $useridnew);
      $stmt->execute();
      mysqli_stmt_close($stmt);
    }
}
}

 ?>
