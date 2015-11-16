<?php
include "../../../libraries/dinsos.php";
$no_resi = $_GET["link"];
$judul1 = trim(str_replace('<,>,*', '', $_POST["nama"]));
$judul = trim(str_replace(' ', '_', $judul1));
$file = $_FILES["file"];

$mode=$_GET["act"];


if($no_resi <> '' and $judul <> '')
{
	if($mode==1)
	{
		if($_FILES["file"]["size"] > 1500000)
		{
		?>
			<script type="text/javascript">
				alert('Gagal Menambah  Karena Ukuran File Terlalu Besar \n\nSolusi: \nKompress ukuran file dengan winzip atau winrar');
				document.location = "./index.php?link=<?php echo $no_resi; ?>";
			</script>
		<?php
			exit();
		}
		
		if($judul == '' || $file == '')
		{
		?>
		<script type="text/javascript">
			alert ('Isi Form Dengan Lengkap');
			document.location = "./index.php?link=<?php echo $no_resi; ?>";
		</script>
		<?php
		}
		else
		{
			$nm = str_replace(' ', '_', $_FILES['file']['name']);
			$nama = date("d-m-Y").'-'.$judul.'-'.$nm;
			$filesementara = $_FILES["file"]["tmp_name"];
			$path =  "../../../file_lap/".$nama;
	
			if(move_uploaded_file($filesementara, $path))
			{
				$tambah_type = mysql_query("insert into tbl_hasil_lap (judul, no_resi, file, tanggal) values('$judul', '$no_resi', '$nama', '".date("Y-m-d")."')");
				if(!tambah_type)
				{
				?>
				<script type="text/javascript">
					alert('Gagal Menambah File ');
					document.location = "./index.php?link=<?php echo $no_resi; ?>";
				</script>
				<?php
				}
				else
				{
				?>
				<script type="text/javascript">
					alert('Berhasil Menambah File ');
					document.location = "./index.php?link=<?php echo $no_resi; ?>";
				</script>
				<?php
				}
			}
		}
	}
	else
	{
	
		if(!empty($_GET["link"]))
		{
			$q3 = mysql_query("select * from tbl_hasil_lap where no_resi='".$_GET["link"]."'");
			$q31 = mysql_fetch_array($q3);
			
			if(!empty($_FILES["file"]["name"]))
			{
				if($_FILES["file"]["size"] > 1500000)
				{
				?>
					<script type="text/javascript">
						alert('Gagal Menambah  Karena Ukuran File Terlalu Besar \n\nSolusi: \nKompress ukuran file dengan winzip atau winrar');
						document.location = "./index.php?link=<?php echo $no_resi; ?>";
					</script>
				<?php
					exit();
				}
		
				$nama = date("d-m-Y").'-'.$judul.'-'.$_FILES["file"]["name"];
				$filesementara = $_FILES["file"]["tmp_name"];
				$path = "../../../file_lap/";
				unlink($path.$q31["file"]);
				
				if(move_uploaded_file($filesementara, $path.$nama))
					$edit = mysql_query("update tbl_hasil_lap set judul='".$judul."', file='".$nama."' where no_resi='".$_GET["link"]."'");	
			}
			else
			{
				$edit = mysql_query("update tbl_hasil_lap set judul='".$judul."' where no_resi='".$_GET["link"]."'");
			}		
	
			if($edit)
			{
			?>
			   <script type="text/javascript">
				  alert('Berhasil Mengubah File ');
				  document.location = "./index.php?link=<?php echo $no_resi; ?>";
			   </script>
			<?php
			}
			else
			{
			?>
				<script type="text/javascript">
					alert('Gagal Mengubah File ');
					document.location = "./index.php?link=<?php echo $no_resi; ?>";
				</script>
			<?php
			}
			
		}
	
	}

}
?>


