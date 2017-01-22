<?php
//THIS FILE IS A PART OF CROPSATH, LICENSED UNDER GPLv3.
//MADE BY MORICZGERGO A.K.A. SKIILAA
//CREATED: 2017.01.22.
//LAST MODIFIED: 2017.01.22.

include_once "include.php";

$conn = new mysqli($config->sqlServ, $config->sqlUser, $config->sqlPass, $config->dbName);

if ($conn->connect_error){
  echo "<center><h1>Failed to connect to database.</h1></center>";
  echo $conn->connect_error;
  die();
}

$sql = "SELECT questionName FROM questions ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0){
  echo "<div style=\"width:100%;\">";
  //output data of each row in bootstrap cards
  while($row = $result->fetch_assoc()) {
    echo "<div class=\"card\" style=\"width: 20rem; display: table-cell;\"><div class=\"card-block\"><h4 class=\"card-text\">" . $row["questionName"] . "</h4></div></div><br class=\"rwd-break\">";
  }
  echo "</div>";
} else {
  echo "<center><h1>No questions found.</h1></center>";
}
?>
