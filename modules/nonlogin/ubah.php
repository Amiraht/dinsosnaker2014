<?php
	include "./libraries/dinsos.php";
	$user=$_POST["user"];
	$pass=md5($_POST["pass"]);
	$newpass=md5($_POST["newpass"]);
	$confirm=md5($_POST["confpass"]);
	
	if($confirm=='d41d8cd98f00b204e9800998ecf8427e' || $newpass=='d41d8cd98f00b204e9800998ecf8427e')
	{
		echo"<script>
								alert('Password Baru tidak Boleh Kosong');
								document.location = '../index.php?mod=umum&do=edit';
						</script>
					";
	}
	else	
	$query1=mysql_query("SELECT * FROM user WHERE username='$user' AND password='$pass'");
	$data = mysql_num_rows($query1);
	
	
	
	
			if($data>0)
			{
				
				if($newpass!=$confirm)
				{
					echo"<script>
								alert('Password Baru tidak Cocok');
								document.location = 'index.php?mod=umum&do=edit';
						</script>
					";
				}
				else
				{	
					$query2=mysql_query("update user set password='$newpass' where username='$user'");
						if(!$query2)
						{
						echo"
								<script>
									alert('Gagal Update Password');
									document.location = 'index.php?mod=umum&do=edit';
								</script>
							";
						}
						else
						{
							echo"
							<script>
									alert('Update Password Berhasil');
									document.location = 'index.php?mod=umum&do=login';
							</script>
							";
						}

				}	
			}
			else
			{
				echo"
					<script>
							alert('Username dan Password tidak cocok');
							document.location = 'index.php?mod=umum&do=edit';
					</script>
				";
			}
?>