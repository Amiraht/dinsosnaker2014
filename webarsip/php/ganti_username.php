<?php
    session_start();
    include("koneksi.php");
    
    // CEK APAKAH USERNAME YANG BARU ITU UDAH ADA YANG PUNYA
    $res_cek = mysql_query("SELECT * FROM tbl_anggota_arsip WHERE id_anggota <> '" . $_SESSION["id_pengguna"] . "' AND username='" . $_POST["username"] . "'");
    if(mysql_num_rows($res_cek) == 0){
        mysql_query("UPDATE tbl_anggota_arsip SET
                        username='" . $_POST["username"] . "'
                     WHERE id_anggota='" . $_SESSION["id_pengguna"] . "'");
        header("location:../?mod=pengguna&scs_msg_ubah_usr=Username pengguna berhasil dirubah. Anda harus logout agar perubahan dapat berlaku");
    }else{
        header("location:../?mod=pengguna&err_msg_ubah_usr=Username pengguna telah digunakan oleh pengguna lain. Harap gunakan username lain");
    }
?>