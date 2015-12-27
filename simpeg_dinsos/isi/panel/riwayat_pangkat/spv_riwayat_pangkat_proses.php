<script type="text/javascript">
$(document).ready(function(){
    ambil_tanggal("tmt");
    ambil_tanggal("tgl_sk");
});
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
                                        	a.*, b.pangkat, b.gol_ruang
                                        FROM 
                                        	tbl_riwayat_pangkat a
                                        	LEFT JOIN ref_pangkat b ON a.id_pangkat = b.id_pangkat
                                        WHERE 
                                        	id_data='" . $_GET["id_riwayat_pangkat"] . "'"));
?>
<form name="frm" id="frm" action="php/riwayat_pangkat/spv_riwayat_pangkat_proses.php" method="post">
<input type="hidden" name="id_riwayat_pangkat" value="<?php echo($_GET["id_riwayat_pangkat"]); ?>" />
<input type="hidden" name="status_supervisi" value="" />
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">PROSES SUPERVISI DATA RIWAYAT KEPANGKATAN <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nip"))); ?>)</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <input type="button" class="btn btn-success" style="width:100px;" value="Kembali" onclick="document.location.href='?mod=spv_riwayat_pangkat';" />
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <label>Pangkat / Gol. Ruang</label>
                    <div class="label_caption"><?php echo($ds["pangkat"] . " / " . $ds["gol_ruang"]); ?></div>
                </td>
                <td width='300px'>
                    <label>TMT :</label>
                    <div class="label_caption"><?php echo(tglindonesia($ds["tmt"])); ?></div>
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <label>Nomor SK. :</label>
                    <div class="label_caption"><?php echo($ds["no_sk"]); ?></div>
                </td>
                <td width='300px'>
                    <label>Tgl SK. :</label>
                    <div class="label_caption"><?php echo(tglindonesia($ds["tgl_sk"])); ?></div>
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <label>Pejabat Penetapan :</label>
                    <div class="label_caption"><?php echo($ds["pejabat_penetapan"]); ?></div>
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