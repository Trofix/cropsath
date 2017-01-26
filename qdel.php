<?php
//THIS FILE IS A PART OF CROPSATH, LICENSED UNDER GPLv3.
//MADE BY MORICZGERGO A.K.A. SKIILAA
include_once "include.php";
session_start();
if (!isset($_GET["qid"]) || strlen(trim($_GET["qid"])) == 0) {
  echo "<center><h1>" . $langfile->req_field_err . "</h1><br><h2><a href=\"index.php\" class=\"btn btn-primary\">" . $langfile->back_to_home . "</a></h2></center>";
  die();
}
session_start();

if ($_SESSION["admin"] == 0){
  echo "<center><h1>" . $langfile->no_perm . "</h1><br><h2><a href=\"index.php\" class=\"btn btn-primary\">" . $langfile->back_to_home . "</a></h2></center>";
  die();
}

$conn = new mysqli($config->sqlServ, $config->sqlUser, $config->sqlPass, $config->dbName);
if ($conn->connect_error){
  echo "<center><h1>Failed to connect to database.</h1><br><h2><a href=\"question.php?id=" . $_GET["qid"] . "\" class=\"btn btn-primary\">" . $langfile->back_to_q . "</a></h2></center>";
  echo $conn->connect_error;
  die();
}

$sql = "SELECT admin FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION["uid"]);
$result = $stmt->execute();
if ($result === FALSE) {
  echo "<center><h1>" . $langfile->sql_query_error . "</h1><h2>" . $conn->error . "</h2><br><h2><a href=\"question.php?id=" .  $_GET["qid"] . "\" class=\"btn btn-primary\">" . $langfile->back_to_q . "</a></h2></center>";
  die();
}

$stmt->bind_result($admin);
$stmt->store_result();

if ($stmt->num_rows > 0) {
  $stmt->fetch();
} else {
  echo "<center><h1>" . $langfile->you_nf . "</h1><br><h2><a href=\"login.php\" class=\"btn btn-primary\">" . $langfile->relog . "</a></h2></center>";
  die();
}

if ($admin == 0){
  echo "<center><h1>" . $langfile->no_perm . "</h1><br><h2><a href=\"question.php?id=" . $_GET["qid"] . "\" class=\"btn btn-primary\">" . $langfile->back_to_q . "</a></h2></center>";
  die();
}

$sql = "DELETE FROM questions WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_GET["qid"]);
$result = $stmt->execute();
if ($result === FALSE) {
  echo "<center><h1>" . $langfile->sql_query_error . "</h1><h2>" . $conn->error . "</h2><br><h2><a href=\"question.php?id=" . $_GET["qid"] . "\" class=\"btn btn-primary\">Back to ask form.</a></h2></center>";
  die();
} else {
  echo "<center><h1>" . $langfile->delete_success . "</h1><br><h2><a href=\"index.php\" class=\"btn btn-primary\">" . $langfile->back_to_home . "</a></h2></center>";
}
?>
