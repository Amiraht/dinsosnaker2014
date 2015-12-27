<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    
    // check who is currently login
    $sttspv = 1;
    if($_SESSION["simpeg_id_level"] == 12)
        $sttspv = 3;
        
    // delete the existing data
    mysql_query("DELETE FROM tbl_pengangkatan_cpns WHERE id_pegawai='" . $_SESSION["simpeg_id_pegawai"] . "'");
    
    // insert the new data to the table
    mysql_query("INSERT INTO tbl_pengangkatan_cpns VALUES(
                    NULL, '" . $_SESSION["simpeg_id_pegawai"] . "', '" . $_POST["no_bakn"] . "', '" . $_POST["tgl_bakn"] . "', '" . $_POST["pejabat_penetapan"] . "',
                    '" . $_POST["no_sk_cpns"] . "', '" . $_POST["tgl_sk_cpns"] . "', '" . $_POST["id_pangkat"] . "', '" . $_POST["tmt_cpns"] . "',
                    '". $_POST['mk_tahun'] ."','". $_POST['mk_bulan'] ."','-', '-', '" . $sttspv . "'
                )");
    
    header("location:../../?mod=pengangkatan_cpns&msg=1");
?>