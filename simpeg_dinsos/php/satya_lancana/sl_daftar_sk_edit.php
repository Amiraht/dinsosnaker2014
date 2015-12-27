<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    require_once("../model/sk_satya_lancana_model.php");
    
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
    
    $obj = new SKSatyaLancana_Model();
    $obj->Record($_POST["id_usulan"]);
    $obj->no_usulan = $_POST["no_usulan"];
    $obj->tgl_usulan = $_POST["tgl_usulan"];
    $obj->jabatan_ttd_usulan = $_POST["jabatan_ttd_usulan"];
    $obj->nama_ttd_usulan = $_POST["nama_ttd_usulan"];
    $obj->nip_ttd_usulan = $_POST["nip_ttd_usulan"];
    $obj->id_pangkat_ttd_usulan = $_POST["id_pangkat_ttd_usulan"];
    
    $validation_result = $obj->Validation();
    if($validation_result == ""){
        $obj->Update();
        success();
    }else{
        something_wrong($validation_result);
    }
        
    //echo("Data usulan telah disimpan");
?>