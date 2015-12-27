<script type="text/javascript">
function hapus(id){
    jConfirm("Anda yakin akan menghapus data ini?", "PERHATIAN", function(r){
        if(r){
            //alert("dihapus " + id);
            document.location.href = "php/hapus_surat_keluar.php?id=" + id;
        }
    });
}
function edit(id){
    document.location.href = "?mod=edit_surat_keluar&id=" + id;
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
    <h3>REKAPITULASI SURAT KELUAR YANG TELAH DIARSIPKAN</h3>
    <div class="bodypanel">
    <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
        <tr class="headertable">
            <th width='40px'>No.</th>
            <th width='100px'>No. Register</th>
            <th width='250px'>No. Surat</th>
            <th width='150px'>Tgl. Surat</th>
            <th width='150px'>Tgl. Kirim</th>
            <th>Perihal</th>
            <th width='250px'>Unit Tujuan</th>
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
            
        $tmbh = "";
        
        $res = mysql_query("SELECT 
                            	a.*, b.unit_kerja,
                            		CASE
                            		WHEN a.no_surat = '' THEN '[[ Belum ditentukan ]]'
                            		ELSE a.no_surat
                            	END AS nomor_surat,
                            		CASE
                            		WHEN a.tgl_kirim = '0000-00-00' THEN '[[ Belum ditentukan ]]'
                            		ELSE	a.tgl_kirim
                            	END AS tgl_pengiriman
                            FROM 
                            	myapp_maintable_suratkeluar a
                            	LEFT JOIN myapp_reftable_unitkerja b ON a.id_skpd_tujuan = b.id_unit_kerja
                            	LEFT JOIN myapp_disptable_suratkeluar c ON a.id = c.id_surat_keluar
                                LEFT JOIN myapp_archivetable_suratkeluar d ON a.id = d.id_surat_keluar
                            WHERE
                            		1 AND d.id_surat_keluar IS NOT NULL  " . $whr . " " . $tmbh . "
                            GROUP BY
                            	a.id
                            ORDER BY 
                            	a.id ASC");
        
        $ctr = 0;
        while($ds = mysql_fetch_array($res)){
            $ctr++;
            echo("<tr>");
                echo("<td align='center'>" . $ctr . "</td>");
                echo("<td align='center'>" . no_register($ds["id"]) . "</td>");
                echo("<td>" . $ds["nomor_surat"] . "</td>");
                echo("<td>" . tglindonesia($ds["tgl_surat"]) . "</td>");
                echo("<td>" . tglindonesia($ds["tgl_pengiriman"]) . "</td>");
                echo("<td>" . $ds["perihal_surat"] . "</td>");
                echo("<td>" . $ds["unit_kerja"] . "</td>");
                echo("<td align='center'>");
                    echo("<img src='image/information_32.png' width='18px' class='linkimage' title='Detail Surat Keluar' onclick='lihat_detail_ska(" . $ds["id"] . ");'>");
                echo("</td>");
                echo("<td align='center'>");
                    echo("<img src='image/icon-disposisi.png' width='18px' class='linkimage' title='Daftar catatan disposisi' onclick='lihat_cadis_sk(" . $ds["id"] . ");'>");
                echo("</td>");
                echo("<td align='center'>");
                    echo("<img src='image/Attachment-32.png' width='18px' class='linkimage' title='File yang dilampirkan' onclick='lihat_file_sk(" . $ds["id"] . ");'>");
                echo("</td>");
            echo("</tr>");
        }
    ?>
        </tbody>
    </table>
    </div>
</div>