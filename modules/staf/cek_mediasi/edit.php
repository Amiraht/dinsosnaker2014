<link rel='stylesheet' href='../../../css/tabel.css' type='text/css' />
<style type="text/css">
fieldset{
	margin-top:20px;
	padding-top:20px;
}
</style>
<script type="text/javascript">
	function terima(c,uid){
	var x = '<?php echo "$resi"; ?>';
	s='../../../index.php?mod=staf&opt=lembar_disposisi&link='+c+'&id_user='+uid;
		parent.document.location.href=s;
	}
	
	function tolak(c,uid){
	var w = '<?php echo "$resi"; ?>';
	g='../../../index.php?mod=staf&opt=lanjut_mediasi&opts=tolak&link='+c+'&id_user='+uid;
		parent.document.location.href=g;
	}	
</script>	
<?php
include "../../../libraries/dinsos.php";
$resi = $_GET["link"]; 
$userid=$_GET["id_user"];
$qry="select * from tbl_berkas_pengaduan where no_resi  = '$resi'";
$cz = mysql_query($qry);
$dt=mysql_fetch_array($cz);
?>
<fieldset>
	<legend>LAPORAN MEDIASI</legend>
<form action="mediasi_validate.php?link=<?php echo $resi; ?>&id_user=<?php echo $userid; ?>" method="POST" enctype="multipart/form-data">
<table>
<tr>
	<td>HASIL MEDIASI
	<td width="40"> :
	<td> 
		<select name="hasil">
		<?php
		$rt = mysql_query("select * from tbl_hasil_mediasi");
		while($da = mysql_fetch_array($rt))
			{
				if($da[0]==$dt["hasil_mediasi"])
				{
					echo "<option value='$da[0]' selected>$da[1]</option> ";
				}
				else
				{
					echo "<option value='$da[0]'>$da[1]</option> ";
				}
			}
		?>
		</select>
</tr>
<tr valign="top">
	<td width="40%">FILE HASIL  MEDIASI</td>
	<td>:</td>
	<td><input type="file" name="file" value="<?php echo $dt["file"];?>">Maximum 1,4 MB</td>
</tr>
<tr valign="top">
	<td>KETERANGAN
	<td width = "40"> :
	<td>
		<textarea name="keterangan" cols="60" rows="10" style="font-family:verdana;font-size:12px"><?php echo $dt["ket_mediasi"];?></textarea>
</tr>
<tr>
	<td></td>
	<td></td>
    	<?php
			$onc1="terima('".$resi."','".$userid."')";
			$onc="tolak('".$resi."','".$userid."')";
		?>	    
	<td><input type="submit" value="SIMPAN"><input type="RESET" value="BATAL"></td>
</tr>
<tr>
	<td></td>
	<td></td>
    <td><br/><br/>
    <input type="button" onClick="<?php echo $onc; ?>" value="PROSES UNTUK PANGGILAN SELANJUTNYA"> <input type="button" onClick="<?php echo $onc1; ?>" value="LANJUTKAN" id="btn"></td>
</tr>
</table>
</form>
</fieldset>
<fieldset>
<legend>CATATAN DISPOSISI</legend>
    <table class="tblisi" border="1" cellpadding="0" cellspacing="0" align="center">
        <tr align="center">
            <td>TANGGAL</td>
            <td>DARI</td>
            <td>LEVEL</td>
            <td>KEPADA</td>
            <td>LEVEL</td>
            <td>PESAN</td>
        </tr>
    <?php
	$q = mysql_query("select * from tbl_info_disposisi where no_resi ='".$resi."'");	
    while($qz = mysql_fetch_array($q))
    {
            $nmpri=mysql_query("select nama from user where id_user='".$qz["dari"]."'");
            $rnmpri = mysql_fetch_array($nmpri);
            $dari=$rnmpri["nama"];
            
            $nmpri=mysql_query("select nama_level from tbl_ket_level where id_level='".$qz["dari_level"]."'");
            $rnmpri = mysql_fetch_array($nmpri);
            $dari_level=$rnmpri["nama_level"];
            
            $nmpri=mysql_query("select nama from user where id_user='".$qz["tujuan"]."'");
            $rnmpri = mysql_fetch_array($nmpri);
            $tujuan=$rnmpri["nama"];
            
            $nmpri=mysql_query("select nama_level from tbl_ket_level where id_level='".$qz["tujuan_level"]."'");
            $rnmpri = mysql_fetch_array($nmpri);
            $tujuan_level=$rnmpri["nama_level"];
    
    
    ?>
        <tr align="center">
            <td><?php echo tgl_indo($qz["tgl"]); ?></td>
            <td><?php echo $dari; ?></td>
            <td><?php echo $dari_level; ?></td>
            <td><?php echo $tujuan; ?></td>
            <td><?php echo $tujuan_level; ?></td>
            <td><?php echo $qz["pesan"]; ?></td>
        </tr>
    <?php
    }
    ?>
    </table> 
</fieldset>    


<?php

function tgl_indo($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;		 
	}	

	function getBulan($bln){
				switch ($bln){
					case 1: 
						return "Januari";
						break;
					case 2:
						return "Februari";
						break;
					case 3:
						return "Maret";
						break;
					case 4:
						return "April";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Juni";
						break;
					case 7:
						return "Juli";
						break;
					case 8:
						return "Agustus";
						break;
					case 9:
						return "September";
						break;
					case 10:
						return "Oktober";
						break;
					case 11:
						return "November";
						break;
					case 12:
						return "Desember";
						break;
				}
			}
?>     