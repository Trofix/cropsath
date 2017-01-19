<?php
//THIS FILE IS A PART OF CROPSATH, LICENSED UNDER GPLV3
//MADE BY MORICZGERGO
//CREATED: 2017.01.19
//LAST EDITED: 2017.01.19
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cropsath Setup</title>
    </head>
    <body>
        <center>
            <h1>Cropsath Setup</h1>
            <hr>
            <form action="setup.php" method="POST">
                <p>MYSQL Database ROOT password:</p>
                <input type="password" name="myroot">
                <p>Cropsath Page Name:</p>
                <input type="text" name="pagename">
                <p>Admin username:</p>
                <input type="text" name="adminname">
                <p>Admin password:</p>
                <input type="password" name="adminpwd">
                <br>
                <input type="submit" name="submit" value="Finish Setup">
            </form>
        </center>
    </body>
</html>
