<?php
	while (ob_get_level())
	ob_end_clean();
	header("Content-Encoding: None", true);
	// Include the main TCPDF library (search for installation path).
	require_once('../../libraries/tcpdf/tcpdf.php');
	include('../../libraries/dinsos.php');
	include "../../include/functions.php";
	include "../../function/fungsi.php";
	
	$get = mysql_real_escape_string($_GET["link"]);
	$resi = base64_decode(base64_decode(base64_decode($get)));
	//arequire_once('tcpdf/tcpdf.php');

	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LEGAL', true, 'UTF-8', false);
	
	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('DINSOSNAKER MEDAN');
	$pdf->SetTitle('LEMBAR DISPOSISI');
	$pdf->SetSubject('LEMBAR DISPOSISI');
	$pdf->SetKeywords('LEMBAR DISPOSISI, MEDAN, DISPOSISI BERKAS , PRINT, DATA SURAT BERKAS');
	
	$pdf->setPrintHeader(false);
	
	// set font
	//$pdf->SetFont('Arial', '', 10);

	// add a page
	$pdf->AddPage();

	// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
	// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

	// create some HTML content
	$atas = '<h2>LEMBAR DISPOSISI</h2>
	      <hr />
	      <br /><br/>
	 ';
	
	//tabel content======================================================================================
	$atas .= "<br/>
			<table border='2'>
			<tr>
				<td width='20'><b>No.</b></td>
				<td width='45'><b>Tanggal</b></td>
				<td><b>Dari</b></td>
				<td><b>Kepada</b></td>
				<td><b>Pesan</b></td>
			</tr>
	";
	
	
	$i=1;
	$d = mysql_query("select * from tbl_info_disposisi where no_resi='".$resi."'");
	
	while($d1 = mysql_fetch_array($d))
	{
		$dari=$d1["dari"];
		$nmpri=mysql_query("select nama from user where id_user='".$dari."'");
		$rnmpri = mysql_fetch_array($nmpri);
		$dari_nama=$rnmpri["nama"];
		
		$dari_lev=$d1["dari_level"];
		$nmpri=mysql_query("select nama_level from tbl_ket_level where id_level='".$dari_lev."'");
		$rnmpri = mysql_fetch_array($nmpri);
		$dari_level=$rnmpri["nama_level"];
		
		
		$tujuan=$d1["tujuan"];
		$nmpri=mysql_query("select nama from user where id_user='".$tujuan."'");
		$rnmpri = mysql_fetch_array($nmpri);
		$tujuan_nama=$rnmpri["nama"];
		
		$tujuan_lev = $d1["tujuan_level"];
		$nmpri = mysql_query("select nama_level from tbl_ket_level where id_level='".$tujuan_lev."'");
		$rnmpri = mysql_fetch_array($nmpri);
		$tujuan_level=$rnmpri["nama_level"];
		//$nmpri=mysql_query("select level from user where id_user='$tujuan'");
		//$rnmpri = mysql_fetch_array($nmpri);
		//$tujuan_level=$rnmpri["level"];
		
		$pesan = $d1["pesan"];
		$atas .= " 
			<tr>
				<td>".$i."</td> 
				<td>".tglindonesia($d1["tgl"])."</td> 
				<td>".$dari_nama."</td> 
				<td>".$tujuan_nama."</td> 
				<td>".$pesan."</td> 
			</tr><br/>	
		";
		
		$i++;
	}
	 
	$atas .= "</table>";

	$html=$atas;
	
	// output the HTML content
	$tes='<b>hai</b>';
	$pdf->writeHTML($html, true, false, true, false, '');
	
	// reset pointer to the last page
	$pdf->lastPage();

	// ---------------------------------------------------------

	//Close and output PDF document
	$pdf->Output('print_lembar_disposisi.pdf', 'I');
?>