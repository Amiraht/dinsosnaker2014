<?php	
	$id = $_SESSION["id_user"];
	$nip = $_POST["nip"];
	$nama = $_POST["nama"];
	$jab = $_POST["jabatan"];
	$skpd = $_POST["skpd"];
	$alamat = $_POST["alamat"];
	$no = $_POST["telp"];
	$email = $_POST["email"];
	$level = $_POST["leveluser"];
	$username = $_POST["username"];
	
	$passw=$_POST["pass_new1"];
	$passw2=$_POST["pass_new2"];
	$passw3=$_POST["pass_old"];	

	$pass1 = md5($_POST["pass_new1"]);
	$pass2 = md5($_POST["pass_new2"]);
	$pass3 = md5($_POST["pass_old"]);
	
	$cek="select password from user where id_user='$id'";
	$hasil=mysql_query($cek);
	$a = mysql_fetch_array($hasil);
	
	if($passw1=='' and $passw2=='' and $passw3=='')
	{
		$query="update user set
			nip='$nip',
			nama='$nama',
			jabatan='$jab',
			skpd='$skpd',
			alamat='$alamat',
			no_kontak='$no',
			email='$email',
			username='$username'
			where
			id_user='$id'";
		
			$data = mysql_query($query);

			if($data)
			{
				echo"
					<script>
							alert('DATA BERHASIL DI UBAH');
							document.location = 'index.php?mod=kasipentaker&opt=user';
					</script>
				";
			}
	
	}	
	
	if(($pass1 != "") && ($pass2 != ""))
	{
	if($pass1==$pass2)
		{
			if($a[0]==$pass3)
			{
				$query="update user set
						nip='$nip',
						nama='$nama',
						jabatan='$jab',
						skpd='$skpd',
						alamat='$alamat',
						no_kontak='$no',
						email='$email',
						username='$username',
						password='$pass1'
						where
						id_user='$id'";
					
						$data = mysql_query($query);

						if($data)
						{
							echo"
								<script>
										alert('DATA BERHASIL DI UBAH');
										document.location = 'index.php?mod=kasipentaker&opt=user';
								</script>
							";
						}
						else
						{
							echo"<script>
										alert('DATA GAGAL DI UBAH');
										document.location = 'index.php?mod=kasipentaker&opt=user';
								</script>";
						}
				}
			else
			{
				?>
					<script>
                        alert("Password Lama Tidak Cocok" );
                        document.location = "index.php?mod=kasipentaker&opt=user" ;
                    </script>
				<?php
			}
		}
	else
		{
			?>
            <script>
				alert("Password 1 dan Password 2 tidak Cocok");
				document.location ="index.php?mod=kasipentaker&opt=user";
			</script>
<?php		}
	} else {
	$query1="update user set
						nip='$nip',
						nama='$nama',
						jabatan='$jab',
						skpd='$skpd',
						alamat='$alamat',
						no_kontak='$no',
						email='$email'
						where
						id_user='$id'";
						
						$data2 = mysql_query($query1);
	
						if($data2)
						{
							echo"
								<script>
										alert('DATA BERHASIL DI UBAH !');
										document.location = 'index.php?mod=kasipentaker&opt=user';
								</script>
							";
						}
						else
						{
							echo"<script>
										alert('DATA GAGAL DI UBAH');
										document.location = 'index.php?mod=kasipentaker&opt=user';
								</script>";
						}	
	}
 ?>