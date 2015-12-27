<script type="text/javascript">
$(document).ready(function(){
    ambil_tanggal("tmt");
    ambil_tanggal("tgl_sk");
});
</script>
<form name="frm" id="frm" action="php/riwayat_pangkat/riwayat_pangkat_tambah.php" method="post">
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">TAMBAH DATA RIWAYAT KEPANGKATAN <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nip"))); ?>)</h3>
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
                                echo("<option value='" . $ds_cb["id_pangkat"] . "'>" . $ds_cb["pangkat"] . " / " . $ds_cb["gol_ruang"] . "</option>");
                            }
                        ?>
                    </select>
                </td>
                <td width='300px'>
                    <label>TMT :</label>
                    <input placeholder=":: TMT ::" type="text" name="tmt" id="tmt" />
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <label>Nomor SK. :</label>
                    <input placeholder=":: Nomor SK. ::" type="text" name="no_sk" id="no_sk" />
                </td>
                <td width='300px'>
                    <label>Tgl SK. :</label>
                    <input placeholder=":: Tgl SK. ::" type="text" name="tgl_sk" id="tgl_sk" />
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <label>Pejabat Penetapan :</label>
                    <input placeholder=":: Pejabat Penetapan ::" type="text" name="pejabat_penetapan" id="pejabat_penetapan" />
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