<script type="text/javascript">
$(document).ready(function(){
    ambil_tanggal("dari");
    ambil_tanggal("sampai");
});
function proses(){
    var dari = $("#dari").val();
    var sampai = $("#sampai").val();
    if(dari == "" || sampai == ""){
        jAlert("Tentukan tanggal nya", "PERHATIAN");
    }else{
        $("#frm").submit();
    }
}
</script>
<form name="frm" id="frm" action="cetak/cetak_laporan_kegiatan_verifikasi_upload_rekap.php" method="post" target="_blank">
<div class="panelcontainer" style="width: 100%;">
    <h3>FILTER DATA REKAP</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='30%'>
            <tr>
                <td width='50%'>
                    <label>Dari Tanggal :</label>
                    <input type="text" id="dari" name="dari" />
                </td>
                <td width='50%'>
                    <label>Sampai Tanggal :</label>
                    <input type="text" id="sampai" name="sampai" />
                </td>
            </tr>
        </table>
        <table>
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='20%'>
            <tr>
                <td>
                    <button type="button" class="btn btn-lg btn-success" onclick="proses();">Proses</button>
                    <button type="reset" class="btn btn-lg btn-default">Reset</button>
                </td>
            </tr>
        </table>
    </div>
</div>
</form>