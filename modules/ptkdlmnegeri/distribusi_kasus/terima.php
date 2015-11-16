<?php
if(!isset($_GET["value"]))
{
	echo "akses di tolak";
}
else
{
	$no_resi = $_GET["value"];
?>
<script type="text/javascript">
function tampil(c)
{
		var t=document.getElementById("div_cek");
		if(t.innerHTML != ''){
			t.innerHTML = '';
		}
		else
			t.innerHTML='<iframe src="./modules/ptkdlmnegeri/distribusi_kasus/tim_periksa/tambah.php?link='+c+'" width="100%" style="height:500px; width:700px;" frameborder="0" scrolling="no" id="iframe_detail"></iframe>';
		
}

	function tolak(){
	var d = '<?php echo "$no_resi"; ?>';
	e='../../../index.php?mod=ptkdlmnegeri&opt=distribusi_kasus&opts=tolak&value='+d;
		document.location.href=e;
	}
</script>
<span> Berdasarkan hasil analisa yang ada, pengurusan perpanjangan IMTA ini </br>perlu dilakukan :
		<input type="button" onClick="tampil('<?php echo $no_resi; ?>')" id="btn" value="VERIFIKASI KE LAPANGAN">
		<input type="button" onClick="tolak()" id="btn" value="TIDAK PERLU MELAKUKAN VERIFIKASI KE LAPANGAN">
</span>
<div id='div_cek'></div>
<?
}
?>