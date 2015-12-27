<?php
while (ob_get_level())
ob_end_clean();
header("Content-Encoding: None", true);

$no_resi = "";
$catatan = "";

$ab = $_GET["id"];
$data=explode("-",$ab);
$jenis_urus = $data[0];
// BUAT QUERY PER JENIS URUS //

			$qry="SELECT catatan from tbl_info_berkas where no_resi='".$ab."'";

	
//echo $af;
//$take = mysql_query($af);
	$take=mysql_query($qry);

$namaPetugas = mysql_query("select nama,nip from user where id_user = ".$_SESSION['id_user']."");
$nama = mysql_fetch_array($namaPetugas);
$a = $nama[0];	
$b = $nama[1];	
	while($set = mysql_fetch_array($take))
	{
		$no_resi = $ab;

		$catatan = $set[0];
	
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
	$pdf->Ln(5);
	$pdf->Cell(1);
	$pdf->write(0,'CATATAN       :  ');
	$pdf->Write(0,$catatan);
	$pdf->Output();	
	}
if($take)
{
}
else
  //echo $af;
  echo "GAGAL MELAKUKAN QUERY";
 
?>