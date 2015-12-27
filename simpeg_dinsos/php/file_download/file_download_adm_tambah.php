<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    $file = $_FILES["file"];
    $tipe_fd = $_POST["tipe_fd"];
    $id_file = $_POST["id_file"];
    $judul = $_POST["judul"];
    $type = $file["type"];
    $file_name = $file["name"];
    $ekstensi = ekstensi($file_name);
    $keterangan = $_POST["keterangan"];
    $source = $_FILES['file']['tmp_name'];
	
	$dest = "../../sys_files/file_upload/" . $file_name ;
	
    if($id_file == "0" && $file["tmp_name"] != ""){
       
	   $query = mysql_query("INSERT INTO tbl_file_download VALUES(null, '$judul', '$file_name', '$ekstensi', '$keterangan', CURDATE(), '$tipe_fd')")
					or die(mysql_error());
					
		if($query){
			// process upload file
			move_uploaded_file($source, $dest);
			header("location:../../?mod=file_download_adm&tipe_fd=" . $tipe_fd);
		}	
	       	
    }else if($id_file =="0" && $file["tmp_name"] == ""){
	
        header("location:../../?mod=file_download_adm_tambah&tipe_fd=" . $tipe_fd . "&id_file=" . $id_file . "&err=Tidak ada file yang diupload atau ukuran file lebih besar dari kapasitas maksimum");
    }else if($id_file != "0" && $file["tmp_name"] != ""){
        
		// cek jika masih ada file yang tersimpan
		if(file_exists($dest)){
			unlink($dest); // hapus dahulu baru di upload kembali
			move_uploaded_file($source, $dest);
		}else{
			move_uploaded_file($source, $dest);
		}
        
        mysql_query("UPDATE tbl_file_download SET judul = '$judul', nama_file = '$file_name', ekstensi = '$ekstensi', keterangan = '$keterangan' , 
					 tanggal = CURDATE() WHERE MD5(id_file)='" . $_POST["id_file"] . "'");
					 
        header("location:../../?mod=file_download_adm&tipe_fd=" . $tipe_fd);
		
    }else if($id_file != "0" && $file["tmp_name"] == ""){
        mysql_query("UPDATE tbl_file_download SET
                        judul='" . $judul . "',
                        keterangan='" . $keterangan . "'
                     WHERE MD5(id_file)='" . $_POST["id_file"] . "'");
					 
        header("location:../../?mod=file_download_adm&tipe_fd=" . $tipe_fd);
    }
?>