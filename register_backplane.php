<?php
//THIS FILE IS A PART OF CROPSATH, LICENSED UNDER GPLv3.
//MADE BY MORICZGERGO A.K.A. SKIILAA
include_once "include.php";
session_start();
if (!isset($_POST["username"]) || !isset($_POST["password"]) || !isset($_POST["email"]) || strlen(trim($_POST["username"])) == 0 || strlen(trim($_POST["password"])) == 0 || strlen(trim($_POST["email"])) == 0) {
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
$sql = "INSERT INTO users (username, password, email, banned, admin) VALUES (?, ?, ?, 0, 0)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT), $_POST["email"]);
$result = $stmt->execute();
if ($result === FALSE) {
  echo "<center><h1>An error happened with the SQL query.</h1><h2>" . $conn->error . "</h2></center>";
  die();
} else {
  echo "<center><h1>Registration successful!</h1></center>";
}
?>
