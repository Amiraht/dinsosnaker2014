<?php

	include "../koneksi.php";
	include "../fungsi.php";
	include "../mysqli_connect.php";
	
	$id_sk = $_POST['id_sk'];
	$id_detail = get_id_detail_sk_kenpang();
	
	$nip = $_POST['nip_11'];
	$id_pegawai = detail_pegawai_by_nip($nip, "id_pegawai");

	$id_pangkat_baru = get_field_usulan_kenpang_detail_by_id_pegawai($id_pegawai,"id_pangkat_baru");
	$id_jabatan_baru = get_field_usulan_kenpang_detail_by_id_pegawai($id_pegawai,"id_jabatan_baru");
	$status = 1;
	
	$sql = "INSERT INTO tbl_sk_kenpang_detail VALUES(?,?,?,?,?,?)";
	
	$stm = $con->prepare($sql);
	
	$stm->bind_param('iiiiii', $id_detail, $id_sk, $id_pegawai, $id_pangkat_baru, $id_jabatan_baru, $status);
	
	$query = $stm->execute();
	
	if($query){
		echo "
			<script>
				alert('Tambah Data Pegawai Sukses !!');
				document.location.href='../../?mod=sk_kenpang_tambah_pegawai&id_data=".$id_sk."';
			</script>	
		";
	}else{
		echo "
			<script>
				alert('Maaf, Tambah Data Gagal !!');
				document.location.href='../../?mod=sk_kenpang_tambah_pegawai&id_data=".$id_sk."';
			</script>	
		";
	}
	
			
	
	
	