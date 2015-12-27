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
        <h3 style='text-transform: uppercase;'>DETAIL PENGADUAN, PESAN DAN SARAN</h3>
        <div class='bodypanel'>
        <table border='0px' cellspacing='0' cellpadding='5' width='100%' style='font-size: 9pt; font-family: serif;'>
    ";
    $whr = "";
            $res = mysql_query("SELECT  
         		                     a.id_pengaduan, a.pengaduan, b.jabatan AS disposisi_sekarang, a.tgl_pengaduan, a.tipe_disposisi  
                                 FROM  
                                	 tbl_pengaduan_pesan_saran a  
                                	 LEFT JOIN ref_jabatan b ON a.id_jabatan_tujuan = b.id_jabatan    
                                 WHERE  
                                	 a.id_pengaduan = '" . $_GET["id"] . "' ");
            $ctr = 0;
            while($ds = mysql_fetch_array($res)){
                $ctr++;
                $tipe_disposisi = "";
                switch($ds["tipe_disposisi"]){
                    case 1 :
                        $tipe_disposisi = "Pemrosesan";
                        break;
                    case 2 :
                        $tipe_disposisi = "Disposisi Hasil";
                        break;
                    case 3 :
                        $tipe_disposisi = "Selesai Diproses";
                        break;
                }
                $html .=
                "<tr>
                    <td width='200px' style='border-bottom: solid 0px #CCC; text-transform: uppercase; font-weight: bold'>Isi</td>
                    <td align='center' width='5px' style='border-bottom: solid 0px #CCC;'>:</td>
                    <td style='border-bottom: solid 1px #CCC; text-transform: capitalize; font-style: italic;'>$ds[pengaduan]</td>
                </tr>
                <tr>
                    <td width='200px' style='border-bottom: solid 0px #CCC; text-transform: uppercase; font-weight: bold'>Status</td>
                    <td align='center' width='5px' style='border-bottom: solid 0px #CCC;'>:</td>
                    <td style='border-bottom: solid 1px #CCC; text-transform: capitalize; font-style: italic;'>$tipe_disposisi</td>
                </tr>
                <tr>
                    <td width='200px' style='border-bottom: solid 0px #CCC; text-transform: uppercase; font-weight: bold'>Posisi Disposisi</td>
                    <td align='center' width='5px' style='border-bottom: solid 0px #CCC;'>:</td>
                    <td style='border-bottom: solid 1px #CCC; text-transform: capitalize; font-style: italic;'>$ds[disposisi_sekarang]</td>
                </tr>
                <tr>
                    <td width='200px' style='border-bottom: solid 0px #CCC; text-transform: uppercase; font-weight: bold'>Tanggal Laporan</td>
                    <td align='center' width='5px' style='border-bottom: solid 0px #CCC;'>:</td>
                    <td style='border-bottom: solid 1px #CCC; text-transform: capitalize; font-style: italic;'>$ds[tgl_pengaduan]</td>
                </tr>
                ";
            }
    $html .= 
    "</table>
    <br /><br />
    <h3>DAFTAR CATATAN PEMROSESAN</h3>
    <table border='1px' cellspacing='0' cellpadding='2' width='100%' style='font-size: 8pt;'>
        <thead>
            <tr class='headertable'>
                <th width='40px'>No.</th>
                <th width='150px'>Jabatan</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>";
        $res_det = mysql_query("SELECT
                                	b.jabatan, a.catatan
                                FROM
                                	tbl_catatan_pps a
                                	LEFT JOIN ref_jabatan b ON a.id_jabatan_pengirim = b.id_jabatan
                                WHERE
                                	a.id_pps = '" . $_GET["id"] . "'
                                ORDER BY
                                	a.id_catatan ASC");
        $ctr = 0;
        while($ds_det = mysql_fetch_array($res_det)){
            $ctr++;
            $html .= "
                <tr>
                <td align='center'>$ctr</td>
                <td>$ds_det[jabatan]</td>
                <td>$ds_det[catatan]</td>
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
      $dompdf->set_paper("a4", "portrait");
      $dompdf->render();
    
      $dompdf->stream("output.pdf", array("Attachment" => false));
    
      exit(0);
?>