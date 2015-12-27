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
	
	function terima(){
	var x = '<?php echo "$no_resi"; ?>';
	s='../../../index.php?mod=loket&opt=berkas_serah&opts=terima2&value='+x;
		document.location.href=s;
	}
	function tolak(){
	var w = '<?php echo "$no_resi"; ?>';
	g='../../../index.php?mod=loket&opt=berkas_serah&opts=tolak&value='+w;
		document.location.href=g;
	}
</script>
<?php
include "../../../libraries/dinsos.php";
$no_resi = $_GET["link"];
?>
<fieldset>
	<legend>KELENGKAPAN BERKAS YANG AKAN DISERAHKAN</legend>
	   <p>
		<label>
		  <input type="checkbox" name="berkas" value="1" id="berkas_0">
		  PEMOHON TELAH MENGISI DAN MENANDATANGI BUKU TANDA BUKTI PENYERAHAN BERKAS AKHIR</label>
		<br>
		<label>
		  <input type="checkbox" name="berkas" value="2" id="berkas_1">
		  BERKAS SUDAH DISERAHKAN</label>
		<br>
	  </p>
	<center>		
		<input type="button" onClick="CekAll()" value="CENTANG SEMUA"> 
		<input type="button" onClick="terima()" value="LANJUTKAN" disabled id="btn">
	</center>
	</fieldset>