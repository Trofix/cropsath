<?php
//THIS FILE IS A PART OF CROPSATH, LICENSED UNDER GPLv3.
//MADE BY MORICZGERGO A.K.A. SKIILAA
include_once "include.php";
session_start();
if (!isset($_GET["qid"]) || strlen(trim($_GET["qid"])) == 0) {
  echo "<center><h1>Required fields are not specified.</h1><br><h2><a href=\"index.php\" class=\"btn btn-primary\">Back to homepage.</a></h2></center>";
  die();
}
session_start();

if ($_SESSION["admin"] == 0){
  echo "<center><h1>You are not allowed to do this.</h1><br><h2><a href=\"index.php\" class=\"btn btn-primary\">Back to homepage.</a></h2></center>";
  die();
}

$conn = new mysqli($config->sqlServ, $config->sqlUser, $config->sqlPass, $config->dbName);
if ($conn->connect_error){
  echo "<center><h1>Failed to connect to database.</h1><br><h2><a href=\"ask.php\" class=\"btn btn-primary\">Back to ask form.</a></h2></center>";
  echo $conn->connect_error;
  die();
}

$sql = "SELECT admin FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION["uid"]);
$result = $stmt->execute();
if ($result === FALSE) {
  echo "<center><h1>An error happened with the SQL query.</h1><h2>" . $conn->error . "</h2><br><h2><a href=\"question.php?id=" .  $_GET["qid"] . "\" class=\"btn btn-primary\">Back to question.</a></h2></center>";
  die();
}

$stmt->bind_result($admin);
$stmt->store_result();

if ($stmt->num_rows > 0) {
  $stmt->fetch();
} else {
  echo "<center><h1>You were not found.</h1><br><h2><a href=\"login.php\" class=\"btn btn-primary\">Please log in again.</a></h2></center>";
  die();
}

if ($admin == 0){
  echo "<center><h1>You are not allowed to do this.</h1><br><h2><a href=\"question.php?id=" . $_GET["qid"] . "\" class=\"btn btn-primary\">Back to question.</a></h2></center>";
  die();
}

$sql = "DELETE FROM questions WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_GET["qid"]);
$result = $stmt->execute();
if ($result === FALSE) {
  echo "<center><h1>An error happened with the SQL query.</h1><h2>" . $conn->error . "</h2><br><h2><a href=\"question.php?id=" . $_GET["qid"] . "\" class=\"btn btn-primary\">Back to ask form.</a></h2></center>";
  die();
} else {
  echo "<center><h1>Deleting successful!</h1><br><h2><a href=\"index.php\" class=\"btn btn-primary\">Back to homepage.</a></h2></center>";
}
?>
