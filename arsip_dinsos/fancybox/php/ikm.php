<?php
    session_start();
    include("koneksi.php");
    if(!isset($_POST["a"]) || !isset($_POST["b"]) || !isset($_POST["c"]) || !isset($_POST["d"]) || !isset($_POST["e"]) || 
        !isset($_POST["f"]) || !isset($_POST["g"]) || !isset($_POST["h"]) || !isset($_POST["i"]) || !isset($_POST["j"]) || 
        !isset($_POST["k"]) || !isset($_POST["l"]) || !isset($_POST["m"]) || !isset($_POST["n"])){
            header("location:../?mod=info&pesan=4&redir=ikm");
    }else{
        mysql_query("INSERT INTO tbl_jawaban_ikm VALUES(
            null, '" . $_SESSION["id_pengguna"] . "', CURDATE(),
            '" . $_POST["a"] . "', '" . $_POST["b"] . "', '" . $_POST["c"] . "', '" . $_POST["d"] . "', '" . $_POST["e"] . "',
            '" . $_POST["f"] . "', '" . $_POST["g"] . "', '" . $_POST["h"] . "', '" . $_POST["i"] . "', '" . $_POST["j"] . "',
            '" . $_POST["k"] . "', '" . $_POST["l"] . "', '" . $_POST["m"] . "', '" . $_POST["n"] . "'  
        )");
        header("location:../?mod=info&pesan=3");
    }
?>