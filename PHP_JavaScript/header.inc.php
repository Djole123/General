<a href = "HomePage.php"> Home </a> <!-- A button to lead to the home page -->
<a href = "MapPage.php"> Map </a> <!-- A button to lead to the map page -->
<a href = "Search.php"> Advanced Search </a> <!-- A button to lead to the advanced search page -->
<!-- The following only appear if user is logged in, otherwise just a login button. -->
<?php
    if(isset($_COOKIE['name'])) {
        echo "<a href = 'AddSighting.php'> Add Sighting </a>&nbsp;"; //add sighting option appears
        echo "<a href = 'continue.php'> Logout </a>&nbsp;"; //logout option appears
        echo $_COOKIE['name']; //user name is next to logout button
        echo "&nbsp is currently logged in.";
    }else{ //otherwise
        echo "<a href = 'SignUp.php'> Register </a>&nbsp;";
        echo "<a href = 'LoginPage.php'> Login </a>"; //only a login button is shown
        echo "&nbsp To add sightings you must be logged in.";
    }
?>