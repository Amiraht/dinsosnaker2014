<?php
while (ob_get_level())
ob_end_clean();
header("Content-Encoding: None", true);


$ab = $_GET["link"];
$data=explode("-",$ab);
$jenis_urus = $data[0];
// BUAT QUERY PER JENIS URUS //

//echo $af;
//$take = mysql_query($af);
	$take=mysql_query($qry);


//$tahun=substr(curdate(),0,4);

$baris1="Berdasarkan Undang-Undang No. 13 Tahun 2003 dan Undang-Undang No. 2 Tahun 2004, sehubungan";
$baris2="dengan surat panggilan I Kepala Dinas Sosial dan Tenaga Kerja Kota Medan No. ..../...../DSTKM/".$tahun;
$baris3="1. Perjanjian Kerja.";
$baris4="2. Peraturan Perusahaan / Perjanjian Kerja Bersama.";
$baris5="3. Hasil Perundingan Bipartit.";
$baris6="4. Data-data tenaga kerja yaitu upah, masa kerja dan jabatan.";
$baris7="Demikian disampaikan agar dapat dihadiri.";
$baris8="KEPALA DINAS SOSIAL DAN TENAGA KERJA";
$baris9="KOTA MEDAN";

$baris11="Guna kelancaran perundingan / penyelesaian dimaksud diminta agar saudara hadir tanpa diwakilkan dengan membawa data-data sebagai berikut :";
$baris13="1. Perjanjian Kerja.";
$baris14="2. Peraturan Perusahaan / Perjanjian Kerja Bersama.";
$baris15="3. Hasil Perundingan Bipartit.";
$baris16="4. Data-data tenaga kerja yaitu upah, masa kerja dan jabatan.";
$baris17="Demikian disampaikan agar dapat dihadiri.";
$baris18="KEPALA DINAS SOSIAL DAN TENAGA KERJA";
$baris19="KOTA MEDAN";

$baris20="";
$baris21="";
$baris22="";

$baris23="Tembusan :";
$baris24="Yth. Bapak Walikota Medan";
$baris25="Pertinggal.";

	define('FPDF_FONTPATH','./libraries/font/');
	require('./libraries/fpdf.php');
	class PDF extends FPDF{
		function Header()
		{
			// Logo
			$this->Image('./image/logo.jpg',3,5,17);
			$this->SetFont('Times','B',10);
			// Move to the right
			
			$this->Cell(15);
			$this->Write(1,'PEMERINTAH KOTA MEDAN');
			$this->Ln(3);
			$this->Cell(10);
			$this->Write(1,'DINAS SOSIAL DAN TENAGA KERJA');
			$this->Ln(3);
			$this->Cell(15);
			$this->Write(1,'Jl. K.H. WAHID HASYIM NO. 14');
			$this->Ln(3);
			$this->Cell(25);
			$this->Write(1,'MEDAN - 20145');
			$this->Line(3,27,90,27);
			$this->Ln(15);
		}
		
	}
	$pdf = new PDF();
	$pdf->AddPage();
	$pdf->SetFont('Times','',10);
	$pdf->Cell(8);
	$pdf->write(0,$baris1);
	$pdf->Ln(5);
	$pdf->Cell(10);
	$pdf->write(0,'NOMOR URUT AGENDA  :  ');
	$pdf->Write(0,$baris1);
	$pdf->Ln(10);
	$pdf->Cell(1);
	$pdf->write(0,'TANGGAL                            :  ');
	$pdf->Write(0,$baris1);
	$pdf->Ln(5);
	$pdf->Cell(1);
	$pdf->write(0,'NAMA PERUSAHAAN       :  ');
	$pdf->Write(0,$baris1);
	$pdf->Ln(5);
	$pdf->Cell(1);
	$pdf->write(0,'ALAMAT PERUSAHAAN  :  ');
	$pdf->Write(0,$baris1);
	$pdf->Ln(5);
	$pdf->Cell(1);
	$pdf->write(0,'NAMA PEMILIK                  :  ');
	$pdf->Write(0,$baris1);
	$pdf->Ln(5);
	$pdf->Cell(1);
	$pdf->write(0,'ALAMAT PEMILIK             :  ');
	$pdf->Write(0,$baris1);
	$pdf->Ln(5);
	$pdf->Cell(1);
	$pdf->write(0,'JENIS USAHA                      :  ');
	$pdf->Write(0,$baris1);
	$pdf->Ln(5);
	$pdf->Cell(1);
	$pdf->write(0,'NAMA PEMOHON              :  ');
	$pdf->Write(0,$baris1);
	$pdf->Ln(10);
	$pdf->Cell(40);
	$pdf->SetFont('Times','B',10);
	$pdf->write(0,'PETUGAS LOKET');
	$pdf->Line(45,110,90,110);
	$pdf->Ln(13);
	$pdf->Cell(34);
	$pdf->write(10,$baris1);
	$pdf->Ln(5);
	$pdf->Cell(40);
	$pdf->write(10,$baris1);
	$pdf->Output();	
	
?>