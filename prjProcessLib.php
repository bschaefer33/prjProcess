<?php
/*  prjProcessLib.php - functions
    Class: CSC 235 Server Side Development
    Week 4: prjProcess
    Student Name: Brittany Schaefer
    Written: 4/6/22
    Revised: 4/27/22
*/
/*******************************************************
*  Functions are in alphabetical order
*******************************************************/
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * 
*  clearThisItem() Clears $thisItem and text boxes
* * * * * * * * * * * * * * * * * * * * * * * * * * * */
function clearThisItem( ) {
    global $thisItem;
    $thisItem['item_ID'] = "";
    $thisItem['itemName'] = "";
    $thisItem['itemDescription'] = ""; 
    $thisItem['itemPrice'] = "";
    $thisItem['itemCurrent'] = "";
    $thisItem['foodTypeName'] = "";
    $true = "unchecked";
    $false = "unchecked";
    $slcSoup = ""; 
    $slcSalad = ""; 
    $slcEntree = ""; 
    $slcDessert = "";
} // end of clearThisItem( )
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * 
*  createConnection() Creates db connection
* * * * * * * * * * * * * * * * * * * * * * * * * * * */
function createConnection( ) {
    global $conn;
    // Create connection object
    $conn = new mysqli(SERVER_NAME, DBF_USER_NAME, DBF_PASSWORD);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    // Select the database
    $conn->select_db(DATABASE_NAME);
} // end of createConnection( )
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * 
*  displayMenu() displays the menu
* * * * * * * * * * * * * * * * * * * * * * * * * * * */
function displayMenu(){
    global $conn;
    $sql = "SELECT itemName, itemDescription, itemPrice, itemCurrent, foodTypeName 
            FROM item
            LEFT OUTER JOIN foodType
            ON item.foodType_ID = foodType.foodType_ID";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        echo "<table border='1'>\n";
        //heading
        echo "<tr><th>Item</th><th>Description</th><th>Price</th><th>Currently On Menu?</th><th>Food Category</th></tr>\n";
        while($row = $result->fetch_assoc()){
            echo "<tr>";
            foreach($row as $key=>$value) {
                if($key == 'itemCurrent'){
                    if($value == 0){
                        echo "<td>No</td>";
                    }else{
                        echo "<td>Yes</td>";
                    }
                }else{
                    echo "<td>" . $value . "</td>";
                }
            }
            echo "</tr>";
        }
        echo "</table>";
    }else{
        echo "zero results";
    }
}//end of display
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * 
*  runQuery() 
* * * * * * * * * * * * * * * * * * * * * * * * * * * */
function runQuery($sql, $msg, $echoSuccess) {
    global $conn;
     
    // run the query
    if ($conn->query($sql) === TRUE) {
       if($echoSuccess) {
          echo $msg . " successful.<br />";
       }
    } else {
       echo "<strong>Error when: " . $msg . "</strong> using SQL: " . $sql . "<br />" . $conn->error;
    }   
} // end of runQuery( ) 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * 
*  userDisplay() 
* * * * * * * * * * * * * * * * * * * * * * * * * * * */
function userDisplay($foodType){
    global $conn;
    $section=$foodType;
    
    $sql = "SELECT itemName, itemDescription, itemPrice
    FROM item
    WHERE itemCurrent = '1'
    AND foodType_ID = $section ";
    $result = $conn->query($sql);
    
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
            echo "<div class='itemDisplay'";
            foreach($row as $key=>$value) {
                echo "<br />";
                if($key == 'itemName'){
                    echo "<div class='nameDisplay'><h2>" . $value . "</h2></div>";
                }elseif($key == 'itemDescription'){
                    echo "<div class='descDisplay'><p>" . $value . "</p></div>";
                }elseif($key == 'itemPrice'){
                    echo "<div class='priceDisplay'><p>" . $value . "</p></div>";
                }
            }
            echo "</div>";
        }
    }

}

?>