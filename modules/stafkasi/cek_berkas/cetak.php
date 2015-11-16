<?php
	while (ob_get_level())
	ob_end_clean();
	
	require_once('./libraries/tcpdf/tcpdf.php');
	include('./libraries/dinsos.php');
	
	$ab = $_GET["link"];
	$userid=$_GET["uid"];
	$data=explode("-",$ab);
	$jenis_urus = $data[0];	
	
	$id_per = anti_injection($_POST["id_per"]);
	$nama_ta = anti_injection($_POST["nama_ta"]);
	$umur = anti_injection($_POST["umur"]);
	$tgl_lahir = anti_injection($_POST["tgl_lahir"]);
	$kewarganegaraan = anti_injection($_POST["kewarganegaraan"]);
	$alamat = anti_injection($_POST["alamat"]);
	$no_pasport = anti_injection($_POST["no_pasport"]);
	$jabatan = anti_injection($_POST["jabatan"]);
	$berlaku_dari = anti_injection($_POST["berlaku_dari"]);
	$berlaku_sampai = anti_injection($_POST["berlaku_sampai"]);
	$no_surat_permohonan = anti_injection($_POST["no_surat_permohonan"]);
	$tgl_berakhir = anti_injection($_POST["tgl_berakhir"]);
	$nama_imta = anti_injection($_POST["nama_imta"]);
	$no_imta = anti_injection($_POST["no_imta"]);
	$tgl_imta = anti_injection($_POST["tgl_imta"]);
	$no_rptka = anti_injection($_POST["no_rptka"]);
	$tgl_rptka = anti_injection($_POST["tgl_rptka"]);
	$tgl_setoran_dpkk = anti_injection($_POST["tgl_setoran_dpkk"]);
	$jlh_setoran_dpkk = anti_injection($_POST["jlh_setoran_dpkk"]);
	

	if($nama_ta == '' or $id_per == '' or $umur == '' or $tgl_lahir == '' or $kewarganegaraan == '' or $alamat == '' or $no_pasport == '' or $jabatan == '' or $berlaku_dari == '' or $berlaku_sampai == '' or $no_surat_permohonan == '' or $tgl_berakhir == '' or $nama_imta == '' or $no_imta == '' or $tgl_imta == '' or $no_rptka == '' or $tgl_rptka == '' or $tgl_setoran_dpkk == '' or $jlh_setoran_dpkk == '' )
	{
	?>
		<script type="text/javascript">
			alert('Isi dengan lengkap !');
			document.location.href='./index.php?mod=stafkasi&opt=cek_berkas';
		</script>
	<?php
	}
	else
	{	
		$qdelete="delete from tbl_berkas_imta_baru where no_resi='$ab'";
		$qinsert="	INSERT INTO tbl_berkas_imta_baru
		(no_resi,tgl_masuk_berkas,id_perusahaan, nama_ta,umur,tgl_lahir,kewarganegaraan,
		alamat,no_passport,jabatan,berlaku_dari,berlaku_sampai,no_surat_permohonan,nama_imta,
		no_imta,tgl_imta,tgl_berakhir,no_rptka,tgl_rptka,tgl_setoran_dpkk,jlh_setoran_dpkk) 
		VALUES 
	
		('$ab',curdate(),'$id_per', '$nama_ta', '$umur','$tgl_lahir',
		 '$kewarganegaraan','$alamat','$no_pasport','$jabatan','$berlaku_dari',
		 '$berlaku_sampai','$no_surat_permohonan','$nama_imta','$no_imta','$tgl_imta',
		 '$tgl_berakhir','$no_rptka','$tgl_rptka','$tgl_setoran_dpkk','$jlh_setoran_dpkk')";
		 
		$a = mysql_query($qdelete);
		$c = mysql_query($qinsert);
		 
		if($c)
		{
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
					<td colspan="2" align="center"><font size="-3">Nomor : ____ /____ /DSTKM/____</font></td>
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
					<td width="50%" align="left"><font size="-4">Pada Tanggal : </font></td>
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
		}
		else
		{
		?>
			<script type="text/javascript">
				alert('gagal !');
				document.location.href='./index.php?mod=stafkasi&opt=cek_berkas';
			</script>
		<?php
		}
	}
?>