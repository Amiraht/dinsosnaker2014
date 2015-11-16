<link rel='stylesheet' href='../../../css/tabel.css' type='text/css' />
<link rel='stylesheet' href='../../../css/button.css' type='text/css' />
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
	s='../../../index.php?mod=sekretaris&opt=lembar_disposisi&opts=terima&link='+x+'&id_user='+uid;
		parent.document.location.href=s;
	}
	function tolak(uid){
	var w = '<?php echo "$no_resi"; ?>';
	g='../../../index.php?mod=sekretaris&opt=lembar_disposisi&opts=tolak&link='+w+'&id_user='+uid;
		parent.document.location.href=g;
	}
	
</script>
<?php
$userid=$_GET["id_user"];
include "../../../libraries/dinsos.php";
$data_khusus = mysql_query("select * from tbl_berkas_pengaduan where no_resi='".$no_resi."'");
$da = mysql_fetch_array($data_khusus);
$hs=$da["hasil_mediasi"];
$sp1=$da["statusp1"];
$sp2=$da["statusp2"];
$sp3=$da["statusp3"];
$hasil = mysql_query("select * from tbl_hasil_mediasi where id_hasil='".$hs."'");
$hsm=mysql_fetch_array($hasil);
?>
<fieldset>
	<legend>INFORMASI PENGADUAN</legend>
<table name="biodata" border="0" cellspacing="0" cellpadding="0" style='text-transform:uppercase'>
  <tr>
	<td>NAMA</td>
	<td>:&nbsp;</td>
	<td><?php echo"$da[4]"?></td>
  </tr>
  <tr>
	<td>NO KTP</td>
	<td>:</td>
	<td><?php echo"$da[5]"?></td>
  </tr>
  <tr>
	<td>ALAMAT</td>
	<td>:</td>
	<td><?php echo"$da[6]"?></td>
  </tr>
  <tr>
	<td>NO HP</td>
	<td>:</td>
	<td><?php echo"$da[7]"?></td>
  </tr>
  <tr>
	<td>NO TELEPON</td>
	<td>:</td>
	<td><?php echo"$da[8]"?></td>
  </tr>
  <tr>
	<td>MULAI BEKERJA</td>
	<td>:</td>
	<td><?php echo"$da[9]"?></td>
  </tr>
  <tr>
	<td>JABATAN</td>
	<td>:</td>
	<td><?php echo"$da[10]"?></td>
  </tr>
  <tr>
	<td>UPAH POKOK</td>
	<td>:</td>
	<td><?php echo"$da[upah]"?></td>
  </tr>   
  <tr>
	<td>DASAR PERMASALAHAN</td>
	<td>:</td>
	<td><?php echo"$da[11]"?></td>
  </tr>
  <tr>
	<td>MASA KERJA</td>
	<td>:</td>
	<td><?php echo"$da[12]"?></td>
  </tr>
  <tr>
	<td>KRONOLOGIS PERMASALAHAN</td>
	<td>:</td>
	<td><?php echo"$da[13]"?></td>
  </tr>
  <tr>
	<td>JANJI YANG PERNAH DIBERIKAN</td>
	<td>:</td>
	<td><?php echo"$da[14]"?></td>
  </tr>
</table>
</fieldset>
<?php
	if($sp1=='0')
	{
		$panggilan="cetak_sp1";
	}
	else
	{
		if($sp2=='0')
		{
			$panggilan="cetak_sp2";
		}
		else
		{
			$panggilan="cetak_sp3";
		}
		
	}
?>
<fieldset>
	<legend>PARAF SURAT PEMANGGILAN</legend>
	   <p>
		<label>
		  <input type="checkbox" name="berkas" value="1" id="berkas_0">
		  BERKAS SUDAH DICEK <a href="../../penomoran/<?php echo $panggilan;?>.php?link=<?php echo $no_resi;?>" target="_blank">(LIHAT DRAFT)</a></label>
		<br>
		<label>
		  <input type="checkbox" name="berkas" value="2" id="berkas_1">
		  SURAT PEMANGGILAN SUDAH DIPARAF</label>
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
<fieldset>
<legend>CATATAN DISPOSISI</legend>
    <table class="tblisi" border="1" cellpadding="0" cellspacing="0" align="center">
        <tr align="center" height="19px">
            <td>TANGGAL</td>
            <td>DARI</td>
            <td>LEVEL</td>
            <td>KEPADA</td>
            <td>LEVEL</td>
            <td>PESAN</td>
        </tr>
    <?php
	$q = mysql_query("select * from tbl_info_disposisi where no_resi ='".$no_resi."'");	
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
        <tr >
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