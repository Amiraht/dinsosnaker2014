<style type="text/css" media="all">@import "../../../css/template.css";</style>
<script type="text/javascript">
function cek_tambah()
{
	if(document.ftambah.nama.value == '')
		alert('nama tidak boleh kosong');
	else if(document.ftambah.username.value == '')
		alert('username tidak boleh kosong');
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
	<td width="40%">NAMA</td>
    <td><input type="text" name="nama" maxlength="100" style="font-family:verdana; font-size:10px;" size="30"/></td>
</tr>
<tr id="tbl-content">
	<td >USERNAME</td>
    <td><input type="text" name="username" maxlength="100" style="font-family:verdana; font-size:10px;" size="30"/></td>
</tr>
<tr id="tbl-content">
	<td >PASSWORD</td>
    <td><input type="password" name="password" maxlength="100" style="font-family:verdana; font-size:10px;" size="30"/></td>
</tr>
<tr id="tbl-content">
	<td>LEVEL</td>
    <td><select name="level">
    <option value="0">PILIH LEVEL</option>
    <?php
		$c = mysql_query("select * from tbl_ket_level order by id_level asc");
		while($c1 = mysql_fetch_array($c))
		{
				echo '<option value="'.$c1["id_level"].'">'.$c1["nama_level"].'</option>';
		}
	?>
    </select></td>
</tr>
<tr id="tbl-content">
	<td>IZIN</td>
    <td><input type="radio" value="Y" name="izin" />YA&nbsp;&nbsp;&nbsp;<input type="radio" value="N" name="izin" />TIDAK</td>
</tr>
<tr id="tbl-content">
	<td colspan="2"><img src="../../../../image/button/simpan.gif" style="border:none" onmouseover="this.src='../../../../image/button/simpan2.gif';this.style.cursor='pointer';" onmouseout="this.src='../../../../image/button/simpan.gif';" width="90" height="27" title="Klik Untuk Menyimpan" onclick="cek_tambah();"/></td>
</tr>
</table>