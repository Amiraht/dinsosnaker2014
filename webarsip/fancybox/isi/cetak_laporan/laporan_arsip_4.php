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
        <h3 style='text-transform: uppercase;'>Rekapitulasi Peminjaman Digital Yang Pernah Dilakukan</h3>
        <div class='bodypanel'>
        <table border='1px' cellspacing='0' cellpadding='2' width='100%' style='font-size: 8pt;'>
            <thead>
            <tr class='headertable' style='text-transform: uppercase;'>
            <th width='40px' style='padding: 10px;'>No.</th>
            <th  style='padding: 10px;'>Tanggal Peminjaman</th>
            <th width='250px'  style='padding: 10px;'>Jumlah Dokumen</th>
            </tr>
            </thead>
    ";
    $html .= "<tbody>";
    $whr = "";
            
            $res = mysql_query("SELECT
                                	a.*,
                                	(SELECT COUNT(*) FROM tbl_arsip_yang_dipinjam WHERE id_peminjaman = a.id_peminjaman) AS jml_dokumen
                                FROM
                                	tbl_peminjaman_arsip a
                                WHERE
                                	a.id_anggota = " . $_SESSION["id_pengguna"] . " AND a.id_jenis_peminjaman = 3");
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
                    <td align='center'>$ds[tgl_peminjaman]</td>
                    <td align='center'>$ds[jml_dokumen] Dokumen</td>
                </tr>";
            }
    $html .= "</tbody>";
    $html .= 
    "</table>
        </div>
    </div>";
      
?>

<?php
    $dompdf = new DOMPDF();
      $dompdf->load_html($html);
      $dompdf->set_paper("a4", "landscape");
      $dompdf->render();
    
      $dompdf->stream("output.pdf", array("Attachment" => false));
    
      exit(0);
?>