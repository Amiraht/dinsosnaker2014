<?php
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
			alert('Ukuran File Terlalu Besar\n\nSolusi:\nKompress File menggunakan winzip atau winrar');
			//parent.parent.document.location.href='./index.php?mod=cp&opt=berita_informasi&opts=view';
			document.location.href='./tambah_berita.php';
		</script>
    <?php
		exit();
	}
	
	if($judul == '' || $file == '')
	{
	?>
    <script type="text/javascript">
		alert ('Isi Form Dengan Lengkap');
		document.location.href='./tambah_berita.php';
	</script>
    <?php
	}
	else
	{
		$nama = $judul.'-'.$_FILES["file"]["name"];
		$filesementara = $_FILES["file"]["tmp_name"];
		$path =  "../file/berita/".$nama;
		$tgl=date("Y-m-d");

		if(move_uploaded_file($filesementara, $path))
		{
			$qr="insert into tbl_berita (judul, keterangan, file, tanggal) values('$judul', '$keterangan', '$nama', curdate()";
			$tambah_type = mysql_query("insert into tbl_berita (judul, keterangan, file, tanggal) values('$judul', '$keterangan', '$nama', curdate())");
			if(!tambah_type)
			{
			?>
			<script type="text/javascript">
				alert('Gagal Menambah Berita dan Informasi');
				document.location.href='./tambah_berita.php';
			</script>
			<?php
			}
			else
			{
				//die ($qr);
			?>
			<script type="text/javascript">
				alert('Berhasil Menambah Berita dan Informasi');
				parent.document.location.href='../../../../index.php?mod=cp&opt=berita_informasi&opts=view';
				//document.location.href='./tambah_berita.php';
			</script>
			<?php
			}
		}
	}
}

else if($_GET["optss"] == 'edit')
{
	if(!empty($_GET["id_berita"]))
	{
		$q3 = mysql_query("select * from tbl_berita where id_berita='".$_GET["id_berita"]."'");
		$q31 = mysql_fetch_array($q3);
		
		if(!empty($_FILES["file"]["name"]))
		{
			if($_FILES["file"]["size"] > 1500000)
			{
			?>
				<script type="text/javascript">
					alert('Ukuran File Terlalu Besar\n\nSolusi:\nKompress File menggunakan inzip atau winrar');
					parent.parent.document.location.href='./index.php?mod=cp&opt=berita_informasi&opts=view';
				</script>
			<?php
				exit();
			}
	
			$nama = date("d-m-Y").'-'.$judul.'-'.$_FILES["file"]["name"];
			$filesementara = $_FILES["file"]["tmp_name"];
			$path = './modules/nonlogin/cp/file/berita/';
			unlink($path.$q31["file"]);
			
			if(move_uploaded_file($filesementara, $path.$nama))
				$edit = mysql_query("update tbl_berita set judul='".$judul."', keterangan='".$keterangan."', file='".$nama."' where id_berita='".$_GET["id_berita"]."'");	
		}
		else
		{
			$edit = mysql_query("update tbl_berita set judul='".$judul."', keterangan='".$keterangan."' where id_berita='".$_GET["id_berita"]."'");
		}		

		if($edit)
		{
		?>
           <script type="text/javascript">
			alert('Berhasil Mengubah Berita dan Informasi');
			parent.document.location.href='./index.php?mod=cp&opt=berita_informasi&opts=view';
		</script>
        <?php
		}
		else
		{
		?>
           <script type="text/javascript">
			alert('Gagal Mengubah Berita dan Informasi');
			parent.document.location.href='./index.php?mod=cp&opt=berita_informasi&opts=view';
		</script>
        <?php
		}
		
	}
}

if($_GET["optss"] == 'hapus')
{
	if(!empty($_GET["id_berita"]))
	{
		$q2 = mysql_query("select  * from tbl_berita where id_berita='".$_GET["id_berita"]."'");
		$q21 = mysql_fetch_array($q2);
		unlink('./modules/nonlogin/cp/file/berita/'.$q21["file"]);
		
		$hapus = mysql_query("delete from tbl_berita where id_berita='".$_GET["id_berita"]."'");
		if($hapus)
		{
		?>
        	<script type="text/javascript">
				alert('Berhasil Menghapus Berita dan Informasi');
				parent.parent.document.location.href='./index.php?mod=cp&opt=berita_informasi&opts=view';
			</script>
        <?php
		}
		else
		{
		?>
        	<script type="text/javascript">
				alert('Gagal Menghapus Berita dan Informasi');
				parent.parent.document.location.href='./index.php?mod=cp&opt=berita_informasi&opts=view';
			</script>
        <?php
		}
	}
	else
	{
	?>
    <script type="text/javascript">
		alert('Berita dan Informasi tidak Dapat Dihapus');
		parent.parent.document.location.href='index.php?mod=cp&opt=berita_informasi&opts=view';
	</script>
    <?php
	exit();
	}
}

?>