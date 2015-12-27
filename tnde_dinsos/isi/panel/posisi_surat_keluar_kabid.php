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
   
   $("#tgl_nodin").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
});
function munculDisposisi(id_surat_keluar, id_disposisi, no_nodin, tgl_nodin, id_ttd){
    //alert(id_surat_keluar + "\n" + id_disposisi + "\n" + no_nodin + "\n" + tgl_nodin + "\n" + id_ttd);
    /*if(id_ttd == 1){
        //$(".angkat").slideDown(50);
        $(".angkat").css("display", "block");
        //$("#no_nodin").attr("disabled", "disabled");
        //$("#tgl_nodin").attr("disabled", "disabled");
    }else{
        //$(".angkat").slideUp(50);
        $(".angkat").css("display", "none");
        //$("#no_nodin").attr("disabled", "disabled");
        //$("#tgl_nodin").attr("disabled", "disabled");
    }*/
    $("#id_surat_keluar").val(id_surat_keluar);
    $("#id_disposisi").val(id_disposisi);
    $("#no_nodin").val(no_nodin);
    $("#tgl_nodin").val(tgl_nodin);
    $("#dialog_form_disp").dialog("open");
}

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
<form name="frm" action="?mod=<?php echo($_GET["mod"]); ?>" method="post">
    <div class="panelcontainer" style="width: 100%;">
        <h3><div style="display: block; float: left;"><div style="clear: both;"></div>FILTER DATA PENCARIAN</div><input type="button" value="+" style="float: right; display: block; font-weight: bold;" id="expand" /><div style="clear: both;"></div></h3>
        <div class="bodypanel" id="bodyfilter">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='20%'>Nomor Register</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="id" value="<?php echo($_POST["id"]); ?>" /></td>
                </tr>
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
                    <td width='20%'>Tanggal Pengiriman</td>
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
                    <td width='20%'>SKPD / Unit Tujuan</td>
                    <td width='10px'>:</td>
                    <td>
                        <select name="id_skpd_pengirim">
                            <option value="0">[.. Pilih SKPD Tujuan ..]</option>
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
    <h3>DAFTAR SURAT KELUAR YANG DITERIMA</h3>
    <div class="bodypanel">
    <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
        <tr class="headertable">
            <th width='5px'>&nbsp;</th>
            <th width='40px'>No.</th>
            <th width='100px'>No. Register</th>
            <th width='200px'>No. Surat</th>
            <th width='90px'>Tgl. Surat</th>
            <th width='90px'>Tgl. Terima</th>
            <th>Perihal</th>
            <th width='200px'>Unit Pengirim</th>
            <th width='150px'>Asal Disposisi</th>
            <th width='100px'>Tipe Disposisi</th>
            <th width='20px'>&nbsp;</th>
            <th width='20px'>&nbsp;</th>
            <th width='20px'>&nbsp;</th>
            <th width='20px'>&nbsp;</th>
            <th width='20px'>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
    <?php
        $whr = "";
        if($_POST["id"] <> "")
            $whr .= " AND a.id = '" . $_POST["id"] . "'";
        if($_POST["no_surat"] <> "")
            $whr .= " AND a.no_surat LIKE '%" . $_POST["no_surat"] . "%'";
        if($_POST["tgl_surat_dari"] <> "" && $_POST["tgl_surat_sampai"] <> "")
            $whr .= " AND a.tgl_surat BETWEEN '" . $_POST["tgl_surat_dari"] . "' AND '" . $_POST["tgl_surat_sampai"] . "'";
        if($_POST["tgl_terima_dari"] <> "" && $_POST["tgl_terima_sampai"] <> "")
            $whr .= " AND a.tgl_kirim BETWEEN '" . $_POST["tgl_terima_dari"] . "' AND '" . $_POST["tgl_terima_sampai"] . "'";
        if($_POST["perihal_surat"] <> "")
            $whr .= " AND a.perihal_surat LIKE '%" . $_POST["perihal_surat"] . "%'";
        if($_POST["deskripsi_surat"] <> "")
            $whr .= " AND a.deskripsi_surat LIKE '%" . $_POST["deskripsi_surat"] . "%'";
        if($_POST["id_skpd_pengirim"] <> 0)
            $whr .= " AND a.id_skpd_tujuan = '" . $_POST["id_skpd_pengirim"] . "'";
        
        $res = mysql_query("SELECT 
                            	a.*, b.unit_kerja, c.status AS kondisi, d.level AS asal, c.id AS id_disposisi,
                                c.keadaan, e.id_surat_masuk
                            FROM 
                            	myapp_maintable_suratkeluar a
                            	LEFT JOIN myapp_reftable_unitkerja b ON a.id_skpd_tujuan = b.id_unit_kerja
                            	LEFT JOIN myapp_disptable_suratkeluar c ON a.id = c.id_surat_keluar
                            	LEFT JOIN myapp_reftable_levelpengguna d ON c.id_level_asal = d.id
                                LEFT JOIN myapp_maintable_balasan e ON a.id = e.id_surat_keluar
                            WHERE
                            	c.id_level_tujuan = '" . $_SESSION["id_level"] . "' AND c.status < 3 " . $whr . "
                            GROUP BY
                                a.id
                            ORDER BY 
                            	id ASC");
        $ctr = 0;
        while($ds = mysql_fetch_array($res)){
            $ctr++;
            echo("<tr>");
                $kondisi = "belumdibaca";
                if($ds["kondisi"] == 2)
                    $kondisi = "telahdibaca";
                echo("<td align='center'><div class='lampu " . $kondisi . "' id='kondisi_" . $ds["id"] . "'>&nbsp;</div></td>");
                echo("<td align='center'>" . $ctr . "</td>");
                echo("<td align='center'>" . no_register($ds["id"]) . "</td>");
                echo("<td>" . $ds["no_surat"] . "</td>");
                echo("<td>" . tglindonesia($ds["tgl_surat"]) . "</td>");
                echo("<td>" . tglindonesia($ds["tgl_terima"]) . "</td>");
                echo("<td>" . $ds["perihal_surat"] . "</td>");
                echo("<td>" . $ds["unit_kerja"] . "</td>");
                echo("<td>" . $ds["asal"] . "</td>");
                echo("<td>" . konversiKeadaanSK($ds["keadaan"]) . "</td>");
                echo("<td align='center'>");
                    echo("<img src='image/mail_replay-48.png' width='18px' class='linkimage' title='Data Surat Masuk Yang Dibalas' onclick='lihat_data_yg_dibalas(" . $ds["id_surat_masuk"] . ", " . $ds["id_disposisi"] . ");'>");
                echo("</td>");
                echo("<td align='center'>");
                    echo("<img src='image/information_32.png' width='18px' class='linkimage' title='Detail Surat Keluar' onclick='lihat_detail_sk(" . $ds["id"] . ", " . $ds["id_disposisi"] . ");'>");
                echo("</td>");
                echo("<td align='center'>");
                    echo("<img src='image/icon-disposisi.png' width='18px' class='linkimage' title='Daftar catatan disposisi' onclick='lihat_cadis_sk(" . $ds["id"] . ", " . $ds["id_disposisi"] . ");'>");
                echo("</td>");
                echo("<td align='center'>");
                    echo("<img src='image/Attachment-32.png' width='18px' class='linkimage' title='File yang dilampirkan' onclick='lihat_file_sk(" . $ds["id"] . ", " . $ds["id_disposisi"] . ");'>");
                echo("</td>");
                echo("<td align='center'>");
                    echo("<img src='image/send_32.png' width='18px' class='linkimage' title='Lanjutkan Disposisi' onclick='munculDisposisi(" . $ds["id"] . ", " . $ds["id_disposisi"] . ", \"" . $ds["no_nodin"] . "\", \"" . $ds["tgl_nodin"] . "\", " . $ds["id_ttd"] . ");'>");
                echo("</td>");
            echo("</tr>\n");
        }
    ?>
    </tbody>
    </table>
    </div>
</div>
<!-- DIALOG -->
<div id="dialog_form_disp" title="Lanjutkan Disposisi Surat Keluar">
<form name="frm" action="php/posisi_surat_keluar_kabid.php" method="post">
    <div class="panelcontainer" style="width: 100%;">
        <div class="bodypanel">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <input type="hidden" name="id_surat_keluar" value="" id="id_surat_keluar" />
                <input type="hidden" name="id_disposisi" value="" id="id_disposisi" />
                <tr class="angkat" style="display: none;">
                    <td width='20%'>Nomor Nota Dinas</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="no_nodin" id="no_nodin" /></td>
                </tr>
                <tr class="angkat" style="display: none;">
                    <td width='20%'>Tanggal Nota Dinas</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="tgl_nodin" id="tgl_nodin" /></td>
                </tr>
                <tr>
                    <td colspan="3"><b>Nomor nota dinas dan tanggal nota dinas diisi jika nota dinas akan ditandatangani oleh anda</b></td>
                </tr>
                <tr>
                    <td colspan="3"><textarea name="catatan" placeholder="CATATAN DISPOSISI"></textarea></td>
                </tr>  
            </table>
            <div class="kelang"></div>
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='50%'>
                        <input type="submit" name="terima" value='Lanjutkan Disposisi Keatas' style="width: 100%;" />
                    </td>
                    <td>
                        <input type="submit" name="tolak" value='Perlu Perbaikan' style="width: 100%;" />
                    </td>
                </tr>
            </table>
        </div>
    </div>
</form>
</div>
<!-- END OF DIALOG -->