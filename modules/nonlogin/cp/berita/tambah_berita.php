<style type="text/css" media="all">@import "../../../css/template.css";</style>
<script type="text/javascript">
function cek_tambah()
{
	if(document.ftambah.judul.value == '')
		alert('Judul Berita tidak boleh kosong');
	else if(document.ftambah.file.value == '')
		alert('File tidak boleh kosong');
	else
		document.ftambah.submit();

}
</script>
<?php
require_once('../../../../libraries/dinsos.php');	
?>

<fieldset style="margin:10px">
<legend style="font-family:verdana; font-size:12px;"><b>Tambah Berita dan Informasi</b></legend>
<form action="./validasi.php?optss=tambah" method="post" name="ftambah" enctype="multipart/form-data">
<table cellpadding="2px" cellspacing="1px" border="0" align="left" id="tbl">
<tr id="tbl-content">
	<td width="30%">Judul Berita</td>
    <td><input type="text" name="judul" maxlength="100" style="font-family:verdana; font-size:10px;" size="30"/></td>
</tr>
<tr id="tbl-content">
	<td >Keterangan</td>
    <td><textarea name="keterangan" cols="50" rows="5" style="font-family:verdana; font-size:10px;"></textarea></td>
</tr>
<tr id="tbl-content">
	<td >File</td>
    <td><input type="file" name="file" style="font-family:verdana; font-size:10px;"> Maximum 1,4 MB</td>
</tr>
<tr id="tbl-content">
	<td colspan="2"><img src="../../../../image/button/simpan.gif" style="border:none" onmouseover="this.src='../../../../image/button/simpan2.gif';this.style.cursor='pointer';" onmouseout="this.src='../../../../image/button/simpan.gif';" width="90" height="27" title="Klik Untuk Menyimpan" onclick="cek_tambah();"/></td>
</tr>
</table>