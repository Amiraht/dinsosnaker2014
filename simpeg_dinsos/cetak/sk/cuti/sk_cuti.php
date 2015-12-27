<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once("../../../php/dompdf_config.inc.php"); ?>
<?php require_once("../../../php/koneksi.php"); ?>
<?php require_once("../../../php/fungsi.php"); ?>
<?php date_default_timezone_set("America/New_York"); ?>
<?php
    /* CONTROLLER */
    
    // data surat
    $ds_surat = mysql_fetch_array(mysql_query("SELECT a.*, b.pangkat FROM tbl_sk_cuti a LEFT JOIN ref_pangkat b ON a.pangkat_surat = b.id_pangkat WHERE id_surat='" . $_GET["id_surat"] . "'"));
    $no_surat = ($ds_surat["no_surat"] == "") ? "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" : $ds_surat["no_surat"];
    $tgl_surat = ($ds_surat["tgl_surat"] == "0000-00-00") ? "&nbsp;&nbsp;&nbsp;&nbsp;" : tglpjgindonesia($ds_surat["tgl_surat"]);
    $pecah_tgl_surat = explode("-", $ds_surat["tgl_surat"]);
    $tahun_surat = ($ds_surat["tgl_surat"] == "0000-00-00") ? "&nbsp;&nbsp;&nbsp;&nbsp;" : $pecah_tgl_surat[0];
    $jabatan_peneken = $ds_surat["pejabat_surat"];
    $nama_peneken = $ds_surat["nama_surat"];
    $pangkat_peneken = $ds_surat["pangkat"];
    $nip_peneken = $ds_surat["nip_surat"];
    
    // data peneken usulan
    $peneken_usulan = array();
    $sql_peneken_usulan = "SELECT
                            	b.no_usulan, b.tgl_usulan, b.pejabat_usulan
                            FROM
                            	tbl_riwayat_cuti a
                            	INNER JOIN tbl_usulan_cuti b ON a.id_usulan = b.id_usulan
                            WHERE
                            	id_surat = '" . $_GET["id_surat"] . "'
                            GROUP BY
                            	b.no_usulan";
    $res_peneken_usulan = mysql_query($sql_peneken_usulan);
    while($ds_peneken_usulan = mysql_fetch_array($res_peneken_usulan)){
        $row_peneken_usulan["no_usulan"] = $ds_peneken_usulan["no_usulan"];
        $row_peneken_usulan["tgl_usulan"] = tglpjgindonesia($ds_peneken_usulan["tgl_usulan"]);
        $row_peneken_usulan["pejabat_usulan"] = $ds_peneken_usulan["pejabat_usulan"];
        array_push($peneken_usulan, $row_peneken_usulan);
    }
?>
<?php
    $html = "";
    
    $html .= "<div style='height: 5cm;'>&nbsp;</div>";
    
    $html .= "<div style='text-align: center; font-family: serif; font-size: 11pt;'>";
        $html .= "<b>SURAT WALIKOTA MEDAN</b><br />";
        $html .= "<b>NOMOR : " . $no_surat . " TAHUN  " . $tahun_surat . "</b><br />";
        $html .= "<b>T E N T A N G</b><br />";
        $html .= "<b>CUTI PEGAWAI NEGERI SIPIL</b><br />";
        $html .= "<b>WALIKOTA MEDAN</b>";
    $html .= "</div>";
    
    $html .= "<div style='height: 20px;'>&nbsp;</div>";
    
    $html .= "<div style='font-family: serif; font-size: 11pt;'>";
        $html .= "<table width='100%' border='0'>";
            $html .= "<tr>";
                $html .= "<td width='10%' align='left' valign='top'>";
                    $html .= "Dasar :";
                $html .= "</td>";
                $html .= "<td style='text-align: justify;'>";
                    $html .= "<ol>";
                        $html .= "<li>Peraturan Pemerintah Nomor 24 Tahun 1976 tentang Cuti Pegawai Negeri Sipil.</li>";
                        $html .= "<li>Surat Edaran Kepala Badan Administrasi Kepegawaian Negara Nomor 01/SE/1977 tanggal 25 Pebruari 1977.</li>";
                        // DISINI DIAMBIL DARI DAFTAR PEJABAT PENANDATANGAN PADA SAAT USULAN
                        foreach($peneken_usulan as $peneken){
                            $html .= "<li>Surat " . $peneken["pejabat_usulan"] . " Nomor " . $peneken["no_usulan"] . " tanggal " . $peneken["tgl_usulan"] . ".</li>";
                        }
                    $html .= "</ol>";
                $html .= "</td>";
            $html .= "<tr>";
        $html .= "</table>";
    $html .= "</div>";
    
    $html .= "<div style='font-family: serif; font-size: 11pt; text-align: center; font-weight: bold;'>";
        $html .= "MENGIZINKAN :";
    $html .= "</div>";
    
    $html .= "<div style='font-family: serif; font-size: 11pt;'>";
        $html .= "<table width='100%' border='0'>";
            $html .= "<tr>";
                $html .= "<td width='10%' align='right' valign='top'>";
                    $html .= "&nbsp;";
                $html .= "</td>";
                $html .= "<td style='text-align: justify;'>";
                    $html .= "<ol>";
                        $html .= "<li>Pegawai Negeri Sipil yang namanya tercantum pada lampiran surat ini untuk menjalani jenis cuti sebagaimana tersebut pada lajur 6 (enam) dan terhitung mulai tanggal (TMT) tersebut pada lajur 7 (tujuh).</li>";
                        $html .= "<li>Sebelum menjalankan cuti wajib menyerahkan pekerjaannya pada atasan langsung.</li>";
                        $html .= "<li>Setelah selesai menjalani cuti wajib melaporkan diri kepada atasan langsung dan bekerja kembali sebagaimana biasa.</li>";
                    $html .= "</ol>";
                $html .= "</td>";
            $html .= "<tr>";
        $html .= "</table>";
    $html .= "</div>";
    
    $html .= "<div style='font-family: serif; font-size: 11pt;'>";
        $html .= "Demikian surat izin cuti ini dibuat untuk dapat digunakan sebagaimana mestinya.";
    $html .= "</div>";
    
    $html .= "<div style='height: 30px;'>&nbsp;</div>";
    
    $html .= "<div style='font-family: serif; font-size: 11pt;'>";
        $html .= "<table width='100%' border='0'>";
            // ROW 1
            $html .= "<tr>";
                $html .= "<td align='right' valign='top'>";
                    $html .= "&nbsp;";
                $html .= "</td>";
                $html .= "<td width='15%' align='left'>";
                    $html .= "Dikeluarkan Di :";
                $html .= "</td>";
                $html .= "<td width='25%' align='left'>";
                    $html .= "Medan";
                $html .= "</td>";
            $html .= "</tr>";
            
            // ROW 2
            $html .= "<tr>";
                $html .= "<td align='right' valign='top'>";
                    $html .= "&nbsp;";
                $html .= "</td>";
                $html .= "<td width='15%' align='left'>";
                    $html .= "Pada Tanggal :";
                $html .= "</td>";
                $html .= "<td width='25%' align='left'>";
                    $html .= $tgl_surat;
                $html .= "</td>";
            $html .= "</tr>";
        $html .= "</table>";
        
        $html .= "<div style='height: 10px;'>&nbsp;</div>";
        
        $html .= "<table width='100%' border='0' style='font-weight: bold; text-transform: uppercase;'>";
            // ROW 3
            $html .= "<tr>";
                $html .= "<td align='right' valign='top'>";
                    $html .= "&nbsp;";
                $html .= "</td>";
                $html .= "<td width='45%' align='center' colspan='2'>";
                    $html .= "an. WALIKOTA MEDAN";
                $html .= "</td>";
            $html .= "</tr>";
            
            // ROW 4
            $html .= "<tr>";
                $html .= "<td align='right' valign='top'>";
                    $html .= "&nbsp;";
                $html .= "</td>";
                $html .= "<td width='45%' align='center' colspan='2'>";
                    $html .= $jabatan_peneken;
                $html .= "</td>";
            $html .= "</tr>";
        $html .= "</table>";
        
        $html .= "<div style='height: 70px;'>&nbsp;</div>";
        
        $html .= "<table width='100%' border='0' style='font-weight: bold; text-transform: uppercase;'>";
            // ROW 5
            $html .= "<tr>";
                $html .= "<td align='right' valign='top'>";
                    $html .= "&nbsp;";
                $html .= "</td>";
                $html .= "<td width='35%' align='left' colspan='2'>";
                    $html .= $nama_peneken;
                $html .= "</td>";
            $html .= "</tr>";
            
            // ROW 6
            $html .= "<tr>";
                $html .= "<td align='right' valign='top'>";
                    $html .= "&nbsp;";
                $html .= "</td>";
                $html .= "<td width='35%' align='left' colspan='2'>";
                    $html .= $pangkat_peneken;
                $html .= "</td>";
            $html .= "</tr>";
            
            // ROW 7
            $html .= "<tr>";
                $html .= "<td align='right' valign='top'>";
                    $html .= "&nbsp;";
                $html .= "</td>";
                $html .= "<td width='35%' align='left' colspan='2'>";
                    $html .= "NIP. " . $nip_peneken;
                $html .= "</td>";
            $html .= "</tr>";
        $html .= "</table>";
    $html .= "</div>";
    
    $html .= "<div style='height: 50px;'>&nbsp;</div>";
    
    $html .= "<div style='font-family: serif; font-size: 10pt; font-style: italic;'>";
        $html .= "<u>Tembusan :</u>";
        $html .= "<ol>";
            $html .= "<li>Walikota Medan sebagai laporan</li>";
            // DISINI DIAMBIL DARI DAFTAR PEJABAT PENANDATANGAN PADA SAAT USULAN
            foreach($peneken_usulan as $peneken){
                $html .= "<li>" . $peneken["pejabat_usulan"] . "</li>";
            }
            $html .= "<li>Kepala Badan Pengelola Keuangan Daerah Kota Medan</li>";
            $html .= "<li>Pertinggal</li>";
        $html .= "</ol>";
    $html .= "</div>";
?>
<?php
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->set_paper("folio", "portrait");
    $dompdf->render();

    $dompdf->stream("target_skp.pdf", array("Attachment" => false));
    //echo($html);

  exit(0);
?>