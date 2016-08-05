<?php
ini_set("display_errors", "on");
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
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
		case '/contacts/':
			header('Content-Type: application/json;charset=UTF-8');
			$users = file_get_contents(__DIR__ . '/data/contacts.json');
			echo $users;
			exit;
			break;
		default;
			echo "<p>Welcome to PHP</p>";
			break;
	}
}
?>