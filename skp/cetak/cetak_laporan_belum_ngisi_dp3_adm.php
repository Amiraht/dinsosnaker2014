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
     if($_POST["id_pangkat"] != "all")
        $whr .= " AND g.id_pangkat = '" . $_POST["id_pangkat"] . "' ";
     $sql = "SELECT
                	a.id_pegawai, a.nama_pegawai, a.nip, a.gelar_depan, a.gelar_belakang,
                	b.status_kepegawaian,
                	e.jenis_kelamin, a.alamat, a.tanggal_lahir, f.skpd, g.pangkat, g.gol_ruang, h.jabatan
                FROM
                	tbl_pegawai a
                	LEFT JOIN ref_status_kepegawaian b ON a.id_status_kepegawaian = b.id_status_kepegawaian
                	LEFT JOIN ref_jenis_kelamin e ON a.id_jenis_kelamin = e.id_jenis_kelamin
                	LEFT JOIN ref_skpd f ON a.id_satuan_organisasi = f.id_skpd
                	LEFT JOIN ref_pangkat g ON a.id_pangkat = g.id_pangkat
                    LEFT JOIN ref_jabatan h ON a.id_jabatan = h.id_jabatan
                    LEFT JOIN tbl_skp_perilaku i ON (a.id_pegawai = i.id_pegawai AND YEAR(i.dari) = " . $_POST["tahun"] . " AND i.orientasi_pelayanan IS NOT NULL)
                WHERE
                	(a.id_status_kepegawaian = 1 OR a.id_status_kepegawaian = 4 OR a.id_status_kepegawaian = 3)
                    AND i.id_pegawai IS NULL
                    " . $whr . "
                GROUP BY
	                a.id_pegawai
                ORDER BY
                	a.id_satuan_organisasi, a.nama_pegawai";
     $res = mysql_query($sql);
     
?>

<?php
    $html = "";
    $html .= "<html>";
    $html .= "<head>";
    
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table width='100%' border='1px' cellspacing='0' cellpadding='5' style='border-collapse: collapse; font-family: sans-serif; font-size: 9pt;'>";
    $html .= "<thead>";
        $html .= "<tr>";
            $html .= "<th width='40px'>NO.</th>";
            $html .= "<th width='17%'>NAMA PEGAWAI</th>";
            $html .= "<th width='17%'>NIP</th>";
            $html .= "<th width='17%'>JENIS KELAMIN</th>";
            $html .= "<th>SKPD</th>";
            $html .= "<th width='17%'>JABATAN</th>";
            $html .= "<th width='17%'>PANGKAT</th>";
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
            $html .= "<td align='center'>" . $ds["jenis_kelamin"] . "</td>";
            $html .= "<td align='center'>" . $ds["skpd"] . "</td>";
            $html .= "<td align='center'>" . $ds["jabatan"] . "</td>";
            $html .= "<td align='center'>" . $ds["pangkat"] . " (" . $ds["gol_ruang"] . ")</td>";
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