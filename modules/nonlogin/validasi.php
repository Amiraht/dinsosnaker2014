<?php
	include "./libraries/dinsos.php";
<<<<<<< HEAD
	$user = trim($_POST["user"]);
	$pass = md5(trim($_POST["pass"]));
	
	// set query string
	$str = "SELECT 
				a.*, b.id_skpd, b.kode_skpd 
			FROM 
				user a 
			LEFT JOIN ref_skpd b ON a.skpd = b.kode_skpd 
			WHERE 
				a.username = '". $user ."' AND password = '". $pass ."' AND a.izin = 'Y' 
				
		";
		
	$query = mysql_query($str);
	$num = mysql_num_rows($query);
	
	if($num > 0){
		$ds = mysql_fetch_array($query);
		// SET THE SESSION VARIABEL 
        $_SESSION["id_pengguna"]       = $ds["id_user"];
		$_SESSION["id_user"]       	   = $ds["id_user"];
        $_SESSION["id_skpd"]           = $ds["id_skpd"];
        $_SESSION["kode_skpd"]         = $ds["kode_skpd"];
        $_SESSION["username"]          = $ds["username"];
        $_SESSION["nama"]              = $ds["nama"];
        $_SESSION["id_level"]          = $ds["level"];
		$_SESSION["id_pegawai"]        = $ds["id_user"];
		$_SESSION["nip"] = $ds["nip"];
		
		// set the url first page
		switch($ds["level"]){
			case 1:
					echo "
						<script type='text/javascript'>
							document.location = './index.php?mod=loket&opt=utama';
						</script>
					";
					break;
					
			case 2:
					echo "
						<script type='text/javascript'>
							document.location = './index.php?mod=jamsostek&do=main';
						</script>
					";
					break;
			case 3:
					echo "
						<script type='text/javascript'>
							document.location = './index.php?mod=loket&opt=utama';
						</script>
					";
					break;
					
			case 4:
					echo "
						<script type='text/javascript'>
							document.location = './index.php?mod=kabidhubsaker&opt=utama';
						</script>
					";
					break;
			case 5:
					echo "
						<script type='text/javascript'>
							document.location = './index.php?mod=kasi&opt=utama';
						</script>
					";
					break;
			case 6:
					echo "
						<script type='text/javascript'>
							document.location = './index.php?mod=staf&opt=utama';
						</script>
					";
					break;
			case 7:
					echo "
						<script type='text/javascript'>
							document.location = './index.php?mod=kabidpentaker&opt=utama';
						</script>
					";
					break;
			case 8:
					echo "
						<script type='text/javascript'>
							document.location = './index.php?mod=kasipentaker&opt=utama';
						</script>
					";
					break;
			case 9:
					echo "
						<script type='text/javascript'>
							document.location = './index.php?mod=pemeriksa&opt=utama';
						</script>
					";
					break;
			case 10:
					echo "
						<script type='text/javascript'>
							document.location = './index.php?mod=stafkasi&opt=utama';
						</script>
					";
					break;
			case 11:
					echo "
						<script type='text/javascript'>
							document.location = './index.php?mod=kabidwasnaker&opt=utama';
						</script>
					";
					break;
			case 12:
					echo "
						<script type='text/javascript'>
							document.location = './index.php?mod=kasiwasnaker&opt=utama';
						</script>
					";
					break;
			case 13:
					echo "
						<script type='text/javascript'>
							document.location = './index.php?mod=pengawas&opt=utama';
						</script>
					";
					break;
			case 14:
					echo "
						<script type='text/javascript'>
							document.location = './index.php?mod=stafkasiwasnaker&opt=utama';
						</script>
					";
					break;
			case 15:
					echo "
						<script type='text/javascript'>
							document.location = './index.php?mod=kasubag_umum&opt=utama';
						</script>
					";
					break;
			case 16:
					echo "
						<script type='text/javascript'>
							document.location = './index.php?mod=sekretaris&opt=utama';
						</script>
					";
					break;
			case 17:
					echo "
						<script type='text/javascript'>
							document.location = './index.php?mod=kadis&opt=utama';
						</script>
					";
					break;
			case 18:
					echo "
						<script type='text/javascript'>
							document.location = './index.php?mod=arsip&opt=utama';
						</script>
					";
					break;
			case 19:
					echo "
						<script type='text/javascript'>
							document.location = './index.php?mod=cp&opt=utama';
						</script>
					";
					break;
			case 20:
					echo "
						<script type='text/javascript'>
							document.location = './index.php?mod=kasihubsaker&opt=utama';
						</script>
					";
					break;
			case 21:
					echo "
						<script type='text/javascript'>
							document.location = './index.php?mod=stafkasihubsaker&opt=utama';
						</script>
					";
					break;
			case 22:
					echo "
						<script type='text/javascript'>
							document.location = './index.php?mod=kabidlatih&opt=utama';
						</script>
					";
					break;
			case 23:
					echo "
						<script type='text/javascript'>
							document.location = './index.php?mod=kasilatih&opt=utama';
						</script>
					";
					break;
			case 24:
					echo "
						<script type='text/javascript'>
							document.location = './index.php?mod=stafkasilatih&opt=utama';
						</script>
					";
					break;
			case 25:
					echo "
						<script type='text/javascript'>
							document.location = './index.php?mod=peninjau&opt=main';
						</script>
					";
					break;
			case 26:
					echo "
						<script type='text/javascript'>
							document.location = './index.php?mod=pemantau&opt=main';
						</script>
					";
					break;
			
		}
		
	}else{
		echo "
			<script type='text/javascript'>
				alert('USERNAME DAN PASSWORD ANDA SALAH');
				document.location = 'index.php?mod=umum&do=login';
			</script>
		";
	}
	
	
=======
	$user=$_POST["user"];
	$pass=md5($_POST["pass"]);

	$query=mysql_query("SELECT * FROM user WHERE username='$user' AND password='$pass' and izin='Y'");
	$data = mysql_num_rows($query);
	
	if($data>0)
	{
		while($data2=mysql_fetch_array($query))
		{
			$_SESSION["lv"]=$data2[8];
			if($data2[8]=="1")
			{
			$_SESSION["id_user"]=$data2[0];
			
?>
			<script type="text/javascript">
				document.location = "./index.php?mod=loket&opt=main";
				//document.location = "./index.php?mod=dinsos&do=main";
			</script>
<?php
			}
			elseif($data2[8]=="2")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=jamsostek&do=main";
				</script>
<?php
			}
			elseif($data2[8]=="0")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./modules/nonlogin/cp/index.php";
				</script>
<?php
			}
			elseif($data2[8]=="3")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=loket&opt=main";
				</script>
<?php
			}
			elseif($data2[8]=="4")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=kabidhubsaker&opt=main";
				</script>		
<?php
			}
			elseif($data2[8]=="5")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=kasi&opt=main";
				</script>	
<?php
			}
			elseif($data2[8]=="6")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=staf&opt=main";
				</script>	
<?php
			}
			elseif($data2[8]=="7")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=kabidpentaker&opt=main";
				</script>
<?php
			}
			elseif($data2[8]=="8")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=kasipentaker&opt=main";
				</script>
<?php
			}
			elseif($data2[8]=="9")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=pemeriksa&opt=main";
				</script>
<?php
			}
			elseif($data2[8]=="10")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=stafkasi&opt=main";
				</script>
<?php
			}
			elseif($data2[8]=="11")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=kabidwasnaker&opt=main";
				</script>
<?php
			}
			elseif($data2[8]=="12")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=kasiwasnaker&opt=main";
				</script>
<?php
			}
			elseif($data2[8]=="13")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=pengawas&opt=main";
				</script>
<?php
			}
			elseif($data2[8]=="14")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=stafkasiwasnaker&opt=main";
				</script>
<?php
			}
			elseif($data2[8]=="15")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=kasubag_umum&opt=main";
				</script>
<?php
			}
			elseif($data2[8]=="16")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=sekretaris&opt=main";
				</script>	
<?php
			}
			elseif($data2[8]=="17")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=kadis&opt=main";
				</script>
<?php
			}
			elseif($data2[8]=="18")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=arsip&opt=main";
				</script>
<?php
			}
			elseif($data2[8]=="19")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=cp&opt=main";
				</script>
<?php
			}//KASI HUBSAKER
			elseif($data2[8]=="20")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=kasihubsaker&opt=main";
				</script>
<?php
			}//STAF KASI HUBSAKER
			elseif($data2[8]=="21")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=stafkasihubsaker&opt=main";
				</script>
<?php
			}//KABID LATIH
			elseif($data2[8]=="22")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=kabidlatih&opt=main";
				</script>
<?php
			}//KASI LATIH
			elseif($data2[8]=="23")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=kasilatih&opt=main";
				</script>
<?php
			}//STAF KASI LATIH
			elseif($data2[8]=="24")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=stafkasilatih&opt=main";
				</script>
<?php
			}
			elseif($data2[8]=="25")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=peninjau&opt=main";
				</script>
<?php
			}	
			elseif($data2[8]=="26")
			{
				$_SESSION["id_user"]=$data2[0];
				?>
				<script type="text/javascript">
					document.location = "./index.php?mod=pemantau&opt=main";
				</script>
<?php
			}						
			else
			{
?>
				<script type="text/javascript">
					alert('USERNAME DAN PASSWORD ANDA SALAH');
					document.location = "index.php?mod=umum&do=login";
				</script>
<?php
			}
		};
	}
	else
	{
		?>
			<script type="text/javascript">
				alert('USERNAME DAN PASSWORD ANDA SALAH');
				document.location = "index.php?mod=umum&do=login";
			</script>
<?php
	}
?>
>>>>>>> 61b16164dbc53b4bcbd8d4faadd081d2b93a07d3
