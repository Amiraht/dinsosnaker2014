<?php
	
	include "../koneksi.php";
	include "../fungsi.php";
	
	  
    function something_wrong($what_is_wrong){
        echo("
            <script type='text/javascript'>
                alert(\"" . $pesan . "\", 'HAPUS GAGAL');
				document.location.href='../../?mod=cuti_daftar_usulan';
            </script>
        ");
    }
    function success($pesan){
        echo("
            <script type='text/javascript'>
                alert(\"" . $pesan . "\", 'KONFIRMASI');
				document.location.href='../../?mod=cuti_daftar_usulan';
            </script>
        ");
    }
    
	
	$id_usulan = $_GET['id_usulan'];
	$no_usul = getNoUsulFromUsulanCuti($id_usulan);
	
	$sql = "DELETE FROM tbl_usulan_cuti WHERE no_usulan = '".$no_usul."'";
	
	$query = mysql_query($sql);
	
	if($query){
		$pesan = "Data dengan no usulan ".$no_usul." telah dihapus";
		success($pesan);	
	}else{
		$pesan = "Maaf, terjadi kesalahan, data gagal dihapus !!";
		something_wrong($pesan);
	}
	
	mysql_close();