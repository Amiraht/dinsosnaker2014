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
</script>
<form name="frm" action="php/edit_surat_keluar.php" method="post">
    <div class="panelcontainer" style="width: 100%;">
        <h3>DETAIL DATA SURAT KELUAR</h3>
        <div class="bodypanel">
            <?php
                $ds = mysql_fetch_array(mysql_query("SELECT * FROM myapp_maintable_suratkeluar WHERE id='$_GET[id]'"));
            ?>
            <input type="hidden" name="id" value="<?php echo($_GET["id"]); ?>" />
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='20%'>Nomor Surat</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="no_surat" value="<?php echo($ds["no_surat"]); ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Tanggal Surat</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="tgl_surat" id="tgl_surat" value="<?php echo($ds["tgl_surat"]); ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Tanggal Pengiriman</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="tgl_terima" id="tgl_terima" value="<?php echo($ds["tgl_kirim"]); ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Perihal</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="perihal_surat" value="<?php echo($ds["perihal_surat"]); ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Tujuan</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="tujuan_surat" value="<?php echo($ds["tujuan_surat"]); ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Alamat Tujuan</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="alamat_tujuan" value="<?php echo($ds["alamat_tujuan"]); ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Judul Surat</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="judul_surat" value="<?php echo($ds["judul_surat"]); ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Deskripsi Surat</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="deskripsi_surat" value="<?php echo($ds["deskripsi_surat"]); ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Catatan Tambahan</td>
                    <td width='10px'>:</td>
                    <td><textarea name="catatan"><?php echo($ds["catatan"]); ?></textarea></td>
                </tr>
                <tr>
                    <td width='20%'>SKPD / Unit Tujuan</td>
                    <td width='10px'>:</td>
                    <td>
                        <select name="id_skpd_tujuan">
                            <option value="0">[.. Pilih SKPD Tujuan ..]</option>
                        <?php
                            $res_skpd = mysql_query("SELECT * FROM myapp_reftable_unitkerja ORDER BY unit_kerja ASC");
                            while($ds_skpd = mysql_fetch_array($res_skpd)){
                                if($ds_skpd["id_unit_kerja"] == $ds["id_skpd_tujuan"])
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
                        <select name="id_masalah">
                            <option value="0">[.. Pilih Masalah ..]</option>
                        <?php
                            $res_masalah= mysql_query("SELECT * FROM myapp_reftable_masalah ORDER BY masalah ASC");
                            while($ds_masalah = mysql_fetch_array($res_masalah)){
                                if($ds_masalah["id_masalah"] == $ds["id_masalah"])
                                    echo("<option value='" . $ds_masalah["id_masalah"] . "' selected='selected'>" . $ds_masalah["masalah"] . "</option>");
                                else
                                    echo("<option value='" . $ds_masalah["id_masalah"] . "'>" . $ds_masalah["masalah"] . "</option>");
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width='20%'>Jenis Surat</td>
                    <td width='10px'>:</td>
                    <td>
                        <select name="id_jenis_surat">
                            <option value="0">[.. Pilih Jenis Surat ..]</option>
                        <?php
                            $res_js= mysql_query("SELECT * FROM myapp_reftable_jenissurat ORDER BY jenis_surat ASC");
                            while($ds_js = mysql_fetch_array($res_js)){
                                if($ds_js["id_jenis_surat"] == $ds["id_jenis_surat"])
                                    echo("<option value='" . $ds_js["id_jenis_surat"] . "' selected='selected'>" . $ds_js["jenis_surat"] . "</option>");
                                else
                                    echo("<option value='" . $ds_js["id_jenis_surat"] . "'>" . $ds_js["jenis_surat"] . "</option>");
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                
            </table>
            <br />
            
            <table border="0px" cellspacing='0' cellpadding='0' width='20%'>
                <tr>
                    <td width='50%'><input type="button" value='Kembali' style="width: 100%;" onclick="document.location.href='?mod=<?php echo($_GET["redir"]); ?>';" /></td>
                </tr>
            </table>
        </div>
    </div>
</form>