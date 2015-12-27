<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    // MENCARI id_eselon DARI JABATAN
    $sttspv = 1;
    if($_SESSION["simpeg_id_level"] == 12)
        $sttspv = 3;
    $ds_eselon = mysql_fetch_array(mysql_query("SELECT * FROM ref_jabatan WHERE id_jabatan='" . $_POST["id_jabatan"] . "'"));
    $sql = "INSERT INTO tbl_riwayat_jabatan VALUES
            (
                null, '" . $_SESSION["simpeg_id_pegawai"] . "', '" . $_POST["id_jabatan"] . "', '" . $_POST["id_tipe_jabatan"] . "',
                '" . $ds_eselon["id_eselon"] . "', '" . $_POST["id_skpd"] . "', '" . $_POST["tmt"] . "', '" . $_POST["no_sk_jabatan"] . "', '" . $_POST["tgl_sk_jabatan"] . "',
                '" . $_POST["pejabat_penetapan"] . "', '" . $_POST["no_sk_pelantikan"] . "', '" . $_POST["tgl_sk_pelantikan"] . "',
                '" . $_POST["pejabat_pelantik"] . "', '" . $_POST["sumpah_jabatan"] . "' , " . $sttspv . "
            )";
    mysql_query($sql);
    
    update_jabatan_pegawai($_SESSION["simpeg_id_pegawai"]);
    header("location:../../?mod=riwayat_jabatan");
?>