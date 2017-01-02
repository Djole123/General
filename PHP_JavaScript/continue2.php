<!DOCTYPE html>
<?php //this entire section of php checks to see if the username and password was correct, and if it was already in the system.
    $flag = 0; //automatically sets the flag to 0
    if (!empty($_POST["user"]) && !empty($_POST["password"])){ //checks if the login page user and password was given 
        $pdo = new PDO('mysql:host=localhost;dbname=doctorwholocator','root','');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try{
            $result = $pdo->prepare('SELECT * FROM `users` WHERE (`UserName` = :x) AND (`Password` = :y)');
            $result->bindValue(':x', $_POST["user"]);
            $result->bindValue(':y', $_POST["password"]);
            $result->execute();
            if($result->rowCount() > 0){
                $flag = 1;
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        if($flag == 1){
            setcookie('name', $_POST["user"], time() + 3600);
        }
    }
    //checks if the registration was valid
    if(!empty($_POST["firstname"]) && !empty($_POST["email"]) && !empty($_POST["gender"]) && !empty($_POST["password2"]) && !empty($_POST["repassword"]) && !empty($_POST["date"])){
        $g;
        $pdo = new PDO('mysql:host=localhost;dbname=doctorwholocator','root','');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try{
            $test1 = $pdo->prepare('SELECT * FROM `users` WHERE (`UserName` = :a)');
            $test1->bindValue(':a', $_POST["firstname"]);
            $test1->execute();
            if($test1->rowCount() > 0){
                $flag = 2;
            }else if(!($_POST["password2"] == $_POST["repassword"])){
                $flag = 3;
            }
            if($_POST["gender"] == 'male'){
                $g = 'M';
            }else if($_POST["gender"] == 'female'){
                $g = 'F';
            }else if($_POST["gender"] == 'other'){
                $g = 'O';
            }
            if($test1->rowCount() == 0){
                $apply = $pdo->prepare('INSERT INTO `users` (`id`, `UserName`, `EMail`, `Gender`, `Password`, `Date`) VALUES (NULL, :a, :b, :c, :d, :e)');
                $apply->bindValue(':a', $_POST["firstname"]);
                $apply->bindValue(':b', $_POST["email"]);
                $apply->bindValue(':c', $g);
                $apply->bindValue(':d', $_POST["password2"]);
                $apply->bindValue(':e', $_POST["date"]);
                $apply->execute();
                $flag = 4;
            }
        }catch(PDOException $z){
            echo $z->getMessage();
        }
    }    
?>
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
        if($flag == 1){
            echo "<main class = 'login'>";
            echo "<h1 id = loginout> You are now being logged in. </h1>";
            echo "<a href = 'HomePage.php'> Continue </a>";
            echo "</main>";
        }else if($flag == 2){
            echo "<main class = 'home'>";
            echo "<h1 id = loginout> This user name already exists within the system. </h1>";
            echo "<a href = 'SignUp.php'> Try Again </a>";
            echo "<a href = 'LoginPage.php' style = float:right> Login </a>";
            echo "</main>";
        }else if($flag == 3){
            echo "<main class = 'home'>";
            echo "<h1 id = loginout> The passwords you entered do not match. </h1>";
            echo "<a href = 'SignUp.php'> Try Again </a>";
            echo "<a href = 'HomePage.php' style = float:right> Go Home </a>";
            echo "</main>";
        }else if($flag == 4){
            echo "<main class = 'login'>";
            echo "<h1 id = loginout> You have successfully registered. </h1>";
            echo "<a href = 'HomePage.php'> Go Home </a>";
            echo "<a href = 'LoginPage.php' style = float:right> Login </a>";
            echo "</main>";
        }else{
            echo "<main class = 'home'>";
            echo "<h1 id = loginout> Your username does not exist or the password was entered incorrectly. </h1>";
            echo "<a href = 'LoginPage.php'> Try Again </a>";
            echo "<a href = 'SignUp.php' style = float:right> Register </a>";
            echo "</main>";
        }
    ?>
</div>

</body>
</html>