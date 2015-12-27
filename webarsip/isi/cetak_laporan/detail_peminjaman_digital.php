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
        <h3 style='text-transform: uppercase;'>DETAIL PEMINJAMAN DIGITAL</h3>
        <div class='bodypanel'>
        <table border='0px' cellspacing='0' cellpadding='5' width='100%' style='font-size: 9pt; font-family: serif;'>
    ";
    $whr = "";
            $res = mysql_query("SELECT
                                	a.*,
                                	(SELECT COUNT(*) FROM tbl_arsip_yang_dipinjam WHERE id_peminjaman = a.id_peminjaman) AS jml_dokumen
                                FROM
                                	tbl_peminjaman_arsip a
                                WHERE
                                	a.id_peminjaman = '" . $_GET["id"] . "'");
            $ctr = 0;
            while($ds = mysql_fetch_array($res)){
                $ctr++;
                $html .=
                "<tr>
                    <td width='200px' style='border-bottom: solid 0px #CCC; text-transform: uppercase; font-weight: bold'>Tanggal Peminjaman</td>
                    <td align='center' width='5px' style='border-bottom: solid 0px #CCC;'>:</td>
                    <td style='border-bottom: solid 1px #CCC; text-transform: capitalize; font-style: italic;'>$ds[tgl_peminjaman]</td>
                </tr>
                <tr>
                    <td width='200px' style='border-bottom: solid 0px #CCC; text-transform: uppercase; font-weight: bold'>Jumlah Dokumen</td>
                    <td align='center' width='5px' style='border-bottom: solid 0px #CCC;'>:</td>
                    <td style='border-bottom: solid 1px #CCC; text-transform: capitalize; font-style: italic;'>$ds[jml_dokumen] Berkas</td>
                </tr>
                ";
            }
    $html .= 
    "</table>
    <br /><br />
    <h3>BERKAS ARSIP YANG DIPINJAM</h3>
    <table border='1px' cellspacing='0' cellpadding='2' width='100%' style='font-size: 8pt;'>
        <thead>
            <tr class='headertable'>
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
        <tbody>";
        $res_det = mysql_query("SELECT
                                	a.*, c.unit_kerja, d.masalah, e.jenis_arsip
                                FROM
                                	tbl_benda_arsip a
                                	LEFT JOIN ref_unit_kerja c ON a.id_unit_kerja = c.id_unit_kerja
                                	LEFT JOIN ref_masalah d ON a.id_masalah  = d.id_masalah
                                	LEFT JOIN ref_jenis_arsip e ON a.id_jenis_arsip = e.id_jenis_arsip
                                    LEFT JOIN tbl_arsip_yang_dipinjam h ON a.id_arsip = h.id_arsip  
                                WHERE
                                	1 AND h.id_peminjaman='" . $_GET["id"] . "'
                                ORDER BY
                                	a.tahun");
        $ctr = 0;
        while($ds_det = mysql_fetch_array($res_det)){
            $ctr++;
            $html .= "
                <tr>
                <td align='center'>$ctr</td>
                <td>$ds_det[kode_klasifikasi]</td>
                <td>$ds_det[indeks]</td>
                <td>$ds_det[masalah]</td>
                <td>$ds_det[uraian]</td>
                <td align='center'>$ds_det[tahun]</td>
                <td align='center'>$ds_det[sampul]</td>
                <td align='center'>$ds_det[box]</td>
                <td align='center'>$ds_det[rak]</td>
                <td>$ds_det[jenis_arsip]</td>
                <td>$ds_det[keterangan]</td>
            </tr>
            ";
        }
    $html .= "</tbody>
            </table>
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