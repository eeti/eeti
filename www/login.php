<?php

	require("includes/settings.inc.php");
	require("includes/authenticate.php");

	session_start();

	if( @isset($_POST['user']) && @isset($_POST['pass']) ){
		$r=authenticate($_POST['user'], $_POST['pass']);
		if( $r['success'] ){
			$_SESSION['user']=$r['user'];
			$_SESSION['pass']=$r['pass'];
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
