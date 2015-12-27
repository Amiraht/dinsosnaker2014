<?php
	include "./libraries/dinsos.php";
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
	
	