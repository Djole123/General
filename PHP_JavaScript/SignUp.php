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
	<main class = "login"> <!-- Styles the main class to the style of login -->
		<fieldset> <!-- Opens a fieldset -->
			<legend> Sign Up </legend> <!-- Title of the fieldset is Sign Up -->
			<form action = "continue2.php" onsubmit = "return validate()" method = "post"> <!-- Opens a form that submits to the homepage -->
				<input type = "text" name = "firstname" placeholder = "User Name" id = "userName"/> <!-- User Name entry field -->
				<br><br>
				<input type = "email" name = "email" placeholder = "E-Mail" id = "email"/> <!-- E-Mail entry field -->
				<br><br>
				<!-- The following three are radio buttons to select gender -->
				<input type = "radio" name = "gender" value = "male"> Male
				<input type = "radio" name = "gender" value = "female"> Female
				<br>
				<input type = "radio" name = "gender" value = "other"> Other
				<br><br>
				<input type = "password" name = "password2" placeholder = "Password" id = "pass1"/> <!-- Password entry field -->
				<br>
				<input type = "password" name = "repassword" placeholder = "Repeat Password" id = "pass2"/> <!-- Repeat password entry field -->
				<br><br>
				<input type = "date" name = "date" placeholder = "Date" id = "date"/>
				<br><br>
				<input class = "register" type = "submit" value = "Register"/> <!-- Buttons to register -->
				<input class = "reset" type = "reset" value = "Reset"/> <!-- Button to reset the information in the fields -->
			</form>
		</fieldset>
	</main>
</div>

</body>
</html>