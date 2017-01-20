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

if (!isset($_POST['myroot']) && !isset($_POST['adminname']) && !isset($_POST['adminpwd']) && !isset($_POST['pagename'])) {
    echo "<center><h1>You didn't fill all the required fields.</h1></center>";
    die();
}

if (!strlen(trim($_POST['myroot'])) > 0 && !strlen(trim($_POST['adminname'])) > 0 && !strlen(trim($_POST['adminpwd'])) > 0 && !strlen(trim($_POST['pagename'])) > 0 ){
    echo "<center><h1>You didn't fill all the required fields.</h1></center>";
    die();
}

$myroot = $_POST['myroot'];
$adminname = $_POST['adminname'];
$adminpwd = $_POST['adminpwd'];
$pagename = $_POST['pagename'];

$config->pagename = $pagename;

$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
$pass = array(); //remember to declare $pass as an array
$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
for ($i = 0; $i < 8; $i++) {
    $n = rand(0, $alphaLength);
    $pass[] = $alphabet[$n];
}

$gameBoardPass = implode($pass); //turn the array into a string

$config->gameBoardPass = $gameBoardPass;

if (!isset($config->databaseIP) || $config == "Insert MYSQL server IP here"){
    echo "<center><h1>You haven't configured Cropsath properly. Please specify all the values in config.json.</h1></center>";
    die();
}

$conn = new mysqli($config->databaseIP, "root", $myroot);

if($conn->connect_error){
    echo "<center><h1>Failed to connect to MYSQL server:</h1><p>";
    echo $conn->connect_error;
    echo "</p></center>";
    die();
}

$sql = "CREATE USER ? IDENTIFIED BY ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $pagename, $gameBoardPass);
$stmt->execute();
