<?php

	include "../mysqli_connect.php";

	$id = $_GET['id'];	
	
	$sql = "DELETE FROM ref_jabatan WHERE id_jabatan = '".$id."'";
	
	$query = $con->query($sql);
	
	if($query){
		header("Location:../../?mod=cp_manage_jabatan&msg=4");
	}else{
		header("Location:../../?mod=cp_manage_jabatan&msg=2");
	}
	
	
	