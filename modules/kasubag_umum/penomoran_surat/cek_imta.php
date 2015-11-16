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
	s='../../../index.php?mod=kasubag_umum&opt=lembar_disposisi&opts=terima&link='+x+'&id_user='+uid;
		parent.document.location.href=s;
	}
	function tolak(uid){
	var w = '<?php echo "$no_resi"; ?>';
	g='../../../index.php?mod=kasubag_umum&opt=lembar_disposisi&opts=tolak&link='+w+'&id_user='+uid;
		parent.document.location.href=g;
	}
	
</script>
<fieldset>
<legend>DATA AWAL</legend>
<?php
$userid=$_GET["id_user"];
include "../../../libraries/dinsos.php";

$sql = "SELECT * FROM tbl_tim_periksa  WHERE no_resi='".$no_resi."'";
$res = mysql_query($sql);
if(mysql_num_rows($res)<>0)
{
	$link="<a href=../../penomoran/cetak_imta.php?link=$no_resi target=_blank>(LIHAT DRAFT)</a>";
}
else
{
	$link="";
}
?>
<fieldset>
	<legend>CHECKLIST PERSYARATAN DAN KELENGKAPAN SURAT</legend>
	 <p>
				<label>
				  <input type="checkbox" name="berkas" value="1" id="berkas_0">
				  BERKAS SURAT SUDAH DI CEK <?php echo $link; ?></label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="2" id="berkas_1">
				  BERKAS SURAT SUDAH DINOMORI</label>
				<br>
			  </p>
	<center>
    	<?php
			$onc="tolak('".$userid."')";
			$onc1="terima('".$userid."')";
		?>		
		<input type="button" onClick="CekAll()" value="CENTANG SEMUA"> 
		<input type="button" onClick="<?php echo $onc1; ?>" value="PROSES" disabled id="btn">
	</center>
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