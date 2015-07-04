<?php

	require("includes/settings.inc.php");
	require("includes/authenticate.php");

	if( ! EETI_ENABLE_API ){
		http_response_code(400);
		die("The eeti.me API is not currently enabled.");
	}

	function respond($payload, $code, $version = "v1"){
		http_response_code($code);
		header("Content-Type: text/json");
		header("X-Served-By: eeti-api " + $version);
		die(json_encode($payload));
	}

	function authcodeok($code){
		return ! (file_exists("../key/" . $code));
	}

	if( ! @isset($_POST['token']) && ! ( @isset($_POST['user']) || @isset($_POST['password']) ) ){
		respond(array("success" => false, "error" => "need token or username/password"), 400);
	}

	if( $_GET['version'] == "1" ){
		if( $_GET['action'] == "gettoken" ){
			if( ! @isset($_POST['user']) || ! @isset($_POST['password']) ) respond(array("success" => false, "error" => "no username/password provided"), 400);
			$r=authenticate($_POST['user'], $_POST['password']);

			if( ! $r['success'] ) respond(array("success" => false, "error" => $r['error']), 400);

			// generate random token
			$valid="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz01234567890";
			$count=0;
			do {
				$str="";
				for( $i=0; $i<30; $i++ ){
					$str.=$valid[rand(0, strlen($valid))];
				}
				$count+=1;
			} while( ! authcodeok($str) && $count < POMF_FILES_RETRIES );

			if( $count >= POMF_FILES_RETRIES ){
				respond(array("success" => false, "error" => "tried too many times to generate a session token"), 500);
			}

			if( ! file_put_contents("../key/" . $str, $r['user']) ) respond(array("success" => "false", "error" => "error saving session key"), 500);

			respond(array("success" => true, "key" => $str), 200);
		}

		if( ! $_POST['token'] ) respond(array("success" => false, "error" => "need token for other api methods"), 400);

		//else {
			respond(array("success" => false, "error" => "invalid API method"), 400);
		//}
	}
	else {
		respond(array("success" => false, "error" => "invalid API version"), 400);
	}
?>
