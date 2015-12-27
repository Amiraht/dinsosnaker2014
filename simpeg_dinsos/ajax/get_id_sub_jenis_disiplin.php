<?php
    session_start();
    include("../php/koneksi.php");
    $sub_jenis_disiplin = array();
    $sql_sub_jenis_disiplin = "SELECT * FROM ref_sub_jenis_disiplin WHERE id_jenis_disiplin='" . $_POST["id_jenis_disiplin"] . "'";
    $res_sub_jenis_disiplin = mysql_query($sql_sub_jenis_disiplin);
    while($ds_sub_jenis_disiplin = mysql_fetch_array($res_sub_jenis_disiplin)){
        $row_sjd["id_sub_jenis_disiplin"] = $ds_sub_jenis_disiplin["id_sub_jenis_disiplin"];
        $row_sjd["id_jenis_disiplin"] = $ds_sub_jenis_disiplin["id_jenis_disiplin"];
        $row_sjd["sub_jenis_disiplin"] = $ds_sub_jenis_disiplin["sub_jenis_disiplin"];
        array_push($sub_jenis_disiplin, $row_sjd);
    }
    echo(json_encode($sub_jenis_disiplin));
?>