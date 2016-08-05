<?php
	ini_set("display_errors", "on");
	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
	require_once getcwd()."/ContactDirectory.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My Directory</title>
	<link rel="stylesheet" href="normalize.css" />
	<link rel="stylesheet" href="styles.css" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
</head>
<body>
	<div class="container">
		<h1>My Directory</h1>
		<div id="search">
			<input type="text" name="lookup" id="lookup" class="lookup" placeholder="search for a contact" />
		</div>
		<div class="newContact">
		 <a href="#" id="newContact">Create a new Contact</a>
			<form method="post" class="hidden">
				<label>Forename</label>
				<input />
				<label>Surname</label>
				<input />
				<label>Email</label>
				<input />
				<label>Telephone</label>
				<input />
				<label>Address</label>
				<textarea></textarea> 
				<input type="submit" value="Make it" />
			</form>
		</div>

		<div class="left">
		<h2>Contact List</h2>
			<ul id="contactList">
				<li class="contact">
					<button>Add to my favourites</button>
				</li>
			</ul>
		</div>

		<div class="right">
		<h2>My Contacts</h2>
			<ul id="myContacts" class="contactList">
				<li class="contact"></li>
			</ul>
		</div>

	</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function() {

	});
</script>