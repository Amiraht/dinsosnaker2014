<?php
error_reporting(E_ALL ^ E_NOTICE);
include "../../../../libraries/dinsos.php";
$no_resi = $_GET["link"];
?>
<script language='javascript'>
	function check(a){
		ab = document.getElementById('nama').value;
		document.location="tambah.php?link=<?PHP echo $no_resi; ?>&uid="+ab;
	}

</script>
<fieldset>
<legend>PILIH ANGGOTA TIM PEMERIKSA</legend>
<table align="center">
	<tr>
		<td>NAMA
		<td width="50px"> :
		<td><select name="nama" id="nama" onChange="return check(1)">
		<?php
			if(empty($_GET["uid"]))
			{
				$ad = "SELECT id_user,nip,nama FROM user";
				echo "<option value='hidden'>PILIH NAMA</option>";
			}
			else
			{
				$a = $_GET['uid'];
				$ad = "SELECT * FROM user where id_user=$a";
			}
			$ad1 = mysql_query($ad);
			$ad2 = mysql_query($ad);
			$i=1;
			$data2=mysql_fetch_array($ad2);
			while ($data1=mysql_fetch_array($ad1))
			{
				echo "<option value='$data1[0]'> $data1[2]</option>\n";
				$i++;
			}    
			?></select>
	</tr>
	<tr>
		<td>NIP
		<td width="50px"> :
		<td><input type="text" disabled value="<?php echo $data2[1]; ?>" name="nip">
	</tr>
	<tr>
		<td>PANGKAT
		<td width="50px"> :
		<td><input type="text" disabled value="<?php echo $data2[4]; ?>" name="pangkat">
	</tr>
	<tr>
		<td>GOLONGAN
		<td width="50px"> :
		<td><input type="text" disabled value="<?php echo $data2[4]; ?>" name="golongan">
	</tr>
	<tr>
		<td>JABATAN
		<td width="50px"> :
		<td><input type="text" disabled value="<?php echo $data2[3]; ?>" name="jabatan">
	</tr>
	<tr>
		<td>JABATAN DALAM TIM
		<td width="50px"> :
		<td><input type="text" name="jbtn_tim">
	</tr>
</table>
</fieldset>