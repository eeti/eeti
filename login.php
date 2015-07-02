<?php

	include("includes/settings.inc.php");

//	echo EETI_AUTH_FILE;

	session_start();

	if( @isset($_POST['user']) && @isset($_POST['pass']) ){
		$ups=file_get_contents(constant("EETI_AUTH_FILE"));
		$ups=explode("\n", $ups);
		unset($ups[count($ups)-1]);

		for( $i=0; $i<count($ups); $i++ ){
			$tmp=explode(",", $ups[$i]);
			if( $tmp[0] == $_POST['user'] && hash('sha256', EETI_SALT . $_POST['pass']) == $tmp[1] ){
				$_SESSION['user']=$_POST['user'];
				$_SESSION['pass']=$_POST['pass'];
			}
		}

		if( ! @isset($_SESSION['user']) ){
			$error="Invalid username/password.";
		}

	}

	if( ( ! @isset($_SESSION['user']) || ! @isset($_SESSION['pass']) ) ){
?>

<html>
	<head>
		<link rel="stylesheet" href="./pomf.css"></link>
		<title>
			eeti.me!
		</title>
	</head>
	<body>
		<img height="65px;" src="http://sw.eeti.me/eeti-me.png"></img>
		<div class="jumbotron"><h1>Konichiwa!</h1>
		<p class="lead">Please log in to use eeti.me.</p></div>

		<?php if(@isset($error)){ ?>
		<p class="alert alert-error"><?php echo $error; ?></p>
		<?php } ?>

		<div style="text-align: center; align: center;" id="main">
			<form action="" method="post">
				Username: <input type="text" name="user"></input><br>
				Password: <input type="password" name="pass"></input><br>
				<input type="submit" value="Login"></input><br><br>
				<a href="#" onClick="requestInvite();">Request an invite</a>
			</form>
		</div>

		<nav><ul><li>Service run by <a href="http://sw.eeti.me/">Sweeti Alexandra</a></li><li><a href="https://github.com/nokonoko/Pomf">Based on Pomf</a></li></ul></nav>
	</body>
	<script src="/js/eetime.js"></script>
</html>
<?php
		die();

	}

?>
