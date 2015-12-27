<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    $qs_add = "";
    $ds_pengguna = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pengguna WHERE id_user='" . $_SESSION["simpeg_id_pengguna"] . "'"));
    $password_lama = $ds_pengguna["password"];
    if($_POST["password_baru_1"] != $_POST["password_baru_2"])
        $qs_add = "&err_msg=Maaf, Password baru dan password baru yang kedua harus sama. Untuk mengantisipasi kesalahan pengetikan";
    else if($_POST["password"] != $password_lama)
        $qs_add = "&err_msg=Maaf, Password lama yang anda masukkan salah. Hal ini untuk mengantisipasi pengguna lain yang ingin merubah password Anda.";
    else{
        mysql_query("UPDATE tbl_pengguna SET password='" . $_POST["password_baru_1"] . "' WHERE id_user='" . $_SESSION["simpeg_id_pengguna"] . "'");
        $qs_add = "&success_msg=Password anda telah berhasil diubah. Untuk login berikutnya, silahkan menggunakan password baru anda";
    }
    header("location:../../?mod=pengguna" . $qs_add);
?>