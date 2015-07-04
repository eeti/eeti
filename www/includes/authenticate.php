<?php
function authenticate($user, $pass){
	$ups=file_get_contents(constant("EETI_AUTH_FILE"));
	$ups=explode("\n", $ups);
	unset($ups[count($ups)-1]);
	$ok=false;
	for( $i=0; $i<count($ups); $i++ ){
		$tmp=explode(",", $ups[$i]);
		if( $tmp[0] == $user && hash('sha256', EETI_SALT . $pass) == $tmp[1] ){
			$ok=true;
		}
	}
	if( ! $ok ){
		$error="Invalid username/password.";
	}

	$result=array();

	if( @isset($error) ){
		$result['success'] = false;
		$result['error'] = $error;
	}
	else {
		$result['success'] = true;
		$result['user'] = $user;
		$result['pass'] = $pass;
	}

	return $result;
}
?>
