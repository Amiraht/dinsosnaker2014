<?php
	// set up HOSTNAME, USERID, PASSWORD, DBNAME
	$host = "localhost";
	$user = "root";
	$password = "";
	$db_name = "simpeg_dinsos";
	
	// mysql mode connection
	$koneksi = mysql_connect($host, $user, $password) or die(mysql_error());
	mysql_select_db($db_name);
	
?>