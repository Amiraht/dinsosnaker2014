<html>
<head>
<title>CETAK RESI SURAT MASUK</title>
<style type="text/css">
@page {margin: 0cm;}
</style>
</head>
<body onload="window.print();">
<?php
    include("koneksi.php");
    include("fungsi.php");
    
    $res_sm = mysql_query("SELECT 
                            	a.*, b.unit_kerja, CONCAT('(', c.kode_masalah, ') ', c.masalah) AS masalah,
                            	CONCAT('(', d.kode, ') ', d.jenis_surat) AS jenis_surat
                            FROM 
                            	myapp_maintable_suratmasuk a
                            	LEFT JOIN myapp_reftable_unitkerja b ON a.id_skpd_pengirim = b.id_unit_kerja
                            	LEFT JOIN myapp_reftable_masalah c ON a.id_masalah = c.id_masalah
                            	LEFT JOIN myapp_reftable_jenissurat d ON a.id_jenis_surat = d.id_jenis_surat
                            WHERE 
                            	a.id='" . $_GET["id"] . "'");
    $ds_sm = mysql_fetch_array($res_sm);
	
    for($i=1; $i<=$_GET["rangkap"]; $i++){
?>
    <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
        <tr>
            <td width='15%'>Nomor Register</td>
            <td width='10px'>:</td>
            <td style="text-transform: uppercase;"><b><?php echo(no_register($ds_sm["noreg"])); ?></b></td>
        </tr>
        <tr>
            <td width='15%'>Nomor Surat</td>
            <td width='10px'>:</td>
            <td style="text-transform: uppercase;"><b><?php echo($ds_sm["no_surat"]); ?></b></td>
        </tr>
        <tr>
            <td width='15%'>Tanggal Surat</td>
            <td width='10px'>:</td>
            <td style="text-transform: uppercase;"><b><?php echo($ds_sm["tgl_surat"]); ?></b></td>
        </tr>
        <tr>
            <td width='15%'>Tanggal Terima</td>
            <td width='10px'>:</td>
            <td style="text-transform: uppercase;"><b><?php echo($ds_sm["tgl_terima"]); ?></b></td>
        </tr>
        <tr>
            <td width='15%'>Perihal</td>
            <td width='10px'>:</td>
            <td style="text-transform: uppercase;"><b><?php echo($ds_sm["perihal_surat"]); ?></td>
        </tr>
        <tr>
            <td width='15%'>Deskripsi</td>
            <td width='10px'>:</td>
            <td style="text-transform: uppercase;"><b><?php echo($ds_sm["deskripsi_surat"]); ?></b></td>
        </tr>
        <tr>
            <td width='15%'>SKPD / Unit Kerja Pengirim</td>
            <td width='10px'>:</td>
            <td style="text-transform: uppercase;"><b><?php echo($ds_sm["unit_kerja"]); ?></b></td>
        </tr>
        <tr>
            <td width='15%'>Masalah</td>
            <td width='10px'>:</td>
            <td style="text-transform: uppercase;"><b><?php echo($ds_sm["masalah"]); ?></b></td>
        </tr>
        <tr>
            <td width='15%'>Sub Masalah</td>
            <td width='10px'>:</td>
            <td style="text-transform: uppercase;"><b><?php echo($ds_sm["jenis_surat"]); ?></b></td>
        </tr>
    </table>
    <div style="height: 10px;"></div>
    <hr style="border-style: dashed;" />
    <div style="height: 10px;"></div>
<?php
    }
?>
</body>
</html>