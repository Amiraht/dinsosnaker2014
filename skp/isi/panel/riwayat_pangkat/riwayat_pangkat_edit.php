<script type="text/javascript">
$(document).ready(function(){
    ambil_tanggal("tmt");
    ambil_tanggal("tgl_sk");
});
</script>
<?php
    $ds = mysql_fetch_array(mysql_query("SELECT * FROM tbl_riwayat_pangkat WHERE MD5(id_riwayat_pangkat)='" . $_GET["id_riwayat_pangkat"] . "'"));
?>
<form name="frm" id="frm" action="php/riwayat_pangkat/riwayat_pangkat_edit.php" method="post">
<input type="hidden" name="id_riwayat_pangkat" value="<?php echo($_GET["id_riwayat_pangkat"]); ?>" />
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">EDIT DATA RIWAYAT KEPANGKATAN <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nip"))); ?>)</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <input type="button" value="Kembali" onclick="document.location.href='?mod=riwayat_pangkat';" />
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <label>Pangkat / Gol. Ruang</label>
                    <select name="id_pangkat">
                        <option value="0">:: Pangkat / Gol. Ruang ::</option>
                        <?php
                            $res_cb = mysql_query("SELECT * FROM ref_pangkat ORDER BY id_pangkat ASC");
                            while($ds_cb = mysql_fetch_array($res_cb)){
                                if($ds["id_pangkat"] == $ds_cb["id_pangkat"])
                                    echo("<option selected='selected' value='" . $ds_cb["id_pangkat"] . "'>" . $ds_cb["pangkat"] . " / " . $ds_cb["gol_ruang"] . "</option>");
                                else
                                    echo("<option value='" . $ds_cb["id_pangkat"] . "'>" . $ds_cb["pangkat"] . " / " . $ds_cb["gol_ruang"] . "</option>");
                            }
                        ?>
                    </select>
                </td>
                <td width='300px'>
                    <label>TMT :</label>
                    <input placeholder=":: TMT ::" type="text" name="tmt" id="tmt" value="<?php echo($ds["tmt"]); ?>" />
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <label>Nomor SK. :</label>
                    <input placeholder=":: Nomor SK. ::" type="text" name="no_sk" id="no_sk" value="<?php echo($ds["no_sk"]); ?>" />
                </td>
                <td width='300px'>
                    <label>Tgl SK. :</label>
                    <input placeholder=":: Tgl SK. ::" type="text" name="tgl_sk" id="tgl_sk" value="<?php echo($ds["tgl_sk"]); ?>" />
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <label>Pejabat Penetapan :</label>
                    <input placeholder=":: Pejabat Penetapan ::" type="text" name="pejabat_penetapan" id="pejabat_penetapan" value="<?php echo($ds["pejabat_penetapan"]); ?>" />
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