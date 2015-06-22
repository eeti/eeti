<?php

include("login.php");

$prefsupdated=false;

if( @isset($_POST['supd']) ){
	$prefs=file_get_contents(constant("EETI_USER_PREFS"));
	if( $prefs != "" ) $prefs = explode("\n", $prefs);
	else $prefs = array();
	//unset($prefs[count($prefs)-1]);
        $lineno = -1;

	for($i=0; $i<count($prefs); $i++){
		if( $prefs[$i] == "" ) continue;
		$pex = explode(",", $prefs[$i]);
		if( $pex[0] == $_SESSION['user'] ){
			$lineno = $i;
		}
	}

	if( $lineno >= 0 ){
		unset($prefs[$lineno]);
		array_values($prefs);
	}

	$str = $_SESSION['user'] . ",";

	// let's go through each thing now...

	if( @isset($_POST['usrdeffn']) ) $str .= "1,";
	else $str .= "0,";

	foreach($prefs as $key => $value){
		if( $prefs[$key] == "" ) unset($prefs[$key]);
	}

	array_values($prefs);

	// okiedone

	array_push($prefs, $str);
	file_put_contents(constant("EETI_USER_PREFS"), implode($prefs, "\n"));

	$prefsupdated=true;

}

include("includes/getsettings.php");

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title>eeti.me!</title>
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="pomf.css">
	</head>
	<body>
		<img height="65px;" src="http://sw.eeti.me/eeti-me.png"></img>
		<div class="container">
			<div class="jumbotron">
				<h1>Ohayou, <?php echo $_SESSION['user']; ?>!</h1>
				<nav>
					<ul class="lead">
						<li><a href="#" onClick="loadTab('welcome');">Welcome</a></li>
						<li><a href="#" onClick="loadTab('rules');">Rules</a></li>
						<li><a href="#" onClick="loadTab('uploads');">Uploads</a></li>
						<li><a href="#" onClick="loadTab('shorten');">Shorten</a></li>
						<li><a href="#" onClick="loadTab('config');">Settings</a></li>
					</ul>
				</nav>
				<!-- welcome tab -->
				<div id="welcome" class="tab">
					<p class="lead">Welcome to eeti.me!</p>
					<p class="lead">Read our <a href="#" onClick="loadTab('rules');">rules</a> (please)</p>
					<div style="text-align: left;">
						<h2>0.1.2 - 21 June 2015</h2>
						<ul>
							<li><a href="#" onClick="loadTab('shorten');">Added URL shortening.</a></li>
						</ul>
						<h2>0.1.1 - 21 June 2015</h2>
						<ul>
							<li>Added <a href="#" onClick="loadTab('config');">a settings page</a>.</li>
							<li>Added the ability to name uploaded files after their originals.</li>
						</ul>
					</div>
				</div>

				<!-- uploads tab -->
				<div id="uploads" class="tab" style="display: none;">
					<p class="lead">
						You can upload files up to 10MB here as long as they follow our <a href="#" onClick="loadTab('rules');">simple rules</a>.
					</p>
					<noscript>
						<p class="alert alert-error"><strong>Enable JavaScript</strong>, it's not gonna hurt you</p>
					</noscript>
					<p id="no-file-api" class="alert alert-error">
						<strong>Your browser is old.</strong>
						Install the latest <a href="http://firefox.com/">Firefox</a> or <a href="http://chrome.google.com/">Chrome</a> and come back &lt;3
					</p>
					<a href="javascript:;" id="upload-btn" class="btn">
						Select <span>or drop</span> file(s) here~
					</a>
					<input type="file" id="upload-input" name="files[]" multiple="multiple" data-max-size="10MiB">
						<ul id="upload-filelist"></ul>
				</div>

				<!-- rules tab -->
				<div class="tab" id="rules" style="display: none;">
					<p class="lead">
						<b>Rules of eeti.me</b><br>
						<i>We don't really like rules, so we'll keep this short.</i>
					</p>
					<ol>
						<li>
							<b>Don't be dumb.</b> You were invited here for a reason and you are seen as mentally competent. eeti.me is a privilege, not a right.
						</li>
						<li>
							<b>Don't be a prick.</b> Don't constantly upload 10MB files, don't DDoS the site, don't hurt other people, and don't distribute viruses. We're <i>very</i> fair.
						</li>
						<li>
							<b>Don't do anything that will get me sued or blacklisted.</b> Seriously. Don't. I will find you.
						</li>
						<li>
							<b>Don't share your login details.</b> Pretty self-explanatory. You are resposible for what happens under your account.
						</li>
					</ol>
				</div>

				<!-- url shortening tab -->
				<div id="shorten" class="tab" style="display: none;">
					<p class="lead">Shorten a URL...</p>
					<div id="error"></div>
					<input type="text" id="url"></input>
					<input type="button" value="Shorten" onclick="shortenURL();"></input>
				</div>

				<!-- prefs tab -->
				<div id="config" class="tab" style="display: none;">
					<?php if( $prefsupdated === true ){ ?><div class="alert alert-info">Settings updated.</div><?php } ?>
					<p class="lead">eeti.me Settings</p>
					<form action="" method="post">
						<input type="hidden" name="supd" value="true"></input><br>
  						<input type="checkbox" name="usrdeffn" value="yes" <?php if($settings['fn']){ ?> checked="checked" <?php } ?>> Upload link uses filename<br>
  						<input type="submit" value="Update">
					</form>
				</div>
			</div>
			<nav>
				<ul>
					<li><a href="/logout.php">Log out</a></li>
					<li>Service run by <a href="http://sw.eeti.me/">Sweeti Alexandra</a></li>
					<li><a href="https://github.com/nokonoko/Pomf">Based on Pomf</a></li>
				</ul>
			</nav>
			<!-- come on chrome >.< -->
			<script src="js/jquery.min.js"></script>
			<script src="js/zepto.js"></script>
			<script src="js/pomf.js.php"></script>
			<script src="js/cheesesteak.js"></script>
			<script src="js/cabinet.js"></script>
			<script src="eetime.js"></script>
			<?php if(@isset($_POST['supd'])) { ?><script type="text/javascript">loadTab('config');</script><?php } ?>
		</div>
	</body>
</html>
