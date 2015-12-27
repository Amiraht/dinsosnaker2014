<?php
include("../../../../libraries/dinsos.php");
<<<<<<< HEAD
include("../../../../libraries/function.php");

$nama = trim(str_replace('<,>,*', '', $_POST["nama"]));
$nip = trim(str_replace('<,>,*', '', $_POST["nip"]));
$username = trim(str_replace('<,>,*', '', $_POST["username"]));
$jabatan = trim(str_replace('<,>,*', '', $_POST["jabatan"]));
$skpd = $_POST["kode_skpd"];
$alamat = trim(str_replace('<,>,*', '', $_POST["alamat"]));
$kontak = trim(str_replace('<,>,*', '', $_POST["no_kontak"]));
$email = trim(str_replace('<,>,*', '', $_POST["email"]));
$izin = trim(str_replace('<,>,*', '', $_POST["izin"]));
$level = trim(str_replace('<,>,*', '', $_POST["level"]));
$pswd = trim(str_replace('<,>,*', '', $_POST["password"]));
$pwd = md5($pswd);
$id_pangkat = $_POST["panggol"];

// id pegawai
$id_pegawai_disnaker = setIdPegawai();
$id_pegawai_simpeg = setIdPegawaiSimpegDinsos();

$id_satuan_organisasi = id_skpd($skpd);
=======

$nama = trim(str_replace('<,>,*', '', $_POST["nama"]));
$username = trim(str_replace('<,>,*', '', $_POST["username"]));
$izin = trim(str_replace('<,>,*', '', $_POST["izin"]));
$level = trim(str_replace('<,>,*', '', $_POST["level"]));
$pswd = trim(str_replace('<,>,*', '', $_POST["password"]));
$pwd=md5($pswd);
>>>>>>> 61b16164dbc53b4bcbd8d4faadd081d2b93a07d3

if($_GET["optss"] == 'tambah')
{
	if($nama == '' or $username == '' or $pwd == '' or $izin == '' or $level == '0')
	{
	?>
<<<<<<< HEAD
			<script type="text/javascript">
				alert ('Isi Form Dengan Lengkap');
				document.location.href='./tambah_member.php';
			</script>
	<?php
	}
	
=======
    <script type="text/javascript">
		alert ('Isi Form Dengan Lengkap');
		document.location.href='./tambah_member.php';
	</script>
	<?php
	}
>>>>>>> 61b16164dbc53b4bcbd8d4faadd081d2b93a07d3
		
	//cek username
	$d = mysql_query("select username from user where username='$username'");
	if(mysql_num_rows($d)>=1)
	{
	?>
<<<<<<< HEAD
			<script type="text/javascript">
				alert ('Username sudah ada');
				document.location.href='./tambah_member.php';
			</script>
=======
    <script type="text/javascript">
		alert ('Username sudah ada');
		document.location.href='./tambah_member.php';
	</script>
>>>>>>> 61b16164dbc53b4bcbd8d4faadd081d2b93a07d3
	<?php
	}
	
		$d = mysql_query("insert into user (nama, username, password, izin, level) values ('$nama','$username', '$pwd', '$izin', '$level')");
	
	if($d)
	{
<<<<<<< HEAD
			// insert ke tabel pegawai simpeg
			insertPegawai($id_pegawai_disnaker, $nip, $nama, $id_satuan_organisasi, $id_pangkat, $alamat);
			
			insertPegawaiToSimpeg($id_pegawai_simpeg, $nip, $nama, $id_satuan_organisasi, $id_pangkat, $alamat);
			
			?>
			<script type="text/javascript">
				alert('Berhasil menambah data pengguna');
=======
			?>
			<script type="text/javascript">
				alert('Berhasil pengguna');
>>>>>>> 61b16164dbc53b4bcbd8d4faadd081d2b93a07d3
				parent.document.location.href='../../../../index.php?mod=cp&opt=member&opts=view';
				//document.location.href='./tambah_berita.php';
			</script>
			<?php
	}
	else
	{
			?>
			<script type="text/javascript">
				alert('Gagal Menambah pengguna');
				document.location.href='./tambah_berita.php';
			</script>
			<?php
	}

}

else if($_GET["optss"] == 'edit')
{
	if(!empty($_GET["id_member"]))
	{
		if(!empty($pwd))
		{
			$edit = mysql_query("update user set nama='".$nama."', username='".$username."', password='".$pwd."', level='".$level."', izin='".$izin."' where id_user='".$_GET["id_member"]."'");
		}
		else
		{
			$edit = mysql_query("update user set nama='".$nama."', username='".$username."', level='".$level."', izin='".$izin."' where id_user='".$_GET["id_member"]."'");
		}		

		if($edit)
		{
		?>
<<<<<<< HEAD
				<script type="text/javascript">
					alert('Berhasil Mengubah Data Pengguna');
					parent.document.location.href='../../../../index.php?mod=cp&opt=member&opts=view';
				</script>
=======
           <script type="text/javascript">
			alert('Berhasil Mengubah Pengguna');
			parent.document.location.href='../../../../index.php?mod=cp&opt=member&opts=view';
		</script>
>>>>>>> 61b16164dbc53b4bcbd8d4faadd081d2b93a07d3
        <?php
		}
		else
		{
		?>
           <script type="text/javascript">
			alert('Gagal Mengubah Pengguna');
			parent.document.location.href='../../../../index.php?mod=cp&opt=member&opts=view';
		</script>
        <?php
		}
		
	}
}

if($_GET["optss"] == 'hapus')
{
	if(!empty($_GET["id_member"]))
	{		
		$hapus = mysql_query("delete from user where id_user='".$_GET["id_member"]."'");
		if($hapus)
		{
		?>
        	<script type="text/javascript">
				alert('Berhasil Menghapus Pengguna');
				parent.parent.document.location.href='./index.php?mod=cp&opt=member&opts=view';
			</script>
        <?php
		}
		else
		{
		?>
        	<script type="text/javascript">
				alert('Gagal Menghapus Pengguna');
				parent.parent.document.location.href='./index.php?mod=cp&opt=member&opts=view';
			</script>
        <?php
		}
	}
	else
	{
	?>
    <script type="text/javascript">
		alert('pengguna tidak Dapat Dihapus');
		parent.parent.document.location.href='index.php?mod=cp&opt=member&opts=view';
	</script>
    <?php
	exit();
	}
}

?>