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
    
    //$id_pegawai = detail_pegawai_by_nip($_POST["nip"], "id_pegawai");
    $kode_skpd = $_POST["kode_skpd_input"];
    $jabatan_list = $_POST["jabatan_list"];
    $tahun = $_POST["tahun_lhkpn"];
    
    if($jabatan_list == "")
        something_wrong("Maaf, pilih jabatan yang akan di simpan sebagai wajib LHKPN");
    else if($tahun == "")
        something_wrong("Maaf, tahun harus diisi");
    else{
        /* DISINI CODING LAMA
        // Cari profil pangkat, jabatan, dan SKPD nya
        $sql_profil = "SELECT id_pangkat, id_jabatan, id_satuan_organisasi FROM tbl_pegawai WHERE id_pegawai = '" . $id_pegawai . "'";
        $res_profil = mysql_query($sql_profil);
        $ds_profil = mysql_fetch_array($res_profil);
        
        $id_pangkat = $ds_profil["id_pangkat"];
        $id_skpd = $ds_profil["id_satuan_organisasi"];
        $id_jabatan = $ds_profil["id_jabatan"];
        
        // Simpan datanya
        $sql_insert = "INSERT INTO tbl_lhkpn_wajib(id_pegawai, id_pangkat, id_skpd, id_jabatan, tahun)
                        VALUES('" . $id_pegawai . "', '" . $id_pangkat . "', '" . $id_skpd . "', '" . $id_jabatan . "', '" . $tahun . "')";
        mysql_query($sql_insert);*/
        
        // 1. Pecah jabatan list nya
        $whr_jabatan = "";
        $arr_jabatan = explode("<s>", $jabatan_list);
        for($i=0; $i<count($arr_jabatan); $i++){
            if($arr_jabatan[$i] != ""){
                if($i==0)
                    $whr_jabatan .= "h.jabatan LIKE '" . $arr_jabatan[$i] . "%'";
                else
                    $whr_jabatan .= "OR h.jabatan LIKE '" . $arr_jabatan[$i] . "%'";
            }
        }
        
        // 2. Bentuk SQL nya
        $sql = "INSERT INTO tbl_lhkpn_wajib(id_pegawai, id_pangkat, id_skpd, id_jabatan, tahun)
                SELECT
                	a.id_pegawai, a.id_pangkat, a.id_satuan_organisasi, a.id_jabatan, '" . $tahun . "'
                FROM
                	tbl_pegawai a
                	LEFT JOIN ref_status_kepegawaian b ON a.id_status_kepegawaian = b.id_status_kepegawaian
                	LEFT JOIN ref_jenis_kepegawaian c ON a.id_jenis_kepegawaian = c.id_jenis_kepegawaian
                	LEFT JOIN ref_kedudukan_kepegawaian d ON a.id_kedudukan_kepegawaian = d.id_kedudukan_kepegawaian
                	LEFT JOIN ref_jenis_kelamin e ON a.id_jenis_kelamin = e.id_jenis_kelamin
                	LEFT JOIN ref_skpd f ON a.id_satuan_organisasi = f.id_skpd
                	LEFT JOIN ref_pangkat g ON a.id_pangkat = g.id_pangkat
                	LEFT JOIN ref_jabatan h ON a.id_jabatan = h.id_jabatan
                	LEFT JOIN tbl_lhkpn_wajib i ON (a.id_pegawai = i.id_pegawai AND i.tahun = '" . $tahun . "')
                WHERE
                	(a.id_status_kepegawaian = 1 OR a.id_status_kepegawaian = 4 OR a.id_status_kepegawaian = 3)
                	AND i.id_pegawai IS NULL AND f.kode_skpd LIKE '" . $kode_skpd . "%' AND
                	(" . $whr_jabatan . ")
                GROUP BY
                	a.id_pegawai
                ORDER BY
                	a.nama_pegawai, f.kode_skpd";
        mysql_query($sql);
        success();
    }
    
?>
