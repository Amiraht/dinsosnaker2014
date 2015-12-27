<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    require_once("../model/usulan_gaji_berkala_model.php");
    
    $obj = new UsulanGajiBerkala_Model();
    $obj->no_usulan = $_POST["no_usulan"];
    $obj->tgl_usulan = $_POST["tgl_usulan"];
    $obj->jabatan_ttd_usulan = $_POST["jabatan_ttd_usulan"];
    $obj->nama_ttd_usulan = $_POST["nama_ttd_usulan"];
    $obj->nip_ttd_usulan = $_POST["nip_ttd_usulan"];
    $obj->id_pangkat_ttd_usulan = $_POST["id_pangkat_ttd_usulan"];
    $obj->kode_skpd = isset($_SESSION["kode_skpd"]) ? $_SESSION["kode_skpd"] : "016";
    $obj->status = 1;
    
    $validation_result = $obj->Validation();
    if($validation_result == ""){
       $obj->Insert();
	   echo "
			<script>
				document.location.href = '../../?mod=gb_daftar_usulan_tambah&code=1';
			</script>
	   ";
    }else{
         echo "
			<script>
				document.location.href = '../../?mod=gb_daftar_usulan_tambah&code=2';
			</script>
	   ";
    }
        
    //echo("Data usulan telah disimpan");
?>