<script type="text/javascript">
$(document).ready(function(){
    $("#tgl_surat").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
    $("#tgl_terima").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
    $("#harus_selesai").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
});

function loadsubmasalah(id_masalah){
    //alert(id_masalah);
    $("#id_jenis_surat").html("<option value='0'>[.. Pilih Sub Masalah ..]</option>");
    $.ajax({
        type: "GET",
        url: "ajax/submasalah.php",
        data: "id_masalah=" + id_masalah,
        success: function(r){
            //alert(r);
            $("#id_jenis_surat").append(r);
        }
    });
}
</script>
<form name="frm" action="php/cp_edit_sm.php" method="post">
    <div class="panelcontainer" style="width: 100%;">
        <h3>EDIT DATA SURAT MASUK</h3>
        <div class="bodypanel">
            <?php
                $res_sm = mysql_query("SELECT * FROM myapp_maintable_suratmasuk WHERE id='" . $_GET["id"] . "'");
                $ds_sm = mysql_fetch_array($res_sm);
            ?>
            <input type="hidden" name="id" value="<?php echo($_GET["id"]); ?>" />
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='20%'>Nomor Surat</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="no_surat" value="<?php echo($ds_sm["no_surat"]); ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Tanggal Surat</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="tgl_surat" id="tgl_surat" value="<?php echo($ds_sm["tgl_surat"]); ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Tanggal Terima</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="tgl_terima" id="tgl_terima" value="<?php echo($ds_sm["tgl_terima"]); ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Perihal</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="perihal_surat" value="<?php echo($ds_sm["perihal_surat"]); ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Pengirim</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="pengirim_surat" value="<?php echo($ds_sm["pengirim_surat"]); ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Alamat Pengirim</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="alamat_pengirim" value="<?php echo($ds_sm["alamat_pengirim"]); ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Judul Surat</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="judul_surat" value="<?php echo($ds_sm["judul_surat"]); ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Deskripsi Surat</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="deskripsi_surat" value="<?php echo($ds_sm["deskripsi_surat"]); ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Catatan Tambahan</td>
                    <td width='10px'>:</td>
                    <td><textarea name="catatan"><?php echo($ds_sm["catatan"]); ?></textarea></td>
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
                                if($ds_skpd["id_unit_kerja"] == $ds_sm["id_skpd_pengirim"])
                                    echo("<option value='" . $ds_skpd["id_unit_kerja"] . "' selected='selected'>" . $ds_skpd["unit_kerja"] . "</option>");
                                else
                                    echo("<option value='" . $ds_skpd["id_unit_kerja"] . "'>" . $ds_skpd["unit_kerja"] . "</option>");
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width='20%'>Masalah</td>
                    <td width='10px'>:</td>
                    <td>
                        <select name="id_masalah" onchange="loadsubmasalah(this.value);">
                            <option value="0">[.. Pilih Masalah ..]</option>
                        <?php
                            $res_masalah= mysql_query("SELECT * FROM myapp_reftable_masalah ORDER BY kode_masalah ASC");
                            while($ds_masalah = mysql_fetch_array($res_masalah)){
                                if($ds_masalah["id_masalah"] == $ds_sm["id_masalah"])
                                    echo("<option value='" . $ds_masalah["id_masalah"] . "' selected='selected'>(" . $ds_masalah["kode_masalah"] . ") " . $ds_masalah["masalah"] . "</option>");
                                else
                                    echo("<option value='" . $ds_masalah["id_masalah"] . "'>(" . $ds_masalah["kode_masalah"] . ") " . $ds_masalah["masalah"] . "</option>");
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width='20%'>Sub Masalah</td>
                    <td width='10px'>:</td>
                    <td>
                        <select name="id_jenis_surat" id="id_jenis_surat">
                            <option value="0">[.. Pilih Sub Masalah ..]</option>
                        <?php
                            $res_js= mysql_query("SELECT * FROM myapp_reftable_jenissurat WHERE id_masalah='" . $ds_sm["id_masalah"] . "' ORDER BY kode ASC");
                            while($ds_js = mysql_fetch_array($res_js)){
                                if($ds_js["id_jenis_surat"] == $ds_sm["id_jenis_surat"])
                                    echo("<option value='" . $ds_js["id_jenis_surat"] . "' selected='selected'>(" . $ds_js["kode"] . ") " . $ds_js["jenis_surat"] . "</option>");
                                else
                                    echo("<option value='" . $ds_js["id_jenis_surat"] . "'>(" . $ds_js["kode"] . ") " . $ds_js["jenis_surat"] . "</option>");
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width='20%'>Harus Selesai Pada<br /><span class="footnote">*) Kosongkan jika tidak perlu ditindak lanjuti</span></td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="harus_selesai" id="harus_selesai" value="<?php echo($ds_sm["harus_selesai"]); ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Indeks</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="indeks" value="<?php echo($ds_sm["indeks"]); ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Kode</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="kode" value="<?php echo($ds_sm["kode"]); ?>" /></td>
                </tr>
            </table>
            <br />
            
            <table border="0px" cellspacing='0' cellpadding='0' width='80%'>
                <tr>
                    <td width='30%'><input type="submit" value='Simpan' style="width: 100%;" /></td>
                    <td width='30%'><input type="reset" value='Reset' style="width: 100%;" /></td>
                    <td width='40%'><input type="button" value='Edit File Bukti / Pendukung Dan Cetak Resi' style="width: 100%;" onclick="document.location.href='?mod=file_surat_masuk&id=<?php echo($_GET["id"]); ?>&redir=cp_edit_sm';" /></td>
                </tr>
            </table>
        </div>
    </div>
</form>