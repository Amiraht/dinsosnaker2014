<?php
	session_start();
	include "koneksi.php";
	
	$username = $_POST['username'];
	$password = $_POST['new_pass'];
	
	$sql = "UPDATE tbl_pengguna SET password = '".$password."' WHERE username = '".$username."'";
	
	$query = mysql_query($sql);
	
	if($query){
		print "<div class='alert alert-success' role='alert' id='alert_add_sukses'>";		
		print "<center><img src='image/icn_alert_success.png' width='18px;' />&nbsp;&nbsp;";
		print "Password Sudah Anda Ubah.<br/></center>";
		print "</div>";
	}else{
		print "<div class='alert alert-warning' role='alert' id='alert_add_sukses'>";		
		print "<center><img src='image/icn_alert_warning.png' width='18px;' />&nbsp;&nbsp;";
		print "Terjadi kesalahan proses, password gagal diubah.<br/></center>";
		print "</div>";
	}
	
	mysql_close();