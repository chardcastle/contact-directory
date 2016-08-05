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

	<script type="text/javascript" src="js/jquery.min.js"></script>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="styles.css" />

	<script type="text/javascript" src="js/script.js"></script>
</head>
<body>
	<div class="container">
		<h1>My Directory</h1>
		<div id="search">
			<div class="form-group">
				<input type="text" class="form-control" name="lookup" id="lookup" class="lookup" placeholder="search for a contact" />
			</div>
		</div>
		<div class="newContact">
			<a href="#" id="newContact" class="btn btn-default" data-toggle="modal" data-target="#newContactModal">Create a new contact</a>
			<div class="modal fade" id="newContactModal" tabindex="-1" role="dialog" aria-labelledby="newContact">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="myModalLabel">Create a new contact</h4>
			      </div>
			      <div class="modal-body">
					<form method="post" class="newContactForm">
					 	<div class="form-group">
							<label for="forename">Forename</label>
							<input type="text" class="form-control" id="forename" required />
						</div>
						<div class="form-group">
							<label for="surname">Surname</label>
							<input type="text" class="form-control" id="surname" required />
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="text" class="form-control" id="email" required />
						</div>
						<div class="form-group">
							<label for="telephone">Telephone</label>
							<input type="text" class="form-control" id="telephone" required />
						</div>
						<div class="form-group">
							<label for="address">Address</label>
							<textarea id="address" class="form-control" cols="20" rows="5" required></textarea> 
						</div>
						<input type="submit" class="btn btn-primary" value="Make it" />
						<a href="#" data-dismiss="modal" class="btn btn-default">Cancel</a>
					</form>
				</div>
			</div>
			</div>
			</div>
		</div>

		<div class="left">
		<h2>Contact List</h2>
			<ul id="contactList">
				<li class="contact">
					<button class="btn btn-default">Add to my favourites</button>
				</li>
			</ul>
		</div>

		<div class="right">
		<h2>My Favourites</h2>
			<ul id="myContacts" class="contactList">
				<li class="contact"></li>
			</ul>
		</div>

	</div>
</body>
</html>
<script type="text/javascript">
	$(function() {

	});
</script>