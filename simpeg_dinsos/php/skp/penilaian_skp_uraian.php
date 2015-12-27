<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    $id_skp = $_POST["id_skp"];
    $bulan = $_POST["bulan"];
    
    // HAPUS DULU YANG LAMA
    mysql_query("DELETE FROM tbl_uraian_realisasi_skp WHERE id_skp='" . $id_skp . "' AND bulan='" . $bulan . "'");
    
    // KEMUDIAN ISI LAGI
    $res = mysql_query("SELECT
                        	a.*, b.satuan_waktu
                        FROM
                        	tbl_uraian_skp a
                            LEFT JOIN ref_satuan_waktu b ON a.id_satuan_waktu = b.id_satuan_waktu
                        WHERE
                        	a.id_skp = '" . $id_skp . "'");
    while($ds = mysql_fetch_array($res)){
        $id_uraian_skp = $ds["id_uraian_skp"];
        $kuantitas = $_POST["kuantitas_" . $id_uraian_skp];
        $kualitas = $_POST["kualitas_" . $id_uraian_skp];
        $waktu = $_POST["waktu_" . $id_uraian_skp];
        $biaya = $_POST["biaya_" . $id_uraian_skp];
        mysql_query("INSERT INTO tbl_uraian_realisasi_skp VALUES(
                        null, '" . $id_skp . "', '" . $bulan . "', '" . $id_uraian_skp . "', '0',
                        '" . $kuantitas . "', '" . $kualitas . "', '" . $waktu . "', '" . $biaya . "', '1'
                    )");
    }
    header("location:../../?mod=penilaian_skp_target");
?>