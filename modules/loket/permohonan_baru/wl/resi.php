<?php 
/*
"./index.php?mod=loket&opt=proses_permohonan&opts=resi&id='.$no_resi.'"
"./index.php?mod=loket&opt=print_resi&opts=cetak&id='.$no_resi.'"
*/
$no_resi = $_GET["id"];
$data=explode("-",$no_resi);
$jenis_urus = $data[0];

$qas=mysql_query("SELECT no_imta FROM tbl_berkas_imta where no_surat_permohonan='".$_POST["no_surat_permohonan"]."'");
$val=mysql_fetch_row($qas);
			
//if($val){

$say="
	INSERT INTO tbl_berkas_imta
	(no_resi,tgl_masuk_berkas,id_perusahaan, nama_ta,umur,tgl_lahir,kewarganegaraan,
	alamat,no_passport,jabatan,berlaku_dari,berlaku_sampai,no_surat_permohonan,nama_imta,
	no_imta,tgl_imta,tgl_berakhir,no_rptka,tgl_rptka,tgl_setoran_dpkk,jlh_setoran_dpkk) 
	VALUES 
	('".$no_resi."',curdate(), ".$_POST["id_per"].", '".$_POST["nama_ta"]."', ".$_POST["umur"].", '".$_POST["tgl_lahir"]."', '".$_POST["kewarganegaraan"]."',
	'".$_POST["alamat"]."', '".$_POST["no_pasport"]."', '".$_POST["jabatan"]."',
	'".$_POST["berlaku_dari"]."', '".$_POST["berlaku_sampai"]."', '".$_POST["no_surat_permohonan"]."', '".$_POST["nama_imta"]."', '".$_POST["no_imta"]."', 
	'".$_POST["tgl_imta"]."', '".$_POST["tgl_berakhir"]."', '".$_POST["no_rptka"]."', '".$_POST["tgl_rptka"]."', '".$_POST["tgl_setoran_dpkk"]."', ".$_POST["jlh_setoran_dpkk"]." )";
$az = "insert into tbl_info_berkas(no_resi,jenis_pengurusan,id_proses_skrg,id_proses_sblm,isValid,isDisposisi)
		values
	('$no_resi','$jenis_urus','31','30','1','3')";


$bz=mysql_query($az);
$sql = mysql_query($say);
/*
}

else 
{
	echo "<script type='text/javascript'>
				alert('DATA BERKAS GAGAL DITAMBAHKAN A');
				document.location.href='index.php?mod=loket&opt=proses_permohonan&opts=baru';
		</script>";
}*/
if($bz)
{

$query = mysql_query("SELECT
						a.no_resi,
						b.tgl_masuk_berkas AS tgl_imta,
						c.tgl_masuk_berkas AS tgl_pengaduan,
						f.pengurusan,
						d.nama AS nama_perusahaan_imta, 
						e.nama AS nama_perusahaan_pengaduan,
						b.nama_ta AS nama_imta, 
						c.nama AS nama_pengaduan,
						b.alamat, c.alamat,
						d.alamat, e.alamat
					FROM
						tbl_info_berkas a
					LEFT JOIN tbl_berkas_imta b ON a.no_resi = b.no_resi
					LEFT JOIN tbl_berkas_pengaduan c ON a.no_resi = c.no_resi
					LEFT JOIN db_dinsos d ON b.id_perusahaan = d.id_perusahaan
					LEFT JOIN db_dinsos e ON c.id_perusahaan = e.id_perusahaan
					INNER JOIN tbl_pengurusan f ON a.jenis_pengurusan = f.id_pengurusan
					where a.no_resi = '$no_resi' ");
				
$set = mysql_fetch_array($query);
?>
<script language="javascript"> 
	function selesai(){
	s='./index.php?mod=loket&opt=main';
		document.location.href=s;
	}
</script>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
<tr >
    <td colspan="2"><div id='header' style='background:url(./image/coba/header2.png) no-repeat;'> 
      <table border="0" id='atasan'">
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00; href="#">PERMOHONAN BARU - IMTA</a></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;">
				  <img src="./image/panah.gif"  /><a href="./index.php?mod=loket&opt=main" id="linkutama"> BERANDA LOKET</a> 
				  <img src="./image/panah.gif"  /> <a href="./index.php?mod=loket&opt=proses_permohonan" id="linkutama"> PROSES PERMOHONAN DAN PRINT RESI </a>
				  <img src="./image/panah.gif"  /><span id="linkutama"> PROSES PENGURUSAN IMTA</span>
                 </td>
                <td style="float:right;">
					<img width="90" height="29" 
						onclick="document.location.href='./index.php?mod=loket&opt=main'" 
						onmouseout="this.src='./image/button/KEMBALI.gif'" 
						onmouseover="this.src='./image/button/KEMBALI2.gif'" 
						src="./image/button/KEMBALI.gif">
					</img>
    			</td>
            </tr>
        </table> 
    </div>
    </td>
</tr>
<tr>
	<td>
		<fieldset>
		<legend>PRINT RESI</legend>
		<form method="post" action="./index.php?mod=loket&opt=print_resi&opts=cetak&id=<?php echo $no_resi; ?>" target="_blank" >
		<table>
			<tr>
				<td>NOMOR RESI</td>
				<td>&nbsp; &nbsp; &nbsp;: &nbsp;&nbsp;</td>
				<td><?php echo $no_resi; ?></td>
			</tr>
			<tr>
				<td>TANGGAL MASUK</td>
				<td>&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;</td>
				<td><?php 
				if($set[1]!=''){ echo	$set[1];}
					else if($set[2]!=''){  echo	$set[2];}
				?>
				</td>
			</tr>
			<tr>
				<td>JENIS PENGGURUSAN</td>
				<td>&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;</td>
				<td> <?php echo $set[3];?></td>
			</tr>
			<tr>
				<td>PERUSAHAAN</td>
				<td>&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;</td>
				<td> 
				<?php
				
				if($set[4]!=''){
					 echo $set[4];}
					else if($set[5]!=''){
					 echo $set[5];}
				?>
				
				</td>
			</tr>
			<tr>
				<td>PEMOHON</td>
				<td>&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;</td>
				<?php 
				if($set[6]!=''){
					 echo	"<td> $set[6]</td>";}
					else if($set[7]!=''){
					 echo	"<td> $set[7]</td>";}

				?> 
			</tr>
			<tr>
				<td>ALAMAT PERUSAHAAN</td>
				<td>&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;</td>
				<?php
				if($set[6]!=''){
					 echo	"<td> $set[8]</td>";}
					else if($set[7]!=''){
					 echo	"<td> $set[9]</td>";}
				?>
			</tr>
			<tr>
				<td>ALAMAT PEMOHON</td>
				<td>&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;</td>
				<?php
				if($set[6]!=''){
					 echo	"<td> $set[10]</td>";}
					else if($set[7]!=''){
					 echo	"<td> $set[11]</td>";}
				?>
			</tr>
		</table>
		<center>
		<input type="submit" value="CETAK">
		<input type="button" onClick="selesai()" value="SELESAI">
		</center>
		</form>
		</fieldset>
	</td>
</tr>
  <tr>
  	<td colspan="2"><div id='footer'  style='background:url(./image/coba/footer.png) no-repeat; height:80px; margin-left:8px;'></div>
    </td>
  </tr>
</table>

<?php } ?>