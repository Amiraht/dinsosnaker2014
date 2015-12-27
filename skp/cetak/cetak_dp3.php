<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once("../php/dompdf_config.inc.php"); ?>
<?php require_once("../php/koneksi.php"); ?>
<?php require_once("../php/fungsi.php"); ?>
<?php date_default_timezone_set("America/New_York"); ?>
<?php
            $ds_header = mysql_fetch_array(mysql_query("SELECT
                                	a.*, 
                                	b.nama_pegawai AS nama_pegawai_penilai, b.nip AS nip_penilai, 
                                	c.nama_pegawai AS nama_pegawai_atasan_penilai, c.nip AS nip_atasan_penilai,
                                	bc.nama_pegawai AS nama_pegawai, bc.nip AS nip,
                                	d.pangkat AS pangkat_penilai, d.gol_ruang AS gol_ruang_penilai,
                                	e.pangkat AS pangkat_atasan_penilai, e.gol_ruang AS gol_ruang_atasan_penilai,
                                	de.pangkat AS pangkat, de.gol_ruang AS gol_ruang,
                                	f.skpd AS skpd_penilai, g.skpd AS skpd_atasan_penilai,
                                	fg.skpd AS skpd,
                                	h.jabatan AS jabatan_penilai, i.jabatan AS jabatan_atasan_penilai,
                                	hi.jabatan AS jabatan
                                FROM
                                	tbl_skp a
                                	LEFT JOIN tbl_pegawai b ON a.id_pegawai_penilai = b.id_pegawai
                                	LEFT JOIN tbl_pegawai c ON a.id_atasan_pegawai_penilai = c.id_pegawai
                                	LEFT JOIN tbl_pegawai bc ON a.id_pegawai = bc.id_pegawai
                                	LEFT JOIN ref_pangkat d ON b.id_pangkat = d.id_pangkat
                                	LEFT JOIN ref_pangkat e ON c.id_pangkat = e.id_pangkat
                                	LEFT JOIN ref_pangkat de ON bc.id_pangkat = de.id_pangkat
                                	LEFT JOIN ref_skpd f ON b.id_satuan_organisasi = f.id_skpd
                                	LEFT JOIN ref_skpd g ON c.id_satuan_organisasi = g.id_skpd
                                	LEFT JOIN ref_skpd fg ON bc.id_satuan_organisasi = fg.id_skpd
                                	LEFT JOIN ref_jabatan h ON b.id_jabatan = h.id_jabatan
                                	LEFT JOIN ref_jabatan i ON c.id_jabatan = i.id_jabatan
                                	LEFT JOIN ref_jabatan hi ON bc.id_jabatan = hi.id_jabatan
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
    $html .= "<div style='text-align: center'><h3>PENILAIAN PRESTASI KERJA PEGAWAI</h3></div>";
    $html .= "<div style='height: 30px'>&nbsp;</div>";
    $html .= "<div style='height: 50px;'></div>";
    $html .= "<div style='text-align: center;'>";
        $html .= "<img src='../image/garuda.png' width='150px' style='border: solid 0px black;' />";
    $html .= "</div>";
    $html .= "<div style='height: 70px;'></div>";
    $html .= "<table width='100%' cellspacing='0' cellpadding='5' border='0px' style='font-family: sans-serif; font-size: 9pt;'>";
        $html .= "<tr>";
            $html .= "<td width='5%' style='border: solid 1px #000000;' align='center' rowspan='6'>1</td>";
            $html .= "<td style='border: solid 1px #000000;' colspan='2'><b>YANG DINILAI</b></td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;' width='30%'>Nama</td>";
            $html .= "<td style='border: solid 1px #000000;'>" . $ds_header["nama_pegawai"] . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";            
            $html .= "<td style='border: solid 1px #000000;'>NIP</td>";
            $html .= "<td style='border: solid 1px #000000;'>" . $ds_header["nip"] . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;'>Pangkat, Gol. Ruang</td>";
            $html .= "<td style='border: solid 1px #000000;'>" . $ds_header["pangkat"] . " / " . $ds_header["gol_ruang"] . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;'>Jabatan / Pekerjaan</td>";
            $html .= "<td style='border: solid 1px #000000;'>" . $ds_header["jabatan"] . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;'>Unit Organisasi</td>";
            $html .= "<td style='border: solid 1px #000000;'>" . $ds_header["skpd"] . "</td>";
        $html .= "</tr>";
    $html .= "</table>";
    
    $html .= "<table width='100%' cellspacing='0' cellpadding='5' border='0px' style='font-family: sans-serif; font-size: 9pt;'>";
        $html .= "<tr>";
            $html .= "<td width='5%' style='border: solid 1px #000000;' align='center' rowspan='6'>2</td>";
            $html .= "<td style='border: solid 1px #000000;' colspan='2'><b>PEJABAT PENILAI</b></td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;' width='30%'>Nama</td>";
            $html .= "<td style='border: solid 1px #000000;'>" . $ds_header["nama_pegawai_penilai"] . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";            
            $html .= "<td style='border: solid 1px #000000;'>NIP</td>";
            $html .= "<td style='border: solid 1px #000000;'>" . $ds_header["nip_penilai"] . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;'>Pangkat, Gol. Ruang</td>";
            $html .= "<td style='border: solid 1px #000000;'>" . $ds_header["pangkat_penilai"] . " / " . $ds_header["gol_ruang_penilai"] . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;'>Jabatan / Pekerjaan</td>";
            $html .= "<td style='border: solid 1px #000000;'>" . $ds_header["jabatan_penilai"] . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;'>Unit Organisasi</td>";
            $html .= "<td style='border: solid 1px #000000;'>" . $ds_header["skpd_penilai"] . "</td>";
        $html .= "</tr>";
    $html .= "</table>";
    
    $html .= "<table width='100%' cellspacing='0' cellpadding='5' border='0px' style='font-family: sans-serif; font-size: 9pt;'>";
        $html .= "<tr>";
            $html .= "<td width='5%' style='border: solid 1px #000000;' align='center' rowspan='6'>3</td>";
            $html .= "<td style='border: solid 1px #000000;' colspan='2'><b>ATASAN PEJABAT PENILAI</b></td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;' width='30%'>Nama</td>";
            $html .= "<td style='border: solid 1px #000000;'>" . $ds_header["nama_pegawai_atasan_penilai"] . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";            
            $html .= "<td style='border: solid 1px #000000;'>NIP</td>";
            $html .= "<td style='border: solid 1px #000000;'>" . $ds_header["nip_atasan_penilai"] . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;'>Pangkat, Gol. Ruang</td>";
            $html .= "<td style='border: solid 1px #000000;'>" . $ds_header["pangkat_atasan_penilai"] . " / " . $ds_header["gol_ruang_atasan_penilai"] . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;'>Jabatan / Pekerjaan</td>";
            $html .= "<td style='border: solid 1px #000000;'>" . $ds_header["jabatan_atasan_penilai"] . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;'>Unit Organisasi</td>";
            $html .= "<td style='border: solid 1px #000000;'>" . $ds_header["skpd_atasan_penilai"] . "</td>";
        $html .= "</tr>";
    $html .= "</table>";
    
    $html .= "<div style='height: 180px;'></div>";
    
    $html .= "<table width='100%' cellspacing='0' cellpadding='5' border='0px' style='font-family: sans-serif; font-size: 9pt;'>";
        $html .= "<tr>";
            $html .= "<td width='5%' style='border: solid 1px #000000;' align='center' rowspan='11'>4</td>";
            $html .= "<td style='border: solid 1px #000000;' colspan='4'><b>UNSUR YANG DINILAI</b></td>";
            $html .= "<td width='20%' align='center' style='border: solid 1px #000000;'><b>JUMLAH</b></td>";
        $html .= "</tr>";
        
        // CARI NILAI SKP --------------------------------------------------------------------------
        //$nilai_skp = total_nilai_skp($_GET["id_skp"]);
        $nilai_skp_belum_persen = total_nilai_skp($_GET["id_skp"]); 
        $nilai_skp = ($nilai_skp_belum_persen * 60) / 100;
        // -----------------------------------------------------------------------------------------
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;' colspan='4'><b>a. SASARAN KERJA PNS (SKP) = " .  number_format($nilai_skp_belum_persen, 2) . " * 60%</b></td>";
            $html .= "<td style='border: solid 1px #000000;' align='center'><b>" . number_format($nilai_skp, 2) . "</b></td>";
        $html .= "</tr>";
        
        // CARI NILAI SKP --------------------------------------------------------------------------
        $ds_perilaku = mysql_fetch_array(mysql_query("SELECT *, 
                                                	(orientasi_pelayanan + integritas + komitmen + disiplin + kerja_sama + kepemimpinan) AS total ,
                                                	((orientasi_pelayanan + integritas + komitmen + disiplin + kerja_sama + kepemimpinan) / 6) AS rata
                                                FROM 
                                                	tbl_skp_perilaku 
                                                WHERE 
                                                	id_skp='" . $_GET["id_skp"] . "'"));
        $nilai_perilaku_kerja = ($ds_perilaku["rata"] * 40) / 100;
        // -----------------------------------------------------------------------------------------
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;' rowspan='9'><b>b. PERILAKU KERJA</b></td>";
            $html .= "<td style='border: solid 1px #000000;'>1. Orientasi Pelayanan</td>";
            $html .= "<td style='border: solid 1px #000000;' align='center'>" . $ds_perilaku["orientasi_pelayanan"] . "</td>";
            $html .= "<td style='border: solid 1px #000000;' align='center'>" . konversi_nilai_ke_huruf($ds_perilaku["orientasi_pelayanan"]) . "</td>";
            $html .= "<td style='border: solid 1px #000000;' rowspan='8'>&nbsp;</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;'>2. Integritas</td>";
            $html .= "<td style='border: solid 1px #000000;' align='center'>" . $ds_perilaku["integritas"] . "</td>";
            $html .= "<td style='border: solid 1px #000000;' align='center'>" . konversi_nilai_ke_huruf($ds_perilaku["integritas"]) . "</td>";
            
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;'>3. Komitmen</td>";
            $html .= "<td style='border: solid 1px #000000;' align='center'>" . $ds_perilaku["komitmen"] . "</td>";
            $html .= "<td style='border: solid 1px #000000;' align='center'>" . konversi_nilai_ke_huruf($ds_perilaku["komitmen"]) . "</td>";
            
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;'>4. Disiplin</td>";
            $html .= "<td style='border: solid 1px #000000;' align='center'>" . $ds_perilaku["disiplin"] . "</td>";
            $html .= "<td style='border: solid 1px #000000;' align='center'>" . konversi_nilai_ke_huruf($ds_perilaku["disiplin"]) . "</td>";
            
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;'>5. Kerja Sama</td>";
            $html .= "<td style='border: solid 1px #000000;' align='center'>" . $ds_perilaku["kerja_sama"] . "</td>";
            $html .= "<td style='border: solid 1px #000000;' align='center'>" . konversi_nilai_ke_huruf($ds_perilaku["kerja_sama"]) . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;'>6. Kepemimpinan</td>";
            $html .= "<td style='border: solid 1px #000000;' align='center'>" . $ds_perilaku["kepemimpinan"] . "</td>";
            $html .= "<td style='border: solid 1px #000000;' align='center'>" . konversi_nilai_ke_huruf($ds_perilaku["kepemimpinan"]) . "</td>";
            
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;'>7. Jumlah</td>";
            $html .= "<td style='border: solid 1px #000000;' align='center'>" . $ds_perilaku["total"] . "</td>";
            $html .= "<td style='border: solid 1px #000000;'>&nbsp;</td>";
            
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;'>8. Nilai Rata-Rata</td>";
            $html .= "<td style='border: solid 1px #000000;' align='center'>" . number_format($ds_perilaku["rata"], 2) . "</td>";
            $html .= "<td style='border: solid 1px #000000;'>&nbsp;</td>";
            
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;' colspan='3'><b>9. Nilai Perilaku Kerja = " .  number_format($ds_perilaku["rata"], 2) . " * 40%</b></td>";
            $html .= "<td style='border: solid 1px #000000;' align='center'><b>" . number_format($nilai_perilaku_kerja, 2) . "</b></td>";
        $html .= "</tr>";
    $html .= "</table>";
    
    // CARI NILAI PRESTASI KERJA ---------------------------------------------------------------------
    $nilai_prestasi_kerja = $nilai_skp + $nilai_perilaku_kerja;
    // -----------------------------------------------------------------------------------------------
    $html .= "<table width='100%' cellspacing='0' cellpadding='5' border='0px' style='font-family: sans-serif; font-size: 9pt;'>";
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;' colspan='4' align='center'><b>NILAI PRESTASI KERJA</b></td>";
            $html .= "<td width='20%' align='center' style='border: solid 1px #000000;'><b>" . number_format($nilai_prestasi_kerja, 2) . "<br />(" . strtoupper(konversi_nilai_ke_huruf($nilai_prestasi_kerja)) . ")</b></td>";
        $html .= "</tr>";
    $html .= "</table>";
    
    // CARI DATA KEBERATAN ---------------------------------------------------------------------------
    $ds_dp3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_skp_dp3 WHERE id_skp='" . $_GET["id_skp"] . "'"));
    // -----------------------------------------------------------------------------------------------
    $html .= "<table width='100%' cellspacing='0' cellpadding='5' border='0px' style='font-family: sans-serif; font-size: 9pt;'>";
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;' colspan='4' align='left'>
                <div><b>5. KEBERATAN DARI PEGAWAI NEGERI SIPIL<br />YANG DINILAI (APABILA ADA)</b></div>
                <div style='height:10px;'>&nbsp;</div>
                <div>" . $ds_perilaku["keberatan"] . "</div>
                <div style='height:10px;'>&nbsp;</div>
                <div><i>Tanggal,</i></div>
            </td>";
        $html .= "</tr>";
    $html .= "</table>";
    //$html .= "<div style='height:50px;'></div>";
    $html .= "<table width='100%' cellspacing='0' cellpadding='5' border='0px' style='font-family: sans-serif; font-size: 9pt;'>";
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;' colspan='4' align='left'>
                <div><b>6. TANGGAPAN PEJABAT PENILAI ATAS KEBERATAN</b></div>
                <div style='height:10px;'>&nbsp;</div>
                <div>" . $ds_perilaku["tanggapan"] . "</div>
                <div style='height:10px;'>&nbsp;</div>
                <div style='text-align:left;'><i>Tanggal,</i></div>
            </td>";
        $html .= "</tr>";
    $html .= "</table>";
    $html .= "<table width='100%' cellspacing='0' cellpadding='5' border='0px' style='font-family: sans-serif; font-size: 9pt;'>";
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;' colspan='4' align='left'>
                <div><b>7. KEPUTUSAN ATASAN PEJABAT PENILAI ATAS KEBERATAN</b></div>
                <div style='height:10px;'>&nbsp;</div>
                <div>" . $ds_perilaku["keputusan"] . "</div>
                <div style='height:10px;'>&nbsp;</div>
                <div style='text-align:left;'><i>Tanggal,</i></div>
            </td>";
        $html .= "</tr>";
    $html .= "</table>";
    $html .= "<table width='100%' cellspacing='0' cellpadding='5' border='0px' style='font-family: sans-serif; font-size: 9pt;'>";
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;' colspan='4' align='left'>
                <div><b>8. REKOMENDASI</b></div>
                <div style='height:20px;'>&nbsp;</div>
                <div></div>
                <div style='height:20px;'>&nbsp;</div>
            </td>";
        $html .= "</tr>";
    $html .= "</table>";
    
    $html .= "<table width='100%' cellspacing='0' cellpadding='5' border='0px' style='font-family: sans-serif; font-size: 9pt;'>";
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;' colspan='4' align='left'>
                <div style='text-align:right;'><b>9. DIBUAT TANGGAL,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></div>
                <div style='text-align:right;'><b>PEJABAT PENILAI</b></div>
                <div style='text-align:right; height:30px;'></div>
                <div style='text-align:right;'>(" . $ds_header["nama_pegawai_penilai"] . ")</div>
                <div style='text-align:right;'>NIP : " . $ds_header["nip_penilai"] . "</div>
            </td>";
        $html .= "</tr>";
        
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;' colspan='4' align='left'>
                <div style='text-align:left;'><b>10. DITERIMA TANGGAL,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></div>
                <div style='text-align:left;'><b>PEGAWAI NEGERI SIPIL YANG DINILAI</b></div>
                <div style='text-align:left; height:30px;'></div>
                <div style='text-align:left;'>(" . $ds_header["nama_pegawai"] . ")</div>
                <div style='text-align:left;'>NIP : " . $ds_header["nip"] . "</div>
            </td>";
        $html .= "</tr>";
        
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;' colspan='4' align='left'>
                <div style='text-align:right;'><b>11. DITERIMA TANGGAL,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></div>
                <div style='text-align:right;'><b>ATASAN PEJABAT YANG MENILAI</b></div>
                <div style='text-align:right; height:30px;'></div>
                <div style='text-align:right;'>(" . $ds_header["nama_pegawai_atasan_penilai"] . ")</div>
                <div style='text-align:right;'>NIP : " . $ds_header["nip_atasan_penilai"] . "</div>
            </td>";
        $html .= "</tr>";
    $html .= "</table>";
    
    $html .= "</body>";
    $html .= "</html>";
?>
<?php
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->set_paper("a4", "portrait");
    $dompdf->render();
    
    //echo($html);

    $dompdf->stream("dp3.pdf", array("Attachment" => false));

  exit(0);
?>