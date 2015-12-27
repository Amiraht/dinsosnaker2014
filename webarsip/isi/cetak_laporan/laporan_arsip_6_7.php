<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once("../../php/dompdf_config.inc.php"); ?>
<?php require_once("../../php/koneksi.php"); ?>
<?php require_once("../../php/fungsi.php"); ?>
<?php date_default_timezone_set("America/New_York"); ?>
<?php
    $judul = "";
    switch($_GET["tipe_pps"]){
        case 1 :
            $judul = "REKAPITULASI PENGADUAN YANG PERNAH DIBUAT";
            $nama = "Pengaduan";
            break;
        case 2 :
            $judul = "REKAPITULASI PESAN DAN SARAN YANG PERNAH DIBUAT";
            $nama = "Pesan Dan Saran";
            break;
    }
    $html = "";
    $html .= 
    "
    <head>
        
    </head>
    <div class='panelcontainer' style='width: 100%;'>
        <h3 style='text-transform: uppercase;'>" . $judul . "</h3>
        <div class='bodypanel'>
        <table border='1px' cellspacing='0' cellpadding='2' width='100%' style='font-size: 8pt;'>
            <thead>
                <tr class='headertable' style='text-transform: uppercase;'>
                    <th width='40px' style='padding: 5px;'>No.</th>
                    <th>Isi</th>
                    <th width='120px'>Status</th>
                    <th width='250px'>Posisi Disposisi</th>
                    <th width='100px'>Tanggal Laporan</th>
                </tr>
            </thead>
    ";
    $html .= "<tbody>";
    $whr = "";
            /* KAKAN ONLY */
			$whr_kakan = "1";
			if($_SESSION["id_unit_kerja"] != 0){
				$whr_kakan = "a.id_anggota = " . $_SESSION["id_pengguna"] . "";
			}
			/* ********** */
            $res = mysql_query(" SELECT  
         		                     a.id_pengaduan, a.pengaduan, b.jabatan AS disposisi_sekarang, a.tgl_pengaduan, a.tipe_disposisi  
                                 FROM  
                                	 tbl_pengaduan_pesan_saran a  
                                	 LEFT JOIN ref_jabatan b ON a.id_jabatan_tujuan = b.id_jabatan  
                                 WHERE  
                                	 " . $whr_kakan . " AND a.tipe_pps = '" . $_GET["tipe_pps"] . "'  
                                 ORDER BY  
                                	 a.id_pengaduan ASC ");
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
                $tipe = "";
                switch($ds["tipe_disposisi"]){
                    case 1 :
                        $tipe = "Pemrosesan";
                        break;
                    case 2 :
                        $tipe = "Disposisi Hasil";
                        break;
                    case 3 :
                        $tipe = "Selesai Diproses";
                        break;
                }
                $ctr++;
                $html .=
                "<tr style='text-transform: capitalize;'>
                    <td align='center'>$ctr</td>
                    <td align='center'>$ds[pengaduan]</td>
                    <td align='center'>$tipe</td>
                    <td align='center'>$ds[disposisi_sekarang]</td>
                    <td align='center'>$ds[tgl_pengaduan]</td>
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