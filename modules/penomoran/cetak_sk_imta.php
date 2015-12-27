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
		$pdf->SetTitle('SK IMTA');
		$pdf->SetSubject('SK IMTA');
		$pdf->SetKeywords('DINSOSNAKER, MEDAN, SK IMTA, PRINT, SURAT');
		
		$pdf->setPrintHeader(false);
		
		// set font
		//$pdf->SetFont('Arial', '', 10);
	
		// add a page
		$pdf->AddPage();
	
		// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
		// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
	
		// create some HTML content
		
		$nmpri=mysql_query("SELECT * FROM tbl_berkas_imta  WHERE no_resi='".$ab."'");
		$rnmpri = mysql_fetch_array($nmpri);
		$nama=$rnmpri["nama"];
		$no_resi=$rnmpri["no_resi"];
		$nomor=$rnmpri["no_imta"];
		$tgl_masuk=$rnmpri["tgl_masuk_berkas"];
		$nama_imta=$rnmpri["nama_imta"];
		$berlaku_dari=$rnmpri["berlaku_dari"];
		$berlaku_sampai=$rnmpri["berlaku_sampai"];
		$no_rptka=$rnmpri["no_rptka"];
		$tgl_rptka=$rnmpri["tgl_rptka"];

		
		$nmpri=mysql_query("SELECT * FROM vw_imta_baru  WHERE no_resi='".$ab."'");
		$rnmpri = mysql_fetch_array($nmpri);
		$nama1=$rnmpri["nama"];
		$alamat1=$rnmpri["alamat"];
		$jenis_usaha1=$rnmpri["jenis"];
		$nama_imta1=$rnmpri["nama_ta"];
		$umur=$rnmpri["umur"];
		$tgl_lahir=$rnmpri["tgl_lahir"];
		$kwn=$rnmpri["kewarganegaraan"];
		$berlaku_dari1=$rnmpri["tgl_imta"];
		$berlaku_sampai1=$rnmpri["tgl_berakhir"];
		$alamat_ta=$rnmpri["alamat_ta"];
		$no_passport=$rnmpri["no_passport"];
		$jabatan=$rnmpri["jabatan"];

		//$gol=$rnmpri["gol"];

		$nmpri=mysql_query("SELECT no_surat,tanggal FROM tbl_sk  WHERE no_resi='".$ab."'");
		$rnmpri = mysql_fetch_array($nmpri);
		$no_surat=$rnmpri["no_surat"];
		$tanggal=$rnmpri["tanggal"];
		if($no_surat=='')
		{
			$no_surat="____ /____ /DSTKM/____";
		}
		
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
					DINAS SOSIAL DAN TENAGA KERJA<br>
					Jln. K.H. Wahid Hasyim No. 14 Telp. 4514424 fax. 4511428<br>
					<font size="-3">MEDAN - 20154</font><br>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">________________________________________________________________________________</td>
				</tr>
				<tr>
					<td colspan="2" align="center"><font size="-3">Nomor : '.$no_surat.'</font></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><font size="-3">TENTANG</font></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><font size="-3">PEMBERIAN IZIN PERPANJANGAN MEMPEKERJAKAN TENAGA KERJA ASING</font></td>
				</tr>
				</table>
				<table border="0" align="center">
				<tr>
					<td width="80" align="left"><font size="-4">Membaca</font></td>
					<td width="20" align="left"><font size="-4">:</font></td>
					<td width="400" align="left"><font size="-4">Permohonan dari '.$nama.' Nomor : '.$no_resi.' Tanggal : '.tgl_biasa($tgl_masuk).' untuk Perpanjangan IMTA</font></td>
				</tr>
				<tr>
					<td width="80" align="left"><font size="-4">Menimbang</font></td>
					<td width="20" align="left"><font size="-4">:</font></td>
					<td width="400" align="left"><font size="-4">1. Bahwa IMTA yang diterbitkan oleh Depnakertrans R.I AN. '.$nama_imta.' Nomor :'.$nomor.' Tgl. '.tgl_biasa($berlaku_dari).' yang akan berakhir pada tgl. '.tgl_biasa($berlaku_sampai).'<br/>
					2. Bahwa Perusahaan tersebut telah mendapat surat pengesahan RPTKA Nomor :'.$no_rptka.' tanggal '.tgl_biasa($tgl_rptka).' </font></td>
				 </tr>
				<tr>
					<td width="80" align="left"><font size="-4">Mengingat</font></td>
					<td width="20" align="left"><font size="-4">:</font></td>
					<td width="400" align="left"><font size="-4">1. Undang-undang No. 13 Tahun 2003 tentang Ketenagakerjaan.<br/>
					2. Peraturan Pemerintah Republik Indonesia No. 38 tahun 2007 tentang Pembagian Urusan Pemerintahan, Antara Pemerintah, Pemerintah Daerah Propinsi dan Pemerintah Daerah Kabupaten/Kota.<br/>
					3. Keputusan Presiden RI No. 75 tahun 1995 tentang Penggunaan TKWNAP.<br/>
					4. Peraturan Menteri Tenaga Kerja No. PER-01/MEN/1997 dan PER.02/MEN/1998 tentang Dana Pengembangan Keahlian dan Keterampilan.<br/>
					5. Permenakertrans No. PER-02/MEN/III/2008 tentang Tata Cara Penggunaan Tenaga Kerja Asing.</font></td>
				 </tr>
				<tr>
					<td width="80" align="left"><font size="-4">Menetapkan</font></td>
					<td width="20" align="left"><font size="-4">:</font></td>
				</tr>
				<tr>
					<td width="80" align="left"><font size="-4">PERTAMA</font></td>
					<td width="20" align="left"><font size="-4">:</font></td>
					<td width="120" align="left"><font size="-4">Memberikan izin kepada</font></td>
					<td width="20" align="left"><font size="-4">:</font></td>
					<td width="300" align="left"><font size="-4">'.$nama1.'</font></td>
				 </tr>
				<tr>
					<td width="80" align="left"><font size="-4"></font></td>
					<td width="20" align="left"><font size="-4"></font></td>
					<td width="120" align="left"><font size="-4">Alamat Instansi/Perusahaan</font></td>
					<td width="20" align="left"><font size="-4">:</font></td>
					<td width="300" align="left"><font size="-4">'.$alamat1.'</font></td>
				 </tr>
				<tr>
					<td width="80" align="left"><font size="-4"></font></td>
					<td width="20" align="left"><font size="-4"></font></td>
					<td width="120" align="left"><font size="-4">Jenis Usaha</font></td>
					<td width="20" align="left"><font size="-4">:</font></td>
					<td width="300" align="left"><font size="-4">'.$jenis_usaha1.'</font></td>
				 </tr>
				<tr>
					<td width="80" align="left"><font size="-4"></font></td>
					<td width="20" align="left"><font size="-4"></font></td>
					<td width="120" align="left"><font size="-4">Untuk mempekerjakan</font></td>
					<td width="20" align="left"><font size="-4"></font></td>
					<td width="300" align="left"><font size="-4"></font></td>
				 </tr>
				<tr>
					<td width="80" align="left"><font size="-4"></font></td>
					<td width="20" align="left"><font size="-4"></font></td>
					<td width="120" align="left"><font size="-4">Nama Tenaga Asing</font></td>
					<td width="20" align="left"><font size="-4">:</font></td>
					<td width="300" align="left"><font size="-4">'.$nama_imta1.'</font></td>
				 </tr>
				<tr>
					<td width="80" align="left"><font size="-4"></font></td>
					<td width="20" align="left"><font size="-4"></font></td>
					<td width="120" align="left"><font size="-4">Umur dan Tanggal Lahir</font></td>
					<td width="20" align="left"><font size="-4">:</font></td>
					<td width="300" align="left"><font size="-4">'.$umur.' tahun, '.tgl_biasa($tgl_lahir).'</font></td>
				 </tr>
				<tr>
					<td width="80" align="left"><font size="-4"></font></td>
					<td width="20" align="left"><font size="-4"></font></td>
					<td width="120" align="left"><font size="-4">Kewrganegaraan</font></td>
					<td width="20" align="left"><font size="-4">:</font></td>
					<td width="300" align="left"><font size="-4">'.$kwn.'</font></td>
				 </tr>
				<tr>
					<td width="80" align="left"><font size="-4"></font></td>
					<td width="20" align="left"><font size="-4"></font></td>
					<td width="120" align="left"><font size="-4">Alamat Tempat Tinggal</font></td>
					<td width="20" align="left"><font size="-4">:</font></td>
					<td width="300" align="left"><font size="-4">'.$alamat_ta.'</font></td>
				 </tr>
				<tr>
					<td width="80" align="left"><font size="-4"></font></td>
					<td width="20" align="left"><font size="-4"></font></td>
					<td width="120" align="left"><font size="-4">No. Paspor</font></td>
					<td width="20" align="left"><font size="-4">:</font></td>
					<td width="300" align="left"><font size="-4">'.$no_passport.'</font></td>
				 </tr>
				<tr>
					<td width="80" align="left"><font size="-4"></font></td>
					<td width="20" align="left"><font size="-4"></font></td>
					<td width="120" align="left"><font size="-4">Untuk mengisi jabatan</font></td>
					<td width="20" align="left"><font size="-4">:</font></td>
					<td width="300" align="left"><font size="-4">'.$jabatan.'</font></td>
				 </tr>
				<tr>
					<td width="80" align="left"><font size="-4">KEDUA</font></td>
					<td width="20" align="left"><font size="-4">:</font></td>
					<td width="120" align="left"><font size="-4">Berlaku</font></td>
					<td width="20" align="left"><font size="-4">:</font></td>
					<td width="300" align="left"><font size="-4">'.tgl_biasa($berlaku_dari1).' s.d '.tgl_biasa($berlaku_sampai1).' (Tanggal '.terbilang(hari($berlaku_dari1)).' bulan '.getbulan(bln($berlaku_dari1)).' tahun '.terbilang(thn($berlaku_dari1)).' s.d tanggal '.terbilang(hari($berlaku_sampai1)).' bulan '.getbulan(bln($berlaku_sampai1)).' tahun '.terbilang(thn($berlaku_sampai1)).'). </font></td>
				 </tr>
				<tr>
					<td width="80" align="left"><font size="-4">KETIGA</font></td>
					<td width="20" align="left"><font size="-4">:</font></td>
					<td width="400" align="left"><font size="-4">Menentukan syarat-syarat berikut :<br/>
					1. Memberikan pendidikan/Pelatihan kepada tenaga-tenaga warga Negara Indonesia sehingga mereka itu dapat menduduki jabatan yang membutuhkan tanggung jawab dan keahlian/keterampilan tertentu dalam perusahaan tersebut, dengan melaporkan hasilnya kepada Depnakertrans RI dan Disnakertrans Propinsi Sumatera Utara dan Walikota Medan secara periodik 6(enam) bulan sekali.<br/>
					2. Tidak akan memindahkan jabatan atau mempekerjakan dalam jabatan lain, tanpa izin Menakertrans.<br/>
					3. Jika kemudian hari ternyata bahwa keterangan-keterangan yang diberikan/disebut dalam daftar permohonan yang bersangkutan tidak benar ataupun syarat-syarat yang kami tentukan ini tidak dipenuhi, maka surat keputusan ini dapat dicabut.<br/>
					4. Setelah menerima IMTA, Pemohon wajib melaporkan Pengguanaan TKA dan Pendamping TKA di perusahaan kepada Kantor Dinas Pendapatan Daerah dan Kantor Kependudukan Kota Medan</font></td>
				 </tr>
				<tr>
					<td width="80" align="left"><font size="-4">KEEMPAT</font></td>
					<td width="20" align="left"><font size="-4">:</font></td>
					<td width="400" align="left"><font size="-4">Apabila dalam surat keputusan ini di kemudian hari ternyata terdapat kekeliruan/kekurangan akan dibetulkan sebagaimana mestinya.</font></td>
				 </tr>
				</table>
				';
		$bawah= '
				<table border="0" width="100%" align="center">
				<tr>
					<td width="15%" align="left"></td>
					<td width="30%" align="left"></td>
					<td width="50%" align="left"><font size="-4">Ditetapkan di : Medan</font></td>
				</tr>
				<tr>
					<td width="15%" align="left"></td>
					<td width="30%" align="left"></td>
					<td width="50%" align="left"><font size="-4">Pada Tanggal : '.tgl_indo($tanggal).'</font></td>
				</tr>
				<tr>
					<td width="15%" align="left"></td>
					<td width="30%" align="left"></td>
					<td width="50%" align="center"><font size="-4">AN. MENTERI TENAGA KERJA DAN TRANSMIGRASI RI<br/>
					WALIKOTA MEDAN<br/>
					u.b<br/>
					KEPALA DINAS SOSIAL DAN TENAGA KERJA<br/>
					KOTA MEDAN</font></td>
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
				<tr>
					<td width="15%" align="left"><font size="-4">Tembusan :</font></td>
					<td width="30%" align="left"></td>
					<td width="50%" align="center"></td>
				</tr>
				<tr>
					<td width="30%" align="left"><font size="-4">1. Menteri Tenaga Kerja dan Transmigrasi RI</font></td>
					<td width="30%" align="left"></td>
					<td width="40%" align="center"></td>
				</tr>
				<tr>
					<td width="30%" align="left"><font size="-4">2. Walikota Medan</font></td>
					<td width="30%" align="left"></td>
					<td width="40%" align="center"></td>
				</tr>
				<tr>
					<td width="30%" align="left"><font size="-4">3. Dinas Tenaga Kerja dan Transmigrasi Prop. Sumut di Medan</font></td>
					<td width="30%" align="left"></td>
					<td width="40%" align="center"></td>
				</tr>
				<tr>
					<td width="30%" align="left"><font size="-4">4. Arsip</font></td>
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
		$pdf->Output('sk_imta.pdf', 'I');
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
function hari($tgl){
	$tanggal = substr($tgl,8,2);
	return $tanggal;
}
function bln($tgl){
	$tanggal = substr($tgl,5,2);
	return $tanggal;
}
function thn($tgl){
	$tanggal = substr($tgl,0,4);
	return $tanggal;
}

function tgl_biasa($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = substr($tgl,5,2);
			$tahun = substr($tgl,0,4);
			return $tanggal.'-'.$bulan.'-'.$tahun;		 
	}			
function terbilang($bilangan){
 $bilangan = abs($bilangan);

$angka = array("","satu","dua","tiga","empat","lima","enam","tujuh","delapan","sembilan","sepuluh","sebelas");
 $temp = "";

if($bilangan < 12){
 $temp = " ".$angka[$bilangan];
 }else if($bilangan < 20){
 $temp = terbilang($bilangan - 10)." belas";
 }else if($bilangan < 100){
 $temp = terbilang($bilangan/10)." puluh".terbilang($bilangan%10);
 }else if ($bilangan < 200) {
 $temp = " seratus".terbilang($bilangan - 100);
 }else if ($bilangan < 1000) {
 $temp = terbilang($bilangan/100). " ratus". terbilang($bilangan % 100);
 }else if ($bilangan < 2000) {
 $temp = " seribu". terbilang($bilangan - 1000);
 }else if ($bilangan < 1000000) {
 $temp = terbilang($bilangan/1000)." ribu". terbilang($bilangan % 1000);
 }else if ($bilangan < 1000000000) {
 $temp = terbilang($bilangan/1000000)." juta". terbilang($bilangan % 1000000);
 }

return $temp;
}						

?>