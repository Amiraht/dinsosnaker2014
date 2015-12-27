<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once("../../../php/dompdf_config.inc.php"); ?>
<?php require_once("../../../php/koneksi.php"); ?>
<?php require_once("../../../php/fungsi.php"); ?>
<?php require_once("../../../php/model/sk_satya_lancana_model.php"); ?>
<?php date_default_timezone_set("America/New_York"); ?>
<?php
    /* CONTROLLER */
    $sk = new SKSatyaLancana_Model();
    $sk->Record($_GET["id_usulan"]);
    $no_sk = ($sk->no_usulan == "") ? "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" : $sk->no_usulan;
    $tgl_sk = ($sk->tgl_usulan == "0000-00-00") ? "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" : tglpjgindonesia($sk->tgl_usulan);
    
    $daftar = array();
    $sql_daftar = "SELECT
                    	a.id_pegawai, a.nama_pegawai, a.nip,
                    	CASE
                    		WHEN a.gelar_depan <> '' THEN CONCAT(a.gelar_depan, '. ')
                    		ELSE ''
                    	END AS gelar_depan,
                    	CASE
                    		WHEN a.gelar_belakang <> '' THEN CONCAT(', ', a.gelar_belakang)
                    		ELSE ''
                    	END AS gelar_belakang,
                    	b.status_kepegawaian, c.jenis_kepegawaian, d.kedudukan_kepegawaian,
                    	e.jenis_kelamin, a.alamat, a.tanggal_lahir, f.skpd, g.pangkat, g.gol_ruang, h.jabatan,
                    	i.id_detail_satya_lencana, i.jenis_satya, i.status
                    FROM
                    	tbl_pegawai a
                    	LEFT JOIN ref_status_kepegawaian b ON a.id_status_kepegawaian = b.id_status_kepegawaian
                    	LEFT JOIN ref_jenis_kepegawaian c ON a.id_jenis_kepegawaian = c.id_jenis_kepegawaian
                    	LEFT JOIN ref_kedudukan_kepegawaian d ON a.id_kedudukan_kepegawaian = d.id_kedudukan_kepegawaian
                    	LEFT JOIN ref_jenis_kelamin e ON a.id_jenis_kelamin = e.id_jenis_kelamin
                    	LEFT JOIN ref_skpd f ON a.id_satuan_organisasi = f.id_skpd
                    	LEFT JOIN ref_pangkat g ON a.id_pangkat = g.id_pangkat
                    	LEFT JOIN ref_jabatan h ON a.id_jabatan = h.id_jabatan
                    	INNER JOIN tbl_usulan_satya_lancana_detail i ON (a.id_pegawai = i.id_pegawai AND i.id_sk = '" . $_GET["id_usulan"] . "')
                    ORDER BY
                    	i.id_detail_satya_lencana ASC";
						
    $res_daftar = mysql_query($sql_daftar);
	
    while($ds_daftar = mysql_fetch_array($res_daftar)){
        $row_daftar["nama_pegawai"] = $ds_daftar["nama_pegawai"];
        $row_daftar["gelar_depan"] = $ds_daftar["gelar_depan"];
        $row_daftar["gelar_belakang"] = $ds_daftar["gelar_belakang"];
        $row_daftar["nip"] = $ds_daftar["nip"];
        $row_daftar["pangkat"] = $ds_daftar["pangkat"];
        $row_daftar["gol_ruang"] = $ds_daftar["gol_ruang"];
        $row_daftar["jabatan"] = $ds_daftar["jabatan"];
        $row_daftar["jenis_satya"] = $ds_daftar["jenis_satya"];
        array_push($daftar, $row_daftar);
    }
    /* END OF CONTROLLER */
?>
<?php
    $html = "<div style='font-family: sans-serif; font-size: 9pt;'>";
    
    $html .= "<div style='height: 1cm;'>&nbsp;</div>";
    
    $html .= "<div style='margin-left: 250px; line-height: 15px;'>";
        $html .= "<div style='text-align: left; text-transform: uppercase;'>DAFTAR LAMPIRAN : SURAT KEPALA BKD KOTA MEDAN TENTANG USUL UNTUK</div>";
        $html .= "<div style='margin-left: 30px; text-align: left; text-transform: uppercase;'>MENDAPATKAN TANDA KEHORMATAN SATYA LANCANA KARYA</div>";
        $html .= "<div style='margin-left: 30px; text-align: left; text-transform: uppercase;'>SATYA XXX, XX, DAN X TAHUN</div>";
        $html .= "<div style='margin-left: 30px; text-align: left; text-transform: uppercase;'>NOMOR : " . $no_sk . "</div>";
        $html .= "<div style='margin-left: 30px; text-align: left; text-transform: uppercase;'>TANGGAL : " . $tgl_sk . "</div>";
    $html .= "</div>";
    
    $html .= "<div style='height: 1cm;'>&nbsp;</div>";
    
    $html .= "<table style='width: 100%;' border='1px' cellspacing='0' cellpadding='5'>";
        $html .= "<thead>";
            $html .= "<tr>";
                $html .= "<th style='width: 3%; text-align: center;'>NO.</th>";
                $html .= "<th style='width: 25%; text-align: center;'>NAMA / NIP</th>";
                $html .= "<th style='text-align: center;'>PANGKAT / JABATAN</th>";
                $html .= "<th style='width: 20%; text-align: center;'>SATYALANCANA KARYA SATYA</th>";
            $html .= "</tr>";
            $html .= "<tr>";
                $html .= "<th style='text-align: center;'>1</th>";
                $html .= "<th style='text-align: center;'>2</th>";
                $html .= "<th style='text-align: center;'>3</th>";
                $html .= "<th style='text-align: center;'>4</th>";
            $html .= "</tr>";
        $html .= "</thead>";
        $html .= "<tbody>";
            $ctr = 0;
            foreach($daftar as $list){
                $ctr++;
                $html .= "<tr>";
                    $html .= "<td style='text-align: center; text-transform: capitalize;'>" . $ctr . "</td>";
                    $html .= "<td style='text-align: left; text-transform: capitalize;'>" . $list["gelar_depan"] . $list["nama_pegawai"] . $list["gelar_belakang"] . "<br />NIP. " . $list["nip"] . "</td>";
                    $html .= "<td style='text-align: left; text-transform: capitalize;'>" . $list["pangkat"] . " (" . $list["gol_ruang"] . ")" . "<br />" . $list["jabatan"] . "</td>";
                    $html .= "<td style='text-align: center; text-transform: uppercase;'>" . $list["jenis_satya"] . " TAHUN</td>";
                $html .= "</tr>";
            }
        $html .= "</tbody>";
    $html .= "</table>";
    
    $html .= "<div style='height: 1cm;'>&nbsp;</div>";
    
    $html .= "<div style='margin-left: 300px; line-height: 15px;'>";
        $html .= "<div style='text-align: center; text-transform: uppercase;'>" . $sk->jabatan_ttd_usulan . "</div>";
        
        $html .= "<div style='height: 2cm;'>&nbsp;</div>";
        
        $html .= "<div style='text-align: center; text-transform: uppercase;'>" . $sk->nama_ttd_usulan . "</div>";
        $html .= "<div style='text-align: center; text-transform: uppercase;'>" . apa_pangkat($sk->id_pangkat_ttd_usulan) . "</div>";
        $html .= "<div style='text-align: center; text-transform: uppercase;'>NIP : " . $sk->nip_ttd_usulan . "</div>";
    $html .= "</div>";
    
    
    $html .= "</div>";
?>
<?php
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->set_paper("folio", "portrait");
    $dompdf->render();

    $dompdf->stream("surat_panggilan.pdf", array("Attachment" => false));
    //echo($html);

  exit(0);
?>