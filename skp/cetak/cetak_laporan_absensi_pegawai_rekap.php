<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once("../php/dompdf_config.inc.php"); ?>
<?php require_once("../php/koneksi.php"); ?>
<?php require_once("../php/fungsi.php"); ?>
<?php date_default_timezone_set("America/New_York"); ?>

<?php
    $whr = "";
     if($_POST["kode_skpd"] != "all")
        $whr .= " AND f.kode_skpd LIKE '" . $_POST["kode_skpd"] . "%' ";
     
     $whrbln = "";
     if($_POST["bulan"] != "0")
        $whrbln .= " AND a.bulan = '" . $_POST["bulan"] . "' ";
        
     $sql = "SELECT
                	a.id_pegawai, a.nama_pegawai, a.nip, a.gelar_depan, a.gelar_belakang,
                	f.skpd, g.pangkat, g.gol_ruang, h.jabatan,
                	CASE
                		WHEN rekap.id_pegawai IS NULL THEN 0
                		ELSE 1
                	END AS sudah_isi,
                	rekap.hari, rekap.hadir, rekap.alpa, rekap.sakit, rekap.izin, rekap.cuti, rekap.tugas_luar, rekap.tugas_belajar
                FROM
                	tbl_pegawai a
                	LEFT JOIN ref_status_kepegawaian b ON a.id_status_kepegawaian = b.id_status_kepegawaian
                	LEFT JOIN ref_jenis_kelamin e ON a.id_jenis_kelamin = e.id_jenis_kelamin
                	LEFT JOIN ref_skpd f ON a.id_satuan_organisasi = f.id_skpd
                	LEFT JOIN ref_pangkat g ON a.id_pangkat = g.id_pangkat
                	LEFT JOIN ref_jabatan h ON a.id_jabatan = h.id_jabatan
                	LEFT JOIN (
                		SELECT
                			b.id_pegawai, a.id_skp, SUM(a.hari) AS hari, SUM(a.hadir) AS hadir,
                			SUM(a.alpa) AS alpa, SUM(a.sakit) AS sakit, SUM(a.izin) AS izin,
                			SUM(a.cuti) AS cuti, SUM(a.tugas_luar) AS tugas_luar, SUM(a.tugas_belajar) AS tugas_belajar
                		FROM
                			tbl_skp_kehadiran a
                			LEFT JOIN tbl_skp b ON a.id_skp = b.id_skp
                		WHERE
                			YEAR(b.dari) = '" . $_POST["tahun"] . "' " . $whrbln . "
                		GROUP BY
                			a.id_skp
                	) rekap ON a.id_pegawai = rekap.id_pegawai
                WHERE
                	(a.id_status_kepegawaian = 1 OR a.id_status_kepegawaian = 4 OR a.id_status_kepegawaian = 3)
                    " . $whr . "
                GROUP BY
                	a.id_pegawai
                ORDER BY
                	f.kode_skpd, a.nama_pegawai";
     $res = mysql_query($sql);
     
?>

<?php
    $html = "";
    $html .= "<html>";
    $html .= "<head>";
    
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table width='100%' border='1px' cellspacing='0' cellpadding='5' style='border-collapse: collapse; font-family: sans-serif; font-size: 7pt;'>";
    $html .= "<thead>";
        $html .= "<tr>";
            $html .= "<th width='40px'>NO.</th>";
            $html .= "<th width='12%'>NAMA PEGAWAI</th>";
            $html .= "<th width='12%'>NIP</th>";
            $html .= "<th>SKPD</th>";
            $html .= "<th width='12%'>JABATAN</th>";
            $html .= "<th width='12%'>PANGKAT</th>";
            $html .= "<th width='40px'>HARI</th>";
            $html .= "<th width='40px'>HADIR</th>";
            $html .= "<th width='40px'>ALPA</th>";
            $html .= "<th width='40px'>SAKIT</th>";
            $html .= "<th width='40px'>IZIN</th>";
            $html .= "<th width='40px'>CUTI</th>";
            $html .= "<th width='40px'>TGS. LUAR</th>";
            $html .= "<th width='40px'>TGS. BELAJAR</th>";
        $html .= "</tr>";
    $html .= "</thead>";
    $html .= "<tbody>";
    $no = 0;
    while($ds = mysql_fetch_array($res)){
        $no++;
        $html .= "<tr>";
            $html .= "<td align='center'>" . $no . "</td>";
            $html .= "<td align='center'>" . strtoupper($ds["nama_pegawai"]) . "</td>";
            $html .= "<td align='center'>" . $ds["nip"] . "</td>";
            $html .= "<td align='center'>" . $ds["skpd"] . "</td>";
            $html .= "<td align='center'>" . $ds["jabatan"] . "</td>";
            $html .= "<td align='center'>" . $ds["pangkat"] . " (" . $ds["gol_ruang"] . ")</td>";
            $html .= "<td align='center'>" . $ds["hari"] . "</td>";
            $html .= "<td align='center'>" . $ds["hadir"] . "</td>";
            $html .= "<td align='center'>" . $ds["alpa"] . "</td>";
            $html .= "<td align='center'>" . $ds["sakit"] . "</td>";
            $html .= "<td align='center'>" . $ds["izin"] . "</td>";
            $html .= "<td align='center'>" . $ds["cuti"] . "</td>";
            $html .= "<td align='center'>" . $ds["tugas_luar"] . "</td>";
            $html .= "<td align='center'>" . $ds["tugas_belajar"] . "</td>";
        $html .= "</tr>";
    }
    $html .= "</tbody>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
?>
<?php
    //$dompdf = new DOMPDF();
    //$dompdf->load_html($html);
    //$dompdf->set_paper("a4", "landscape");
    //$dompdf->render();

    echo($html);
    //$dompdf->stream("laporan.pdf", array("Attachment" => false));
    mysql_close();
  exit(0);
?>