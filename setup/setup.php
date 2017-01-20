<?php
//THIS FILE IS A PART OF CROPSATH, LICENSED UNDER GPLV3
//MADE BY MORICZGERGO
//CREATED: 2017.01.20
//LAST MODIFIED: 2017.01.20

$config = json_decode(file_get_contents('../config.json'));


// Check if json_decode could decode that JSON file.
if ($config === NULL) {
    echo "<center><h1>Your config.json file is not valid. Please test your file with an online JSON linter.</h1></center>";
    die();
}

// Check if allowedSetupIP is set to a normal IP
if (!isset($config->allowedSetupIP) || $config->allowedSetupIP == "enter setup client ip here"){
    echo "<center><h1>You haven't configured Cropsath properly. Please specify all the values in config.php.</h1></center>";
    die();
}

// Check if client IP is not contained in allowedSetupIP
if ($allowedSetupIP == $_SERVER['REMOTE_ADDR']){
    echo "<center><h1>You are not allowed to view this page.</h1></center>";
    die();
}
