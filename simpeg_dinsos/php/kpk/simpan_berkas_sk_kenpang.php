<?php
	error_reporting(E_ALL ^ E_NOTICE);

	include "../koneksi.php";
	include "../fungsi.php";
	include "../mysqli_connect.php";
	require_once "../excel_reader2.php";
	
	$nomor_sk = $_POST['no_sk'];
	
	/*INFO OF FILES*/
	
	$tmp = $_FILES['filename']['tmp_name'];
	$fname = $_FILES['filename']['name'];
	$DIR = "../../sys_files/scan_sk_kenpang/".$fname;
	
	// upload dahulu
	move_uploaded_file($tmp, $DIR);
	
	if(file_exists($DIR)){	
		$data = new Spreadsheet_Excel_Reader($DIR);
	}	
		$sql = "";
	
		for($i=5; $i <= $data->rowcount(0); $i++){
		// Cek Jika Pada Suatu Baris Nilainya Kosong atau Tidak
			if($data->value($i,1,0) != ""){		
				//$data->value($i,1,0);
				$no_bkn = $data->value($i,2,0);
				$tgl_bkn = $data->value($i,3,0);
				$nip = $data->value($i,5,0);
				$pendidikan = $data->value($i,6,0);
				$tmt_lama = $data->value($i,8,0);
				$mkgt_lama = $data->value($i,9,0);
				$mkgb_lama = $data->value($i,10,0);
				$gapok_lama = $data->value($i,11,0);
				$jabatan = $data->value($i,12,0);
				$tmt_baru = $data->value($i,14,0);
				$mkgt_baru = $data->value($i,15,0);
				$mkgb_baru = $data->value($i,16,0);
				$skpd = $data->value($i,19,0);
				$no_sk = $data->value($i,21,0);
				$tgl_sk = $data->value($i,22,0);
				$sql .= "INSERT INTO tbl_scan_sk_kenpang VALUES(NULL, '".$no_bkn."', '".$tgl_bkn."', '".$nip."', '".$pendidikan."', '".$tmt_lama."', 
					'".$mkgt_lama."','".$mkgb_lama."','".$gapok_lama."', '".$tmt_baru."', '".$mkgt_baru."', '".$mkgb_baru."', '".$jabatan."', 
					'".$skpd."', '".$nomor_sk."','".$tgl_sk."', '".$fname."');";
			}			
		}
		
		$query = $con->multi_query($sql);
		if($query){
			header("Location:../../cetak/sk/kepangkatan/render_upload_sk_kenpang.php?filename=".$fname);
		}
	
	