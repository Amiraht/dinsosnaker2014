<script type="text/javascript">
$(document).ready(function(){
    $("#dialog_form_disp").dialog({
            autoOpen: false,
			height: "auto",
			width: 700,
			modal: true,
            show: "fade",
			hide: "fade"
        });
});
function munculDisposisi(id_surat_masuk, id_disposisi){
    $("#id_surat_masuk").val(id_surat_masuk);
    $("#id_disposisi").val(id_disposisi);
    $("#dialog_form_disp").dialog("open");
}

</script>
<script type="text/javascript">
$(document).ready(function(){
    $("#expand").click(function(){
        $("#bodyfilter").slideToggle(500);
    });
    
    $("#tgl_surat_dari").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
    $("#tgl_terima_dari").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
    
    $("#tgl_surat_sampai").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
    $("#tgl_terima_sampai").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
});
</script>
<form name="frm" action="?mod=edit_arsip_surat_masuk" method="post">
    <div class="panelcontainer" style="width: 100%;">
        <h3><div style="display: block; float: left;"><div style="clear: both;"></div>FILTER DATA PENCARIAN</div><input type="button" value="+" style="float: right; display: block; font-weight: bold;" id="expand" /><div style="clear: both;"></div></h3>
        <div class="bodypanel" id="bodyfilter">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='20%'>Nomor Surat</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="no_surat" value="<?php echo($_POST["no_surat"]); ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Tanggal Surat</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="text" name="tgl_surat_dari" id="tgl_surat_dari" class="ufilter" value="<?php echo($_POST["tgl_surat_dari"]); ?>" />
                        S/D
                        <input type="text" name="tgl_surat_sampai" id="tgl_surat_sampai" class="ufilter" value="<?php echo($_POST["tgl_surat_sampai"]); ?>" />
                    </td>
                </tr>
                <tr>
                    <td width='20%'>Tanggal Terima</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="text" name="tgl_terima_dari" id="tgl_terima_dari" class="ufilter" value="<?php echo($_POST["tgl_terima_dari"]); ?>" />
                        S/D
                        <input type="text" name="tgl_terima_sampai" id="tgl_terima_sampai" class="ufilter" value="<?php echo($_POST["tgl_terima_sampai"]); ?>" />
                    </td>
                </tr>
                <tr>
                    <td width='20%'>Perihal</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="perihal_surat" value="<?php echo($_POST["perihal_surat"]); ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Deskripsi Surat</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="deskripsi_surat" value="<?php echo($_POST["deskripsi_surat"]); ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>SKPD / Unit Pengirim</td>
                    <td width='10px'>:</td>
                    <td>
                        <select name="id_skpd_pengirim">
                            <option value="0">[.. Pilih SKPD Pengirim ..]</option>
                        <?php
                            $res_skpd = mysql_query("SELECT * FROM myapp_reftable_unitkerja ORDER BY unit_kerja ASC");
                            while($ds_skpd = mysql_fetch_array($res_skpd)){
                                if($ds_skpd["id_unit_kerja"] == $_POST["id_skpd_pengirim"])
                                    echo("<option selected='selected' value='" . $ds_skpd["id_unit_kerja"] . "'>" . $ds_skpd["unit_kerja"] . "</option>");
                                else
                                    echo("<option value='" . $ds_skpd["id_unit_kerja"] . "'>" . $ds_skpd["unit_kerja"] . "</option>");
                            }
                        ?>
                        </select>
                    </td>
                </tr>
            </table>
            <div class="kelang"></div>
            <table border="0px" cellspacing='0' cellpadding='0' width='40%'>
                <tr>
                    <td width='50%'><input type="submit" value='Filter' style="width: 100%;" /></td>
                    <td width='50%'><input type="reset" value='Reset' style="width: 100%;" /></td>
                </tr>
            </table>
        </div>
    </div>
</form>
<div class="kelang"></div>
<div class="panelcontainer" style="width: 100%;">
    <h3>CARI SURAT MASUK YANG AKAN DIEDIT DATA PENGARSIPANNYA</h3>
    <div class="bodypanel">
    <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
        <tr class="headertable">
            <th width='40px'>No.</th>
            <th width='200px'>No. Surat</th>
            <th width='100px'>Tgl. Surat</th>
            <th width='100px'>Tgl. Terima</th>
            <th>Perihal</th>
            <th width='250px'>Unit Pengirim</th>
            <th width='100px'>Harus Selesai</th>
            <th width='100px'>Sampul</th>
            <th width='100px'>Kotak</th>
            <th width='100px'>Rak</th>
            <th width='20px'>&nbsp;</th>
            <th width='20px'>&nbsp;</th>
            <th width='20px'>&nbsp;</th>
            <th width='20px'>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
    <?php
        $whr = "";
        if($_POST["no_surat"] <> "")
            $whr .= " AND a.no_surat LIKE '%" . $_POST["no_surat"] . "%'";
        if($_POST["tgl_surat_dari"] <> "" && $_POST["tgl_surat_sampai"] <> "")
            $whr .= " AND a.tgl_surat BETWEEN '" . $_POST["tgl_surat_dari"] . "' AND '" . $_POST["tgl_surat_sampai"] . "'";
        if($_POST["tgl_terima_dari"] <> "" && $_POST["tgl_terima_sampai"] <> "")
            $whr .= " AND a.tgl_terima BETWEEN '" . $_POST["tgl_terima_dari"] . "' AND '" . $_POST["tgl_terima_sampai"] . "'";
        if($_POST["perihal_surat"] <> "")
            $whr .= " AND a.perihal_surat LIKE '%" . $_POST["perihal_surat"] . "%'";
        if($_POST["deskripsi_surat"] <> "")
            $whr .= " AND a.deskripsi_surat LIKE '%" . $_POST["deskripsi_surat"] . "%'";
        if($_POST["id_skpd_pengirim"] <> 0)
            $whr .= " AND a.id_skpd_pengirim = '" . $_POST["id_skpd_pengirim"] . "'";
        
        
        $res = mysql_query("SELECT 
                            	a.*, b.unit_kerja, c.sampul, c.kotak, c.rak
                            FROM 
                            	myapp_maintable_suratmasuk a
                            	LEFT JOIN myapp_reftable_unitkerja b ON a.id_skpd_pengirim = b.id_unit_kerja
                                LEFT JOIN myapp_archivetable_suratmasuk c ON a.id = c.id_surat_masuk
                            WHERE
                            	1 AND c.id_surat_masuk IS NOT NULL " . $whr . "
                            ORDER BY 
                            	id ASC");
        $ctr = 0;
        while($ds = mysql_fetch_array($res)){
            $ctr++;
            echo("<tr>");
                echo("<td align='center'>" . $ctr . "</td>");
                echo("<td>" . $ds["no_surat"] . "</td>");
                echo("<td>" . tglindonesia($ds["tgl_surat"]) . "</td>");
                echo("<td>" . tglindonesia($ds["tgl_terima"]) . "</td>");
                echo("<td>" . $ds["perihal_surat"] . "</td>");
                echo("<td>" . $ds["unit_kerja"] . "</td>");
                if($ds["harus_selesai"] == "0000-00-00")
                    echo("<td>[.:: === ::.]</td>");
                else
                    echo("<td>" . $ds["harus_selesai"] . "</td>");
                echo("<td>" . $ds["sampul"] . "</td>");
                echo("<td>" . $ds["kotak"] . "</td>");
                echo("<td>" . $ds["rak"] . "</td>");
                echo("<td align='center'>");
                    echo("<img src='image/information_32.png' width='18px' class='linkimage' title='Detail Surat Masuk' onclick='lihat_detail_sm(" . $ds["id"] . ", 0);'>");
                echo("</td>");
                echo("<td align='center'>");
                    echo("<img src='image/icon-disposisi.png' width='18px' class='linkimage' title='Daftar catatan disposisi' onclick='lihat_cadis_sm(" . $ds["id"] . ", 0);'>");
                echo("</td>");
                echo("<td align='center'>");
                    echo("<img src='image/Attachment-32.png' width='18px' class='linkimage' title='File yang dilampirkan' onclick='lihat_file_sm(" . $ds["id"] . ", 0);'>");
                echo("</td>");
                echo("<td align='center'>");
                    echo("<img src='image/Button Next_32.png' width='18px' class='linkimage' title='Arsipkan Surat Masuk' onclick='document.location.href=\"?mod=pengarsipan_surat_masuk&id=" . $ds["id"] . "\"'>");
                echo("</td>");
            echo("</tr>");
        }
    ?>
    </tbody>
    </table>
    </div>
</div>
<!-- DIALOG -->
<div id="dialog_form_disp" title="Lanjutkan Surat Ke Kepala Bidang Yang Dituju">
<form name="frm" action="php/posisi_surat_masuk_kaban.php" method="post">
    <div class="panelcontainer" style="width: 100%;">
        <div class="bodypanel">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <input type="hidden" name="id_surat_masuk" value="" id="id_surat_masuk" />
                <input type="hidden" name="id_disposisi" value="" id="id_disposisi" />
                <?php
                    $res_ldb = mysql_query("SELECT * FROM myapp_reftable_levelpengguna WHERE atasan='" . $_SESSION["id_level"] . "' AND id <> 2");
                    while($ds_ldb = mysql_fetch_array($res_ldb)){
                ?>
                <tr>
                    <td width='5px'><input type="checkbox" name="id_level_tujuan_<?php echo($ds_ldb["id"]); ?>" /></td>
                    <td style="text-transform: capitalize;"><?php echo($ds_ldb["level"]); ?></td>
                </tr>  
                <?php
                    }
                ?>
                <tr>
                    <td colspan="3"><textarea name="catatan" placeholder="TULIS CATATAN UNTUK SEKRETARIS DISINI"></textarea></td>
                </tr>
            </table>
            <div class="kelang"></div>
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='50%'><input type="submit" value='Kembalikan ke Sekretaris Untuk Didisposisikan' style="width: 100%;" /></td>
                </tr>
            </table>
        </div>
    </div>
</form>
</div>
<!-- END OF DIALOG -->