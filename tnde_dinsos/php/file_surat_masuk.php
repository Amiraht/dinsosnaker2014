<?php
    include("koneksi.php");
    $file = $_FILES["file"];
    $err_code = "";
    if($file["error"] > 0){
        $err_code = "&err_code=" . $file["error"];
    }else{
        //echo("uploaded/" . $file["name"]);
        // DAPATKAN EKSTENSI FILE
        $pecah = explode(".", $file["name"]);
        $ekstensi = $pecah[count($pecah) - 1];
        $ekstensi = strtolower($ekstensi);
        $mulai = 0;
        do{
            $mulai++;
            $tmp_file_name = "sm_" . $_POST["id"] . "_" . $mulai . "." . $ekstensi;
        }while(file_exists("../uploaded/sm/" . $tmp_file_name));
        move_uploaded_file($file["tmp_name"], "../uploaded/sm/" . $tmp_file_name);
        $query = mysql_query("INSERT INTO myapp_filetable_suratmasuk VALUES(null, '" . $_POST["id"] . "', '" . $tmp_file_name . "', '" . $_POST["keterangan"] . "')");
		
		if($query){
				 header("location:../?mod=file_surat_masuk&id=" . $_POST["id"] . $err_code . "&redir=" . $_POST["redir"]);
		}
   }	
   
?>