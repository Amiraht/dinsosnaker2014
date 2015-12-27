<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    $id_skp_perilaku = 0;
    if($_POST["id_skp"] == 0){
        $sql = "INSERT INTO tbl_skp_perilaku(id_pegawai, id_pegawai_penilai, id_atasan_pegawai_penilai, dari, sampai) 
                VALUES('" . $_SESSION["simpeg_id_pegawai"] . "' , '" . detail_pegawai_by_nip($_POST["nip_pejabat_penilai"], "id_pegawai") . "',
                '" . detail_pegawai_by_nip($_POST["nip_atasan_pejabat_penilai"], "id_pegawai") . "',
                '" . $_POST["dari"] . "', '" . $_POST["sampai"] . "')";
        mysql_query($sql);
        
        $ds_id_skp_perilaku_terbaru = mysql_fetch_array(mysql_query("SELECT id_skp_perilaku FROM tbl_skp_perilaku WHERE id_pegawai = '" . $_SESSION["simpeg_id_pegawai"] . "' ORDER BY id_skp_perilaku DESC"));
        $id_skp_perilaku = $ds_id_skp_perilaku_terbaru["id_skp_perilaku"];
    }else{
        $sql = "UPDATE tbl_skp_perilaku SET
                    id_pegawai_penilai='" . detail_pegawai_by_nip($_POST["nip_pejabat_penilai"], "id_pegawai") . "',
                    id_atasan_pegawai_penilai='" . detail_pegawai_by_nip($_POST["nip_atasan_pejabat_penilai"], "id_pegawai") . "',
                    dari='" . $_POST["dari"] . "',
                    sampai='" . $_POST["sampai"] . "'
                WHERE id_skp_perilaku='" . $_POST["id_skp"] . "'";
        mysql_query($sql);
        
        $id_skp_perilaku = $_POST["id_skp"];
    }
    
    // PROSES MENGIKATKAN ANTARA SKP DENGAN PERILAKU
    mysql_query("DELETE FROM tbl_skp_perilaku_disatukan WHERE id_skp_perilaku='" . $id_skp_perilaku . "'");
    
    $res_pilih_skp = mysql_query("SELECT
                                    	a.*
                                    FROM
                                    	tbl_skp a
                                    WHERE
                                    	a.id_pegawai = '" . $_SESSION["simpeg_id_pegawai"] . "'
                                    ORDER BY
                                    	a.dari ASC
                                    ");
    while($ds_pilih_skp = mysql_fetch_array($res_pilih_skp)){
        if(isset($_POST["skp_id_" . $ds_pilih_skp["id_skp"]])){
            mysql_query("INSERT INTO tbl_skp_perilaku_disatukan VALUES('" . $id_skp_perilaku . "', '" . $ds_pilih_skp["id_skp"] . "')");
        }
    }
    
    header("location:../../?mod=perilaku_lihat_pilih_periode");
?>