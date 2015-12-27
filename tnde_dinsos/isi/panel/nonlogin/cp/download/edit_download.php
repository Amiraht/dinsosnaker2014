<style type="text/css" media="all">@import "../../../css/template.css";</style>
<script type="text/javascript">
function cek_tambah()
{
	if(document.fedit.judul.value == '')
		alert('Judul Berita tidak boleh kosong');
	else
		document.fedit.submit();

}
</script>
<?php
//define('_BLH_EXEC', '1');
require_once('../../../../libraries/dinsos.php');

	$q1 = mysql_query("select * from tbl_download where id_download='".$_GET["id_download"]."'");
	$q11 = mysql_fetch_array($q1);
	
?>

<fieldset style="margin:10px"><legend style="font-family:verdana; font-size:12px;"><b>Edit File Download</b></legend>
<form action="../../../../index.php?mod=cp&opt=download&opts=validasi&optss=edit&id_download=<?php echo $_GET["id_download"]; ?>" method="post" name="fedit" enctype="multipart/form-data">
<table cellpadding="2px" cellspacing="1px" border="0" align="left" id="tbl">
<tr id="tbl-content">
	<td width="30%">Judul File</td>
    <td><input type="text" name="judul" maxlength="100" style="font-family:verdana; font-size:10px;" size="30" value="<?php echo $q11["judul"]; ?>"/></td>
</tr>
<tr id="tbl-content">
	<td>Keterangan</td>
    <td><textarea name="keterangan" cols="50" rows="5" style="font-family:verdana; font-size:10px;"><?php echo $q11["keterangan"]; ?></textarea></td>
</tr>
<tr id="tbl-content">
	<td >File</td>
    <td><input type="file" name="file" style="font-family:verdana; font-size:10px;"> Maximum 1,4 MB</td>
</tr>
<tr id="tbl-content">
	<td colspan="2"><input type="submit" name="informasi_berkas" value="SIMPAN" onclick="cek_tambah();"/></td>
</tr>
</table>
</fieldset>