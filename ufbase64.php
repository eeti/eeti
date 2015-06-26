<?php
require("login.php");
require("includes/database.inc.php");

// I wonder where this was copied from
function generate_name () {
	global $settings;
	global $db;
	global $doubledots;
	// We start at N retries, and --N until we give up
	$tries = POMF_FILES_RETRIES;
	$ext   = "png"; //chrome uploads pngs from clipboards

	do {
		// Iterate until we reach the maximum number of retries
		if ($tries-- == 0) throw new Exception('Gave up trying to find an unused name', 500);
		$chars = 'abcdefghijklmnopqrstuvwxyz';
		$name  = '';
		for ($i = 0; $i < 6; $i++) {
			$name .= $chars[mt_rand(0, 25)];
			// $chars string length is hardcoded, should use a variable to store it?
		}
		// Add the extension to the file name
		if (isset($ext) && $ext !== '')
			$name .= '.' . strip_tags($ext);
		// Check if a file with the same name does already exist in the database
		$q = $db->prepare('SELECT COUNT(name) FROM pomf WHERE name = (:name)');
		$q->bindValue(':name', $name, PDO::PARAM_STR);
		$q->execute();
		$result = $q->fetchColumn();
	// If it does, generate a new name
	} while($result > 0);
	return $name;
}

// I wonder where this was copied from
function put_in_database($origbase64, $name){

	global $db;
	$q = $db->prepare('INSERT INTO files (hash, originalname, filename, size, date, ' .
        	'expire, delid) VALUES (:hash, :orig, :name, :size, :date, ' .
        	':exp, :del)');

	// Common parameters binding
	$q->bindValue(':hash', sha1($origbase64),       PDO::PARAM_STR);
	$q->bindValue(':orig', "imagepaste" . time() . ".png", PDO::PARAM_STR);
	$q->bindValue(':name', $name,                PDO::PARAM_STR);
	$q->bindValue(':size', strlen($origbase64),             PDO::PARAM_INT);
	$q->bindValue(':date', date('Y-m-d'),           PDO::PARAM_STR);
	$q->bindValue(':exp',  null,                    PDO::PARAM_STR);
	$q->bindValue(':del',  sha1($origbase64),   PDO::PARAM_STR);
	$q->execute();

	file_put_contents(POMF_FILES_ROOT . $name, base64_decode($origbase64));
}

if( ! @isset($_POST['base64']) ){
	http_response_code(400);
	die("Need a base64.");
}

try {
	$name=generate_name();
	put_in_database($_POST['base64'], $name);
	die(POMF_URL . $name);
} catch(Exception $e) {
	http_response_code($e->getCode());
	die($e->getMessage());
}


?>
