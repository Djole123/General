<!DOCTYPE html>
<html>
<head>
	<!-- Meta data and linking the css to the website -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<link rel = "stylesheet" type = "text/css" href = "style.css">
	<title> Doctor Who Locator </title>
</head>
<body>

<div>
    <?php
        $mapFlag = false;
        if(!empty($_POST["name"]) && !empty($_POST["rating"]) && !empty($_POST["review"]) && !empty($_POST["long"]) && !empty($_POST["lat"])){
            $pdo = new PDO('mysql:host=localhost;dbname=doctorwholocator','root','');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $g;
            try{
                $test2 = $pdo->prepare('SELECT * FROM `markers` WHERE (`x` = :a) AND (`y` = :b)');
                $test2->bindValue(':a', $_POST["lat"]);
                $test2->bindValue(':b', $_POST["long"]);
                $test2->execute();
                if($test2->rowCount() > 0){
                    $mapFlag = false;
                }
                if($_POST["rating"] == 1){
                    $g = '1 Star';
                }else if($_POST["rating"] == 2){
                    $g = '2 Stars';
                }else if($_POST["rating"] == 3){
                    $g = '3 Stars';
                }else if($_POST["rating"] == 4){
                    $g = '4 Stars';
                }else if($_POST["rating"] == 5){
                    $g = '5 Stars';
                }
                if($test2->rowCount() == 0){
                    $apply = $pdo->prepare('INSERT INTO `markers` (`ID`, `x`, `y`, `name`, `review`, `rating`) VALUES (NULL, :a, :b, :c, :d, :e)');
                    $apply->bindValue(':a', $_POST["lat"]);
                    $apply->bindValue(':b', $_POST["long"]);
                    $apply->bindValue(':c', $_POST["name"]);
                    $apply->bindValue(':d', $_POST["review"]);
                    $apply->bindValue(':e', $g);
                    $apply->execute();
                    $mapFlag = true;
                }
            }catch(PDOException $z){
                echo $z->getMessage();
            }
        }
    ?>
    
    <?php
        if($mapFlag){
            echo "<main class = 'login'>";
            echo "<h1 id = loginout> You have created a map marker. </h1>";
            echo "<a href = 'MapPage.php'> Continue to Map </a>";
            echo "</main>";
        }else{
            echo "<main class = 'home'>";
            echo "<h1 id = loginout> Something went wrong. Would you like to try again? </h1>";
            echo "<a href = 'AddSighting.php'> Try Again </a>";
            echo "<a href = 'HomePage.php' style = 'float:right'> Go Home </a>";
            echo "</main>";
        }
    ?>
</div>

</body>
</html>