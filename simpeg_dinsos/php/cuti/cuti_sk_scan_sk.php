<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    
    function something_wrong($what_is_wrong){
        echo("
            <script type='text/javascript'>
                window.parent.window.something_wrong_upload(\"" . $what_is_wrong . "\");
            </script>
        ");
    }
    function debug($what_is_wrong){
        echo("
            <script type='text/javascript'>
                window.parent.window.debug(\"" . $what_is_wrong . "\");
            </script>
        ");
    }
    function success(){
        echo("
            <script type='text/javascript'>
                window.parent.window.success_upload();
            </script>
        ");
    }
    
    $scan_sk = $_FILES["scan_sk"];
    $id_surat = $_POST["id_surat"];
    if($scan_sk["tmp_name"] == ""){
        something_wrong("Pilih file yang akan diupload");
    }else{
        if(strtolower(ekstensi($scan_sk["name"])) != "pdf"){
            something_wrong("Maaf, file yang diupload harus berformat PDF");
        }else{
            $path = "../../sk_uploaded/cuti/";
            $nama_file_baru = "sk_cuti_" . $id_surat . ".pdf";
            move_uploaded_file($scan_sk["tmp_name"], $path . $nama_file_baru);
            //echo($scan_sk["tmp_name"] . "<br />");
            //echo($path . $nama_file_baru . "<br />");
            
            // EDIT DATA SCAN SK PADA TABLE SK DAN RIWAYAT CUTI
            $sql_edit_1 = "UPDATE tbl_sk_cuti SET scan_sk='" . $nama_file_baru . "' WHERE id_surat='" . $id_surat . "'";
            $sql_edit_2 = "UPDATE tbl_riwayat_cuti SET scan_sk='" . $nama_file_baru . "' WHERE id_surat='" . $id_surat . "'";
            mysql_query($sql_edit_1);
            mysql_query($sql_edit_2);
            //echo($sql_edit_1 . "<br />" . $sql_edit_2);
            success();
        }
    }
?>
