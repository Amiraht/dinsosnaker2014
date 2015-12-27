<?php 
	session_start();
	
	
	$app = strip_tags(trim($_GET["app"]));
	
	// set the rules to the index of page
	if($app == "tnde_dinsos"){
		
		// set the rules 
		switch($_SESSION["id_level"]){
				case 3 : // untuk loket
					$_SESSION["id_level"] = 18; // sesuaikan dengan mod login di tata naskah
					$_SESSION["id_pengguna"] = 18;
					echo "<script>document.location.href='../../tnde_dinsos/?mod=main_loket';</script>";
					break;
					
				case 15 : // untuk kasubbag umum
					$_SESSION["id_level"] = 7;
					$_SESSION["id_pengguna"] = 7;
					echo "<script>document.location.href='../../tnde_dinsos/?mod=main_kasubbag_umum';</script>";
					break;
	
				case 17 : // untuk kadis atau kaban
					$_SESSION["id_level"] = 35;
					$_SESSION["id_pengguna"] = 53;
					echo "<script>document.location.href='../../tnde_dinsos/?mod=main_kadis';</script>";
					break;
					
				// untuk masing2 kepala bidang (kabid)	
				case 4  :
					$_SESSION["id_level"] = 6;
					$_SESSION["id_pengguna"] = 4;
					echo "<script>document.location.href='../../tnde_dinsos/?mod=main_kabid';</script>";
					break;
				case 7  :
					$_SESSION["id_level"] = 26;
					$_SESSION["id_pengguna"] = 6;
					echo "<script>document.location.href='../../tnde_dinsos/?mod=main_kabid';</script>";
					break;
				case 11 :
					$_SESSION["id_level"] = 27;
					$_SESSION["id_pengguna"] = 5;
					echo "<script>document.location.href='../../tnde_dinsos/?mod=main_kabid';</script>";
					break;
				case 22 :
					$_SESSION["id_level"] = 28;
					$_SESSION["id_pengguna"] = 3;
					echo "<script>document.location.href='../../tnde_dinsos/?mod=main_kabid';</script>";
					break;
				
				// untuk masing-masing kasubbid atau kasi (kepala seksi)	
				case 5 	:
					$_SESSION["id_level"] = 36;
					$_SESSION["id_pengguna"] = 7;
					echo "<script>document.location.href='../../tnde_dinsos/?mod=main_kasubbid';</script>";
					break;
				case 8 	:
					$_SESSION["id_level"] = 13;
					$_SESSION["id_pengguna"] = 13;
					echo "<script>document.location.href='../../tnde_dinsos/?mod=main_kasubbid';</script>";
					break;
				case 12 :
					$_SESSION["id_level"] = 12;
					$_SESSION["id_pengguna"] = 12;
					echo "<script>document.location.href='../../tnde_dinsos/?mod=main_kasubbid';</script>";
					break;
				case 20 :
					$_SESSION["id_level"] = 11;
					$_SESSION["id_pengguna"] = 11;
					echo "<script>document.location.href='../../tnde_dinsos/?mod=main_kasubbid';</script>";
					break;
				case 23	:
					$_SESSION["id_level"] = 10;
					$_SESSION["id_pengguna"] = 10;
					echo "<script>document.location.href='../../tnde_dinsos/?mod=main_kasubbid';</script>";
					break;
					
				// loginan untuk para staff
				case 10 :
					$_SESSION["id_level"] = 22;
					$_SESSION["id_pengguna"] = 30;
					echo "<script>document.location.href='../../tnde_dinsos/?mod=main_staff';</script>";
					break;
				case 14 :
					$_SESSION["id_level"] = 29;
					$_SESSION["id_pengguna"] = 31;
					echo "<script>document.location.href='../../tnde_dinsos/?mod=main_kasubbid';</script>";
					break;
				case 21 :
					$_SESSION["id_level"] = 23;
					$_SESSION["id_pengguna"] = 32;
					echo "<script>document.location.href='../../tnde_dinsos/?mod=main_kasubbid';</script>";
					break;
				
		}
		
	}else if($app == "skp_dinsos"){
		// cek session id level user
		switch($_SESSION["id_level"]){
			case 17 :
					$_SESSION["simpeg_id_pengguna"] = 22462; // id user Simpeg dan SKP (ganti ini jika berganti database)
					$_SESSION["simpeg_id_tipe_jabatan"] = 1;
					echo "<script>document.location.href = '../../skp/?mod=';</script>";
					break;
			default :
					echo "<script>document.location.href = '../../skp';</script>";
					break;
		}
	}else if($app == "simpeg_dinsos"){
		// cek session id level user
		switch($_SESSION["id_level"]){
			case 17 :
					$_SESSION["simpeg_id_pengguna"] = 22462; // id user Simpeg dan SKP (ganti ini jika berganti database)
					$_SESSION["simpeg_id_tipe_jabatan"] = 1;
					echo "<script>document.location.href = '../../simpeg_dinsos/?mod=';</script>";
					break;
			default :
					echo "<script>document.location.href = '../../simpeg_dinsos';</script>";
					break;
		}
	}else if($app == "arsip_dinsos"){
		// cek session id level user
		switch($_SESSION["id_level"]){
			
			// kasubbag umum
			case 15 :
					$_SESSION["id_level"] = 9;
					echo "<script>document.location.href = '../../webarsip';</script>";
					break;
			
			default :
					echo "<script>document.location.href = '../../webarsip';</script>";
		}
		
	}
	
	
?>
