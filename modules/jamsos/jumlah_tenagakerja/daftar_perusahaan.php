<?php
include "./module/header.php";
$id = $_POST["pilih"];
$sumber = $_POST["hidden"];
$y="n";
if ($sumber == 'a')
	{
		$dari = "tbl_perusahaan";
	}
	else if ($sumber == 'b')
	{
		$dari = "db_bppt";
	}
		else if($sumber == 'c')
		{
			$dari = "db_jamsostek";
		} else
			$dari = "";
if($sumber !="")
{	
	$y="y";
	$query = mysql_query("select * from $dari where id_perusahaan = '$id'");
	$query_row=mysql_num_rows($query);
	if($query_row>0)
	{
		while($data=mysql_fetch_array($query))	
			{
				$id=$data[0];
				$a=$data[1];$b=$data[2];$c=$data[3];$d=$data[4];
				$e=$data[5];$f=$data[6];$g=$data[7];$h=$data[8];
				$i=$data[9];$j=$data[10];$k=$data[11];
			}
	}
	
}
echo "	<h1>DAFTAR PERUSAHAAN BARU</h1>
</br></BR>
		<form action='index.php?mod=menu&do=daftar&act=validate' method='post'>
		<table border='0px' width='80%' align='center' style='margin-left:60px;'>
				<tr>
					<td>
						<label>NAMA PERUSAHAAN</label>
					</td>
					<td>
						<input type='text' name='nama' placeholder='' value='$a'>
					</td>
				</tr>
				
				<tr>
					<td>
						<label>ALAMAT</label>
						</td>
					<td>
						<input type='text' name='alamat' placeholder='' value='$b'>
					</td>
				</tr>
				<tr>
					<td>
						<label>NO. TELEPON</label>
						</td>
					<td>
						<input type='text' name='telpon' placeholder='' value='$c'>
					</td>
				</tr>
				<tr>
					<td>
						<label>KODE POS</label>
					</td>
					<td>
						<input type='text' name='kd_pos' placeholder='' value='$d'>
					</td>
				</tr>
				<tr>
					<td>
						<label>JENIS USAHA</label>
					</td>
					<td>
						<input type='text' name='jns_usaha' placeholder='' value='$e'>
					</td>
				</tr>
				<tr>
					<td>
						<label>NAMA PEMILIK</label>
						</td>
					<td>
						<input type='text' name='nm_pem' placeholder='' value='$f'>
					</td>
				</tr>	
				<tr>
					<td>
						<label>ALAMAT PEMILIK</label>
						</td>
					<td>
						<input type='text' name='almt_pem' placeholder='' value='$g'>
					</td>
				</tr>	
				<tr>
					<td>
						<label>NAMA PENGURUS</label>
						</td>
					<td>
						<input type='text' name='nm_pengurus' placeholder='' value='$h'>
					</td>
				</tr>	
				<tr>
					<td>
						<label>ALAMAT PENGURUS</label>
						</td>
					<td>
						<input type='text' name='almt_pengurus' placeholder='' value='$i'>
					</td>
				</tr>
				<tr>
					<td>
						<label>TANGGAL PENDIRIAN</label>
						</td>
					<td>
						<input type='text' name='tgl_diri' placeholder='' value='$j'>
					</td>
				</tr>
				<tr>
					<td>
						<label>NOMOR AKTE PENDIRIAN</label>
						</td>
					<td>
						<input type='text' name='no_akte' placeholder='' value='$k'>
					</td>
				</tr>
				<tr>
					<td>
						<label>STATUS PERUSAHAAN</label>
						</td>
					<td>
						<select name='status_per'>
							<option value='1'>PUSAT</option>
							<option value='2'>CABANG</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<label>STATUS PEMILIK</label>
						</td>
					<td>
						<select name='status_pemilik'>
							<option value='1'>SWASTA</option>
							<option value='2'>PERSERO</option>
							<option value='3'>PATUNG DENGAN ASING</option>
							<option value='4'>ASING</option>
							<option value='5'>PERUM</option>
							<option value='6'>PERUSAHAAN DAERAH</option>
							<option value='7'>YAYASAN</option>
							<option value='8'>KOPERASI</option>
							<option value='9'>PERSEORANGAN</option>
							<option value='10'>BADAN USAHA LAINNYA</option>							
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<label>STATUS PERMODALAN</label>
						</td>
					<td>
						<select name='status_permodalan'>
							<option value='1'>PMDN</option>
							<option value='2'>PMA</option>
							<option value='3'>SWASTA NASIONAL</option>
							<option value='4'>JOINT VENTURE</option>
						</select>
					</td>
				</tr>
";

echo"<tr>
					<td colspan='2'class='clearfix' align='center' style='padding-top:10px;'>
					<input type='hidden' name='hidden4' value='$y' align='right'>
					
						<input type='submit' value='SAVE' class='button3d cyan' style='margin-right:5px;'>
						</form>
					</td>
				</tr>
			</table>
		</div>";
include "./module/footer.php";
?>