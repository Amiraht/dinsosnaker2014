<form name="frm" action="isi/cetak_laporan/kotak.php" method="post" target="_blank">
    <div class="panelcontainer" style="width: 100%;">
        <h3>CETAK INFORMASI KOTAK</h3>
        <div class="bodypanel" id="bodyfilter">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='10%'>Nomor Kotak</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="text" name="box" value="" />
                    </td>
                </tr>
                <tr>
                    <td width='10%'>Masalah</td>
                    <td width='10px'>:</td>
                    <td>
                        <select name="id_masalah">
                            <option value="0">[.. Pilih Masalah ..]</option>
                        <?php
                            $res_skpd = mysql_query("SELECT * FROM ref_masalah ORDER BY id_masalah ASC");
                            while($ds_skpd = mysql_fetch_array($res_skpd)){
                                echo("<option value='" . $ds_skpd["masalah"] . "'>(" . $ds_skpd["kode_masalah"] . ") " . $ds_skpd["masalah"] . "</option>");
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
                    <td width='10%'>No. Bungkus</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="text" name="sampul" value="" />
                    </td>
                </tr>
            </table>
            <div class="kelang"></div>
            <table border="0px" cellspacing='0' cellpadding='0' width='40%'>
                <tr>
                    <td width='33%'><input type="submit" value='Cetak' style="width: 100%;" /></td>
                    <td width='33%'><input type="reset" value='Reset' style="width: 100%;" /></td>
                </tr>
            </table>
        </div>
    </div>
</form>