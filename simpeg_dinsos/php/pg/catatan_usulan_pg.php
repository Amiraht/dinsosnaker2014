<?php
	
	include "../koneksi.php";
	include "../fungsi.php";
	include "../mysqli_connect.php";
	
	// data
	$catatan = $_POST['catatan'];
	$id_detail_pg = $_POST['id_detail_pg'];
	$id_usulan = $_POST['id_usulan'];
	$id_pegawai = getIDPegawaiDetailPg($id_detail_pg);
	$nama = detail_pegawai_by_id($id_pegawai, "nama_pegawai");
	$encode = base64_encode($nama);
	$status = 1;
	
	$sql = "UPDATE tbl_usulan_pg_detail SET status = ?, catatan = ? WHERE id_usulan_pg_detail = ?";
	
	$stm = $con->prepare($sql);
	
	$stm->bind_param('isi', $status, $catatan, $id_detail_pg);
	
	$query = $stm->execute();
	
	if($query){
		header("Location:../../?mod=supervisi_pegawai_usulan_pg&id_usulan=".$id_usulan."&code=2&name=".$encode);
	}
	