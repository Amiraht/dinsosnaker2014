<?php
	include "../mysqli_connect.php";
	include "../koneksi.php";
	include "../fungsi.php";
	
		$id_sk = $_GET['id_sk'];
		$sql = "";
		$qr = "SELECT * FROM tbl_sk_kenpang_detail WHERE id_sk = '".$id_sk."'";
		
		$no_sk = get_field_in_table_sk_kenpang($id_sk, "no_sk");
		$tgl_sk = get_field_in_table_sk_kenpang($id_sk, "tgl_sk");
		$pejabat = get_field_in_table_sk_kenpang($id_sk, "nama_ttd_sk");
			
		$ex = mysql_query($qr) or die(mysql_error());
		$count = mysql_num_rows($ex);
		
		$sql .= "UPDATE tbl_sk_kenpang SET status_supervisi = 3 WHERE id_data = '".$id_sk."';";
			
		$index = getIDTabelRiwayatPangkat();
		while($row = mysql_fetch_array($ex)){
			
			$sql .= "UPDATE tbl_pegawai SET id_pangkat = '".$row['id_pangkat_baru']."' WHERE id_pegawai = '".$row['id_pegawai']."';";
			$sql .= "INSERT INTO tbl_riwayat_pangkat VALUES('".$index."', '".$row['id_pegawai']."', '".$row['id_pangkat_baru']."', 
					CURDATE(), '".$no_sk."', '".$tgl_sk."', '".$pejabat."','3');";
					
			$index++;	
		}
	
	
		$query = $con->multi_query($sql);
	
		if($query){
			echo "
				<script type='text/javascript'>
					alert('Data SK Kepangkatan telah di ACC!!');
				    document.location.href='../../?mod=kenpang_daftar_sk_diusulkan';	
				</script>	
			";
		}else{
			echo "
				<script type='text/javascript'>
					alert('Maaf, terjadi kesalahan proses ACC!!');
				    document.location.href='../../?mod=kenpang_daftar_sk_diusulkan';	
				</script>	
			";
		}	

function getIDTabelRiwayatPangkat(){
	$query = mysql_query("SELECT MAX(id_data) as 'Max' FROM tbl_riwayat_pangkat") or die(mysql_error());
	$row = mysql_fetch_array($query);
	$maks = $row['Max'];
	$ID = "";
	
	if($maks > 0){
		$ID = $maks + 1;
	}else{
		$ID = 1;
	}
	
	return $ID;
}
