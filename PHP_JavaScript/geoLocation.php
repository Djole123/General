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
	<main class = "map"> <!-- styles the main to the style of map -->
		<div id = "actualMap"></div>
			<?php
            $pdo = new PDO('mysql:host=localhost;dbname=doctorwholocator','root',''); //logs into the database
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
            try{
                $result = $pdo->prepare('SELECT `x`, `y`, `name`, `review`, `rating` FROM `markers`'); //prepares the statements to avoid injection
                $result->execute();
                $var = $result->fetchAll(); //fetches all the reults from the table "markers"
                $arrayB = array(); //creates an empty array
                foreach($var as $output) { //places all of the results from the search into the array
                    $arrayB[] = $output;
                }
                $arrayC = array(); //creates a second empty array
                for($i=0;$i<sizeof($arrayB);$i++){ //these two for loops look through the array and turn it into a 1d array, it was previously 2d.
                    for($j=0;$j<sizeof($arrayB[$i])-5;$j++){
                        $arrayC[] = $arrayB[$i][$j];
                    }
                }
            }catch(PDOException $e){ //catches any exceptions
                echo $e->getMessage();
            }
        ?>
        <div id = "actualMap"></div>
		<script>
            var arrayA = [<?php echo '"'.implode('","', $arrayC).'"' ?>]; //takes the array from php and turnsit into a javascript array
            makeGeoMap(arrayA); //makes the map with the array while including the users location
		</script>
	</main>
</div>

</body>
</html>