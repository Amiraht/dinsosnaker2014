<?php
	session_start();
    include("../koneksi.php");
	include("../../method/function.php");
	
	// set the post variabel securely
	$username = anti_injection($_POST['username']);
	$password = anti_injection($_POST['password']);
	
    $res = mysql_query("SELECT 
                        	a.*, b.atasan AS atasan, b.level as level 
                        FROM 
                        	myapp_maintable_pengguna a
                        LEFT JOIN 
                        	myapp_reftable_levelpengguna b ON a.id_level = b.id
                        WHERE 
                        	username = '".$username."' AND password = '".md5($password)."'");
							
    if(mysql_num_rows($res) == 1){
        $ds = mysql_fetch_array($res);
        $_SESSION["password"]       = $ds["password"];
        $_SESSION["id_pengguna"]    = $ds["id"];
        $_SESSION["id_level"]       = $ds["id_level"];
        $_SESSION["username"]       = $ds["username"];
        $_SESSION["nama"]           = $ds["nama"];
        $_SESSION["atasan"]         = $ds["atasan"];
		$_SESSION["level"]          = $ds["level"];
		
		// set login act depend on id level of user
		// rules
		switch($ds['id_level']){
			case 18 :
				header("location:../../?mod=main_loket");
				break;
			case 1 :
				header("location:../../?mod=main_kaban");
				break;
			case 2 :
				header("location:../../?mod=main_sekretaris");
				break;
			case 3 :
			case 4 :
			case 5 :
			case 6 :
			case 26 :
			case 27 :
			case 28 :
				header("location:../../?mod=main_kabid");
				break;
			case 7 : 
			case 8 :
			case 9 :
				header("location:../../?mod=main_kasubbag_umum");
				break;
			case 19 :
				header("location:../../?mod=main_arsip");
				break;
			case 20:
			case 21:
			case 22:
			case 23:
			case 25:
			case 29 :
			case 30 :
				header("location:../../?mod=main_staff");
				break;
			case 24 :
				header("location:../../?mod=main_administrator");
				break;
			
		}
		
    }else{
        session_destroy();
        header("location:../../?mod=login&fail=1");
    }
?>