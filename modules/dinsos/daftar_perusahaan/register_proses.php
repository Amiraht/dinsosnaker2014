<?php
	/*data perusahaan*/
	
	$perusahaan =$_POST["dataper"];
	$tngkerja = $_POST["datatng"];

	$data = explode("/",$perusahaan);
	$data2 = explode("/",$tngkerja);
	
	$tambah= "insert into db_dinsos
				  (
		nama,alamat,kec,kel,telpon,kode_pos,nomor_akte,tgl_pendirian,
		jenis_usaha,id_status_perusahaan,klui,nama_pemilik,alamat_pemilik,
		nama_pengurus,alamat_pengurus,id_status_pemilik,id_status_permodalan
				  ) 
			  values 
			  	  ('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]'
				  ,'$data[8]','$data[9]','$data[10]','$data[11]','$data[12]','$data[13]','$data[14]','$data[15]','$data[16]'
				  )
			";
	
	$do = mysql_query($tambah);	
	
	$cek = mysql_query("select id_perusahaan from db_dinsos where nama='$data[0]'");
	
	$hasil=mysql_fetch_array($cek);
	
	$isVal = "0";
	$isSame = "0";
	
	$query = "insert into tbl_tenagakerja_dinsos (id_perusahaan,wnilk,wnipr,wnalk,wnapr,isValidate,isSesuai) 
			  values ($hasil[0],'$data2[0]','$data2[1]','$data2[2]','$data2[3]',$isVal,$isSame)";	
	$do2 = mysql_query($query);
	
	//echo $tambah;
	//echo $query;
	
	if($do2)
		{

			echo "<script type='text/javascript'>
				alert('DATA PERUSAHAAN BERHASIL DITAMBAHKAN');
				document.location = './index.php?mod=dinsos&do=daftar';
				</script>";
		}
		else
		{
			echo "<script type='text/javascript'>
				alert('DATA PERUSAHAAN GAGAL DITAMBAHKAN');
				document.location = './index.php?mod=dinsos&do=daftar&act=register';
				</script>";
		}
?>