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
    <?php include 'searchBar.inc.php'; ?>
    <?php include 'header.inc.php'; ?>
    <h1 id = "title"> Doctor Who Locator </h1> <!-- Adding the title -->
	</nav>
	<main class = "home"> <!-- Sets the main section to be styled with home -->
		<p> This page was created to document sightings of a man called "The Doctor". This Doctor has been around
		people for a very long time yet nobody has seemed to notice. He silently shows up to major historical
		events yet nobody knows his real name or his purpose here. He was there to witness the assasination
		of JFK, he was there when the moon got dark and he was there when that space-ship was flying over 
		London on Christmas day. Although his face is always different, one thing's for certain; The Doctor is 
		always around when bad things happen.</p> <!-- brief descrition -->
		<!-- The two images -->
		<img id = "jfk" src = "jfk.jpg" alt = "Assassination">
		<img id = "west" src = "west.jpg" alt = "In The West">
	</main>
	<footer> <!-- Opening a footer -->
		<p id = "disclaimer"> Legal stuff: <br> The intellectual property of Doctor Who belongs solely
		to BBC. Nothing about this website is in any way related to BBC. This is simply a project put together
		as a university assignment.</p> <!-- Adding a legal disclaimer to it -->
	</footer>
</div>

</body>
</html>