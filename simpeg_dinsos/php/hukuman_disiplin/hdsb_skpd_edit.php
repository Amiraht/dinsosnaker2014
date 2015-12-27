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
    
    $keterangan = $_POST["keterangan"];
    
    if($keterangan==""){
        something_wrong("Maaf, input anda masih belum lengkap");
    }else{
        //echo($_POST["mengingat"] . "<br />");
        $obj = new UsulanHukumanDisiplin();
        $obj->Record($_POST["id_usulan"]);
        $obj->keterangan = $keterangan;
        $obj->Update();
        success();
    }
?>
