<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    
    // check who is currently login
    $sttspv = 1;
    if($_SESSION["simpeg_id_level"] == 12)
        $sttspv = 3;
        
    // delete the existing data
    mysql_query("DELETE FROM tbl_pengangkatan_pns WHERE id_pegawai='" . $_SESSION["simpeg_id_pegawai"] . "'");
    
    // insert the new data to the table
    mysql_query("INSERT INTO tbl_pengangkatan_pns VALUES(
                    '" . $_SESSION["simpeg_id_pegawai"] . "', '" . $_POST["pejabat_penetapan"] . "',
                    '" . $_POST["no_sk_pns"] . "', '" . $_POST["tgl_sk_pns"] . "', '" . $_POST["id_pangkat"] . "', '" . $_POST["tmt_pns"] . "', '" . $_POST["sumpah_pns"] . "',
                    null, '" . $sttspv . "'
                )");
    
    header("location:../../?mod=pengangkatan_pns&msg=1");
?>