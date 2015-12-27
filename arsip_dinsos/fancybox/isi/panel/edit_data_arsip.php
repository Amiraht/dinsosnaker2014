<?php
    $ds_arsip = mysql_fetch_array(mysql_query("SELECT * FROM tbl_benda_arsip WHERE id_arsip='" . $_GET["id"] . "'"));
?>
<form name="frm" action="php/edit_data_arsip.php" method="post">
    <input type="hidden" name="id" value="<?php echo($_GET["id"]); ?>" />
    <div class="panelcontainer" style="width: 100%;">
        <h3>EDIT DATA ARSIP AKTIF</h3>
        <div class="bodypanel" id="bodyfilter">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='10%'>Masalah</td>
                    <td width='10px'>:</td>
                    <td>
                        <select name="id_masalah">
                            <option value="0">[.. Pilih Masalah ..]</option>
                        <?php
                            $res_skpd = mysql_query("SELECT * FROM ref_masalah ORDER BY id_masalah ASC");
                            while($ds_skpd = mysql_fetch_array($res_skpd)){
                                if($ds_arsip["id_masalah"] == $ds_skpd["id_masalah"])
                                    echo("<option selected='selected' value='" . $ds_skpd["id_masalah"] . "'>(" . $ds_skpd["kode_masalah"] . ") " . $ds_skpd["masalah"] . "</option>");
                                else
                                    echo("<option value='" . $ds_skpd["id_masalah"] . "'>(" . $ds_skpd["kode_masalah"] . ") " . $ds_skpd["masalah"] . "</option>");
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width='10%'>Tahun</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="text" name="tahun" value="<?php echo($ds_arsip["tahun"]); ?>" />
                    </td>
                </tr>
                <tr>
                    <td width='10%'>Deskripsi</td>
                    <td width='10px'>:</td>
                    <td>
                        <textarea name="uraian"><?php echo($ds_arsip["uraian"]); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td width='10%'>Keterangan</td>
                    <td width='10px'>:</td>
                    <td>
                        <select name="keterangan">
                            <option value="0">[.. Pilih Keterangan ..]</option>
                        <?php
                            $res_skpd = mysql_query("SELECT * FROM ref_keterangan_benda_arsip ORDER BY id_keterangan_benda_arsip ASC");
                            while($ds_skpd = mysql_fetch_array($res_skpd)){
                                    if($ds_arsip["keterangan"] == $ds_skpd["keterangan_benda_arsip"])
                                        echo("<option selected='selected' value='" . $ds_skpd["keterangan_benda_arsip"] . "'>" . $ds_skpd["keterangan_benda_arsip"] . "</option>");
                                    else
                                        echo("<option value='" . $ds_skpd["keterangan_benda_arsip"] . "'>" . $ds_skpd["keterangan_benda_arsip"] . "</option>");
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width='10%'>Keadaan</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="text" name="keadaan" value="<?php echo($ds_arsip["keadaan"]); ?>" />
                    </td>
                </tr>
                <tr>
                    <td width='10%'>Sampul</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="text" name="sampul" value="<?php echo($ds_arsip["sampul"]); ?>" />
                    </td>
                </tr>
                <tr>
                    <td width='10%'>Kotak</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="text" name="box" value="<?php echo($ds_arsip["box"]); ?>" />
                    </td>
                </tr>
                <tr>
                    <td width='10%'>Rak</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="text" name="rak" value="<?php echo($ds_arsip["rak"]); ?>" />
                    </td>
                </tr>
                <tr>
                    <td width='10%'>&nbsp;</td>
                    <td width='10px'>&nbsp;</td>
                    <td>
                        <b>Arsip aktif adalah arsip yang belum dikumpulkan oleh pihak Kantor Arsip Pemerintah Kota Medan,
                        tetapi arsip masih berada pada Kantor/Unit Kerja/SKPD yang bersangkutan. Dan ketika berkas arsip
                        telah dikumpulkan, maka kemudian data lokasi penyimpanan arsip (sampul, kotak, rak)
                        akan diinput oleh pihak Kantor Arsip.</b>
                    </td>
                </tr>
            </table>
            <div class="kelang"></div>
            <table border="0px" cellspacing='0' cellpadding='0' width='40%'>
                <tr>
                    <td width='33%'><input type="submit" value='Simpan' style="width: 100%;" /></td>
                    <td width='33%'><input type="reset" value='Reset' style="width: 100%;" /></td>
                    <td width='33%'><input type="button" value='Kembali' style="width: 100%;" onclick="document.location.href='?mod=data_arsip';" /></td>
                </tr>
            </table>
        </div>
    </div>
</form>