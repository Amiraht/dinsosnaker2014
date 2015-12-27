<?php
    include("../php/koneksi.php");
    $ds_sk = mysql_fetch_array(mysql_query("SELECT a.id_ttd, b.ttd FROM myapp_maintable_suratkeluar a LEFT JOIN myapp_reftable_ttd b ON a.id_ttd = b.id WHERE a.id='" . $_GET["id"] . "'"));
    $res = mysql_query("SELECT
                        	a.id_level_asal, b.urutan, b.level,
                        	CASE
                        		WHEN a.id_pengguna_asal <> 0 THEN (SELECT ttd FROM myapp_maintable_pengguna WHERE id=a.id_pengguna_asal LIMIT 0, 1)
                        		ELSE (SELECT ttd FROM myapp_maintable_pengguna WHERE id_level=a.id_level_asal LIMIT 0, 1)
                        	END AS pengguna,
                            (SELECT COUNT(*) FROM myapp_disptable_suratkeluar tmp WHERE id_surat_keluar = '" . $_GET["id"] . "' AND id_level_tujuan = a.id_level_asal AND tmp.status = 4) AS menolak
                        FROM
                        	myapp_disptable_suratkeluar a
                        	LEFT JOIN myapp_reftable_levelpengguna b ON a.id_level_asal = b.id
                        WHERE
                        	a.id_surat_keluar = '" . $_GET["id"] . "' AND a.id_level_asal <> 1
                        GROUP BY
                        	a.id_level_asal
                        ORDER BY
                        	b.urutan ASC, a.id_level_asal ASC");
?>
<table width='100%' cellspacing='0' cellpadding='0' border='1px' style="border-collapse: collapse; font-weight: bold; font-family: arial; color: blue;">
<?php
    if($ds_sk["id_ttd"] <> 1){
?>
    <tr height='50px'>
        <td width='60%' style="text-transform: uppercase; padding: 5px; font-size: 10pt; background-color: white;"><?php echo($ds_sk["ttd"]); ?></td>
        <td width='40%' style=" background-color: white;">&nbsp;</td>
    </tr>
<?php
    }
?>
    <tr height='50px'>
        <td width='60%' style="text-transform: uppercase; padding: 5px; font-size: 10pt; background-color: white;">KEPALA BADAN</td>
        <td width='40%' style=" background-color: white;">&nbsp;</td>
    </tr>
<?php
    while($ds = mysql_fetch_array($res)){
?>
    <tr>
        <td width='60%' style="text-transform: uppercase; padding: 5px; font-size: 10pt; background-color: white;"><?php echo($ds["level"]); ?></td>
        <td width='40%' style=" background-color: white;">
        <?php
            if($ds["menolak"] == 0){
        ?>
            <img src="ttd/<?php echo($ds["pengguna"]); ?>" height="50px" width="100%" />
        <?php
            }
        ?>
        </td>
    </tr>
<?php
    }
?>
</table>