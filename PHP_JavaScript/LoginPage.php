<!DOCTYPE html>
<html>
<head>
	<!-- Meta data and linking the css to the website -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<link rel = "stylesheet" type = "text/css" href = "style.css">
    <script src = "script.js"></script>
	<title> Doctor Who Locator </title>
</head>
<body>

<div>
	<nav>
		<?php include 'searchBar.inc.php'; ?>
		<?php include 'header.inc.php'; ?>
	</nav>
	<main class = "login"> <!-- Styles the main in the style of login -->
		<fieldset> <!-- opens a fieldset to contain the following forms -->
			<legend> Login </legend> <!-- Puts the title "Login" to the fieldset -->
			<form action = "continue2.php" onsubmit = "return validateLogin()" method = "post"> <!-- Starts a form that submits to the home page -->
				<input type = "text" name = "user" placeholder = "User Name" id = "userName"/> <!-- User name entry field -->
				<br><br>
				<input type = "password" name = "password" placeholder = "Password" id = "pass1"/> <!-- password entry field -->
				<br><br>
				<input class = "login" type = "submit" value = "Submit"/> <!-- submits the info -->
				<input class = "login" type = "reset" value = "Reset"/> <!-- resets all the values -->
				<br><br>
			</form>
			<form action = "SignUp.php"> <!-- new form outside of the previous one that leads to the registration page -->
				<input class = "register" type = "submit" value = "Register"/> <!-- moves the user to the register page -->
			</form>
		</fieldset>
	</main>
</div>

</body>
</html>