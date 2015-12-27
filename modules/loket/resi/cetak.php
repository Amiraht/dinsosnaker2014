<?php
while (ob_get_level())
ob_end_clean();
header("Content-Encoding: None", true);

$no_resi = "";
$tanggal = "";
$pengurusan = "";
$nama_per = "";
$nama_ta = "";
$alamat_per = "";
$jenis_usaha = "";
$alamat_ta = "";

$ab = mysql_real_escape_string(strip_tags(trim($_GET["id"])));
$data = explode("-",$ab);
$jenis_urus = $data[0];
// BUAT QUERY PER JENIS URUS //
if ($jenis_urus == '01')
	{ 
			$qry="SELECT a.tgl_masuk_berkas,c.pengurusan,d.nama,d.alamat,d.nama_pemilik,d.alamat_pemilik,e.jenis,a.pemohon,a.alamatpemohon FROM
			 tbl_berkas_wl a
			 INNER JOIN tbl_info_berkas b ON b.no_resi= a.no_resi 
			 INNER JOIN tbl_pengurusan c ON c.id_pengurusan=b.jenis_pengurusan
			 INNER JOIN db_dinsos d ON d.id_perusahaan=a.id_perusahaan
			 INNER JOIN t_jenis_usaha e ON e.id_jenis_usaha=d.jenis_usaha WHERE a.no_resi='".$ab."'";
	}
else if($jenis_urus == '02')
	{
		 $tbl = "b.tgl_masuk_berkas AS tgl_imta,
		 		 f.pengurusan,
				 d.nama AS nama_perusahaan_imta,
				 d.alamat,
				 d.nama_pemilik,d.alamat_pemilik,
				 e.jenis,
				 b.nama_ta AS nama_imta,
				 b.alamat";
				  
		  $qry = "SELECT
				 ".$tbl."	
				 FROM
				 tbl_info_berkas a
				 LEFT JOIN tbl_berkas_imta b ON a.no_resi = b.no_resi
				 LEFT JOIN tbl_berkas_pengaduan c ON a.no_resi = c.no_resi
				 LEFT JOIN db_dinsos d ON b.id_perusahaan = d.id_perusahaan
				 LEFT JOIN t_jenis_usaha e ON d.jenis_usaha = e.id_jenis_usaha 
				 INNER JOIN tbl_pengurusan f ON a.jenis_pengurusan = f.id_pengurusan
				 where a.no_resi = '$ab' ";
	}
else if($jenis_urus == '03')

	{
		$qry="SELECT a.tgl_masuk_berkas,c.pengurusan,d.nama,d.alamat,d.nama_pemilik,d.alamat_pemilik,e.jenis,a.nama,a.alamat FROM
			 tbl_berkas_pengaduan a
			 INNER JOIN tbl_info_berkas b ON b.no_resi= a.no_resi 
			 INNER JOIN tbl_pengurusan c ON c.id_pengurusan=b.jenis_pengurusan
			 INNER JOIN db_dinsos d ON d.id_perusahaan=a.id_perusahaan
			 INNER JOIN t_jenis_usaha e ON e.id_jenis_usaha=d.jenis_usaha WHERE a.no_resi='".$ab."'";
	}
else if($jenis_urus == '04')

	{
		$qry="SELECT a.tgl_masuk_berkas,c.pengurusan,d.nama,d.alamat,d.nama_pemilik,d.alamat_pemilik,e.jenis,a.nama_pemohon,a.alamat_pemohon FROM
			 tbl_berkas_janji a
			 INNER JOIN tbl_info_berkas b ON b.no_resi= a.no_resi 
			 INNER JOIN tbl_pengurusan c ON c.id_pengurusan=b.jenis_pengurusan
			 INNER JOIN db_dinsos d ON d.id_perusahaan=a.id_perusahaan
			 INNER JOIN t_jenis_usaha e ON e.id_jenis_usaha=d.jenis_usaha WHERE a.no_resi='".$ab."'";
	}
else if($jenis_urus == '05')

	{
		$qry="SELECT a.tgl_masuk_berkas,c.pengurusan,d.nama,d.alamat,d.nama_pemilik,d.alamat_pemilik,e.jenis,a.nama_pemohon,a.alamat_pemohon FROM
			 tbl_berkas_sah a
			 INNER JOIN tbl_info_berkas b ON b.no_resi= a.no_resi 
			 INNER JOIN tbl_pengurusan c ON c.id_pengurusan=b.jenis_pengurusan
			 INNER JOIN db_dinsos d ON d.id_perusahaan=a.id_perusahaan
			 INNER JOIN t_jenis_usaha e ON e.id_jenis_usaha=d.jenis_usaha WHERE a.no_resi='".$ab."'";
	}
	
else if($jenis_urus == '06')

	{
		$qry="SELECT a.tgl_masuk_berkas,c.pengurusan,d.nama,d.alamat,d.nama_pemilik,d.alamat_pemilik,e.jenis,a.nama_pemohon,a.alamat_pemohon FROM
			 tbl_berkas_iplk a
			 INNER JOIN tbl_info_berkas b ON b.no_resi= a.no_resi 
			 INNER JOIN tbl_pengurusan c ON c.id_pengurusan=b.jenis_pengurusan
			 INNER JOIN db_dinsos d ON d.id_perusahaan=a.id_perusahaan
			 INNER JOIN t_jenis_usaha e ON e.id_jenis_usaha=d.jenis_usaha WHERE a.no_resi='".$ab."'";
	}	
//echo $af;
//$take = mysql_query($af);
	$take = mysql_query($qry) or die(mysql_error());

$namaPetugas = mysql_query("select nama,nip from user where id_user = ".$_SESSION['id_user']."") or die(mysql_error());
$nama = mysql_fetch_array($namaPetugas);
$a = $nama[0];	
$b = $nama[1];	
	while($set = mysql_fetch_array($take))
	{
		$no_resi = $ab;

		$tanggal = $set[0];
		$pengurusan = $set[1];
		$nama_per = $set[2];
		$alamat_per = $set[3];
		$nama_pe = $set[4];
		$alamat_pe = $set[5];		
		$jenis_usaha = $set[6];
		$nama_ta = $set[7];	
		$alamat_ta = $set[8];

		
/*		$tanggal = $set[1];
		$pengurusan = $set[2];
		$nama_per = $set[3];
		$nama_ta = $set[4];
		$alamat_per = $set[5];
		$jenis_usaha = $set[6];
		$alamat_ta = $set[7];
		$nama_pe = $set[8];
		$alamat_pe = $set[9];
*/	
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
	
	if($jenis_urus=='02')
	{
		$pdf->Cell(24);
		$pdf->write(0,$pengurusan);	
	}
	if($jenis_urus=='01')
	{
		$pdf->Cell(22);
		$pdf->write(0,$pengurusan);	
	}
	else
	{
		$pdf->Cell(8);
		$pdf->write(0,$pengurusan);		
	}
	$pdf->Ln(5);
	$pdf->Cell(10);
	$pdf->write(0,'NOMOR URUT AGENDA  :  ');
	$pdf->Write(0,$no_resi);
	$pdf->Ln(10);
	$pdf->Cell(1);
	$pdf->write(0,'TANGGAL                            :  ');
	$pdf->Write(0,$tanggal);
	$pdf->Ln(5);
	$pdf->Cell(1);
	$pdf->write(0,'NAMA PERUSAHAAN       :  ');
	$pdf->Write(0,$nama_per);
	$pdf->Ln(5);
	$pdf->Cell(1);
	$pdf->write(0,'ALAMAT PERUSAHAAN  :  ');
	$pdf->Write(0,$alamat_per);
	$pdf->Ln(5);
	$pdf->Cell(1);
	$pdf->write(0,'NAMA PEMILIK                  :  ');
	$pdf->Write(0,$nama_pe);
	$pdf->Ln(5);
	$pdf->Cell(1);
	$pdf->write(0,'ALAMAT PEMILIK             :  ');
	$pdf->Write(0,$alamat_pe);
	$pdf->Ln(5);
	$pdf->Cell(1);
	$pdf->write(0,'JENIS USAHA                      :  ');
	$pdf->Write(0,$jenis_usaha);
	$pdf->Ln(5);
	$pdf->Cell(1);
	$pdf->write(0,'NAMA PEMOHON              :  ');
	$pdf->Write(0,$nama_ta);
	$pdf->Ln(10);
	$pdf->Cell(40);
	$pdf->SetFont('Times','B',10);
	$pdf->write(0,'PETUGAS LOKET');
	$pdf->Line(45,110,90,110);
	$pdf->Ln(13);
	$pdf->Cell(34);
	$pdf->write(10,$a);
	$pdf->Ln(5);
	$pdf->Cell(40);
	$pdf->write(10,$b);
	$pdf->Output();	
	}
if($take)
{
}
else{
  //echo $af;
  echo "GAGAL MELAKUKAN QUERY";
 } 
 
?>