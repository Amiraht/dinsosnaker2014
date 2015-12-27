<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    
    function something_wrong($what_is_wrong){
        echo("
            <script type='text/javascript'>
                window.parent.window.something_wrong(\"" . $what_is_wrong . "\");
            </script>
        ");
    }
    function success(){
        echo("
            <script type='text/javascript'>
                window.parent.window.success();
            </script>
        ");
    }
    
    $id_usulan = $_POST["id_usulan"];
    $nama_pasangan = $_POST["nama_pasangan"];
    $pekerjaan_pasangan = $_POST["pekerjaan_pasangan"];
    $id_agama_pasangan = $_POST["id_agama_pasangan"];
    $no_sk = $_POST["no_sk"];
    $tgl_sk = $_POST["tgl_sk"];
    $pejabat_sk = $_POST["pejabat_sk"];
    $tgl_tidak_rujuk_lagi = $_POST["tgl_tidak_rujuk_lagi"];
    $tgl_tidak_serumah_lagi = $_POST["tgl_tidak_serumah_lagi"];
    $scan_sk = $_FILES["scan_sk"];
    
    if($nama_pasangan=="" || $pekerjaan_pasangan=="" || $id_agama_pasangan=="0" || $no_sk=="" || $tgl_sk=="" || $pejabat_sk==""){
        something_wrong("Maaf, input anda belum lengkap");
    }else{
        if($scan_sk["tmp_name"] == ""){
            something_wrong("File scan SK harus diupload");
        }else{
            $nama_file_asli = $scan_sk["name"];
            $tmp_file_asli = $scan_sk["tmp_name"];
            if(strtolower(ekstensi($nama_file_asli)) != "pdf"){
                something_wrong("Maaf, file yang diupload harus berformat PDF");
            }else{
                // find the id_pegawai from the id_usulan
                $ds_usulan = mysql_fetch_array(mysql_query("SELECT * FROM tbl_usulan_cerai WHERE id_usulan='" . $id_usulan . "'"));
                $id_pegawai = $ds_usulan["id_pegawai"];
                
                $folder_path = "../../sk_uploaded/cerai/";
                
                // find the right filename in order to avoid
                // overwritting the file with the same name
                $urut = 1;
                while(file_exists($folder_path . "cerai_" . $id_pegawai . "_" . $urut . ".pdf")){
                    $urut++;
                }
                $nama_file_baru = "cerai_" . $id_pegawai . "_" . $urut . ".pdf";
                
                // copying the uploaded file to the website folder
                move_uploaded_file($tmp_file_asli, $folder_path . $nama_file_baru);
                
                // and the last move is
                // store the data to database and set diproses field to 1
                $sql_insert = "INSERT INTO tbl_riwayat_cerai(
                                    id_pegawai, nama_pasangan, pekerjaan_pasangan, id_agama_pasangan,
                                    no_sk, tgl_sk, pejabat_sk,
                                    tgl_tidak_rujuk_lagi, tgl_tidak_serumah_lagi,
                                    scan_sk, id_usulan
                                )
                                VALUES(
                                    '" . $id_pegawai . "', '" . $nama_pasangan . "', '" . $pekerjaan_pasangan . "', '" . $id_agama_pasangan . "',
                                    '" . $no_sk . "', '" . $tgl_sk . "', '" . $pejabat_sk . "',
                                    '" . $tgl_tidak_rujuk_lagi . "', '" . $tgl_tidak_serumah_lagi . "',
                                    '" . $nama_file_baru . "', '" . $id_usulan . "'
                                )";
                $sql_update = "UPDATE tbl_usulan_cerai SET diproses=1 WHERE id_usulan='" . $id_usulan . "'";
                mysql_query($sql_insert);
                mysql_query($sql_update);
                
                // process finished successfully
                success();
            }
        }
    }
    
?>
