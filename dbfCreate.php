<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
<!-- dbfCreate.php - Createa a database
  Class: CSC 235 Server Side Development
  Week 4: prjProcess
  Student Name: Brittany Schaefer
  Written: 4/6/22
  Revised: 4/27/22 BS
-->
    <link rel="stylesheet" href= "style.css">
    <title>Week 4 Project</title>
</head>
<body> 
<?php
/****************************************
* Create Database connections
****************************************/
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

    //create connection object
    $conn=new mysqli(SERVER_NAME, DBF_USER_NAME, DBF_PASSWORD);
    //check connection
    if($conn->connect_error) {
        die("Connection failed: ".$conn->connect_error);
    }

    //Start with new database
    $sql="Drop Database " . DATABASE_NAME;
    runQuery($sql, "DROP " . DATABASE_NAME, false);

    //create database if is doesn't exist
    $sql = "CREATE DATABASE IF NOT EXISTS ". DATABASE_NAME;
    if ($conn->query($sql) === TRUE) {
        
    } else {
        echo "Error creating database " . DATABASE_NAME . ": " . $conn->error;
        echo "<br />";
    }
    
    //select the database
    $conn->select_db(DATABASE_NAME);

    /******* Create the Tables******************/
    $sql= "CREATE TABLE IF NOT EXISTS foodType (
        foodType_ID INT AUTO_INCREMENT PRIMARY KEY,
        foodTypeName VARCHAR(45) NOT NULL
        )";
    runQuery($sql,"Creating foodType", false);

    $sql = "CREATE TABLE IF NOT EXISTS item (
        item_ID INT AUTO_INCREMENT PRIMARY KEY,
        itemName VARCHAR(20) NOT NULL,
        itemDescription VARCHAR(200) NOT NULL,
        itemPrice FLOAT(5,2) NOT NULL,
        itemCurrent BOOLEAN ,
        foodType_ID INT
        )";
    runQuery($sql,"Creating item", false);  
    
    /******* Populate the Tables******************/
    $foodTypeArray = array("Soup", "Salad", "Entree", "Dessert");

    foreach($foodTypeArray as $foodType){
        $sql= "INSERT INTO foodType(foodTypeName)"
        ."VALUES ('" . $foodType . "')";
        runQuery($sql, "Record inserted for: ".$foodType[0], false);
    }

    $itemArray = array(
        array("Chicken Noodle", "noodle soup", "5.99", '1', "1"),
        array("Ceasar", "Romaine, classic Ceasar", "5.99", '1', "2"),
        array("Cheeseburger", "Classic American Cheeseburger", "3.99",'1',"3"),
        array("Chicken Strips", "Served with fries and coleslaw", "4.25", '0', "3")
    );

    foreach($itemArray as $item){
        $sql= "INSERT INTO item(itemName, itemDescription, itemPrice, itemCurrent, foodType_ID)"
        ."VALUES ('" . $item[0] . "','"
        .$item[1] . "','"
        .$item[2] . "','"
        .$item[3] . "','"
        .$item[4] . "')";
        runQuery($sql, "Record inserted for: ".$item[0], false);
    }
    /****************************************
    * displayResult()
    ****************************************/
    function displayResult($result,$sql){
        if ($result-> num_rows>0){
            echo "<table border='1'>";
            $heading = $result-> fetch_assoc();
            echo "<tr>";
            foreach($heading as $key=>$value){
                echo "<th>". $key . "</th>";
            }
            echo "</tr>";
            echo "<tr>";
            foreach($heading as $key=>$value){
                echo "<td>" . $value . "</td>";
            }
            while($row=$result->fetch_assoc()){
                echo "<tr>";
                foreach($row as $key=>$value) {
                    echo "<td>" . $value. "</td>";
                }
                echo"</tr>";
            }
            echo "</table>";
        }else{
            echo "<strong>zero results using SQL: </strong>". $sql;
        }
    }
    /****************************************
    * runQuery()
    ****************************************/
    function runQuery($sql,$msg,$echoSuccess) {
        global $conn;
        //run the query
        if($conn->query($sql)===TRUE) {
            if($echoSuccess){
                echo $msg . " successful.<br />";
            }
        } else{
            echo "<strong>Error when: " . $msg . "</strong> using SQL: " .$sql . "<br />" . $conn->error;
        }
    }
   
    ?>
</body>
</html>

