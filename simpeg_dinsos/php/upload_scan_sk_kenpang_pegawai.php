<?php
	session_start();
	/* INFORMASI MENGENAI FILE YANG DI UPLOAD */
	/* OLEH MASING-MASING PEGAWAI            */
	
	$fname = $_FILES['file_sc']['name'];
	$ftype = $_FILES['file_sc']['type'];
	$source = $_FILES['file_sc']['tmp_name'];
		
	if($source == ""){
		echo "
				<script>
					alert('Maaf, pilih file anda dahulu!!');
					document.location.href = '../?mod=riwayat_pangkat';
				</script>	
			";
		exit;	
	}
	
	// dir tujuan
	$dest = "../sys_files/scan_sk_kenpang/" . $_SESSION['simpeg_id_pegawai'] . ".pdf";
	
	if(file_exists($dest)){
		$dest = "../sys_files/scan_sk_kenpang/" . $_SESSION['simpeg_id_pegawai'] . ".pdf";
	}
	
	// cek dan konversi jenis file dan tipe file
	if($ftype == "application/pdf"){
		
		$upload = move_uploaded_file($source, $dest);
		
		if($upload){
			echo "
				<script>
					alert('Upload File SK Sukses !!');
					document.location.href = '../?mod=riwayat_pangkat';
				</script>	
			";
		}else{
			echo "
				<script>
					alert('Maaf, Upload File Gagal !!');
					document.location.href = '../?mod=riwayat_pangkat';
				</script>	
			";
		}
	}else{
		echo "
			<script>
				alert('Maaf, Tipe File Harus PDF !!');
				document.location.href = '../?mod=riwayat_pangkat';
			</script>
		";
		exit;
	}
	
	