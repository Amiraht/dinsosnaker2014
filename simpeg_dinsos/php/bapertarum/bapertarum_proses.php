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
    
    $id_pegawai = $_POST["id_pegawai"];
    $tgl_lapor = $_POST["tgl_lapor"];
    
    if($tgl_lapor == ""){
        something_wrong("Maaf, tanggal lapor harus diisi");
    }else{
        // Hapus data bapertarum sebelumnya
        mysql_query("DELETE FROM tbl_bapertarum WHERE id_pegawai='" . $_POST["id_pegawai"] . "'");
        
        // Simpan data yang baru
        mysql_query("INSERT INTO tbl_bapertarum(id_pegawai, tgl_lapor) VALUES('" . $id_pegawai . "', '" . $tgl_lapor . "')");
        
        success();
    }
?>
