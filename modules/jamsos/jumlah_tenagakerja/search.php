<?php
	echo "
	<script type='text/javascript' >
	function validasi(av)
	{
		var Check = av.nama_per.value;
			
			if(Check == '' )
			{		
				alert('TOLONG DI ISI TERLEBIH DAHULU');
				return false;
			}
			else
			{return true;}
	}
	</script>";
		echo"<div id='content'><form name='search' action='index.php?mod=menu&do=tenaga_kerja&act=search' method='post'>
			<table width='100%' height='auto' style='margin-top:10%;margin-bottom:20%;'>
				<tr>
					<td><input type='text' placeholder='CARI NAMA PERUSAHAAN' name='nama_per' style='margin-top:-5px;'></td>
				</tr>
				<tr>
					<td width='25%' style='padding-top:10px;'><input type='submit' value='CARI' onclick='return validasi(search)' class='button3d green'></td>
				</tr>
			</table>
			</form>
			</div>	
			";
?>