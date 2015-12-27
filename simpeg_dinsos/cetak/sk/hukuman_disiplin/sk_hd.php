<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once("../../../php/dompdf_config.inc.php"); ?>
<?php require_once("../../../php/koneksi.php"); ?>
<?php require_once("../../../php/fungsi.php"); ?>
<?php date_default_timezone_set("America/New_York"); ?>
<?php
    /* CONTROLLER */
    
    // data surat
    $ds_usulan = mysql_fetch_array(mysql_query("SELECT
                                                	a.*, pp.pangkat AS pgkps, pp.gol_ruang AS grps, b.jenis_disiplin, c.sub_jenis_disiplin, d.nama_pegawai, d.nip, e.pangkat, e.gol_ruang,
                                                	f.jabatan, g.skpd
                                                FROM
                                                	tbl_usulan_hukuman_disiplin a
                                                    LEFT JOIN ref_pangkat pp ON a.pangkat_pejabat_sk = pp.id_pangkat
                                                	LEFT JOIN ref_jenis_disiplin b ON a.id_jenis_disiplin = b.id_jenis_disiplin
                                                	LEFT JOIN ref_sub_jenis_disiplin c ON a.id_sub_jenis_disiplin = c.id_sub_jenis_disiplin
                                                	LEFT JOIN tbl_pegawai d ON a.id_pegawai = d.id_pegawai
                                                	LEFT JOIN ref_pangkat e ON d.id_pangkat = e.id_pangkat
                                                	LEFT JOIN ref_jabatan f ON d.id_jabatan = f.id_jabatan
                                                	LEFT JOIN ref_skpd g ON d.id_satuan_organisasi = g.id_skpd
                                                WHERE
                                                	a.id_usulan = '" . $_GET["id_usulan"] . "'"));
    $tmt = tglpjgindonesia($ds_usulan["tmt"]);
    $keterangan = $ds_usulan["keterangan"];
    $jabatan_pejabat_sk = $ds_usulan["jabatan_pejabat_sk"];
    $nama_pejabat_sk = $ds_usulan["nama_pejabat_sk"];
    $nip_pejabat_sk = $ds_usulan["nip_pejabat_sk"];
    $pangkat_pejabat_sk = $ds_usulan["pgkps"];
    $gol_ruang_pejabat_sk = $ds_usulan["grps"];
    $tgl_sk = ($ds_usulan["tgl_sk"] == "0000-00-00") ? "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" : tglpjgindonesia($ds_usulan["tgl_sk"]);
    $no_sk = ($ds_usulan["no_sk"] == "") ? "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" : $ds_usulan["no_sk"];
    $membaca = explode("{}", $ds_usulan["membaca"]);
    $menimbang = explode("{}", $ds_usulan["menimbang"]);
    $mengingat = explode("{}", $ds_usulan["mengingat"]);
    $menetapkan = explode("{}", $ds_usulan["menetapkan"]);
    $tembusan = explode("{}", $ds_usulan["tembusan"]);
    $jenis_disiplin = $ds_usulan["jenis_disiplin"];
    $sub_jenis_disiplin = $ds_usulan["sub_jenis_disiplin"];
    $nama_pegawai = $ds_usulan["nama_pegawai"];
    $nip = $ds_usulan["nip"];
    $pangkat = $ds_usulan["pangkat"];
    $gol_ruang = $ds_usulan["gol_ruang"];
    $jabatan = $ds_usulan["jabatan"];
    $skpd = $ds_usulan["skpd"];
    $arr_memutuskan = array("KESATU", "KEDUA", "KETIGA", "KEEMPAT", "KELIMA", "KEENAM", "KETUJUH", "KEDELAPAN", "KESEMBILAN", "KESEPULUH");
    
    /* END OF CONTROLLER */
?>
<?php
    $html = "";
    $html .= "<table cellspacing='0' cellpadding='2' width='100%' style='font-family: sans-serif; font-size: 11pt;'>";
        $html .= "<tr>";
            $html .= "<td align='right' valign='top'>";
                $html .= "ANAK LAMPIRAN I-f";
            $html .= "</td>";
            $html .= "<td width='2%'>";
                $html .= "&nbsp;";
            $html .= "</td>";
            $html .= "<td width='30%'>";
                $html .= "PERATURAN KEPALA BADAN<br />";
                $html .= "KEPEGAWAIAN NEGARA<br />";
                $html .= "NOMOR : 21 TAHUN 2010<br />";
                $html .= "TANGGAL : 1 OKTOBER 2010<br />";
            $html .= "</td>";
        $html .= "</tr>";
    $html .= "</table>";
    
    $html .= "<div style='height: 100px;'>&nbsp;</div>";
    
    $html .= "<table cellspacing='0' cellpadding='2px' width='100%' style='font-family: sans-serif; font-size: 11pt;'>";
        $html .= "<tr>";
            $html .= "<td align='center'>";    
                $html .= "RAHASIA";
            $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td align='center'>";    
                $html .= "KEPUTUSAN " . $jabatan_pejabat_sk;
            $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td align='center'>";    
                $html .= "NOMOR " . $no_sk;
            $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td align='center'>";    
                $html .= "DENGAN RAHMAT TUHAN YANG MAHA ESA";
            $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td align='center'>";    
                $html .= $jabatan_pejabat_sk;
            $html .= "</td>";
        $html .= "</tr>";
    $html .= "</table>";
    
    $html .= "<div style='height: 50px;'>&nbsp;</div>";
    
    $html .= "<table border='0' cellspacing='0' cellpadding='2' width='100%' style='font-family: sans-serif; font-size: 11pt;'>";
        $html .= "<tr>";
            $html .= "<td width='15%' valign='top'>";
                $html .= "Membaca";
            $html .= "</td>";
            $html .= "<td width='2%' valign='top'>";
                $html .= ":";
            $html .= "</td>";
            $html .= "<td>";
                $html .= "<ol style='margin: 0px; padding: 0px 20px;'>";
                foreach($membaca as $isi){
                    $html .= "<li>";
                        $html .= $isi;
                    $html .= "</li>";
                }
                $html .= "</ol>";
            $html .= "</td>";
        $html .= "</tr>";
    $html .= "</table>";
    
    $html .= "<div style='height: 30px;'>&nbsp;</div>";
    
    $html .= "<table border='0' cellspacing='0' cellpadding='2' width='100%' style='font-family: sans-serif; font-size: 11pt;'>";
        $html .= "<tr>";
            $html .= "<td width='15%' valign='top'>";
                $html .= "Menimbang";
            $html .= "</td>";
            $html .= "<td width='2%' valign='top'>";
                $html .= ":";
            $html .= "</td>";
            $html .= "<td>";
                $html .= "<ol style='margin: 0px; padding: 0px 20px;'>";
                foreach($menimbang as $isi){
                    $html .= "<li>";
                        $html .= $isi;
                    $html .= "</li>";
                }
                $html .= "</ol>";
            $html .= "</td>";
        $html .= "</tr>";
    $html .= "</table>";
    
    $html .= "<div style='height: 30px;'>&nbsp;</div>";
    
    $html .= "<table border='0' cellspacing='0' cellpadding='2' width='100%' style='font-family: sans-serif; font-size: 11pt;'>";
        $html .= "<tr>";
            $html .= "<td width='15%' valign='top'>";
                $html .= "Mengingat";
            $html .= "</td>";
            $html .= "<td width='2%' valign='top'>";
                $html .= ":";
            $html .= "</td>";
            $html .= "<td>";
                $html .= "<ol style='margin: 0px; padding: 0px 20px;'>";
                foreach($mengingat as $isi){
                    $html .= "<li>";
                        $html .= $isi;
                    $html .= "</li>";
                }
                $html .= "</ol>";
            $html .= "</td>";
        $html .= "</tr>";
    $html .= "</table>";
    
    $html .= "<div style='height: 40px;'>&nbsp;</div>";
    
    $html .= "<table cellspacing='0' cellpadding='2px' width='100%' style='font-family: sans-serif; font-size: 11pt;'>";
        $html .= "<tr>";
            $html .= "<td align='center'>";    
                $html .= "MEMUTUSKAN";
            $html .= "</td>";
        $html .= "</tr>";
    $html .= "</table>";
    
    $html .= "<div style='height: 40px;'>&nbsp;</div>";
    
    $html .= "<table border='0' cellspacing='0' cellpadding='2' width='100%' style='font-family: sans-serif; font-size: 11pt; page-break-after: always;'>";
        $html .= "<tr>";
            $html .= "<td width='15%' valign='top'>";
                $html .= "Menetapkan";
            $html .= "</td>";
            $html .= "<td width='2%' valign='top'>";
                $html .= ":";
            $html .= "</td>";
            $html .= "<td>";
                $html .= "&nbsp;";
            $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td width='15%' valign='top'>";
                $html .= $arr_memutuskan[0];
            $html .= "</td>";
            $html .= "<td width='2%' valign='top'>";
                $html .= ":";
            $html .= "</td>";
            $html .= "<td>";
                $html .= "Menjatuhkan " . $jenis_disiplin . " Berupa " . $sub_jenis_disiplin . " Kepada :";
                $html .= "<div style='height: 2px;'>&nbsp;</div>";
                $html .= "<table border='0' cellspacing='0' cellpadding='2' width='100%' style='font-family: sans-serif; font-size: 11pt;'>";
                    $html .= "<tr>";
                        $html .= "<td width='15%'>Nama</td>";
                        $html .= "<td width='3%'>:</td>";
                        $html .= "<td>" . $nama_pegawai . "</td>";
                    $html .= "</tr>";
                    $html .= "<tr>";
                        $html .= "<td>NIP</td>";
                        $html .= "<td>:</td>";
                        $html .= "<td>" . $nip . "</td>";
                    $html .= "</tr>";
                    $html .= "<tr>";
                        $html .= "<td>Pangkat</td>";
                        $html .= "<td>:</td>";
                        $html .= "<td>" . $pangkat . " (" . $gol_ruang . ")" . "</td>";
                    $html .= "</tr>";
                    $html .= "<tr>";
                        $html .= "<td>Jabatan</td>";
                        $html .= "<td>:</td>";
                        $html .= "<td>" . $jabatan . "</td>";
                    $html .= "</tr>";
                    $html .= "<tr>";
                        $html .= "<td>Unit Kerja</td>";
                        $html .= "<td>:</td>";
                        $html .= "<td>" . $skpd . "</td>";
                    $html .= "</tr>";
                $html .= "</table>";
                $html .= "<div style='height: 10px;'>&nbsp;</div>";
                $html .= $menetapkan[0];
            $html .= "</td>";
        $html .= "</tr>";
    $html .= "</table>";
    
    for($i=1; $i<count($menetapkan); $i++){
        $html .= "<div style='height: 10px;'>&nbsp;</div>";
        
        $html .= "<table border='0' cellspacing='0' cellpadding='2' width='100%' style='font-family: sans-serif; font-size: 11pt;'>";
        $html .= "<tr>";
            $html .= "<td width='15%' valign='top'>";
                $html .= $arr_memutuskan[$i];
            $html .= "</td>";
            $html .= "<td width='2%' valign='top'>";
                $html .= ":";
            $html .= "</td>";
            $html .= "<td>";
                $html .= $menetapkan[$i];
            $html .= "</td>";
        $html .= "</tr>";
    $html .= "</table>";
    }
    
    $html .= "<div style='height: 30px;'>&nbsp;</div>";
    
    $html .= "<table cellspacing='0' cellpadding='2' width='100%' style='font-family: sans-serif; font-size: 11pt;'>";
        $html .= "<tr>";
            $html .= "<td>";
                $html .= "&nbsp;";
            $html .= "</td>";
            $html .= "<td width='40%'>";
                $html .= "Ditetapkan di Medan<br />";
                $html .= "Pada Tanggal " . $tgl_sk . "<br />";
            $html .= "</td>";
        $html .= "</tr>";
    $html .= "</table>";
        
        $html .= "<div style='height: 30px;'>&nbsp;</div>";
        
    $html .= "<table cellspacing='0' cellpadding='2' width='100%' style='font-family: sans-serif; font-size: 11pt;'>";
        $html .= "<tr>";
            $html .= "<td>";
                $html .= "&nbsp;";
            $html .= "</td>";
            $html .= "<td width='40%' align='center'>";
                //$html .= "Atasan Langsung";
                $html .= "&nbsp;";
            $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td>";
                $html .= "&nbsp;";
            $html .= "</td>";
            $html .= "<td align='left'>";
                $html .= $jabatan_pejabat_sk;
            $html .= "</td>";
        $html .= "</tr>";
    $html .= "</table>";
    
    $html .= "<div style='height: 50px;'>&nbsp;</div>";
    
    $html .= "<table cellspacing='0' cellpadding='2' width='100%' style='font-family: sans-serif; font-size: 11pt;'>";
        $html .= "<tr>";
            $html .= "<td>";
                $html .= "&nbsp;";
            $html .= "</td>";
            $html .= "<td width='40%' align='left'>";
                $html .= "NAMA : " . $nama_pejabat_sk . "<hr />";
                $html .= "NIP : " . $nip_pejabat_sk;
            $html .= "</td>";
        $html .= "</tr>";
    $html .= "</table>";
    
    $html .= "<div style='height: 30px;'>&nbsp;</div>";
    
    $html .= "<table cellspacing='0' cellpadding='2' width='100%' style='font-family: sans-serif; font-size: 11pt;'>";
        $html .= "<tr>";
            $html .= "<td width='40%'>";
                $html .= "Diterima Tanggal : ";
            $html .= "</td>";
            $html .= "<td>";
                $html .= "&nbsp;";
            $html .= "</td>";
        $html .= "</tr>";
    $html .= "</table>";
    
    $html .= "<div style='height: 50px;'>&nbsp;</div>";
    
    $html .= "<table cellspacing='0' cellpadding='2' width='100%' style='font-family: sans-serif; font-size: 11pt;'>";
        $html .= "<tr>";
            $html .= "<td width='40%'>";
                $html .= "NAMA : " . $nama_pegawai . "<hr />";
                $html .= "NIP : " . $nip;
            $html .= "</td>";
            $html .= "<td>&nbsp;</td>";
        $html .= "</tr>";
    $html .= "</table>";
    
    $html .= "<div style='height: 100px;'>&nbsp;</div>";
    
    $html .= "<table border='0' cellspacing='0' cellpadding='2' width='100%' style='font-family: sans-serif; font-size: 11pt;'>";
        $html .= "<tr>";
            $html .= "<td width='15%' valign='top'>";
                $html .= "Tembusan Yth :";
                $html .= "<ol style='margin: 0px; padding: 0px 20px;'>";
                foreach($tembusan as $isi){
                    $html .= "<li>";
                        $html .= $isi;
                    $html .= "</li>";
                }
                $html .= "</ol>";
            $html .= "</td>";
        $html .= "</tr>";
    $html .= "</table>";
?>
<?php
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->set_paper("folio", "portrait");
    $dompdf->render();

    $dompdf->stream("hukuman_disiplin.pdf", array("Attachment" => false));
    //echo($html);

  exit(0);
?>