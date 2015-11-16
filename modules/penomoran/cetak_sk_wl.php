<?php
	while (ob_get_level())
	ob_end_clean();
	
	require_once('../../libraries/tcpdf/tcpdf.php');
	include('../../libraries/dinsos.php');
	
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
	$pdf->SetTitle('SK WL');
	$pdf->SetSubject('SK WL');
	$pdf->SetKeywords('DINSOSNAKER, MEDAN, SK WL, PRINT, SURAT');
	
	$pdf->setPrintHeader(false);
	
	// set font
	//$pdf->SetFont('Arial', '', 10);

	// add a page
	$pdf->AddPage();

	// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
	// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

	// create some HTML content
	
	$nmpri=mysql_query("SELECT * FROM tbl_sk_wl  WHERE no_resi='".$ab."'");
	$rnmpri = mysql_fetch_array($nmpri);
	$tanggal=$rnmpri["tanggal"];
	$lampiran=$rnmpri["lampiran"];
	$hal=$rnmpri["hal"];
	$no_daftar=$rnmpri["no_daftar"];
	$tgl_daftar=$rnmpri["tgl_daftar"];
	$urut=$rnmpri["urut"];
	$berlaku=$rnmpri["berlaku"];
	$sampai=$rnmpri["sampai"];

	
	$nmpri=mysql_query("SELECT no_surat FROM tbl_sk  WHERE no_resi='".$ab."'");
	$rnmpri = mysql_fetch_array($nmpri);
	$no_surat=$rnmpri["no_surat"];
	
	if($no_surat=='')
	{
		$no_surat="____ /____ /DSTKM/____";
	}
	
	$nmpri=mysql_query("SELECT * FROM vw_info_berkas  WHERE no_resi='".$ab."'");
	$rnmpri = mysql_fetch_array($nmpri);
	$nama=$rnmpri["nama"];

	//$gol=$rnmpri["gol"];

	
	$sql = "SELECT nama,jabatan,nip FROM user  WHERE level='17'";
	$res = mysql_query($sql);
	$ds = mysql_fetch_array($res);
	
	$kadis=$ds["nama"];
	$kadisjab=$ds["jabatan"];
	$kadisnip=$ds["nip"];

	
	
	$atas = '<table border="0" width="100%" align="center">
			<tr>
				<td width="15%" valign="top" align="center"><img src="../../image/logo1.png"></td>
				<td width="85%" align="center">
				<font size="-1">PEMERINTAH KOTA MEDAN</font><br>
				<b>DINAS SOSIAL DAN TENAGA KERJA</b><br>
				<font size="-2">Jln. K.H. Wahid Hasyim No. 14 Telp. 4514424 fax. 4511428</font><br>
				<font size="-3">MEDAN - 20154</font><br>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center"><b>___________________________________________________________________________________</b></td>
			</tr>
			<tr>
				<td width="60%"></td>
				<td width="40%" align="left"><font size="-3">Medan, '.tgl_indo($tanggal).'</font></td>
			</tr>			
			<tr>
				<td width="5%" align="left"><font size="-3">No.</font></td>
				<td width="1%" align="left"><font size="-3">:</font></td>
				<td width="54%" align="left"><font size="-3">'.$no_surat.'</font></td>
				<td width="40%" align="left"><font size="-3">Kepada</font></td>
			</tr>
			<tr>
				<td width="5%" align="left"><font size="-3">Lamp.</font></td>
				<td width="1%" align="left"><font size="-3">:</font></td>
				<td width="54%" align="left"><font size="-3">'.$lampiran.'</font></td>
				<td width="40%" align="left"><font size="-3">Yth. Sdr. Pemilik/Pengurus Perusahaan</font></td>
			</tr>	
			<tr>
				<td width="5%" align="left"><font size="-3">Hal</font></td>
				<td width="1%" align="left"><font size="-3">:</font></td>
				<td width="54%" align="left"><font size="-3">'.$hal.'</font></td>
				<td width="40%" align="left"><font size="-3">'.$nama.'</font></td>
			</tr>	
			<tr>
				<td width="5%" align="left"><font size="-3"></font></td>
				<td width="1%" align="left"><font size="-3"></font></td>
				<td width="54%" align="left"><font size="-3"></font></td>
				<td width="40%" align="left"><font size="-3">Di-</font></td>
			</tr>	
			<tr>
				<td width="5%" align="left"><font size="-3"></font></td>
				<td width="1%" align="left"><font size="-3"></font></td>
				<td width="54%" align="left"><font size="-3"></font></td>
				<td width="40%" align="center"><font size="-3">MEDAN</font></td>
			</tr>													
			</table>
			';
	$tengah= '
			<br/>
			<br/>
			<table border="0" width="100%" align="center">
			<tr>	
				<td align="center"><b>TANDA PENDAFTARAN WAJIB LAPOR KETENAGA</b></td>
			</tr>
			<tr>	
				<td align="center"><b>KERJAAN PERUSAHAAN</b></td>
			</tr>	
			<tr>
				<td align="center"><b>___________________________________________________</b></td>
			</tr>
			<tr>
				<td align="left"><font size="-3">Sesuai dengan bunyi pasal 6 ayat (1) dan (2) Undang-Undang Nomor 7 tahun 1981 tentang Wajib Lapor Ketenaga Kerjaan di Perusahaan, dengan ini diberitahukan bahwa kami telah menerima dari Saudara <b><u>Daftar Laporan</u></b> yang telah diisi untuk didaftarkan menjadi bukti pelaporan.</font></td>
			</tr>
			<tr>
				<td align="left"><font size="-3">Oleh karenanya perusahaan yang saudara pimpin telah terdaftar di Kantor kami dengan :</font></td>
			</tr>
			<tr>
				<td width="5%"></td>	
				<td align="left"><font size="-3">A. No. Pendaftaran : '.$no_daftar.'</font></td>
			</tr>	
			<tr>
				<td width="5%"></td>	
				<td align="left"><font size="-3">B. Telah terdaftar tanggal : '.tgl_indo($tgl_daftar).'</font></td>
			</tr>	
			<tr>
				<td width="5%"></td>	
				<td align="left"><font size="-3">C. No. Urut : '.$urut.'</font></td>
			</tr>	
			<tr>
				<td width="5%"></td>	
				<td align="left"><font size="-3">Nomor dan tanggal pendaftaran tersebut di atas adalah sama dengan daftar laporan terlampir.</font></td>
			</tr>																
			<tr>
				<td width="40%" align="left"><font size="-1"><b><u>PERHATIAN :</u></b></font></td>
			</tr>	
			<tr>
				<td width="5%" align="left"><font size="-3">1.</font></td>
				<td width="95%" align="left"><font size="-3">Pengusaha atau pengurus wajib melaporkan secara tertulis kepada Menteri atau Pejabat yang ditunjuk selambat-lambatnya dalam jangka waktu 30 (tiga puluh) hari setelah mendirikan, menjalankan kembali atau memindahkan perusahaan, pasal 6 ayat(1) UU No. 7 Th. 1981.</font></td>
			</tr>	
			<tr>
				<td width="5%" align="left"><font size="-3">2.</font></td>
				<td width="95%" align="left"><font size="-3">Setelah menyampaikan laporan sebagaimana yang dimaksud dalam pasal 6 Pengusaha atau pengurus wajib melaporkan setiap tahun secara tertulis mengenai ketenaga kerjaan kepada Menteri atau Pejabat yang ditunjuk Pasal 7 ayat(1) UU No. 7 Thn. 1981.</font></td>
			</tr>	
			<tr>
				<td width="5%" align="left"><font size="-3">3.</font></td>
				<td width="95%" align="left"><font size="-3">Pengusaha atau pengurus wajib melaporkan secara tertulis kepada Menteri atau Pejabat yang ditunjuk selambat-lambatnya dalam jangka waktu 30 (tiga puluh) hari sebelum memindahkan, menghentikan atau membubarkan perusahaan , pasal 8 ayat (1) UU No. 7 Th. 1981.</font></td>
			</tr>	
			<tr>
				<td width="5%" align="left"><font size="-3">4.</font></td>
				<td width="95%" align="left"><font size="-3">Bukti melaporkan ketenaga kerjaan ini beserta lampirannya, harus disimpan baik-baik, dan bila diminta oleh Pegawai Pengawas supaya dapat ditunjukkan.</font></td>
			</tr>	
			<tr>
				<td width="5%" align="left"><font size="-3">5.</font></td>
				<td width="95%" align="left"><font size="-3">Bukti tentang Wajib Lapor Ketenaga Kerjaan di perusahaan ini berlaku untuk 1 (satu) tahun terhitung mulai tanggal '.tgl_indo($berlaku).' sampai tanggal '.tgl_indo($sampai).'</font></td>
			</tr>																									
			</table>
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
	$html=$atas.$tengah.$bawah;
	
	// output the HTML content
	$tes='<b>hai</b>';
	$pdf->writeHTML($html, true, false, true, false, '');
	
	// reset pointer to the last page
	$pdf->lastPage();

	// ---------------------------------------------------------

	//Close and output PDF document
	$pdf->Output('wl.pdf', 'I');
	
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