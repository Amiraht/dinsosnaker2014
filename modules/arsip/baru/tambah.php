<script>
$(document).ready(function(){
	$("#kd_lemari").change(function(){
		var kd_lemari=$("#kd_lemari").val();
		if(kd_lemari=='0')
		{
			$("#kd_rak").html('<option value=0></option>');
		}
		else
		{
			$("#kd_rak").html('<option value=0>Loading</option>');
			$.ajax
			({
				url:'./ajax/cek_rak.php',
				data:'kd_lemari='+kd_lemari,
				success:function(data)
				{
					$("#kd_rak").html(data);
				}
				
			});
		 }
	});
});
</script>	


<script language="javascript">
fields = 0;
function addInput(xa) {
 var element = document.getElementById('upl');
  var new_el = document.createElement("input");
  new_el.setAttribute("type", "file");
  new_el.setAttribute("name", "file[]");
  document.getElementById(xa).insertBefore(new_el, element);

}
</script>
<?php
include "../../../libraries/dinsos.php";
$no_resi = $_GET["link"];

$a = mysql_query("select * from vw_info_berkas where no_resi='$no_resi'");
$a1 = mysql_fetch_array($a);

$b = mysql_query("select * from tbl_arsip_berkas where no_resi='$no_resi'");
$b1 = mysql_fetch_array($b);

?>
</br>
<fieldset>
<legend>INFORMASI LOKASI BERKAS</legend>
<form action="info_berkas.php?aa=<?php echo $a1["no_resi"]?>" method="POST" name="info">
<table>
<tr>
	<td width="30%">Jenis Pengurusan</td>
    <td><input type="text" name="judul" maxlength="100" size="30" disabled value="<?php echo $a1["pengurusan"]?>"/></td>
</tr>
<tr>
	<td width="10%">Nama Perusahaan</td>
    <td><input type="text" name="namaper" maxlength="100" size="30" disabled value="<?php echo $a1["nama"]?>"/></textarea></td>
</tr>
<tr>
	<td width="10%">Nomor Resi</td>
    <td><input type="text" name="no_res" maxlength="100" size="30" disabled value="<?php echo $a1["no_resi"]?>"/></td>
</tr>
<tr>
	<td width="10%">Kode Lemari</td>  
    <td>
    <select name="kd_lemari" id="kd_lemari">
    <option value=0></option>
        <?php
			$t = mysql_query("select * from tbl_lemari order by kode_lemari");
			while($t1 = mysql_fetch_array($t))
			{
             	echo"<option value=$t1[id]>$t1[kode_lemari]</option>";
			}
        ?>
   </select>
   </td>
</tr>
<tr>
	<td width="10%">Kode Rak</td>
    <td><select name="kd_rak" id="kd_rak">
    <option value=0></option>
        <?php
			$t = mysql_query("select * from tbl_lemari_rak");
			while($t1 = mysql_fetch_array($t))
			{
             	echo"<option value=$t1[id]>$t1[kode_rak]</option>";
			}
        ?>    
   </select></td>
</tr>
<tr>
	<td width="10%">Kode Folder</td>
    <td><input type="text" name="kd_folder" maxlength="100" size="30" value="<?php echo $b1["kode_folder"]?>"/></td>
</tr>
<tr>
	<td width="10%" valign="top">Keterangan</td>
    <td><textarea name="keterangan" cols="50" rows="5"><?php echo $b1["keterangan"]?></textarea></td>
</tr>
<tr>
	<td colspan="2" valign="right"><input type="submit" name="informasi_berkas" value="SIMPAN"></td>
</tr>
</table>
</form>
</fieldset>
</br></br>
<fieldset>
<legend>INFORMASI GAMBAR BERKAS</legend>
<form action="validasi.php?aa=<?php echo $a1["no_resi"]?>" method="POST" id="ftambah" enctype="multipart/form-data">
<input type="file" id="file" name="file[]"><label> ekstensi yang di perbolehkan : jpg,jpeg,png</label><br/><br/>
	<div id="upl"></div>
<input type="button" onclick="addInput('ftambah');" name="add" value="TAMBAH"/><br/><br/>
<input type="submit" name="upload"	value="PROSES"/> 

</form>	
</fieldset>