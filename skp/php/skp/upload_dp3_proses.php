<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    $skp = $_FILES["skp"];
    $penilaian = $_FILES["penilaian"];
    $dp3 = $_FILES["dp3"];
    
    $nama_file_skp = $skp["name"];
    $nama_file_penilaian = $penilaian["name"];
    $nama_file_dp3 = $dp3["name"];
    
    if((strtolower(ekstensi($nama_file_skp)) != "pdf" && $nama_file_skp != "") || (strtolower(ekstensi($nama_file_penilaian)) != "pdf" && $nama_file_penilaian != "") || (strtolower(ekstensi($nama_file_dp3)) != "pdf" && $nama_file_dp3 != "")){
        header("location:../../?mod=upload_dp3_proses&id=" . $_POST["id_skp"] . "&err_msg=Ekstensi file yang di upload harus PDF");
    }else{
        // PROSES UPLOAD SKP
        if($skp["tmp_name"] != ""){
            $handle_skp = fopen($skp["tmp_name"], "r");
            $bacafile_skp = fread($handle_skp, filesize($skp["tmp_name"]));
            $hex_skp = $bacafile_skp;
            fclose($handle_skp);
        }
        
        // PROSES UPLOAD PENILAIAN
        if($penilaian["tmp_name"] != ""){
            $handle_penilaian = fopen($penilaian["tmp_name"], "r");
            $bacafile_penilaian = fread($handle_penilaian, filesize($penilaian["tmp_name"]));
            $hex_penilaian = $bacafile_penilaian;
            fclose($handle_penilaian);
        }
        
        // PROSES UPLOAD DP3
        if($dp3["tmp_name"] != ""){
            $handle_dp3 = fopen($dp3["tmp_name"], "r");
            $bacafile_dp3 = fread($handle_dp3, filesize($dp3["tmp_name"]));
            $hex_dp3 = $bacafile_dp3;
            fclose($handle_dp3);
        }
        
        $res_cek = mysql_query("SELECT * FROM tbl_skp_dp3_upload WHERE id_skp='" . $_POST["id_skp"] . "'");
        if(mysql_num_rows($res_cek) == 0){
            $yang_diupload = array();
            
            if($skp["tmp_name"] != ""){
                array_push($yang_diupload, "'" . mysql_real_escape_string($hex_skp) . "'");
            }else{
                array_push($yang_diupload, "null");
            }
            
            if($penilaian["tmp_name"] != ""){
                array_push($yang_diupload, "'" . mysql_real_escape_string($hex_penilaian) . "'");
            }else{
                array_push($yang_diupload, "null");
            }
            
            if($dp3["tmp_name"] != ""){
                array_push($yang_diupload, "'" . mysql_real_escape_string($hex_dp3) . "'");
            }else{
                array_push($yang_diupload, "null");
            }
            
            $kumpulin_yang_diupload = implode(", ", $yang_diupload);
            mysql_query("INSERT INTO tbl_skp_dp3_upload VALUES('" . $_POST["id_skp"] . "', " . $kumpulin_yang_diupload . ", 1)");
            //echo("INSERT INTO tbl_skp_dp3_upload VALUES('" . $_POST["id_skp"] . "', " . $kumpulin_yang_diupload . ", 1)");
        }else{
            $update = array();
            if($skp["tmp_name"] != "")
                array_push($update, "skp='" . mysql_real_escape_string($hex_skp) . "'");
            if($penilaian["tmp_name"] != "")
                array_push($update, "penilaian='" . mysql_real_escape_string($hex_penilaian) . "'");
            if($dp3["tmp_name"] != "")
                array_push($update, "dp3='" . mysql_real_escape_string($hex_dp3) . "'");
            
            $str_update = implode(", ", $update);
            mysql_query("UPDATE tbl_skp_dp3_upload SET status_supervisi=1, " . $str_update . " WHERE id_skp='" . $_POST["id_skp"] . "'");
        }
        
        // whatever happened, delete the marker data form tbl_skp_dp3_upload_pemeriksaan
        mysql_query("DELETE FROM tbl_skp_dp3_upload_pemeriksaan WHERE id_skp='" . $_POST["id_skp"] . "'");
        header("location:../../?mod=upload_dp3_proses&id=" . $_POST["id_skp"]);
    }
?>