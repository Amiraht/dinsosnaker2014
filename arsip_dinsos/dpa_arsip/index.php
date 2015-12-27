<?php
    error_reporting(0);
    include("config/connection.php");
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Daftar Pertelaan Arsip</title>
        <link rel="stylesheet" type="text/css" href="css/default.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.10.3.custom.min.css" />
        <script type="text/javascript" src="js/googleapis_jquery_min.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min-1.11.1.js"></script>
        <script type="text/javascript">
            function go_ttd(){
                var ttd_row = $("#ttd_row").val();
                $.ajax({
                    url: "ttd_list_generator.php",
                    data: "jml=" + ttd_row,
                    type: "GET",
                    dataType: "text",
                    success: function(r){
                        $("#ttd_list").html(r);
                    }
                });
            }
        </script>
    </head>
    <body>
        <div class="panel">
            <div class="panel_title">Filter Laporan</div>
            <div class="panel_body">
                <form name="frm_filter" method="get" target="_blank" action="dpa.php">
                    <table width="100%" cellspacing="0" cellpadding="0" class="itblfrm" border="0">
                        <tr>
                            <td>
                                <input type="text" name="judul" placeholder="Judul DPA" />
                            </td>
                        </tr>
                    </table>
                    <table width="100%" cellspacing="0" cellpadding="0" class="itblfrm" border="0">
                        <tr>
                            <td width="45%">
                                <select name="masalah">
                                    <option value="0">::::: Semua Masalah :::::</option>
                                    <?php
                                        $sql_masalah = "SELECT * FROM ref_masalah ORDER BY kode_masalah ASC";
                                        $res_masalah = mysql_query($sql_masalah, $link_identifier);
                                        while($ds_masalah = mysql_fetch_array($res_masalah)){
                                    ?>
                                            <option value="<?php echo $ds_masalah["id_masalah"]; ?>"><?php echo $ds_masalah["kode_masalah"]; ?> - <?php echo $ds_masalah["masalah"]; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select name="unit_pencipta">
                                    <option value="0">::::: Semua SKPD :::::</option>
                                    <?php
                                        $sql_unit_kerja = "SELECT * FROM ref_unit_kerja ORDER BY unit_kerja";
                                        $res_unit_kerja = mysql_query($sql_unit_kerja, $link_identifier);
                                        while($ds_unit_kerja = mysql_fetch_array($res_unit_kerja)){
                                            echo "<option value='" . $ds_unit_kerja["id_unit_kerja"] . "'>" . $ds_unit_kerja["unit_kerja"] . "</option>";
                                        }
                                    ?>
                                </select>
                            </td>
                            <td width="10%">
                                <input type="text" name="tahun" placeholder="Tahun" />
                            </td>
                        </tr>
                    </table>
                    <table width="100%" cellspacing="0" cellpadding="0" class="itblfrm" border="0">
                        <tr>
                            <td>
                                <textarea placeholder="Uraian Masalah / Deskripsi" name="uraian"></textarea>
                            </td>
                        </tr>
                    </table>
                    <table width="50%" cellspacing="0" cellpadding="0" class="itblfrm" border="0">
                        <tr>
                            <td>
                                <input type="text" name="tgl" placeholder="Tanggal" />
                            </td>
                            <td>
                                <input type="text" name="sampul" placeholder="Sampul" />
                            </td>
                            <td>
                                <input type="text" name="box" placeholder="Kotak" />
                            </td>
                            <td>
                                <input type="text" name="rak" placeholder="Rak" />
                            </td>
                        </tr>
                    </table>
                    <div>&nbsp;</div>
                    <table width="100%" cellspacing="0" cellpadding="0" class="list_ttd" border="0" style="border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th colspan="6" style="text-align: left;">
                                    <input type="text" style="width: 50px;" placeholder="Ttd" id="ttd_row" name="ttd_row" />
                                    <input type="button" value="OK" onclick="go_ttd();" />
                                </th>
                            </tr>
                            <tr>
                                <th style="width: 2%;" align="center">NO.</th>
                                <th style="width: 20%;" align="center">JUDUL KOLOM</th>
                                <th align="center">NAMA</th>
                                <th  style="width: 15%;" align="center">NIP</th>
                                <th style="width: 20%;" align="center">JABATAN</th>
                                <th style="width: 20%;" align="center">PANGKAT</th>
                            </tr>
                        </thead>
                        <tbody id="ttd_list">
                        </tbody>
                    </table>
                    <div>&nbsp;</div>
                    <table width="50%" cellspacing="0" cellpadding="0" class="itblfrm" border="0">
                        <tr>
                            <td>
                                <input type="submit" name="proses" value="Proses DPA" />
                                <input type="checkbox" name="batasi" />
                                Batasi Baris :
                                <input type="text" name="dari" placeholder="Dari" style="width: 50px;" />
                                S/D
                                <input type="text" name="sampai" placeholder="Sampai" style="width: 50px;" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <br />
        <?php include("rekap_skpd.php"); ?>
    </body>
</html>
<?php
    mysql_close($link_identifier);
?>