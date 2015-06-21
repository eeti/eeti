<?php include("login.php"); ?>
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
					</ul>
				</nav>
				<!-- welcome tab -->
				<div id="welcome" class="tab">
					<p class="lead">Welcome to eeti.me!</p>
					I'll eventually put some updates here or something but there's nothing here yet. Pomf on~
				</div>

				<!-- uploads tab -->
				<div id="uploads" class="tab" style="display: none;">
					<p class="lead">
						You can upload files up to 50MB here as long as they follow our <a href="#" onClick="loadTab('rules');">simple rules</a>.
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
					<input type="file" id="upload-input" name="files[]" multiple="multiple" data-max-size="50MiB">
						<ul id="upload-filelist"></ul>
				</div>
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
							<b>Don't be a prick.</b> Don't constantly upload 50MB files, don't DDoS the site, don't hurt other people, don't distribute viruses. We're <i>very</i> fair.
						</li>
						<li>
							<b>Don't do anything that will get me sued or blacklisted.</b> Seriously. Don't. I will find you.
						</li>
						<li>
							<b>Don't share your login details.</b> Pretty self-explanatory. You are resposible for what happens under your account.
						</li>
					</ol>
				</div>
				<div id="configuration" class="tab" style="display: none;">
					<p class="lead">User Configuration Panel</p>
					<form action="">
  						<input type="checkbox" name="usrdeffn" value="usrdeffn"> Upload link uses filename<br>
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
			<script src="js/zepto.js"></script>
			<script src="js/pomf.js.php"></script>
			<script src="js/cheesesteak.js"></script>
			<script src="js/cabinet.js"></script>
			<script src="eetime.js"></script>
		</div>
	</body>
</html>
