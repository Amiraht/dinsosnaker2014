<?php
	session_start();
    include("../koneksi.php");
    include("../fungsi.php");
	
	// all variables
	$nip = mysql_real_escape_string($_POST['nip']);
	$tingkat = $_POST['tk_pendidikan'];
	$tempat = mysql_real_escape_string($_POST['tempat_pendidikan']);
	$nomer = mysql_real_escape_string($_POST['no_ijazah']);
	$tgl_ijazah = mysql_real_escape_string($_POST['tgl_ijazah']);
	$kepala = mysql_real_escape_string($_POST['kepala']);
	$index = mysql_real_escape_string($_POST['index']);
	$id_rp = get_maks_id_data_riwayat_pendidikan();
	
	//SET the file upload info
	$fname = $_FILES['sc_ijazah']['name'];
	$fsize = $_FILES['sc_ijazah']['size'];
	$ftype = $_FILES['sc_ijazah']['type'];
	$tmp   = $_FILES['sc_ijazah']['tmp_name'];
	
	if($ftype != 'application/pdf'){
		if($_SESSION['simpeg_id_level'] == 1 || $_SESSION['simpeg_id_level'] == 2){
				echo "
					<script>
						alert('Tipe file harus PDF !!');
						document.location.href = '../../?mod=riwayat_pendidikan_pegawai';
					</script>	
				";
			}else{
				echo "
					<script>
						alert('Tipe File harus PDF !!');
						document.location.href = '../../?mod=riwayat_pendidikan';
					</script>	
				";
			}
		exit;
	}
	
	// destination dir
	$ntype = explode('/',$ftype);
	$eks = $ntype[1];
	$file = $nip . "." . $eks;
	$dest = "../../ijazah_uploaded/riwayat_pendidikan/" . $file;
	
	move_uploaded_file($tmp, $dest); // upload process
	
    $sttspv = 1;
	
    if($_SESSION["simpeg_id_level"] == 5)
        $sttspv = 3;
		
    $sql = "INSERT INTO tbl_riwayat_pendidikan VALUES('$id_rp','$nip','$tingkat','$tempat','$nomer','$tgl_ijazah','$kepala',
			'$index', '$file','$sttspv','')";
    
	$query	= mysql_query($sql) or die(mysql_error());
	
	if($query){
			
			if($_SESSION['simpeg_id_level'] == 1 || $_SESSION['simpeg_id_level'] == 2){
				echo "
					<script>
						alert('Tambah Riwayat Pendidikan Sukses');
						document.location.href = '../../?mod=riwayat_pendidikan_pegawai';
					</script>	
				";
			}else{
				echo "
					<script>
						alert('Tambah Riwayat Pendidikan Sukses');
						document.location.href = '../../?mod=riwayat_pendidikan';
					</script>	
				";
			}
	}else{
			
			if($_SESSION['simpeg_id_level'] == 1 || $_SESSION['simpeg_id_level'] == 2){
				echo "
					<script>
						alert('Tambah Riwayat Pendidikan Gagal');
						document.location.href = '../../?mod=riwayat_pendidikan_pegawai';
					</script>	
				";
			}else{
				echo "
					<script>
						alert('Tambah Riwayat Pendidikan Gagal');
						document.location.href = '../../?mod=riwayat_pendidikan';
					</script>	
				";
			}
	}	
	
	
    //header("location:../../?mod=riwayat_pendidikan");
?>