<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    include("../model/usulan_hukuman_disiplin_model.php");
    
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
    $id_pegawai = detail_pegawai_by_nip($_POST["nip"], "id_pegawai");
    $keterangan = $_POST["keterangan"];    
    $status = 1;
    $pemisah_hukuman = 2;
    
    if($id_pegawai == 0){
        something_wrong("Maaf, pegawai tidak ditemukan. Pilih pegawai dahulu");
    }else if($keterangan==""){
        something_wrong("Maaf, input anda masih belum lengkap");
    }else{
        //echo($_POST["mengingat"] . "<br />");
        $obj = new UsulanHukumanDisiplin();
        $obj->id_pegawai = $id_pegawai;
        $obj->keterangan = $keterangan;
        $obj->status = $status;
        $obj->pemisah_hukuman = $pemisah_hukuman;
        $obj->Insert();
        success();
    }
?>
