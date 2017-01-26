<?php
//THIS FILE IS A PART OF CROPSATH, LICENSED UNDER GPLv3.
//MADE BY MORICZGERGO A.K.A. SKIILAA
include_once "include.php";

if (!isset($_GET["id"])) {
  echo "<center><h1>" . $langfile->q_not_spec . "</h1></center>";
  die();
}
session_start();
$conn = new mysqli($config->sqlServ, $config->sqlUser, $config->sqlPass, $config->dbName);
if ($conn->connect_error){
  echo "<center><h1>" . $langfile->db_conn_fail . "</h1></center>";
  echo $conn->connect_error;
  die();
}
$sql = "SELECT questionName, questionText FROM questions WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_GET["id"]);
$result = $stmt->execute();
if ($result === FALSE) {
  echo "<center><h1>" . $langfile->sql_query_error . "</h1><h2>" . $conn->error . "</h2></center>";
  die();
}
$stmt->bind_result($questionName, $questionText);
$stmt->store_result();
if ($stmt->num_rows == 1){
  $stmt->fetch();
?>
<html>
  <body>
    <center>
      <form action="qedit_backplane.php" method="POST">
        <input type="hidden" name="qid" value="<?php echo $_GET["id"]; ?>">
        <p><?php echo $langfile->q_name; ?></p>
        <input type="text" name="qname" value="<?php echo $questionName; ?>">
        <p><?php echo $langfile->q_name; ?></p>
        <textarea name="qtext" cols="100" rows="5"><?php echo $questionText; ?></textarea>
        <br><br>
        <input type="submit" name="submit" value="<?php echo $langfile->edit; ?>" class="btn btn-primary">
      </form>
    </center>
  </body>
</html>
<?php
} else {
  if ($stmt->num_rows == 0){
    echo "<center><h1>" . $langfile->q_not_found . "</h1></center>";
  } else {
    echo "<center><h1>" . $langfile->unx_err . "</h1><h2>" . $langfile->code . " multiple_questions</h2></center>";
  }
  die();
}
?>
