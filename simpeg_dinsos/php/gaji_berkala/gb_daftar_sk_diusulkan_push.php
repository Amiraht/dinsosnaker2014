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
    
    $ctr = 0;
    $id_sk = $_POST["id_sk"];
    $sql_daftar = "SELECT * FROM tbl_usulan_gaji_berkala_detail WHERE status = 1";
    $res_daftar = mysql_query($sql_daftar);
    while($ds_daftar = mysql_fetch_array($res_daftar)){
        // jika dia diceklist
        if(isset($_POST["chk_" . $ds_daftar["id_detail_gaji_berkala"]])){
            $ctr++;
            
            // editlah datanya sesuai dengan kebutuhan
            $id_detail_gaji_berkala = $ds_daftar["id_detail_gaji_berkala"];
            $sql_edit = "UPDATE tbl_usulan_gaji_berkala_detail SET id_sk='" . $id_sk . "', status='2' WHERE id_detail_gaji_berkala='" . $id_detail_gaji_berkala . "'";
            mysql_query($sql_edit);
        }
    }
    
    if($ctr == 0)
        something_wrong("Tidak data usulan yang dipilih");
    else
        success();
    //echo("Data usulan telah disimpan");
?>