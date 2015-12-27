<script type="text/javascript" src="../../../libraries/fancybox/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="../../../libraries/fancybox/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="../../../libraries/fancybox/fancybox/jquery.fancybox-1.3.4.css" media="screen" />

<script type="text/javascript">
	$(document).ready(function() {
		$("a[rel=example_group]").fancybox({
			'transitionIn'		: 'none',
			'transitionOut'		: 'none',
			'titlePosition' 	: 'over',
			'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
				return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
			}
		});			
	});
</script>
<link href="../../../libraries/bettertooltip/theme/style.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="../../../libraries/bettertooltip/js/jquery.betterTooltip.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("a[rel=example_group]").betterTooltip({speed: 150, delay: 300});
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
    <select name="kd_lemari">
    <option value=0></option>
        <?php
			$t = mysql_query("select * from tbl_lemari order by kode_lemari");
			while($t1 = mysql_fetch_array($t))
			{
				if($b1["id_lemari"]==$t1["id"])
                {
                    echo"<option value=$t1[id] selected>$t1[kode_lemari]</option>";
                }
                else
                {
                    echo"<option value=$t1[id]>$t1[kode_lemari]</option>";
                }	
			}
        ?>
   </select>
   </td>
</tr>
<tr>
	<td width="10%">Kode Rak</td>
    <td><select name="kd_rak">
    <option value=0></option>
        <?php
			$t = mysql_query("select * from tbl_lemari_rak order by kode_rak");
			while($t1 = mysql_fetch_array($t))
			{
				if($b1["id_rak"]==$t1["id"])
                {
                    echo"<option value=$t1[id] selected>$t1[kode_rak]</option>";
                }
                else
                {
                    echo"<option value=$t1[id]>$t1[kode_rak]</option>";
                }	
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
<table cellpadding="0" cellspacing="0" width="100%" align="left">
<?php

$d = mysql_query("select count(*) as jumlah from tbl_arsip_upload where no_resi='$no_resi'");	
$d1 = mysql_fetch_array($d);
$jumlah = $d1["jumlah"];

		
$i = 1;

$d = mysql_query("select * from tbl_arsip_upload where no_resi='$no_resi'");
	
while($d1 = mysql_fetch_array($d))
{
	$gambar[$i][0] = $d1["id"];
	$gambar[$i][1] = $d1["judul"];
	$gambar[$i][2] = $d1["nama_file"];
	$i++;
}

$j=1;
$jlh_baris = ceil(($i-1)/4);
while($jlh_baris != 0)
{
	echo '<tr>';
	for($k=0; $k<4; $k++)
	{
		echo '<td align="center" valign="middle" width="25%">';
		if($gambar[$j][0] != '')
		{
			echo '<div class="galeri">';
			echo '<a rel="example_group" href="../../../upload/'.$no_resi.'/'.$gambar[$j][2].'" title="'.$gambar[$j][1].'"><img src="../../../upload/'.$no_resi.'/kecil_'.$gambar[$j][2].'"></a><br>';
			echo '</div>';
			//echo '<a href="../../../libraries/fdownload.php?jenis=foto&path='.$no_resi.'/'.$gambar[$j][2].'" target="_blank" class="foto" title="klik untuk download"><img src="../../../image/icon/download1.gif" width="25" height="25"></a>&nbsp;';
			echo '<a href="validasi.php?aa='.$no_resi.'&mode=3&id='.$gambar[$j][0].'" class="foto" title="klik untuk hapus" onClick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\' +  \'\n\n\' + \'Jika YA silahkan klik OK, Jika TIDAK klik CANCEL.\')"><img src="../../../image/icon/hapus1.gif" width="25" height="25"></a>';
			
		}
		echo '<br>';
		echo '<br>';
		echo '</td>';
		$j++;
	}
	echo '</tr>';
	$jlh_baris--;
}
?>
</table>

<form action="validasi.php?aa=<?php echo $a1["no_resi"]?>" method="POST" id="ftambah" enctype="multipart/form-data">
<input type="file" id="file" name="file[]"><label> ekstensi yang di perbolehkan : jpg,jpeg,png</label><br/><br/>
	<div id="upl"></div>
<input type="button" onclick="addInput('ftambah');" name="add" value="TAMBAH"/><br/><br/>
<input type="submit" name="upload"	value="PROSES"/> 

</form>	
</fieldset>