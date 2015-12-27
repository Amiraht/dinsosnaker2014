<?php
	if(isset($_SESSION["simpeg_id_pengguna"])){
		
    $ds_user = mysql_fetch_array(mysql_query("SELECT a . * , b.modul_pengguna
                                                FROM tbl_pengguna a
                                                LEFT JOIN ref_modul_pengguna b ON a.modul = b.id_modul_pengguna
                                              WHERE
                                                id_user = '" . $_SESSION["simpeg_id_pengguna"] . "'"));
		
		// define the user variable
		$username = $ds_user["nama"];
		$mod_pengguna = $ds_user["modul_pengguna"];
	}else{
		$username = "";
		$mod_pengguna = "";
	}
?>
<table width='100%' border='0px' cellspacing='0' cellpadding='0'>
    <tr>
        <td width='150px' align='center' style="background-color: green;"><img src="image/logo.png" /></td>
        <td style="background-color:green;">
            <div style="color:white; margin-left: -150px; text-align: center; font-family: cambria; font-size: 20pt; font-weight: bold; text-shadow: 2px 2px 1px #ccccdd;">:: SISTEM INFORMASI MANAJEMEN KEPEGAWAIAN ::</div>
            <div style="color:white; margin-left: -150px; text-align: center; font-family: cambria; font-size: 20pt; font-weight: bold; text-shadow: 2px 2px 1px #ccccdd;">:: DINAS SOSIAL DAN TENAGA KERJA ::</div>
            <div style="color:white;margin-left: -150px; text-align: center; font-family: cambria; font-size: 20pt; font-weight: bold; text-shadow: 2px 2px 1px #ccccdd;">:: PEMERINTAH KOTA MEDAN ::</div>
        </td>
    </tr>
</table>
<table width='100%' border='0px' cellspacing='0' cellpadding='0'>
    <tr>
        <td style="text-align: right; vertical-align: bottom; padding: 10px; background-color: #eeeeff;">
            <div style="font-family: sans-serif; font-size: 15pt; font-weight: bold;"><?php echo $username; ?></div>
            <div style="font-family: arial; font-size: 10pt; text-transform: capitalize;"><?php echo $mod_pengguna; ?></div>
        </td>
    </tr>
</table>