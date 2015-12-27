<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once("../../php/dompdf_config.inc.php"); ?>
<?php require_once("../../php/koneksi.php"); ?>
<?php require_once("../../php/fungsi.php"); ?>
<?php date_default_timezone_set("America/New_York"); ?>
<?php
    $html = "";
    $html .= 
    "
    <head>
        
    </head>
    <div class='panelcontainer' style='width: 100%;'>
        <h3 style='text-transform: uppercase; text-align: center'>Rekapitulasi Daftar Pengumpulan Arsip (DPA)</h3>
        <div class='bodypanel'>
        <table border='1px' cellspacing='0' cellpadding='2' width='100%' style='font-size: 8pt;'>
            <thead>
            <tr class='headertable' style='text-transform: uppercase;'>
            <th width='40px'>No.</th>
            <th width='100px'>Kode Klasifikasi</th>
            <th width='70px'>Indeks</th>
            <th width='100px'>Masalah</th>
            <th>Uraian Masalah</th>
            <th width='70px'>Tahun</th>
            <th width='50px'>Sampul</th>
            <th width='50px'>Boks</th>
            <th width='50px'>Rak</th>
            <th width='100px'>Jenis Arsip</th>
            <th width='100px'>Keterangan</th>
            </tr>
            </thead>
    ";
    $html .= "<tbody>";
    $whr = "";
            if($_POST["id_masalah"] <> "" && $_POST["id_masalah"] <> "0"){
                $whr .= " AND a.id_masalah = '" . $_POST["id_masalah"] . "' "; 
            }
            if($_POST["keterangan"] <> "" && $_POST["keterangan"] <> "0"){
                $whr .= "  AND a.keterangan = '" . $_POST["keterangan"] . "' ";
            }
            if($_POST["id_jenis_arsip"] <> "" && $_POST["id_jenis_arsip"] <> "0"){
                $whr .= "  AND a.id_jenis_arsip = '" . $_POST["id_jenis_arsip"] . "'";
            }
            if($_POST["tahun"] <> ""){
                $whr .= " AND a.tahun='" . $_POST["tahun"] . "'"; 
            }
            if($_POST["dari"] != "" && $_POST["sampai"] != ""){
                $whr .= " AND a.tgl_input BETWEEN '" . $_POST["dari"] . "' AND '" . $_POST["sampai"] . "'";
            }
            
            /* KAKAN ONLY */
			$whr_kakan = "";
			if($_SESSION["id_unit_kerja"] != 0){
				$whr_kakan = "AND a.id_unit_kerja = '" . $_SESSION["id_unit_kerja"] . "'";
			}
			/* ********** */
			
            $res = mysql_query("SELECT
                                	a.*, c.unit_kerja, d.masalah, e.jenis_arsip
                                FROM
                                	tbl_benda_arsip a
                                	LEFT JOIN ref_unit_kerja c ON a.id_unit_kerja = c.id_unit_kerja
                                	LEFT JOIN ref_masalah d ON a.id_masalah  = d.id_masalah
                                	LEFT JOIN ref_jenis_arsip e ON a.id_jenis_arsip = e.id_jenis_arsip
                                WHERE
                                	a.id_jenis_arsip='1' " . $whr_kakan . " " . $whr . "
                                ORDER BY
                                	a.tahun");
            /*echo("SELECT
                                	a.*, c.unit_kerja, d.masalah, e.jenis_arsip
                                FROM
                                	tbl_benda_arsip a
                                	LEFT JOIN ref_unit_kerja c ON a.id_unit_kerja = c.id_unit_kerja
                                	LEFT JOIN ref_masalah d ON a.id_masalah  = d.id_masalah
                                	LEFT JOIN ref_jenis_arsip e ON a.id_jenis_arsip = e.id_jenis_arsip
                                WHERE
                                	a.id_unit_kerja = '" . $_SESSION["id_unit_kerja"] . "' " . $whr . "
                                ORDER BY
                                	a.tahun");*/
            $ctr = 0;
            while($ds = mysql_fetch_array($res)){
                $ctr++;
                $html .=
                "<tr style='text-transform: capitalize;'>
                    <td align='center'>$ctr</td>
                    <td>$ds[kode_klasifikasi]</td>
                    <td>$ds[indeks]</td>
                    <td>$ds[masalah]</td>
                    <td>$ds[uraian]</td>
                    <td align='center'>$ds[tahun]</td>
                    <td align='center'>$ds[sampul]</td>
                    <td align='center'>$ds[box]</td>
                    <td align='center'>$ds[rak]</td>
                    <td>$ds[jenis_arsip]</td>
                    <td>$ds[keterangan]</td>
                </tr>";
            }
    $html .= "</tbody>";
    $html .= 
    "</table>
        </div>
    </div>";
      
?>

<?php
    
    /*
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->set_paper("a4", "landscape");
    $dompdf->render();
    
    $dompdf->stream("output.pdf", array("Attachment" => false));
    */
    
    echo $html;
    exit(0);
?>