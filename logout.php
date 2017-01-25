<?php
//THIS FILE IS A PART OF CROPSATH, LICENSED UNDER GPLv3.
//MADE BY MORICZGERGO A.K.A. SKIILAA

include_once "include.php";

session_start();

$_SESSION = array();

session_destroy();

echo "<center><h1>You have been logged out.</h1></center>";
?>
