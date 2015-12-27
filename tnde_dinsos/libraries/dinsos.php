<?php
	error_reporting(0);
	//mysql_connect("localhost", "root", "dinsosrunning100%");
	mysql_connect("localhost", "root", "");
	mysql_select_db("db_disnakersos");
	$con = mysqli_connect("localhost", "root", "", "db_disnakersos");
	
	// Try to use mysqli connect module
	/*
	$con = new mysqli("localhost", "root", "", "db_disnakersos");
	// check the connection
	if($con->connect_error){
		trigger_error('Koneksi ke database gagal !!', E_USER_ERROR);
	}
	*/
?>