<style type="text/css" media="all">@import "../../../css/template.css";</style>
<script type="text/javascript">
function cek_tambah()
{
	if(document.fedit.nama.value == '')
		alert('nama tidak boleh kosong');
	else
		document.fedit.submit();

}
</script>
<?php
define('_BLH_EXEC', '1');
require_once('../../../../libraries/dinsos.php');
$q1 = mysql_query("select * from user where id_user='".$_GET["id_member"]."'");
$q11 = mysql_fetch_array($q1);
	
?>

<fieldset style="margin:10px"><legend style="font-family:verdana; font-size:12px;"><b>EDIT PENGGUNA</b></legend>
<form action="./validasi.php?optss=edit&id_member=<?php echo $_GET["id_member"]; ?>" method="post" name="fedit" enctype="multipart/form-data">
<table cellpadding="2px" cellspacing="1px" border="0" align="left" id="tbl">
<tr id="tbl-content">
	<td width="40%">NAMA</td>
    <td><input type="text" name="nama" maxlength="100" style="font-family:verdana; font-size:10px;" size="30" value="<?php echo $q11["nama"]; ?>"/></td>
</tr>
<tr id="tbl-content">
	<td>USERNAME</td>
    <td><input type="text" name="username" maxlength="100" style="font-family:verdana; font-size:10px;" size="30" value="<?php echo $q11["username"]; ?>"/></td>
</tr>
<tr id="tbl-content">
	<td>PASSWORD</td>
    <td><input type="password" name="password" maxlength="100" style="font-family:verdana; font-size:10px;" size="30" value=""/></td>
</tr>
<tr id="tbl-content">
	<td>LEVEL</td>
    <td><select name="level">
    <option value="0">PILIH LEVEL</option>
    <?php
		$c = mysql_query("select * from tbl_ket_level order by id_level asc");
		while($c1 = mysql_fetch_array($c))
		{
			if($q11["level"] == $c1["id_level"])
				echo '<option value="'.$c1["id_level"].'" selected="selected">'.$c1["nama_level"].'</option>';
			else
				echo '<option value="'.$c1["id_level"].'">'.$c1["nama_level"].'</option>';
		}
	?>
    </select></td>
</tr>
<tr id="tbl-content">
	<td>IZIN</td>
    <td><input type="radio" value="Y" name="izin" <?php if($q11["izin"] == 'Y') echo 'checked'; ?> />YA&nbsp;&nbsp;&nbsp;<input type="radio" value="N" name="izin" <?php if($q11["izin"] == 'N') echo 'checked'; ?> />TIDAK</td>
</tr>
<tr id="tbl-content">
	<td colspan="2"><input type="submit" name="informasi_berkas" value="SIMPAN" onclick="cek_tambah();"/></td>
</tr>
</table>
</fieldset>