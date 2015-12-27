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
    
    $id_surat = $_POST["id_surat"];
    $no_surat = $_POST["no_surat"];
    $tgl_surat = $_POST["tgl_surat"];
    $nama_surat = $_POST["nama_surat"];
    $nip_surat = $_POST["nip_surat"];
    $pangkat_surat = $_POST["pangkat_surat"];
    $pejabat_surat = $_POST["pejabat_surat"];
    
    if($no_surat=="" || $tgl_surat=="" || $pejabat_surat==""){
        something_wrong("Maaf, input anda belum lengkap");
    }else{
        $sql_insert = "UPDATE tbl_sk_cuti SET no_surat='" . $no_surat . "', tgl_surat='" . $tgl_surat . "', pejabat_surat='" . $pejabat_surat . "', nama_surat='" . $nama_surat . "', nip_surat='" . $nip_surat . "', pangkat_surat='" . $pangkat_surat . "' WHERE id_surat='" . $id_surat . "'";
        $sql_update_2 = "UPDATE tbl_riwayat_cuti SET no_sk='" . $no_surat . "', tgl_sk='" . $tgl_surat . "', pejabat_sk='" . $pejabat_surat . "' WHERE id_surat='" . $id_surat . "'";
        mysql_query($sql_insert);
        mysql_query($sql_update_2);
        success();
    }
?>
