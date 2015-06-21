<?php
	if( ! php_sapi_name() == 'cli' ) die();
	include("includes/settings.inc.php");
	unset($argv[0]);
	$argv=array_values($argv);
	echo join(" ", $argv) . "\t";
	echo hash('sha256', EETI_SALT . join(" ", $argv)) . "\n";
?>
