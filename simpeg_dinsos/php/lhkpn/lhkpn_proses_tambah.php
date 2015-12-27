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
    $jenis_form = $_POST["jenis_form"];
    $no_nhk = $_POST["no_nhk"];
    
    if($id_pegawai == 0)
        something_wrong("Maaf, pegawai dengan NIP " . $_POST["nip"] . " tidak ditemukan");
    else if($tgl_lapor == "")
        something_wrong("Maaf, Tanggal Lapor harus diisi");
    else{
        // Cari profil pangkat, jabatan, dan SKPD nya
        $sql_profil = "SELECT id_pangkat, id_jabatan, id_satuan_organisasi FROM tbl_pegawai WHERE id_pegawai = '" . $id_pegawai . "'";
        $res_profil = mysql_query($sql_profil);
        $ds_profil = mysql_fetch_array($res_profil);
        
        $id_pangkat = $ds_profil["id_pangkat"];
        $id_skpd = $ds_profil["id_satuan_organisasi"];
        $id_jabatan = $ds_profil["id_jabatan"];
        
        // Simpan datanya
        $sql_insert = "INSERT INTO tbl_lhkpn(id_pegawai, id_pangkat, id_skpd, id_jabatan, tgl_lapor, jenis_form, no_nhk)
                        VALUES('" . $id_pegawai . "', '" . $id_pangkat . "', '" . $id_skpd . "', '" . $id_jabatan . "', '" . $tgl_lapor . "', '" . $jenis_form . "', '" . $no_nhk . "')";
        mysql_query($sql_insert);
        success();
    }
    
?>
