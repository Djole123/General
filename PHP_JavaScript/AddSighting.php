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
	<main class = "add"> <!-- styles the main in the style of add -->
		<fieldset> <!-- opens a fieldset -->
			<legend> Add Sighting </legend> <!-- title of the fieldset is Add Sighting -->
			<form action = "continueToMap.php" onsubmit = "return validateMap()" method = "post"> <!-- form that submits to the map page -->
				<input type = "text" name = "name" placeholder = "Name of Area" id = "name"/> <!-- input value for the name of the location -->
				<br><br>
				<!-- The following two are input data for the exact coordinates of the sighting -->
                <input type = "number" step="0.000001" name = "lat" placeholder = "Latitude" id = "lat"/>
				<input type = "number" step="0.000001" name = "long" placeholder = "Longitude" id = "long"/>
				<br>
				<p> Rating: </p>
				<!-- The next 5 are a selection of ratings as radio buttons -->
				<input type = "radio" name = "rating" value = "1" checked> 1
				<input type = "radio" name = "rating" value = "2"> 2
				<input type = "radio" name = "rating" value = "3"> 3
				<input type = "radio" name = "rating" value = "4"> 4
				<input type = "radio" name = "rating" value = "5"> 5
				<br><br>
				<textarea name = "review" rows = "10" cols = "40" id = "review">Brief review within 150 characters.</textarea> <!-- A section for a brief summary or review -->
				<br><br>
				<input class = "login" type = "submit" value = "Submit"/> <!-- submit button -->
				<input class = "reset" type = "reset" value = "Reset"/> <!-- reset the fields -->
			</form>
		</fieldset>
	</main>
</div>

</body>
</html>