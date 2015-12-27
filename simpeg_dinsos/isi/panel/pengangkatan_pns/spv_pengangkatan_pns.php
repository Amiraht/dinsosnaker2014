<script type="text/javascript">
function disimpan(sttspv){
    $("#stt").val(sttspv);
    if(sttspv == 2){
        var catatan = $("#catatan").val();
        if(catatan == "")
            jAlert("Maaf, berikan catatan penolakan jika ingin menolak data ini", "PERHATIAN");
        else{
            jConfirm("Anda yakin akan menolak data pengangkatan CPNS ini?", "PERHATIAN", function(r){
                if(r){
                    $("#frm").submit();
                }
            });
        }
    }else if(sttspv == 3){
        jConfirm("Anda yakin akan menerima data pengangkatan CPNS ini?", "PERHATIAN", function(r){
            if(r){
                $("#frm").submit();
            }
        });
    }
}
</script>
<form name="frm" id="frm" action="php/pengangkatan_pns/spv_pengangkatan_pns.php" method="post">
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">DATA PENGANGKATAN PNS <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nip"))); ?>)</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
    <?php
        $ds = mysql_fetch_array(mysql_query("SELECT a.*, b.pangkat, b.gol_ruang
                                            FROM tbl_pengangkatan_pns a
                                            LEFT JOIN ref_pangkat b ON a.id_pangkat = b.id_pangkat
                                             WHERE id_pegawai='" . $_SESSION["simpeg_id_pegawai"] . "'"));
    ?>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <label>Pejabat Penetapan :</label>
                    <div class="label_caption"><?php echo($ds["pejabat_penetapan"]); ?></div>
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='70%'>
                    <label>No. SK CPNS :</label>
                    <div class="label_caption"><?php echo($ds["no_sk_pns"]); ?></div>
                </td>
                <td width='80%'>
                    <label>Tgl. SK CPNS :</label>
                    <div class="label_caption"><?php echo($ds["tgl_sk_pns"]); ?></div>
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
                    <label>Pangkat :</label>
                    <div class="label_caption"><?php echo($ds["pangkat"] . " (" . $ds["gol_ruang"] . ")"); ?></div>
                    </select>
                </td>
                <td width='30%'>
                    <label>TMT CPNS :</label>
                    <div class="label_caption"><?php echo($ds["tmt_pns"]); ?></div>
                </td>
                <td>
                    <label>SUMPAH PNS</label>
                    <div class="label_caption"><?php echo($ds["sumpah_pns"]); ?></div>
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="kelang"></div>
<div class="panelcontainer panelform" style="width: 100%;">
    <div class="bodypanel bodyfilter" id="bodyfilter">
    <?php
        if($ds["status_supervisi"] == 1){
    ?>
                <input type="hidden" name="stt" id="stt" />
                <textarea name="catatan" id="catatan" placeholder=":: Jika Ditolak, Berikan catatan penolakan disini ::"></textarea>
                <div class="kelang"></div>
                <button type="button" class="btn btn-lg btn-success" onclick="disimpan(3);">Terima</button>
                <button type="button" class="btn btn-lg btn-default" onclick="disimpan(2);">TolaK</button>
    <?php
        }else{
            echo("
                        <div class='alert alert-info' role='alert'>
                            Data pengangkatan PNS telah disupervisi
                        </div>
                ");
        }
    ?>
    </div>
</div>
</form>