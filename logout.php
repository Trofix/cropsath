<?php
//THIS FILE IS A PART OF CROPSATH, LICENSED UNDER GPLv3.
//MADE BY MORICZGERGO A.K.A. SKIILAA

include_once "include.php";

session_start();

$_SESSION = array();

session_destroy();

echo "<center><h1>" . $langfile->logout_success . "</h1><br><h2><a href=\"index.php\" class=\"btn btn-primary\">" . $langfile->back_to_home . "</a></h2></center>";
?>
