<?php
    include("koneksi.php");
    $file = $_FILES["file"];
    $err_code = "";
    if($file["error"] > 0){
        $err_code = "&err_code=" . $file["error"];
    }else{
        //Cek Ekstensi nya
        $pecah = explode(".", $file["name"]);
        $ekstensi = $pecah[count($pecah) - 1];
        $ekstensi = strtolower($ekstensi);
        if(!isset($_POST["status"])){
            $err_code = "&err_code=Status file belum dipilih";
        }else if(($_POST["status"] == 1 ||  $_POST["status"] == 2) && ($ekstensi <> "docx" && $ekstensi <> "doc" && $ekstensi <> "pdf")){
            $err_code = "&err_code=Maaf, untuk konsep surat dan konsep nota dinas surat harus berformat word atau pdf";
        }else{
            $mulai = 0;
            do{
                $mulai++;
                $tmp_file_name = "sk_" . $_POST["id"] . "_" . $mulai . "." . $ekstensi;
            }while(file_exists("../uploaded/sk/" . $tmp_file_name));
            move_uploaded_file($file["tmp_name"], "../uploaded/sk/" . $tmp_file_name);
            mysql_query("INSERT INTO myapp_filetable_suratkeluar VALUES(null, '" . $_POST["id"] . "', '" . $tmp_file_name . "', '" . $_POST["keterangan"] . "', '" . $_POST["status"] . "')");
        }
    }
    if(isset($_POST["saya"]))
        header("location:../?mod=file_final_surat_keluar&id=" . $_POST["id"] . $err_code);
    else
        header("location:../?mod=file_surat_keluar&id=" . $_POST["id"] . $err_code . "&redir=" . $_POST["redir"]);
?>