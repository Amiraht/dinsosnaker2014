<script type="text/javascript">
function proses(){
    var tahun = $("#tahun").val();
    
    if(tahun == "")
        jAlert("Maaf, tahun SKP harus ditentukan", "PERHATIAN");
    else
        $("#frm").submit();
}
</script>
<form name="frm" id="frm" action="cetak/cetak_laporan_sudah_ngupload_skp_dp3_adm.php" method="post" target="_blank">
<div class="panelcontainer" style="width: 100%;">
    <h3>FILTER DATA LAPORAN</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='70%'>
                    <label>Pilih SKPD :</label>
                    <select name="kode_skpd" id="kode_skpd">
                        <option value="all">:::: SEMUA SKPD ::::</option>
                    <?php
                        $res_skpd = mysql_query("SELECT * FROM ref_skpd ORDER BY skpd ASC");
                        while($ds_skpd = mysql_fetch_array($res_skpd)){
                            echo("<option value='" . $ds_skpd["kode_skpd"] . "'>" . $ds_skpd["skpd"] . "</option>");
                        }
                    ?>
                    </select>
                </td>
                <td>
                    <label>Pilih Pangkat :</label>
                    <select name="id_pangkat" id="id_pangkat">
                        <option value="all">:::: SEMUA PANGKAT ::::</option>
                    <?php
                        $res_pangkat = mysql_query("SELECT * FROM ref_pangkat ORDER BY gol_ruang ASC");
                        while($ds_pangkat = mysql_fetch_array($res_pangkat)){
                            echo("<option value='" . $ds_pangkat["id_pangkat"] . "'>" . $ds_pangkat["pangkat"] . "</option>");
                        }
                    ?>
                    </select>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td width="40%">
                    <label>Tahun SKP Dan Penilaian Prestasi Kerja Yang Diupload :</label>
                    <input type="text" name="tahun" id="tahun" placeholder=":: Tahun SKP Dan Penilaian Prestasi Kerja ::" />
                </td>
                <td>&nbsp;</td>
            </tr>
        </table>
        <table>
            <tr>
                <td>
                    <input type="checkbox" class="pilih" name="skp" checked="checked" /> SKP<br />
                    <input type="checkbox" class="pilih" name="penilaian" checked="checked" /> Penilaian SKP Bulanan<br />
                    <input type="checkbox" class="pilih" name="dp3" checked="checked" /> Penilaian Prestasi Kerja
                </td>
            </tr>
        </table>
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='20%'>
            <tr>
                <td>
                    <button type="button" class="btn btn-lg btn-success" onclick="proses();">Proses</button>
                    <button type="reset" class="btn btn-lg btn-default">Reset</button>
                </td>
            </tr>
        </table>
    </div>
</div>
</form>
<div class="kelang"></div>
<iframe name="hasil_laporan" style="border: solid 1px #CCC; width: 100%;"></iframe>