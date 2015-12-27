<?php
$userid=$_GET["id_user"];
if(!isset($_GET["value"]))
{
	echo "akses di tolak";
}
else
{
	$no_resi = $_GET["value"];
?>
<script type="text/javascript">
	function tampil(uid)
	{
	var x = '<?php echo $no_resi; ?>';
	s='./index.php?mod=kasiwasnaker&opt=tim_periksa&link='+x+'&id_user='+uid;
		parent.document.location.href=s;
	}
	
	function tolak(uid)
	{
	var x = '<?php echo $no_resi; ?>';
	s='./index.php?mod=kasiwasnaker&opt=lembar_disposisi&opts=no_periksa&link='+x+'&id_user='+uid;
		parent.document.location.href=s;
	}
	

</script>
<center>
        <?php
			//$onc="tampil('".$no_resi."')";
			$onc="tampil('".$userid."')";
			$onc1="tolak('".$userid."')";
		?>	
<span> Berdasarkan hasil analisa yang ada, pengurusan wajib lapor ini perlu dilakukan :<br/><br/>
		<input type="button" onClick="<?php echo $onc; ?>" value="VERIFIKASI KE LAPANGAN">
		<input type="button" onClick="<?php echo $onc1; ?>" value="TIDAK PERLU MELAKUKAN VERIFIKASI KE LAPANGAN"></span>
</center>
<div id='div_cek'></div>
<?php
}
?>