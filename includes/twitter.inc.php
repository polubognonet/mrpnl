<?php


$sql_a = "SELECT * FROM twitterposts WHERE ID = `1`";
  $result = $conn->query($sql_a);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $date1 = $row['date'];
      $subject1 = $row['subject'];
    }
  }
 ?>
