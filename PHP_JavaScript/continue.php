<!DOCTYPE html>
<?php setcookie('name', 'nothing', time() - 3600); //destroys the cookie to log you out ?>
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
	<main class = "login"> <!-- Styles the main in the style of login -->
		<h1 id = "loginout"> You will now be logged out. </h1>  <!-- let the user know they will be logged out -->
        <a href = "HomePage.php"> Continue </a> <!-- button to bring them to the homepage -->
	</main>
</div>

</body>
</html>