<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once("../../php/dompdf_config.inc.php"); ?>
<?php require_once("../../php/koneksi.php"); ?>
<?php require_once("../../php/fungsi.php"); ?>
<?php date_default_timezone_set("America/New_York"); ?>
<?php
    $sql_pengguna = "SELECT
                        	a.*, b.unit_kerja, b.kode_instansi, c.level, c.id_level
                        FROM
                        	tbl_anggota_arsip a
                        	LEFT JOIN ref_unit_kerja b ON a.id_unit_kerja = b.id_unit_kerja
                            LEFT JOIN ref_level_pengguna c ON a.id_level_pengguna = c.id_level
                        WHERE
                        	a.id_anggota='" .$_SESSION["id_pengguna"] . "'";
    $res_pengguna = mysql_query($sql_pengguna);
    $ds_pengguna = mysql_fetch_array($res_pengguna);
    $html = "";
    $html .= 
    "
    <head>
        
    </head>
    <div class='panelcontainer' style='width: 100%;'>
        <div class='bodypanel'>
        <table border='0px' cellspacing='0' cellpadding='2' width='100%' style='font-size: 9pt; font-family: serif;'>
    ";
                $html .=
                "
                <tr>
                    <td style='text-align: center; border-bottom: solid 2px #000000; padding: 5px 0px;'>
                        <img src='../../image/logo.png' width='100px'>
                    </td>
                    <td colspan='2' style='font-weight: bold; font-size: 25px; text-align: left; border-bottom: solid 2px #000000; padding: 5px 0px;'>
                        KANTOR ARSIP DAERAH KOTA MEDAN
                    </td>
                </tr>
                <tr>
                    <td colspan='3'>&nbsp;</td>
                </tr>
                <tr>
                    <td width='150px' style='border-bottom: solid 0px #CCC; text-transform: uppercase; font-weight: bold'>No. Kotak</td>
                    <td align='center' width='5px' style='border-bottom: solid 1px #000000;'>:</td>
                    <td style='border-bottom: solid 1px #000000; text-transform: capitalize; font-style: italic;'>$_POST[box]</td>
                </tr>
                <tr>
                    <td width='150px' style='border-bottom: solid 0px #CCC; text-transform: uppercase; font-weight: bold'>Masalah</td>
                    <td align='center' width='5px' style='border-bottom: solid 1px #000000;'>:</td>
                    <td style='border-bottom: solid 1px #000000; text-transform: capitalize; font-style: italic;'>$_POST[id_masalah]</td>
                </tr>
                <tr>
                    <td width='150px' style='border-bottom: solid 0px #CCC; text-transform: uppercase; font-weight: bold'>Tahun</td>
                    <td align='center' width='5px' style='border-bottom: solid 1px #000000;'>:</td>
                    <td style='border-bottom: solid 1px #000000; text-transform: capitalize; font-style: italic;'>$_POST[tahun]</td>
                </tr>
                <tr>
                    <td width='150px' style='border-bottom: solid 0px #CCC; text-transform: uppercase; font-weight: bold'>No. Bungkus</td>
                    <td align='center' width='5px' style='border-bottom: solid 1px #000000;'>:</td>
                    <td style='border-bottom: solid 1px #000000; text-transform: capitalize; font-style: italic;'>$_POST[sampul]</td>
                </tr>
                <tr>
                    <td width='150px' style='border-bottom: solid 0px #CCC; text-transform: uppercase; font-weight: bold'>KIN</td>
                    <td align='center' width='5px' style='border-bottom: solid 1px #000000;'>:</td>
                    <td style='border-bottom: solid 1px #000000; text-transform: capitalize; font-style: italic;'>($ds_pengguna[kode_instansi]) $ds_pengguna[unit_kerja]</td>
                </tr>
                ";
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