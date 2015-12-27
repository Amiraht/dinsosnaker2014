<?php
$nama = "Mathematics Science Competitions";
include("mpdf.php");

$mpdf=new mPDF('c','A4','','',32,25,47,47,10,10); 

$mpdf->mirrorMargins = 1;	// Use different Odd/Even headers and footers and mirror margins

$header = '
<table width="100%" style="border-bottom: 1px solid #000000; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000088;"><tr>
<td width="33%"><span style="font-size:14pt;">MSC</span></td>
<td width="33%" align="center">'.$nama.'</td>
<td width="33%" style="text-align: right;"><span style="font-weight: bold;">{PAGENO}</span></td>
</tr></table>
';
$headerE = '
<table width="100%" style="border-bottom: 1px solid #000000; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000088;"><tr>
<td width="33%"><span style="font-weight: bold;">MSC</span></td>
<td width="33%" align="center">'.$nama.'</td>
<td width="33%" style="text-align: right;"><span style="font-size:14pt;">{PAGENO}</span></td>
</tr></table>
';

$footer = '<div align="center">See <a href="http://mpdf1.com/manual/index.php">documentation manual</a></div>';
$footerE = '<div align="center">See <a href="http://mpdf1.com/manual/index.php">documentation manual</a></div>';


$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLHeader($headerE,'E');
$mpdf->SetHTMLFooter($footer);
$mpdf->SetHTMLFooter($footerE,'E');


$html = '
<center><h1>FORMULIR REGISTRASI PESERTA LOMBA VIDEO LAGU</h1></center>
<h3>Harap Dicetak dan diberikan kepada panitia sebagai bukti sah registrasi..</h3>
<p>
	<table border = "0" cellspacing="5" cellpadding="2">
		<tr>
			<td>ID TIM</td>
			<td> : </td>
			<td>1234567WQE</td>
		</tr>
		<tr>
			<td>Nama TIM</td>
			<td> : </td>
			<td>Buluh Perinduh</td>
		</tr>
		<tr>
			<td>Asal Sekolah</td>
			<td> : </td>
			<td>SMA Negri 1 Medan</td>
		</tr>
		<tr>
			<td>Judul Lagu</td>
			<td> : </td>
			<td>Epen Kah Cupen Toh</td>
		</tr>
		<tr>
			<td>Email</td>
			<td> : </td>
			<td>msuryansah@gmail.com</td>
		</tr>
	</table>
</p>
<pagebreak />
<fieldset>
	<legend>Anggota 1</legend>
	<table border = "0" cellspacing="5" cellpadding="2">
		<tr>
			<td>Nama Peserta</td>
			<td> : </td>
			<td>Surya Manik</td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td> : </td>
			<td>Jl.Maluku No.10 A,Medan</td>
		</tr>
		<tr>
			<td>Tempat/Tanggal Lahir</td>
			<td> : </td>
			<td>Medan, 8 oktober 1992</td>
		</tr>
		<tr>
			<td>No.Hp/Telp</td>
			<td> : </td>
			<td>087868354751</td>
		</tr>
		<tr>
			<td>Email</td>
			<td> : </td>
			<td>msuryansah@gmail.com</td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td> : </td>
			<td>Jl.Rajawali, Medan</td>
		</tr>
		<tr>
			<td>Status</td>
			<td> : </td>
			<td><b>anggota</b></td>
		</tr>
	</table>
</fieldset>
';

$mpdf->WriteHTML($html);

$mpdf->Output('registration_video_card.pdf','I');
exit;

?>