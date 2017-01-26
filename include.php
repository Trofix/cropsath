<?php
//THIS FILE IS A PART OF CROPSATH, LICENSED UNDER GPLv3.
//MADE BY MORICZGERGO A.K.A. SKIILAA
//CREATED: 2017.01.21.
//LAST MODIFIED: 2017.01.21.

$config = json_decode(file_get_contents("config.json"));

$langfile = json_decode(file_get_contents("lang/" . $config->langfile));

session_start();
?>
<html>
    <head>
       <meta charset="UTF-8">
       <title><?php echo $config->pageName ?></title>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    </head>
    <body>
        <style>
            .responsive-thingy {
                word-wrap: break-word;
            }
        </style>
        <div class="header">
           <center>
               <a href="index.php"><img src="logo.png"></a>
               <p>
               <?php if (!isset($_SESSION["uname"]) && !isset($_SESSION["uid"]) && !isset($_SESSION["admin"]) && strlen(trim($_SESSION["uname"])) == 0 && strlen(trim($_SESSION["uid"])) == 0) { ?>
                <a href="login.php" class="btn btn-warning"><?php echo $langfile->login; ?></a> <a href="register.php" class="btn btn-success"><?php echo $langfile->register; ?></a>
               <?php } else { ?>
                <?php if ($_SESSION["admin"] == 1) { ?>
                     <a href="ask.php" class="btn btn-primary"><?php echo $langfile->ask_question; ?></a> 
                <?php } ?>
                <a href="logout.php" class="btn btn-danger"><?php echo $langfile->logout; ?></a>
               <?php } ?>
               </p>
               <hr>
           </center>
        </div>
        
        <!-- BOOTSTRAP 4 !-->
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    </body>
</html>
