<?php
ini_set("display_errors", "on");
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

require_once getcwd()."/ContactDirectory.php";


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
			
			$directory = new ContactDirectory();
			header('Content-Type: application/json;charset=UTF-8');
			header('Access-Control-Allow-Origin: *');
			echo $directory->raw();
			exit;

			break;
		case '/contact/':

			$post = file_get_contents("php://input");
			parse_str($post, $postData);

			$directory = new ContactDirectory();
			$directory->load();
			if ($directory->addContact($postData))
			{
				header('Content-Type: application/json;charset=UTF-8');
				echo json_encode(['error' => false, 'message' => 'ok']);
			} else {
				header('Content-Type: application/json;charset=UTF-8');
				echo json_encode(['error' => true, 'message' => 'error saving data ' . print_r($postData, true)]);
			}
			exit;
			break;			
		default;
			echo "<p>Welcome to PHP</p>";
			break;
	}
}
?>