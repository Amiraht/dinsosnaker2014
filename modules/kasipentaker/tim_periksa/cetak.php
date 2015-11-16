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
	$pdf->SetTitle('SURAT PERINTAH TUGAS');
	$pdf->SetSubject('SURAT PERINTAH TUGAS');
	$pdf->SetKeywords('DINSOSNAKER, MEDAN, PERINTAH TUGAS, PRINT, SURAT');
	
	$pdf->setPrintHeader(false);
	
	// set font
	//$pdf->SetFont('Arial', '', 10);

	// add a page
	$pdf->AddPage();

	// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
	// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

	// create some HTML content
	
	$sql = "SELECT * FROM tbl_tim_periksa  WHERE no_resi='".$ab."'";
	$res = mysql_query($sql);
	$petugas1="";
	$petugas='<table border="0" width="600" align="center">';
	$no=1;
	while($ds = mysql_fetch_array($res))
	{
	$nmpri=mysql_query("select * from user where id_user='$ds[2]'");
	$rnmpri = mysql_fetch_array($nmpri);
	$nama=$rnmpri["nama"];
	$nip=$rnmpri["nip"];
	$pangkat=$rnmpri["pangkat"];
	$gol=$rnmpri["gol"];

	if($petugas1=="")
		{
			$petugas2='<tr>
						<td width="80" align="left">Kepada :</td>
						<td width="20" align="left">'.$no.'. </td>
						<td width="80" align="left">Nama</td>
						<td width="20">:</td>
						<td width="300" align="left">'.$nama.'</td>
					  </tr>
					  <tr>
						<td width="80" align="left"></td>
						<td></td>
						<td width="80" align="left">NIP</td>
						<td width="20">:</td>
						<td width="300" align="left">'.$nip.'</td>
					  </tr>
					  <tr>
						<td width="80" align="left"></td>
						<td></td>
						<td width="80" align="left">Pangkat/Gol.</td>
						<td width="20">:</td>
						<td width="300" align="left">'.$pangkat.'/'.$gol.'</td>
					  </tr>
					  <tr>
						<td width="80" align="left"></td>
						<td></td>
						<td width="80" align="left">Jabatan</td>
						<td width="20">:</td>
						<td width="300" align="left">'.$ds["jabatan"].'</td>
					  </tr>';
		}
		else
		{
			$petugas2='<tr>
						<td width="80" align="left"></td>
						<td width="20" align="left">'.$no.'. </td>
						<td width="80" align="left">Nama</td>
						<td width="20">:</td>
						<td width="300" align="left">'.$nama.'</td>
					  </tr>
					  <tr>
						<td width="80" align="left"></td>
						<td></td>
						<td width="80" align="left">NIP</td>
						<td width="20">:</td>
						<td width="300" align="left">'.$nip.'</td>
					  </tr>
					  <tr>
						<td width="80" align="left"></td>
						<td></td>
						<td width="80"align="left">Pangkat/Gol.</td>
						<td width="20">:</td>
						<td width="300" align="left">'.$pangkat.'/'.$gol.'</td>
					  </tr>
					  <tr>
						<td width="80" align="left"></td>
						<td></td>
						<td width="80"align="left">Jabatan</td>
						<td width="20">:</td>
						<td width="300" align="left">'.$ds["jabatan"].'</td>
					  </tr>';
		}
		
	$petugas1=$petugas1.$petugas2;
	$no=$no+1;
	}
	$petugas3='</table>';
	$tengah=$petugas.$petugas1.$petugas3;
	
	$sql = "SELECT nama,jabatan,nip FROM user  WHERE level='17'";
	$res = mysql_query($sql);
	$ds = mysql_fetch_array($res);
	
	$kadis=$ds["nama"];
	$kadisjab=$ds["jabatan"];
	$kadisnip=$ds["nip"];

	$sql = "SELECT no_surat,tanggal FROM tbl_surat_tugas WHERE no_resi='".$ab."'";
	$res = mysql_query($sql);
	if(mysql_num_rows($res)<>0)
	{
		$ds = mysql_fetch_array($res);
		$no_surat=$ds["no_surat"];
		$tgl_surat=$ds["tanggal"];
	}
	else
	{
		$no_surat='____ /____ /DSTKM/____';
		$tgl_surat='..........';
	}
	
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
				<td colspan="2" align="center"><font size="+1"><b><u>SURAT PERINTAH TUGAS</u></b></font></td>
			</tr>
			<tr>
				<td colspan="2" align="center">Nomor : '.$no_surat.'</td>
			</tr>
			</table>
			<br/><br/>
			<table border="0" align="center">
			<tr>
				<td width="80" align="left">Dasar :</td>
				<td width="20" align="left">1. </td>
				<td width="400" align="left">Undang-Undang No. 13 Tahun 2003 tentang ketenagakerjaan.</td>
			 </tr>
			 <tr>
				<td width="80" align="left"></td>
				<td width="20" align="left">2. </td>
				<td width="400" align="left">Peraturan Pemerintah Republik Indonesia NO. 38 tahun 2007 tentang Pembagian Urusan Pemerintahan, Antara Pemerintah, Pemerintah Daerah Propinsi dan Pemerintah Daerah Kabupaten / Kota</td>
			 </tr>
			 <tr>
				<td width="80" align="left"></td>
				<td width="20" align="left">3. </td>
				<td width="400" align="left">Keputusan Presiden R.I No. 75 tahun 1995 tentang Penggunaan TKWNAP</td>
			 </tr>
			 <tr>
				<td width="80" align="left"></td>
				<td width="20" align="left">4. </td>
				<td width="400" align="left">Peraturan Menteri Tenaga Kerja No. PER-01/MEN/1997 dan PER.02/MEN/1998 tentang Dana Pengembangan Keahlian Dan Keterampilan.</td>
			 </tr>
			 <tr>
				<td width="80" align="left"></td>
				<td width="20" align="left">5. </td>
				<td width="400" align="left">Permenakertrans No. PER-02/MEN/III/2008 tentang Tata Cara Penggunaan Tenaga Kerja Asing.<br/></td>
			 </tr>
			 <tr>
				<td colspan="3"><b>DIPERINTAHKAN</b><br/></td>
			</tr>
			</table>
			';
	$bawah= '
			<table border="0" align="center">
			<tr>
				<td width="80" align="left">Untuk :</td>
				<td width="20" align="left">1. </td>
				<td width="400" align="left">Melakukan kunjungan monitoring keberadaan TKA di perusahaan.</td>
			 </tr>
			 <tr>
				<td width="80" align="left"></td>
				<td width="20" align="left">2. </td>
				<td width="400" align="left">Melakukan kunjungan evaluasi Alih Teknologi kepada TKI Pendamping dan laporan keberadaan TKA</td>
			 </tr>
			 <tr>
				<td width="80" align="left"></td>
				<td width="20" align="left">3. </td>
				<td width="400" align="left">Surat Perintah Tugas ini berlaku sejak tanggal'.tgl_indo($tgl_surat).' sampai dengan selesai</td>
			 </tr>
			 <tr>
				<td width="80" align="left"></td>
				<td width="20" align="left">4. </td>
				<td width="400" align="left">Membuat / menyampaikan laporan tertulis hasil kunjungan kepada Kepala Dinas Sosial Dan Tenaga Kerja Kota Medan.</td>
			 </tr>
			 <tr>
				<td width="80" align="left"></td>
				<td width="20" align="left">5. </td>
				<td width="400" align="left">Melaksanakan perintah dengan seksama dan penuh tanggung jawab.<br/></td>
			 </tr>
			</table>
			<table border="0" width="100%" align="center">
			<tr>
				<td width="15%" align="left"></td>
				<td width="30%" align="left"></td>
				<td width="50%" align="left">Dikeluarkan di : Medan</td>
			</tr>
			<tr>
				<td width="15%" align="left"></td>
				<td width="30%" align="left"></td>
				<td width="50%" align="left">Pada Tanggal : '.tgl_indo($tgl_surat).'</td>
			</tr>
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
			</table>';
	$html=$atas.$tengah.$bawah;
	
	// output the HTML content
	$tes='<b>hai</b>';
	$pdf->writeHTML($html, true, false, true, false, '');
	
	// reset pointer to the last page
	$pdf->lastPage();

	// ---------------------------------------------------------

	//Close and output PDF document
	$pdf->Output('cetak_perintah_tugas.pdf', 'I');
?>