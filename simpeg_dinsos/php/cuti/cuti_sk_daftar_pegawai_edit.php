<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    
    function something_wrong($what_is_wrong){
        echo("
            <script type='text/javascript'>
                window.parent.window.something_wrong(\"" . $what_is_wrong . "\");
            </script>
        ");
    }
    function success(){
        echo("
            <script type='text/javascript'>
                window.parent.window.success();
            </script>
        ");
    }
    
    if($_POST["id_jenis_cuti"] != "0" && $_POST["lama"] != "" && $_POST["dari"] != ""){
        $id_riwayat_cuti = $_POST["id_riwayat_cuti"];
        $id_jenis_cuti = $_POST["id_jenis_cuti"];
        $lama = $_POST["lama"];
        $dari = $_POST["dari"];
        $sampai = $_POST["sampai"];
        $keterangan = $_POST["keterangan"];
        mysql_query("UPDATE tbl_riwayat_cuti SET id_jenis_cuti='" . $id_jenis_cuti . "', lama='" . $lama . "', dari='" . $dari . "', sampai='" . $sampai . "', keterangan='" . $keterangan . "' WHERE id_riwayat_cuti='" . $id_riwayat_cuti . "'");
        success();
    }else{
        something_wrong("Maaf, input anda belum lengkap");
    }
?>