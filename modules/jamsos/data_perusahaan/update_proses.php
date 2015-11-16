<?php
include("../../../libraries/dinsos.php");
/*data perusahaan*/

	$id_per=$_POST['hidden'];
	
	$a = $_POST['nama'];$b = $_POST['alamat'];$c = $_POST['kecamatan'];$d = $_POST['kelurahan'];$e = $_POST['telpon'];
	$f = $_POST['kd_pos'];$g = $_POST['no_akte'];$h=$_POST['tgl_diri'];$i=$_POST['jns_usaha'];$j=$_POST['status_per']; 
	$u = $_POST['klui'];
	
	/*data pemilik*/
	$k = $_POST['pemilik'];$l = $_POST['alamat_pemilik'];$m = $_POST['pengurus'];$n = $_POST['alamat_pengurus'];
	$o = $_POST['status_pemilik'];$p = $_POST['status_modal'];
	
	
	/*data tenaga kerja*/
	$q = $_POST['wnip'];$r = $_POST['wniw'];$s = $_POST['wnap'];$t = $_POST['wnaw'];
	
	if($a!="")
	{
		$update1="	UPDATE db_jamsostek
					SET
						nama='$a', alamat='$b', kec='$c', kel='$d',
						telpon='$e', kode_pos='$f', nomor_akte='$g',
						tgl_pendirian='$h', jenis_usaha='$i', id_status_perusahaan='$j',
						klui='$u',
						nama_pemilik='$k',alamat_pemilik='$l',nama_pengurus='$m',
						alamat_pengurus='$n',
						id_status_pemilik='$o',id_status_permodalan='$p'
					WHERE
						id_perusahaan='$id_per'	
		";
		
		$data = "select count(id_perusahaan) from tbl_tenagakerja_jamsos where id_perusahaan=$id_per";
		$fetch=mysql_query($data);
		$cek=mysql_fetch_array($fetch);
		if($cek[0] > 0)
			{
				$update2="	UPDATE tbl_tenagakerja_jamsos 
					SET 
						wnilk='$q',wnipr='$r',wnalk='$s',wnapr='$t'  
					WHERE 
					id_perusahaan = '$id_per'";
			}
		else
			{
				$update2 = "INSERT INTO tbl_tenagakerja_jamsos (id_perusahaan,wnilk,wnipr,wnalk,wnapr,isValidate,isSesuai) values 
							('$id_per','$q','$r','$s','$t',0,0)
							";
			}
		
	}
	else
		echo "
			<script>
				alert('Nama Perusahaan Tidak Boleh Kosong');
				history.back();
			</script>
		";
	
	$execute = mysql_query($update1);
	$execute2 = mysql_query($update2);

	if(($execute)&&($execute2))
		{

			echo "<script type='text/javascript'>
				alert('DATA PERUSAHAAN BERHASIL DI UBAH');
				</script>";
		}
		else
		{
			echo "<script type='text/javascript'>
				alert('DATA PERUSAHAAN GAGAL DIUBAH');
				break();
				history.back();
				</script>";
		}
 ?>