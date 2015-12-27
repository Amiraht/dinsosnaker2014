<script type="text/javascript">
$(document).ready(function(){
   $( "#auto_search_satuan" ).dialog({
        autoOpen: false,
		height: "500",
		width: "400",
		modal: true,
        show: "fade",
		hide: "fade"
    }); 
});
function show_auto_search_satuan(){
    $( "#auto_search_satuan" ).dialog("open");
}
function pilih_satuan(parsing_kal){
    $("#satuan_kuantitas").val(parsing_kal);
    $( "#auto_search_satuan" ).dialog("close");
}
</script>
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">DATA SKP <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nip"))); ?>)</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <?php
            $ds = mysql_fetch_array(mysql_query("SELECT
                                	a.*, b.nama_pegawai AS nama_pegawai_penilai, b.nip AS nip_penilai, 
                                	c.nama_pegawai AS nama_pegawai_atasan_penilai, c.nip AS nip_atasan_penilai,
                                	d.pangkat AS pangkat_penilai, d.gol_ruang AS gol_ruang_penilai,
                                	e.pangkat AS pangkat_atasan_penilai, e.gol_ruang AS gol_ruang_atasan_penilai,
                                	f.skpd AS skpd_penilai, g.skpd AS skpd_atasan_penilai,
                                	h.jabatan AS jabatan_penilai, i.jabatan AS jabatan_atasan_penilai
                                FROM
                                	tbl_skp a
                                	LEFT JOIN tbl_pegawai b ON a.id_pegawai_penilai = b.id_pegawai
                                	LEFT JOIN tbl_pegawai c ON a.id_atasan_pegawai_penilai = c.id_pegawai
                                	LEFT JOIN ref_pangkat d ON b.id_pangkat = d.id_pangkat
                                	LEFT JOIN ref_pangkat e ON c.id_pangkat = e.id_pangkat
                                	LEFT JOIN ref_skpd f ON b.id_satuan_organisasi = f.id_skpd
                                	LEFT JOIN ref_skpd g ON c.id_satuan_organisasi = g.id_skpd
                                	LEFT JOIN ref_jabatan h ON b.id_jabatan = h.id_jabatan
                                	LEFT JOIN ref_jabatan i ON c.id_jabatan = i.id_jabatan
                                WHERE
                                	a.id_skp='" . $_GET["id_skp"] . "'
                                ORDER BY
                                	a.dari ASC
                                "));
        ?>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='150px'>Periode</td>
                <td width='5px'>:</td>
                <td style="text-transform: uppercase;"><b><?php echo(tglindonesia($ds["dari"]) . " S/D " . tglindonesia($ds["sampai"])); ?></b></td>
                <td width='150px'>&nbsp;</td>
                <td width='5px'>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Pejabat Penilai</td>
                <td>:</td>
                <td style="text-transform: uppercase;">
                    <b>
                        <?php echo($ds["nama_pegawai_penilai"]); ?><br />
                        NIP : <?php echo($ds["nip_penilai"]); ?><br />
                        Pangkat : <?php echo($ds["pangkat_penilai"]); ?><br />
                        Jabatan : <?php echo($ds["jabatan_penilai"]); ?><br />
                        SKPD : <?php echo($ds["skpd_penilai"]); ?>
                    </b>
                </td>
                
                <td>Atasan Pejabat Penilai</td>
                <td>:</td>
                <td style="text-transform: uppercase;">
                    <b>
                        <?php echo($ds["nama_pegawai_atasan_penilai"]); ?><br />
                        NIP : <?php echo($ds["nip_atasan_penilai"]); ?><br />
                        Pangkat : <?php echo($ds["pangkat_atasan_penilai"]); ?><br />
                        Jabatan : <?php echo($ds["jabatan_atasan_penilai"]); ?><br />
                        SKPD : <?php echo($ds["skpd_atasan_penilai"]); ?>
                    </b>
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="kelang"></div>
<?php
    $ds_data = mysql_fetch_array(mysql_query("SELECT * FROM tbl_uraian_skp WHERE id_uraian_skp='" . $_GET["id_uraian_skp"] . "'"));
?>
<form name="frm" id="frm" action="php/skp/skp_uraian_tambah.php" method="post">
<input type="hidden" name="id_skp" value="<?php echo($_GET["id_skp"]); ?>" />
<input type="hidden" name="id_uraian_skp" value="<?php echo($_GET["id_uraian_skp"]); ?>" />
<div class="panelcontainer panelform" style="width: 100%;">
    <?php
        $jdl = "TAMBAH";
        if($_GET["id_uraian_skp"] != 0)
            $jdl = "EDIT";
    ?>
    <h3 style="text-align: left;"><?php echo($jdl); ?> DATA TARGET SKP PEGAWAI <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nip"))); ?>)</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <input type="button" value="Kembali" onclick="document.location.href='?mod=skp_uraian&id=<?php echo($_GET["id_skp"]); ?>';" />
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <label>Uraian Kegiatan Tugas Jabatan :</label>
                    <input type="text" name="kegiatan" id="kegiatan" placeholder=":: Kegiatan Tugas Jabatan ::" title="Kegiatan Tugas Jabatan" value="<?php echo($ds_data["kegiatan"]); ?>" />
                </td>
                <td width='200px'>
                    <label>Bobot Kredit :</label>
                    <input type="text" name="ak" id="ak" placeholder=":: AK ::" title="AK" value="<?php echo($ds_data["ak"]); ?>" />
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='150px'>
                    <label>Kuantitas / Output :</label>
                    <input type="text" name="kuantitas" id="kuantitas" placeholder=":: Kuantitas / Output ::" title="Kuantitas / Output" value="<?php echo($ds_data["kuantitas"]); ?>" />
                </td>
                <td>
                    <label>
                        Satuan Kuantitas :
                        <a href="javascript:show_auto_search_satuan();" class="link_auto_panel input_widget">Search</a>
                    </label>
                    <input type="text" name="satuan_kuantitas" id="satuan_kuantitas" placeholder=":: Satuan Kuantitas ::" title="Satuan Kuantitas" value="<?php echo($ds_data["satuan_kuantitas"]); ?>" />
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='20%'>
            <tr>
                <td>
                    <label>Kualitas / Mutu :</label>
                    <select name="kualitas" id="kualitas">
                        <option value="0">:: Kualitas ::</option>
                        <?php
                            for($i=0; $i<=100; $i++){
                                if($ds_data["kualitas"] == $i)
                                    echo("<option selected='selected' value='" . $i . "'>" . $i . "</option>");
                                else
                                    echo("<option value='" . $i . "'>" . $i . "</option>");
                            }
                        ?>
                    </select>
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='150px'>
                    <label>Waktu :</label>
                    <input type="text" name="waktu" id="waktu" placeholder=":: Waktu ::" title="Waktu" value="<?php echo($ds_data["waktu"]); ?>" />
                </td>
                <td>
                    <label>Satuan Waktu :</label>
                    <select name="id_satuan_waktu">
                        <option value="0">:: Satuan Waktu ::</option>
                    <?php
                        $res_cb = mysql_query("SELECT * FROM ref_satuan_waktu ORDER BY id_satuan_waktu ASC");
                        while($ds_cb = mysql_fetch_array($res_cb)){
                            if($ds_data["id_satuan_waktu"] == $ds_cb["id_satuan_waktu"])
                                echo("<option selected='selected' value='" . $ds_cb["id_satuan_waktu"] . "'>" . $ds_cb["satuan_waktu"] . "</option>");
                            else
                                echo("<option value='" . $ds_cb["id_satuan_waktu"] . "'>" . $ds_cb["satuan_waktu"] . "</option>");
                        }
                    ?>
                    </select>
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <label>Biaya :</label>
                    <input type="text" name="biaya" id="biaya" placeholder=":: Biaya ::" title="Biaya" value="<?php echo($ds_data["biaya"]); ?>" />
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td style="text-align: left;">
                    <input type="submit" value="SIMPAN" style="width: 150px; height: 40px;" />
                    <input type="reset" value="RESET" style="width: 150px; height: 40px;" />
                </td>
            </tr>
        </table>
    </div>
</div>
</form>
<!-- DIALOG JQUERY -->
<div id="auto_search_satuan" title="AUTO SEARCH : SATUAN KUANTITAS" style="display: none;">
<div class="panelcontainer" style="width: 100%;">
    <div class="bodypanel">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtablebackup">
            <thead>
                <tr class="headertable">
                    <th width='30px'>No.</th>
                    <th>Satuan Kuantitas</th>
                    <th width='20px'>&nbsp;</th>
                </tr>
            </thead>
            <tbody id="as_listing_satuan" style="overflow: scroll;">
            <?php
                $res_satuan = mysql_query("SELECT
                                            	satuan_kuantitas
                                            FROM
                                            	tbl_uraian_skp
                                            GROUP BY
                                            	satuan_kuantitas
                                            ORDER BY
                                            	satuan_kuantitas ASC");
                $no=0;
                while($ds_satuan = mysql_fetch_array($res_satuan)){
                    $no++;
                    echo("<tr>");
                        echo("<td align='center'>" . $no . "</td>");
                        echo("<td align='center'>" . $ds_satuan["satuan_kuantitas"] . "</td>");
                        echo("<td>
                                <img src='image/Button Next_32.png' width='18px' class='linkimage' title='Pilih Satuan ini' onclick='pilih_satuan(\"" . $ds_satuan["satuan_kuantitas"] . "\");' />
                              </td>");
                    echo("</tr>");
                }
            ?>
            </tbody>
        </table>
    </div>
</div>
</div>
<!-- ------------- -->