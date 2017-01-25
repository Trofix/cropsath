<?php
//THIS FILE IS A PART OF CROPSATH, LICENSED UNDER GPLv3.
//MADE BY MORICZGERGO A.K.A. SKIILAA

include_once "include.php";

session_start();

if (!isset($_POST["username"]) || !isset($_POST["password"]) || strlen(trim($_POST["username"])) == 0 || strlen(trim($_POST["password"])) == 0) {
  echo "<center><h1>" . $langfile->req_field_err . "</h1><br><h2><a href=\"login.php\" class=\"btn btn-primary\">" . $langfile->back_to_log . "</a></h2></center>";
  die();
}

session_start();
$conn = new mysqli($config->sqlServ, $config->sqlUser, $config->sqlPass, $config->dbName);
if ($conn->connect_error){
  echo "<center><h1>" . $langfile->db_conn_fail . "</h1><br><h2><a href=\"login.php\" class=\"btn btn-primary\">" . $langfile->back_to_log . "</a></h2></center>";
  echo $conn->connect_error;
  die();
}
$sql = "SELECT id, password, admin FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_POST["username"]);
$result = $stmt->execute();
if ($result === FALSE) {
  echo "<center><h1>" . $langfile->sql_query_error . "</h1><h2>" . $conn->error . "</h2><br><h2><a href=\"login.php\" class=\"btn btn-primary\">" . $langfile->back_to_log . "</a></h2></center>";
  die();
}
$stmt->bind_result($id, $password, $admin);
$stmt->store_result();
if ($stmt->num_rows == 1){
  $stmt->fetch();
  if (!password_verify($_POST["password"] , $password)){
    echo "<center><h1>" . $langfile->pass_err . "</h1><br><h2><a href=\"login.php\" class=\"btn btn-primary\">" . $langfile->back_to_log . "</a></h2></center>";
    die();
  }
  $_SESSION["uid"] = $id;
  $_SESSION["uname"] = $_POST["username"];
  $_SESSION["admin"] = $admin;
  echo "<center><h1>" . $langfile->log_success . "</h1><br><h2><a href=\"index.php\" class=\"btn btn-primary\">" . $langfile->back_to_home . "</a></h2></center>";
} else {
  if ($stmt->num_rows == 0){
    echo "<center><h1>" . $langfile->user_not_found . "</h1><br><h2><a href=\"login.php\" class=\"btn btn-primary\">" . $langfile->back_to_login . "</a></h2></center>";
  } else {
    echo "<center><h1>" . $langfile->unx_err . "</h1><h2>" . $langfile->code . " multiple_users</h2><h2><a href=\"login.php\">" . $langfile->back_to_login . "</a></h2></center>";
  }
  die();
}
?>
