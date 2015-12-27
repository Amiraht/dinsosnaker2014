<script type="text/javascript">
function proses(status_supervisi){
    jConfirm("Anda yakin telah memeriksa data ini?", "PERHATIAN", function(r){
        var catatan = frm.catatan.value;
        frm.status_supervisi.value = status_supervisi;
        if(status_supervisi == 2){
            if(catatan == "")
                jAlert("Maaf, Catatan supervisi atau revisi harus di isi jika data perlu diperbaiki", "PERHATIAN");
            else
                frm.submit();
        }else{
            frm.submit();
        } 
    });
}
</script>
<?php
    $ds = mysql_fetch_array(mysql_query("SELECT 
                                        	a.*, b.skpd, c.tipe_jabatan, d.jabatan
                                        FROM 
                                        	tbl_riwayat_jabatan a
                                        	LEFT JOIN ref_skpd b ON a.id_skpd = b.id_skpd
                                        	LEFT JOIN ref_tipe_jabatan c ON a.id_tipe_jabatan = c.id_tipe_jabatan
                                        	LEFT JOIN ref_jabatan d ON a.id_jabatan = d.id_jabatan
                                        WHERE 
                                        	a.id_riwayat_jabatan = '" . $_GET["id_riwayat_jabatan"] . "'"));
?>
<form name="frm" id="frm" action="php/riwayat_jabatan/spv_riwayat_jabatan_proses.php" method="post">
<input type="hidden" name="id_riwayat_jabatan" value="<?php echo($_GET["id_riwayat_jabatan"]); ?>" />
<input type="hidden" name="status_supervisi" value="" />
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">PROSES SUPERVISI DATA RIWAYAT JABATAN <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nip"))); ?>)</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <input type="button" value="Kembali" onclick="document.location.href='?mod=spv_riwayat_jabatan';" />
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='33%'>
                    <label>SKPD / Unit Kerja :</label>
                    <div class="label_caption"><?php echo($ds["skpd"]); ?></div>
                </td>
                <td width='33%'>
                    <label>Tipe Jabatan :</label>
                    <div class="label_caption"><?php echo($ds["tipe_jabatan"]); ?></div>
                </td>
                <td width='34%'>
                    <label>
                        Jabatan : 
                    </label>
                    <div class="label_caption"><?php echo($ds["jabatan"]); ?></div>
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='300px'>
                    <label>TMT</label>
                    <div class="label_caption"><?php echo(tglindonesia($ds["tmt"])); ?></div>
                </td>
                <td>
                    <label>Nomor SK Jabatan :</label>
                    <div class="label_caption"><?php echo($ds["no_sk_jabatan"]); ?></div>
                </td>
                <td width='300px'>
                    <label>Tgl SK Jabatan :</label>
                    <div class="label_caption"><?php echo(tglindonesia($ds["tgl_sk_jabatan"])); ?></div>
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <label>Pejabat Penetapan</label>
                    <div class="label_caption"><?php echo($ds["pejabat_penetapan"]); ?></div>
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <label>Nomor SK Pelantikan :</label>
                    <div class="label_caption"><?php echo($ds["no_sk_pelantikan"]); ?></div>
                </td>
                <td width='300px'>
                    <label>Tgl SK Pelantikan :</label>
                    <div class="label_caption"><?php echo(tglindonesia($ds["tgl_sk_pelantikan"])); ?></div>
                </td>
                <td width='300px'>
                    <label>Sumpah Jabatan :</label>
                    <div class="label_caption"><?php if($ds["sumpah_jabatan"]==1){echo("Sudah");}else{echo("Belum");} ?></div>
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <label>Pejabat Pelantik</label>
                    <div class="label_caption"><?php echo($ds["pejabat_pelantik"]); ?></div>
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <textarea name="catatan" placeholder=":: Berikan Catatan Penolakan Atau Catatan Revisi Disini ::"></textarea>
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td style="text-align: left;">
                    <input type="button" value="TERIMA" style="width: 150px; height: 40px;" onclick="proses(3);" />
                    <input type="button" value="TOLAK" style="width: 150px; height: 40px;" onclick="proses(2);" />
                </td>
            </tr>
        </table>
    </div>
</div>
</form>