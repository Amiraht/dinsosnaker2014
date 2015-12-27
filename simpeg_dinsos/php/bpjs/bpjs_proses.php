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
    
    $id_pegawai = $_POST["id_pegawai"];
    $no_bpjs = $_POST["no_bpjs"];
    $scan_bpjs = $_FILES["scan_bpjs"];   
    
    if($no_bpjs == "")
        something_wrong("Maaf, nomor BPJS harus diisi");
    else{
        // Cek, apakah data sudah pernah ada atau belum?
        $res_cek = mysql_query("SELECT * FROM tbl_bpjs WHERE id_pegawai='" . $id_pegawai . "'");
        if(mysql_num_rows($res_cek) == 0){
            // Berarti belum pernah diisi
            if($scan_bpjs["tmp_name"] == ""){
                $sql_insert = "INSERT INTO tbl_bpjs(id_pegawai, no_bpjs, scan_bpjs) VALUES('" . $id_pegawai . "', '" . $no_bpjs . "', '')";
                mysql_query($sql_insert);
                success();
            }
            else{
                // cek filenya. Harus PDF
                if(strtolower(ekstensi($scan_bpjs["name"])) != "pdf")
                    something_wrong("File yang diupload harus PDF");
                else{
                    // copy kan dulu file yang diupload nya kedalam folder jika filenya sudah PDF
                    $path = "../../sk_uploaded/bpjs/";
                    $nama_file_baru = "bpjs_" . $id_pegawai . ".pdf";
                    move_uploaded_file($scan_bpjs["tmp_name"], $path . $nama_file_baru);
                    $sql_insert = "INSERT INTO tbl_bpjs(id_pegawai, no_bpjs, scan_bpjs) VALUES('" . $id_pegawai . "', '" . $no_bpjs . "', '" . $nama_file_baru . "')";
                    mysql_query($sql_insert);
                    success();
                }        
            }
        }else{
            // Berarti sudah pernah diisi dan ingin diedit
            if($scan_bpjs["tmp_name"] == ""){
                $sql_edit = "UPDATE tbl_bpjs SET no_bpjs='" . $no_bpjs . "' WHERE id_pegawai='" . $id_pegawai . "'";
                mysql_query($sql_edit);
                success();
            }else{
                // cek filenya. Harus PDF
                if(strtolower(ekstensi($scan_bpjs["name"])) != "pdf")
                    something_wrong("File yang diupload harus PDF");
                else{
                    // copy kan dulu file yang diupload nya kedalam folder jika filenya sudah PDF
                    $path = "../../sk_uploaded/bpjs/";
                    $nama_file_baru = "bpjs_" . $id_pegawai . ".pdf";
                    move_uploaded_file($scan_bpjs["tmp_name"], $path . $nama_file_baru);
                    $sql_edit = "UPDATE tbl_bpjs SET no_bpjs='" . $no_bpjs . "', scan_bpjs='" . $nama_file_baru . "' WHERE id_pegawai='" . $id_pegawai . "'";
                    mysql_query($sql_edit);
                    success();
                }
            }
        }
    } 
    
?>
