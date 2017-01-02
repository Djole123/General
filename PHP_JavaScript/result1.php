<!DOCTYPE html>
<html>
<head>
	<!-- Meta data and linking the css to the website -->
	<meta name = "viewport" content = "width=device-width, initial-scale=1">
	<meta charset = "UTF-8">
	<link rel = "stylesheet" type = "text/css" href = "style.css"/>
	<link rel = "stylesheet" href = "https://unpkg.com/leaflet@1.0.1/dist/leaflet.css" />
	<script src = "https://unpkg.com/leaflet@1.0.1/dist/leaflet.js"></script>
	<script src = "script.js"></script>
	<title> Doctor Who Locator </title>
</head>
<body>

<div> 
	<nav>
		<?php include 'searchBar.inc.php'; ?>
		<?php include 'header.inc.php'; ?>
	</nav>
	<main class = "sample"> <!-- main class is to be styled after the sample style -->
        <?php
            $savedIndex = $_COOKIE['clicked']; //checking to find these cookies as they were used to carry over data
            $temp1 = $_COOKIE[$savedIndex];
            $temp2 = $_COOKIE[$savedIndex+1];
            $temp3 = $_COOKIE[$savedIndex+2];
            $temp4 = $_COOKIE[$savedIndex+3];
            $temp5 = $_COOKIE[$savedIndex+4];
            $tempArray = array($temp1, $temp2, $temp3, $temp4, $temp5);
        ?>
		<div id = "actualMap"></div>
		<script>
            var singleResult = [<?php echo '"'.implode('","', $tempArray).'"' ?>];
            makeMap(singleResult); //makes a map of the result
		</script>
		<br><br>
        <?php //styles the section under the map
            echo "<h1>";
                echo $tempArray[2];
            echo "</h1>";
            echo "<h1>";
                echo "Review:";
            echo "</h1>";
            echo "<p>";
                echo $tempArray[3];
            echo "</p>";
            echo "<h1>";
                echo $tempArray[4];
            echo "</h1>";
        ?>
	</main>
</div>

</body>
</html>