<?php
//THIS FILE IS A PART OF CROPSATH, LICENSED UNDER GPLv3.
//MADE BY MORICZGERGO A.K.A. SKIILAA
include_once "include.php";
session_start();
if (!isset($_POST["username"]) || !isset($_POST["password"]) || !isset($_POST["email"]) || strlen(trim($_POST["username"])) == 0 || strlen(trim($_POST["password"])) == 0 || strlen(trim($_POST["email"])) == 0) {
  echo "<center><h1>" . $langfile->req_field_err . "</h1><br><h2><a href=\"register.php\" class=\"btn btn-primary\">" . $langfile->back_to_reg . "</a></h2></center>";
  die();
}
session_start();
$conn = new mysqli($config->sqlServ, $config->sqlUser, $config->sqlPass, $config->dbName);
if ($conn->connect_error){
  echo "<center><h1>" . $langfile->db_conn_fail . "</h1><br><h2><a href=\"register.php\" class=\"btn btn-primary\">" . $langfile->back_to_reg . "</a></h2></center>";
  echo $conn->connect_error;
  die();
}
$sql = "INSERT INTO users (username, password, email, banned, admin) VALUES (?, ?, ?, 0, 0)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT), $_POST["email"]);
$result = $stmt->execute();
if ($result === FALSE) {
  echo "<center><h1>" . $langfile->sql_query_error . "</h1><h2>" . $conn->error . "</h2><br><h2><a href=\"register.php\" class=\"btn btn-primary\">" . $langfile->back_to_reg . "</a></h2></center>";
  die();
} else {
  echo "<center><h1>" . $langfile->reg_success . "</h1><br><h2><a href=\"login.php\" class=\"btn btn-primary\">" . $langfile->go_to_log . ".</a></h2></center>";
}
?>
