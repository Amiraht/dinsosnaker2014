<?php
    session_start();
    include("koneksi.php");
	include("fungsi.php");
	
	$id_pegawai = set_id_pegawai();
	$id_pengguna = set_id_pengguna();
	
	$default_pass = md5("@simpeg123");
	
    $sql = "INSERT INTO tbl_pegawai VALUES(
                ".$id_pegawai.",
                '$_POST[nip]', '$_POST[nama_pegawai]', null, '$_POST[id_status_kepegawaian]', '$_POST[id_jenis_kepegawaian]', '$_POST[id_kedudukan_kepegawaian]',
                '$_POST[id_instansi]', '$_POST[id_satuan_organisasi]', '$_POST[id_pangkat]', '$_POST[id_tipe_jabatan]', '$_POST[id_jabatan]', '$_POST[gelar_depan]', '$_POST[gelar_belakang]',
                '$_POST[id_golongan_darah]', '$_POST[id_jenis_kelamin]', '$_POST[tempat_lahir]', '$_POST[tanggal_lahir]', '$_POST[alamat]', '$_POST[rt]', '$_POST[rw]',
                '$_POST[marga]', '$_POST[id_suku]', '$_POST[id_agama]', '$_POST[id_provinsi]', '$_POST[id_kabupaten]', '$_POST[id_kecamatan]', '$_POST[id_kelurahan]',
                '$_POST[kode_pos]', '$_POST[no_telp]', '$_POST[no_hp]', '$_POST[nama_ayah]', '$_POST[nama_ibu]', '$_POST[id_status_pernikahan]', '$_POST[npwp]',
                '$_POST[tinggi]', '$_POST[berat]', '$_POST[id_rambut]', '$_POST[id_bentuk_muka]', '$_POST[id_warna_kulit]', '$_POST[ciri_khas]', '$_POST[cacat_tubuh]',
                '$_POST[hobi]', '$_POST[id_status_kepegawaian]', 0, 0
            )";
    //echo($sql);
    mysql_query($sql);
    
    // LANGSUNG BUAT AKUN USER UNTUK PEGAWAI INI
    $ds_nip = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pegawai WHERE nip='" . $_POST["nip"] . "'"));
	
    mysql_query("INSERT INTO tbl_pengguna VALUES(
                    ".$id_pengguna.", '$_POST[nama_pegawai]', REPLACE('$_POST[nip]',' ',''), '".$default_pass."', '', '', 0, 1, 0, null, 0, '" . $ds_nip["id_pegawai"] . "', 0
                )");
    
    header("location:../?mod=info&pesan=1&redir=data_pegawai");
?>