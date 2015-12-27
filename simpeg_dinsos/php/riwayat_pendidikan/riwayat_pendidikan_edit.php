<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    
	function pesan($isi){
        echo("
            <script type='text/javascript'>
                window.parent.window.pesan(\"" . $isi . "\");
            </script>
        ");
    }
	
	// all variables
	$id = $_POST['id_rp'];
	$nip = mysql_real_escape_string($_POST['nip']);
	$tingkat = $_POST['tk_pendidikan'];
	$tempat = mysql_real_escape_string($_POST['tempat_pendidikan']);
	$nomer = mysql_real_escape_string($_POST['no_ijazah']);
	$tgl_ijazah = mysql_real_escape_string($_POST['tgl_ijazah']);
	$kepala = mysql_real_escape_string($_POST['kepala']);
	$index = mysql_real_escape_string($_POST['index']);
	$id_rp = get_maks_id_data_riwayat_pendidikan();
	
	//SET the file upload info
	$fname = $_FILES['sc_ijazah']['name'];
	$fsize = $_FILES['sc_ijazah']['size'];
	$ftype = $_FILES['sc_ijazah']['type'];
	$tmp   = $_FILES['sc_ijazah']['tmp_name'];
	
	if($ftype != 'application/pdf'){
		header("location:../../?mod=riwayat_pendidikan");
	}
	
	// cek foto yang pernah di upload
	$existing_filename = get_existing_filename($id);
	$dir = "../../ijazah_uploaded/riwayat_pendidikan/" . $existing_filename;
	
	if(!empty($fname)){
		if(file_exists($dir)){
			// hapus data file
			unlink($dir);
		}
	}
	// upload yang baru
	// destination dir
	$ntype = explode('/',$ftype);
	$eks = $ntype[1];
	$file = $nip . "." . $eks;
	$dest = "../../ijazah_uploaded/riwayat_pendidikan/" . $file;
	
	move_uploaded_file($tmp, $dest); // upload process
	
	$sql = "UPDATE tbl_riwayat_pendidikan SET nip = '$nip', id_tingkat_pendidikan = '$tingkat', tempat_pendidikan = '$tempat' ,
			no_ijazah = '$nomer', tgl_ijazah = '$tgl_ijazah', k_a_tempat_pendidikan = '$kepala', nilai = '$index', scan_ijazah = '$file' 
			WHERE id_data_rp = '$id'";
			
	$query = mysql_query($sql) or die(mysql_error());

	if($query){
			//$code = 1;
			//$act = "edit";
			//header("location:../../?mod=riwayat_pendidikan");
			pesan("Edit Riwayat Pendidikan sukses !!");
	}else{
			//$code = 2;
			//$act = "edit";
			//header("location:../../?mod=riwayat_pendidikan&code=".$code."&act=".$act);
			pesan("Error Query, edit data riwayat pendidikan gagal !!");
	}	
 
        
    //echo("Data usulan telah disimpan");
?>