
<?php
    $servername = "us-cdbr-iron-east-01.cleardb.net";
    $username = "bc000a9d35d22f";
    $password = "6580f159";
    $dbname = "heroku_6d77d31d03d7e6f";
	ini_set('display_errors', 1);
	ini_set('dispaly_startup_errors',1);
	error_reporting(E_ALL);
	
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
?>
