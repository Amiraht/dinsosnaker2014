<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    if($_POST["id_skp"] == 0){
        $sql = "INSERT INTO tbl_skp VALUES(null, '" . $_SESSION["simpeg_id_pegawai"] . "' , '" . detail_pegawai_by_nip($_POST["nip_pejabat_penilai"], "id_pegawai") . "',
            '" . detail_pegawai_by_nip($_POST["nip_atasan_pejabat_penilai"], "id_pegawai") . "',
            '" . $_POST["dari"] . "', '" . $_POST["sampai"] . "', 1)";
    }else{
        $sql = "UPDATE tbl_skp SET
                    id_pegawai_penilai='" . detail_pegawai_by_nip($_POST["nip_pejabat_penilai"], "id_pegawai") . "',
                    id_atasan_pegawai_penilai='" . detail_pegawai_by_nip($_POST["nip_atasan_pejabat_penilai"], "id_pegawai") . "',
                    dari='" . $_POST["dari"] . "',
                    sampai='" . $_POST["sampai"] . "',
                    status_supervisi='1'
                WHERE id_skp='" . $_POST["id_skp"] . "'";
    }
    
    mysql_query($sql);
    header("location:../../?mod=skp_target");
?>