<?php
	while (ob_get_level())
	ob_end_clean();
	header("Content-Encoding: None", true);
	// Include the main TCPDF library (search for installation path).
	require_once('../../libraries/tcpdf/tcpdf.php');
	include('../../libraries/dinsos.php');
	
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
						<td width="80" align="left"><font size="-1"><b>Kepada :</b></font></td>
						<td width="20" align="left"><font size="-1">'.$no.'. </font></td>
						<td width="80" align="left"><font size="-1">Nama</font></td>
						<td width="20"><font size="-1">:</font></td>
						<td width="300" align="left"><font size="-1">'.$nama.'</font></td>
					  </tr>
					  <tr>
						<td width="80" align="left"></td>
						<td></td>
						<td width="80" align="left"><font size="-1">NIP</font></td>
						<td width="20"><font size="-1">:</font></td>
						<td width="300" align="left"><font size="-1">'.$nip.'</font></td>
					  </tr>
					  <tr>
						<td width="80" align="left"></td>
						<td></td>
						<td width="80" align="left"><font size="-1">Pangkat/Gol.</font></td>
						<td width="20"><font size="-1">:</font></td>
						<td width="300" align="left"><font size="-1">'.$pangkat.'/'.$gol.'</font></td>
					  </tr>
					  <tr>
						<td width="80" align="left"></td>
						<td></td>
						<td width="80" align="left"><font size="-1">Jabatan</font></td>
						<td width="20"><font size="-1">:</font></td>
						<td width="300" align="left"><font size="-1">'.$ds["jabatan"].'</font></td>
					  </tr>';
		}
		else
		{
			$petugas2='<tr>
						<td width="80" align="left"></td>
						<td width="20" align="left"><font size="-1">'.$no.'. </font></td>
						<td width="80" align="left"><font size="-1">Nama</font></td>
						<td width="20"><font size="-1">:</font></td>
						<td width="300" align="left"><font size="-1">'.$nama.'</font></td>
					  </tr>
					  <tr>
						<td width="80" align="left"></td>
						<td></td>
						<td width="80" align="left"><font size="-1">NIP</font></td>
						<td width="20"><font size="-1">:</font></td>
						<td width="300" align="left"><font size="-1">'.$nip.'</font></td>
					  </tr>
					  <tr>
						<td width="80" align="left"></td>
						<td></td>
						<td width="80"align="left"><font size="-1">Pangkat/Gol.</font></td>
						<td width="20"><font size="-1">:</font></td>
						<td width="300" align="left"><font size="-1">'.$pangkat.'/'.$gol.'</font></td>
					  </tr>
					  <tr>
						<td width="80" align="left"></td>
						<td></td>
						<td width="80"align="left"><font size="-1">Jabatan</font></td>
						<td width="20"><font size="-1">:</font></td>
						<td width="300" align="left"><font size="-1">'.$ds["jabatan"].'</font></td>
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
				<td width="15%" valign="top" align="center"><img src="../../image/logo1.png"></td>
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
				<td width="80" align="left"><font size="-1"><b>Dasar :</b></font></td>
				<td width="20" align="left"><font size="-1">1. </font></td>
				<td width="400" align="left"><font size="-1">Undang-Undang No. 3 Tahun 1951, tentang Pengawasan Ketenaga Kerjaan.</font></td>
			 </tr>
			 <tr>
				<td width="80" align="left"></td>
				<td width="20" align="left"><font size="-1">2. </font></td>
				<td width="400" align="left"><font size="-1">Undang-Undang No.21 Tahun 1954, tentang Peraturan Istirahat Buruh.</font></td>
			 </tr>
			 <tr>
				<td width="80" align="left"></td>
				<td width="20" align="left"><font size="-1">3. </font></td>
				<td width="400" align="left"><font size="-1">Undang-Undang No.1 Tahun 1970, tentang Keselamatan Kerja.</font></td>
			 </tr>
			 <tr>
				<td width="80" align="left"></td>
				<td width="20" align="left"><font size="-1">4. </font></td>
				<td width="400" align="left"><font size="-1">Undang-Undang Tahun 1981, tentang Wajib Lapor Ketenaga Kerjaan.</font></td>
			 </tr>
			 <tr>
				<td width="80" align="left"></td>
				<td width="20" align="left"><font size="-1">5. </font></td>
				<td width="400" align="left"><font size="-1">Peraturan Pemerintah No. 8 Tahun 1981, tentang Perlindungan Upah</font></td>
			 </tr>
			 <tr>
				<td width="80" align="left"></td>
				<td width="20" align="left"><font size="-1">6. </font></td>
				<td width="400" align="left"><font size="-1">Undang-Undang Tahun No. 3 Tahun 1992, tentang Jaminan Sosial Tenaga Kerja.</font></td>
			 </tr>
			 <tr>
				<td width="80" align="left"></td>
				<td width="20" align="left"><font size="-1">7. </font></td>
				<td width="400" align="left"><font size="-1">Undang-Undang Tahun No. 13 Tahun 2003, tentang Ketenaga Kerjaan.</font></td>
			 </tr>
			 <tr>
				<td width="80" align="left"></td>
				<td width="20" align="left"><font size="-1">8. </font></td>
				<td width="400" align="left"><font size="-1">Peraturan Walikota Medan No. 12 Tahun 2010 tentang Tugas Pokok dan fungsi Dinas Sosial dan Tenaga Kerja Kota Medan</font><br/></td>
			 </tr>			 			 			 
			 <tr>
				<td colspan="3"><font size="-1"><b>DIPERINTAHKAN</b></font><br/></td>
			</tr>
			</table>
			';
	$bawah= '
			<table border="0" align="center">
			<tr>
				<td width="80" align="left"><font size="-1"><b>Untuk :</b></font></td>
				<td width="20" align="left"><font size="-1">1. </font></td>
				<td width="400" align="left"><font size="-1">Melakukan kunjungan Pemeriksaan tentang Pelaksanaan Peraturan Perundang-undangan Ketenaga Kerjaan di perusahaan.</font></td>
			 </tr>
			 <tr>
				<td width="80" align="left"></td>
				<td width="20" align="left"><font size="-1">2. </font></td>
				<td width="400" align="left"><font size="-1">Surat Perintah Tugas ini berlaku sejak tanggal '.tgl_indo($tgl_surat).' sampai dengan selesai</font></td>
			 </tr>
			 <tr>
				<td width="80" align="left"></td>
				<td width="20" align="left"><font size="-1">3. </font></td>
				<td width="400" align="left"><font size="-1">Membuat / menyampaikan laporan tertulis hasil kunjungan kepada Kepala Dinas Sosial Dan Tenaga Kerja Kota Medan.</font></td>
			 </tr>
			 <tr>
				<td width="80" align="left"></td>
				<td width="20" align="left"><font size="-1">4. </font></td>
				<td width="400" align="left"><font size="-1">Melaksanakan perintah dengan seksama dan penuh tanggung jawab.</font><br/></td>
			 </tr>
			</table>
			<table border="0" width="100%" align="center">
			<tr>
				<td width="15%" align="left"></td>
				<td width="30%" align="left"></td>
				<td width="50%" align="left"><font size="-1">Dikeluarkan di : Medan</font></td>
			</tr>
			<tr>
				<td width="15%" align="left"></td>
				<td width="30%" align="left"></td>
				<td width="50%" align="left"><font size="-1">Pada Tanggal : '.tgl_indo($tgl_surat).'</font></td>
			</tr>
			<tr>
				<td width="15%" align="left"></td>
				<td width="30%" align="left"></td>
				<td width="50%" align="center"><font size="-1">KEPALA DINAS SOSIAL DAN TENAGA KERJA</font></td>
			</tr>
			<tr>
				<td width="15%" align="left"></td>
				<td width="30%" align="left"></td>
				<td width="50%" align="center"><font size="-1">KOTA MEDAN</font><br><br></td>
			</tr>
			<tr>
				<td width="15%" align="left"></td>
				<td width="30%" align="left"></td>
				<td width="50%" align="center"><font size="-1">'.$kadis.'</font></td>
			</tr>
			<tr>
				<td width="15%" align="left"></td>
				<td width="30%" align="left"></td>
				<td width="50%" align="center"><font size="-1">'.$kadisjab.'</font></td>
			</tr>
			<tr>
				<td width="15%" align="left"></td>
				<td width="30%" align="left"></td>
				<td width="50%" align="center"><font size="-1">NIP. '.$kadisnip.'</font></td>
			</tr>
			<tr>
				<td width="15%" align="left"><font size="-2">Tembusan :</font></td>
				<td width="30%" align="left"></td>
				<td width="50%" align="center"></td>
			</tr>
			<tr>
				<td width="30%" align="left"><font size="-2">1. Yth. Bapak Walikota Medan</font></td>
				<td width="30%" align="left"></td>
				<td width="40%" align="center"></td>
			</tr>
			<tr>
				<td width="30%" align="left"><font size="-2">2. Pertinggal</font></td>
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