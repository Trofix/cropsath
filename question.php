<?php
//THIS FILE IS A PART OF CROPSATH, LICENSED UNDER GPLv3.
//MADE BY MORICZGERGO A.K.A. SKIILAA

include_once "include.php";

if (!isset($_GET["id"])) {
  echo "<center><h1>Question not specified.</h1></center>";
  die();
}

session_start();

$conn = new mysqli($config->sqlServ, $config->sqlUser, $config->sqlPass, $config->dbName);

if ($conn->connect_error){
  echo "<center><h1>Failed to connect to database.</h1></center>";
  echo $conn->connect_error;
  die();
}

$sql = "SELECT questionName, questionText, comments FROM questions WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_GET["id"]);
$result = $stmt->execute();

if ($result === FALSE) {
  echo "<center><h1>An error happened with the SQL query.</h1><h2>" . $conn->error . "</h2></center>";
  die();
}

$stmt->bind_result($questionName, $questionText, $comments);
$stmt->store_result();

if ($stmt->num_rows == 1){
  $stmt->fetch();
  echo "<center>";
  //This is a temporary design
  echo "<h1>" . $questionName . "</h1>";
  echo "<br>";
  echo "<p>" . nl2br($questionText) . "</p>";
  $commentObject = json_decode($comments);
  
  if($commentObject === NULL){
    echo "<h2>No comments found.</h2>";
  } else {
    echo "<h3>Comments:</h3>";
  }
  
  echo "<br>";
  
  foreach ($commentObject->comments as $comment) {
    echo "<p>" . $comment->user . " - " . $comment->text . "</p>";
  }
  
  if (!isset($_SESSION["uname"]) && !isset($_SESSION["uid"]) && !isset($_SESSION["admin"]) && strlen(trim($_SESSION["uname"])) == 0 && strlen(trim($_SESSION["uid"])) == 0) {
    echo "<br>";
    echo "<a href=\"qdel.php?id=" . $_GET["id"] . "\" class=\"btn btn-danger\">Delete</a>";
  }
  
  echo "<br>";
  
  echo "<form action=\"addcomment.php\" method=\"POST\"><input type=\"hidden\" name=\"id\" value=\"" . $_GET["id"] . "\"><input type=\"text\" name=\"comment\" value=\"Enter comment here...\"><br><input type=\"submit\" value=\"Comment\"></form>";
  
  echo "</center>";
} else {
  if ($stmt->num_rows == 0){
    echo "<center><h1>Question not found.</h1></center>";
  } else {
    echo "<center><h1>An unexpected error happened.</h1><h2>Code: multiple_questions</h2></center>";
  }
  die();
}
?>
