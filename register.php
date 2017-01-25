<?php
//THIS FILE IS A PART OF CROPSATH, LICENSED UNDER GPLv3.
//MADE BY MORICZGERGO A.K.A. SKIILAA
include_once "include.php";
?>

<html>
  <body>
    <center>
      <form action="register_backplane.php" method="POST">
        <p>Username:</p>
        <input type="text" name="username" required>
        <p>Password:</p>
        <input type="password" name="password" required>
        <p>E-mail address:</p>
        <input type="text" name="email" required>
        <br>
        <input type="submit" name="submit" value="Register" class="btn btn-primary">
      </form>
    </center>
  </body>
</html>
