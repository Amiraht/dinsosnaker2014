<?php

	// set the conection config bro
	$DBServer = "localhost"; // server name or IP Address
	$DBUser = "root";
	$DBPassword = "";
	$DBName = "db_simpeg_medan";
	
	$con = new mysqli($DBServer, $DBUser, $DBPassword, $DBName);
	
	// check the connection
	if($con->connect_error){
		trigger_error('Koneksi ke database gagal !!', E_USER_ERROR);
	}