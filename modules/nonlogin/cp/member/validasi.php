<?php
include("../../../../libraries/dinsos.php");
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

if($_GET["optss"] == 'tambah')
{
	if($nama == '' or $username == '' or $pwd == '' or $izin == '' or $level == '0')
	{
	?>
			<script type="text/javascript">
				alert ('Isi Form Dengan Lengkap');
				document.location.href='./tambah_member.php';
			</script>
	<?php
	}
	
		
	//cek username
	$d = mysql_query("select username from user where username='$username'");
	if(mysql_num_rows($d)>=1)
	{
	?>
			<script type="text/javascript">
				alert ('Username sudah ada');
				document.location.href='./tambah_member.php';
			</script>
	<?php
	}
	
		$d = mysql_query("insert into user (nama, username, password, izin, level) values ('$nama','$username', '$pwd', '$izin', '$level')");
	
	if($d)
	{
			// insert ke tabel pegawai simpeg
			insertPegawai($id_pegawai_disnaker, $nip, $nama, $id_satuan_organisasi, $id_pangkat, $alamat);
			
			insertPegawaiToSimpeg($id_pegawai_simpeg, $nip, $nama, $id_satuan_organisasi, $id_pangkat, $alamat);
			
			?>
			<script type="text/javascript">
				alert('Berhasil menambah data pengguna');
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
				<script type="text/javascript">
					alert('Berhasil Mengubah Data Pengguna');
					parent.document.location.href='../../../../index.php?mod=cp&opt=member&opts=view';
				</script>
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