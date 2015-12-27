<?php
	if($_SESSION["id_unit_kerja"] != 0){
		$sql_pengguna = "SELECT
                        	a.*, b.unit_kerja, c.level, c.id_level
                        FROM
                        	tbl_anggota_arsip a
                        	LEFT JOIN ref_unit_kerja b ON a.id_unit_kerja = b.id_unit_kerja
                            LEFT JOIN ref_level_pengguna c ON a.id_level_pengguna = c.id_level
                        WHERE
                        	a.id_anggota='" .$_SESSION["id_pengguna"] . "'";
	}else{
		$sql_pengguna = "SELECT
							a.username AS nama_lengkap, b.level
						FROM
							tbl_pengguna a
							LEFT JOIN ref_level_pengguna b ON a.id_level = b.id_level
						WHERE
							a.id_user = '" . $_SESSION["id_pengguna"] . "'";
	}
    
    $res_pengguna = mysql_query($sql_pengguna);
    $ds_pengguna = mysql_fetch_array($res_pengguna);
?>
<table width='100%' border='0px' cellspacing='0' cellpadding='0'>
    <tr>
        <td width='150px' align='center' style="background-color: #eeeedd;"><img src="image/logo.png" /></td>
        <td style="background-color: #eeeedd;">
            <div style="margin-left: -150px; text-align: center; font-family: cambria; font-size: 20pt; font-weight: bold; text-shadow: 2px 2px 1px #ccccdd;">:: SISTEM INFORMASI MANAJEMEN KEARSIPAN KOTA MEDAN ::</div>
            <div style="margin-left: -150px; text-align: center; font-family: cambria; font-size: 20pt; font-weight: bold; text-shadow: 2px 2px 1px #ccccdd;">:: KANTOR ARSIP DAERAH ::</div>
            <div style="margin-left: -150px; text-align: center; font-family: cambria; font-size: 20pt; font-weight: bold; text-shadow: 2px 2px 1px #ccccdd;">:: PEMERINTAH KOTA MEDAN ::</div>
        </td>
    </tr>
</table>
<table width='100%' border='0px' cellspacing='0' cellpadding='0'>
    <tr>
        <td style="text-align: right; vertical-align: bottom; padding: 10px; background-color: #eeeeff;">
            <div style="font-family: sans-serif; font-size: 15pt; font-weight: bold; text-transform: capitalize;"><?php echo($ds_pengguna["nama_lengkap"]); ?></div>
            <div style="font-family: arial; font-size: 10pt; text-transform: capitalize;"><?php echo($ds_pengguna["level"]); if($ds_pengguna["id_level"]==2)echo(" (" . $ds_pengguna["unit_kerja"] . ")"); ?></div>
        </td>
    </tr>
</table>