<?php
	while (ob_get_level())
	ob_end_clean();
	header("Content-Encoding: None", true);
	// Include the main TCPDF library (search for installation path).
	require_once('./libraries/tcpdf/tcpdf.php');
	include('./libraries/dinsos.php');
	
	$id = $_GET['id_p'];
	$sumber = $_GET['sumber'];
		
	if($sumber=='DINSOSNAKER')
	{
	$perusahaan = "
							SELECT
									a.id_perusahaan, a.nama, a.alamat,
									a_k.kecamatan, a_kel.kelurahan,
									a.telpon, a.kode_pos,
									a.nomor_akte,a.tgl_pendirian, 
									a_j.jenis, a_s.status,
									a.nama_pemilik,a.alamat_pemilik ,a.nama_pengurus, a.alamat_pengurus,
									a_m.status,a_mod.modal,
									a_tbl.wnilk, a_tbl.wnipr, a_tbl.wnalk, a_tbl.wnapr, 
									a.klui
								FROM
									db_dinsos a
									LEFT JOIN t_jenis_usaha a_j ON a.jenis_usaha = a_j.id_jenis_usaha
									LEFT JOIN t_status_milik a_m ON a.id_status_pemilik = a_m.id_status
									LEFT JOIN t_status_modal a_mod ON a.id_status_permodalan = a_mod.id_status
									LEFT JOIN t_status a_s ON a.id_status_perusahaan = a_s.id_status
									LEFT JOIN t_kecamatan a_k ON a.kec = a_k.id_kecamatan
									LEFT JOIN t_kelurahan a_kel ON a.kel = a_kel.id_kelurahan
									LEFT JOIN tbl_tenagakerja_jamsos a_tbl ON a.id_perusahaan = a_tbl.id_perusahaan
								WHERE
									a.id_perusahaan = '$id'
							";
	}
	if($sumber=='BPPT')
	{
		$perusahaan="SELECT 
						a.id,a.nama, a.alamat, b.kecamatan, c.kelurahan,  
						a.notelp, a.kodepos, a.no_akte, a.tgl_akte, 
						 e.`status`,  a.`status` as 'Status Perusahaan', 
						a.pemohon, a.tempat1, a.pengurus, a.tempat2, 
						a.status_milik,a.status_modal,
						'-' as wnilk, '-' as wnipr, '-' as wnalk, '-' as wnapr,
						d.nama_bagian as klui
						FROM bppt a 
						LEFT JOIN t_kecamatan b on a.kecamatan = b.id_kecamatan 
						LEFT JOIN t_kelurahan c ON a.kelurahan = c.id_kelurahan
						LEFT JOIN kbli d ON a.klui = d.kode_bagian 
						LEFT JOIN t_status e ON a.`status` = e.id_status	 
						WHERE a.id=$id";
	}
	
	$data =mysql_query($perusahaan);
	
	$set = mysql_fetch_array($data);	

	//arequire_once('tcpdf/tcpdf.php');

	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LEGAL', true, 'UTF-8', false);
	
	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('DINSOSNAKER MEDAN');
	$pdf->SetTitle('DATA PERUSAHAAN');
	$pdf->SetSubject('DATA PERUSAHAAN');
	$pdf->SetKeywords('DATA PERUSAHAAN, MEDAN, DATA PERUSAHAAN, PRINT, DATA PERUSAHAAN');
	
	$pdf->setPrintHeader(false);
	
	// set font
	//$pdf->SetFont('Arial', '', 10);

	// add a page
	$pdf->AddPage();

	// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
	// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

	// create some HTML content
	$atas='<table width="100%" border="0" align="center" cellpadding="5" cellspacing="2" >
	  <tr>
	    <td align="left" colspan="3"><h2>DATA PERUSAHAAN</h2>
	      <hr />
	      <br /></td>		
      </tr>
	  <tr>
	    <td width="30%" align="left">NAMA PERUSAHAAN</td>
	    <td width="7%">:</td>
	    <td align="left" width="63%">'. $set[1].'</td>
      </tr>
	  <tr>
	    <td width="30%" align="left">ALAMAT</td>
	    <td>:</td>
	    <td align="left" width="63%" >'. $set[2].'</td>
      </tr>
	  <tr>
	    <td width="30%" align="left">KECAMATAN</td>
	    <td>:</td>
	    <td align="left" width="63%">'. $set[3].'</td>
      </tr>
	  <tr>
	    <td width="30%" align="left">KELURAHAN</td>
	    <td>:</td>
	    <td align="left" width="63%">'. $set[4].'</td>
      </tr>
	  <tr>
	    <td width="30%" align="left">No. TELEPON</td>
	    <td>:</td>
	    <td align="left" width="63%">'. $set[5].'</td>
      </tr>
	  <tr>
	    <td width="30%" align="left">KODE POS</td>
	    <td>:</td>
	    <td align="left" width="63%">'. $set[6].'</td>
      </tr>
	  <tr>
	    <td width="30%" align="left">NO AKTE PENDIRIAN</td>
	    <td width="7%">:</td>
	    <td align="left" width="63%">'. $set[7].'</td>
      </tr>
	  <tr>
	    <td width="30%" align="left">TANGGAL PENDIRIAN</td>
	    <td>:</td>
	    <td align="left" width="63%">'. $set[8].'</td>
      </tr>
	  <tr>
	    <td width="30%" align="left">JENIS USAHA</td>
	    <td>:</td>
	    <td align="left" width="63%">'. $set[9].'</td>
      </tr>
	  <tr>
	    <td width="30%" align="left">STATUS USAHA</td>
	    <td>:</td>
	    <td align="left" width="63%">'. $set[10].'</td>
      </tr>
	  <tr>
	    <td width="30%" align="left">KLUI</td>
	    <td>:</td>
	    <td align="left" width="63%">'. $set[21].'</td>
      </tr>
	  <tr>
	    <td align="left" colspan="3"><h2>DATA KEPEMILIKAN</h2>
	      <hr />
	      <br /></td>
      </tr>
	  <tr>
	    <td width="30%" align="left">PEMILIK</td>
	    <td>:</td>
	    <td align="left" width="63%">'. $set[11].'</td>
      </tr>
	  <tr>
	    <td width="30%" align="left">ALAMAT PEMILIK</td>
	    <td>:</td>
	    <td align="left" width="63%">'. $set[12].'</td>
      </tr>
	  <tr>
	    <td width="30%" align="left">PENGURUS</td>
	    <td>:</td>
	    <td align="left" width="63%">'. $set[13].'</td>
      </tr>
	  <tr>
	    <td width="30%" align="left">ALAMAT PENGURUS</td>
	    <td>:</td>
	    <td align="left" width="63%">'. $set[14].'</td>
      </tr>
	  <tr>
	    <td width="30%" align="left">STATUS PEMILIK</td>
	    <td width="7%">:</td>
	    <td align="left" width="63%">'. $set[15].'</td>
      </tr>
	  <tr>
	    <td width="30%" align="left">STATUS PERMODALAN</td>
	    <td>:</td>
	    <td align="left" width="63%">'. $set[16].'</td>
      </tr>
      <tr>
	    <td align="left" colspan="3">
	      <h2>DATA TENAGA KERJA</h2>
	      <hr />
          
	      <br /></td>
      </tr>
	  <tr>
	    <td width="30%" align="left">T.K WNI PRIA</td>
	    <td>:</td>
	    <td align="left" width="63%">'. $set[17].'</td>
      </tr>
	  <tr>
	    <td width="30%" align="left">T.K WNI WANITA</td>
	    <td>:</td>
	    <td align="left" width="63%">'. $set[18].'</td>
      </tr>
	  <tr>
	    <td width="30%" align="left">T.K WNA PRIA</td>
	    <td>:</td>
	    <td align="left" width="63%">'. $set[19].'</td>
      </tr>
	  <tr>
	    <td width="30%" align="left">T.K WNA WANITA</td>
	    <td>:</td>
	    <td align="left" width="63%">'. $set[20].'</td>
      </tr>';

	$html=$atas;
	
	// output the HTML content
	$tes='<b>hai</b>';
	$pdf->writeHTML($html, true, false, true, false, '');
	
	// reset pointer to the last page
	$pdf->lastPage();

	// ---------------------------------------------------------

	//Close and output PDF document
	$pdf->Output('cetak_perusahaan.pdf', 'I');
?>