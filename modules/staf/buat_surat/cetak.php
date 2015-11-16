<?php
	while (ob_get_level())
	ob_end_clean();
	header("Content-Encoding: None", true);
	// Include the main TCPDF library (search for installation path).
	require_once('./libraries/tcpdf/tcpdf.php');
	include('./libraries/dinsos.php');
	
	$ab = $_GET["link"];
	$userid=$_GET["uid"];
	$data=explode("-",$ab);
	$jenis_urus = $data[0];

	//arequire_once('tcpdf/tcpdf.php');

	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LEGAL', true, 'UTF-8', false);
	
	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('DINSOSNAKER MEDAN');
	$pdf->SetTitle('SURAT PANGGILAN');
	$pdf->SetSubject('SURAT PANGGILAN');
	$pdf->SetKeywords('DINSOSNAKER, MEDAN, PANGGILAN, PRINT, SURAT');
	
	$pdf->setPrintHeader(false);
	
	// set font
	//$pdf->SetFont('Arial', '', 10);

	// add a page
	$pdf->AddPage();

	// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
	// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

	// create some HTML content
	$sql = "SELECT nama,alamat,alamat_perusahaan,nama_perusahaan,nama_pemilik,alamat_pemilik,tgl_masuk_berkas,dasar_permasalahan FROM vw_pengaduan  WHERE no_resi='".$ab."'";
	$res = mysql_query($sql);
	$ds = mysql_fetch_array($res);
	$pemilik=$ds["nama_pemilik"];
	$pengadu=$ds["nama"];
	$alamat=$ds["alamat"];
	$alamat_per=$ds["alamat_perusahaan"];
	$per=$ds["nama_perusahaan"];
	$masalah=$ds["dasar_permasalahan"];
	$tgl=$ds["tgl_masuk_berkas"];
	$hr=substr($tgl,8,2);
	$bln=substr($tgl,5,2);
	$thn=substr($tgl,0,4);
	$tbt=$hr."-".$bln."-".$thn;
	
	$sql = "SELECT nama FROM user  WHERE id_user='".$userid."'";
	$res = mysql_query($sql);
	$ds = mysql_fetch_array($res);
	
	$mediator=$ds["nama"];
	
	$sql = "SELECT nama,jabatan,nip FROM user  WHERE level='17'";
	$res = mysql_query($sql);
	$ds = mysql_fetch_array($res);
	
	$kadis=$ds["nama"];
	$kadisjab=$ds["jabatan"];
	$kadisnip=$ds["nip"];

	$sql = "SELECT * FROM tbl_sp1 WHERE no_resi='".$ab."'";
	$res = mysql_query($sql);
	$ds = mysql_fetch_array($res);
	
	$no_surat=$ds["no_surat"];
	$tgl_surat=$ds["tanggal"];
	$hari_h=$ds["hari_h"];
	$tgl_h=$ds["tgl_h"];
	$pukul_h=$ds["pukul_h"];
			
	
	
	$html = '<table border="0" width="100%" align="center">
			<tr>
				<td width="15%" valign="top" align="center"><img src="./image/logo1.png"></td>
				<td width="85%" align="center">
				<font size="+3">PEMERINTAH KOTA MEDAN</font><br>
				<font size="+4">DINAS SOSIAL DAN TENAGA KERJA</font><br>
				<font size="+2">Jln. K.H. Wahid Hayim No. 14 Telp. 4514424 fax. 4511428</font><br>
				<font size="+1">MEDAN - 20154</font><br>
				</td>
			</tr>
			</table>
			<hr/>
			<table border="0" width="100%" align="center">
			<tr>
				<td width="15%" align="left"></td>
				<td width="55%" align="left"></td>
				<td width="30%" align="left">Medan, '.tgl_indo($tgl_surat).'</td>
			</tr>
			<tr>
				<td width="15%" align="left"></td>
				<td width="55%" align="left"></td>
				<td width="30%" align="left">Kepada Yth,</td>
			</tr>
			<tr>
				<td width="15%" align="left">Nomor</td>
				<td width="55%" align="left">: '.$no_surat.'</td>
				<td width="30%" align="left">1. Sdr. Pimpinan Perusahaan</td>
			</tr>
			<tr>
				<td width="15%" align="left">Sifat</td>
				<td width="55%" align="left">: -</td>
				<td width="30%" align="left">'.$alamat_per.'</td>
			</tr>
			<tr>
				<td width="15%" align="left">Lampiran</td>
				<td width="55%" align="left">: 1(satu) berkas</td>
				<td width="30%" align="left">Di Medan</td>
			</tr>
			<tr>
				<td width="15%" align="left">Perihal</td>
				<td width="55%" align="left">: <u>Panggilan I</u></td>
				<td width="30%" align="left">2. Sdr. '.$pengadu.'</td>
			</tr>
			<tr>
				<td width="15%" align="left"></td>
				<td width="55%" align="left"></td>
				<td width="30%" align="left">'.$alamat.'</td>
			</tr>
			<tr>
				<td width="15%" align="left"></td>
				<td width="55%" align="left"></td>
				<td width="30%" align="left">Di Medan</td>
			</tr>
			</table>
<p>Berdasarkan Undang-Undang No. 13 Tahun 2003 dan Undang-Undang No. 2 Tahun 2004, sehubungan dengan pengaduan sdr. '.$pengadu.' yang ditujukan kepada Kepala Dinas Sosial dan Tenaga Kerja Kota Medan tanggal '.$tbt.' perihal '.$masalah.' dari '.$per.' maka untuk penyelesaian masalah tersebut diminta kehadiran saudara pada : 
			</p>
			<table border="0" width="400" align="center">
			<tr>
				<td width="100" align="left">Hari/Tanggal</td>
				<td width="50">:</td>
				<td width="250" align="left">'.$hari_h.' / '.tgl_indo($tgl_h).'</td>
			</tr>
			<tr>
				<td width="100" align="left">Pukul</td>
				<td width="50">:</td>
				<td width="250" align="left">'.$pukul_h.' WIB</td>
			</tr>
			<tr>
				<td width="100" align="left">Tempat</td>
				<td width="50">:</td>
				<td width="250" align="left">Ruang Bidang Hubinsyaker Lt. II Kantor Dinas Sosial dan Tenaga Kerja Kota Medan</td>
			</tr>
			<tr>
				<td width="100" align="left">Menghadap</td>
				<td width="50">:</td>
				<td width="250" align="left">'.$mediator.'(Mediator Hubungan Industrial)/(Kepala Seksi)</td>
			</tr>
			<tr>
				<td width="100" align="left">Masalah</td>
				<td width="50">:</td>
				<td width="250" align="left">Penyelesaian masalah '.$masalah.' sdr. '.$pengadu.' dari '.$per.'</td>
			</tr>
			</table>
			<p>
			Guna kelancaran perundingan / penyelesaian dimaksud diminta agar saudara hadir tanpa diwakilkan dengan membawa data-data sebagai berikut :<br>
1. Perjanjian Kerja.<br>
2. Peraturan Perusahaan / Perjanjian Kerja Bersama.<br>
3. Hasil Perundingan Bipartit.<br>
4. Data-data tenaga kerja yaitu upah, masa kerja dan jabatan.</p>
<p>Demikian disampaikan agar dapat dihadiri.</p>
			<table border="0" width="100%" align="center">
			<tr>
				<td width="15%" align="left"></td>
				<td width="30%" align="left"></td>
				<td width="50%" align="center">KEPALA DINAS SOSIAL DAN TENAGA KERJA</td>
			</tr>
			<tr>
				<td width="15%" align="left"></td>
				<td width="30%" align="left"></td>
				<td width="50%" align="center">KOTA MEDAN<br><br></td>
			</tr>
			<tr>
				<td width="15%" align="left"></td>
				<td width="30%" align="left"></td>
				<td width="50%" align="center">'.$kadis.'</td>
			</tr>
			<tr>
				<td width="15%" align="left"></td>
				<td width="30%" align="left"></td>
				<td width="50%" align="center">'.$kadisjab.'</td>
			</tr>
			<tr>
				<td width="15%" align="left"></td>
				<td width="30%" align="left"></td>
				<td width="50%" align="center">NIP. '.$kadisnip.'</td>
			</tr>
			<tr>
				<td width="15%" align="left"><font size="-1">Tembusan :</font></td>
				<td width="30%" align="left"></td>
				<td width="50%" align="center"></td>
			</tr>
			<tr>
				<td width="30%" align="left"><font size="-1">1. Yth. Bapak Walikota Medan</font></td>
				<td width="30%" align="left"></td>
				<td width="40%" align="center"></td>
			</tr>
			<tr>
				<td width="30%" align="left"><font size="-1">2. Pertinggal</font></td>
				<td width="30%" align="left"></td>
				<td width="40%" align="center"></td>
			</tr>
			</table>

';
	
	
	// output the HTML content
	$tes='<b>hai</b>';
	$pdf->writeHTML($html, true, false, true, false, '');
	
	// reset pointer to the last page
	$pdf->lastPage();

	// ---------------------------------------------------------

	//Close and output PDF document
	$pdf->Output('cetak_panggilan.pdf', 'I');
?>