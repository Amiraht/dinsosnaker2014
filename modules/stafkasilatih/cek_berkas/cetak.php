<?php
	while (ob_get_level())
	ob_end_clean();
	
	require_once('./libraries/tcpdf/tcpdf.php');
	include('./libraries/dinsos.php');
	
	$ab = $_GET["link"];
	$userid=$_GET["uid"];
	$data=explode("-",$ab);
	$jenis_urus = $data[0];	
	
		 

	header("Content-Encoding: None", true);
	// Include the main TCPDF library (search for installation path).


	//arequire_once('tcpdf/tcpdf.php');

	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LEGAL', true, 'UTF-8', false);
	
	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('DINSOSNAKER MEDAN');
	$pdf->SetTitle('SK IPLK');
	$pdf->SetSubject('SK IPLK');
	$pdf->SetKeywords('DINSOSNAKER, MEDAN, SK IPLK, PRINT, SURAT');
	
	$pdf->setPrintHeader(false);
	
	// set font
	//$pdf->SetFont('Arial', '', 10);

	// add a page
	$pdf->AddPage();

	// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
	// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

	// create some HTML content
	
	$nmpri=mysql_query("SELECT * FROM tbl_sk_iplk  WHERE no_resi='".$ab."'");
	$rnmpri = mysql_fetch_array($nmpri);
	$tanggal=$rnmpri["tanggal"];
	$no_daftar=$rnmpri["no_daftar"];
	$berlaku=$rnmpri["berlaku"];
	$sampai=$rnmpri["sampai"];

	
	$nmpri=mysql_query("SELECT * FROM vw_info_berkas  WHERE no_resi='".$ab."'");
	$rnmpri = mysql_fetch_array($nmpri);
	$nama=$rnmpri["nama"];
	$alamat=$rnmpri["alamat"];
	$pemohon=$rnmpri["pemohon"];
	$id_p=$rnmpri["id_perusahaan"];

	$nmpri=mysql_query("SELECT * FROM tbl_iplk_program  WHERE id_perusahaan='".$id_p."'");
	while($rnmpri = mysql_fetch_array($nmpri))
	{
		$program=$program.''.$rnmpri["nama"].'<br/>';
	
	}

	//$gol=$rnmpri["gol"];


	$head="KEPUTUSAN<br/>
		   KEPALA DINAS SOSIAL DAN TENAGA KERJA<br />
		   KOTA MEDAN";
	$head1="TENTANG<br/><br/>
		   IZIN PENYELENGGARAAN PELATIHAN KERJA<br />";		   
	$head2="MEMUTUSKAN";


	$sql = "SELECT nama,jabatan,nip FROM user  WHERE level='17'";
	$res = mysql_query($sql);
	$ds = mysql_fetch_array($res);
	
	$kadis=$ds["nama"];
	$kadisjab=$ds["jabatan"];
	$kadisnip=$ds["nip"];

	$atas = '<table border="0" width="100%" align="center">
			<tr>
				<td width="15%" valign="top" align="center"><img src="./image/logo1.png"></td>
				<td width="85%" align="center">
				<font size="+3">PEMERINTAH KOTA MEDAN</font><br>
				<font size="+4">DINAS SOSIAL DAN TENAGA KERJA</font><br>
				<font size="+2">Jln. K.H. Wahid Hasyim No. 14 Telp. 4514424 fax. 4511428</font><br>
				<font size="+1">MEDAN - 20154</font><br>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">________________________________________________________________________________</td>
			</tr>
			
			<tr>
				<td colspan="2" align="center"><font size="+1"><b><br/>'.$head.'</b></font></td>
			</tr>
			<tr>
				<td colspan="2" align="center">_________________________________________________</td>
			</tr>			
			<tr>
				<td colspan="2" align="center">Nomor : '.$no_surat.'</td>
			</tr>
			<tr>
				<td colspan="2" align="center"><font size="+1"><b><br/>'.$head1.'</b></font></td>
			</tr>			
			</table>
			<br/><br/>
			<table border="0" align="center">
			<tr>
				<td width="80" align="left"><font size="-2">Menimbang</font></td>
				<td width="5">:</td>
				<td width="20" align="left"><font size="-2">a. </font></td>
				<td width="400" align="left"><font size="-2">Bahwa dalam rangka meningkatkan kualitas tenaga kerja perlu adanya suatu lembaga sebagai penyelenggara latihan kerja.</font></td>
			 </tr>	 		
			<tr>
				<td width="80" align="left"><font size="-2"><b></b></font></td>
				<td width="5"></td>
				<td width="20" align="left"><font size="-2">b. </font></td>
				<td width="400" align="left"><font size="-2">Bahwa lembaga sebagai penyelenggara pelatihan yang memenuhi persyaratan yang telah ditetapkan perlu diberi izin penyelenggaraan latihan kerja.</font></td>
			 </tr>	
			<tr>
				<td width="80" align="left"><font size="-2"><b></b></font></td>
				<td width="5"></td>
				<td width="20" align="left"><font size="-2">c. </font></td>
				<td width="400" align="left"><font size="-2">Bahwa untuk itu izin penyelenggaraan pelatihan kerja dimaksud perlu ditetapkan dengan Keputusan Kepala Dinas Sosial dan Tenaga Kerja Kota Medan.</font></td>
			 </tr>	
			<tr>
				<td width="80" align="left"><font size="-2">Mengingat</font></td>
				<td width="5">:</td>
				<td width="20" align="left"><font size="-2">1. </font></td>
				<td width="400" align="left"><font size="-2">Undang-undang Nomor 13 Tahun 2003 tentang Ketenaga Kerjaan.</font></td>
			 </tr>		
			<tr>
				<td width="80" align="left"><font size="-2"><b></b></font></td>
				<td width="5"></td>
				<td width="20" align="left"><font size="-2">2. </font></td>
				<td width="400" align="left"><font size="-2">Peraturan Menteri Tenaga Kerja dan Transmigrasi Republik Indonesia Nomor : PER-17/MEN/VI/2007 tentang Tata Cara Perizinan dan Pendaftaran Lembaga Pelatihan Kerja.</font></td>
			 </tr>	
			<tr>
				<td width="80" align="left"><font size="-2">Memperhatikan</font></td>
				<td width="5">:</td>
				<td width="20" align="left"><font size="-2"></font></td>
				<td width="400" align="left"><font size="-2">Surat permohonan izin penyelenggaraan pelatihan kerja : '.$nama.' Nomor : '.$no_daftar.' Tanggal : '.$tanggal.' perihal permohonan izin penyelenggaraan pelatihan kerja.</font></td>
			 </tr>	
			<tr>
				<td colspan="4" align="center"><font size="-1">MEMUTUSKAN</font></td>
			 </tr>	
			<tr>
				<td width="80" align="left"><font size="-2">PERTAMA</font></td>
				<td width="5">:</td>
				<td width="20" align="left"><font size="-2"></font></td>
				<td width="400" align="left"><font size="-2">Memberi izin penyelenggaraan pelatihan kerja kepada :</font></td>
			 </tr>		
			<tr>
				<td width="80" align="left"><font size="-2"></font></td>
				<td width="5"></td>
				<td width="20" align="left"><font size="-2"></font></td>
				<td width="400" align="left"><font size="-2">a. Nama Lembaga : '.$nama.'</font></td>
			 </tr>	
			<tr>
				<td width="80" align="left"><font size="-2"></font></td>
				<td width="5"></td>
				<td width="20" align="left"><font size="-2"></font></td>
				<td width="400" align="left"><font size="-2">b. Alamat : '.$alamat.'</font></td>
			 </tr>	
			<tr>
				<td width="80" align="left"><font size="-2"></font></td>
				<td width="5"></td>
				<td width="20" align="left"><font size="-2"></font></td>
				<td width="400" align="left"><font size="-2">c. Penanggung Jawab : '.$pemohon.'</font></td>
			 </tr>	
			<tr>
				<td width="80" align="left"><font size="-2"></font></td>
				<td width="5"></td>
				<td width="20" align="left"><font size="-2"></font></td>
				<td width="400" align="left"><font size="-2">d. Jenis Program Pelatihan : '.$program.'</font></td>
			 </tr>	
			<tr>
				<td width="80" align="left"><font size="-2">KEDUA</font></td>
				<td width="5">:</td>
				<td width="20" align="left"><font size="-2"></font></td>
				<td width="400" align="left"><font size="-2">'.$nama.' dapat menerbitkan sertifikat pelatihan untuk jenis program yang diselenggarakan pada amar PERTAMA.</font></td>
			 </tr>	
			<tr>
				<td width="80" align="left"><font size="-2">KETIGA</font></td>
				<td width="5">:</td>
				<td width="20" align="left"><font size="-2"></font></td>
				<td width="400" align="left"><font size="-2">'.$nama.' bertanggung jawab dan menyampaikan laporan kegiatan secara periodik kepada Dinas Sosial dan Tenaga Kerja Kota Medan dengan tembusan kepada instansi yang terkait.</font></td>
			 </tr>	
			<tr>
				<td width="80" align="left"><font size="-2">KEEMPAT</font></td>
				<td width="5">:</td>
				<td width="20" align="left"><font size="-2"></font></td>
				<td width="400" align="left"><font size="-2">Pengendalian penyelenggaraan pelatihan kerja ini dilakukan oleh Dinas Sosial dan Tenaga Kerja Kota Medan.</font></td>
			 </tr>	
			<tr>
				<td width="80" align="left"><font size="-2">KELIMA</font></td>
				<td width="5">:</td>
				<td width="20" align="left"><font size="-2"></font></td>
				<td width="400" align="left"><font size="-2">Pemberian izin penyelenggaraan pelatihan kerja ini dapat dicabut apabila penerima izin menyalahgunakan, melanggar atau tidak menaati terhadap ketentuan peraturan yang berlaku.</font></td>
			 </tr>	
			<tr>
				<td width="80" align="left"><font size="-2">KEENAM</font></td>
				<td width="5">:</td>
				<td width="20" align="left"><font size="-2"></font></td>
				<td width="400" align="left"><font size="-2">Keputusan ini berlaku sejak tanggal ditetapkan dengan ketentuan apabila di kemudian hari terdapat kekeliruan dalam penetapan ini akan diperbaiki sebagaimana mestinya.</font></td>
			 </tr>				 			 			 		 			 			 			 			 			 	 			 		 			 		 		  			 	 			
			</table>
			';		
	$bawah= '
			<table border="0" width="100%" align="center">
			<tr>
				<td width="15%" align="left"></td>
				<td width="40%" align="left"></td>
				<td width="40%" align="left"><font size="-2">Ditetapkan di : Medan </font></td>
			</tr>			
			<tr>
				<td width="15%" align="left"></td>
				<td width="40%" align="left"></td>
				<td width="40%" align="left"><font size="-2">Pada tanggal : </font></td>
			</tr>	
			<tr>
				<td width="15%" align="left"></td>
				<td width="30%" align="left"></td>
				<td width="50%" align="center"><font size="-2"><b>KEPALA DINAS SOSIAL DAN TENAGA KERJA<br/>
				KOTA MEDAN</font></b></td>
			</tr>
			<tr>
				<td width="15%" align="left"></td>
				<td width="30%" align="left"></td>
				<td width="50%" align="center"><font size="-4"><br><br></font></td>
			</tr>
			<tr>
				<td width="15%" align="left"></td>
				<td width="30%" align="left"></td>
				<td width="50%" align="center"><font size="-4">'.$kadis.'</font></td>
			</tr>
			<tr>
				<td width="15%" align="left"></td>
				<td width="30%" align="left"></td>
				<td width="50%" align="center"><font size="-4">'.$kadisjab.'</font></td>
			</tr>
			<tr>
				<td width="15%" align="left"></td>
				<td width="30%" align="left"></td>
				<td width="50%" align="center"><font size="-4">NIP. '.$kadisnip.'</font></td>
			</tr>
			</table>';
	$html=$atas.$bawah;
	//.$bawah;
	
	// output the HTML content
	$tes='<b>hai</b>';
	$pdf->writeHTML($html, true, false, true, false, '');
	
	// reset pointer to the last page
	$pdf->lastPage();

	// ---------------------------------------------------------

	//Close and output PDF document
	$pdf->Output('wl.pdf', 'I');
	
	
?>