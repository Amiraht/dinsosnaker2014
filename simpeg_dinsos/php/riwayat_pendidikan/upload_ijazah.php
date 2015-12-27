<?php
	
	include "../koneksi.php";
	
	$id_data = $_POST['id_data'];
	
	/* SELECT FILE INFO */
	$ck = mysql_query("SELECT scan_ijazah FROM tbl_riwayat_pendidikan WHERE id_data_rp = '".$id_data."'") or die(mysql_error());
	$ft = mysql_fetch_array($ck);
	$c_file = $ft['scan_ijazah'];
	
	/* Cek */
	$dir = "../../ijazah_uploaded/riwayat_pendidikan/";
	
	if(file_exists($dir . $c_file)){
		unlink($dir . $c_file);
	}
	
	/* FILE UPLOADED INFO */
	$fname = $_FILES['file']['name'];
	$ftype = $_FILES['file']['type'];
	$source = $_FILES['file']['tmp_name'];
	
	if($ftype != 'application/pdf'){
		echo "
			<script>
				alert('Maaf, Tipe File Anda Tidak Valid !!');
				document.location.href='../../?mod=upload_ijazah_pendidikan&id=".$id_data."';
			</script>	
		";
		exit;
	}
	$dest = $dir. $fname;
	$upload = move_uploaded_file($source, $dest);
	
	if($upload){
		$sql = "UPDATE tbl_riwayat_pendidikan SET scan_ijazah = '$fname' WHERE id_data_rp = '$id_data'";
		$query = mysql_query($sql);
		if($query){
			echo "
			<script>
				alert('Upload Sukses !!');
				document.location.href='../../?mod=riwayat_pendidikan_pegawai';
			</script>	
			";
		}else{
			echo "
			<script>
				alert('Maaf, Terjadi kesalahan pada proses query !!');
				document.location.href='../../?mod=upload_ijazah_pendidikan&id=".$id_data."';
			</script>	
		";
		}
	}else{
		echo "
			<script>
				alert('Maaf, Proses upload file gagal!!');
				document.location.href='../../?mod=upload_ijazah_pendidikan&id=".$id_data."';
			</script>	
		";
	}
	