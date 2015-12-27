<?php

    include("koneksi.php");
    include("fungsi.php");
    
    $res = mysql_query("SELECT * FROM myapp_maintable_pengguna WHERE username='" . $_POST["username"] . "'");
    if(mysql_num_rows($res) > 0){
        header("location:../?mod=cp_pengguna&err_code=Maaf, pengguna dengan username '<b>" . $_POST["username"] . "</b>' telah ada");
    }else{
		
        $file_ttd = $_FILES["ttd"];
		
        if($file_ttd["name"] != ""){
            $ttd = $_POST["username"] . ".jpg";
        }else{
            $ttd = "contoh.jpg";
        }
		
        move_uploaded_file($file_ttd["tmp_name"] , "../ttd/" . $ttd);
		
        $sql = "INSERT INTO myapp_maintable_pengguna (id, id_level, username, password, nama, ttd, nip, kontak, email, level_kasubbid) VALUES 
                (NULL, '$_POST[id_level]', '$_POST[username]', '$_POST[password]', '$_POST[nama]', '" . $ttd . "', '$_POST[nip]', '$_POST[kontak]', '$_POST[email]', 0)";
        mysql_query($sql);
        
        //echo($sql);
        header("location:../?mod=cp_pengguna");
		
    }
	
?>