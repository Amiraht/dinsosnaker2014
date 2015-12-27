<?php
error_reporting(E_ALL ^ E_NOTICE);
include "../../../libraries/dinsos.php";
if(isset($_GET["aa"]))
	$no_resi = $_GET["aa"];
	$tahun=date("Y");

for($f=0; $f<count($_FILES['file']['name']); $f++) {
$allowedExts = array("jpg", "jpeg", "png");
$extension = end(explode(".", $_FILES["file"]["name"][$f]));

	if($_FILES["file"]["size"][$f] > 1900000)
	{
	?>
    	<script type="text/javascript">
			alert('Gagal menambahkan gambar!\n Ukuran melebihi kapasitas');
			document.location.href='../../../modules/arsip/baru/tambah.php?link=<?php echo $no_resi ?>';
		</script>
    <?php
		exit();
	}
	
	else if ((($_FILES["file"]["type"][$f] == "image/jpeg") || 
			  ($_FILES["file"]["type"][$f] == "image/jpg") || 
			  ($_FILES["file"]["type"][$f] == "image/pjpeg")|| 
			  ($_FILES["file"]["type"][$f] == "image/x-png")||
			  ($_FILES["file"]["type"][$f] == "image/png")) && 
			   in_array($extension, $allowedExts))
			  {
			  	$nama = '['.date("d-m-Y").']-'.$no_resi.'-'.$_FILES["file"]["name"][$f];
		$filesementara = $_FILES["file"]["tmp_name"][$f];
				
		if (!file_exists("../../../upload/".$no_resi)) {
			mkdir("../../../upload/".$no_resi);
		}
		
		$path =  "../../../upload/".$no_resi."/".$nama;
		$namafile=$nama;
		$vdir_upload ="../../../upload/".$no_resi."/";
		
		if(move_uploaded_file($filesementara, $path))
		{
		  //identitas file asli
		  $im_src = imagecreatefromjpeg($path);
		  $src_width = imageSX($im_src);
		  $src_height = imageSY($im_src);
		
		  //Simpan dalam versi small 80 pixel
		  //Set ukuran gambar hasil perubahan
		  $dst_width = 80;
		  $dst_height = 80;
		
		  //proses perubahan ukuran
		  $im = imagecreatetruecolor($dst_width,$dst_height);
		  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
		
		  //Simpan gambar
		  if(imagejpeg($im,$vdir_upload . "kecil_" . $nama))
		  {
			  
			  //Hapus gambar di memori komputer
			  imagedestroy($im_src);
			  imagedestroy($im);	
				
				$tambah_type = mysql_query("insert into tbl_arsip_upload(no_resi, nama_file, tanggal) values('$no_resi', '$namafile','".date("Y-m-d")."')");
				if(!tambah_type)
				{
				?>
				<script type="text/javascript">
					alert('Gagal Menambah File Gambar');
					parent.parent.document.location.href='../../../index.php?mod=arsip&opt=pengarsipan';
				</script>
				<?php
				}
				else
				{
				?>
				<script type="text/javascript">
					alert('Berhasil Menambah File Gambar');
					parent.parent.document.location.href='../../../index.php?mod=arsip&opt=pengarsipan';
				</script>
				<?php
				}
			}
		}
		else
		{
		?>
		<script type="text/javascript">
			alert('Gagalss Menambah File Gambar');
			parent.parent.document.location.href='../../../index.php?mod=arsip&opt=pengarsipan';
		</script>
		<?php
		}	
	}
	else
	{
			?>
    	<script type="text/javascript">
			alert('File tidak diperbolehkan untuk di upload');
			document.location.href='../../../modules/arsip/baru/tambah.php?link=<?php echo $no_resi ?>';
		</script>
    <?php
		exit();
	}
}
?>