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
    
    // CARI. APAKAH NOMOR USULAN YANG DIMASUKKAN UDAH ADA
    $ds_udah_ada = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS jumlah FROM tbl_usulan_cuti WHERE no_usulan = '" . $_GET["no_usulan"] . "'"));
    if($ds_udah_ada["jumlah"] == 0){
        // AMBIL DAFTAR USULAN SKPD YANG BERSANGKUTAN
        $sql_list_pegawai = "SELECT
                            	e.id_usulan
                            FROM
                            	tbl_pegawai a
                            	LEFT JOIN ref_pangkat b ON a.id_pangkat = b.id_pangkat
                            	LEFT JOIN ref_jabatan c ON a.id_jabatan = c.id_jabatan
                            	LEFT JOIN ref_skpd d ON a.id_satuan_organisasi = d.id_skpd
                            	LEFT JOIN tbl_usulan_cuti e ON (a.id_pegawai = e.id_pegawai AND e.no_usulan IS NULL)
                            WHERE
                            	d.kode_skpd LIKE '" . $_SESSION["simpeg_kode_skpd"] . "%' AND e.id_pegawai IS NOT NULL
                            ORDER BY
                            		a.nama_pegawai ASC";
        $res_list_pegawai = mysql_query($sql_list_pegawai);
        while($ds_list_pegawai = mysql_fetch_array($res_list_pegawai)){
            $id_usulan = $ds_list_pegawai["id_usulan"];
            mysql_query("UPDATE tbl_usulan_cuti SET no_usulan='" . $_GET["no_usulan"] . "', tgl_usulan='" . $_GET["tgl_usulan"] . "', pejabat_usulan='" . $_GET["pejabat_usulan"] . "', diproses=4 WHERE id_usulan='" . $id_usulan . "'");
        }
        success();
    }else{
        something_wrong("Maaf, nomor usulan <b>" . $_GET["no_usulan"] . "</b> sudah ada");
    }
    
    
    //header("location:../../?mod=cuti_daftar_usulan");
?>