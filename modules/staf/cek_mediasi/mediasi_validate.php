<?php
include "../../../libraries/dinsos.php";
$resi = $_GET["link"];
$dari = $_GET["id_user"];
$hasil = $_POST["hasil"];
$file = $_FILES["file"];
$judul = trim(str_replace('<,>,*', '', $_POST["hasil"]));
$keterangan = $_POST["keterangan"];


		if(!empty($_GET["link"]))
		{
			$q3 = mysql_query("select * from tbl_berkas_pengaduan where no_resi='".$_GET["link"]."'");
			$q31 = mysql_fetch_array($q3);
			
			if(!empty($_FILES["file"]["name"]))
			{
				if($_FILES["file"]["size"] > 1500000)
				{
				?>
					<script type="text/javascript">
						alert('Gagal Menambah  Karena Ukuran File Terlalu Besar \n\nSolusi: \nKompress ukuran file dengan winzip atau winrar');
						document.location = "./edit.php?link=<?php echo $resi; ?>&id_user=<?php echo $dari; ?>";
					</script>
				<?php
					exit();
				}
		
				$nama = date("d-m-Y").'-'.$judul.'-'.$_FILES["file"]["name"];
				$filesementara = $_FILES["file"]["tmp_name"];
				$path = "../../../file_lap/";
				unlink($path.$q31["file"]);
				
				if(move_uploaded_file($filesementara, $path.$nama))
					$edit = mysql_query("update tbl_berkas_pengaduan set hasil_mediasi='$hasil', ket_mediasi='$keterangan',tgl_mediasi=curdate(), file='".$nama."' where no_resi='".$_GET["link"]."'");	
			}
			else
			{
				$edit = mysql_query("update tbl_berkas_pengaduan set hasil_mediasi='$hasil', ket_mediasi='$keterangan',tgl_mediasi=curdate() where no_resi='".$_GET["link"]."'");
			}		
	
			if($edit)
			{
			?>
			   <script type="text/javascript">
				alert('Berhasil Mengubah File ');
				document.location = "./edit.php?link=<?php echo $resi; ?>&id_user=<?php echo $dari; ?>";
			</script>
			<?php
			}
			else
			{
			?>
			   <script type="text/javascript">
				alert('Gagal Mengubah File ');
				document.location = "./edit.php?link=<?php echo $resi; ?>&id_user=<?php echo $dari; ?>";
			</script>
			<?php
			}
			
		}

?>



