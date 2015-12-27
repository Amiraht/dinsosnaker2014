<script type="text/javascript">
$(document).ready(function(){
    ambil_tanggal("tmt");
    ambil_tanggal("tgl_sk_jabatan");
    ambil_tanggal("tgl_sk_pelantikan");
    $( "#auto_panel_jabatan" ).dialog({
        autoOpen: false,
		height: "auto",
		width: "700",
		modal: true,
        show: "fade",
		hide: "fade"
    });
    
    $("#frm_auto_panel_jabatan").submit(function(){
        var id_skpd = $("#ap_id_skpd").val();
        var id_tipe_jabatan = $("#ap_id_tipe_jabatan").val();
        var id_eselon = $("#ap_id_eselon").val();
        var jabatan = $("#ap_jabatan").val();
        $.ajax({
            type: "GET",
            url: "ajax/ap_jabatan.php",
            data: "id_skpd=" + id_skpd + "&id_tipe_jabatan=" + id_tipe_jabatan + "&id_eselon=" + id_eselon + "&jabatan=" + jabatan,
            success: function(r){
                get_jabatan();
				jAlert("Tambah Data Jabatan Berhasil", "KONFIRMASI");
                $("#auto_panel_jabatan").dialog("close");
            }
        });
        return false;
    });
});
function show_auto_panel_jabatan(){
    var id_skpd = $("#id_skpd").val();
    var id_tipe_jabatan = $("#id_tipe_jabatan").val(); 
    if(id_skpd != 0 && id_tipe_jabatan != 0){
        $("#ap_id_skpd").val($("#id_skpd").val());
        $("#ap_id_tipe_jabatan").val($("#id_tipe_jabatan").val());
        $("#ap_id_eselon").val(0);
        $("#ap_jabatan").val("");
        if(id_tipe_jabatan == 1){
            $("#td_eselon").show();
        }else{
            $("#td_eselon").hide();
        }
        $("#auto_panel_jabatan").dialog("open");
    }else{
        jAlert("Maaf, anda harus memilih SKPD dan tipe jabatan terlebih dahulu", "PERHATIAN");
    }
}
function get_jabatan(){
    var id_skpd = $("#id_skpd").val();
    var id_tipe_jabatan = $("#id_tipe_jabatan").val(); 
    if(id_skpd != 0 && id_tipe_jabatan != 0){
        $("#id_jabatan").html("<option value='0'>:: Jabatan ::</option>");
        $.ajax({
            type: "GET",
            url: "ajax/get_jabatan.php",
            data: "id_skpd=" + id_skpd + "&id_tipe_jabatan=" + id_tipe_jabatan,
            success: function(r){
                $("#id_jabatan").append(r);
            }
        });
    }
}
</script>
<?php
    $ds = mysql_fetch_array(mysql_query("SELECT * FROM tbl_riwayat_jabatan WHERE MD5(id_riwayat_jabatan) = '" . $_GET["id_riwayat_jabatan"] . "'"));
?>
<form name="frm" id="frm" action="php/riwayat_jabatan/riwayat_jabatan_edit.php" method="post">
<input type="hidden" name="id_riwayat_jabatan" value="<?php echo($_GET["id_riwayat_jabatan"]); ?>" />
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">EDIT DATA RIWAYAT JABATAN <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nip"))); ?>)</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <input type="button" value="Kembali" onclick="document.location.href='?mod=riwayat_jabatan';" />
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='33%'>
                    <label>SKPD / Unit Kerja :</label>
                    <select name="id_skpd" id="id_skpd" onchange="get_jabatan();">
                        <option value="0">:: SKPD / Unit Kerja ::</option>
                        <?php
                            $res_cb = mysql_query("SELECT * FROM ref_skpd ORDER BY skpd ASC");
                            while($ds_cb = mysql_fetch_array($res_cb)){
                                if($ds["id_skpd"] == $ds_cb["id_skpd"])
                                    echo("<option selected='selected' value='" . $ds_cb["id_skpd"] . "'>" . $ds_cb["skpd"] . "</option>");
                                else
                                    echo("<option value='" . $ds_cb["id_skpd"] . "'>" . $ds_cb["skpd"] . "</option>");
                            }
                        ?>
                    </select>
                </td>
                <td width='33%'>
                    <label>Tipe Jabatan :</label>
                    <select name="id_tipe_jabatan" id="id_tipe_jabatan" onchange="get_jabatan();">
                        <option value="0">:: Tipe Jabatan ::</option>
                        <?php
                            $res_cb = mysql_query("SELECT * FROM ref_tipe_jabatan ORDER BY id_tipe_jabatan ASC");
                            while($ds_cb = mysql_fetch_array($res_cb)){
                                if($ds["id_tipe_jabatan"] == $ds_cb["id_tipe_jabatan"])
                                    echo("<option selected='selected' value='" . $ds_cb["id_tipe_jabatan"] . "'>" . $ds_cb["tipe_jabatan"] . "</option>");
                                else
                                    echo("<option value='" . $ds_cb["id_tipe_jabatan"] . "'>" . $ds_cb["tipe_jabatan"] . "</option>");
                            }
                        ?>
                    </select>
                </td>
                <td width='34%'>
                    <label>
                        Jabatan : 
                        <a href="javascript:show_auto_panel_jabatan();" class="link_auto_panel input_widget">Tambah Baru</a>
                    </label>
                    <select name="id_jabatan" id="id_jabatan">
                        <option value="0">:: Jabatan ::</option>
                        <?php
                            $res_cb = mysql_query("SELECT * FROM ref_jabatan WHERE id_skpd='" . $ds["id_skpd"] . "' AND id_tipe_jabatan='" . $ds["id_tipe_jabatan"] . "' ORDER BY jabatan ASC");
                            while($ds_cb = mysql_fetch_array($res_cb)){
                                if($ds["id_jabatan"] == $ds_cb["id_jabatan"])
                                    echo("<option selected='selected' value='" . $ds_cb["id_jabatan"] . "'>" . $ds_cb["jabatan"] . "</option>");
                                else
                                    echo("<option value='" . $ds_cb["id_jabatan"] . "'>" . $ds_cb["jabatan"] . "</option>");
                            }
                        ?>
                    </select>
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='300px'>
                    <label>TMT</label>
                    <input placeholder=":: TMT ::" type="text" name="tmt" id="tmt" value="<?php echo($ds["tmt"]); ?>" />
                </td>
                <td>
                    <label>Nomor SK Jabatan :</label>
                    <input placeholder=":: Nomor SK. ::" type="text" name="no_sk_jabatan" id="no_sk_jabatan" value="<?php echo($ds["no_sk_jabatan"]); ?>" />
                </td>
                <td width='300px'>
                    <label>Tgl SK Jabatan :</label>
                    <input placeholder=":: Tgl SK. ::" type="text" name="tgl_sk_jabatan" id="tgl_sk_jabatan" value="<?php echo($ds["tgl_sk_jabatan"]); ?>" />
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <label>Pejabat Penetapan</label>
                    <input placeholder=":: Pejabat Penetapan ::" type="text" name="pejabat_penetapan" id="pejabat_penetapan" value="<?php echo($ds["pejabat_penetapan"]); ?>" />
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <label>Nomor SK Pelantikan :</label>
                    <input placeholder=":: Nomor SK. Pelantikan ::" type="text" name="no_sk_pelantikan" id="no_sk_pelantikan" value="<?php echo($ds["no_sk_pelantikan"]); ?>" />
                </td>
                <td width='300px'>
                    <label>Tgl SK Pelantikan :</label>
                    <input placeholder=":: Tgl SK. Pelantikan ::" type="text" name="tgl_sk_pelantikan" id="tgl_sk_pelantikan" value="<?php echo($ds["tgl_sk_pelantikan"]); ?>" />
                </td>
                <td width='300px'>
                    <label>Sumpah Jabatan :</label>
                    <select name="sumpah_jabatan" id="sumpah_jabatan">
                        <option value="0">:: Sumpah Jabatan ::</option>
                        <option value="1" <?php if($ds["sumpah_jabatan"]==1){echo("selected='selected'");} ?> >Sudah</option>
                        <option value="2" <?php if($ds["sumpah_jabatan"]==2){echo("selected='selected'");} ?> >Belum</option>
                    </select>
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <label>Pejabat Pelantik</label>
                    <input placeholder=":: Pejabat Pelantik ::" type="text" name="pejabat_pelantik" id="pejabat_pelantik" value="<?php echo($ds["pejabat_pelantik"]); ?>" />
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
<!-- DIALOG JQUERY --------------------------------------------------- -->
<div id="auto_panel_jabatan" title="AUTO PANEL : TAMBAH ITEM JABATAN" style="display: none;">
<form name="frm_auto_panel_jabatan" id="frm_auto_panel_jabatan" action="" method="post">
    <input type="hidden" name="ap_id_skpd" id="ap_id_skpd" />
    <input type="hidden" name="ap_id_tipe_jabatan" id="ap_id_tipe_jabatan" />
    <div class="panelcontainer panelform" style="width: 100%;">
        <div class="bodypanel bodyfilter" id="bodyfilter">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr id="td_eselon">
                    <td>
                        <select id="ap_id_eselon">
                            <option value="0">:: Eselon ::</option>
                            <?php
                                $res_cb = mysql_query("SELECT * FROM ref_eselon ORDER BY id_eselon DESC");
                                while($ds_cb = mysql_fetch_array($res_cb)){
                                    echo("<option value='" . $ds_cb["id_eselon"] . "'>" . $ds_cb["eselon"] . "</option>");
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" id="ap_jabatan" placeholder=":: Jabatan ::" />
                    </td>
                </tr>
            </table>
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td style="text-align: left;">
                        <input type="submit" value="SIMPAN" style="width: 150px; height: 40px;" />
                    </td>
                </tr>
            </table>
        </div>
    </div>
</form>
</div>
<!-- ----------------------------------------------------------------- -->