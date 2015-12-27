<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    
    $id_usulan = $_POST["id_usulan"];
    $id_pegawai = detail_pegawai_by_nip($_POST["nip"], "id_pegawai");
	$nama_pegawai = detail_pegawai_by_nip($_POST["nip"], "nama_pegawai");
	
    $sql = "INSERT INTO tbl_usulan_pg_detail(id_usulan, id_pegawai, status) VALUES('" . $id_usulan . "', '" . $id_pegawai . "', 1)";
    $query =  mysql_query($sql);
    
	if($query){
		 $encode = base64_encode($nama_pegawai);
		 header("location:../../?mod=pg_daftar_usulan_diusulkan&id_usulan=". $id_usulan."&code=1&name=".$encode);
	}else{
		header("location:../../?mod=pg_daftar_usulan_diusulkan&id_usulan=". $id_usulan."&code=2");
	}
   
        
    //echo("Data usulan telah disimpan");
?>