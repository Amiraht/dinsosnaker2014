<script type="text/javascript">
function proses(){
    var tahun = $("#tahun").val();
    var bulan = $("#bulan").val();
    if(tahun == "" || bulan == 0)
        jAlert("Maaf, tahun dan bulan penilaian harus ditentukan", "PERHATIAN");
    else
        $("#frm").submit();
}
</script>
<form name="frm" id="frm" action="cetak/cetak_laporan_sudah_ngisi_penilaian_skp_adm_rekap.php" method="post" target="_blank">
<div class="panelcontainer" style="width: 100%;">
    <h3>FILTER DATA LAPORAN REKAP</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
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
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width="30%">
                    <label>Tahun SKP :</label>
                    <input type="text" name="tahun" id="tahun" placeholder=":: Tahun SKP ::" />
                </td>
                <td>
                    <label>Bulan :</label>
                    <select name="bulan" id="bulan">
                    <?php
                        $arr_bulan = array(":: Pilih Bulan ::", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
                                            "September", "Oktober", "November", "Desember");
                        for($i_bln=0; $i_bln<count($arr_bulan); $i_bln++){
                            echo("<option value='" . $i_bln . "'>" . $arr_bulan[$i_bln] . "</option>");
                        }
                    ?>
                    </select>
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