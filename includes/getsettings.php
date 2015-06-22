<?php
	require_once("includes/settings.inc.php");
	$settings = array();

	$k=file_get_contents(constant("EETI_USER_PREFS"));
	$k=explode("\n", $k);
	for( $i=0; $i<count($k); $i++ ){
		$tmp = explode(",", $k[$i]);
		if( $tmp[0] == $_SESSION['user'] ){
			$settings['set'] = true;
			if( ! @isset($tmp[1]) || $tmp[1] == "0" ) $settings['fn'] = false;
			else $settings['fn'] = true;
		}
	}

	// use defaults if none exist
	if( ! @isset($settings['set']) ){
		$settings['set'] = true;
		$settings['fn'] = false;
	}
?>
