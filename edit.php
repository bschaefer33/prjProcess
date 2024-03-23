<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- proofOfConcept.php - snippits of code
    Class: CSC 235 Server Side Development
    Week 4: prjProcess
    Student Name: Brittany Schaefer
    Written: 4/6/22
    Revised: 4/27/22
    -->
    <title>Project Process</title> 
    <link rel="stylesheet" href= "style.css">
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
    $true = "unchecked";
    $false = "unchecked";
    $slcSoup = ""; 
    $slcSalad = ""; 
    $slcEntree = ""; 
    $slcDessert = "";
    clearThisItem();

    //return visit?
if(array_key_exists('hidIsReturning', $_POST)){
    if(isset($_SESSION['sessionThisItem'])){
        $thisItem = unserialize(urldecode($_SESSION['sessionThisItem']));
    }
    if(isset($_POST['lstItem']) && !($_POST['lstItem'] == 'new')){
        $selection = $_POST['lstItem']; 
        $sql = "SELECT item_ID, itemName, itemDescription, itemPrice, itemCurrent, foodTypeName  FROM item 
                LEFT OUTER JOIN foodType
                ON item.foodType_ID = foodType.foodType_ID
                WHERE item.item_ID =  {$selection} ";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        
        $thisItem = [
            "item_ID" => $row['item_ID'],
            "itemName" => $row['itemName'],
            "itemDescription" => $row['itemDescription'], 
            "itemPrice" => $row['itemPrice'],
            "itemCurrent" => $row['itemCurrent'],
            "foodTypeName" => $row['foodTypeName']
        ];
        $_SESSION['sessionThisItem'] = urlencode(serialize($thisItem));
        if($thisItem['itemCurrent']==TRUE){
            $true = "checked";
        }
        else{
            $false= "checked";
        }
        if($thisItem['foodTypeName']== "Soup"){
            $slcSoup = "selected";
            $slcSalad = ""; 
            $slcEntree = ""; 
            $slcDessert = ""; 
        }elseif($thisItem['foodTypeName']== "Salad"){
            $slcSalad = "selected";
            $slcSoup = ""; 
            $slcEntree = ""; 
            $slcDessert = "";
        }elseif($thisItem['foodTypeName']== "Entree"){
            $slcEntree = "selected";
            $slcSoup = ""; 
            $slcSalad = ""; 
            $slcDessert = "";
        }elseif($thisItem['foodTypeName']== "Dessert"){
            $slcDessert = "selected";
            $slcSoup = ""; 
            $slcSalad = ""; 
            $slcEntree = ""; 
        }else{
            $slcSoup = ""; 
            $slcSalad = ""; 
            $slcEntree = ""; 
            $slcDessert = "";
        }
    }//end of lstItem

    //button submit
    if(isset($_POST['btnSubmit'])) {
        switch($_POST['btnSubmit']){
            //Delete
            case 'delete':
                //check if item is selected
                if($_POST['lstItem']== ""){
                    echo "Please select an item.";
                }else{
                    $sql = "DELETE FROM item WHERE item_ID=" . $thisItem["item_ID"];
                    $result = $conn->query($sql);
                }
                clearThisItem();
                break;
            //Update
            case 'update':
                //check for empty field
                if($_POST['lstItem']== ""){
                    echo "Please select an item";
                }else{
                    $sql = "UPDATE item SET itemName = '" . $_POST['txtItemName'] . "', "
                    . " itemDescription = '" . $_POST['txtItemDescription'] . "',"
                    . " itemPrice = '" . $_POST['txtItemPrice'] . "',"
                    . " itemCurrent = '" . $_POST['radioCurrent'] . "',"
                    . " foodType_ID = '" . $_POST['lstFoodType'] . "'
                    WHERE item_ID = " . $thisItem['item_ID'];
                    $result = $conn->query($sql);

                    $thisItem['itemName'] = $_POST['txtItemName'];
                    $thisItem['itemDescription'] =  $_POST['txtItemDescription'];
                    $thisItem['itemPrice'] =  $_POST['txtItemPrice'];
                    $thisItem['itemCurrent'] =  $_POST['radioCurrent'];
                    $thisItem['foodType_ID'] =  $_POST['lstFoodType']; 

                    $_SESSION['sessionThisItem'] = urlencode(serialize($thisItem));
                    if($thisItem['itemCurrent']==TRUE){
                        $true = "checked";
                    }
                    else{
                        $false= "checked";
                    }
                    if($thisItem['foodTypeName']== "Soup"){
                        $slcSoup = "selected";
                        $slcSalad = ""; 
                        $slcEntree = ""; 
                        $slcDessert = ""; 
                    }elseif($thisItem['foodTypeName']== "Salad"){
                        $slcSalad = "selected";
                        $slcSoup = ""; 
                        $slcEntree = ""; 
                        $slcDessert = "";
                    }elseif($thisItem['foodTypeName']== "Entree"){
                        $slcEntree = "selected";
                        $slcSoup = ""; 
                        $slcSalad = ""; 
                        $slcDessert = "";
                    }elseif($thisItem['foodTypeName']== "Dessert"){
                        $slcDessert = "selected";
                        $slcSoup = ""; 
                        $slcSalad = ""; 
                        $slcEntree = ""; 
                    }else{
                        $slcSoup = ""; 
                        $slcSalad = ""; 
                        $slcEntree = ""; 
                        $slcDessert = "";
                    }
                }
                clearThisItem();
                break;
            //New
            case 'new':
                //check for duplicates
                $sql = "SELECT COUNT(*) AS total FROM item
                WHERE itemName= '" . $_POST['txtItemName'] . "'
                AND itemDescription = '" . $_POST['txtItemDescription'] . "' 
                AND itemPrice = '" . $_POST['txtItemPrice'] . "'";
                $result = $conn->query($sql);
                $totalCount= $result->fetch_assoc();
                if($totalCount['total'] >0){
                    echo "Item already exists";
                } //check for empty fields
                elseif($_POST['txtItemName']=="" || $_POST['txtItemDescription']=="" || 
                    $_POST['txtItemPrice']=="" || $_POST['lstFoodType']=="0" || $_POST['radioCurrent']==""){
                        echo "Please fill out the whole form.";
                }else{
                    //$itemName = $_POST['txtItemName'];
                    //$itemDescription = $_POST['txtItemDescription'];
                    //$itemPrice = $_POST['txtItemPrice'];
                    //$itemCurrent = $_POST['radioCurrent'];
                    //$foodType = $_POST['lstFoodType'];

                    //echo $foodType;
                    $sql = "INSERT INTO item(item_ID, itemName, itemDescription, itemPrice, itemCurrent, foodType_ID)
                            VALUES (NULL, 
                            '" . $_POST['txtItemName'] . "',
                            '" . $_POST['txtItemDescription'] . "',
                            '" . $_POST['txtItemPrice'] . "',
                            '" . $_POST['radioCurrent'] . "',
                            '" . $_POST['lstFoodType'] . "')";
                    $result = $conn->query($sql);
                }
                clearThisItem();
                break;
        }
    }
}
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
    <div id="editPage">
        <h1>Edit Menu</h1>
        <div id="frmContainer">
            <form action= "<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"
                method= "POST"
                name = "frmMenu"
                id = "frmMenu">

                <fieldset>
                <legend>New Menu Item</legend>
                <div id="questionSet">
                <div class = "topLabel">
                    <label for="lstItem">Select Item</label>

                    <select name="lstItem" id="lstItem" onchange="this.form.submit();">
                        <option value="new"></option>
                        <?php
                            //loop through items
                            $sql = "SELECT item_ID,itemName FROM item";
                            $result= $conn->query($sql);
                            while($row= $result->fetch_assoc()){
                            echo "<option value='" . $row['item_ID'] . "'>" . $row['itemName'] . "</option>\n";
                            }
                        ?>
                    </select>
                </div>

                <div class = "topLabel">
                    <label for="txtItemName">Item Name</label>
                    <input type="text" id="txtItemName" name="txtItemName" value="<?php echo $thisItem['itemName']; ?>">
                </div>
                
                <div class = "topLabel">
                    <label for="txtItemDescription">Item Description</label>
                    <input type="text" id="txtItemDescription" name="txtItemDescription" value="<?php echo $thisItem['itemDescription']; ?>" >
                </div>

                <div class = "topLabel">
                    <label for="txtItemPrice">Item Price</label>
                    <input type="text" id="txtItemPrice" name="txtItemPrice" value="<?php echo $thisItem['itemPrice']; ?>">
                </div>
                </div>
                <div class = "topLabel">
                    <label for="lstFoodType">Food Type</label>
                    <select name="lstFoodType" id="lstFoodType">
                        <option value="0"></option>
                        <option <?php echo $slcSoup; ?> value="1">Soup</option>
                        <option <?php echo $slcSalad; ?> value="2">Salad</option>
                        <option <?php echo $slcEntree; ?> value="3">Entree</option>
                        <option <?php echo $slcDessert; ?> value="4">Dessert</option>
                    </select>
                </div>


                    <fieldset id="radioBox">
                        <legend>Should this be on the current menu?</legend>
                        <div class="box">
                            <label for ="radioYes">Yes</label>
                            <input type="radio" id="radioYes" name="radioCurrent" value="1" <?php echo $true; ?>>
                        </div>
                        <div class="box">
                            <label for ="radioNo">No</label>
                            <input type="radio" id="radioNo" name="radioCurrent" value="0" <?php echo $false;?>>
                        </div>
                    </fieldset>

                </fieldset>
                <!--Buttons-->
                <button name="btnSubmit" 
                        value="delete"
                        style="float:left;"
                        onclick="this.form.submit();">
                        Delete Item
                </button>
                <button name="btnSubmit"    
                        value="new"  
                        style="float:right;"
                        onclick="this.form.submit();">
                        Add New Item
                </button>
                <button name="btnSubmit" 
                        value="update" 
                        style="float:right;"
                        onclick="this.form.submit();">
                        Update Item
                </button>
                <!--Hidden Field-->
                <input type= "hidden" name="hidIsReturning" value="true" />

            </form>
        </div>
        <div id="display">
            <?php
                displayMenu();
            ?>
        </div>
    </div>
</body>
</html>