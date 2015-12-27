<script type="text/javascript">
	$(document).ready(function(){
		window.print();
	});
</script>
<?php
session_start();
$nama_dinas = "PEMERINTAH KOTA MEDAN";
include("./modules/loket/resi/card/mpdf.php");

$mpdf = new mPDF('c','A4','','',32,25,47,47,10,10,'l'); 

$mpdf->mirrorMargins = 1;	// Use different Odd/Even headers and footers and mirror margins

$mpdf->_setPageSize('l');

// 	query data setting
$no_resi = "";
$tanggal = "";
$pengurusan = "";
$nama_per = "";
$nama_ta = "";
$alamat_per = "";
$jenis_usaha = "";
$alamat_ta = "";

$ab = strip_tags(trim($_GET["id"]));
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

 // mengambil data hasil query
 $set = mysql_fetch_array($take);
$header = '';
$footer = '';
$html = '';

$header .= '
<table width="650px;" style="border-bottom: 4px solid green; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000088;"><tr>
<td width="28%"><span style="font-size:14pt;"><img src="./image/logo.jpg" height="80px" width="90px"></span></td>
<td width="50%" align="center" style="font-family:verdana; font-size:14px; color:black;">'.$nama_dinas.' <br/>
DINAS SOSIAL DAN TENAGA KERJA<br/>
Jl. K.H WAHID HASYIM NO.14<br/>
MEDAN - 20145<br/>
</td>
<td width="28%" style="text-align: right;">&nbsp;&nbsp&nbsp;</td>
</tr></table>
';

$footer .= '<div align="center" style="border-top:4px solid green; width:100%;">Copyright &copy; By DINAS SOSIAL DAN 
			TENAGA KERJA PEMERINTAH KOTA MEDAN.</div>';

$mpdf->SetHTMLHeader($header);
//$mpdf->SetHTMLHeader($headerE,'E');
$mpdf->SetHTMLFooter($footer);
//$mpdf->SetHTMLFooter($footerE,'E');

/* Set Up the Query Variabel */
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

$html .= '
<center><h3>WAJIB LAPOR</h3></center><br/>
<span style="font-family:verdana; font-size:14px;"><center>NO URUT AGENDA&nbsp;&nbsp; : <b>'.$no_resi.'</b></center></span><br/>
<p>
	<table border = "0" cellspacing="15" cellpadding="2" >
		<tr>
			<td>TANGGAL</td>
			<td> : </td>
			<td>'. $tanggal.'</td>
		</tr>
		<tr>
			<td>NAMA PERUSAHAAN</td>
			<td> : </td>
			<td>'. $nama_per .'</td>
		</tr>
		<tr>
			<td>ALAMAT PERUSAHAAN</td>
			<td> : </td>
			<td>' . $alamat_per .'</td>
		</tr>
		<tr>
			<td>NAMA PEMILIK</td>
			<td> : </td>
			<td>' . $nama_pe. '</td>
		</tr>
		<tr>
			<td>ALAMAT PEMILIK</td>
			<td> : </td>
			<td>' . $alamat_pe. '</td>
		</tr>
		<tr>
			<td>JENIS USAHA</td>
			<td> : </td>
			<td>' . $jenis_usaha. '</td>
		</tr>
		<tr>
			<td>NAMA PEMOHON</td>
			<td> : </td>
			<td>' . $nama_ta. '</td>
		</tr>
	</table>
</p><br/><br/>
<span style="float:right; margin-right:7px; padding-right:5px;">
	<span><center>PETUGAS LOKET</center></span>
	<br/><br/><br/><br/><br/><br/>
	<span><center><b>'.$a.'</b></center></span><br/>
	<span><center>( <b>'.$b.'</b> )</center></span></span>
</span>
';

//$mpdf->setDisplayMode('fullwidth','single');
//$mpdf->WriteHTML($html);
	echo ($header . "<br/>");
	echo ($html);
//$output_file = "./modules/loket/resi/card/RESI-NO-".$no_resi.".pdf";
//$mpdf->Output($output_file,'I');
//exit(0);

?>