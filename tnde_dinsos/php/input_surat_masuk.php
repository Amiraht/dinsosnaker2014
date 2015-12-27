<?php
    include("koneksi.php");
    include("fungsi.php");
    
    // AMBIL noreg SURAT MASUK DAN KEMUDIAN UPDATE NOREG NYA DENGAN MENAMBAHKAN !
    $ds_noreg = mysql_fetch_array(mysql_query("SELECT * FROM myapp_consttable_noreg WHERE id = 1"));
    $noreg = $ds_noreg["reg_sm"];
    mysql_query("UPDATE myapp_consttable_noreg SET reg_sm = reg_sm+1 WHERE id=1");
    
    $sql = "INSERT INTO myapp_maintable_suratmasuk (id, no_surat, tgl_surat, tgl_terima, perihal_surat, pengirim_surat, alamat_pengirim, judul_surat, deskripsi_surat, catatan, id_skpd_pengirim, id_masalah, id_jenis_surat, harus_selesai, indeks, kode, status, asal_disposisi, tujuan_disposisi, noreg) VALUES 
            (NULL, '".anti_injection($_POST['no_surat'])."', '".anti_injection($_POST['tgl_surat'])."', '".anti_injection($_POST['tgl_terima'])."', 
			'".anti_injection($_POST['perihal_surat'])."', '".anti_injection($_POST['pengirim_surat'])."', 
			'".anti_injection($_POST['alamat_pengirim'])."', '".anti_injection($_POST['judul_surat'])."', '".anti_injection($_POST['deskripsi_surat'])."', 
			'".anti_injection($_POST['catatan'])."', '".anti_injection($_POST['id_skpd_pengirim')."', '".anti_injection($_POST['id_masalah'])."', 
			'".anti_injection($_POST['id_jenis_surat'])."', '".anti_injection($_POST['harus_selesai'])."', 
			'".anti_injection($_POST['indeks'])."', '".anti_injection($_POST['kode'])."', 1, 0, 0, '" . $noreg . "')";
			
    mysql_query($sql);
    
    // MENCARI ID SURAT MASK YANG BARU DIMASUKKAN
    $ds_id_max = mysql_fetch_array(mysql_query("SELECT MAX(id) AS id FROM myapp_maintable_suratmasuk"));
    
    // PUSH KEDALAM myapp_disptable_suratmasuk
    pushDispSM($ds_id_max["id"], 18, 7, "");
    
    //echo($sql);
	// encode the ID that passing via HTTP GET  Method
	$parse_id = encode($ds_id_max["id"]);
    header("location:../?mod=inform&pesan=1&redir=file_surat_masuk&id=" . $parse_id);
?>