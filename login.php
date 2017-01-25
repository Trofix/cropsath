<?php
//THIS FILE IS A PART OF CROPSATH, LICENSED UNDER GPLv3.
//MADE BY MORICZGERGO A.K.A. SKIILAA

include_once "include.php";
?>

<html>
  <body>
    <center>
      <form action="login_backplane.php" method="POST">
        <p><?php echo $langfile->username; ?></p>
        <input type="text" name="username" required>
        <p><?php echo $langfile->password; ?></p>
        <input type="password" name="password" required>
        <br><br>
        <input type="submit" name="submit" value="<?php echo $langfile->login; ?>" class="btn btn-primary">
      </form>
    </center>
  </body>
</html>
