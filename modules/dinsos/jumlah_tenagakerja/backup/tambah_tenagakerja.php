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
	$a = mysql_query("select * from tbl_tenagakerja where id_perusahaan = $id");
	$ab=mysql_num_rows($a);
	if($ab>0){$y="y";}
	$query = mysql_query("select * from $dari where id_perusahaan = '$id'");
	$query_row=mysql_num_rows($query);
	if($query_row>0)
	{
		while($data=mysql_fetch_array($query))	
			{
				$id=$data[0];$a=$data[1];
			}
	}
		echo "	<h1>PENGISIAN JUMLAH TENAGA KERJA</h1>
		</br></BR>
		<form action='index.php?mod=menu&do=tenaga_kerja&act=validate' method='post'>
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
						<label>TENAGA KERJA WNI PRIA</label>
					</td>
					<td>
						<input type='text' name='wnilk' placeholder=''>
					</td>
				</tr>
				<tr>
					<td>
						<label>TENAGA KERJA WNI PEREMPUAN</label>
					</td>
					<td>
						<input type='text' name='wnipr' placeholder=''>
					</td>
				</tr>
				<tr>
					<td>
						<label>TENAGA KERJA WNA PRIA</label>
					</td>
					<td>
						<input type='text' name='wnalk' placeholder=''>
					</td>
				</tr>
				<tr>
					<td>
						<label>TENAGA KERJA WNA PEREMPUAN</label>
					</td>
					<td>
						<input type='text' name='wnapr' placeholder=''>
					</td>
				</tr>
			<tr>
					<td colspan='2'class='clearfix' align='center' style='padding-top:10px;'>
					<input type='hidden' name='hidden' value='$y' align='right'>
					<input type='hidden' name='hidden3' value='$sumber' align='right'>
					<input type='hidden' name='hidden2' value='$id' align='right'>
						<input type='submit' value='SAVE' class='button3d cyan' style='margin-right:5px;'>
						</form>
					</td>
				</tr>
			</table>
		</div>";	
	
}

include "./module/footer.php";
?>