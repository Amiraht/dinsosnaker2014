<?php
	
	include "../koneksi.php";
	include "../fungsi.php";
	include "../mysqli_connect.php";
	
	// data
	$catatan = $_POST['catatan'];
	
	$id_detail_pi = $_POST['id_detail_pi'];
	$id_usulan = $_POST['id_usulan'];
	$id_pegawai = getIDPegawaiDetailPi($id_detail_pi);
	$nama = detail_pegawai_by_id($id_pegawai, "nama_pegawai");
	$encode = base64_encode($nama);
	$status = 1;
	
	$sql = "UPDATE tbl_usulan_pi_detail SET status = ?, catatan = ? WHERE id_pi_detali = ?";
	
	$stm = $con->prepare($sql);
	
	$stm->bind_param('isi', $status, $catatan, $id_detail_pi);
	
	$query = $stm->execute();
	
	if($query){
		header("Location:../../?mod=supervisi_usulan_pegawai_pi&id_usulan=".$id_usulan."&code=2&name=".$encode);
	}
	