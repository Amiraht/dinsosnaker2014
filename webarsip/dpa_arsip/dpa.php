<?php
    error_reporting(0);
    include("config/connection.php");
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Cetak Daftar Pertelaan Arsip</title>
        <style type="text/css">
            .kertas {
                width: 90%;
                margin-right: auto;
                font-family: arial;
                font-size: 70%;
            }
            .col_title th{
                border: solid 1px gray;
                background-color: #CCC;
                color: white;
                padding: 5px;
            }
            .col_fill td {
                padding: 3px;
                border: solid 1px gray;
            }
        </style>
    </head>
    <body>
        <div class="kertas">
            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse: collapse;">
                <tr>
                    <th style="font-size: 150%; padding: 5px;" colspan="10"><?php echo $_GET["judul"]; ?></th>
                </tr>
                <tr>
                    <?php
                        $ds_instansi = mysql_fetch_array(
                            mysql_query("
                                SELECT * FROM ref_unit_kerja WHERE id_unit_kerja='" . $_GET["unit_pencipta"] . "'
                            ")
                        );
                    ?>
                    <th style="text-align: left; padding: 2px;" colspan="10">INSTANSI : <?php echo strtoupper($ds_instansi["unit_kerja"]); ?></th>
                </tr>
                <tr>
                    <?php
                        $ds_masalah = mysql_fetch_array(
                            mysql_query("
                                SELECT * FROM ref_masalah WHERE id_masalah='" . $_GET["masalah"] . "'
                            ")
                        );
                    ?>
                    <th style="text-align: left; padding: 2px;" colspan="10">MASALAH : <?php echo strtoupper($ds_masalah["masalah"] . " (" . $ds_masalah["kode_masalah"] . ")"); ?></th>
                </tr>
            </table>
            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse: collapse;">
                <thead>
                    <tr class="col_title">
                        <th width="2%">NO.</th>
                        <th width="5%">KODE KLASIFIKASI</th>
                        <th width="5%">INDEKS</th>
                        <th>URAIAN MASALAH</th>
                        <th width="10%">TAHUN</th>
                        <th width="15%">UNIT KERJA PENCIPTA</th>
                        <th width="5%">SAMPUL</th>
                        <th width="5%">KOTAK</th>
                        <th width="5%">RAK</th>
                        <th width="15%">KONDISI</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $limit = "";
                    $awal = 0;
                    if(isset($_GET["batasi"])){
                        $awal = $_GET["dari"] - 1;
                        $byk_record = $_GET["sampai"] - ($_GET["dari"] - 1);
                        $limit = "LIMIT " . $awal . "," . $byk_record;
                    }
                    $whr = "";
                    if($_GET["unit_pencipta"] != "0"){
                        $whr .= "
                            AND a.id_unit_kerja = '" . $_GET["unit_pencipta"] . "'
                        ";
                    }
                    $sql_list = "
                        SELECT 
                        		a.*, b.unit_kerja, b.unit_kerja, f.jenis_arsip, g.masalah, g.kode_masalah, i.username 
                        FROM 
                        		tbl_benda_arsip a 
                        		LEFT JOIN ref_unit_kerja b ON a.id_unit_kerja = b.id_unit_kerja 
                        		LEFT JOIN ref_jenis_arsip f ON a.id_jenis_arsip = f.id_jenis_arsip 
                        		LEFT JOIN ref_masalah g ON a.id_masalah = g.id_masalah 
                        		LEFT JOIN tbl_arsip_usul_musnah h ON a.id_arsip = h.id_arsip 
                        		LEFT JOIN tbl_pengguna i ON a.id_pengguna = i.id_user 
                        WHERE 
                        		a.status > 3
                        		AND h.status = 21 " . $whr . "
                        ORDER BY 
                            a.tahun ASC, a.id_masalah ASC, a.id_unit_kerja ASC, a.rak ASC, a.box ASC, a.sampul ASC
                        " . $limit . "
                    ";
                    //echo "<pre>" . $sql_list . "</pre>";
                    $res_list = mysql_query($sql_list);
                    $ctr = $awal;
                    while($ds_list = mysql_fetch_array($res_list)){
                        echo trim("
                            <tr class='col_fill'>
                                <td style='text-align: center;'>" . ++$ctr . "</td>
                                <td style='text-align: center;'>" . $ds_list["kode_klasifikasi"] . "</td>
                                <td style='text-align: center;'>" . $ds_list["indeks"] . "</td>
                                <td>" . $ds_list["uraian"] . "</td>
                                <td style='text-align: center;'>" . $ds_list["tahun"] . "</td>
                                <td>" . $ds_list["unit_kerja"] . "</td>
                                <td style='text-align: center;'>" . $ds_list["sampul"] . "</td>
                                <td style='text-align: center;'>" . $ds_list["box"] . "</td>
                                <td style='text-align: center;'>" . $ds_list["rak"] . "</td>
                                <td>" . $ds_list["keadaan"] . "</td>
                            </tr>
                        ");
                    }
                ?>
                </tbody>
            </table>
            <div class="kolom_ttd" style="page-break-before: always;">
            <div>&nbsp;</div>
            <div style="text-align: right; border: solid 0px black; width: 70%;">
                Medan, <?php echo $_GET["tgl"]; ?>
            </div>
            <div>&nbsp;</div>
            <table width="90%" border='0' cellspacing="0" cellpadding="0">
            <?php
                for($i=0; $i<$_GET["ttd_row"]; $i++){
                    if($i%2 == 0){
                        echo "
                            <tr>
                                <td width='70%' align='left'>
                                    <div><b>" . $_GET["kolom_ttd_" . $i] . "</b></div>
                                    <div>" . $_GET["jabatan_ttd_" . $i] . "</div>
                                    <div style='height: 1.5cm;'>&nbsp;</div>
                                    <div style='text-transform: uppercase;'>" . $_GET["nama_ttd_" . $i] . "</div>
                                    <div style='text-transform: uppercase;'>" . $_GET["pangkat_ttd_" . $i] . "</div>
                                    <div>" . $_GET["nip_ttd_" . $i] . "</div>
                                </td>
                        ";
                    }else{
                        echo "
                                <td align='left'>
                                    <div><b>" . $_GET["kolom_ttd_" . $i] . "</b></div>
                                    <div>" . $_GET["jabatan_ttd_" . $i] . "</div>
                                    <div style='height: 1.5cm;'>&nbsp;</div>
                                    <div style='text-transform: uppercase;'>" . $_GET["nama_ttd_" . $i] . "</div>
                                    <div style='text-transform: uppercase;'>" . $_GET["pangkat_ttd_" . $i] . "</div>
                                    <div>" . $_GET["nip_ttd_" . $i] . "</div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='2'>&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan='2'>&nbsp;</td>
                            </tr>
                        ";
                    }
                }
            ?>
            </table>
            </div>
        </div>
    </body>
</html>
<?php
    mysql_close($link_identifier);
?>