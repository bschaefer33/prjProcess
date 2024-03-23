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

    require 'dbfCreate.php';
    $true = "unchecked";
    $false = "unchecked";
    
?>
</head>
<body>
    <div id="frmContainer">
        <form action= "<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"
            method= "POST"
            name = "frmMenu"
            id = "frmMenu">
            
            <div class = "topLabel">
                <label for="lstItem"><strong>Select Item</strong></label>

                <select name="lstItem" id="lstItem" onchange="this.form.submit();">
                    <option value="new">Item</option>
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
            <label for="txtItemName">Item Name</label>
            <input type="text" id="txtItemName" name="txtItemName" ><br>

            <label for="txtItemDescription">Item Description</label>
            <input type="text" id="txtItemDescription" name="txtItemDescription"  ><br>

            <label for="txtItemPrice">Item Price</label>
            <input type="text" id="txtItemPrice" name="txtItemPrice" ><br>
        
            <label for="lstFoodType">Food Type</label>
            <select name="lstFoodType" id="lstFoodType">
                <option value="1">Soup</option>
                <option value="2">Salad</option>
                <option value="3">Entree</option>
                <option value="4">Dessert</option>
            </select>
        
            <fieldset>
                <legend>Is this a current menu item?</legend>
                    <label for ="radioYes">Yes</label>
                    <input type="radio" id="radioYes" name="radioCurrent" value="1" <?php echo $true; ?>>
                    <label for ="radioNo">No</label>
                    <input type="radio" id="radioNo" name="radioCurrent" value="0" <?php echo $false;?>><br>
            </fieldset>

            <!--Buttons-->
            <button name="btnSubmit" 
                    value="delete"
                    onclick="this.form.submit();">
                    Delete Item
            </button>
            <button name="btnSubmit"    
                    value="new"  
                    onclick="this.form.submit();">
                    Add New Item
            </button>
            <button name="btnSubmit" 
                    value="update" 
                    onclick="this.form.submit();">
                    Update Item
            </button>
        </form>
    </div>
    <div id="display">
        <?php
            $sql= "SELECT item_ID, itemName, itemDescription, itemPrice, itemCurrent, foodTypeName  FROM item 
                    LEFT OUTER JOIN foodType
                    ON item.foodType_ID = foodType.foodType_ID";
            $result = $conn->query($sql);
            displayResult($result,$sql);
        ?>
    </div>
</body>
</html>
    