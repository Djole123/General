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
        <?php
            $pdo = new PDO('mysql:host=localhost;dbname=doctorwholocator','root',''); //connects to the database
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
            try{
                $result = $pdo->prepare('SELECT `x`, `y`, `name`, `review`, `rating` FROM `markers`'); //searches for all markers
                $result->execute();
                $var = $result->fetchAll();
                $arrayB = array();
                foreach($var as $output) {
                    $arrayB[] = $output;
                } //turns it into a usable array
                $arrayC = array();
                for($i=0;$i<sizeof($arrayB);$i++){ //changes it to a 1d array
                    for($j=0;$j<sizeof($arrayB[$i])-5;$j++){
                        $arrayC[] = $arrayB[$i][$j];
                    }
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        ?>
        <div id = "actualMap"></div>
		<script>
            var arrayA = [<?php echo '"'.implode('","', $arrayC).'"' ?>];//puts the array into javascript
            makeMap(arrayA); //makes a map with all the contents of the array
		</script>
	</main>
</div>

</body>
</html>