<?php
//THIS FILE IS A PART OF CROPSATH, LICENSED UNDER GPLv3.
//MADE BY MORICZGERGO A.K.A. SKIILAA

include_once "include.php";
?>

<html>
  <body>
    <center>
      <form action="ask_backplane.php" method="POST">
        <p><?php echo $langfile->q_name; ?></p>
        <input type="text" name="qname">
        <p><?php echo $langfile->q_text; ?></p>
        <textarea name="qtext" cols="100" rows="5"></textarea>
        <br><br>
        <input type="submit" name="submit" value="<?php echo $langfile->ask; ?>" class="btn btn-primary">
      </form>
    </center>
  </body>
</html>
