<?php
//THIS FILE IS A PART OF CROPSATH, LICENSED UNDER GPLv3.
//MADE BY MORICZGERGO A.K.A. SKIILAA
//CREATED: 2017.01.22.
//LAST MODIFIED: 2017.01.22.

include_once "include.php";
?>

<html>
  <body>
    <center>
      <form action="search_backplane.php" method="GET">
        <p><?php echo $langfile->query; ?></p>
        <input type="text" name="q">
        <br><br>
        <input type="submit" name="submit" value="<?php echo $langfile->search; ?>" class="btn btn-primary">
      </form>
    </center>
  </body>
</html>
