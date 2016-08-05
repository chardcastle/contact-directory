<?php
/**
 * Router to serve requests
 */
if (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $_SERVER["REQUEST_URI"])) {
	// serve the requested (asset) resource as-is
    return false;
} else { 
	switch ($_SERVER["REQUEST_URI"])
	{
		case '/':
			echo "<p>Home</p>";
			break;
		case '/contacts':
			echo "<p>Contacts here</p>";
			break;
		default;
			echo "<p>Welcome to PHP</p>";
			break;
	}
}
?>