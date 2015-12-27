<?php

	include "../koneksi.php";
	include "../fungsi.php";
	include "../mysqli_connect.php";
	
	$id_detail = $_GET['id'];
	$id_usulan = $_GET['id_usulan'];
	$id_pegawai = getIDPegawaiDetailPg($id_detail);
	$nama = detail_pegawai_by_id($id_pegawai, "nama_pegawai");
	$encode = base64_encode($nama);
	
	$sql = "UPDATE tbl_usulan_pg_detail SET status = 3 WHERE id_usulan_pg_detail = ?";
	
	$stm = $con->prepare($sql);
	
	$stm->bind_param('i', $id_detail);
	
	$query = $stm->execute();
	
	if($query){
		header("Location:../../?mod=supervisi_pegawai_usulan_pg&id_usulan=".$id_usulan."&code=1&name=".$encode);
	}