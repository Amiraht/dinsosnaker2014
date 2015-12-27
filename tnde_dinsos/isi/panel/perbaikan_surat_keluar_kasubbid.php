<script type="text/javascript">
function disposisi(id){
    jConfirm("Anda yakin akan mendisposisikan data surat masuk ini?", "PERHATIAN", function(r){
        if(r){
            var catatan = $("#catatan_" + id).val();
            //alert("KE : " + tujuan_disposisi + "\nCatatan : " + catatan);
            document.location.href = "php/hasil_surat_keluar_kasubbid.php?id=" + id + "&catatan=" + catatan;
        }
    });
}
</script>
<div class="panelcontainer" style="width: 100%;">
    <h3>DAFTAR SURAT KELUAR YANG PERLU PERBAIKAN</h3>
    <div class="bodypanel">
    <?php
        $res = mysql_query("SELECT 
                            	a.*, b.unit_kerja,
                                CASE
                            		WHEN a.no_surat = '' THEN '[[ Belum ditentukan ]]'
                            		ELSE a.no_surat
                            	END AS nomor_surat,
                                CASE
                            		WHEN a.tgl_kirim = '0000-00-00' THEN '[[ Belum ditentukan ]]'
                            		ELSE a.tgl_kirim
                            	END AS tgl_pengiriman
                            FROM 
                            	myapp_maintable_suratkeluar a
                            	LEFT JOIN myapp_reftable_unitkerja b ON a.id_skpd_tujuan = b.id_unit_kerja
                            WHERE
                                status = 2 AND tujuan_disposisi = $_SESSION[id_level]
                            ORDER BY 
                            	id ASC");
        $ctr = 0;
        while($ds = mysql_fetch_array($res)){
            $ctr++;
            echo("<div class='listingcontent'>");
            ?>
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td rowspan="7" width='40px' align='center' style="background-color: #334444; color: white;"><?php echo($ctr); ?></td>
                    <td width='10%'>Nomor Surat</td>
                    <td width='10px'>:</td>
                    <td><span class="detail"><?php echo($ds["nomor_surat"]); ?></span></td>
                </tr>
                <tr>
                    <td width='10%'>Tanggal Surat</td>
                    <td width='10px'>:</td>
                    <td><span class="detail"><?php echo($ds["tgl_surat"]); ?></span></td>
                </tr>
                <tr>
                    <td width='10%'>Tanggal Pengiriman</td>
                    <td width='10px'>:</td>
                    <td><span class="detail"><?php echo($ds["tgl_pengiriman"]); ?></span></td>
                </tr>
                <tr>
                    <td width='10%'>Perihal</td>
                    <td width='10px'>:</td>
                    <td><span class="detail"><?php echo($ds["perihal_surat"]); ?></span></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <input type="button" class="tombolkecil" value="Lihat Catatan Disposisi" onclick="lihat_cadis_sk(<?php echo($ds["id"]) ?>);" />
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <textarea id="catatan_<?php echo($ds["id"]); ?>" placeholder="Berikan Catatan Pada Disposisi"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <input type="button" value="Laporan Perbaikan Proses Telah Selesai Ke Bidang" onclick="disposisi(<?php echo($ds["id"]) ?>);" />
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