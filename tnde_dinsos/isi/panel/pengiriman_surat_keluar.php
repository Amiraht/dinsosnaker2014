<script type="text/javascript">
function disposisi(id){
    var no_surat = $("#no_surat_" + id).val();
    var tgl_kirim = $("#tgl_kirim_" + id).val();
    if(no_surat == ""){
        jAlert("Maaf, nomor surat harus diisi", "PERHATIAN");
        return false;
    }else if(tgl_kirim == ""){
        jAlert("Maaf, Tanggal pengiriman harus diisi", "PERHATIAN");
        return false;
    }
    jConfirm("Anda yakin akan mengirimkan surat ini ke tujuan?", "PERHATIAN", function(r){
        if(r){
            var catatan = $("#catatan_" + id).val();
            //alert("KE : " + tujuan_disposisi + "\nCatatan : " + catatan);
            document.location.href = "php/pengiriman_surat_keluar.php?id=" + id + "&catatan=" + catatan + "&no_surat=" + no_surat + "&tgl_kirim=" + tgl_kirim;
        }
    });
}

$(document).ready(function(){
    $(".tgl_kirim").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
});
</script>
<div class="panelcontainer" style="width: 100%;">
    <h3>DAFTAR SURAT KELUAR YANG AKAN DIKIRIM</h3>
    <div class="bodypanel">
    <?php
        $res = mysql_query("SELECT 
                            	a.*, b.unit_kerja
                            FROM 
                            	myapp_maintable_suratkeluar a
                            	LEFT JOIN myapp_reftable_unitkerja b ON a.id_skpd_tujuan = b.id_unit_kerja
                            WHERE
                                status = 3 AND tujuan_disposisi = $_SESSION[id_level]
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
                    <td><span class="detail"><input type="text" id="no_surat_<?php echo($ds["id"]); ?>" /></span></td>
                </tr>
                <tr>
                    <td width='10%'>Tanggal Surat</td>
                    <td width='10px'>:</td>
                    <td><span class="detail"><?php echo($ds["tgl_surat"]); ?></span></td>
                </tr>
                <tr>
                    <td width='10%'>Tanggal Pengiriman</td>
                    <td width='10px'>:</td>
                    <td><span class="detail"><input type="text" name="tgl_kirim" id="tgl_kirim_<?php echo($ds["id"]); ?>" class="tgl_kirim" /></span></td>
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
                        <textarea id="catatan_<?php echo($ds["id"]); ?>" placeholder="Berikan Catatan Pada Pengiriman Surat"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <input type="button" value="Kirim Surat" onclick="disposisi(<?php echo($ds["id"]) ?>);" />
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