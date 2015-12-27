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
    $obj->nip_kesdip = $_POST["nip_kesdip"];
    $obj->nama_kesdip = $_POST["nama_kesdip"];
    $obj->id_pangkat_kesdip = $_POST["id_pangkat_kesdip"];
    $obj->no_smp = $_POST["no_smp"];
    $obj->tgl_smp = $_POST["tgl_smp"];
    $obj->no_spgl = $_POST["no_spgl"];
    $obj->tgl_spgl = $_POST["tgl_spgl"];
    $obj->nama_pejabat_spgl = $_POST["nama_pejabat_spgl"];
    $obj->nip_pejabat_spgl = $_POST["nip_pejabat_spgl"];
    $obj->jabatan_pejabat_spgl = $_POST["jabatan_pejabat_spgl"];
    $obj->id_pangkat_pejabat_spgl = $_POST["id_pangkat_pejabat_spgl"];
    $obj->hari_h_spgl = $_POST["hari_h_spgl"];
    $obj->tgl_h_spgl = $_POST["tgl_h_spgl"];
    $obj->jam_h_spgl = $_POST["jam_h_spgl"];
    $obj->tempat_h_spgl = $_POST["tempat_h_spgl"];
    $obj->membaca_sk = $_POST["membaca_sk"];
    $obj->menimbang_sk = $_POST["menimbang_sk"];
    $obj->mengingat_sk = $_POST["mengingat_sk"];
    $obj->memperhatikan_sk = $_POST["memperhatikan_sk"];
    $obj->tembusan_sk = $_POST["tembusan_sk"];
    $obj->no_sk = $_POST["no_sk"];
    $obj->tgl_sk = $_POST["tgl_sk"];
    $obj->nama_pejabat_sk = $_POST["nama_pejabat_sk"];
    $obj->nip_pejabat_sk = $_POST["nip_pejabat_sk"];
    $obj->jabatan_pejabat_sk = $_POST["jabatan_pejabat_sk"];
    $obj->id_pangkat_pejabat_sk = $_POST["id_pangkat_pejabat_sk"];
    
    $validation_result = $obj->Validation();
    if($validation_result == ""){
        $obj->Update();
        success();
    }else{
        something_wrong($validation_result);
    }
        
    //echo("Data telah disimpan");
?>