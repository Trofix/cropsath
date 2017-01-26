<?php
//THIS FILE IS A PART OF CROPSATH, LICENSED UNDER GPLv3.
//MADE BY MORICZGERGO A.K.A. SKIILAA
//CREATED: 2017.01.22.
//LAST MODIFIED: 2017.01.22.

include_once "include.php";

$conn = new mysqli($config->sqlServ, $config->sqlUser, $config->sqlPass, $config->dbName);

if ($conn->connect_error){
  echo "<center><h1>" . $langfile->db_conn_fail . "</h1></center>";
  echo $conn->connect_error;
  die();
}

$sql = "SELECT questionName, id FROM questions ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0){
  echo "<center>";
  //output data of each row in bootstrap cards
  $breakIndex = 1;
  while($row = $result->fetch_assoc()) {
    echo "<a href=\"question.php?id=" . $row["id"] . "\"><div class=\"card\" style=\"width: 20rem; display: table-cell;\"><div class=\"card-block\"><h4 class=\"card-text\">" . $row["questionName"] . "</h4></div></div></a>";
    $breakIndex++;
    if ($breakIndex == 6) { // "responsivity"
      echo "<br>";
      $breakIndex = 1;
    }
  }
  echo "</center>";
} else {
  echo "<center><h1>" . $langfile->no_q . "</h1></center>";
}
?>
