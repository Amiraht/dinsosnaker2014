<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once("../../../php/dompdf_config.inc.php"); ?>
<?php require_once("../../../php/koneksi.php"); ?>
<?php require_once("../../../php/fungsi.php"); ?>
<?php require_once("../../../php/model/ijin_cerai_model.php"); ?>
<?php date_default_timezone_set("America/New_York"); ?>
<?php
    /* CONTROLLER */
    $cerai = new IjinCerai_Model();
    $cerai->Record($_GET["id_cerai"]);
    $pegawai_cerai = all_detail_pegawai($cerai->id_pegawai);
    $no_surat_panggilan = ($cerai->no_sk == "") ? "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" : $cerai->no_sk;
    $tgl_surat_panggilan = ($cerai->tgl_sk == "0000-00-00") ? "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" : tglpjgindonesia($cerai->tgl_sk);
    
    $membaca = explode("\n", $cerai->membaca_sk);
    $menimbang = explode("\n", $cerai->menimbang_sk);
    $mengingat = explode("\n", $cerai->mengingat_sk);
    $memperhatikan = explode("\n", $cerai->memperhatikan_sk);
    $tembusan = explode("\n", $cerai->tembusan_sk);
    $ds_agama = mysql_fetch_array(mysql_query("SELECT * FROM ref_agama WHERE id_agama='" . $cerai->id_agama_pasangan . "'"));
    $agama = $ds_agama["agama"];
    /* END OF CONTROLLER */
?>
<?php
    $html = "<div style='font-family: sans-serif; font-size: 11pt;'>";
    
    $html .= "<div style='height: 4cm;'>&nbsp;</div>";
    
    $html .= "<div style='text-align: center; font-weight: bold;'>RAHASIA</div>";
    $html .= "<div style='text-align: center; font-weight: bold;'>KEPUTUSAN PEMBERIAN IJIN PERCERAIAN</div>";
    $html .= "<div style='text-align: center; text-transform: uppercase; font-weight: bold;'>NOMOR : " . $no_surat_panggilan . "</div>";
    $html .= "<div style='text-align: center; font-weight: bold; text-transform: uppercase;'>" . $cerai->jabatan_pejabat_sk . "</div>";
    
    $html .= "<div style='height: 1cm;'>&nbsp;</div>";
    
    $html .= "<table cellspacing='0' cellpadding='0' style='width: 100%;'>";
        $html .= "<tr>";
            $html .= "<td style='width: 20%;' valign='top'>Membaca</td>";
            $html .= "<td style='width: 3%;' valign='top'>:</td>";
            $html .= "<td>";
                $html .= "<ol style='margin: 0px; padding-left: 20px; text-align: justify;'>";
                foreach($membaca as $pecah){
                    if(trim($pecah) <> "")
                        $html .= "<li>" . $pecah . "</li>";
                }
                $html .= "</ol>";
            $html .= "</td>";
        $html .= "</tr>";
    $html .= "</table>";
    
    $html .= "<div style='height: 0.1cm;'>&nbsp;</div>";
    
    $html .= "<table cellspacing='0' cellpadding='0' style='width: 100%;'>";
        $html .= "<tr>";
            $html .= "<td style='width: 20%;' valign='top'>Menimbang</td>";
            $html .= "<td style='width: 3%;' valign='top'>:</td>";
            $html .= "<td>";
                $html .= "<ol style='margin: 0px; padding-left: 20px; text-align: justify;'>";
                foreach($menimbang as $pecah){
                    if(trim($pecah) <> "")
                        $html .= "<li>" . $pecah . "</li>";
                }
                $html .= "</ol>";
            $html .= "</td>";
        $html .= "</tr>";
    $html .= "</table>";
    
    $html .= "<div style='height: 0.1cm;'>&nbsp;</div>";
    
    $html .= "<table cellspacing='0' cellpadding='0' style='width: 100%;'>";
        $html .= "<tr>";
            $html .= "<td style='width: 20%;' valign='top'>Mengingat</td>";
            $html .= "<td style='width: 3%;' valign='top'>:</td>";
            $html .= "<td>";
                $html .= "<ol style='margin: 0px; padding-left: 20px; text-align: justify;'>";
                foreach($mengingat as $pecah){
                    if(trim($pecah) <> "")
                        $html .= "<li>" . $pecah . "</li>";
                }
                $html .= "</ol>";
            $html .= "</td>";
        $html .= "</tr>";
    $html .= "</table>";
    
    $html .= "<div style='height: 0.1cm;'>&nbsp;</div>";
    
    $html .= "<table cellspacing='0' cellpadding='0' style='width: 100%;'>";
        $html .= "<tr>";
            $html .= "<td style='width: 20%;' valign='top'>Memperhatikan</td>";
            $html .= "<td style='width: 3%;' valign='top'>:</td>";
            $html .= "<td>";
                $html .= "<ol style='margin: 0px; padding-left: 20px; text-align: justify;'>";
                foreach($memperhatikan as $pecah){
                    if(trim($pecah) <> "")
                        $html .= "<li>" . $pecah . "</li>";
                }
                $html .= "</ol>";
            $html .= "</td>";
        $html .= "</tr>";
    $html .= "</table>";
    
    $html .= "<div style='height: 1cm;'>&nbsp;</div>";
    
    $html .= "<div style='text-align: center; font-weight: bold;'>MEMUTUSKAN</div>";
    
    $html .= "<div style='height: 1cm;'>&nbsp;</div>";
    
    $html .= "<table cellspacing='0' cellpadding='0' style='width: 100%;'>";
        $html .= "<tr>";
            $html .= "<td style='width: 20%;' valign='top'>Menetapkan</td>";
            $html .= "<td style='width: 3%;' valign='top'>:</td>";
            $html .= "<td>";
                $html .= "&nbsp;";
            $html .= "</td>";
        $html .= "</tr>";
    $html .= "</table>";
    
    $html .= "<div style='height: 0.3cm;'>&nbsp;</div>";
    
    $html .= "<table cellspacing='0' cellpadding='0' style='width: 100%;'>";
        $html .= "<tr>";
            $html .= "<td style='width: 20%;' valign='top'>PERTAMA</td>";
            $html .= "<td style='width: 3%;' valign='top'>:</td>";
            $html .= "<td>";
                $html .= "<div>Memberikan ijin kepada :</div>";
                $html .= "<table cellspacing='0' cellpadding='0' style='width: 100%;'>";
                    $html .= "<tr>";
                        $html .= "<td style='width: 20%;' valign='top'>Nama</td>";
                        $html .= "<td style='width: 3%;' valign='top'>:</td>";
                        $html .= "<td>" . $pegawai_cerai["gelar_depan"] . $pegawai_cerai["nama_pegawai"] . $pegawai_cerai["gelar_belakang"] . "</td>";
                    $html .= "</tr>";
                    $html .= "<tr>";
                        $html .= "<td style='width: 20%;' valign='top'>NIP</td>";
                        $html .= "<td style='width: 3%;' valign='top'>:</td>";
                        $html .= "<td>" . $pegawai_cerai["nip"] . "</td>";
                    $html .= "</tr>";
                    $html .= "<tr>";
                        $html .= "<td style='width: 20%;' valign='top'>Pangkat</td>";
                        $html .= "<td style='width: 3%;' valign='top'>:</td>";
                        $html .= "<td>" . $pegawai_cerai["pangkat"] . " (" . $pegawai_cerai["gol_ruang"] . ")</td>";
                    $html .= "</tr>";
                    $html .= "<tr>";
                        $html .= "<td style='width: 20%;' valign='top'>Jabatan</td>";
                        $html .= "<td style='width: 3%;' valign='top'>:</td>";
                        $html .= "<td>" . $pegawai_cerai["jabatan"] . "</td>";
                    $html .= "</tr>";
                    $html .= "<tr>";
                        $html .= "<td style='width: 20%;' valign='top'>Unit Kerja</td>";
                        $html .= "<td style='width: 3%;' valign='top'>:</td>";
                        $html .= "<td>" . $pegawai_cerai["skpd"] . "</td>";
                    $html .= "</tr>";
                    $html .= "<tr>";
                        $html .= "<td style='width: 20%;' valign='top'>Agama</td>";
                        $html .= "<td style='width: 3%;' valign='top'>:</td>";
                        $html .= "<td>" . $pegawai_cerai["agama"] . "</td>";
                    $html .= "</tr>";
                $html .= "</table>";
                
                $html .= "<div style='height: 0.1cm;'>&nbsp;</div>";
                
                $html .= "<div>Untuk melaksanakan perceraian dengan pasangannya :</div>";
                $html .= "<table cellspacing='0' cellpadding='0' style='width: 100%;'>";
                    $html .= "<tr>";
                        $html .= "<td style='width: 20%;' valign='top'>Nama</td>";
                        $html .= "<td style='width: 3%;' valign='top'>:</td>";
                        $html .= "<td>" . $cerai->nama_pasangan . "</td>";
                    $html .= "</tr>";
                    $html .= "<tr>";
                        $html .= "<td style='width: 20%;' valign='top'>Pekerjaan</td>";
                        $html .= "<td style='width: 3%;' valign='top'>:</td>";
                        $html .= "<td>" . $cerai->pekerjaan_pasangan . "</td>";
                    $html .= "</tr>";
                    $html .= "<tr>";
                        $html .= "<td style='width: 20%;' valign='top'>Agama</td>";
                        $html .= "<td style='width: 3%;' valign='top'>:</td>";
                        $html .= "<td>" . $agama . "</td>";
                    $html .= "</tr>";
                $html .= "</table>";
            $html .= "</td>";
        $html .= "</tr>";
    $html .= "</table>";
    
    $html .= "<div style='height: 0.3cm;'>&nbsp;</div>";
    
    $html .= "<table cellspacing='0' cellpadding='0' style='width: 100%;'>";
        $html .= "<tr>";
            $html .= "<td style='width: 20%;' valign='top'>KEDUA</td>";
            $html .= "<td style='width: 3%;' valign='top'>:</td>";
            $html .= "<td>Keputusan ini berlaku sejak tanggal ditetapkan.</td>";
        $html .= "</tr>";
    $html .= "</table>";
    
    $html .= "<div style='height: 0.3cm;'>&nbsp;</div>";
    
    $html .= "<table cellspacing='0' cellpadding='0' style='width: 100%;'>";
        $html .= "<tr>";
            $html .= "<td style='width: 20%;' valign='top'>KETIGA</td>";
            $html .= "<td style='width: 3%;' valign='top'>:</td>";
            $html .= "<td>Asli Keputusan ini disampaikan kepada PNS yang bersangkutan untuk diindahkan dan digunakan sebagaimana mestinya.</td>";
        $html .= "</tr>";
    $html .= "</table>";
    
    $html .= "<div style='height: 1cm;'>&nbsp;</div>";
    
    $html .= "<div style='margin-left: 350px;'>";
        $html .= "<div>Ditetapkan di : Medan</div>";
        $html .= "<div>Pada Tanggal : " . $tgl_surat_panggilan . "</div>";
        $html .= "<hr />";
        $html .= "<div style='font-weight: bold; text-transform: uppercase;'>" . $cerai->jabatan_pejabat_sk . "</div>";
        $html .= "<div style='height: 2cm;'>&nbsp;</div>";
        $html .= "<div style='font-weight: bold; text-transform: uppercase;'>" . $cerai->nama_pejabat_sk . "</div>";
        $html .= "<div style='font-weight: bold; text-transform: uppercase;'>" . apa_pangkat($cerai->id_pangkat_pejabat_sk) . "</div>";
        $html .= "<div style='font-weight: bold; text-transform: uppercase;'>NIP. " . $cerai->nip_pejabat_sk . "</div>";
    $html .= "</div>";
    
    $html .= "<div style='height: 1cm;'>&nbsp;</div>";
    
    $html .= "<div style='font-size: 10pt; font-style: italic;'>";
        $html .= "Tembusan Yth :";
        $html .= "<ol>";
            foreach($tembusan as $pecah){
                if(trim($pecah) <> "")
                    $html .= "<li>" . $pecah . "</li>";
            }
        $html .= "</ol>";
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