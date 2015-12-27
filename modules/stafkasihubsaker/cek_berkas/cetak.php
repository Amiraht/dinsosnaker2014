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
	$pdf->SetTitle('SK');
	$pdf->SetSubject('SK');
	$pdf->SetKeywords('DINSOSNAKER, MEDAN, SK, PRINT, SURAT');
	
	$pdf->setPrintHeader(false);
	
	// set font
	//$pdf->SetFont('Arial', '', 10);

	// add a page
	$pdf->AddPage();

	// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
	// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

	// create some HTML content
	
	$nmpri=mysql_query("SELECT * FROM tbl_sk_janji  WHERE no_resi='".$ab."'");
	$rnmpri = mysql_fetch_array($nmpri);
	$tanggal=$rnmpri["tanggal"];
	$no_daftar=$rnmpri["no_daftar"];
	$berlaku=$rnmpri["berlaku"];
	$sampai=$rnmpri["sampai"];

	
	$nmpri=mysql_query("SELECT * FROM vw_info_berkas  WHERE no_resi='".$ab."'");
	$rnmpri = mysql_fetch_array($nmpri);
	$nama=$rnmpri["nama"];
	$alamat=$rnmpri["alamat"];
	$id_jenis=$rnmpri["jenis_usaha"];
	$id_perusahaan=$rnmpri["id_perusahaan"];
	
	if(is_null($id_jenis))
	{
	
	}
	else
	{ 
		$nmpri=mysql_query("SELECT * FROM t_jenis_usaha  WHERE id_jenis_usaha='".$id_jenis."'");
		$rnmpri = mysql_fetch_array($nmpri);
		$jenis=$rnmpri["jenis"];
	}
	
	if(is_null($id_perusahaan))
	{
	
	}
	else
	{ 	
	$nmpri=mysql_query("SELECT * FROM tbl_serikat  WHERE id_perusahaan='".$id_perusahaan."'");
	$rnmpri = mysql_fetch_array($nmpri);
	$nama_serikat=$rnmpri["nama"];
	$alamat_serikat=$rnmpri["alamat"];	
	}

	//$gol=$rnmpri["gol"];

	if($jenis_urus=='04')
	{
		$head="PENDAFTARAN PERJANJIAN KERJA BERSAMA";
		$head1="Mendaftarkan Perjanjian Kerja Bersama antara :";
		$penutup="Apabila dalam Perjanjian Kerja Bersama ini terdapat kekeliruan, maka akan diperbaiki sebagaimana mestinya.";
	}
	else
	{
	
		$head="PENGESAHAN PERATURAN PERUSAHAAN";
		$head1="Mensyahkan Peraturan Perusahaan dari :";
		$penutup="Apabila dalam Peraturan Perusahaan ini terdapat kekeliruan, maka akan diperbaiki sebagaimana mestinya.";
	}


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
				<td colspan="2" align="center"><font size="+1"><b><u><br/><br/>'.$head.'</u></b></font></td>
			</tr>
			<tr>
				<td colspan="2" align="center">Nomor : '.$no_surat.'</td>
			</tr>
			</table>
			<br/><br/>
			<table border="0" align="center">
			<tr>
				<td width="80" align="left"><font size="-1"><b>Dasar :</b></font></td>
				<td width="20" align="left"><font size="-1">1. </font></td>
				<td width="400" align="left"><font size="-1">Undang-Undang No. 13 Tahun 2003, tentang Ketenagakerjaan.</font></td>
			 </tr>
			 <tr>
				<td width="80" align="left"></td>
				<td width="20" align="left"><font size="-1">2. </font></td>
				<td width="400" align="left"><font size="-1">Peraturan Menteri Tenaga Kerja dan Transmigrasi R.I No. PER.16/MEN/XI/2011 tentang Tata Cara Pembuatan dan Pengesahan Peraturan Perusahaan serta Pembuatan dan Pendaftaran Perjanjian Kerja Bersama.</font></td>
			 </tr>
			 <tr>
				<td width="80" align="left"></td>
				<td width="20" align="left"><font size="-1">3. </font></td>
				<td width="400" align="left"><font size="-1">Keputusan Walikota Medan No. 59 Tahun 2001 tentang Tugas Pokok dan Fungsi Dinas Tenaga Kerja Kota Medan.<br/><br/></font></td>
			 </tr>		 			 			 
			 <tr>
				<td width="80" align="left"><font size="-1"><b>Menetapkan :</b></font><br/></td>
				<td colspan="2" width="420" align="left"><font size="-1">'.$head1.'</font></td>				
			</tr>
			</table>
			';	
	
	$tengah1= '<table border="0" align="center">
			<tr>
				<td width="80" align="left"><font size="-1"></font></td>
				<td width="180" align="left"><font size="-1">Nama Perusahaan :</font></td>
				<td width="200" align="left"><font size="-1">'.$nama.'</font></td>
			 </tr>
			 <tr>
				<td width="80" align="left"><font size="-1"></font></td>
				<td width="180" align="left"><font size="-1">Alamat Perusahaan :</font></td>
				<td width="200" align="left"><font size="-1">'.$alamat.'</font></td>
			 </tr>
			 <tr>
				<td width="80" align="left"><font size="-1"></font></td>
				<td width="180" align="left"><font size="-1">Jenis Usaha :</font></td>
				<td width="200" align="left"><font size="-1">'.$jenis.'</font></td>
			 </tr>			 
			 <tr>
				<td width="80" align="left"><font size="-1"></font></td>
				<td width="180" align="left"><font size="-1">Nomor Pendaftaran :</font></td>
				<td width="200" align="left"><font size="-1">'.$no_daftar.'</font></td>
			 </tr>
			 <tr>
				<td width="80" align="left"><font size="-1"></font></td>
				<td width="180" align="left"><font size="-1">Masa Berlaku :</font></td>
				<td width="200" align="left"><font size="-1">'.$berlaku.' s/d '.$sampai.'</font></td>
			 </tr>
			 <tr>
			 	<td width="80" align="left"><font size="-1"></font></td>
				<td colspan="2" align="left"><font size="-1">'.$penutup.'</font></td>
			 </tr>			 	 			 

			 ';
	$tengah2= '<table border="0" align="center">
			<tr>
				<td width="80" align="left"><font size="-1"></font></td>
				<td width="180" align="left"><font size="-1">Nama Perusahaan :</font></td>
				<td width="200" align="left"><font size="-1">'.$nama.'</font></td>
			 </tr>
			 <tr>
				<td width="80" align="left"><font size="-1"></font></td>
				<td width="180" align="left"><font size="-1">Alamat Perusahaan :</font></td>
				<td width="200" align="left"><font size="-1">'.$alamat.'</font></td>
			 </tr>
			 <tr>
				<td width="80" align="left"><font size="-1"></font></td>
				<td width="180" align="left"><font size="-1">Jenis Usaha :</font></td>
				<td width="200" align="left"><font size="-1">'.$jenis.'</font></td>
			 </tr>	
			 <tr>
				<td width="80" align="left"><font size="-1"></font></td>
				<td width="180" align="left"><font size="-1"></font></td>
				<td width="200" align="left"><font size="-1">Dengan</font></td>
			 </tr>
			 <tr>
				<td width="80" align="left"><font size="-1"></font></td>
				<td width="180" align="left"><font size="-1">Serikat Pekerja / Serikat Buruh :</font></td>
				<td width="200" align="left"><font size="-1">'.$nama_serikat.'</font></td>
			 </tr>
			 <tr>
				<td width="80" align="left"><font size="-1"></font></td>
				<td width="180" align="left"><font size="-1">Alamat :</font></td>
				<td width="200" align="left"><font size="-1">'.$alamat_serikat.'</font></td>
			 </tr>			 			 			 		 
			 <tr>
				<td width="80" align="left"><font size="-1"></font></td>
				<td width="180" align="left"><font size="-1">Nomor Pendaftaran :</font></td>
				<td width="200" align="left"><font size="-1">'.$no_daftar.'</font></td>
			 </tr>
			 <tr>
				<td width="80" align="left"><font size="-1"></font></td>
				<td width="180" align="left"><font size="-1">Masa Berlaku :</font></td>
				<td width="200" align="left"><font size="-1">'.$berlaku.' s/d '.$sampai.'</font></td>
			 </tr>			 			 
			 <tr>
			 	<td width="80" align="left"><font size="-1"></font></td>
				<td colspan="2" align="left"><font size="-1">'.$penutup.'</font></td>
			 </tr>			 	 			 
			 ';			 

			
	$bawah= '
			<table border="0" width="100%" align="center">
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

	if($jenis_urus=='04')
	{			
		$html=$atas.$tengah2.$bawah;
	}
	else
		$html=$atas.$tengah1.$bawah;
	
	// output the HTML content
	$tes='<b>hai</b>';
	$pdf->writeHTML($html, true, false, true, false, '');
	
	// reset pointer to the last page
	$pdf->lastPage();

	// ---------------------------------------------------------

	//Close and output PDF document
	$pdf->Output('sk.pdf', 'I');
	
	
?>