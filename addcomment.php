<?php
//THIS FILE IS A PART OF CROPSATH, LICENSED UNDER GPLv3.
//MADE BY MORICZGERGO A.K.A. SKIILAA

include_once "include.php";

session_start();

//Check if user is logged in
if (!isset($_SESSION["uname"]) && !isset($_SESSION["uid"]) && strlen(trim($_SESSION["uname"])) == 0 && strlen(trim($_SESSION["uid"])) == 0) {
  echo "<center><h1>" . $langfile->not_log . "</h1></center>";
  die();
}

//Check if needed vars are specified
if (!isset($_POST["id"]) && !isset($_POST["comment"]) && strlen(trim($_POST["id"])) && strlen(trim($_POST["comment"]))) {
  echo "<center><h1>" . $langfile->req_field_err . "</h1></center>";
  die();
}

//Init MYSQLi
$conn = new mysqli($config->sqlServ, $config->sqlUser, $config->sqlPass, $config->dbName);
if ($conn->connect_error){
  echo "<center><h1>" . $langfile->db_conn_fail . "</h1></center>";
  echo $conn->connect_error;
  die();
}

//Select comments
$sql = "SELECT comments FROM questions WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_POST["id"]);
$result = $stmt->execute();

if ($result === FALSE) {
  echo "<center><h1>" . $langfile->sql_query_error . "</h1><h2>" . $conn->error . "</h2></center>";
  die();
}

$stmt->bind_result($comments);
$stmt->store_result();

if ($stmt->num_rows == 1){
  //Fetch results
  $stmt->fetch();
  
  //Decode JSON
  $commentObject = json_decode($comments);
  
  //If JSON decode failed, create false commentObject
  if($commentObject === NULL){
    $commentObject = (object)array("comments" => array());
  }
  
  $commentsArray = $commentObject->comments;
  
  $newArray = array("user" => $_SESSION["uname"], "id" => $_SESSION["uid"], "text" => $_POST["comment"]);
  
  array_push($commentsArray, $newArray);
  
  $commentObject->comments = $commentsArray;
  
  $newComments = json_encode($commentObject);
  
  //New SQL for updating comments
  $sql = "UPDATE questions SET comments = ? WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $newComments, $_POST["id"]);
  $result = $stmt->execute();
  
  //Error checking
  if ($result === FALSE) {
    echo "<center><h1>" . $langfile->sql_query_error . "</h1><h2>" . $conn->error . "</h2></center>";
    die();
  } else {
    echo "<center><h1>" . $langfile->comm_success . "</h1></center>";
  }
} else {
  if ($stmt->num_rows == 0){
    echo "<center><h1>" . $langfile->q_not_found . "</h1></center>";
  } else {
    echo "<center><h1>" . $langfile->unx_err . "</h1><h2>" . $langfile->code . " multiple_questions</h2></center>";
  }
  die();
}
?>
