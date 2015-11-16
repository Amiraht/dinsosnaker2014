<?php
	
	mysql_connect("localhost", "root", "");
	mysql_select_db("db_disnakersos");
	
	
// fungsi untuk menentukan nilai id maks setiap tabel database
   function setIDTabel($nama_tabel, $FIELD_ID){
	   $id = 0;
	   $sql = "SELECT MAX(".$FIELD_ID.") as maks FROM ".$nama_tabel."";
	   $query = mysql_query($sql) or die(mysql_error());
	   $fetch = mysql_fetch_array($query);
	   $tmp = $fetch['maks'];
	   
	   if($tmp <= 0){
		   $id = 1;
	   }else{
		   $id = (int) ($tmp + 1);
	   }
	   mysql_close(); // close the connection stream database
	   return $id;
   }	
   
   function anti_injection($data)
{
	$data1 = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
	return $data1;
}
	
	echo "TEST";
	// all POST VARIABLES from baru_iplk.php file
// CMIIWW
$id_per = anti_injection($_POST["id_per"]);
$nama_pemohon = anti_injection($_POST["nama_pemohon"]);
$alamat_pemohon = anti_injection($_POST["alamat_pemohon"]);
$no_hp = anti_injection($_POST["no_hp"]);
$nama_lembaga = anti_injection($_POST["nama_lembaga"]);
$no_akte = anti_injection($_POST["no_akte"]);
$nama_penanggung_jawab = anti_injection($_POST["nama_penanggung_jawab"]);
$bentuk_usaha = anti_injection($_POST["bentuk_usaha"]);
$sumber_siswa = anti_injection($_POST["sumber_siswa"]);
$sumber_biaya = anti_injection($_POST["sumber_biaya"]);
$sifat = anti_injection($_POST["sifat"]);
$id_urus = setIDTabel("tbl_berkas_iplk", "id_urus_janji");
$id_berkas = setIDTabel("tbl_info_berkas", "id");
echo "ID URUS : " . $id_urus . "<br/>";