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
    $no_surat_panggilan = ($cerai->no_spgl == "") ? "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" : $cerai->no_spgl;
    $tgl_surat_panggilan = ($cerai->tgl_spgl == "0000-00-00") ? "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" : tglpjgindonesia($cerai->tgl_spgl);
    /* END OF CONTROLLER */
?>
<?php
    $html = "<div style='font-family: sans-serif; font-size: 11pt;'>";
    
    $html .= "<div style='height: 4cm;'>&nbsp;</div>";
    
    $html .= "<div style='text-align: center;'>RAHASIA</div>";
    $html .= "<div style='text-align: center;'>SURAT PANGGILAN</div>";
    $html .= "<div style='text-align: center; text-transform: uppercase;'>NOMOR : " . $no_surat_panggilan . "</div>";
    
    $html .= "<div style='height: 1cm;'>&nbsp;</div>";
    
    $html .= "<div>Bersama ini diminta dengan hormat kehadiran Saudara :</div>";
    $html .= "<div style='height: 0.2cm;'>&nbsp;</div>";
    $html .= "<table style='width: 100%; margin-left: 30px;' cellspacing='0' cellpadding='2'>";
        $html .= "<tr>";
            $html .= "<td style='width: 20%;'>Nama</td>";
            $html .= "<td style='width: 5%;'>:</td>";
            $html .= "<td style='text-transform: uppercase;'>" . $pegawai_cerai["nama_pegawai"] . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='width: 20%;'>NIP</td>";
            $html .= "<td style='width: 5%;'>:</td>";
            $html .= "<td style='text-transform: uppercase;'>" . $pegawai_cerai["nip"] . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='width: 20%;'>Pangkat</td>";
            $html .= "<td style='width: 5%;'>:</td>";
            $html .= "<td style='text-transform: uppercase;'>" . $pegawai_cerai["pangkat"] . " (" . $pegawai_cerai["gol_ruang"] . ")</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='width: 20%;'>Jabatan</td>";
            $html .= "<td style='width: 5%;'>:</td>";
            $html .= "<td style='text-transform: uppercase;'>" . $pegawai_cerai["jabatan"] . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='width: 20%;'>Unit Kerja</td>";
            $html .= "<td style='width: 5%;'>:</td>";
            $html .= "<td style='text-transform: uppercase;'>" . $pegawai_cerai["skpd"] . "</td>";
        $html .= "</tr>";
    $html .= "</table>";
    $html .= "<div style='height: 0.2cm;'>&nbsp;</div>";
    $html .= "<div>Untuk menghadap kepada</div>";
    $html .= "<div style='height: 0.2cm;'>&nbsp;</div>";
    $html .= "<table style='width: 100%; margin-left: 30px;' cellspacing='0' cellpadding='2'>";
        $html .= "<tr>";
            $html .= "<td style='width: 20%;'>Nama</td>";
            $html .= "<td style='width: 5%;'>:</td>";
            $html .= "<td style='text-transform: uppercase;'>" . $cerai->nama_kesdip . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='width: 20%;'>NIP</td>";
            $html .= "<td style='width: 5%;'>:</td>";
            $html .= "<td style='text-transform: uppercase;'>" . $cerai->nip_kesdip . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='width: 20%;'>Pangkat</td>";
            $html .= "<td style='width: 5%;'>:</td>";
            $html .= "<td style='text-transform: uppercase;'>" . apa_pangkat($cerai->id_pangkat_kesdip) . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='width: 20%;'>Jabatan</td>";
            $html .= "<td style='width: 5%;'>:</td>";
            $html .= "<td style='text-transform: uppercase;'>Kepala Bidang Kesejahteraan dan Disiplin Badan Kepegawaian Daerah Kota Medan</td>";
        $html .= "</tr>";
    $html .= "</table>";
    $html .= "<div style='height: 0.2cm;'>&nbsp;</div>";
    $html .= "<div>Pada</div>";
    $html .= "<div style='height: 0.2cm;'>&nbsp;</div>";
    $html .= "<table style='width: 100%; margin-left: 30px;' cellspacing='0' cellpadding='2'>";
        $html .= "<tr>";
            $html .= "<td style='width: 20%;'>Hari</td>";
            $html .= "<td style='width: 5%;'>:</td>";
            $html .= "<td style='text-transform: uppercase;'>" . $cerai->hari_h_spgl . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='width: 20%;'>Tanggal</td>";
            $html .= "<td style='width: 5%;'>:</td>";
            $html .= "<td style='text-transform: uppercase;'>" . tglpjgindonesia($cerai->tgl_h_spgl) . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='width: 20%;'>Jam</td>";
            $html .= "<td style='width: 5%;'>:</td>";
            $html .= "<td style='text-transform: uppercase;'>" . $cerai->jam_h_spgl . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='width: 20%;'>Tempat</td>";
            $html .= "<td style='width: 5%;'>:</td>";
            $html .= "<td style='text-transform: uppercase;'>" . $cerai->tempat_h_spgl . "</td>";
        $html .= "</tr>";
    $html .= "</table>";
    $html .= "<div style='height: 0.2cm;'>&nbsp;</div>";
    $html .= "<div>
                Untuk dimintai keterangan sehubungan dengan surat " . $cerai->jabatan_pejabat_sp . "
                Nomor " . $cerai->no_sp . " tanggal " . tglpjgindonesia($cerai->tgl_sp) . " perihal permohonan
                ijin cerai An. " . $pegawai_cerai["nama_pegawai"] . ", NIP " . $pegawai_cerai["nip"] . "
              </div>";
    $html .= "<div style='height: 0.2cm;'>&nbsp;</div>";
    $html .= "<div>Demikian untuk dilaksanakan.</div>";
    
    $html .= "<div style='height: 0.5cm;'>&nbsp;</div>";
    
    $html .= "<div style='margin-left: 350px;'>";
        $html .= "<div>Medan, " . $tgl_surat_panggilan . "</div>";
        $html .= "<div style='font-weight: bold; text-transform: uppercase;'>" . $cerai->jabatan_pejabat_spgl . "</div>";
        $html .= "<div style='height: 2cm;'>&nbsp;</div>";
        $html .= "<div style='font-weight: bold; text-transform: uppercase;'>" . $cerai->nama_pejabat_spgl . "</div>";
        $html .= "<div style='font-weight: bold; text-transform: uppercase;'>" . apa_pangkat($cerai->id_pangkat_pejabat_spgl) . "</div>";
        $html .= "<div style='font-weight: bold; text-transform: uppercase;'>NIP. " . $cerai->nip_pejabat_spgl . "</div>";
    $html .= "</div>";
    
    $html .= "<div style='height: 0.5cm;'>&nbsp;</div>";
    
    $html .= "<div style='font-size: 10pt; font-style: italic;'>";
        $html .= "Tembusan Yth :";
        $html .= "<ol>";
            $html .= "<li>" . $cerai->jabatan_pejabat_sp . "</li>";
            $html .= "<li>Inspektur Kota Medan</li>";
            $html .= "<li>Pertinggal</li>";
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