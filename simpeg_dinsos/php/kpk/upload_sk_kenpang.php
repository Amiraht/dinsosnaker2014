<?php
	
	include("../mysqli_connect.php");
	include("../koneksi.php");
	include("../fungsi.php");
	
	 function something_wrong($what_is_wrong){
        echo("
            <script type='text/javascript'>
                alert(\"" . $what_is_wrong . "\");
				document.location.href = '../../?mod=kenpang_daftar_sk_diusulkan';
            </script>
        ");
    }
    function success(){
        echo("
            <script type='text/javascript'>
               document.location.href = '../../?mod=kenpang_daftar_sk_diusulkan';
            </script>
        ");
    }
	
	// all POST data
	$no_usul = mysql_real_escape_string($_POST['no_usul']);
	$no_sk = mysql_real_escape_string($_POST['no_sk']);
	
	// file info
	$fname = $_FILES['scan_sk_kenpang']['name'];
	$ftype = $_FILES['scan_sk_kenpang']['type'];
	$des = $_FILES['scan_sk_kenpang']['tmp_name'];
	
	// dir destination
	$tujuan = "../../sk_uploaded/kepangkatan/" . $fname;
	
	// cek validasi file
	if($ftype == "application/pdf" || $ftype == "application/msword" || $ftype == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"){
		
		$pangkat_list = get_id_pangkat_baru($no_usul);
		$ids = get_id_pegawai_baru($no_usul);
		
		$sql = "";
		$i = 0;
		foreach($pangkat_list as $pangkat){
			$sql .= "UPDATE tbl_pegawai SET id_pangkat = '" . $pangkat . "' WHERE id_pegawai = '". $ids[$i] ."';";
			$sql .= "UPDATE tbl_sk_kenpang SET scan_sk = '". $fname ."' WHERE no_sk = '". $no_sk ."';";
			$i++;
		}
		
		// proses upload file
		$upload = move_uploaded_file($des,$tujuan);
		
		if($upload){
			$query = $con->multi_query($sql);
			success();
		}else{
			something_wrong("Maaf, proses upload dan update data gagal !!");
		}
	
	}else{
		something_wrong("Tipe data file tidak valid !!");
	}
	