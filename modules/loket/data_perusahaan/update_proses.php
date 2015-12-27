<?php
include("../../../libraries/dinsos.php");
/*data perusahaan*/

	$id_per=$_POST['hidden'];
	
	$a = $_POST['nama'];$b = $_POST['alamat'];$c = $_POST['kecamatan'];$d = $_POST['kelurahan'];$e = $_POST['telpon'];
	$f = $_POST['kd_pos'];$g = $_POST['no_akte'];$h=$_POST['tgl_diri'];$i=$_POST['jns_usaha'];$j=$_POST['status_per']; 
	
	/*data pemilik*/
	$k = $_POST['pemilik'];$l = $_POST['alamat_pemilik'];$m = $_POST['pengurus'];$n = $_POST['alamat_pengurus'];
	$o = $_POST['status_pemilik'];$p = $_POST['status_modal'];
	
	
	/*data tenaga kerja*/
	$q = $_POST['wnip'];$r = $_POST['wniw'];$s = $_POST['wnap'];$t = $_POST['wnaw'];

	if($a!="")	
		{				
			$query = "update db_dinsos 
						set 
						 nama = '$a', alamat='$b', telpon='$e',kode_pos='$f',
						 jenis_usaha='$i',nama_pemilik='$k',alamat_pemilik='$l',
						 nama_pengurus='$m',alamat_pengurus='$n',
						 tgl_pendirian='$h',nomor_akte='$g',id_status_perusahaan='$j',
						 id_status_pemilik='$o',id_status_permodalan='$p',kec='$c',kel='$d'
						 where id_perusahaan='$id_per'";
				  
			$query2 = "UPDATE tbl_tenagakerja_dinsos 
						SET wnilk='$q',wnipr='$r',wnalk='$s',wnapr='$t'  
						where id_perusahaan='$id_per'" ; 	  
		}
	$do = mysql_query($query);
	$do2 = mysql_query($query2);
		
		if(($do)&&($do2))
		{

			echo "<script type='text/javascript'>
				alert('DATA PERUSAHAAN BERHASIL DI UBAH');
				</script>";
		}
		else
		{
			echo "<script type='text/javascript'>
				alert('DATA PERUSAHAAN GAGAL DIUBAH');
				</script>";
		}
 ?>