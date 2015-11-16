<?php
error_reporting(E_ALL ^ E_NOTICE);
include "../../../../libraries/dinsos.php";
$no_resi = $_GET["link"];

$conn = mysqli_connect("localhost", "root", "", "db_disnakersos");
$userget = "SELECT id_user,nip,nama, jabatan FROM user";
$userdata = mysqli_query($conn, $userget);
$userarray = array();
	while ($row = mysqli_fetch_assoc($userdata)) {
		$userarray [ $row['id_user'] ] = $row['nama'];
	}	
?>
<script src='../../../../libraries/jquery-1.4.3.js'></script>
<script language='javascript'>
		$(document).ready(function(){
			 $('#nama_peg').change(function(){
					$.getJSON('fetching.php',{action:'getUser',id_user:$(this).val()},function(json){
						$.each(json, function(index,row){	
						$("#text1").attr("value",row.nip);
						$("#text4").attr("value",row.jabatan);
						});
						});
					});
				});
</script>
<!-- //	$('#mytext5').append('<option value='+row.id_jabatan+'>'+row.jabatan+'</option>'); -->
<fieldset>
<legend>PILIH ANGGOTA TIM PEMERIKSA</legend>
<table align="center">
	<tr>
		<td>NAMA
		<td width="50px"> :
		<td><select name="nama" id="nama_peg">
		<!--Panggil Nama-->
		<?php
		foreach($userarray as $id_user=>$nama){
					echo "<option value='$id_user'>$nama</option>";
		}
		?>
		</select>
	</tr>
	<tr>
		<td>NIP
		<td width="50px"> :
		<td><input type="text" disabled value="" name="nip" id="text1">
	</tr>
	<tr>
		<td>PANGKAT
		<td width="50px"> :
		<td><input type="text" disabled value="" name="jabatan" id="text2">
	</tr>
	<tr>
		<td>GOLONGAN
		<td width="50px"> :
		<td><input type="text" disabled value="" name="golongan" id="text3">
	</tr>
	<tr>
		<td>JABATAN
		<td width="50px"> :
		<td><input type="text" disabled value="" name="jabatan" id="text4">
	</tr>
	<tr>
		<td>JABATAN DALAM TIM
		<td width="50px"> :
		<td><input type="text" name="jbtn_tim">
	</tr>
</table>
</fieldset>