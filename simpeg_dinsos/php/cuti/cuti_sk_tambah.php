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
    
    $no_surat = $_POST["no_surat"];
    $tgl_surat = $_POST["tgl_surat"];
    $nama_surat = $_POST["nama_surat"];
    $nip_surat = $_POST["nip_surat"];
    $pangkat_surat = $_POST["pangkat_surat"];
    $pejabat_surat = $_POST["pejabat_surat"];
    
    if($pejabat_surat==""){
        something_wrong("Maaf, input anda belum lengkap");
    }else{
        $sql_insert = "INSERT INTO tbl_sk_cuti(no_surat, tgl_input, tgl_surat, pejabat_surat, nama_surat, nip_surat, pangkat_surat) VALUES('" . $no_surat . "', CURDATE(), '" . $tgl_surat . "', '" . $pejabat_surat . "', '" . $nama_surat . "', '" . $nip_surat . "', '" . $pangkat_surat . "')";
        mysql_query($sql_insert);
        success();
    }
?>
