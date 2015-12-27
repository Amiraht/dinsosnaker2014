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
	s='../../../index.php?mod=staf&opt=lanjut_mediasi&opts=terima&link='+x+'&id_user='+uid;
		parent.document.location.href=s;
	}
	
	function tolak(uid){
	var w = '<?php echo "$no_resi"; ?>';
	g='../../../index.php?mod=staf&opt=lanjut_mediasi&opts=tolak&link='+w+'&id_user='+uid;
		parent.document.location.href=g;
	}
	
</script>
<?php
$userid=$_GET["id_user"];
include "../../../libraries/dinsos.php";
$data_khusus = mysql_query("select * from tbl_berkas_pengaduan where no_resi='".$no_resi."'");
$da = mysql_fetch_array($data_khusus);
$sp1=$da["statusp1"];
$sp2=$da["statusp2"];
$sp3=$da["statusp3"];
$hs=$da["hasil_mediasi"];
$hasil = mysql_query("select * from tbl_hasil_mediasi where id_hasil='".$hs."'");
$hsm=mysql_fetch_array($hasil);
if($sp1=='1' and $sp2=='0' and $sp3=='0')
{
	$judul="SURAT PEMANGGILAN I";
	$panggilan="cetak_sp1";
}
if($sp1=='1' and $sp2=='1' and $sp3=='0')
{
	$judul="SURAT PEMANGGILAN II";
	$panggilan="cetak_sp2";
}
if($sp1=='1' and $sp2=='1' and $sp3=='1')
{
	$judul="SURAT PEMANGGILAN III";
	$panggilan="cetak_sp3";
}
?>
<fieldset>
	<legend><?php echo $judul; ?></legend>
	   <p>
		<label>
		  <input type="checkbox" name="berkas" value="1" id="berkas_0">
		  SURAT SUDAH DIKIRIM <a href="../../penomoran/<?php echo $panggilan;?>.php?link=<?php echo $no_resi;?>" target="_blank">(LIHAT SURAT)</a></label>
		<br>
	  </p>
	<center>
    	<?php
			$onc="tolak('".$userid."')";
			$onc1="terima('".$userid."')";
		?>	
		<input type="button" onClick="CekAll()" value="CENTANG SEMUA">
        <!--<input type="button" onClick="<?php echo $onc; ?>" value="SURAT PANGGILAN SELANJUTNYA"> -->
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
        <tr>
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