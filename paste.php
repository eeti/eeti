<?php
	require("login.php");
	require("includes/database.inc.php");

	function generate_name() {
		global $settings;
		global $db;

		// We start at N retries, and --N until we give up
		$tries = POMF_FILES_RETRIES;
		$ext = "txt";

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

	try {
		if( ! @isset($_POST['paste']) ) throw new Exception("No paste given");
		$name=generate_name();
		file_put_contents(POMF_FILES_ROOT . $name, $_POST['paste']);
		die(POMF_URL . $name);
	} catch(Exception $e){
		header("500 Internal Server Error");
		die("Could not save paste for some reason. Try again later?");
	}
?>
