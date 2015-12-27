<?php
	session_start();
?>
<script src="../../js/jquery-1.7.2.min.js"></script>
<script src="../../js/jquery.alerts.js"></script>
<link rel="stylesheet" href="../../js/alert/jquery.alerts.css" />

<?php
    include("../koneksi.php");
    include("../fungsi.php");
	
	$id_data = mysql_real_escape_string($_GET['id']);
	
	/* cek file scan ijazah yang pernah di upload */
	/* jika ditemukan maka hapus kembali file tersbut */
	$existing_filename = get_existing_filename($id_data);
	$dir = "../../ijazah_uploaded/riwayat_pendidikan/" . $existing_filename;
	
	if(file_exists($dir)){
		// hapus data file
		unlink($dir);
	}
	
	$sql = "DELETE FROM tbl_riwayat_pendidikan WHERE id_data_rp = '$id_data'";
	$delete = mysql_query($sql);
	
	if($delete){
			
			if($_SESSION['simpeg_id_level'] == 1 || $_SESSION['simpeg_id_level'] == 2){
				echo "
					<script>
						jAlert('Hapus Riwayat Pendidikan Sukses', 'PESAN SUKSES');
						document.location.href = '../../?mod=riwayat_pendidikan_pegawai';
					</script>	
				";
			}else{
				echo "
					<script>
						jAlert('Hapus Riwayat Pendidikan Sukses', 'PESAN SUKSES');
						document.location.href = '../../?mod=riwayat_pendidikan';
					</script>	
				";
			}
	}else{
			if($_SESSION['simpeg_id_level'] == 1 || $_SESSION['simpeg_id_level'] == 2){
				echo "
					<script>
						jAlert('Hapus Riwayat Pendidikan Gagal', 'ERROR');
						document.location.href = '../../?mod=riwayat_pendidikan_pegawai';
					</script>	
				";
			}else{
				echo "
					<script>
						jAlert('Hapus Riwayat Pendidikan Gagal', 'ERROR');
						document.location.href = '../../?mod=riwayat_pendidikan';
					</script>	
				";
			}
	}	
	
