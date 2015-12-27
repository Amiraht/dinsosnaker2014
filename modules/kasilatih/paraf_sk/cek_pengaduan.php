<link rel='stylesheet' href='../../../css/tabel.css' type='text/css' />
<style type="text/css">
fieldset{
	margin-top:20px;
	padding-top:20px;
}
</style>
<script type="text/javascript">
	function CekAll() {
		document.getElementById("btn").disabled=false;
		checkboxes = document.getElementsByName('berkas');
		for(var i=0, n=checkboxes.length;i<n;i++) {
			checkboxes[i].checked = true;
		}
	}

	function terima(uid){
	var x = '<?php echo "$no_resi"; ?>';
	s='../../../index.php?mod=kasi&opt=lembar_disposisi&opts=terima&link='+x+'&id_user='+uid;
		parent.document.location.href=s;
	}
	
	function tolak(){
	var w = '<?php echo "$no_resi"; ?>';
	g='../../../index.php?mod=kasi&opt=paraf_mediasi&opts=tolak&value='+w;
		document.location.href=g;
	}
</script>
<?php
$userid=$_GET["id_user"];
include "../../../libraries/dinsos.php";
$data_khusus = mysql_query("select * from tbl_berkas_pengaduan where no_resi='".$no_resi."'");
$da = mysql_fetch_array($data_khusus);
$hs=$da["hasil_mediasi"];
$hasil = mysql_query("select * from tbl_hasil_mediasi where id_hasil='".$hs."'");
$hsm=mysql_fetch_array($hasil);
?>
<fieldset>
	<legend>INFORMASI PENGADUAN</legend>
<table name="biodata" border="0" cellspacing="0" cellpadding="0" >
  <tr >
	<td>NAMA</td>
	<td>:&nbsp;</td>
	<td><?php echo"$da[4]"?></td>
  </tr>
  <tr >
	<td>NO KTP</td>
	<td>:</td>
	<td><?php echo"$da[5]"?></td>
  </tr>
  <tr >
	<td>ALAMAT</td>
	<td>:</td>
	<td><?php echo"$da[6]"?></td>
  </tr>
  <tr >
	<td>NO HP</td>
	<td>:</td>
	<td><?php echo"$da[7]"?></td>
  </tr>
  <tr >
	<td>NO TELEPON</td>
	<td>:</td>
	<td><?php echo"$da[8]"?></td>
  </tr>
  <tr >
	<td>MULAI BEKERJA</td>
	<td>:</td>
	<td><?php echo"$da[9]"?></td>
  </tr>
  <tr >
	<td>JABATAN</td>
	<td>:</td>
	<td><?php echo"$da[10]"?></td>
  </tr>
  <tr >
	<td>UPAH POKOK</td>
	<td>:</td>
	<td><?php echo"$da[upah]"?></td>
  </tr>   
  <tr >
	<td>DASAR PERMASALAHAN</td>
	<td>:</td>
	<td><?php echo"$da[11]"?></td>
  </tr>
  <tr >
	<td>MASA KERJA</td>
	<td>:</td>
	<td><?php echo"$da[12]"?></td>
  </tr>
  <tr >
	<td>KRONOLOGIS PERMASALAHAN</td>
	<td>:</td>
	<td><?php echo"$da[13]"?></td>
  </tr>
  <tr >
	<td>JANJI YANG PERNAH DIBERIKAN</td>
	<td>:</td>
	<td><?php echo"$da[14]"?></td>
  </tr>
  <tr>
  </tr>
  <tr>
	<td>TANGGAL MEDIASI</td>
	<td>:</td>
	<td><?php echo"$da[16]"?></td>
  </tr>
  <tr>
	<td>HASIL MEDIASI</td>
	<td>:</td>
	<td><?php echo"$hsm[1]"?></td>
  </tr>
  <tr>
	<td>KETERANGAN MEDIASI</td>
	<td>:</td>
	<td><?php echo"$da[17]"?></td>
  </tr>
</table>
</fieldset>
<fieldset>
	<legend>PARAF HASIL MEDIASI</legend>
	   <p>
		<label>
		  <input type="checkbox" name="berkas" value="1" id="berkas_0">
		  BERKAS SUDAH DICEK</label>
		<br>
		<label>
		  <input type="checkbox" name="berkas" value="2" id="berkas_1">
		  BERKAS SUDAH DIPARAF</label>
		<br>
	  </p>
	<center>	
    	<?php
			$onc="tolak('".$userid."')";
			$onc1="terima('".$userid."')";
		?>		
		<input type="button" onClick="CekAll()" value="CENTANG SEMUA"> 
		<input type="button" onClick="<?php echo $onc1; ?>" value="LANJUTKAN" disabled id="btn">
	</center>
	</fieldset>