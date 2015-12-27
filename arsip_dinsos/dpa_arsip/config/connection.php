<?php
    /**
     * UBAH SESUAI DENGAN KEBUTUHAN
     * ==============================================================
     * $host : berisi IP dari server. Biasanya localhost (127.0.0.1)
     * $username : berisi username MySQL
     * $password : berisi password MySQL
     * $port : berisi port MySQL (default : 3306)
     * $database : berisi nama database nya
     * ==============================================================
     */
     $host = "192.168.0.121";
     $username = "root";
     $password = "arsip";
     $port = "3306";
     $database = "db_arsip";
     $link_identifier = mysql_connect($host, $username, $password);
     if(!$link_identifier){
        echo "<h3 style='color: red;'>Uuppss.. tidak bisa terhubung ke MySQL \"" . mysql_error() . "\"</h3>";
     }else{
        $connect_identifier = mysql_select_db($database, $link_identifier);
        if($$connect_identifier){
            echo "<h3 style='color: red;'>Uuppss.. tidak bisa terhubung ke database " . $database . " \"" . mysql_error() . "\"</h3>";
        }
     }
?>