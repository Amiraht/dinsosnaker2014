<?php
$resi = $_GET["link"];
?>
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
	var x = '<?php echo "$resi"; ?>';
	s='../../../index.php?mod=kadis&opt=penugasan&opts=proses&value='+x;
		document.location.href=s;
	}
</script>
<fieldset>
	<legend>CHECKLIST PERSYARATAN DAN KELENGKAPAN BERKAS</legend>
	<p>
		<label>
		  <input type="checkbox" name="berkas" value="1" id="berkas_0">
		  BERKAS SURAT SUDAH DI CEK</label>
		<br>
		<label>
		  <input type="checkbox" name="berkas" value="2" id="berkas_1">
		  BERKAS SURAT SUDAH DI TANDATANGANI</label>
		<br>
	</p>
	<center>		
		<input type="button" onClick="CekAll()" value="CENTANG SEMUA"> 
		<input type="button" onClick="terima()" value="PROSES" disabled id="btn">
	</center>
</fieldset>