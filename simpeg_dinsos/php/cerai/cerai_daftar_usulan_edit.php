<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    require_once("../model/ijin_cerai_model.php");
    
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
    
    $obj = new IjinCerai_Model();
    $obj->Record($_POST["id_cerai"]);
    $obj->nama_pasangan = $_POST["nama_pasangan"];
    $obj->pekerjaan_pasangan = $_POST["pekerjaan_pasangan"];
    $obj->id_agama_pasangan = $_POST["id_agama_pasangan"];
    $obj->alasan = $_POST["alasan"];
    $obj->no_sp = $_POST["no_sp"];
    $obj->tgl_sp = $_POST["tgl_sp"];
    $obj->nama_pejabat_sp = $_POST["nama_pejabat_sp"];
    $obj->nip_pejabat_sp = $_POST["nip_pejabat_sp"];
    $obj->jabatan_pejabat_sp = $_POST["jabatan_pejabat_sp"];
    $obj->id_pangkat_pejabat_sp = $_POST["id_pangkat_pejabat_sp"];
    $obj->status = 1;
    
    $validation_result = $obj->Validation();
    if($validation_result == ""){
        $obj->Update();
        success();
    }else{
        something_wrong($validation_result);
    }
        
    //echo("Data telah disimpan");
?>