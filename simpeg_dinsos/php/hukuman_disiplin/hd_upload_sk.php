<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    include("../model/usulan_hukuman_disiplin_model.php");
    
    function something_wrong($what_is_wrong){
        echo("
            <script type='text/javascript'>
                window.parent.window.something_wrong_upload(\"" . $what_is_wrong . "\");
            </script>
        ");
    }
    function debug($what_is_wrong){
        echo("
            <script type='text/javascript'>
                window.parent.window.debug(\"" . $what_is_wrong . "\");
            </script>
        ");
    }
    function success(){
        echo("
            <script type='text/javascript'>
                window.parent.window.success_upload();
            </script>
        ");
    }
    
    $scan_sk = $_FILES["scan_sk"];
    $id_usulan = $_POST["id_usulan"];
    if($scan_sk["tmp_name"] == ""){
        something_wrong("Pilih file yang akan diupload");
    }else{
        if(strtolower(ekstensi($scan_sk["name"])) != "pdf"){
            something_wrong("Maaf, file yang diupload harus berformat PDF");
        }else{
            $path = "../../sk_uploaded/hukuman_disiplin/";
            $nama_file_baru = "sk_hukuman_disiplin_" . $id_usulan . ".pdf";
            move_uploaded_file($scan_sk["tmp_name"], $path . $nama_file_baru);
            //echo($scan_sk["tmp_name"] . "<br />");
            //echo($path . $nama_file_baru . "<br />");
            
            // EDIT DATA SCAN SK PADA DATA
            $obj = new UsulanHukumanDisiplin();
            $obj->Record($id_usulan);
            $obj->scan_sk = $nama_file_baru;
            $obj->Update();
            
            success();
        }
    }
?>
