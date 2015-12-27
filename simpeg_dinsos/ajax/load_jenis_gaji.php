<?php
    session_start();
    include("../php/koneksi.php");
    include("../php/fungsi.php");
    
    $jenis_gaji = array();
    $sql = "SELECT * FROM ref_jenis_gaji WHERE id_peraturan_gaji = '" . $_POST["id_peraturan_gaji"] . "' AND id_pangkat = '" . $_POST["id_pangkat"] . "' ORDER BY mkg ASC";
    $res = mysql_query($sql);
    while($ds = mysql_fetch_array($res)){
        $row_jenis_gaji["id_jenis_gaji"] = $ds["id_jenis_gaji"];
        $row_jenis_gaji["id_peraturan_gaji"] = $ds["id_peraturan_gaji"];
        $row_jenis_gaji["id_pangkat"] = $ds["id_pangkat"];
        $row_jenis_gaji["mkg"] = $ds["mkg"];
        $row_jenis_gaji["gaji"] = idr($ds["gaji"]);
        array_push($jenis_gaji, $row_jenis_gaji);
    }
    echo(json_encode($jenis_gaji));
?>