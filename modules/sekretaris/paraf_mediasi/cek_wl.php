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
	s='../../../index.php?mod=sekretaris&opt=lembar_disposisi&opts=terima&link='+x+'&id_user='+uid;
		parent.document.location.href=s;
	}
	function tolak(uid){
	var w = '<?php echo "$no_resi"; ?>';
	g='../../../index.php?mod=sekretaris&opt=lembar_disposisi&opts=tolak&link='+w+'&id_user='+uid;
		parent.document.location.href=g;
	}
	
</script>
<fieldset>
		<legend>DATA AWAL</legend>
<?php
$userid=$_GET["id_user"];
include "../../../libraries/dinsos.php";
$data_khusus = mysql_query("select * from tbl_berkas_wl where no_resi='".$no_resi."'");
$result = mysql_fetch_array($data_khusus);

$qry="select * from tbl_tenaga_kerja where id_perusahaan  = '".$result[3]."'";
$cz = mysql_query($qry);

$qry1="select * from tbl_rencana_tk where id_perusahaan  = '".$result[3]."'";
$cz1 = mysql_query($qry1);

$qry2="select * from tbl_tenaga_kerja_akhir where id_perusahaan  = '".$result[3]."'";
$cz2= mysql_query($qry2);

$qry3="select * from tbl_latihan where id_perusahaan  = '".$result[3]."'";
$cz3 = mysql_query($qry3);
$perusahaan = mysql_query("select * from db_dinsos where id_perusahaan='".$result[3]."'");
$tenagakerja = mysql_query("select b.nama, a.wnilk, a.wnipr, a.wnalk, a.wnapr from tbl_tenagakerja_dinsos a inner join db_dinsos b on a.id_perusahaan=b.id_perusahaan where a.id_perusahaan='".$result[3]."'");
	while($set = mysql_fetch_array($perusahaan))
	{
	        $nmpri=mysql_query("select kecamatan from t_kecamatan where id='".$set["kec"]."'");
            $rnmpri = mysql_fetch_array($nmpri);
            $kec=$rnmpri["kecamatan"];
			
	        $nmpri=mysql_query("select negara from t_negara where id_negara='".$da["kewarganegaraan"]."'");
            $rnmpri = mysql_fetch_array($nmpri);
            $neg=$rnmpri["negara"];
			
	        $nmpri=mysql_query("select jenis from t_jenis_usaha where id_jenis_usaha='".$set["jenis_usaha"]."'");
            $rnmpri = mysql_fetch_array($nmpri);
            $jenusaha=$rnmpri["jenis"];		
			
			$nmpri=mysql_query("select status from t_status where id_status ='".$set["id_status_perusahaan"]."'");
            $rnmpri = mysql_fetch_array($nmpri);
            $status=$rnmpri["status"];		

			$nmpri=mysql_query("select status from t_status_milik where id_status ='".$set["id_status_milik"]."'");
            $rnmpri = mysql_fetch_array($nmpri);
            $milik=$rnmpri["status"];	
			
			$nmpri=mysql_query("select modal from t_status_modal where id_status ='".$set["id_status_permodalan"]."'");
            $rnmpri = mysql_fetch_array($nmpri);
            $modal=$rnmpri["modal"];							
						
echo"
	<table id='data_awal' name='data_awal' style='text-transform:uppercase'>
		<tr>
    		<td>NAMA PERUSAHAAN</td>
			<td>:</td>
			<td>$set[1]</td>
		</tr>	
		<tr>        
			<td>ALAMAT</td>
			<td>:</td>
			<td>$set[2]</td>
		</tr>
		<tr>
			<td>KOTA/KABUPATEN</td>	
			<td>:</td>
			<td>$set[15]</td>	
		</tr>
			<td>KECAMATAN</td>
			<td>:</td>
			<td>$kec</td>
		</tr>
		<tr>
			<td>TELPON</td>
			<td>:</td>
			<td>$set[5]</td>
        </tr>
		<tr>
			<td>KODE POS</td>
			<td>:</td>
			<td>$set[6]</td>
		</tr>
		<tr>	
            <td>JENIS USAHA</td>
			<td>:</td>
			<td>$jenusaha</td>
		</tr>
		<tr>	
            <td>NAMA PEMILIK</td>
			<td>:</td>
			<td>$set[12]</td>
		</tr>
		<tr>	
            <td>ALAMAT PEMILIK</td>
			<td>:</td>
			<td>$set[13]</td>
		</tr>
		<tr>	
            <td>NAMA PENGURUS</td>
			<td>:</td>
			<td>$set[14]</td>
		</tr>
		<tr>	
            <td>ALAMAT PENGURUS</td>
			<td>:</td>
			<td>$set[15]</td>
		</tr>
		<tr>	
            <td>TANGGAL PENDIRIAN</td>
			<td>:</td>
			<td>$set[8]</td>
		</tr>
		<tr>	
            <td>NOMOR AKTE</td>
			<td>:</td>
			<td>$set[7]</td>
		</tr>
		<tr>				
            <td>STATUS PERUSAHAAN</td>
			<td>:</td>
			<td>$status</td>
		</tr>
		<tr>				
            <td>STATUS PEMILIK</td>
			<td>:</td>
			<td>$milik</td>
		</tr>
		<tr>	
            <td>STATUS PERMODALAN</td>
			<td>:</td>
			<td>$modal</td>
		</tr>
	</table>
	</fieldset>";
}
/*if(mysql_num_rows($tenagakerja)==0)
	echo "<h5>*BELUM MELAKUKAN PENGISIAN JUMLAH TENAGA KERJA</h5>";
else {
echo '
	<fieldset>
	<legend>DETAIL TENAGA KERJA</legend>
	<table class="tblisi" border="1">
		<tr>
			<td>NAMA PERUSAHAAN</td>
			<td>WNI LAKI-LAKI</td>
			<td>WNI PEREMPUAN</td>
			<td>WNA LAKI-LAKI</td>
			<td>WNA PEREMPUAN</td>
		</tr>';

	while($data=mysql_fetch_array($tenagakerja))
	{
		echo"
			<tr>
				<td>$data[0]</td>
				<td>$data[1]</td>
				<td>$data[2]</td>
				<td>$data[3]</td>
				<td>$data[4]</td>
			</tr>";	
	}
	echo "</table>
	</fieldset>";
}
*/
?>
<fieldset>
	<legend>DATA KHUSUS WAJIB LAPOR</legend>
    <form name="form1" method="post" action="../../../index.php?mod=stafsekretaris&opt=cetak&link=<?php echo"$no_resi"?>" target="_blank">    
	<table name="biodata" border="0" cellspacing="0" cellpadding="0">
    <?php echo'
					  <tr height="26px">
						<td>TANGGAL PERPINDAHAN PERUSAHAAN</td>
						<td width="20">:</td>
						<td><input name="tgl_pindah" type="date" size="40" id="date1" value="'.$result["tgl_pindah"].'"disabled>
                        	<input type="hidden" value="'.$result["id_perusahaan"].'" name="id_per">
                            <input type="hidden" value="'.$result["pemohon"].'" name="pemohon">
                            <input type="hidden" value="'.$result["alamatpemohon"].'" name="alamatpemohon">
                            </td>
					  </tr>
					  <tr height="26px">
						<td>ALAMAT LAMA</td>
						<td width="20">:</td>
						<td><input name="alamatlama" id="alamatlama" type="text" size="40" value="'.$result["alamatlama"].'"disabled onkeyup="javascript:this.value=this.value.toUpperCase()"></td>
					  </tr>
					  <tr height="26px">
						<td>JLH TENAGA KERJA LAKI-LAKI WNI</td>
						<td width="20">:</td>
						<td><input name="wnipria" id="wnipria" type="text" size="40" value="'.$result["wnipria"].'"disabled onkeypress="return isNumberKey(event)"></td>
					  </tr>
					  <tr height="26px">
						<td>JLH TENAGA KERJA WANITA WNI</td>
						<td width="20">:</td>
						<td><input name="wniwanita" id="wniwanita" type="text" size="40" value="'.$result["wniwanita"].'"disabled onkeypress="return isNumberKey(event)"></td>
					  </tr>
					  <tr height="26px">
						<td>JLH TENAGA KERJA LAKI-LAKI WNA</td>
						<td width="20">:</td>
						<td><input name="wnapria" id="wnapria" type="text" size="40" value="'.$result["wnapria"].'" disabled onkeypress="return isNumberKey(event)"></td>
					  </tr>
					  <tr height="26px">
						<td>JLH TENAGA KERJA WANITA WNA</td>
						<td width="20">:</td>
						<td><input name="wnawanita" id="wnawanita" type="text" size="40" value="'.$result["wnawanita"].'" disabled onkeypress="return isNumberKey(event)"></td>
					  </tr>
					  <tr<tr><td>&nbsp;</td></tr>
					  <tr>
						<td>PERINCIAN</td>
						<td width="20">:</td>
						<td>
							<table class="tblisi" border="1">
							<tr>
								<td>NO</td>
								<td>KEWARGANEGARAAN</td>
								<td>JENIS KELAMIN</td>
								<td>KELOMPOK UMUR</td>
								<td>HUBUNGAN KERJA</td>
								<td>JUMLAH</td>
							</tr>';
							$no=1;
							while($data=mysql_fetch_array($cz))
							{
								$nmpri=mysql_query("select kelompok from tbl_kelompok_umur where id='$data[kelompok_umur]'");
								$rnmpri = mysql_fetch_array($nmpri);
								$kel=$rnmpri["kelompok"];
								$nmpri=mysql_query("select hubungan from tbl_hubungan_kerja where id='$data[hubungan_kerja]'");
								$rnmpri = mysql_fetch_array($nmpri);
								$hub=$rnmpri["hubungan"];	
								echo'
									<tr>
										<td>'.$no.'</td>
										<td>'.$data[2].'</td>
										<td>'.$data[3].'</td>
										<td>'.$kel.'</td>
										<td>'.$hub.'</td>
										<td>'.$data[6].'</td>
									</tr>';
									$no++;	
							}
							echo '</table>															
						</td>
					  </tr> 
					  <tr><td>&nbsp;</td></tr>					                       
					  <tr>
						<td valign="top">WAKTU KERJA</td>
						<td valign="top" width="20">:</td>';
						if($result["jam1"]==1)
							{echo'<td><label><input type="checkbox" name="jam1" disabled checked value="1" >7 JAM/HARI dan 40 JAM/MINGGU</label><br/>';}
						else
							{echo'<td><label><input type="checkbox" name="jam1"  disabled value="1" >7 JAM/HARI dan 40 JAM/MINGGU</label><br/>';}
						if($result["jam2"]==1)
                        	{echo'<label><input type="checkbox" name="jam2" disabled checked value="1" >8 JAM/HARI dan 40 JAM/MINGGU</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="jam2" disabled value="1" >8 JAM/HARI dan 40 JAM/MINGGU</label><br/>';}
						if($result["jam3"]==1)					
                        	{echo'<label><input type="checkbox" name="jam3" disabled checked value="1" >12 JAM/HARI dan 40 JAM/MINGGU</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="jam3" disabled value="1" >12 JAM/HARI dan 40 JAM/MINGGU</label><br/>';}
						if($result["jam4"]==1)	
                        	{echo'<label><input type="checkbox" name="jam4" disabled checked value="1" >12 JAM/HARI SELAMA 10 HARI TERUS MENERUS</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="jam4" disabled value="1" >12 JAM/HARI SELAMA 10 HARI TERUS MENERUS</label><br/>';}
						if($result["jam5"]==1)
							{echo'<label><input type="checkbox" checked disabled name="jam5" value="1" >12 JAM/HARI SELAMA 14 HARI TERUS MENERUS</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="jam5" disabled value="1" >12 JAM/HARI SELAMA 14 HARI TERUS MENERUS</label><br/>';}
                        if($result["jam6"]==1)
							{echo'<label><input type="checkbox" name="jam6" disabled checked value="1" >LEBIH LAMA DARI 7 ATAU 8 JAM/HARI DAN 40 JAM/MINGGU KURANG DARI 12 JAM/HARI SELAMA 10 HARI TERUS MENERUS</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="jam6" disabled value="1" >LEBIH LAMA DARI 7 ATAU 8 JAM/HARI DAN 40 JAM/MINGGU KURANG DARI 12 JAM/HARI SELAMA 10 HARI TERUS MENERUS</label><br/>';}
						if($result["jam7"]==1)
                        	{echo'<label><input type="checkbox" checked disabled name="jam7" value="1" >KURANG ATAU SAMA DENGAN 15 JAM/MINGGU</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="jam7" disabled value="1" >KURANG ATAU SAMA DENGAN 15 JAM/MINGGU</label><br/>';}
						if($result["jam8"]==1)
                        	{echo'<label><input type="checkbox" checked disabled name="jam8" value="1" >KURANG ATAU SAMA DENGAN 20 JAM/MINGGU</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="jam8" disabled value="1" >KURANG ATAU SAMA DENGAN 20 JAM/MINGGU</label><br/>';}
						echo
                        '</td>
					  </tr>
					  <tr><td>&nbsp;</td></tr>
					  <tr>
						<td valign="top">PENGGUNAAN ALAT DAN BAHAN</td>
						<td valign="top" width="20">:</td>';
						if($result["alat1"]==1)
							{echo'<td><label><input type="checkbox" checked disabled name="alat1" value="1" >PESAWAT UAP</label><br/>';}
						else
							{echo'<td><label><input type="checkbox" disabled name="alat1" value="1" >PESAWAT UAP</label><br/>';}
						if($result["alat2"]==1)
							{echo'<label><input type="checkbox" checked disabled name="alat2" value="1" >PESAWAT ANGKAT</label><br/>';}
						else
							{echo'<label><input type="checkbox"  disabled name="alat2" value="1" >PESAWAT ANGKAT</label><br/>';}
						if($result["alat3"]==1)
							{echo'<label><input type="checkbox" checked disabled name="alat3" value="1" >PESAWAT ANGKUT</label><br/>';}
						else
							{echo'<label><input type="checkbox" disabled name="alat3" value="1" >PESAWAT ANGKUT</label><br/>';}
						if($result["alat4"]==1)
							{echo'<label><input type="checkbox" disabled checked name="alat4" value="1" >PESAWAT LAINNYA</label><br/>';}
						else
							{echo'<label><input type="checkbox" disabled name="alat4" value="1" >PESAWAT LAINNYA</label><br/>';}
						if($result["alat5"]==1)
							{echo'<label><input type="checkbox" disabled checked name="alat5" value="1" >ALAT-ALAT BERAT</label><br/>';}
						else
							{echo'<label><input type="checkbox" disabled name="alat5" value="1" >ALAT-ALAT BERAT</label><br/>';}
						if($result["alat6"]==1)
							{echo'<label><input type="checkbox" disabled checked name="alat6" value="1" >MOTOR</label><br/>';}
						else
							{echo'<label><input type="checkbox" disabled name="alat6" value="1" >MOTOR</label><br/>';}
						if($result["alat7"]==1)
							{echo'<label><input type="checkbox" disabled checked name="alat7" value="1" >INSTALASI LISTRIK</label><br/>';}
						else
							{echo'<label><input type="checkbox" disabled name="alat7" value="1" >INSTALASI LISTRIK</label><br/>';}
						if($result["alat8"]==1)
							{echo'<label><input type="checkbox" disabled checked name="alat8" value="1" >INSTALASI PEMADAM KEBAKARAN</label><br/>';}
						else
							{echo'<label><input type="checkbox" disabled name="alat8" value="1" >INSTALASI PEMADAM KEBAKARAN</label><br/>';}
						if($result["alat9"]==1)
							{echo'<label><input type="checkbox" disabled checked name="alat9" value="1" >PENYALUR PETIR</label><br/>';}
						else
							{echo'<label><input type="checkbox" disabled name="alat9" value="1" >PENYALUR PETIR</label><br/>';}
						if($result["alat10"]==1)
							{echo'<label><input type="checkbox" disabled checked name="alat10" value="1" >PEMBANGKIT LISTRIK</label><br/>';}
						else
							{echo'<label><input type="checkbox" disabled name="alat10" value="1" >PEMBANGKIT LISTRIK</label><br/>';}
						if($result["alat11"]==1)
							{echo'<label><input type="checkbox" disabled checked name="alat11" value="1" >LIFT</label><br/>';}
						else
							{echo'<label><input type="checkbox" disabled name="alat11" value="1" >LIFT</label><br/>';}
						if($result["alat12"]==1)
							{echo'<label><input type="checkbox" disabled checked name="alat12" value="1" >BEJANA TEKAN</label><br/>';}
						else
							{echo'<label><input type="checkbox" disabled name="alat12" value="1" >BEJANA TEKAN</label><br/>';}
						if($result["alat13"]==1)
							{echo'<label><input type="checkbox" disabled checked name="alat13" value="1" >BAHAN BERACUN DAN BERBAHAYA</label><br/>';}
						else
							{echo'<label><input type="checkbox" disabled name="alat13" value="1" >BAHAN BERACUN DAN BERBAHAYA</label><br/>';}
						if($result["alat14"]==1)
							{echo'<label><input type="checkbox" disabled checked name="alat14" value="1" >TURBIN</label><br/>';}
						else
							{echo'<label><input type="checkbox" disabled name="alat14" value="1" >TURBIN</label><br/>';}
						if($result["alat15"]==1)
							{echo'<label><input type="checkbox" disabled checked name="alat15" value="1" >BOTOL BAJA</label><br/>';}
						else
							{echo'<label><input type="checkbox" disabled name="alat15" value="1" >BOTOL BAJA</label><br/>';}
						if($result["alat16"]==1)
							{echo'<label><input type="checkbox" disabled checked name="alat16" value="1" >PERANCAH</label><br/>';}
						else
							{echo'<label><input type="checkbox" disabled name="alat16" value="1" >PERANCAH</label><br/>';}
						if($result["alat17"]==1)
							{echo'<label><input type="checkbox" disabled checked name="alat17" value="1" >BAHAN RADIO AKTIF</label><br/>';}
						else
							{echo'<label><input type="checkbox" disabled name="alat17" value="1" >BAHAN RADIO AKTIF</label><br/>';}
						echo'
                        </td>
					  </tr>
					  <tr><td>&nbsp;</td></tr>
					  <tr>
						<td valign="top">LIMBAH PRODUKSI</td>
						<td valign="top" width="20">:</td>';
						if($result["limbah1"]==1)
							{echo'<td><label><input type="checkbox" checked disabled name="limbah1" value="1" >PADAT</label><br/>';}
						else
							{echo'<td><label><input type="checkbox" disabled name="limbah1" value="1" >PADAT</label><br/>';}
						if($result["limbah2"]==1)
							{echo'<label><input type="checkbox" checked disabled name="limbah2" value="1" >CAIR</label><br/>';}
						else
							{echo'<label><input type="checkbox" disabled name="limbah2" value="1" >CAIR</label><br/>';}
						if($result["limbah3"]==1)
							{echo'<label><input type="checkbox" checked disabled name="limbah3" value="1" >GAS</label><br/>';}
						else
							{echo'<label><input type="checkbox" disabled name="limbah3" value="1" >GAS</label><br/>';}
						echo'
                        </td>
					  </tr>  
					  <tr><td>&nbsp;</td></tr>        
					  <tr height="28px">
						<td>INSTALASI PENGOLAH LIMBAH</td>
						<td width="20">:</td>
						<td><select name="olah_limbah" id="olah_limbah">';
							if($result["olah_limbah"]==0)
								{echo'<option selected value="0" disabled>TIDAK ADA</option>';}
							else
								{echo'<option value="0" disabled >TIDAK ADA</option>';}
							if($result["olah_limbah"]==1)
                            	{echo'<option selected value="1" disabled>ADA</option>';}
							else
								{echo'<option value="1" disabled>ADA</option>';}
							echo'
                            </select>
                        </td>
					  </tr>
					  <tr height="28px">
						<td>AMDAL</td>
						<td width="20">:</td>
						<td><select name="amdal" id="amdal">';
							if($result["amdal"]==0)
								{echo'<option selected value="0" disabled>TIDAK PERNAH</option>';}
							else
								{echo'<option value="0" disabled>TIDAK PERNAH</option>';}
							if($result["amdal"]==1)
                            	{echo'<option selected value="1" disabled> ADA</option>';}
							else
								{echo'<option value="1" disabled>PERNAH ADA</option>';}
							echo'					 
                            </select>
                        </td>
					  </tr>
					  <tr height="28px">
						<td>SERTIFIKAT</td>
						<td width="20">:</td>
						<td><input name="sertifikat" type="text" size="40" value="'.$result["sertifikat"].'" disabled onkeyup="javascript:this.value=this.value.toUpperCase()"></td>
					  </tr>
					  <tr height="28px">
						<td>TANGGAL SERTIFIKAT</td>
						<td width="20">:</td>
						<td><input name="tgl_sertifikat" type="date" value="'.$result["tgl_sertifikat"].'" disabled size="40" id="date2" ></td>
					  </tr>              
					  <tr height="28px">
						<td>JUMLAH UPAH SELURUH PEKERJA YANG DIBAYARKAN</td>
						<td width="20">:</td>
						<td><input name="upah" type="text" size="40" value="'.$result["jlh_upah"].'" disabled></td>
					  </tr>                      
 					  <tr height="28px">
						<td>TINGKAT UPAH TERTINGGI</td>
						<td width="20">:</td>
						<td><input name="upahtinggi" type="text" size="40" value="'.$result["upah_tinggi"].'" disabled></td>
					  </tr>                     
 					  <tr height="28px">
						<td>TINGKAT UPAH TERENDAH</td>
						<td width="20">:</td>
						<td><input name="upahrendah" type="text" size="40" value="'.$result["upah_rendah"].'" disabled></td>
					  </tr>	
 					  <tr height="28px">
						<td>JUMLAH PEKERJA PENERIMA UMK/UMR</td>
						<td width="20">:</td>
						<td><input name="upahumr" type="text" size="40" value="'.$result["jlh_umr"].'" disabled></td>
					  </tr> 
					  <tr height="28px">
						<td>TUNJANGAN HARI RAYA KEAGAMAAN</td>
						<td width="20">:</td>
						<td><select name="thr" id="thr">';
							if($result["thr"]==0)
								{echo'<option selected value="0" disabled>1 BULAN UPAH</option>';}
							else
								{echo'<option value="0" disabled>1 BULAN UPAH</option>';}
							if($result["thr"]==1)
                            	{echo'<option selected value="1" disabled>> 1 BULAN UPAH</option>';}
							else
								{echo'<option value="1" disabled>> 1 BULAN UPAH</option>';}
							echo'							
                            </select>
                        </td>
					  </tr>
					  <tr height="28px">
						<td>BONUS/GRATIFIKASI</td>
						<td width="20">:</td>
						<td><select name="bonus" id="bonus">';
							if($result["bonus"]==0)
								{echo'<option selected value="0" disabled>1 BULAN GAJI</option>';}
							else
								{echo'<option value="0" disabled>1 BULAN GAJI</option>';}
							if($result["bonus"]==1)
                            	{echo'<option selected value="1" disabled>> 1 BULAN GAJI</option>';}
							else
								{echo'<option value="1" disabled>> 1 BULAN GAJI</option>';}
							if($result["bonus"]==2)
                            	{echo'<option selected value="1" disabled>< 1 BULAN GAJI</option>';}
							else
								{echo'<option value="1" disabled>< 1 BULAN GAJI</option>';}								
							echo'							
                            </select>
                        </td>
					  </tr>	
					  <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>
					  <tr>
						<td valign="top">FASILITAS KESELAMATAN & KESEHATAN KERJA</td>
						<td valign="top" width="20">:</td>';
						if($result["sehat1"]==1)
							{echo'<td><label><input type="checkbox" checked disabled name="sehat1" value="1" >P3KP</label><br/>';}
						else
							{echo'<td><label><input type="checkbox" disabled name="sehat1" value="1" >P3K</label><br/>';}
						if($result["sehat2"]==1)
							{echo'<label><input type="checkbox" checked disabled name="sehat2" value="1" >POLIKLINIK</label><br/>';}
						else
							{echo'<label><input type="checkbox" disabled name="sehat2" value="1" >POLIKLINIK</label><br/>';}
						if($result["sehat3"]==1)
							{echo'<label><input type="checkbox" checked disabled name="sehat3" value="1" >DOKTER PEMERIKSA</label><br/>';}
						else
							{echo'<label><input type="checkbox" disabled name="sehat3" value="1" >DOKTER PEMERIKSA</label><br/>';}
						if($result["sehat4"]==1)
							{echo'<label><input type="checkbox" checked disabled name="sehat4" value="1" >AHLI / PETUGAS K3</label><br/>';}
						else
							{echo'<label><input type="checkbox" disabled name="sehat4" value="1" >AHLI / PETUGAS K3</label><br/>';}
						if($result["sehat5"]==1)
							{echo'<label><input type="checkbox" checked disabled name="sehat5" value="1" >PARAMEDIS</label><br/>';}
						else
							{echo'<label><input type="checkbox" disabled name="sehat5" value="1" >PARAMEDIS</label><br/>';}
						if($result["sehat6"]==1)
							{echo'<label><input type="checkbox" checked disabled name="sehat6" value="1" >REGU PEMADAM KEBAKARAN</label><br/>';}
						else
							{echo'<label><input type="checkbox" disabled name="sehat6" value="1" >REGU PEMADAM KEBAKARAN</label><br/>';}							
						echo'						
                        </td>
					  </tr> 
					  <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>
					  <tr>
						<td valign="top">FASILITAS KESEJAHTERAAN</td>
						<td valign="top" width="20">:</td>';
						if($result["sejahtera1"]==1)
							{echo'<td><label><input type="checkbox" checked disabled name="sejahtera1" value="1" >KOPERASI KARYAWAN</label><br/>';}
						else
							{echo'<td><label><input type="checkbox" disabled name="sejahtera1" value="1" >KOPERASI KARYAWAN</label><br/>';}
						if($result["sejahtera2"]==1)
							{echo'<label><input type="checkbox" checked disabled name="sejahtera2" value="1" >UNIT KB PERUSAHAAN</label><br/>';}
						else
							{echo'<label><input type="checkbox" disabled name="sejahtera2" value="1" >UNIT KB PERUSAHAAN</label><br/>';}
						if($result["sejahtera3"]==1)
							{echo'<label><input type="checkbox" checked disabled name="sejahtera3" value="1" >SARANA IBADAH</label><br/>';}
						else
							{echo'<label><input type="checkbox" disabled name="sejahtera3" value="1" >SARANA IBADAH</label><br/>';}
						if($result["sejahtera4"]==1)
							{echo'<label><input type="checkbox" checked disabled name="sejahtera4" value="1" >PERUMAHAN KARYAWAN</label><br/>';}
						else
							{echo'<label><input type="checkbox" disabled name="sejahtera4" value="1" >PERUMAHAN KARYAWAN</label><br/>';}
						if($result["sejahtera5"]==1)
							{echo'<label><input type="checkbox" checked disabled name="sejahtera5" value="1" >OLAHRAGA DAN KESENIAN</label><br/>';}
						else
							{echo'<label><input type="checkbox" disabled name="sejahtera5" value="1" >OLAHRAGA DAN KESENIAN</label><br/>';}
						if($result["sejahtera6"]==1)
							{echo'<label><input type="checkbox" checked disabled name="sejahtera6" value="1" >KANTIN</label><br/>';}
						else
							{echo'<label><input type="checkbox" disabled name="sejahtera6" value="1" >KANTIN</label><br/>';}		
						if($result["sejahtera7"]==1)
							{echo'<label><input type="checkbox" checked disabled name="sejahtera7" value="1" >TPA</label><br/>';}
						else
							{echo'<label><input type="checkbox" disabled name="sejahtera7" value="1" >TPA</label><br/>';}														
						echo'						
                        </td>
					  </tr>	
					  <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>
					  <tr>
						<td> <u> JAMINAN SOSIAL TENAGA KERJA</u></td>
                      </tr>                                                                                                                                      
					  <tr height="28px">
						<td>TANGGAL MENJADI PESERTA</td>
						<td width="20">:</td>
						<td><input name="tgl_jamsostek" type="date" disabled size="40" id="date7" value="'.$result["tgl_jamsostek"].'"></td>
					  </tr>
					  <tr height="28px">
						<td>NOMOR PENDAFTARAN</td>
						<td width="20">:</td>
						<td><input name="no_pendaftaran" type="text" disabled size="40" value="'.$result["no_pendaftaran"].'"></td>
					  </tr>
					  <tr height="28px">
						<td>JUMLAH PESERTA TENAGA KERJA</td>
						<td width="20">:</td>
						<td><input name="peserta_tk" type="text" disabled size="40" value="'.$result["peserta_tk"].'"></td>
					  </tr>
					  <tr height="28px">
						<td>JUMLAH PESERTA KELUARGA</td>
						<td width="20">:</td>
						<td><input name="peserta_keluarga" type="text" disabled size="40" value="'.$result["peserta_keluarga"].'"></td>
					  </tr>  
					  <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>
					  <tr >
						<td valign="top">JAMINAN</td>
						<td valign="top" width="20">:</td>';
						if($result["jaminan1"]==0)
							{echo'<td><label><input type="checkbox" name="jaminan1" disabled  value="1" >JAMINAN KECELAKAAN KERJA</label> <select name="jamin1" id="jamin1">';}
						else
							{echo'<td><label><input type="checkbox" checked name="jaminan1" disabled value="1" >JAMINAN KECELAKAAN KERJA</label> <select name="jamin1" id="jamin1">';}
							if($result["jamin1"]==0)
								{echo'<option selected value="0" disabled></option>';}
							else
								{echo'<option value="0" disabled></option>';}
							if($result["jamin1"]=='A')
								{echo'<option selected value="A" disabled>A</option>';}
							else
								{echo'<option value="A" disabled>A</option>';}
							if($result["jamin1"]=='B')
                            	{echo'<option selected value="B" disabled>B</option>';}
							else
								{echo'<option value="B" disabled>B</option>';}
							if($result["jamin1"]=='C')
                            	{echo'<option selected value="C" disabled>C</option>';}
							else
								{echo'<option value="C" disabled >C</option>';}								
							echo'							
                            </select><br/>';
						if($result["jaminan2"]==0)
							{echo'<label><input type="checkbox" name="jaminan2" value="1" disabled>JAMINAN KEMATIAN</label> <select name="jamin2" id="jamin2">';}
						else
							{echo'<label><input type="checkbox" checked name="jaminan2" disabled value="1" >JAMINAN KEMATIAN</label> <select name="jamin2" id="jamin2">';}							
							if($result["jamin1"]==0)
								{echo'<option selected value="0" disabled ></option>';}
							else
								{echo'<option value="0" disabled></option>';}							
							if($result["jamin2"]=='A')
								{echo'<option selected value="A" disabled>A</option>';}
							else
								{echo'<option value="A" disabled>A</option>';}
							if($result["jamin2"]=='B')
                            	{echo'<option selected value="B" disabled>B</option>';}
							else
								{echo'<option value="B" disabled>B</option>';}
							if($result["jamin2"]=='C')
                            	{echo'<option selected value="C" disabled>C</option>';}
							else
								{echo'<option value="C" disabled>C</option>';}								
							echo'	                        
                            </select><br/>';
						if($result["jaminan3"]==0)
							{echo'<label><input type="checkbox" disabled name="jaminan3" value="1" >JAMINAN HARI TUA</label> <select name="jamin3" id="jamin3">';}
						else
							{echo'<label><input type="checkbox" disabled checked name="jaminan3" value="1" >JAMINAN HARI TUA</label> <select name="jamin3" id="jamin3">';}							
							if($result["jamin1"]==0)
								{echo'<option selected disabled value="0"></option>';}
							else
								{echo'<option value="0" disabled></option>';}							
							if($result["jamin3"]=='A')
								{echo'<option selected vdisabled alue="A">A</option>';}
							else
								{echo'<option value="0" disabled>A</option>';}
							if($result["jamin3"]=='B')
                            	{echo'<option selected value="B" disabled>B</option>';}
							else
								{echo'<option value="B"disabled >B</option>';}
							if($result["jamin3"]=='C')
                            	{echo'<option selected value="C disabled">C</option>';}
							else
								{echo'<option value="C" disabled>C</option>';}								
							echo'	                        
                            </select><br/>';
						if($result["jaminan4"]==0)
							{echo'<label><input type="checkbox" name="jaminan4" disabled value="1" >JAMINAN PEMELIHARAAN KESEHATAN</label> <select name="jamin4" id="jamin4">';}
						else
							{echo'<label><input type="checkbox" checked name="jaminan4" disabled value="1" >JAMINAN PEMELIHARAAN KESEHATAN</label> <select name="jamin4" id="jamin4">';}								
							if($result["jamin1"]==0)
								{echo'<option selected value="0" disabled></option>';}
							else
								{echo'<option value="0" disabled></option>';}							
							if($result["jamin4"]=='A')
								{echo'<option selected value="A" disabled>A</option>';}
							else
								{echo'<option value="A" disabled>A</option>';}
							if($result["jamin4"]=='B')
                            	{echo'<option selected value="B" disabled>B</option>';}
							else
								{echo'<option value="B" disabled>B</option>';}
							if($result["jamin4"]=='C')
                            	{echo'<option selected value="C" disabled>C</option>';}
							else
								{echo'<option value="C" disabled>C</option>';}								
							echo'                        
                            </select><br/>
                        </td>
					  </tr> 
					  <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>
					  <tr>
						<td valign="top">PROGRAM PENSIUN</td>
						<td valign="top" width="20">:</td>';
						if($result["pensiun1"]==0)
							{echo'<td><label><input type="checkbox" name="pensiun1" disabled value="1" >DILAKSANAKAN OLEH DANA PENSIUN PEMBERI KERJA</label><br/>';}
						else
							{echo'<td><label><input type="checkbox" checked name="pensiun1" disabled value="1" >DILAKSANAKAN OLEH DANA PENSIUN PEMBERI KERJA</label><br/>';}
						if($result["pensiun2"]==0)
							{echo'<label><input type="checkbox" name="pensiun2" value="1" disabled >DILAKSANAKAN OLEH DANA PENSIUN LEMBAGA KEUANGAN</label><br/>';}
						else
							{echo'<label><input type="checkbox" checked name="pensiun2" value="1" disabled >DILAKSANAKAN OLEH DANA PENSIUN LEMBAGA KEUANGAN</label><br/>';}
						echo'
                        </td>
					  </tr> 
					  <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>  
					  <tr>
						<td valign="top">PERANGKAT HUBUNGAN KERJA</td>
						<td valign="top" width="20">:</td>';
						if($result["hub1"]==0)
							{echo'<td><label><input type="checkbox" disabled name="hub1" value="1" >PK (PERJANJIAN KERJA)</label><br/>';}
						else
							{echo'<td><label><input type="checkbox" disabled checked name="hub1" value="1" >PK (PERJANJIAN KERJA)</label><br/>';}
						if($result["hub2"]==0)
							{echo'<label><input type="checkbox" disabled name="hub2" value="1" >PP (PERATURAN PERUSAHAAN)</label><br/>';}
						else
							{echo'<label><input type="checkbox" disabled name="hub2" value="1" >PP (PERATURAN PERUSAHAAN)</label><br/>';}
						if($result["hub3"]==0)
							{echo'<label><input type="checkbox" disabled name="hub3" value="1" >KKB (KESEPAKATAN KERJA BERSAMA)</label><br/>';}
						else
							{echo'<label><input type="checkbox" disabled checked name="hub3" value="1" >KKB (KESEPAKATAN KERJA BERSAMA)</label><br/>';}																			
                        echo'
                        </td>
					  </tr>	
					  <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>
					  <tr>
						<td valign="top">PERANGKAT ORGANISASI KETENAGAKERJAAN</td>
						<td valign="top" width="20">:</td>';
						if($result["org1"]==0)
							{echo'<td><label><input type="checkbox" disabled name="org1" value="1" >SPTP (SERIKAT PEKERJA TINGKAT PERUSAHAAN)</label><br/>';}
						else
							{echo'<td><label><input type="checkbox" disabled checked name="org1" value="1" >SPTP (SERIKAT PEKERJA TINGKAT PERUSAHAAN)</label><br/>';}
						if($result["org2"]==0)
							{echo'<label><input type="checkbox" disabled name="org2" value="1" >UK SPSI (UNIT KERJA SERIKAT PEKERJA SELURUH INDONESIA)</label><br/>';}
						else
							{echo'<label><input type="checkbox" disabled checked name="org2" value="1" >UK SPSI (UNIT KERJA SERIKAT PEKERJA SELURUH INDONESIA)</label><br/>';}
						if($result["org3"]==0)
							{echo'<label><input type="checkbox" disabled name="org3" value="1" >P2K3</label><br/>';}
						else
							{echo'<label><input type="checkbox" disabled checked name="org3" value="1" >P2K3</label><br/>';}	
						if($result["org4"]==0)
							{echo'<label><input type="checkbox" disabled name="org4" value="1" >Apindo (ASOSIASI PERUSAHAAN INDONESIA)</label><br/>';}
						else
							{echo'<label><input type="checkbox" disabled checked name="org4" value="1" >Apindo (ASOSIASI PERUSAHAAN INDONESIA)</label><br/>';}																			
                        echo'
                        </td>
					  </tr>
					   <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>
					  <tr><td colspan="3"> <u> RENCANA PEKERJA YANG DIBUTUHKAN DALAM 12 BULAN YANG AKAN DATANG</u> </td></tr>
					  <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>                                                                                                   
					  <tr>
						<td height="28px">JUMLAH</td>
						<td width="20">:</td>
						<td><input name="jlh_tk_nanti" type="text" disabled size="40" value="'.$result["jlh_tk_nanti"].'"></td>
					  </tr>
					  <tr height="28px">
						<td>LAKI-LAKI</td>
						<td width="20">:</td>
						<td><input name="jlh_tk_nanti_p" type="text" disabled size="40" value="'.$result["jlh_tk_nanti_p"].'"></td>
					  </tr>
					  <tr height="28px">
						<td>PEREMPUAN</td>
						<td width="20">:</td>
						<td><input name="jlh_tk_nanti_w" type="text" disabled size="40" value="'.$result["jlh_tk_nanti_w"].'"></td>
					  </tr> 
					  <tr >
						<td>PERINCIAN</td>
						<td width="20">:</td>
						<td>
							<table class="tblisi" border="1">
							<tr>
								<td>NO</td>
								<td>JABATAN</td>
								<td>KODE</td>
								<td>PENDIDIKAN</td>
								<td>KEWARGANEGARAAN</td>
								<td>HUBUNGAN KERJA</td>
								<td>JUMLAH</td>
							</tr>';
							$no=1;
							while($data=mysql_fetch_array($cz1))
							{
								$nmpri=mysql_query("select pendidikan from tbl_pendidikan where id='$data[id_pendidikan]'");
								$rnmpri = mysql_fetch_array($nmpri);
								$pend=$rnmpri["pendidikan"];
								echo'
									<tr>
										<td>'.$no.'</td>
										<td>'.$data[jabatan].'</td>
										<td>'.$data[kode].'</td>
										<td>'.$pend.'</td>
										<td>'.$data[kewarganegaraan].'</td>
										<td>'.$data[hubungan].'</td>
										<td>'.$data[jumlah].'</td>
									</tr>';
									$no++;	
							}
							echo '</table>	<br/>	<br/>					
						</td>
					  </tr>
					  <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>
					  <tr><td colspan="3"> <u>PEKERJA 12 BULAN TERAKHIR</u> </td></tr>
					  <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>     
					  <tr height="28px">
						<td>JUMLAH</td>
						<td width="20">:</td>
						<td><input name="jlh_tk_skrg" type="text" disabled size="40" value="'.$result["jlh_tk_skrg"].'"></td>
					  </tr>
					  <tr height="28px">
						<td>LAKI-LAKI</td>
						<td width="20">:</td>
						<td><input name="jlh_tk_skrg_p" type="text" disabled size="40" value="'.$result["jlh_tk_skrg_p"].'"></td>
					  </tr>
					  <tr height="28px">
						<td>PEREMPUAN</td>
						<td width="20">:</td>
						<td><input name="jlh_tk_skrg_w" type="text" disabled size="40" value="'.$result["jlh_tk_nanti_w"].'"></td>
					  </tr> 
					  <tr height="28px">
						<td>PERINCIAN</td>
						<td width="20">:</td>
						<td>
							<table class="tblisi" border="1">
							<tr>
								<td>NO</td>
								<td>GOL. POKOK JABATAN</td>
								<td>PENDIDIKAN</td>
								<td>KEWARGANEGARAAN</td>
								<td>HUBUNGAN KERJA</td>
								<td>JUMLAH</td>
							</tr>';
							$no=1;
							while($data=mysql_fetch_array($cz2))
							{
								$nmpri=mysql_query("select pendidikan from tbl_pendidikan where id='$data[id_pendidikan]'");
								$rnmpri = mysql_fetch_array($nmpri);
								$pend=$rnmpri["pendidikan"];
								echo'
									<tr>
										<td>'.$no.'</td>
										<td>'.$data[golongan].'</td>
										<td>'.$pend.'</td>
										<td>'.$data[kewarganegaraan].'</td>
										<td>'.$data[hubungan].'</td>
										<td>'.$data[jumlah].'</td>
									</tr>';
									$no++;	
							}
							echo '</table>							
						</td>
					  </tr>
					  <tr height="28px">
						<td>JUMLAH PENERIMAAN PEKERJA SELAMA 12 BULAN TERAKHIR</td>
						<td width="20">:</td>
						<td><input name="jlh_terima" type="text" disabled size="40" value="'.$result["jlh_terima"].'"></td>
					  </tr> 
					  <tr height="28px">
						<td>JUMLAH PEKERJA YANG BERHENTI SELAMA 12 BULAN TERAKHIR</td>
						<td width="20">:</td>
						<td><input name="jlh_berhenti" type="text" disabled size="40" value="'.$result["jlh_berhenti"].'"></td>
					  </tr>
					  <tr height="28px">
						<td>PROGRAM PELATIHAN BAGI PEKERJA</td>
						<td width="20">:</td>
						<td><select name="pelatihan" id="pelatihan">';
							if($result["pelatihan"]==0)
								{echo'<option selected value="0" disabled>TIDAK ADA</option>';}
							else
								{echo'<option value="0" disabled>TIDAK ADA</option>';}
							if($result["pelatihan"]==1)
                            	{echo'<option selected value="1" disabled>ADA</option>';}
							else
								{echo'<option value="1" disabled>ADA</option>';}
							echo'						
                            </select>
                        </td>
					  </tr>  
					  <tr height="28px">
						<td>PROGRAM PEMAGANGAN</td>
						<td width="20">:</td>
						<td><select name="pemagangan" id="pemagangan">';
							if($result["pemagangan"]==0)
								{echo'<option selected value="0" disabled>TIDAK ADA</option>';}
							else
								{echo'<option value="0" disabled>TIDAK ADA</option>';}
							if($result["pemagangan"]==1)
                            	{echo'<option selected value="1" disabled>ADA</option>';}
							else
								{echo'<option value="1" disabled>ADA</option>';}
							echo'							
                            </select>
                        </td>
					  </tr> 
					  <tr height="28px">
						<td>FASILITAS PELATIHAN</td>
						<td width="20">:</td>
						<td><select name="fasilitas" id="fasilitas">';
							if($result["fasilitas"]==0)
								{echo'<option selected value="0" disabled>TIDAK ADA</option>';}
							else
								{echo'<option value="0" disabled>TIDAK ADA</option>';}
							if($result["fasilitas"]==1)
                            	{echo'<option selected value="1" disabled>ADA</option>';}
							else
								{echo'<option value="1" disabled>ADA</option>';}
							echo'	
                            </select>
                        </td>
					  </tr>
					  <tr height="28px">
						<td>PROGRAM PENGINDONESIAAN</td>
						<td width="20">:</td>
						<td><select name="pengindonesiaan" id="pengindonesiaan">';
							if($result["pengindonesiaan"]==0)
								{echo'<option selected value="0" disabled>TIDAK ADA</option>';}
							else
								{echo'<option value="0" disabled>TIDAK ADA</option>';}
							if($result["pengindonesiaan"]==1)
                            	{echo'<option selected value="1" disabled>ADA</option>';}
							else
								{echo'<option value="1" disabled>ADA</option>';}
							echo'
                            </select>
                        </td>
					  <tr >
						<td>PERENCANAAN KEBUTUHAN LATIHAN BAGI PEKERJA</td>
						<td width="20">:</td>
						<td>
							<table class="tblisi" border="1">
							<tr>
								<td>NO</td>
								<td>KEJURUAN</td>
								<td>KODE</td>
								<td>JUMLAH</td>
							</tr>';
							$no=1;
							while($data=mysql_fetch_array($cz3))
							{
								$nmpri=mysql_query("select pendidikan from tbl_pendidikan where id='$data[id_pendidikan]'");
								$rnmpri = mysql_fetch_array($nmpri);
								$pend=$rnmpri["pendidikan"];
								echo'
									<tr>
										<td>'.$no.'</td>
										<td>'.$data[kejuruan].'</td>
										<td>'.$data[kode].'</td>
										<td>'.$data[jumlah].'</td>
									</tr>';
									$no++;	
							}
							echo '</table><br/><br/>
						</td>
					  </tr>';	
					  
					$qpath = mysql_query("select file from tbl_hasil_lap where no_resi='".$no_resi."'");
					$respath = mysql_fetch_array($qpath);
					$path=$respath["file"];				  					  				  				  				  					  							
	?>
	</table>
</fieldset>
<fieldset>
	<legend>CHECKLIST PERSYARATAN DAN KELENGKAPAN BERKAS</legend>
	 <p>
				<label>
				  <input type="checkbox" name="berkas" value="1" id="berkas_0">
				  BERKAS SK DAN LAPORAN SUDAH DIPERIKSA
					<?php if($path<>'')
                    {
                        echo "<a class=menu href=../../../libraries/fdownload.php?jenis=laporan&path=$path target=_blank>(LAPORAN)</a>";
                    }
                    ?>
                   	<a class="menu" href="../../penomoran/cetak_sk_wl.php?link=<?php echo $no_resi;?>" target="_blank">(SK)</a></label>
				<br>
                <label>
				  <input type="checkbox" name="berkas" value="1" id="berkas_1">
				  BERKAS SK DAN LAPORAN SUDAH DIPARAF</label>
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