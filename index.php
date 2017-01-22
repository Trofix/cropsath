<?php
//THIS FILE IS A PART OF CROPSATH, LICENSED UNDER GPLv3.
//MADE BY MORICZGERGO A.K.A. SKIILAA
//CREATED: 2017.01.22.
//LAST MODIFIED: 2017.01.22.

include_once "include.php";

$conn = new mysqli($config->sqlserv, $config->sqluser, $config->sqlpass, $config->dbName);

if ($conn->connecterror){
  echo "<center><h1>Failed to connect to database.</h1></center>";
  die();
}

$sql = "SELECT questionName FROM questions ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0){
  //output data of each row in bootstrap cards
  while($row = $result->fetch_assoc()) {
    echo "<div class=\"card\"><div class=\"card-block\"><h4 class=\"card-text\">" . $row["questionName"] . "</h4></div></div>";
  }
} else {
  echo "<center><h1>No questions found.</h1></center>";
}
?>
