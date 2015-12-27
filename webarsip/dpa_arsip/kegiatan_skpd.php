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
                width: 100%;
                margin: auto;
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
            <?php
                $sql_judul = "
                    SELECT
                    	a.unit_kerja, DATE_FORMAT(tgl.dari, '%d-%m-%Y') AS dari, DATE_FORMAT(tgl.sampai, '%d-%m-%Y') AS sampai
                    FROM
                    	ref_unit_kerja a
                    	CROSS JOIN (SELECT '" . $_GET["dari"] . "' AS dari, '" . $_GET["sampai"] . "' AS sampai) tgl
                    WHERE
                    	a.id_unit_kerja = '" . $_GET["skpd"] . "'
                ";
                $res_judul = mysql_query($sql_judul);
                $ds_judul = mysql_fetch_assoc($res_judul);
            ?>
            <div style="text-align: center; font-weight: bold; font-size: 200%;">
                
            </div>
            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="font-size: 150%; padding: 5px;" colspan="10"><?php echo $_GET["judul"]; ?></th>
                    </tr>
                    <tr>
                        <th style="text-align: left; padding: 2px;" colspan="10">INSTANSI : <?php echo strtoupper($ds_judul["unit_kerja"]); ?></th>
                    </tr>
                    <tr>
                        <th style="text-align: left; padding: 2px;" colspan="10">MASALAH :</th>
                    </tr>
                    <tr>
                        <th colspan="10" style="height: 2px;">&nbsp;</th>
                    </tr>
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
                    $sql_list = "
                        SELECT
                        	a.*, c.unit_kerja, d.masalah, e.jenis_arsip
                        FROM
                        	tbl_benda_arsip a
                        	LEFT JOIN ref_unit_kerja c ON a.id_unit_kerja = c.id_unit_kerja
                        	LEFT JOIN ref_masalah d ON a.id_masalah  = d.id_masalah
                        	LEFT JOIN ref_jenis_arsip e ON a.id_jenis_arsip = e.id_jenis_arsip
                        WHERE
                        	a.id_jenis_arsip='1' AND a.id_pengguna='47' AND a.id_unit_kerja = '" . $_GET["skpd"] . "'
                            AND a.tgl_input BETWEEN '" . $_GET["dari"] . "' AND '" . $_GET["sampai"] . "'
                        ORDER BY
                        	a.tahun
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
            <br />
            <div style="text-align: right;">
                <?php
                    $sql_tgl_laporan = "
                        SELECT
                        	DATE_FORMAT(tgl.tanggal, '%d-%m-%Y') AS tanggal
                        FROM
                        	(SELECT '" . $_GET["tgl_laporan"] . "' AS tanggal) tgl
                    ";
                    $res_tgl_laporan = mysql_query($sql_tgl_laporan);
                    $ds_tgl_laporan = mysql_fetch_assoc($res_tgl_laporan);
                ?>
                Medan, <?php echo $ds_tgl_laporan["tanggal"]; ?>
            </div>
            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tr>
                    <td style="text-align: center; font-weight: bold;">Disetujui Oleh</td>
                    <td style="text-align: center; font-weight: bold;">Penginput Arsip</td>
                </tr>
                <tr>
                    <td style="text-align: center; font-weight: bold;"><?php echo $_GET["jabatan_setuju"]; ?></td>
                    <td style="text-align: center; font-weight: bold;"></td>
                </tr>
                <tr>
                    <td style="height: 1.5cm;">&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align: center;"><?php echo $_GET["nama_setuju"]; ?></td>
                    <td style="text-align: center;"><?php echo $_GET["nama_penginput"]; ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;"><?php echo $_GET["nip_setuju"]; ?></td>
                    <td style="text-align: center;"><?php echo $_GET["nip_penginput"]; ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;"><?php echo $_GET["pangkat_setuju"]; ?></td>
                    <td style="text-align: center;"><?php echo $_GET["pangkat_penginput"]; ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"><?php echo $_GET["jabatan_penginput"]; ?></td>
                </tr>
            </table>
        </div>
    </body>
</html>
<?php
    mysql_close($link_identifier);
?>