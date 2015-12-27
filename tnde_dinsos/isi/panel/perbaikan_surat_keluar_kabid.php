<?php
    $judul = "";
    $tombol_ok = "";
    $tombol_tolak = "";
    if($_SESSION["id_level"] == 2){
        $judul = "DAFTAR SURAT KELUAR KABAN YANG DIPERIKSA ULANG";
        $tombol_ok = "Disposisi Ke Kaban";
        $tombol_tolak = "Perlu Perbaikan. Kembalikan Ke Bidang";
    }else{
        $judul = "DAFTAR SURAT KELUAR DARI SEKRETARIAT YANG AKAN DIPERBAIKI";
        $tombol_ok = "Disposisi Ke Sekretariat";
        $tombol_tolak = "Perlu Perbaikan. Kembalikan Ke Sub Bidang / Sub Bagian"; 
    }
?>
<script type="text/javascript">
function disposisi(id, stt){
    jConfirm("Anda yakin akan mendisposisikan data surat masuk ini?", "PERHATIAN", function(r){
        if(r){
            //var tujuan_disposisi = $("#tujuan_disposisi_" + id).val();
            var catatan = $("#catatan_" + id).val();
            //alert("KE : " + tujuan_disposisi + "\nCatatan : " + catatan);
            document.location.href = "php/perbaikan_surat_keluar_kabid.php?id=" + id + "&catatan=" + catatan + "&status=" + stt;
        }
    });
}
</script>
<div class="panelcontainer" style="width: 100%;">
    <h3><?php echo($judul); ?></h3>
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
                            	END AS tgl_pengiriman,
                                c.level
                            FROM 
                            	myapp_maintable_suratkeluar a
                            	LEFT JOIN myapp_reftable_unitkerja b ON a.id_skpd_tujuan = b.id_unit_kerja
                                LEFT JOIN myapp_reftable_levelpengguna c ON a.id_level_pembuat = c.id
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
                    <td rowspan="8" width='40px' align='center' style="background-color: #334444; color: white;"><?php echo($ctr); ?></td>
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
                    <td width='10%'>Bidang / Bagian Pembuat Surat</td>
                    <td width='10px'>:</td>
                    <td><span class="detail" style="text-transform: uppercase;"><?php echo($ds["level"]); ?></span></td>
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
                        <input type="button" value="<?php echo($tombol_ok); ?>" onclick="disposisi(<?php echo($ds["id"]) ?>, 3);" />
                        <input type="button" value="<?php echo($tombol_tolak); ?>" onclick="disposisi(<?php echo($ds["id"]) ?>, 4);" />
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