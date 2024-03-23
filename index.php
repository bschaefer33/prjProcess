<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- index.php - Displays information to the customers
    Class: CSC 235 Server Side Development
    Week 4: prjProcess
    Student Name: Brittany Schaefer
    Written: 4/6/22
    Revised: 4/27/22 BS
    -->
    <link rel="stylesheet" href= "style.css">
    <title>User Page</title>
<?php
    //set up connection constants
    //forlocalhost and bluehost

    //Is this localhost or bluehost
    $whitelist = array('127.0.0.1','::1');

    if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){ 
        // Credentials for localhost
        define("SERVER_NAME","localhost");
        define("DBF_USER_NAME","root");
        define("DBF_PASSWORD", "mysql");
        define("DATABASE_NAME","prjProcess");
    } else {
        // credentials for BLuehost server 
        define("SERVER_NAME","localhost");
        define("DBF_USER_NAME","dsemachi_Brittany");
        define("DBF_PASSWORD", "#database333");
        define("DATABASE_NAME","dsemachi_prjProcess");
    }
    //connection object
    global $conn;
    //connect to library
    require_once(getcwd( ) . "/prjProcessLib.php");
    //create connection
    createConnection();
?>
</head>
<body> 
    <header id="finalHeader">
        <div id="headLogo">
            <h1>Auntie B's</h1>
        </div>
        <div id="headNav">
            <a href="presentation.php">Home</a>
            <a href="index.php">User View</a>
            <a href="edit.php">Edit Page</a>
            <a href="proofOfConcept.php">Proof Of Concept</a>
        </div>
    </header>
    <h1>Menu</h1>
    <div id="displayMenu">
        <div id="columnOne">
            <div id="soupMenu">
                <h1>Soup</h1>
                <?php userDisplay(1); ?>
            </div>
            <div id="saladMenu">
                <h1>Salad</h1>
                <?php userDisplay(2); ?>
            </div>
        </div>
        <div id="columnTwo">
            <div id="entreeMenu">
                <h1>Entree</h1>
                <?php userDisplay(3); ?>
            </div>
            <div id="dessertMenu">
                <h1>Dessert</h1>
                <?php userDisplay(4); ?>
            </div>
        </div>
    </div>

</body>
</html>