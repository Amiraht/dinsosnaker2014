<script type="text/javascript">
function jlhfile(){
    var jlh = $("#jlh_file").val();
    $("#panelupload").html("");
    var isi = "";
    for(var i=1; i<=jlh; i++){
        isi += "<tr>";
            isi += "<td align='center'>" + i + "</td>";
            isi += "<td colspan='3'>";
                isi += "<input type='file' name='file_" + i + "' />";
            isi += "</td>";
        isi += "</tr>"
    }
    $("#panelupload").html(isi);
}
</script>
<form name="frm" action="php/tambah_pps.php" method="post" enctype="multipart/form-data">
    <div class="panelcontainer" style="width: 100%;">
        <input type="hidden" name="tipe_pps" value="<?php echo($_GET["tipe_pps"]); ?>" />
        <h3>TAMBAH DATA PENGADUAN / PESAN DAN SARAN</h3>
        <div class="bodypanel" id="bodyfilter">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td>
                        <textarea name="pengaduan"></textarea>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="kelang"></div>
    <div class="panelcontainer" style="width: 100%;">
        <h3>FILE PENDUKUNG PENGADUAN / PESAN DAN SARAN</h3>
        <div class="bodypanel" id="bodyfilter">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='70px'>Jumlah File</td>
                    <td width='10px'>:</td>
                    <td width='100px'><input type="text" id="jlh_file" name="jlh_file" value="0" /></td>
                    <td>
                        <input type="button" value="OK" onclick="jlhfile();" />
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <b>isikan jumlah file dan klik tombol OK. Maka akan muncul input untuk file upload
                        sejumlah yang anda isikan</b>
                    </td>
                </tr>
                <tbody id="panelupload"></tbody>
            </table>
        </div>
    </div>
    <div class="kelang"></div>
    <div class="panelcontainer" style="width: 100%;">
        <div class="bodypanel" id="bodyfilter">
            <table border="0px" cellspacing='0' cellpadding='0' width='40%'>
                <tr>
                    <td width='33%'><input type="submit" value='Simpan' style="width: 100%;" /></td>
                    <td width='33%'><input type="reset" value='Reset' style="width: 100%;" /></td>
                </tr>
            </table>
        </div>
    </div>
</form>