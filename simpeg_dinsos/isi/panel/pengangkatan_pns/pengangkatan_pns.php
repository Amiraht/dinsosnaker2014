<script type="text/javascript">
$(document).ready(function(){
    ambil_tanggal("tgl_sk_pns");
    ambil_tanggal("tmt_pns");
    $( "#dialog_cadis" ).dialog({
        autoOpen: false,
		height: "auto",
		width: 500,
		modal: true,
        show: "fade",
		hide: "fade"
    });
});
function disimpan(){
    jConfirm("Anda yakin akan menyimpan data pengangkatan PNS ini?", "PERHATIAN", function(r){
       if(r){
            $("#frm").submit();
       } 
    });
}
function catatan(id_riwayat_jabatan){
    $("#dialog_cadis").dialog("open");
}
</script>
<form name="frm" id="frm" action="php/pengangkatan_pns/pengangkatan_pns.php" method="post">
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">DATA PENGANGKATAN PNS <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nip"))); ?>)</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <?php
		if(isset($_GET["msg"])){
            if($_GET["msg"] == 1){
                echo "
                        <div class='alert alert-info' role='alert'>
                            Data pengangkatan PNS telah disimpan
                        </div>
                ";
            }
		}	
        ?>
        <?php
            $ds_data = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pengangkatan_pns WHERE id_pegawai='" . $_SESSION["simpeg_id_pegawai"] . "'"));
            if($ds_data["status_supervisi"] == 2){
                echo("<button type='button' class='btn btn-sm btn-success' onclick='catatan();'>Lihat Catatan Supervisi</button>");
                echo("<div class='kelang'></div>");
            }
        ?>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <label>Pejabat Penetapan :</label>
                    <input type="text" name="pejabat_penetapan" id="pejabat_penetapan" placeholder=":: Pejabat Penetapan ::" value="<?php echo($ds_data["pejabat_penetapan"]); ?>" />
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='70%'>
                    <label>No. SK PNS :</label>
                    <input type="text" name="no_sk_pns" id="no_sk_pns" placeholder=":: No. SK PNS ::" value="<?php echo($ds_data["no_sk_pns"]); ?>" />
                </td>
                <td width='80%'>
                    <label>Tgl. SK PNS :</label>
                    <input type="text" name="tgl_sk_pns" id="tgl_sk_pns" placeholder=":: Tgl. SK PNS ::" value="<?php echo($ds_data["tgl_sk_pns"]); ?>" />
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
                    <label>Pangkat :</label>
                    <select name="id_pangkat" id="id_pangkat">
                        <option value="0">:: Pilih Pangkat ::</option>
                    <?php
                        $res_pg = mysql_query("SELECT * FROM ref_pangkat");
                        while($ds_pg = mysql_fetch_array($res_pg)){
                            if($ds_pg["id_pangkat"] == $ds_data["id_pangkat"])
                                echo("<option selected='selected' value='" . $ds_pg["id_pangkat"] . "'>" . $ds_pg["pangkat"] . " (" . $ds_pg["gol_ruang"] . ")</option>");
                            else
                                echo("<option value='" . $ds_pg["id_pangkat"] . "'>" . $ds_pg["pangkat"] . " (" . $ds_pg["gol_ruang"] . ")</option>");
                        }
                    ?>
                    </select>
                </td>
                <td width='30%'>
                    <label>TMT PNS :</label>
                    <input type="text" name="tmt_pns" id="tmt_pns" placeholder=":: TMT PNS ::" value="<?php echo($ds_data["tmt_pns"]); ?>" />
                </td>
                <td>
                    <label>SUMPAH PNS :</label>
                    <select name="sumpah_pns">
                        <option value="sudah">Sudah</option>
                        <option value="belum">Belum</option>
                    </select>
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="kelang"></div>
<div class="panelcontainer panelform" style="width: 100%;">
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <?php
            if($ds_data["status_supervisi"] != 3 || $_SESSION["simpeg_id_level"] == 12){
        ?>
                <button type="button" class="btn btn-lg btn-success" onclick="disimpan();">Simpan</button>
                <button type="reset" class="btn btn-lg btn-default">Reset</button>
        <?php
            }else{
                echo("
                <div class='alert alert-info' role='alert'>
                            Data pengangkatan PNS telah di ACC. Data tidak bisa diedit kembali
                        </div>
                ");
            }
        ?>
        
    </div>
</div>
</form>
<!-- DIALOG JQUERY -->
<div id="dialog_cadis" title="Catatan : Revisi / Perbaikan Data Pengangkatan PNS" style="display: none;">
<?php
    $res_supervisi = mysql_query("SELECT * FROM catatan_pengangkatan_pns WHERE id_pegawai='" . $_SESSION["simpeg_id_pegawai"] . "'");
    $no_ctt = 0;
    while($ds_supervisi = mysql_fetch_array($res_supervisi)){
        $no_ctt++;
        echo("<div class='judullist'>Catatan No : " . $no_ctt . "</div>");
        echo("<div class='isilist'>");
            echo("<div>" . $ds_supervisi["catatan"] . "</div>");
        echo("</div>");
    }
?>
</div>
<!-- ------------- -->