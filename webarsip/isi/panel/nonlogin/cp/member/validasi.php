<?php
include("../../../../libraries/dinsos.php");

$nama = trim(str_replace('<,>,*', '', $_POST["nama"]));
$username = trim(str_replace('<,>,*', '', $_POST["username"]));
$izin = trim(str_replace('<,>,*', '', $_POST["izin"]));
$level = trim(str_replace('<,>,*', '', $_POST["level"]));
$pswd = trim(str_replace('<,>,*', '', $_POST["password"]));
$pwd=md5($pswd);

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
			?>
			<script type="text/javascript">
				alert('Berhasil pengguna');
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
			alert('Berhasil Mengubah Pengguna');
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