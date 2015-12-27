<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
	$id_rp = getIDTabelRiwayatPangkat();
    $sttspv = 1;
    if($_SESSION["simpeg_id_level"] == 12)
        $sttspv = 3;
    $sql = "INSERT INTO tbl_riwayat_pangkat VALUES('".$id_rp."', '" . $_SESSION["simpeg_id_pegawai"] . "', '" . $_POST["id_pangkat"] . "', '" . $_POST["tmt"] . "', '" . $_POST["no_sk"] . "',
            '" . $_POST["tgl_sk"] . "', '" . $_POST["pejabat_penetapan"] . "', '" . $sttspv . "')";
    mysql_query($sql);
    update_pangkat_pegawai($_SESSION["simpeg_id_pegawai"]); 
    header("location:../../?mod=riwayat_pangkat");
	
	
	// function get ID Tabel
	function getIDTabelRiwayatPangkat(){
	$query = mysql_query("SELECT MAX(id_data) as 'Max' FROM tbl_riwayat_pangkat") or die(mysql_error());
	$row = mysql_fetch_array($query);
	$maks = $row['Max'];
	$ID = "";
	
	if($maks > 0){
		$ID = $maks + 1;
	}else{
		$ID = 1;
	}
	
	return $ID;
}
?>