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
    
    $id_lhkpn = $_POST["id_lhkpn"];
    $id_pegawai = $_POST["id_pegawai"];
    $tgl_lapor = $_POST["tgl_lapor"];
    $jenis_form = $_POST["jenis_form"];
    $no_nhk = $_POST["no_nhk"];
    
    if($id_pegawai == 0)
        something_wrong("Maaf, pegawai dengan NIP " . $_POST["nip"] . " tidak ditemukan");
    else if($tgl_lapor == "")
        something_wrong("Maaf, Tanggal Lapor harus diisi");
    else{
        
        // Simpan datanya
        $sql_update = "UPDATE tbl_lhkpn SET
                            no_nhk='" . $no_nhk . "', tgl_lapor='" . $tgl_lapor . "', jenis_form='" . $jenis_form . "'
                        WHERE id_lhkpn='" . $id_lhkpn . "'";
        mysql_query($sql_update);
        success();
    }
    
?>
