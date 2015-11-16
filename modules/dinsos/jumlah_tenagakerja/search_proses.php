<?php
	include "./module/header.php";
	?><div id='content'><script>
			$(document).ready(function(){
				$(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
				$(".ajax").colorbox({transition:"none"});				
			});
		</script>
<?php
	$perusahaan ="";
	$perusahaan = $_POST["nama_per"];
	$query=mysql_query("select * from db_jamsostek where nama like '%$perusahaan%'");
	$query_row=mysql_num_rows($query);
	if($query_row>0)
	{
		{
			echo "
				<table border='1' width='100%'>
					<tr style='background:#89AB76'>
						<td width='40%' align='center'>NAMA PERUSAHAAN</td>
						<td width='40%' align='center'>ALAMAT PERUSAHAAN </td>
					</tr>
				";
		}
		while($set=mysql_fetch_array($query))
		{
			
			echo "<tr> 
					<td> <a class='group3' href = 'index.php?mod=menu&do=tenaga_kerja&act=isi&id=$set[0]' > $set[1] </a></td>
					<td> $set[2]</td>
				</tr>";
		}
			
	}
	else
	{			
		echo "<script type='text/javascript'>
				alert('Tidak ada Data Perusahaan');
				document.location = 'index.php?mod=menu&do=tenaga_kerja&act=daftar';
				</script>";
					
	}
	echo "</table></div>";
	include "./module/footer.php";

?>