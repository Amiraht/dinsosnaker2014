<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once("../php/dompdf_config.inc.php"); ?>
<?php require_once("../php/koneksi.php"); ?>
<?php require_once("../php/fungsi.php"); ?>
<?php date_default_timezone_set("America/New_York"); ?>

<?php
    $html = "";
    $html .= "<html>";
    $html .= "<head>";
    
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<h3 style='text-align: center;'>REKAP KEGIATAN VERIFIKASI UPLOAD PER TANGGAL " . tglindonesia($_POST["dari"]) . " SAMPAI " . tglindonesia($_POST["sampai"]) . "</h3>";
    $html .= "<table width='100%' border='1px' cellspacing='0' cellpadding='5' style='border-collapse: collapse; font-family: sans-serif; font-size: 9pt;'>";
    $html .= "<thead>";
        $html .= "<tr>";
            $html .= "<th width='40px'>NO.</th>";
            $html .= "<th>NAMA PENGGUNA</th>";
            $html .= "<th width='20%'>TOTAL</th>";
        $html .= "</tr>";
    $html .= "</thead>";
    $html .= "<tbody>";
    $no = 0;
    $sql = "SELECT
            	a.nama, a.id_user,
            	CASE
            		WHEN rekap.jumlah IS NOT NULL THEN rekap.jumlah
            		ELSE 0
            	END AS jumlah
            FROM
            	tbl_pengguna a
            	LEFT JOIN (
            		SELECT
            			id_pemeriksa, COUNT(*) AS jumlah
            		FROM
            			tbl_skp_dp3_upload_pemeriksaan
            		WHERE
            			tgl_periksa BETWEEN '" . $_POST["dari"] . " 00:00:00' AND '" . $_POST["sampai"] . " 23:59:59'
            		GROUP BY
            			id_pemeriksa
            	) rekap ON a.id_user = rekap.id_pemeriksa
            WHERE
            	a.modul = 12 OR a.modul = 14";
    $res = mysql_query($sql);
    while($ds = mysql_fetch_array($res)){
        $no++;
        $html .= "<tr>";
            $html .= "<td align='center'>" . $no . "</td>";
            $html .= "<td align='left'>" . strtoupper($ds["nama"]) . "</td>";
            $html .= "<td align='center'>" . $ds["jumlah"] . "</td>";
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