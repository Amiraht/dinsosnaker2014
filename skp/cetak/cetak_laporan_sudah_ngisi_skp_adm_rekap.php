<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once("../php/dompdf_config.inc.php"); ?>
<?php require_once("../php/koneksi.php"); ?>
<?php require_once("../php/fungsi.php"); ?>
<?php date_default_timezone_set("America/New_York"); ?>

<?php
    $whr = "";
     if($_POST["kode_skpd"] != "all")
        $whr .= " AND hasil.kode_skpd LIKE '" . $_POST["kode_skpd"] . "%' ";
     $sql = "SELECT
            	hasil.skpd, hasil.kode_skpd, SUM(hasil.belum_isi) AS belum_isi, SUM(hasil.sudah_isi) AS sudah_isi, SUM(hasil.belum_supervisi) AS belum_supervisi,
            	SUM(hasil.sudah_supervisi) AS sudah_supervisi
            FROM
            	(
            		SELECT
            			a.id_pegawai, c.skpd, c.kode_skpd, a.id_satuan_organisasi, a.nama_pegawai, a.nip,
                        CASE
            				WHEN b.id_pegawai IS NULL THEN 1
            				ELSE 0
            			END AS belum_isi,
            			CASE
            				WHEN b.id_pegawai IS NULL THEN 0
            				ELSE 1
            			END AS sudah_isi,
            			CASE
            				WHEN b.status_supervisi <> 3 THEN 1
            				ELSE 0
            			END AS belum_supervisi,
            			CASE
            				WHEN b.status_supervisi = 3 THEN 1
            				ELSE 0
            			END AS sudah_supervisi
            		FROM
            			tbl_pegawai a
            			LEFT JOIN tbl_skp b ON (a.id_pegawai = b.id_pegawai AND YEAR(b.dari) = '" . $_POST["tahun"] . "')
            			LEFT JOIN ref_skpd c ON a.id_satuan_organisasi = c.id_skpd
            		GROUP BY
            			a.id_pegawai
            	) hasil
            WHERE
            	1 " . $whr . "
            GROUP BY
            	hasil.id_satuan_organisasi
            ORDER BY
            	hasil.kode_skpd";
     $res = mysql_query($sql);
     $jlh_all = mysql_num_rows($res);
     
     // MENCARI NAMA SKPD
     $nama_skpd = "SEMUA SKPD";
     if($_POST["kode_skpd"] != "all"){
        $ds_nama_skpd = mysql_fetch_array(mysql_query("SELECT * FROM ref_skpd WHERE kode_skpd='" . $_POST["kode_skpd"] . "'"));
        $nama_skpd = $ds_nama_skpd["skpd"];
     }
?>

<?php
    $html = "";
    $html .= "<html>";
    $html .= "<head>";
    
    $html .= "</head>";
    $html .= "<body>";
    
    if($_POST["kode_skpd"] != "all"){
        $total_belum_ngisi = 0 ;
        $total_sudah_ngisi = 0;
        $total_belum_spv = 0;
        $total_sudah_spv = 0;
        $no = 0;
        while($ds = mysql_fetch_array($res)){
            $no++;
            $total_belum_ngisi += $ds["belum_isi"];
            $total_sudah_ngisi += $ds["sudah_isi"];
            $total_belum_spv += $ds["belum_supervisi"];
            $total_sudah_spv += $ds["sudah_supervisi"];
            if(($no - 1) % 30 == 0){
                $html .= "<h3 style='text-align: center;'>REKAPITULASI PENGISIAN SKP " . strtoupper($nama_skpd . " TAHUN " . $_POST["tahun"]) . "</h3>";
                $html .= "<table width='100%' border='1px' cellspacing='0' cellpadding='5' style='border-collapse: collapse; font-family: sans-serif; font-size: 9pt; page-break-after: always'>";
                    $html .= "<tr>";
                        $html .= "<th width='40px'>NO.</th>";
                        $html .= "<th>NAMA SKPD</th>";
                        $html .= "<th width='10%'>BELUM MENGISI</th>";
                        $html .= "<th width='10%'>TELAH MENGISI</th>";
                        $html .= "<th width='10%'>TELAH MENGISI<BR/>BELUM DI SUPERVISI</th>";
                        $html .= "<th width='10%'>TELAH MENGISI<BR/>TELAH DI SUPERVISI</th>";
                    $html .= "</tr>";
                    $html .= "<tr>";
                        $html .= "<td align='center'>" . $no . "</td>";
                        $html .= "<td align='left'>" . strtoupper($ds["skpd"]) . "</td>";
                        $html .= "<td align='center'>" . $ds["belum_isi"] . "</td>";
                        $html .= "<td align='center'>" . $ds["sudah_isi"] . "</td>";
                        $html .= "<td align='center'>" . $ds["belum_supervisi"] . "</td>";
                        $html .= "<td align='center'>" . $ds["sudah_supervisi"] . "</td>";
                    $html .= "</tr>";
            }else if(($no - 1) % 30 == 29 || $no == $jlh_all){
                $html .= "<tr>";
                        $html .= "<td align='center'>" . $no . "</td>";
                        $html .= "<td align='left'>" . strtoupper($ds["skpd"]) . "</td>";
                        $html .= "<td align='center'>" . $ds["belum_isi"] . "</td>";
                        $html .= "<td align='center'>" . $ds["sudah_isi"] . "</td>";
                        $html .= "<td align='center'>" . $ds["belum_supervisi"] . "</td>";
                        $html .= "<td align='center'>" . $ds["sudah_supervisi"] . "</td>";
                    $html .= "</tr>";
                    if($no == $jlh_all){
                        $html .= "<tr>";
                            $html .= "<th colspan='2'><b>TOTAL REKAPITULASI</b></th>";
                            $html .= "<th width='10%'><b>" . $total_belum_ngisi . "</b></th>";
                            $html .= "<th width='10%'><b>" . $total_sudah_ngisi . "</b></th>";
                            $html .= "<th width='10%'><b>" . $total_belum_spv . "</b></th>";
                            $html .= "<th width='10%'><b>" . $total_sudah_spv . "</b></th>";
                        $html .= "</tr>";
                    }
                $html .= "</table>";
            }else{
                $html .= "<tr>";
                        $html .= "<td align='center'>" . $no . "</td>";
                        $html .= "<td align='left'>" . strtoupper($ds["skpd"]) . "</td>";
                        $html .= "<td align='center'>" . $ds["belum_isi"] . "</td>";
                        $html .= "<td align='center'>" . $ds["sudah_isi"] . "</td>";
                        $html .= "<td align='center'>" . $ds["belum_supervisi"] . "</td>";
                        $html .= "<td align='center'>" . $ds["sudah_supervisi"] . "</td>";
                    $html .= "</tr>";
            }
        }
    }else{
        $ds_jumlah_skpd_suhu = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS jumlah FROM ref_skpd WHERE LENGTH(kode_skpd) = 3 ORDER BY skpd"));
        $jumlah_skpd_suhu = $ds_jumlah_skpd_suhu["jumlah"];
        $sql_skpd_suhu = "SELECT * FROM ref_skpd WHERE LENGTH(kode_skpd) = 3 ORDER BY skpd";
        $res_skpd_suhu = mysql_query($sql_skpd_suhu);
        $no = 0;
        $total_belum_ngisi = 0;
        $total_sudah_ngisi = 0;
        $total_belum_spv = 0;
        $total_sudah_spv = 0;
        while($ds_skpd_suhu = mysql_fetch_array($res_skpd_suhu)){
            $kode_skpd = $ds_skpd_suhu["kode_skpd"];
            $ds_rekap_skp = mysql_fetch_array(mysql_query("SELECT
                                                            	hasil.skpd, hasil.kode_skpd, SUM(hasil.belum_isi) AS belum_isi, SUM(hasil.sudah_isi) AS sudah_isi, SUM(hasil.belum_supervisi) AS belum_supervisi,
                                                            	SUM(hasil.sudah_supervisi) AS sudah_supervisi
                                                            FROM
                                                            	(
                                                            		SELECT
                                                            			a.id_pegawai, c.skpd, c.kode_skpd, a.id_satuan_organisasi, a.nama_pegawai, a.nip,
                                                                        CASE
                                                            				WHEN b.id_pegawai IS NULL THEN 1
                                                            				ELSE 0
                                                            			END AS belum_isi,
                                                            			CASE
                                                            				WHEN b.id_pegawai IS NULL THEN 0
                                                            				ELSE 1
                                                            			END AS sudah_isi,
                                                            			CASE
                                                            				WHEN b.status_supervisi <> 3 THEN 1
                                                            				ELSE 0
                                                            			END AS belum_supervisi,
                                                            			CASE
                                                            				WHEN b.status_supervisi = 3 THEN 1
                                                            				ELSE 0
                                                            			END AS sudah_supervisi
                                                            		FROM
                                                            			tbl_pegawai a
                                                            			LEFT JOIN tbl_skp b ON (a.id_pegawai = b.id_pegawai AND YEAR(b.dari) = '" . $_POST["tahun"] . "')
                                                            			LEFT JOIN ref_skpd c ON a.id_satuan_organisasi = c.id_skpd
                                                            		GROUP BY
                                                            			a.id_pegawai
                                                            	) hasil
                                                            WHERE
                                                            	hasil.kode_skpd LIKE '" . $kode_skpd . "%'"));
            $total_belum_ngisi += $ds_rekap_skp["belum_isi"];
            $total_sudah_ngisi += $ds_rekap_skp["sudah_isi"];
            $total_belum_spv += $ds_rekap_skp["belum_supervisi"];
            $total_sudah_spv += $ds_rekap_skp["sudah_supervisi"];
            $no++;
            if(($no - 1) % 30 == 0){
                $html .= "<h3 style='text-align: center;'>REKAPITULASI PENGISIAN SKP " . strtoupper($nama_skpd . " TAHUN " . $_POST["tahun"]) . "</h3>";
                $html .= "<table width='100%' border='1px' cellspacing='0' cellpadding='5' style='border-collapse: collapse; font-family: sans-serif; font-size: 9pt; page-break-after: always'>";
                    $html .= "<tr>";
                        $html .= "<th width='40px'>NO.</th>";
                        $html .= "<th>NAMA SKPD</th>";
                        $html .= "<th width='10%'>BELUM MENGISI</th>";
                        $html .= "<th width='10%'>TELAH MENGISI</th>";
                        $html .= "<th width='10%'>TELAH MENGISI<BR/>BELUM DI SUPERVISI</th>";
                        $html .= "<th width='10%'>TELAH MENGISI<BR/>TELAH DI SUPERVISI</th>";
                    $html .= "</tr>";
                    $html .= "<tr>";
                        $html .= "<td align='center'>" . $no . "</td>";
                        $html .= "<td align='left'>" . strtoupper($ds_skpd_suhu["skpd"]) . "</td>";
                        $html .= "<td align='center'>" . $ds_rekap_skp["belum_isi"] . "</td>";
                        $html .= "<td align='center'>" . $ds_rekap_skp["sudah_isi"] . "</td>";
                        $html .= "<td align='center'>" . $ds_rekap_skp["belum_supervisi"] . "</td>";
                        $html .= "<td align='center'>" . $ds_rekap_skp["sudah_supervisi"] . "</td>";
                    $html .= "</tr>";
            }else if(($no - 1) % 30 == 29 || $no == $jumlah_skpd_suhu){
                $html .= "<tr>";
                        $html .= "<td align='center'>" . $no . "</td>";
                        $html .= "<td align='left'>" . strtoupper($ds_skpd_suhu["skpd"]) . "</td>";
                        $html .= "<td align='center'>" . $ds_rekap_skp["belum_isi"] . "</td>";
                        $html .= "<td align='center'>" . $ds_rekap_skp["sudah_isi"] . "</td>";
                        $html .= "<td align='center'>" . $ds_rekap_skp["belum_supervisi"] . "</td>";
                        $html .= "<td align='center'>" . $ds_rekap_skp["sudah_supervisi"] . "</td>";
                    $html .= "</tr>";
                    if($no == $jumlah_skpd_suhu){
                        $html .= "<tr>";
                            $html .= "<th colspan='2'><b>TOTAL REKAPITULASI</b></th>";
                            $html .= "<th width='10%'><b>" . $total_belum_ngisi . "</b></th>";
                            $html .= "<th width='10%'><b>" . $total_sudah_ngisi . "</b></th>";
                            $html .= "<th width='10%'><b>" . $total_belum_spv . "</b></th>";
                            $html .= "<th width='10%'><b>" . $total_sudah_spv . "</b></th>";
                        $html .= "</tr>";
                    }
                $html .= "</table>";
            }else{
                $html .= "<tr>";
                        $html .= "<td align='center'>" . $no . "</td>";
                        $html .= "<td align='left'>" . strtoupper($ds_skpd_suhu["skpd"]) . "</td>";
                        $html .= "<td align='center'>" . $ds_rekap_skp["belum_isi"] . "</td>";
                        $html .= "<td align='center'>" . $ds_rekap_skp["sudah_isi"] . "</td>";
                        $html .= "<td align='center'>" . $ds_rekap_skp["belum_supervisi"] . "</td>";
                        $html .= "<td align='center'>" . $ds_rekap_skp["sudah_supervisi"] . "</td>";
                    $html .= "</tr>";
            }
        }
    }
    
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