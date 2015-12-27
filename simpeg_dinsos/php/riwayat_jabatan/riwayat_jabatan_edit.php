<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    // MENCARI id_eselon DARI JABATAN
    $sttspv = 1;
    if($_SESSION["simpeg_id_level"] == 12)
        $sttspv = 3;
    $ds_eselon = mysql_fetch_array(mysql_query("SELECT * FROM ref_jabatan WHERE id_jabatan='" . $_POST["id_jabatan"] . "'"));
    $sql = "UPDATE tbl_riwayat_jabatan SET
                id_jabatan='" . $_POST["id_jabatan"] . "', 
                id_tipe_jabatan='" . $_POST["id_tipe_jabatan"] . "',
                id_eselon='" . $ds_eselon["id_eselon"] . "', 
                id_skpd='" . $_POST["id_skpd"] . "', 
                tmt='" . $_POST["tmt"] . "', 
                no_sk_jabatan='" . $_POST["no_sk_jabatan"] . "', 
                tgl_sk_jabatan='" . $_POST["tgl_sk_jabatan"] . "',
                pejabat_penetapan='" . $_POST["pejabat_penetapan"] . "', 
                no_sk_pelantikan='" . $_POST["no_sk_pelantikan"] . "', 
                tgl_sk_pelantikan='" . $_POST["tgl_sk_pelantikan"] . "',
                pejabat_pelantik='" . $_POST["pejabat_pelantik"] . "', 
                sumpah_jabatan='" . $_POST["sumpah_jabatan"] . "',
                status_supervisi=" . $sttspv . "
            WHERE MD5(id_riwayat_jabatan)='" . $_POST["id_riwayat_jabatan"] . "'";
    mysql_query($sql);
    update_jabatan_pegawai($_SESSION["simpeg_id_pegawai"]);
    header("location:../../?mod=riwayat_jabatan");
?>