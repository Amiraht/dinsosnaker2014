<link rel='stylesheet' href='../../../css/tabel.css' type='text/css' />

<?php
include "../../../libraries/dinsos.php";

$resi = $_GET["link"]; 
$b = mysql_query("select * from tbl_info_disposisi where no_resi = '$resi'");
$f = mysql_fetch_array($b);
function tgl_indo($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = substr($tgl,5,2);
			$tahun = substr($tgl,0,4);
			return $tanggal.'-'.$bulan.'-'.$tahun;		 
	}
?>
<script type="text/javascript">
	function cetak_data(){	
		//var x = '<?php echo "$no_resi"; ?>';
		var link = '<?php echo base64_encode(base64_encode(base64_encode($_GET['link']))); ?>';
		s = '../cetak_disposisi.php?link='+link;
		window.open(s);
		//parent.document.location.href=s;
		//alert('Cetak ini '+id_p);
	}
</script>
<fieldset>
	<?php $nomor_resi = $f['no_resi']; ?>
	<legend>LEMBAR KENDALI</legend>
	
<form action="cetak_disposisi.php?link=<?php echo $resi; ?>" method="POST">

<table class="tblisi" border="1" cellpadding="0" cellspacing="0" align="center" width="100%">
    <tr align="center">
        <th height="20px">TANGGAL</th>
        <th>DARI</th>
        <th>LEVEL</th>
        <th>KEPADA</th>
        <th>LEVEL</th>
        <th>PESAN</th>
    </tr>
<?php
while($bz = mysql_fetch_array($b))
{
		$nmpri=mysql_query("select nama from user where id_user='".$bz["dari"]."'");
		$rnmpri = mysql_fetch_array($nmpri);
		$dari=$rnmpri["nama"];
		
		$nmpri=mysql_query("select nama_level from tbl_ket_level where id_level='".$bz["dari_level"]."'");
		$rnmpri = mysql_fetch_array($nmpri);
		$dari_level=$rnmpri["nama_level"];
		
		$nmpri=mysql_query("select nama from user where id_user='".$bz["tujuan"]."'");
		$rnmpri = mysql_fetch_array($nmpri);
		$tujuan=$rnmpri["nama"];
		
		$nmpri=mysql_query("select nama_level from tbl_ket_level where id_level='".$bz["tujuan_level"]."'");
		$rnmpri = mysql_fetch_array($nmpri);
		$tujuan_level=$rnmpri["nama_level"];


?>
    <tr>
        <td><?php echo tgl_indo($bz["tgl"]); ?></td>
        <td><?php echo $dari; ?></td>
        <td><?php echo $dari_level; ?></td>
        <td><?php echo $tujuan; ?></td>
        <td><?php echo $tujuan_level; ?></td>
        <td><?php echo $bz["pesan"]; ?></td>
    </tr>
<?php
}
?>
<tr>
	<td colspan="6"><input type="button" value="CETAK" onClick='cetak_data()'></td>
</tr>
</table>
</form>
</fieldset>