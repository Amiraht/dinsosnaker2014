<?php
    session_start();
    include("../php/koneksi.php");
    $kode_skpd = $_POST["kode_skpd"];
    $id_tipe_jabatan = $_POST["id_tipe_jabatan"];
    $jabatan = array();
    $sql_jabatan = "SELECT
                    	a.*,
                        CASE
                    		WHEN c.eselon IS NULL THEN ''
                    		ELSE CONCAT(' - ', c.eselon)
                    	END AS eselon
                    FROM
                    	ref_jabatan a
                    	LEFT JOIN ref_skpd b ON a.id_skpd = b.id_skpd
                        LEFT JOIN ref_eselon c ON a.id_eselon = c.id_eselon
                    WHERE
                    	a.id_tipe_jabatan = '" . $id_tipe_jabatan . "' AND b.kode_skpd LIKE '" . $kode_skpd . "%'
                    GROUP BY
                        a.jabatan
                    ORDER BY
                    	c.eselon ASC, a.kode_jabatan";
    $res_jabatan = mysql_query($sql_jabatan);
    while($ds_jabatan = mysql_fetch_array($res_jabatan)){
        $row_jabatan["id_jabatan"] = $ds_jabatan["id_jabatan"];
        $row_jabatan["only_jabatan"] = $ds_jabatan["jabatan"];
        $row_jabatan["jabatan"] = $ds_jabatan["jabatan"] . $ds_jabatan["eselon"];
        array_push($jabatan, $row_jabatan);
    }
    echo(json_encode($jabatan));
    //echo($sql_jabatan);
?>