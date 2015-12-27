<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    require_once("../model/sk_gaji_berkala_model.php");
    
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
    
    $obj = new SKGajiBerkala_Model();
    $obj->Record($_POST["id_sk"]);
    $obj->no_sk = $_POST["no_sk"];
    $obj->tgl_sk = $_POST["tgl_sk"];
    $obj->jabatan_ttd_sk = $_POST["jabatan_ttd_sk"];
    $obj->nama_ttd_sk = $_POST["nama_ttd_sk"];
    $obj->nip_ttd_sk = $_POST["nip_ttd_sk"];
    $obj->id_pangkat_ttd_sk = $_POST["id_pangkat_ttd_sk"];
    
    $validation_result = $obj->Validation();
    if($validation_result == ""){
        $obj->Update();
        success();
    }else{
        something_wrong($validation_result);
    }
        
    //echo("Data usulan telah disimpan");
?>