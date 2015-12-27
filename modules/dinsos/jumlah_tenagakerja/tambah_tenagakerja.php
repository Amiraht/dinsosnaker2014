<?php
require_once("../../../../libraries/dinsos.php");
$id = $_GET["id"];

if($id !="")
{	
	$a = mysql_query("select * from tbl_tenagakerja where id_perusahaan = $id");
	$ab = mysql_num_rows($a);
	if($ab>0){
	$y="y";
		while($isi=mysql_fetch_array($a)){
		$b=$isi[2];
		$c=$isi[3];
		$d=$isi[4];
		$e=$isi[5];
		}
	}
	
	$query = mysql_query("select nama from db_jamsostek where id_perusahaan = '$id'");
	$query_row = mysql_num_rows($query);
	if($query_row>0)
	{
		while($data=mysql_fetch_array($query))	
			{
				$ac=$data[0];
			}
	}
		echo "<div>PENGISIAN JUMLAH TENAGA KERJA
		</br></BR>
		<form action='./tambah_proses.php' method='post'>
		<table border='0px' width='90%'>
				<tr>
					<td>
						<label>NAMA PERUSAHAAN</label>
					</td>
					<td>:</td>
					<td>
						<input type='text' name='nama' placeholder='' value='$ac'>
					</td>
				</tr>
				<tr>
					<td>
						<label>TENAGA KERJA WNI PRIA</label>
					</td>
					<td>:</td>
					<td>
						<input type='text' name='wnilk' placeholder='' value='$b'>
					</td>
				</tr>
				<tr>
					<td>
						<label>TENAGA KERJA WNI PEREMPUAN</label>
					</td>
					<td>:</td>
					<td>
						<input type='text' name='wnipr' placeholder='' value='$c'>
					</td>
				</tr>
				<tr>
					<td>
						<label>TENAGA KERJA WNA PRIA</label>
					</td>
					<td>:</td>
					<td>
						<input type='text' name='wnalk' placeholder='' value='$d'>
					</td>
				</tr>
				<tr>
					<td>
						<label>TENAGA KERJA WNA PEREMPUAN</label>
					</td>
					<td>:</td>
					<td>
						<input type='text' name='wnapr' placeholder='' value='$e'>
					</td>
				</tr>
			<tr>
					<td colspan='2'class='clearfix' align='center' style='padding-top:10px;'>
					<input type='hidden' name='hidden' value='$y' align='right'>
					<input type='hidden' name='hidden2' value='$id' align='right'>
						<input type='submit' value='SAVE' style='margin-right:5px;'>
						</form>
					</td>
				</tr>
			</table>
		</div>
";	
	
}else
echo "ACCESS DENIED";

?>