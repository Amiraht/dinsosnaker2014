<?php
    session_start();
    include("koneksi.php");
    mysql_query("UPDATE tbl_pengaduan_pesan_saran SET pengaduan='" . $_POST["pengaduan"] . "' WHERE id_pengaduan='" . $_POST["id_pengaduan"] . "'");
    for($i=1; $i<=$_POST["jlh_file"]; $i++){
        $file = $_FILES["file_" . $i];
        if($file["tmp_name"] <> ""){
            $nama_file = $file["name"];
            $pecah = explode(".", $nama_file);
            $ekstensi = $pecah[count($pecah) - 1];
            $handle = fopen($file["tmp_name"], "r");
            $bacafile = fread($handle, filesize($file["tmp_name"]));
            $hex = $bacafile;
            fclose($handle);
            //echo("<div><b>(" . $file["tmp_name"] . ")</b> - " . $hex . "</div>");
            //echo("<hr />");
            mysql_query("INSERT INTO tbl_file_pengaduan_pesan_saran VALUES(null, '" . $_POST["id_pengaduan"] . "', '" . $nama_file . "', '" . $ekstensi . "', '" . mysql_real_escape_string($hex) . "', '1')");
            //echo("INSERT INTO tbl_file_pengaduan_pesan_saran VALUES(null, '" . $id_pengaduan . "', '" . $nama_file . "', '" . $ekstensi . "', '" . mysql_real_escape_string($hex) . "', '1')");
            //echo("<br><br><br>");
        }
    }
    header("location:../?mod=pps&tipe_pps=" . $_POST["tipe_pps"]);
?>