<?php
    session_start();
    include("koneksi.php");
    
    // AMBIL USERNAME SAAT INI
    $ds = mysql_fetch_array(mysql_query("SELECT * FROM tbl_anggota_arsip WHERE id_anggota='" . $_SESSION["id_pengguna"] . "'"));
    if($_POST["pwd_now"] != $ds["password"])
        header("location:../?mod=pengguna&err_msg_ubah_pwd=Password Saat Ini Salah");
    else{
        if($_POST["pwd_new_1"] != $_POST["pwd_new_2"])
            header("location:../?mod=pengguna&err_msg_ubah_pwd=Password baru dan konfirmasi password baru tidak sama");
        else if($_POST["pwd_new_1"] == "" || $_POST["pwd_new_2"] == "")
            header("location:../?mod=pengguna&err_msg_ubah_pwd=Password baru dan konfirmasi password baru harus diisi");
        else{
            mysql_query("UPDATE tbl_anggota_arsip SET
                            password='" . $_POST["pwd_new_1"] . "'
                         WHERE id_anggota='" . $_SESSION["id_pengguna"] . "'");
            header("location:../?mod=pengguna&scs_msg_ubah_pwd=Password pengguna berhasil dirubah. Anda harus logout agar perubahan dapat berlaku");
        }
    }
?>