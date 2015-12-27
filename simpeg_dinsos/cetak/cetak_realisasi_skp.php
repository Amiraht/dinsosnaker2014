<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once("../php/dompdf_config.inc.php"); ?>
<?php require_once("../php/koneksi.php"); ?>
<?php require_once("../php/fungsi.php"); ?>
<?php date_default_timezone_set("America/New_York"); ?>
<?php
            $ds_header = mysql_fetch_array(mysql_query("SELECT
                                	a.*, b.nama_pegawai AS nama_pegawai_penilai, b.nip AS nip_penilai, 
                                	c.nama_pegawai AS nama_pegawai_atasan_penilai, c.nip AS nip_atasan_penilai,
                                	d.pangkat AS pangkat_penilai, d.gol_ruang AS gol_ruang_penilai,
                                	e.pangkat AS pangkat_atasan_penilai, e.gol_ruang AS gol_ruang_atasan_penilai,
                                	f.skpd AS skpd_penilai, g.skpd AS skpd_atasan_penilai,
                                	h.jabatan AS jabatan_penilai, i.jabatan AS jabatan_atasan_penilai
                                FROM
                                	tbl_skp a
                                	LEFT JOIN tbl_pegawai b ON a.id_pegawai_penilai = b.id_pegawai
                                	LEFT JOIN tbl_pegawai c ON a.id_pegawai = c.id_pegawai
                                	LEFT JOIN ref_pangkat d ON b.id_pangkat = d.id_pangkat
                                	LEFT JOIN ref_pangkat e ON c.id_pangkat = e.id_pangkat
                                	LEFT JOIN ref_skpd f ON b.id_satuan_organisasi = f.id_skpd
                                	LEFT JOIN ref_skpd g ON c.id_satuan_organisasi = g.id_skpd
                                	LEFT JOIN ref_jabatan h ON b.id_jabatan = h.id_jabatan
                                	LEFT JOIN ref_jabatan i ON c.id_jabatan = i.id_jabatan
                                WHERE
                                	a.id_skp='" . $_GET["id_skp"] . "'
                                ORDER BY
                                	a.dari ASC
                                "));
        ?>
<?php
    $html = "";
    $html .= "<html>";
    $html .= "<head>";
    
    $html .= "</head>";
    $html .= "<body>";
    
    $html .= "<div style='text-align: center'><h3>PENILAIAN SASARAN KERJA PEGAWAI</h3></div>";
    $html .= "<div style='height: 10px'>&nbsp;</div>";
    
    /**
 * $html .= "<table width='100%' cellspacing='0' cellpadding='5' border='0px' style='font-family: sans-serif; font-size: 9pt;'>";
 *         $html .= "<tr>";
 *             $html .= "<td style='font-weight: bold'>I. PEJABAT PENILAI</td>";
 *             $html .= "<td style='font-weight: bold'>II. PNS YANG DINILAI</td>";
 *         $html .= "</tr>";
 *     $html .= "</table>";
 *     $html .= "<table width='100%' cellspacing='0' cellpadding='5' border='0px' style='font-family: sans-serif; font-size: 9pt;'>";
 *         $html .= "<tr>";
 *             $html .= "<td width='15%' style='border: solid 1px #CCC;'>Nama</td>";
 *             $html .= "<td width='2%' style='border: solid 1px #CCC;'>:</td>";
 *             $html .= "<td width='33%' style='border: solid 1px #CCC;'>" . $ds_header["nama_pegawai_penilai"] . "</td>";
 *             
 *             $html .= "<td width='15%' style='border: solid 1px #CCC;'>Nama</td>";
 *             $html .= "<td width='2%' style='border: solid 1px #CCC;'>:</td>";
 *             $html .= "<td width='33%' style='border: solid 1px #CCC;'>" . $ds_header["nama_pegawai_atasan_penilai"] . "</td>";
 *         $html .= "</tr>";
 *         $html .= "<tr>";
 *             $html .= "<td style='border: solid 1px #CCC;'>NIP</td>";
 *             $html .= "<td style='border: solid 1px #CCC;'>:</td>";
 *             $html .= "<td style='border: solid 1px #CCC;'>" . $ds_header["nip_penilai"] . "</td>";
 *             
 *             $html .= "<td style='border: solid 1px #CCC;'>NIP</td>";
 *             $html .= "<td style='border: solid 1px #CCC;'>:</td>";
 *             $html .= "<td style='border: solid 1px #CCC;'>" . $ds_header["nip_atasan_penilai"] . "</td>";
 *         $html .= "</tr>";
 *         $html .= "<tr>";
 *             $html .= "<td style='border: solid 1px #CCC;'>Pangkat / Gol. Ruang</td>";
 *             $html .= "<td style='border: solid 1px #CCC;'>:</td>";
 *             $html .= "<td style='border: solid 1px #CCC;'>" . $ds_header["pangkat_penilai"] . " / " . $ds_header["gol_ruang_penilai"] . "</td>";
 *             
 *             $html .= "<td style='border: solid 1px #CCC;'>Pangkat / Gol. Ruang</td>";
 *             $html .= "<td style='border: solid 1px #CCC;'>:</td>";
 *             $html .= "<td style='border: solid 1px #CCC;'>" . $ds_header["pangkat_atasan_penilai"] . " / " . $ds_header["gol_ruang_atasan_penilai"] . "</td>";
 *         $html .= "</tr>";
 *         $html .= "<tr>";
 *             $html .= "<td style='border: solid 1px #CCC;'>Jabatan</td>";
 *             $html .= "<td style='border: solid 1px #CCC;'>:</td>";
 *             $html .= "<td style='border: solid 1px #CCC;'>" . $ds_header["jabatan_penilai"] . "</td>";
 *             
 *             $html .= "<td style='border: solid 1px #CCC;'>Jabatan</td>";
 *             $html .= "<td style='border: solid 1px #CCC;'>:</td>";
 *             $html .= "<td style='border: solid 1px #CCC;'>" . $ds_header["jabatan_atasan_penilai"] . "</td>";
 *         $html .= "</tr>";
 *         $html .= "<tr>";
 *             $html .= "<td style='border: solid 1px #CCC;'>Unit Kerja</td>";
 *             $html .= "<td style='border: solid 1px #CCC;'>:</td>";
 *             $html .= "<td style='border: solid 1px #CCC;'>" . $ds_header["skpd_penilai"] . "</td>";
 *             
 *             $html .= "<td style='border: solid 1px #CCC;'>Unit Kerja</td>";
 *             $html .= "<td style='border: solid 1px #CCC;'>:</td>";
 *             $html .= "<td style='border: solid 1px #CCC;'>" . $ds_header["skpd_atasan_penilai"] . "</td>";
 *         $html .= "</tr>";
 *     $html .= "</table>";
 */
    $html .= "<div style='height: 10px;'></div>";
    $html .= "<table width='100%' cellspacing='0' cellpadding='5' border='0px' style='font-family: sans-serif; font-size: 10pt;'>";
        $html .= "<tr>";
            $html .= "<td><b>Periode Penilaian : " . tglindonesia($ds_header["dari"]) . " S/D " . tglindonesia($ds_header["sampai"]) . "</b></td>";
        $html .= "</tr>";
    $html .= "</table>";
    $html .= "<table width='100%' cellspacing='0' cellpadding='5' border='0px' style='font-family: sans-serif; font-size: 9.5pt;'>";
        $html .= "<thead>";
            $html .= "<tr>";
                $html .= "<td rowspan='2' width='3%' style='text-align: center; border: solid 1px #000000;'>NO.</td>";
                $html .= "<td rowspan='2' width='20%' style='text-align: center; border: solid 1px #000000;'>I. KEGIATAN TUGAS JABATAN</td>";
                $html .= "<td rowspan='2' width='5%' style='text-align: center; border: solid 1px #000000;'>AK</td>";
                $html .= "<td colspan='4' style='text-align: center; border: solid 1px #000000;'>TARGET</td>";
                $html .= "<td rowspan='2' width='5%' style='text-align: center; border: solid 1px #000000;'>AK</td>";
                $html .= "<td colspan='4' style='text-align: center; border: solid 1px #000000;'>REALISASI</td>";
                $html .= "<td rowspan='2' width='7%' style='text-align: center; border: solid 1px #000000;'>PENG<br/>HITUNGAN</td>";
                $html .= "<td rowspan='2' width='8%' style='text-align: center; border: solid 1px #000000;'>CAPAIAN</td>";
            $html .= "</tr>";
            $html .= "<tr>";
                $html .= "<td width='5%' style='text-align: center; border: solid 1px #000000;'>KUANT / OUTPUT</td>";
                $html .= "<td width='5%' style='text-align: center; border: solid 1px #000000;'>KUAL / MUTU</td>";
                $html .= "<td width='5%' style='text-align: center; border: solid 1px #000000;'>WAKTU</td>";
                $html .= "<td width='5%' style='text-align: center; border: solid 1px #000000;'>BIAYA</td>";
                
                $html .= "<td width='5%' style='text-align: center; border: solid 1px #000000;'>KUANT / OUTPUT</td>";
                $html .= "<td width='5%' style='text-align: center; border: solid 1px #000000;'>KUAL / MUTU</td>";
                $html .= "<td width='5%' style='text-align: center; border: solid 1px #000000;'>WAKTU</td>";
                $html .= "<td width='5%' style='text-align: center; border: solid 1px #000000;'>BIAYA</td>";
            $html .= "</tr>";
        $html .= "</thead>";
        $html .= "<tbody>";
        $res_data = mysql_query("SELECT
                                    a.*, c.satuan_waktu, 
                                	CASE
                                		WHEN SUM(b.kuantitas) IS NULL THEN 0
                                		ELSE SUM(b.kuantitas)
                                	END AS rel_kuantitas,
                                	(SELECT AVG(kualitas) FROM tbl_uraian_realisasi_skp WHERE id_skp='" . $_GET["id_skp"] . "' AND id_uraian_skp=b.id_uraian_skp AND kualitas > 0) AS rel_kualitas,
                                	CASE 
                                		WHEN SUM(b.waktu) IS NULL THEN 0
                                		ELSE SUM(b.waktu)
                                	END AS rel_waktu, 
                                	CASE
                                		WHEN SUM(b.biaya) IS NULL THEN 0
                                		ELSE SUM(b.biaya)
                                	END AS rel_biaya
                                FROM
                                	tbl_uraian_skp a
                                	LEFT JOIN tbl_uraian_realisasi_skp b ON a.id_uraian_skp = b.id_uraian_skp
                                	LEFT JOIN ref_satuan_waktu c ON a.id_satuan_waktu = c.id_satuan_waktu
                                WHERE
                                	a.id_skp = '" . $_GET["id_skp"] . "'
                                GROUP BY
                                	a.id_uraian_skp
                                ORDER BY
                                		a.kegiatan ASC");
        $no = 0;
        $total_seluruh = 0;
        while($ds_data = mysql_fetch_array($res_data)){
            // BAGIAN MENGHITUNG PENILAIAN --------------------------------------------------------------------
            $bobot_ak = $ds_data["ak"];
            $target_ak = $bobot_ak * $ds_data["kuantitas"];
            $nilai_ak = $bobot_ak * $ds_data["rel_kuantitas"];
            $tulis_target_ak = "-";
            if($target_ak > 0)
                $tulis_target_ak = $target_ak;
            $tulis_nilai_ak = "-";
            if($nilai_ak > 0)
                $tulis_nilai_ak = $nilai_ak;
             
            $pembagi = 0;
            $nilai_kuantitas = 0;
            if($ds_data["rel_kuantitas"] > 0){
                $nilai_kuantitas = ($ds_data["rel_kuantitas"] * 100) / $ds_data["kuantitas"];
                $pembagi++;
            }
            
            $nilai_kualitas = 0;
            if($ds_data["rel_kualitas"] > 0){
                $nilai_kualitas = ($ds_data["rel_kualitas"] * 100) / $ds_data["kualitas"];
                $pembagi++;
            }
                
            $nilai_waktu = 0;
            if($ds_data["rel_waktu"] > 0){
                $nilai_waktu = (((1.76 * $ds_data["waktu"]) - $ds_data["rel_waktu"]) * 100) / $ds_data["waktu"];
                $pembagi++;
            }
            
            $nilai_biaya = 0;
            if($ds_data["biaya"] > 0 && $ds_data["rel_biaya"] > 0){
                $nilai_biaya = (((1.76 * $ds_data["biaya"]) - $ds_data["rel_biaya"]) * 100) / $ds_data["biaya"];
                $pembagi++;
            }
            $total_penghitungan = $nilai_kuantitas + $nilai_kualitas + $nilai_waktu + $nilai_biaya;
            $total_capaian = 0;
            if($pembagi > 0)
                $total_capaian = $total_penghitungan / $pembagi;
            $total_seluruh += $total_capaian;
            // ------------------------------------------------------------------------------------------------
            $no++;
            $html .= "<tr>";
                $html .= "<td style='text-align: center; border: solid 1px #000000;'>" . $no . "</td>";
                $html .= "<td style='text-align: left; border: solid 1px #000000;'>" . $ds_data["kegiatan"] . "</td>";
                
                $html .= "<td style='text-align: center; border: solid 1px #000000;'>" . $tulis_target_ak . "</td>";
                $html .= "<td style='text-align: center; border: solid 1px #000000;'>" . $ds_data["kuantitas"] . " " . $ds_data["satuan_kuantitas"] . "</td>";
                $html .= "<td style='text-align: center; border: solid 1px #000000;'>" . number_format($ds_data["kualitas"], 2) . "</td>";
                $html .= "<td style='text-align: center; border: solid 1px #000000;'>" . $ds_data["waktu"] . " " . $ds_data["satuan_waktu"] . "</td>";
                if($ds_data["biaya"] > 0)
                    $html .= "<td style='text-align: center; border: solid 1px #000000;'>" . number_format($ds_data["biaya"], 0, ".", ",") . "</td>";
                else
                    $html .= "<td style='text-align: center; border: solid 1px #000000;'>-</td>";
                
                $html .= "<td style='text-align: center; border: solid 1px #000000;'>" . $tulis_nilai_ak . "</td>";
                if($ds_data["rel_kuantitas"] > 0)
                    $html .= "<td style='text-align: center; border: solid 1px #000000;'>" . $ds_data["rel_kuantitas"] . " " . $ds_data["satuan_kuantitas"] . "</td>";
                else
                    $html .= "<td style='text-align: center; border: solid 1px #000000;'>-</td>";
                
                $html .= "<td style='text-align: center; border: solid 1px #000000;'>" . number_format($nilai_kualitas, 2) . "</td>";
                
                if($ds_data["rel_waktu"] > 0)
                    $html .= "<td style='text-align: center; border: solid 1px #000000;'>" . $ds_data["rel_waktu"] . " " . $ds_data["satuan_waktu"] . "</td>";
                else
                    $html .= "<td style='text-align: center; border: solid 1px #000000;'>-</td>";
                
                if($ds_data["rel_biaya"] > 0)
                    $html .= "<td style='text-align: center; border: solid 1px #000000;'>" . number_format($ds_data["rel_biaya"], 0, ".", ",") . "</td>";
                else
                    $html .= "<td style='text-align: center; border: solid 1px #000000;'>-</td>";
                
                $html .= "<td style='text-align: center; border: solid 1px #000000;'>" . number_format($total_penghitungan, 2) . "</td>";
                $html .= "<td style='text-align: center; border: solid 1px #000000;'>" . number_format($total_capaian, 2) . "</td>";
            $html .= "</tr>";
        }
        $nilai_skp = $total_seluruh / $no;
            $html .= "<tr>";
                $html .= "<td style='text-align: center; border: solid 1px #000000;'>&nbsp;</td>";
                $html .= "<td style='text-align: left; border: solid 1px #000000;' colspan='13'>II. TUGAS TAMBAHAN DAN KREATIFITAS / UNSUR PENUNJANG :</td>";
            $html .= "</tr>";
            
            $html .= "<tr>";
                $html .= "<td style='text-align: center; border: solid 1px #000000;'>&nbsp;</td>";
                $html .= "<td style='text-align: left; border: solid 1px #000000;' colspan='13'><b>A. TUGAS TAMBAHAN</b></td>";
            $html .= "</tr>";
            $res_tugas_tambahan = mysql_query("SELECT * FROM tbl_skp_tugas_tambahan WHERE id_skp='" . $_GET["id_skp"] . "'");
            $no_tugas_tambahan = 0;
            while($ds_tugas_tambahan = mysql_fetch_array($res_tugas_tambahan)){
                $no_tugas_tambahan++;
                $html .= "<tr>";
                    $html .= "<td style='text-align: center; border-left: solid 1px #000000;'>&nbsp;</td>";
                    $html .= "<td style='text-align: left; border-right: solid 1px #000000;' colspan='13'>" . $no_tugas_tambahan . ". " . $ds_tugas_tambahan["tugas_tambahan"] . "</td>";
                $html .= "</tr>";
            }
            $html .= "<tr>";
                $html .= "<td style='text-align: center; border: solid 1px #000000;'>&nbsp;</td>";
                $html .= "<td style='text-align: left; border: solid 1px #000000;' colspan='12'><b>TOTAL TUGAS TAMBAHAN</b></td>";
                $html .= "<td style='text-align: center; border: solid 1px #000000;'>" . $no_tugas_tambahan . "</td>";
            $html .= "</tr>";
            
            $html .= "<tr>";
                $html .= "<td style='text-align: center; border: solid 1px #000000;'>&nbsp;</td>";
                $html .= "<td style='text-align: left; border: solid 1px #000000;' colspan='13'><b>B. KREATIFITAS</b></td>";                
            $html .= "</tr>";
            $res_kreatifitas = mysql_query("SELECT * FROM tbl_skp_kreatifitas WHERE id_skp='" . $_GET["id_skp"] . "'");
            $no_kreatifitas = 0;
            while($ds_kreatifitas = mysql_fetch_array($res_kreatifitas)){
                $no_kreatifitas++;
                $html .= "<tr>";
                    $html .= "<td style='text-align: center; border-left: solid 1px #000000;'>&nbsp;</td>";
                    $html .= "<td style='text-align: left; border-right: solid 1px #000000;' colspan='13'>" . $no_kreatifitas . ". " . $ds_kreatifitas["kreatifitas"] . "</td>";
                $html .= "</tr>";
            }
            $html .= "<tr>";
                $html .= "<td style='text-align: center; border: solid 1px #000000;'>&nbsp;</td>";
                $html .= "<td style='text-align: left; border: solid 1px #000000;' colspan='12'><b>TOTAL KREATIFITAS</b></td>";
                $html .= "<td style='text-align: center; border: solid 1px #000000;'>" . $no_kreatifitas . "</td>";
            $html .= "</tr>";
            
            $html .= "<tr>";
                $html .= "<td style='text-align: center; border: solid 1px #000000;'>&nbsp;</td>";
                $html .= "<td style='text-align: left; border: solid 1px #000000;' colspan='12'><b>JUMLAH</b></td>";
                $html .= "<td style='text-align: center; border: solid 1px #000000;'>" . number_format($total_seluruh, 2) . "</td>";
            $html .= "</tr>";
            
            $html .= "<tr>";
                $html .= "<td style='text-align: center; border: solid 1px #000000;' colspan='13' ><b>NILAI CAPAIAN SKP</b></td>";
                $html .= "<td style='text-align: center; border: solid 1px #000000;'><b>" . number_format($nilai_skp, 2) . "<br />" . strtoupper(konversi_nilai_ke_huruf($nilai_skp)) . "</b></td>";
            $html .= "</tr>";
            
            /*$html .= "<tr>";
                $html .= "<td style='text-align: center; border: solid 1px #000000;'>" . strtoupper(konversi_nilai_ke_huruf($nilai_skp)) . "</td>";
            $html .= "</tr>";*/
        $html .= "</tbody>";
    $html .= "</table>";
    
    $html .= "<div style='height: 10px;'></div>";
    $html .= "<table width='100%' cellspacing='0' cellpadding='5' border='0px' style='font-family: sans-serif; font-size: 10pt;'>";
        $html .= "<tr>";
            $html .= "<td>&nbsp;</td>";
            $html .= "<td width='20%' align='center'>Medan, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td>&nbsp;</td>";
            $html .= "<td align='center'>Pejabat Penilai</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='height: 50px;'>&nbsp;</td>";
            $html .= "<td align='center'>&nbsp;</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td>&nbsp;</td>";
            $html .= "<td align='center'>" . $ds_header["nama_pegawai_penilai"] . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td>&nbsp;</td>";
            $html .= "<td align='center'>NIP : " . $ds_header["nip_penilai"] . "</td>";
        $html .= "</tr>";
    $html .= "</table>";
    
    $html .= "</body>";
    $html .= "</html>";
?>
<?php
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->set_paper("a4", "landscape");
    $dompdf->render();
    
    //echo($html);

    $dompdf->stream("realisasi_skp.pdf", array("Attachment" => false));

  exit(0);
?>