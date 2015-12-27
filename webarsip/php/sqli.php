<?php

	$host = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbsett = "db_arsip";
	
	$con = mysqli_connect("$host","$dbuser","$dbpass","$dbsett");
	
	if(!$con){
		echo mysqli_error($con);
	}
