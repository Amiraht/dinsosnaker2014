<?php
    include("php/koneksi.php");
    function ubah_tgl_mysql($tgl){
        $pecah = explode("-", $tgl);
        return $pecah[2] . "-" . $pecah[1] . "-" . $pecah[0];
    }
    
    $res_ambil = mysql_query("SELECT * FROM tbl_riwayat_jabatan WHERE id_riwayat_jabatan > 12441");
    while($ds_ambil = mysql_fetch_array($res_ambil)){
        $id_riwayat_jabatan = $ds_ambil["id_riwayat_jabatan"];
        $tmt = $ds_ambil["tmt"];
        $tmt_mysql = ubah_tgl_mysql($tmt);
        echo("<li>UPDATE tbl_riwayat_jabatan SET tmt='" . $tmt_mysql . "' WHERE id_riwayat_jabatan='" . $id_riwayat_jabatan . "'</li>");
        mysql_query("UPDATE tbl_riwayat_jabatan SET tmt='" . $tmt_mysql . "' WHERE id_riwayat_jabatan='" . $id_riwayat_jabatan . "'");
    }



?>