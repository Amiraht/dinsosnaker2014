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
        $id_surat = $_POST["id_surat"];
        
        // mengambil data surat SK nya
        $ds_sk = mysql_fetch_array(mysql_query("SELECT * FROM tbl_sk_cuti WHERE id_surat='" . $id_surat . "'"));
        
        $id_usulan = $_POST["id_usulan"];
        $id_pegawai = $_POST["id_pegawai"];
        $id_jenis_cuti = $_POST["id_jenis_cuti"];
        $lama = $_POST["lama"];
        $dari = $_POST["dari"];
        $sampai = $_POST["sampai"];
        $keterangan = $_POST["keterangan"];
        $no_sk = $ds_sk["no_surat"];
        $tgl_sk = $ds_sk["tgl_surat"];
        $pejabat_sk = $ds_sk["pejabat_surat"];
        $scan_sk = $ds_sk["scan_sk"];
        
        // MASUKKAN RIWAYAT CUTI YANG BERSANGKUTAN
        mysql_query("INSERT INTO tbl_riwayat_cuti(
                        id_pegawai, id_jenis_cuti, lama, dari, sampai, keterangan, no_sk, tgl_sk, pejabat_sk, id_surat, id_usulan, scan_sk
                    ) VALUES(
                        '" . $id_pegawai . "', '" . $id_jenis_cuti . "', '" . $lama . "', '" . $dari . "', '" . $sampai . "', '" . $keterangan . "', '" . $no_sk . "', '" . $tgl_sk . "', '" . $pejabat_sk . "', '" . $id_surat . "', '" . $id_usulan . "', '" . $scan_sk . "'
                    )");
                    
        // EDIT STATUS DIPROSES NYA MENJADI 1
        mysql_query("UPDATE tbl_usulan_cuti SET diproses=1 WHERE id_usulan='" . $id_usulan . "'");
        success();
    }else{
        something_wrong("Maaf, input anda belum lengkap");
    }
?>