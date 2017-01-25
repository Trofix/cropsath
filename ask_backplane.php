<?php
//THIS FILE IS A PART OF CROPSATH, LICENSED UNDER GPLv3.
//MADE BY MORICZGERGO A.K.A. SKIILAA
include_once "include.php";
session_start();
if (!isset($_POST["qname"]) || !isset($_POST["qtext"]) || strlen(trim($_POST["qname"])) == 0 || strlen(trim($_POST["qtext"])) == 0) {
  echo "<center><h1>Required fields are not specified.</h1></center>";
  die();
}
session_start();
$conn = new mysqli($config->sqlServ, $config->sqlUser, $config->sqlPass, $config->dbName);
if ($conn->connect_error){
  echo "<center><h1>Failed to connect to database.</h1></center>";
  echo $conn->connect_error;
  die();
}
$sql = "INSERT INTO questions (questionName, questionText) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $_POST["qname"], $_POST["qtext"]);
$result = $stmt->execute();
if ($result === FALSE) {
  echo "<center><h1>An error happened with the SQL query.</h1><h2>" . $conn->error . "</h2></center>";
  die();
} else {
  echo "<center><h1>Asking successful!</h1></center>";
}
?>
