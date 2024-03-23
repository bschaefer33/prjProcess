<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
<!-- presentation.php - Shows agile process/pitch to customer
  Class: CSC 235 Server Side Development
  Week 4: prjProcess
  Student Name: Brittany Schaefer
  Written: 4/6/22
  Revised: 
-->
    <link rel="stylesheet" href= "style.css">
    <title>Week 4 Project</title>
</head>
<body> 
    <header id="finalHeader">
        <!--Company name-->
        <div id="headLogo">
            <h1>Auntie B's</h1>
        </div>
        <!--Navigation-->
        <div id="headNav">
            <a href="presentation.php">Home</a>
            <a href="index.php">User View</a>
            <a href="edit.php">Edit Page</a>
            <a href="proofOfConcept.php">Proof Of Concept</a>
        </div>
    </header>
    <!--Presentation page container-->
    <div id="contentContainer">
        <div id="intro">
            <h1>Project Cafe Specials</h1>
            <h3>Brittany Schaefer</h3>
            <h3>April 6th, 2022</h3>
        </div>
        <!--Step one-5W's and table of data-->
        <div id="stepOne">
            <h2>Step 1: Needs Assesment</h2>
            <div id="needsW">
                <h3>The Who, What, When, Where and Why</h3>
                <dl>
                    <dt>The problem the client is having</dt>
                    <dd>A local coffee shop/deli has daily lunch specials,
                        and would like to be able to post them online daily 
                        for customers to look at. </dd>
                    <dt>Who will be updating the daily specials? Who will be looking at the site?</dt>
                    <dd>The chef, owner or manager will be updating the information daily. The target  
                        customers are local business people looking for fresh options for lunch. In 
                        the summer there is an increase in tourists as well that look for local options.</dd>
                    <dt>What needs to be updated? What type of information is being updated? 
                        (Ex: descriptions, names, prices, images, links? What information is the most important?</dt>
                    <dd>There is a standard menu that doesn't change often, and then there are daily specials that 
                        allow the shop to utilize leftover product, seasonal items and add some variability for everyone. 
                        The specials consist of a smoothie, salad, soup and entree. A name, description and price will 
                        all need to be displayed. It would be important to save these specials as they can appear multiple 
                        times. The specials are the most important since users usually look at those before coming in.</dd>    
                    <dt>When does this need to be done? When will users expect the updated information?</dt>
                    <dd>The specials system should be ready by Sunday April 10th. The specials will be updated the 
                        evening before but before 10am, so users can check before lunch time.</dd>    
                    <dt>Where will the information be updated? Where will the users access the information?</dt>
                    <dd>The information will be updated from a desktop at the shop, or on a laptop if the 
                        responsible party cannot be there. There is an even mix of people who will check for 
                        the specials on a desktop, tablet or mobile phone.</dd>    
                    <dt>Why do users visit the site?</dt>
                    <dd>Since the shop is in a rural area, it is usually a decent drive to get food from a restaurant. 
                        If the customer can see what the daily special is, they will be more likely to make the special 
                        trip for something they will enjoy and not be able to get daily.</dd>        
                </dl>
            </div>
            <div id="roughWire">
                <h3>Rough sketch of Website layout</h3>
                <a href="graghic/roughSketch.png" target="_blank">
                    <img src="graphic/roughSketch.png" width="500px">
                </a>
            </div>
            <div id="sampleData">
                <table>
                    <tr>
                        <th>Day</th>
                        <th>Smoothie</th>
                        <th>Soup</th>
                        <th>Salad</th>
                        <th>Entree</th>
                    </tr>
                    <tr>
                        <td>Monday</td>
                        <td>Strawberry Banana</td>
                        <td>Chicken Wild Rice</td>
                        <td>Taco Salad</td>
                        <td>Enchiladas</td>
                    </tr>
                    <tr>
                        <td>Tuesday</td>
                        <td>Chocolate Peanut Butter</td>
                        <td>Chicken Noodle Soup</td>
                        <td>Ceasar Salad</td>
                        <td>Cheeseburger</td>
                    </tr>
                    <tr>
                        <td>Wednesday</td>
                        <td>Green Machine</td>
                        <td>Wonton</td>
                        <td>Garden</td>
                        <td>Sloppy Joes</td>
                    </tr>
                    <tr>
                        <td>Thursday</td>
                        <td>Pineapple Mango</td>
                        <td>Chili</td>
                        <td>Chef</td>
                        <td>Fried Chicken</td>
                    </tr>
                </table>
            </div>
        </div>
        <!--Step two-decide what best approach is-->
        <div id="stepTwo">
            <div id="soultions">
                <h2>Step 2: Problem Analysis</h2>
                <h3>Different Approaches</h3>
                <ul>
                    <li>First Approach: The first way that the clients problem could be solved would be to use a social 
                        media account to post the daily specials. This would not require much upkeep, is free and is a 
                        platform the client is most likely already comfortable with. A portion of the client base however 
                        does not use social media, and the client would not be able to save the specials to use repeatedly. 
                    </li>
                    <li>Second Approach: Another approach would be to keep the information in a .txt file and update it on 
                        the office desktop. This solution would be faster to implement but has more room for human error, 
                        such as forgetting to delete a comma or putting information in the wrong place. This also does not 
                        allow for the flexibility of updating the information away from the shop. 
                    </li>
                    <li>Third Approach: The last approach, and the one that is recommended, is to create a database that can 
                        store the specials and pair it with a user interface so the client can easily select the specials for 
                        that day. The information will then be updated in the same format and place for customers to easily 
                        access. 
                    </li>
                </ul>
            </div>
            <div id="databseDesign">
                <h3>Database Design</h3>
                    <a href="graghic/prjProcessDB.png" target="_blank">
                        <img src="graphic/prjProcessDB.png" width="500px">
                    </a>
            </div>
        </div>

        <!--Step three-code samples-->
        <div id="stepThree">
            <h2>Step 3: Proof-Of-Concept Code</h2>
            <a href ="proofOfConcept.php">Code</a>
        </div>

        <!--Step four-UI prototype-->
        <div id="stepFour">
            <h2>Step 4: User Interface Prototype</h2>
            <h3>Wireframe for Users</h3>
                <a href="graghic/indexWire.png" target="_blank">
                    <img src="graphic/indexWire.png" width="500px">
                </a>
            <h3>Wireframe for Admin</h3>
                <a href="graghic/editWire.png" target="_blank">
                    <img src="graphic/editWire.png" width="500px">
                </a>
        </div>

        <!--Step 5- finish the project-->
        <div id="stepFive">
            <h2>Step 5: Write the App</h2>
            <h3>Link to HomePage</h3>
            <a href="https://www.brittanyschaefer.com/">Home</a>
        </div>
    </div>
</body>
</html>