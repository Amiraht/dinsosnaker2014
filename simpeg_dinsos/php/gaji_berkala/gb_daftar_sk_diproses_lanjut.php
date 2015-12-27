<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    require_once("../model/riwayat_gaji_berkala_model.php");
    
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
    
    // SIMPAN DATANYA
    $obj = new RiwayatGajiBerkala_Model();
    $obj->id_pegawai = $_POST["id_pegawai"];
    $obj->tmt = $_POST["tmt"];
    $obj->no_sk = $_POST["no_sk"];
    $obj->tgl_sk = $_POST["tgl_sk"];
    $obj->nama_pejabat_ttd_sk = $_POST["nama_pejabat_ttd_sk"];
    $obj->nip_pejabat_ttd_sk = $_POST["nip_pejabat_ttd_sk"];
    $obj->jabatan_pejabat_ttd_sk = $_POST["jabatan_pejabat_ttd_sk"];
    $obj->id_pangkat_pejabat_ttd_sk = $_POST["id_pangkat_pejabat_ttd_sk"];
    $obj->id_peraturan_gaji = $_POST["id_peraturan_gaji"];
    $obj->id_jenis_gaji = $_POST["id_jenis_gaji"];
    $obj->scan_sk = $_POST["scan_sk"];
    
    $val_res = $obj->Validation();
    if($val_res != "")
        something_wrong($val_res);
    else{
        $obj->Insert();
        
        // UBAH STATUS JADI 3 DI DETAIL USULAN GAJI BERKALA
        $sql_edit = "UPDATE tbl_usulan_gaji_berkala_detail SET status='3' WHERE id_detail_gaji_berkala='" . $_POST["id_detail_gaji_berkala"] . "'";
        mysql_query($sql_edit);
        
        success();
    }
        
    //echo("Data usulan telah disimpan");
?>