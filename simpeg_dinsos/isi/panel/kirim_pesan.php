<?php
	$curr_date = getdate();
	$cur_tgl = $curr_date['year'] . "-" . $curr_date['mon'] . "-" . $curr_date['mday'];
	
	// cek token string
	$pecah = explode('-', $cur_tgl);
	$bulan = ($pecah[1] < 10) ? "0" . $pecah[1] : $pecah[1];
	$token = $bulan ."-". $pecah[2];
	
	$sql = "SELECT * from tbl_pegawai WHERE RIGHT(tanggal_lahir, 5) = '$token' AND id_satuan_organisasi LIKE '".  $_SESSION["simpeg_id_skpd"]. "%'";
	$query = mysql_query($sql) or die(mysql_error());
	$num = mysql_num_rows($query);
	
?>

<center>
<div class="panelcontainer panelform" style="width: 80%;">
    <h3 style="text-align: left;">KIRIM UCAPAN SELAMAT ULANG TAHUN (TOTAL PEGAWAI YANG BERULANG TAHUN HARI INI : <?=$num; ?> orang)</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
<?php
	
	while($row = mysql_fetch_array($query)){

		// query check 
		$s = "SELECT * FROM tbl_ucapan_ultah_pegawai WHERE dari = '".$_SESSION["simpeg_id_pegawai"]."' AND tujuan = '".$row['id_pegawai']."' 
				AND tgl_submit = CURDATE()";
		$q = mysql_query($s);
		$jum = mysql_num_rows($q);
		if($jum > 0){
		
			echo "<table border='0px' cellspacing='0' cellpadding='6' width='100%'>
				<tr>
					<label>Terima kasih, atas pesan yang sudah kamu kirimkan kepada saudara ".$row['nama_pegawai']."</b></label>
				</tr>
			</table><br/><br/>";

	
		}else{

			echo "<form id='ultah' name='ultah' method='POST' action='php/pesan_insert_ultah.php'>
					<table border='0px' cellspacing='0' cellpadding='6' width='100%'>
					<tr>
						<label>Nama Pegawai : <b>" .$row['nama_pegawai']. " ( NIP: " .$row['nip']. " )</b></label>
						<input type='hidden' name='tujuan[]' value='" .$row['id_pegawai']. "' />
						<input type='hidden' name='dari' value='" .$_SESSION["simpeg_id_pegawai"]. "' />
					</tr>
					<tr>
						<textarea name='pesan[]' cols='5' rows='5'>
						</textarea>
					</tr>
					<tr>
						<input type='submit' value='KIRIM' class='btn btn-success' style='width:150px;'/>
					</tr>
				</table>
				</form><br/>";

		}
		
	}
	
?>	
	
     </div>
</div>
</center>
