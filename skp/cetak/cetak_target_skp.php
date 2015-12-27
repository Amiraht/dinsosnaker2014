<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once("../php/dompdf_config.inc.php"); ?>
<?php require_once("../php/koneksi.php"); ?>
<?php require_once("../php/fungsi.php"); ?>
<?php date_default_timezone_set("America/New_York"); ?>
<?php
			
			$id = mysql_real_escape_string(strip_tags($_GET['id_skp']));
			
			$sql = mysql_query("SELECT 
                                	a.*, b.nama_pegawai AS nama_pegawai_penilai, b.nip AS nip_penilai, 
                                	c.nama_pegawai AS nama_pegawai_atasan_penilai, c.nip AS nip_atasan_penilai,
                                	d.pangkat AS pangkat_penilai, d.gol_ruang AS gol_ruang_penilai,
                                	e.pangkat AS pangkat_atasan_penilai, e.gol_ruang AS gol_ruang_atasan_penilai,
                                	f.skpd AS skpd_penilai, g.skpd AS skpd_atasan_penilai,
                                	h.jabatan AS jabatan_penilai, i.jabatan AS jabatan_atasan_penilai,
                                    CASE
                                		WHEN b.gelar_depan <> '' AND b.gelar_depan IS NOT NULL THEN CONCAT(b.gelar_depan, '. ')
                                		ELSE ''
                                	END AS geldep_penilai,
                                	CASE
                                		WHEN c.gelar_depan <> '' AND c.gelar_depan IS NOT NULL THEN CONCAT(c.gelar_depan, '. ')
                                		ELSE ''
                                	END AS geldep_pegawai,
                                	CASE
                                		WHEN b.gelar_belakang <> '' AND b.gelar_belakang IS NOT NULL THEN CONCAT(', ', b.gelar_belakang)
                                		ELSE ''
                                	END AS gelbel_penilai,
                                	CASE
                                		WHEN c.gelar_belakang <> '' AND c.gelar_belakang IS NOT NULL THEN CONCAT(', ', c.gelar_belakang)
                                		ELSE ''
                                	END AS gelbel_pegawai
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
                                	a.id_skp='" . $id . "'
                                ORDER BY
                                	a.dari ASC
                                ") or die(mysql_error());	
								
            $ds_header = mysql_fetch_array($sql);
            $gelar_depan_penilai = $ds_header["geldep_penilai"];
            $gelar_belakang_penilai = $ds_header["gelbel_penilai"];
            $gelar_depan_pegawai = $ds_header["geldep_pegawai"];
            $gelar_belakang_pegawai = $ds_header["gelbel_pegawai"];
																			
        ?>
<?php
    $html = "";
    $html .= "<html>";
    $html .= "<head>";
    
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<div style='text-align: center'><h3>SASARAN KERJA PEGAWAI</h3></div>";
    $html .= "<div style='height: 30px'>&nbsp;</div>";
    $html .= "<table width='100%' cellspacing='0' cellpadding='5' border='0px' style='font-family: sans-serif; font-size: 9pt;'>";
        $html .= "<tr>";
            $html .= "<td style='font-weight: bold'>I. PEJABAT PENILAI</td>";
            $html .= "<td style='font-weight: bold'>II. PNS YANG DINILAI</td>";
        $html .= "</tr>";
    $html .= "</table>";
    $html .= "<table width='100%' cellspacing='0' cellpadding='5' border='0px' style='font-family: sans-serif; font-size: 9pt;'>";
        $html .= "<tr>";
            $html .= "<td width='15%' style='border: solid 1px #000000;'>Nama</td>";
            $html .= "<td width='2%' style='border: solid 1px #000000;'>:</td>";
            $html .= "<td width='33%' style='border: solid 1px #000000;'>" . $gelar_depan_penilai . "" . $ds_header["nama_pegawai_penilai"] . "" . $gelar_belakang_penilai . "</td>";
            
            $html .= "<td width='15%' style='border: solid 1px #000000;'>Nama</td>";
            $html .= "<td width='2%' style='border: solid 1px #000000;'>:</td>";
            $html .= "<td width='33%' style='border: solid 1px #000000;'>" . $gelar_depan_pegawai . "" . $ds_header["nama_pegawai_atasan_penilai"] . "" . $gelar_belakang_pegawai . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;'>NIP</td>";
            $html .= "<td style='border: solid 1px #000000;'>:</td>";
            $html .= "<td style='border: solid 1px #000000;'>" . $ds_header["nip_penilai"] . "</td>";
            
            $html .= "<td style='border: solid 1px #000000;'>NIP</td>";
            $html .= "<td style='border: solid 1px #000000;'>:</td>";
            $html .= "<td style='border: solid 1px #000000;'>" . $ds_header["nip_atasan_penilai"] . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;'>Pangkat / Gol. Ruang</td>";
            $html .= "<td style='border: solid 1px #000000;'>:</td>";
            $html .= "<td style='border: solid 1px #000000;'>" . $ds_header["pangkat_penilai"] . " / " . $ds_header["gol_ruang_penilai"] . "</td>";
            
            $html .= "<td style='border: solid 1px #000000;'>Pangkat / Gol. Ruang</td>";
            $html .= "<td style='border: solid 1px #000000;'>:</td>";
            $html .= "<td style='border: solid 1px #000000;'>" . $ds_header["pangkat_atasan_penilai"] . " / " . $ds_header["gol_ruang_atasan_penilai"] . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;'>Jabatan</td>";
            $html .= "<td style='border: solid 1px #000000;'>:</td>";
            $html .= "<td style='border: solid 1px #000000;'>" . $ds_header["jabatan_penilai"] . "</td>";
            
            $html .= "<td style='border: solid 1px #000000;'>Jabatan</td>";
            $html .= "<td style='border: solid 1px #000000;'>:</td>";
            $html .= "<td style='border: solid 1px #000000;'>" . $ds_header["jabatan_atasan_penilai"] . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='border: solid 1px #000000;'>Unit Kerja</td>";
            $html .= "<td style='border: solid 1px #000000;'>:</td>";
            $html .= "<td style='border: solid 1px #000000;'>" . $ds_header["skpd_penilai"] . "</td>";
            
            $html .= "<td style='border: solid 1px #000000;'>Unit Kerja</td>";
            $html .= "<td style='border: solid 1px #000000;'>:</td>";
            $html .= "<td style='border: solid 1px #000000;'>" . $ds_header["skpd_atasan_penilai"] . "</td>";
        $html .= "</tr>";
    $html .= "</table>";
    $html .= "<div style='height: 10px;'></div>";
    $html .= "<table width='100%' cellspacing='0' cellpadding='5' border='0px' style='font-family: sans-serif; font-size: 9pt;'>";
        $html .= "<thead>";
            $html .= "<tr>";
                $html .= "<td rowspan='2' width='5%' style='text-align: center; border: solid 1px #000000;'>NO.</td>";
                $html .= "<td rowspan='2' width='40%' style='text-align: center; border: solid 1px #000000;'>III. KEGIATAN TUGAS JABATAN</td>";
                $html .= "<td rowspan='2' width='5%' style='text-align: center; border: solid 1px #000000;'>AK</td>";
                $html .= "<td colspan='4' style='text-align: center; border: solid 1px #000000;'>TARGET</td>";
            $html .= "</tr>";
            $html .= "<tr>";
                $html .= "<td width='15%' style='text-align: center; border: solid 1px #000000;'>KUANTITAS / OUTPUT</td>";
                $html .= "<td width='10%' style='text-align: center; border: solid 1px #000000;'>KUALITAS / MUTU</td>";
                $html .= "<td width='10%' style='text-align: center; border: solid 1px #000000;'>WAKTU</td>";
                $html .= "<td width='15%' style='text-align: center; border: solid 1px #000000;'>BIAYA</td>";
            $html .= "</tr>";
        $html .= "</thead>";
        $html .= "<tbody>";
        $res_data = mysql_query("SELECT
                                	*
                                FROM
                                	tbl_uraian_skp_fix
                                WHERE
                                	id_skp = '" . $id . "'
                                ORDER BY
                                    id_uraian_skp ASC") or die(mysql_error());
        $no = 0;
        while($ds_data = mysql_fetch_array($res_data)){
            $ak = "-";
            $biaya = "-";
            if($ds_data["ak"] * $ds_data["kuantitas"] > 0)
                $ak = $ds_data["ak"] * $ds_data["kuantitas"];
            if($ds_data["biaya"] > 0)
                $biaya = number_format($ds_data["biaya"], 0, ".", ",");
            $no++;
            $html .= "<tr>";
                $html .= "<td style='text-align: center; border: solid 1px #000000;'>" . $no . "</td>";
                $html .= "<td style='text-align: left; border: solid 1px #000000;'>" . $ds_data["kegiatan"] . "</td>";
                $html .= "<td style='text-align: center; border: solid 1px #000000;'>" . $ak . "</td>";
                $html .= "<td style='text-align: center; border: solid 1px #000000;'>" . $ds_data["kuantitas"] . " " . $ds_data["satuan_kuantitas"] . "</td>";
                $html .= "<td style='text-align: center; border: solid 1px #000000;'>" . $ds_data["kualitas"] . "</td>";
                $html .= "<td style='text-align: center; border: solid 1px #000000;'>" . $ds_data["waktu"] . " Bulan</td>";
                $html .= "<td style='text-align: center; border: solid 1px #000000;'>" . $biaya . "</td>";
            $html .= "</tr>";
        }
        $html .= "</tbody>";
    $html .= "</table>";
    $html .= "<div style='height: 20px;'>&nbsp;</div>";
    $html .= "<table width='100%' cellspacing='0' cellpadding='5' border='0px' style='font-family: sans-serif; font-size: 9pt;'>";
        $html .= "<tr>";
            $html .= "<td align='left'>PEJABAT YANG MENILAI</td>";
            $html .= "<td width='50%' align='left'>Tanggal,<br />PEGAWAI NEGERI SIPIL YANG DINILAI</td>";
        $html .= "</tr>";
        $html .= "<tr>";
            $html .= "<td style='height: 70px;'>&nbsp;</td>";
            $html .= "<td>&nbsp;</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td align='left'>" . $gelar_depan_penilai . strtoupper($ds_header["nama_pegawai_penilai"]) . $gelar_belakang_penilai . "<br/>NIP : " . $ds_header["nip_penilai"] . "</td>";
            $html .= "<td width='50%' align='left'>" . $gelar_depan_pegawai . strtoupper($ds_header["nama_pegawai_atasan_penilai"]) . $gelar_belakang_pegawai . "<br/>NIP : " . $ds_header["nip_atasan_penilai"] . "</td>";
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
	
	//echo $html;
	
    $dompdf->stream("target_skp.pdf", array("Attachment" => false));
    mysql_close();
  exit(0);
?>