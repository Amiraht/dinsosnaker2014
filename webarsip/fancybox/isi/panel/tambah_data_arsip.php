<form name="frm" action="php/tambah_data_arsip.php" method="post">
    <div class="panelcontainer" style="width: 100%;">
        <h3>TAMBAH DATA ARSIP AKTIF</h3>
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
                        <input type="text" name="tahun" value="" />
                    </td>
                </tr>
                <tr>
                    <td width='10%'>Deskripsi</td>
                    <td width='10px'>:</td>
                    <td>
                        <textarea name="uraian"></textarea>
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
                        <input type="text" name="keadaan" value="" />
                    </td>
                </tr>
                <tr>
                    <td width='10%'>Sampul</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="text" name="sampul" value="" />
                    </td>
                </tr>
                <tr>
                    <td width='10%'>Kotak</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="text" name="box" value="" />
                    </td>
                </tr>
                <tr>
                    <td width='10%'>Rak</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="text" name="rak" value="" />
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