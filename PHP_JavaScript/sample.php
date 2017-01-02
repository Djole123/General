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
        $flagSearch = false;
        if(!empty($_POST["search"])){
            $pdo = new PDO('mysql:host=localhost;dbname=doctorwholocator','root','');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            try{
                $check = $pdo->prepare('SELECT `x`, `y`, `name`, `review`, `rating` FROM `markers` WHERE (`x` = :a) OR (`y` = :a) OR (`name` = :a) OR (`review` = :a) OR (`rating` = :a)');
                $check->bindValue(':a', $_POST["search"]);
                $check->execute();
                if($check->rowCount() > 0){
                    $var = $check->fetchAll();
                    $arrayx = array();
                    foreach($var as $output) {
                        $arrayx[] = $output;
                    }
                    $arrayy = array();
                    for($i=0;$i<sizeof($arrayx);$i++){
                        for($j=0;$j<sizeof($arrayx[$i])-5;$j++){
                            $arrayy[] = $arrayx[$i][$j];
                        }
                    }
                    $flagSearch = true;
                }else{
                    $flagSearch = false;
                }
            }catch(PDOException $z){
                echo $z->getMessage();
            }
        }else if(!empty($_POST["advSearch"])){
            $pdo = new PDO('mysql:host=localhost;dbname=doctorwholocator','root','');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            try{
                $check = $pdo->prepare('SELECT `x`, `y`, `name`, `review`, `rating` FROM `markers` WHERE (`x` = :a) OR (`y` = :a) OR (`name` = :a) OR (`review` = :a) OR (`rating` = :a)');
                $check->bindValue(':a', $_POST["advSearch"]);
                $check->execute();
                if($check->rowCount() > 0){
                    $var = $check->fetchAll();
                    $arrayx = array();
                    foreach($var as $output) {
                        $arrayx[] = $output;
                    }
                    $arrayy = array();
                    for($i=0;$i<sizeof($arrayx);$i++){
                        for($j=0;$j<sizeof($arrayx[$i])-5;$j++){
                            $arrayy[] = $arrayx[$i][$j];
                        }
                    }
                    $flagSearch = true;
                }else{
                    $flagSearch = false;
                }
            }catch(PDOException $z){
                echo $z->getMessage();
            }
        }else if(!empty($_POST["rating"])){
            $pdo = new PDO('mysql:host=localhost;dbname=doctorwholocator','root','');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if($_POST["rating"] == 1){
                $rate = 1;
            }else if($_POST["rating"] == 2){
                $rate = 2;
            }else if($_POST["rating"] == 3){
                $rate = 3;
            }else if($_POST["rating"] == 4){
                $rate = 4;
            }else if($_POST["rating"] == 5){
                $rate = 5;
            }else{
                $rate = "all";
            }
            try{
                if($rate == 1 || $rate == 2 || $rate == 3 || $rate == 4 || $rate == 5){
                    $check = $pdo->prepare('SELECT `x`, `y`, `name`, `review`, `rating` FROM `markers` WHERE (`x` = :a) OR (`y` = :a) OR (`name` = :a) OR (`review` = :a) OR (`rating` = :a)');
                    $check->bindValue(':a', $rate);
                    $check->execute();
                }else{
                    $check = $pdo->prepare('SELECT `x`, `y`, `name`, `review`, `rating` FROM `markers` WHERE (`rating` = "1 Star") OR (`rating` = "2 Stars") OR (`rating` = "3 Stars") OR (`rating` = "4 Stars") OR (`rating` = "5 Stars")');
                    $check->execute();
                }
                if($check->rowCount() > 0){
                    $var = $check->fetchAll();
                    $arrayx = array();
                    foreach($var as $output) {
                        $arrayx[] = $output;
                    }
                    $arrayy = array();
                    for($i=0;$i<sizeof($arrayx);$i++){
                        for($j=0;$j<sizeof($arrayx[$i])-5;$j++){
                            $arrayy[] = $arrayx[$i][$j];
                        }
                    }
                    $flagSearch = true;
                }else{
                    $flagSearch = false;
                }
            }catch(PDOException $z){
                echo $z->getMessage();
            }
        }
        //If the search was successful, create tabulated results
        if($flagSearch){
            echo "<table>";
                echo "<tr>";
                    echo "<th> Name of Location </th>";
                    echo "<th> Rating(1-5) </th>";
                    echo "<th> Further Information </th>";
                echo "</tr>";
                for($k=0;$k<sizeof($arrayy);$k+=5){
                    echo "<tr>";
                        echo "<th>";
                            echo $arrayy[$k+2];
                        echo "</th>";
                        echo "<th>";
                            echo $arrayy[$k+4];
                        echo "</th>";
                        echo "<th>";
                            $temp1 = $arrayy[$k];
                            $temp2 = $arrayy[$k+1];
                            $temp3 = $arrayy[$k+2];
                            $temp4 = $arrayy[$k+3];
                            $temp5 = $arrayy[$k+4];
                            setcookie($k, $temp1, time() + 3600);
                            setcookie($k+1, $temp2, time() + 3600);
                            setcookie($k+2, $temp3, time() + 3600);
                            setcookie($k+3, $temp4, time() + 3600);
                            setcookie($k+4, $temp5, time() + 3600);
                            setcookie('clicked', $k, time() + 3600);
                            echo "<a href = 'result1.php'> Click Me! </a>";
                        echo "</th>";
                    echo "<tr>";
                }
            echo "</table>";
        }else{
            echo "Sorry, no results were found."; //otherwise let the user know nothing was found
        }
        ?>
        <div id = "actualMap"></div>
        <script>
            var arraySearch = [<?php echo '"'.implode('","', $arrayy).'"' ?>];
            makeMap(arraySearch);
		</script>
	</main>
</div>

</body>
</html>