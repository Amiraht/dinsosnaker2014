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
        <div class='bodypanel'>
        <table border='0px' cellspacing='0' cellpadding='5' width='100%' style='font-size: 9pt; font-family: serif;'>
    ";
    $whr = "";
            $res = mysql_query("SELECT
                                	a.*, c.unit_kerja, d.masalah, e.jenis_arsip
                                FROM
                                	tbl_benda_arsip a
                                	LEFT JOIN ref_unit_kerja c ON a.id_unit_kerja = c.id_unit_kerja
                                	LEFT JOIN ref_masalah d ON a.id_masalah  = d.id_masalah
                                	LEFT JOIN ref_jenis_arsip e ON a.id_jenis_arsip = e.id_jenis_arsip
                                WHERE
                                	a.id_arsip = '" . $_GET["id"] . "'
                                ORDER BY
                                	a.tahun");
            $ctr = 0;
            while($ds = mysql_fetch_array($res)){
                $ctr++;
                $html .=
                "
                <tr>
                    <td style='font-weight: bold; font-size: 25px; text-align: center; border-bottom: solid 2px #000000; padding: 5px 0px;'>
                        <img src='../../image/logo.png' width='100px'>
                    </td>
                    <td colspan='2' style='font-weight: bold; font-size: 25px; text-align: center; border-bottom: solid 2px #000000; padding: 5px 0px;'>
                        KANTOR ARSIP DAERAH KOTA MEDAN
                    </td>
                </tr>
                <tr>
                    <td colspan='3'>&nbsp;</td>
                </tr>
                <tr>
                    <td width='150px' style='border-bottom: solid 0px #CCC; text-transform: uppercase; font-weight: bold'>Tahun</td>
                    <td align='center' width='5px' style='border-bottom: solid 1px #000000;'>:</td>
                    <td style='border-bottom: solid 1px #000000; text-transform: capitalize; font-style: italic;'>$ds[tahun]</td>
                </tr>
                <tr>
                    <td width='150px' style='border-bottom: solid 0px #CCC; text-transform: uppercase; font-weight: bold'>Masalah</td>
                    <td align='center' width='5px' style='border-bottom: solid 1px #000000;'>:</td>
                    <td style='border-bottom: solid 1px #000000; text-transform: capitalize; font-style: italic;'>$ds[masalah]</td>
                </tr>
                <tr>
                    <td width='150px' style='border-bottom: solid 0px #CCC; text-transform: uppercase; font-weight: bold'>Sub Masalah</td>
                    <td align='center' width='5px' style='border-bottom: solid 1px #000000;'>:</td>
                    <td style='border-bottom: solid 1px #000000; text-transform: capitalize; font-style: italic;'>$ds[uraian]</td>
                </tr>
                <tr>
                    <td width='150px' style='border-bottom: solid 0px #CCC; text-transform: uppercase; font-weight: bold'>No. Bungkus</td>
                    <td align='center' width='5px' style='border-bottom: solid 1px #000000;'>:</td>
                    <td style='border-bottom: solid 1px #000000; text-transform: capitalize; font-style: italic;'>$ds[sampul]</td>
                </tr>
                <tr>
                    <td width='150px' style='border-bottom: solid 0px #CCC; text-transform: uppercase; font-weight: bold'>No. Kotak</td>
                    <td align='center' width='5px' style='border-bottom: solid 1px #000000;'>:</td>
                    <td style='border-bottom: solid 1px #000000; text-transform: capitalize; font-style: italic;'>$ds[box]</td>
                </tr>
                <tr>
                    <td width='150px' style='border-bottom: solid 0px #CCC; text-transform: uppercase; font-weight: bold'>Keterangan</td>
                    <td align='center' width='5px' style='border-bottom: solid 1px #000000;'>:</td>
                    <td style='border-bottom: solid 1px #000000; text-transform: capitalize; font-style: italic;'>$ds[keterangan]</td>
                </tr>
                ";
            }
    $html .= 
    "</table>
        </div>
    </div>";
      
?>

<?php
    $dompdf = new DOMPDF();
      $dompdf->load_html($html);
      $dompdf->set_paper("a4", "portrait");
      $dompdf->render();
    
      $dompdf->stream("output.pdf", array("Attachment" => false));
    
      exit(0);
?>