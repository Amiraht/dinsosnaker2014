<?php

	$host = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbsett = "tnde_dinsos";
	
	$con = mysqli_connect("$host","$dbuser","$dbpass","$dbsett");
	
	if(!$con){
		echo mysqli_error($con);
	};
?>