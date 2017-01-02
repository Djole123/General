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
	<nav>
		<?php include 'header.inc.php'; ?>
	</nav>
	<main class = "login">
		<fieldset> <!-- creating a fieldset -->
		<legend> Advanced Search </legend> <!-- fieldset is named Advanced Search -->
			<form action = "Sample.php" method = "post"> <!-- submissions take you to the sample results page -->
				<input type = "text" name = "advSearch" placeholder = "Keyword"/> <!-- Keyword search -->
				<p> OR <br> Search by Rating: </p>
				<!-- the following 5 options are ratings to select from a drop down menu -->
				<select name = "rating">
					<option value = "all"> All </option>
					<option value = "1"> 1 Star </option>
					<option value = "2"> 2 Star </option>
					<option value = "3"> 3 Star </option>
					<option value = "4"> 4 Star </option>
					<option value = "5"> 5 Star </option>
				</select>
				<br><br>
				<input class = "login" type = "submit" value = "Submit"/> <!-- submit button -->
				<input class = "login" type = "reset" value = "Reset"/> <!-- button to reset all the fields -->
			</form>
			<form action = "geoLocation.php">
				<input class = "login" type = "submit" value = "Search by My Location"/>
			</form>
		</fieldset>
	</main>
</div>

</body>
</html>