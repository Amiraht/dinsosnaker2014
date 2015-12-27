<script type="text/javascript">
function disposisi(id, stt){
    jConfirm("Anda yakin akan mendisposisikan data surat masuk ini?", "PERHATIAN", function(r){
        if(r){
            var tujuan_disposisi = $("#tujuan_disposisi_" + id).val();
            var catatan = $("#catatan_" + id).val();
            //alert("KE : " + tujuan_disposisi + "\nCatatan : " + catatan);
            document.location.href = "php/perbaikan_surat_masuk_kabid.php?id=" + id + "&catatan=" + catatan + "&status=" + stt + "&tujuan_disposisi=" + tujuan_disposisi;
        }
    });
}
</script>
<div class="panelcontainer" style="width: 100%;">
    <h3>DAFTAR SURAT MASUK YANG PERLU DIPROSES ULANG</h3>
    <div class="bodypanel">
    <?php
        $res = mysql_query("SELECT 
                            	a.*, b.unit_kerja
                            FROM 
                            	myapp_maintable_suratmasuk a
                            	LEFT JOIN myapp_reftable_unitkerja b ON a.id_skpd_pengirim = b.id_unit_kerja
                            WHERE
                                status = 4 AND tujuan_disposisi = $_SESSION[id_level]
                            ORDER BY 
                            	id ASC");
        $ctr = 0;
        while($ds = mysql_fetch_array($res)){
            $ctr++;
            echo("<div class='listingcontent'>");
            ?>
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td rowspan="8" width='40px' align='center' style="background-color: #334444; color: white;"><?php echo($ctr); ?></td>
                    <td width='10%'>Nomor Surat</td>
                    <td width='10px'>:</td>
                    <td><span class="detail"><?php echo($ds["no_surat"]); ?></span></td>
                </tr>
                <tr>
                    <td width='10%'>Tanggal Surat</td>
                    <td width='10px'>:</td>
                    <td><span class="detail"><?php echo($ds["tgl_surat"]); ?></span></td>
                </tr>
                <tr>
                    <td width='10%'>Tanggal Terima</td>
                    <td width='10px'>:</td>
                    <td><span class="detail"><?php echo($ds["tgl_terima"]); ?></span></td>
                </tr>
                <tr>
                    <td width='10%'>Perihal</td>
                    <td width='10px'>:</td>
                    <td><span class="detail"><?php echo($ds["perihal_surat"]); ?></span></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <input type="button" class="tombolkecil" value="Lihat Catatan Disposisi" onclick="lihat_cadis_sm(<?php echo($ds["id"]) ?>);" />
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                    <select id="tujuan_disposisi_<?php echo($ds["id"]); ?>">
                        <option value="0">[.. Pilih Tujuan Disposisi Jika Ingin Menyerahkan ke Sub Bidang / Sub Bagian ..]</option>
                    <?php
                        $res_ldb = mysql_query("SELECT * FROM myapp_reftable_levelpengguna WHERE atasan='" . $_SESSION["id_level"] . "'");
                        while($ds_ldb = mysql_fetch_array($res_ldb)){
                            echo("<option value='" . $ds_ldb["id"] . "'>" . $ds_ldb["level"] . "</option>");
                        }
                    ?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <textarea id="catatan_<?php echo($ds["id"]); ?>" placeholder="Berikan Catatan Pada Disposisi"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <input type="button" value="Laporan Selesai Proses Ke Kepala Badan" onclick="disposisi(<?php echo($ds["id"]) ?>, 3);" />
                        <input type="button" value="Serahkan Perbaikan Hasil Proses Ke Sub Bidang / Sub Bagian" onclick="disposisi(<?php echo($ds["id"]) ?>, 4);" />
                    </td>
                </tr>
            </table>
            <?php
            echo("</div>");
        }
    ?>
    </table>
    </div>
</div>