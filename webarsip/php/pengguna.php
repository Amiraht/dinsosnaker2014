<?php
    session_start();
    include("koneksi.php");
    
    $id_unit_kerja = 0;
    if($_POST["id_level_pengguna"] == 2)
        $id_unit_kerja = $_POST["id_unit_kerja"];
    mysql_query("UPDATE tbl_anggota_arsip SET
                    nama_lengkap='" . $_POST["nama_lengkap"] . "',
                    id_jenis_kelamin='" . $_POST["id_jenis_kelamin"] . "',
                    tgl_lahir='" . $_POST["tgl_lahir"] . "',
                    alamat='" . $_POST["alamat"] . "',
                    no_kontak='" . $_POST["no_kontak"] . "',
                    email='" . $_POST["email"] . "',
                    id_level_pengguna='" . $_POST["id_level_pengguna"] . "',
                    pekerjaan='" . $_POST["pekerjaan"] . "',
                    id_unit_kerja='" . $id_unit_kerja . "',
                    alamat_unit_kerja='" . $_POST["alamat_unit_kerja"] . "',
                    jabatan='" . $_POST["jabatan"] . "'
                 WHERE id_anggota='" . $_SESSION["id_pengguna"] . "'");
    header("location:../?mod=pengguna&scs_msg_pengguna=Data pengguna berhasil dirubah. Anda harus logout agar perubahan dapat berlaku");
?>