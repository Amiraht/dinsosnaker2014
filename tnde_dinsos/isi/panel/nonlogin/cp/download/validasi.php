<?php
//defined('_BLH_EXEC') or die ('Restricted Access');
include("../../../../libraries/dinsos.php");
	$judul = trim(str_replace('<,>,*', '', $_POST["judul"]));
	$keterangan = trim(str_replace('<,>,*', '', $_POST["keterangan"]));
	$file = $_FILES["file"];

if($_GET["optss"] == 'tambah')
{
	if($_FILES["file"]["size"] > 2500000)
	{
	?>
    	<script type="text/javascript">
			alert('Gagal Menambah Berita dan Informasi Karena Ukuran File Terlalu Besar \n\nSolusi: \nKompress ukuran file dengan winzip atau winrar');
			//parent.parent.document.location.href='./index.php?mod=cp&opt=download&opts=view';
			document.location.href='./tambah_download.php';
		</script>
    <?php
		exit();
	}
	
	if($judul == '' || $file == '')
	{
	?>
    <script type="text/javascript">
		alert ('Isi Form Dengan Lengkap');
		//parent.parent.document.location.href='./index.php?mod=cp&opt=download&opts=view';
		document.location.href='./tambah_download.php';
	</script>
    <?php
	}
	else
	{
		$nama = date("d-m-Y").'-'.$judul.'-'.$_FILES["file"]["name"];
		$filesementara = $_FILES["file"]["tmp_name"];
		$path =  "../file/download/".$nama;

		if(move_uploaded_file($filesementara, $path))
		{
			$tambah_type = mysql_query("insert into tbl_download (judul, keterangan, file, tanggal) values('$judul', '$keterangan', '$nama', '".date("Y-m-d")."')");
			if(!tambah_type)
			{
			?>
			<script type="text/javascript">
				alert('Gagal Menambah File Download');
				parent.document.location.href='../../../../index.php?mod=cp&opt=download&opts=view';
			</script>
			<?php
			}
			else
			{
			?>
			<script type="text/javascript">
				alert('Berhasil Menambah File Download');
				parent.document.location.href='../../../../index.php?mod=cp&opt=download&opts=view';
			</script>
			<?php
			}
		}
	}
}

else if($_GET["optss"] == 'edit')
{
	if(!empty($_GET["id_download"]))
	{
		$q3 = mysql_query("select * from tbl_download where id_download='".$_GET["id_download"]."'");
		$q31 = mysql_fetch_array($q3);
		
		if(!empty($_FILES["file"]["name"]))
		{
			if($_FILES["file"]["size"] > 1500000)
			{
			?>
				<script type="text/javascript">
					alert('Gagal Menambah Berita dan Informasi Karena Ukuran File Terlalu Besar \n\nSolusi: \nKompress ukuran file dengan winzip atau winrar');
					parent.parent.document.location.href='./index.php?mod=cp&opt=download&opts=view';
				</script>
			<?php
				exit();
			}
	
			$nama = date("d-m-Y").'-'.$judul.'-'.$_FILES["file"]["name"];
			$filesementara = $_FILES["file"]["tmp_name"];
			$path = "./modules/nonlogin/cp/file/download/";
			unlink($path.$q31["file"]);
			
			if(move_uploaded_file($filesementara, $path.$nama))
				$edit = mysql_query("update tbl_download set judul='".$judul."', keterangan='".$keterangan."', file='".$nama."' where id_download='".$_GET["id_download"]."'");	
		}
		else
		{
			$edit = mysql_query("update tbl_download set judul='".$judul."', keterangan='".$keterangan."' where id_download='".$_GET["id_download"]."'");
		}		

		if($edit)
		{
		?>
           <script type="text/javascript">
			alert('Berhasil Mengubah File Download');
			parent.parent.document.location.href='./index.php?mod=cp&opt=download&opts=view';
		</script>
        <?php
		}
		else
		{
		?>
           <script type="text/javascript">
			alert('Gagal Mengubah File Download');
			parent.parent.document.location.href='./index.php?mod=cp&opt=download&opts=view';
		</script>
        <?php
		}
		
	}
}

if($_GET["optss"] == 'hapus')
{
	if(!empty($_GET["id_download"]))
	{
		$q2 = mysql_query("select  * from tbl_download where id_download='".$_GET["id_download"]."'");
		$q21 = mysql_fetch_array($q2);
		unlink('./modules/nonlogin/cp/file/download/'.$q21["file"]);
		
		$hapus = mysql_query("delete from tbl_download where id_download='".$_GET["id_download"]."'");
		if($hapus)
		{
		?>
        	<script type="text/javascript">
				alert('Berhasil Menghapus File Download');
				parent.parent.document.location.href='./index.php?mod=cp&opt=download&opts=view';
			</script>
        <?php
		}
		else
		{
		?>
        	<script type="text/javascript">
				alert('Gagal Menghapus File Download');
				parent.parent.document.location.href='./index.php?mod=cp&opt=download&opts=view';
			</script>
        <?php
		}
	}
	else
	{
	?>
    <script type="text/javascript">
		alert('File Download tidak Dapat Dihapus');
		parent.parent.document.location.href='index.php?mod=cp&opt=download&opts=view';
	</script>
    <?php
	exit();
	}
}

?>