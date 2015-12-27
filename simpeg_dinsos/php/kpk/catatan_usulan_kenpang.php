<?php

	include "../koneksi.php";
	include "../fungsi.php";
	include "../mysqli_connect.php";
	
	// data
	$catatan = $_POST['catatan'];
	$id_detail = $_POST['id_detail'];
	$id_usulan = getIDUsulanDetailKenpang($id_detail);
	$id_pegawai = getIDPegawaiDetailKenpang($id_detail);
	$nama = detail_pegawai_by_id($id_pegawai, "nama_pegawai");
	$encode = base64_encode($nama);
	$status = 1;
	
	$sql = "UPDATE tbl_detail_usulan_pangkat SET status = ?, catatan = ? WHERE id_detail = ?";
	
	$stm = $con->prepare($sql);
	
	$stm->bind_param('isi', $status, $catatan, $id_detail);
	
	$query = $stm->execute();
	
	if($query){
		header("Location:../../?mod=acc_usulan_pangkat&id_usulan=".$id_usulan."&code=2&name=".$encode);
	}
	