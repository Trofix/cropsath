<?php
//THIS FILE IS A PART OF CROPSATH, LICENSED UNDER GPLv3.
//MADE BY MORICZGERGO A.K.A. SKIILAA

include_once "include.php";

session_start();

if (!isset($_POST["username"]) || !isset($_POST["username"]) || strlen(trim($_POST["username"])) == 0 || strlen(trim($_POST["password"])) == 0) {
  echo "<center><h1>Required fields not specified.</h1></center>";
  die();
}

session_start();
$conn = new mysqli($config->sqlServ, $config->sqlUser, $config->sqlPass, $config->dbName);
if ($conn->connect_error){
  echo "<center><h1>Failed to connect to database.</h1></center>";
  echo $conn->connect_error;
  die();
}
$sql = "SELECT id, password, admin FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_POST["username"]);
$result = $stmt->execute();
if ($result === FALSE) {
  echo "<center><h1>An error happened with the SQL query.</h1><h2>" . $conn->error . "</h2></center>";
  die();
}
$stmt->bind_result($id, $password, $admin);
$stmt->store_result();
if ($stmt->num_rows == 1){
  $stmt->fetch();
  if (!password_verify($_POST["password"] , $password)){
    echo "<center><h1>Wrong password.</h1></center>";
    die();
  }
  $_SESSION["uid"] = $id;
  $_SESSION["uname"] = $_POST["username"];
  $_SESSION["admin"] = $admin;
  echo "<center><h1>Login successful!</h1></center>";
} else {
  if ($stmt->num_rows == 0){
    echo "<center><h1>User not found.</h1></center>";
  } else {
    echo "<center><h1>An unexpected error happened.</h1><h2>Code: multiple_users</h2></center>";
  }
  die();
}
?>
