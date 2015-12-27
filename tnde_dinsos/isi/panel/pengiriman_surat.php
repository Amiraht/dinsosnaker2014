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
        
   $("#dialog_nosur").dialog({
            autoOpen: false,
			height: "auto",
			width: 700,
			modal: true,
            show: "fade",
			hide: "fade"
        });
   
   $("#dialog_parkor").dialog({
            autoOpen: false,
			height: "auto",
			width: 700,
			modal: true,
            show: "fade",
			hide: "fade"
        });
    
    $("#cmdKirim").click(function(){
        jConfirm("Anda yakin surat ini akan dikirimkan ke tujuan?", "PERHATIAN", function(r){
           if(r){
                $("#frm_kirim_surat").submit();
           }else{
                return false;
           }
            
        });
        //return false;
    });
    
    $("#cmdJangan").click(function(){
        $("#dialog_form_disp").dialog("close");
    });
});
function munculDisposisi(id_surat_keluar, id_disposisi, no_nodin, tgl_nodin){
    $("#id_surat_keluar").val(id_surat_keluar);
    $("#id_disposisi").val(id_disposisi);
    $("#no_nodin").val(no_nodin);
    $("#tgl_nodin").val(tgl_nodin);
    $("#dialog_form_disp").dialog("open");
}

function munculNosur(id_surat_keluar, nosur, kode_masalah, kode_sub_masalah){
    //alert(id_surat_keluar);
    $("#id_surat_keluar_nosur").val(id_surat_keluar);
    $("#no_surat").val(nosur);
    $("#dialog_nosur").dialog("open");
    var kode_surat = kode_masalah;
    if(kode_sub_masalah != "")
        kode_surat += "." + kode_sub_masalah;
    $("#kode_surat").html(kode_surat);
    $("#kodsur").val(kode_surat);
}

function munculParkor(id_surat_masuk){
    var judul = "Paraf Koordinasi";
        $("#dialog_parkor").dialog("open");
        $("#dialog_parkor").html("");
        $("#dialog_parkor").attr("title", "Loading...");
        $.ajax({
            type: "GET",
            url: "ajax/paraf_koordinasi.php",
            data: "id=" + id_surat_masuk,
            success: function(r){
                //alert(r);
                $("#dialog_parkor").attr("title", judul);
                $("#dialog_parkor").html(r);
            }
        });
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
                <tr>
                    <td width='20%'>Filter Berdasarkan</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="radio" name="ftype" value="1" <?php if($_POST["ftype"]==1 || empty($_POST["ftype"]))echo("checked='checked'"); ?> />Surat Keluar<br />
                        <input type="radio" name="ftype" value="2" <?php if($_POST["ftype"]==2)echo("checked='checked'"); ?> />Surat Masuk Yang Dibalas
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
            <th width='20px'>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
    <?php
        $whr = "";
        $sql = "";
        if($_POST["ftype"] == 1 || empty($_POST["ftype"])){
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
            
            $sql = "SELECT 
                    	a.*, b.unit_kerja, 'Siap Untuk Pengiriman' AS kondisi, 'Kepala Badan' AS asal, 0 AS id_disposisi,
                        1 AS keadaan, c.kode_masalah, d.kode
                    FROM 
                    	myapp_maintable_suratkeluar a
                    	LEFT JOIN myapp_reftable_unitkerja b ON a.id_skpd_tujuan = b.id_unit_kerja
                        LEFT JOIN myapp_reftable_masalah c ON a.id_masalah = c.id_masalah
                        LEFT JOIN myapp_reftable_jenissurat d ON a.id_jenis_surat = d.id_jenis_surat
                    WHERE
                    	a.status = 2 AND a.id_pengguna_pembuat='" . $_SESSION["id_pengguna"] . "' " . $whr . "
                    ORDER BY 
                    	id ASC";
        }else if($_POST["ftype"] == 2){
            if($_POST["id"] <> "")
                $whr .= " AND f.id = '" . $_POST["id"] . "'";
            if($_POST["no_surat"] <> "")
                $whr .= " AND f.no_surat LIKE '%" . $_POST["no_surat"] . "%'";
            if($_POST["tgl_surat_dari"] <> "" && $_POST["tgl_surat_sampai"] <> "")
                $whr .= " AND f.tgl_surat BETWEEN '" . $_POST["tgl_surat_dari"] . "' AND '" . $_POST["tgl_surat_sampai"] . "'";
            if($_POST["tgl_terima_dari"] <> "" && $_POST["tgl_terima_sampai"] <> "")
                $whr .= " AND f.tgl_kirim BETWEEN '" . $_POST["tgl_terima_dari"] . "' AND '" . $_POST["tgl_terima_sampai"] . "'";
            if($_POST["perihal_surat"] <> "")
                $whr .= " AND f.perihal_surat LIKE '%" . $_POST["perihal_surat"] . "%'";
            if($_POST["deskripsi_surat"] <> "")
                $whr .= " AND f.deskripsi_surat LIKE '%" . $_POST["deskripsi_surat"] . "%'";
            if($_POST["id_skpd_pengirim"] <> 0)
                $whr .= " AND f.id_skpd_tujuan = '" . $_POST["id_skpd_pengirim"] . "'";
            
            $sql = "SELECT 
                    	a.*, b.unit_kerja, 'Siap Untuk Pengiriman' AS kondisi, 'Kepala Badan' AS asal, 0 AS id_disposisi,
                    	1 AS keadaan, c.kode_masalah, d.kode, f.no_surat
                    FROM 
                    	myapp_maintable_suratkeluar a
                    	LEFT JOIN myapp_reftable_unitkerja b ON a.id_skpd_tujuan = b.id_unit_kerja
                    	LEFT JOIN myapp_reftable_masalah c ON a.id_masalah = c.id_masalah
                    	LEFT JOIN myapp_reftable_jenissurat d ON a.id_jenis_surat = d.id_jenis_surat
                    	LEFT JOIN myapp_maintable_balasan e ON a.id = e.id_surat_keluar
                    	LEFT JOIN myapp_maintable_suratmasuk f ON e.id_surat_masuk = f.id
                    WHERE
                    	a.status = 2 AND a.id_pengguna_pembuat='" . $_SESSION["id_pengguna"] . "' " . $whr . "
                    GROUP BY
                    	a.id
                    ORDER BY
                    	f.id ASC";
        }
        //echo($sql);
        $res = mysql_query($sql);
        $ctr = 0;
        while($ds = mysql_fetch_array($res)){
            $nosur = explode("/", $ds["no_surat"]);
            
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
                    echo("<img src='image/information_32.png' width='18px' class='linkimage' title='Detail Surat Keluar' onclick='lihat_detail_sk(" . $ds["id"] . ", " . $ds["id_disposisi"] . ");'>");
                echo("</td>");
                echo("<td align='center'>");
                    echo("<img src='image/Edit-32.png' width='15px' class='linkimage' title='Pemberian Nomor Surat Keluar' onclick='munculNosur(" . $ds["id"] . ", \"" . $nosur[1] . "\", \"" . $ds["kode_masalah"] . "\", \"" . $ds["kode"] . "\");'>");
                echo("</td>");
                echo("<td align='center'>");
                    echo("<img src='image/icon-disposisi.png' width='18px' class='linkimage' title='Daftar catatan disposisi' onclick='lihat_cadis_sk(" . $ds["id"] . ", " . $ds["id_disposisi"] . ");'>");
                echo("</td>");
                /*echo("<td align='center'>");
                    echo("<img src='image/Upload-Blue-48.png' width='18px' class='linkimage' title='Upload File Final' onclick='document.location.href=\"?mod=file_final_surat_keluar&id=" . $ds["id"] . "\";'>");
                echo("</td>");*/
                echo("<td align='center'>");
                    echo("<img src='image/Attachment-32.png' width='18px' class='linkimage' title='File yang dilampirkan' onclick='lihat_file_sk(" . $ds["id"] . ", " . $ds["id_disposisi"] . ");'>");
                echo("</td>");
                echo("<td align='center'>");
                    echo("<img src='image/Text-Signature-32.png' width='18px' class='linkimage' title='Paraf Koordinasi' onclick='munculParkor(" . $ds["id"] . ");'>");
                echo("</td>");
                echo("<td align='center'>");
                    echo("<img src='image/send_32.png' width='18px' class='linkimage' title='Lanjutkan Pengiriman Surat' onclick='munculDisposisi(" . $ds["id"] . ", " . $ds["id_disposisi"] . ", \"" . $ds["no_nodin"] . "\", \"" . $ds["tgl_nodin"] . "\");'>");
                echo("</td>");
            echo("</tr>\n");
        }
    ?>
    </tbody>
    </table>
    </div>
</div>
<!-- DIALOG -->
<div id="dialog_form_disp" title="Kirim Surat">
<form name="frm" id="frm_kirim_surat" action="php/pengiriman_surat.php" method="post">
    <div class="panelcontainer" style="width: 100%;">
        <div class="bodypanel">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <input type="hidden" name="id_surat_keluar" value="" id="id_surat_keluar" />
                <input type="hidden" name="id_disposisi" value="" id="id_disposisi" />
                <tr style="display: none;">
                    <td width='20%'>Nomor Nota Dinas</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="no_nodin" id="no_nodin" /></td>
                </tr>
                <tr style="display: none;">
                    <td width='20%'>Tanggal Nota Dinas</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="tgl_nodin" id="tgl_nodin" /></td>
                </tr>
                <tr>
                    <td colspan="3">
                        Anda yakin bahwa surat keluar ini telah selesai diproses dan akan dikirimkan ke tujuan?
                    </td>
                </tr>
            </table>
            <div class="kelang"></div>
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='50%'>
                        <input type="button" name="terima" value='Ya' id="cmdKirim" style="width: 100%;" />
                    </td>
                    <td width='50%'>
                        <input type="button" name="ya" value='Tidak' id="cmdJangan" style="width: 100%;" />
                    </td>
                </tr>
            </table>
        </div>
    </div>
</form>
</div>

<div id="dialog_nosur" title="Penomoran Surat Keluar">
    <form name="frm" action="php/penomoran_surat_keluar.php" method="post">
        <div class="panelcontainer" style="width: 100%;">
            <div class="bodypanel">
                <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <input type="hidden" name="id_surat_keluar" value="" id="id_surat_keluar_nosur" />
                <tr>
                    <td width='20%'>Nomor Surat</td>
                    <td width='10px'>:</td>
                    <td width='50px' align='right'><span id="kode_surat">989.00</span>/</td>
                    <input type="hidden" name="kode_surat" id="kodsur" />
                    <td><input type="text" name="no_surat" id="no_surat" /></td>
                </tr>
                <tr>
                    <td colspan="4"><b>Nomor surat harus sesuai dengan nomor fisik pada keadaan surat keluar yang sebenarnya</b></td>
                </tr>  
            </table>
            <div class="kelang"></div>
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td>
                        <input type="submit" value='Simpan Nomor Surat' style="width: 100%;" />
                    </td>
                </tr>
            </table>
            </div>
        </div>
    </form>
</div>

<div id="dialog_parkor" title="Paraf Koordinasi">
</div>
<!-- END OF DIALOG -->