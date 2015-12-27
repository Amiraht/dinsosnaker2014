<?php
    session_start();
    include("koneksi.php");
    include("fungsi.php");
    $salah=0;
    if($_POST["id_masalah"] == 0)
        $salah++;
    if($_POST["id_ttd"] == 0)
        $salah++;
    if(($_SESSION["id_level"]>=20 && $_SESSION["id_level"]<=25) && $_POST["kasubbid"] == 0)
        $salah++;
    if($salah == 0){
        $peneken_nota = $_SESSION["atasan"];
        if($_POST["id_ttd"] > 1){
            $peneken_nota = 1;
        }
        // AMBIL noreg SURAT MASUK DAN KEMUDIAN UPDATE NOREG NYA DENGAN MENAMBAHKAN !
        $ds_noreg = mysql_fetch_array(mysql_query("SELECT * FROM myapp_consttable_noreg WHERE id=1"));
        $noreg = $ds_noreg["reg_sk"];
        mysql_query("UPDATE myapp_consttable_noreg SET reg_sk=reg_sk+1 WHERE id=1");
    
        $sql = "INSERT INTO myapp_maintable_suratkeluar (id, no_surat, tgl_surat, tgl_kirim, perihal_surat, tujuan_surat, alamat_tujuan, judul_surat, deskripsi_surat, catatan, id_skpd_tujuan, id_masalah, id_jenis_surat, id_level_pembuat, status, asal_disposisi, tujuan_disposisi, id_pengguna_pembuat, id_ttd, no_nodin, tgl_nodin, noreg) VALUES 
                (NULL, '$_POST[no_surat]', '$_POST[tgl_surat]', '$_POST[tgl_kirim]', '$_POST[perihal_surat]', '$_POST[tujuan_surat]', '$_POST[alamat_tujuan]', '$_POST[judul_surat]', '$_POST[deskripsi_surat]', '$_POST[catatan]', '$_POST[id_skpd_tujuan]', '$_POST[id_masalah]', '$_POST[id_jenis_surat]', '$_SESSION[id_level]', 1, '$_SESSION[id_level]', '$_SESSION[atasan]', '$_SESSION[id_pengguna]', '$_POST[id_ttd]', '', CURDATE(), '" . $noreg . "')";
        mysql_query($sql);
        
        // MENCARI ID SURAT KELUAR YANG BARU DIMASUKKAN
        $ds_id_max = mysql_fetch_array(mysql_query("SELECT MAX(id) AS id FROM myapp_maintable_suratkeluar"));
        
        // PUSH KEDALAM myapp_disptable_suratkeluar
        if($_SESSION["id_level"] == 20 || $_SESSION["id_level"] == 21 || $_SESSION["id_level"] == 22 || $_SESSION["id_level"] == 23 || $_SESSION["id_level"] == 25){
            pushDispSK($ds_id_max["id"], $_SESSION["id_level"], $_POST["kasubbid"], "Surat keluar telah dibuat", 1, $_SESSION["id_pengguna"]);
        }else if($_SESSION["id_level"] >= 3 && $_SESSION["id_level"] <= 6){
            pushDispSK($ds_id_max["id"], $_SESSION["id_level"], 2, "Surat keluar telah dibuat", 1, $_SESSION["id_pengguna"]);
        }else if($_SESSION["id_level"] >=7 && $_SESSION["id_level"] <= 17){
            pushDispSK($ds_id_max["id"], $_SESSION["id_level"], $_SESSION["atasan"], "Surat keluar telah dibuat", 1, $_SESSION["id_pengguna"]);
        }
        
        // PUSH KEDALAM DATA SURAT BALASAN
        $id_surat_keluar = $ds_id_max["id"];
        mysql_query("INSERT INTO myapp_maintable_balasan(id_surat_masuk, id_surat_keluar)
                     SELECT id_surat_masuk, '" . $id_surat_keluar . "' FROM myapp_sessiontable_balasan WHERE session_id = '" . session_id() . "'");
                     
        // HAPUS TEMPORARY SURAT BALASAN
        mysql_query("DELETE FROM myapp_sessiontable_balasan WHERE session_id='" . session_id() . "'");
        
        //echo($sql);
        header("location:../?mod=inform&pesan=12&redir=file_surat_keluar&id=" . $ds_id_max["id"]);
    }else{
        header("location:../?mod=buat_surat_keluar&err=Maaf, input anda belum lengkap. Masalah, Sub Masalah, Peneken Surat, Serta Tujuan disposisi kasubbid/kasubbag harus diisi");
    }
?>