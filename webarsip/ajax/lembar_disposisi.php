<?php
	error_reporting(0);
?>
<html>
<head>
<title>Cetak Lembar Disposisi</title>
</head>
<body onload="window.print();">
<table border='1' style="border-collapse: collapse; width:100%;">
    <tr>
        <td width='5%' align='center' style="padding: 10px; font-weight: bold; text-transform: uppercase; background-color: black; color: white;">No.</td>
        <td width='20%' align='center' style="padding: 10px; font-weight: bold; text-transform: uppercase; background-color: black; color: white;">Asal</td>
        <td width='20%' align='center' style="padding: 10px; font-weight: bold; text-transform: uppercase; background-color: black; color: white;">Tujuan</td>
        <td width='20%' align='center' style="padding: 10px; font-weight: bold; text-transform: uppercase; background-color: black; color: white;">Catatan</td>
        <td align='center' style="padding: 10px; font-weight: bold; text-transform: uppercase; background-color: black; color: white;">Paraf</td>
    </tr>
    <?php
    include("../php/koneksi.php");
    include("../php/fungsi.php");
    bacaDisp($_GET["id_disposisi"]);
	$id_surat = anti_injection($_GET['id']);
    $sql = "SELECT
            	b.level AS level_asal, c.level AS level_tujuan, a.catatan, a.tgl_disposisi, c.urutan, d.nama
            FROM
            	myapp_disptable_suratmasuk a
            	LEFT JOIN myapp_reftable_levelpengguna b ON a.id_level_asal = b.id
            	LEFT JOIN myapp_reftable_levelpengguna c ON a.id_level_tujuan = c.id
                LEFT JOIN myapp_maintable_pengguna d ON a.id_pengguna_tujuan = d.id
            WHERE
            	MD5(MD5(a.id_surat_masuk )) = '" . $id_surat . "'";
    $res = mysql_query($sql);
    $ctr = 0;
    while($ds = mysql_fetch_array($res)){
        $ctr++;
        $nama = "";
        if($ds["urutan"] == 4)
            $nama = " [[ " . $ds["nama"] . " ]]";
?>
    <tr>
        <td align='center' style="padding: 10px;"><?php echo($ctr); ?></td>
        <td style="padding: 10px; text-transform: uppercase;"><?php echo($ds["level_asal"]); ?></td>
        <td style="padding: 10px; text-transform: uppercase;"><?php echo($ds["level_tujuan"] . $nama); ?></td>
        <td style="padding: 10px; text-transform: capitalize;"><?php if($ds["catatan"]<>""){echo($ds["catatan"]);}else{echo("<i>.:: tidak ada catatan ::.</i>");} ?></td>
        <td style="padding: 10px;">&nbsp;</td>
    </tr>
    <!--<div class="judullist"> <?php echo($ds["level_asal"]); ?>&nbsp;&nbsp;>>&nbsp;&nbsp;<?php echo($ds["level_tujuan"] . $nama); ?></div>
    <div class="isilist">
        <div><?php if($ds["catatan"]<>""){echo($ds["catatan"]);}else{echo("<i>.:: tidak ada catatan ::.</i>");} ?></div>
        <div class="waktulist"><?php echo($ds["tgl_disposisi"]); ?></div>
    </div>-->
<?php
    }
?>
</table>
</body>
</html>