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
function download(id){
    window.open("php/download_file_pps.php?id=" + id);
}
function hapusfile(id){
    jConfirm("Anda yakin ingin menghapus file ini?", "PERHATIAN", function(r){
        if(r){
            document.location.href="php/hapus_file_pps.php?id=" + id + "&tipe_pps=<?php echo($_GET["tipe_pps"]); ?>";
        }
    });
}
</script>
<form name="frm" action="php/edit_pps.php" method="post" enctype="multipart/form-data">
    <div class="panelcontainer" style="width: 100%;">
        <input type="hidden" name="id_pengaduan" value="<?php echo($_GET["id_pengaduan"]); ?>" />
        <input type="hidden" name="tipe_pps" value="<?php echo($_GET["tipe_pps"]); ?>" />
        <h3>EDIT DATA PENGADUAN / PESAN DAN SARAN</h3>
        <div class="bodypanel" id="bodyfilter">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                 <tr>
                    <td>
                        <textarea name="pengaduan"><?php echo($_GET["pengaduan"]); ?></textarea>
                    </td>
                </tr>
            </table>
            <!--<div class="kelang"></div>
            <table border="0px" cellspacing='0' cellpadding='0' width='40%'>
                <tr>
                    <td width='33%'><input type="submit" value='Simpan' style="width: 100%;" /></td>
                    <td width='33%'><input type="reset" value='Reset' style="width: 100%;" /></td>
                    <td width='33%'><input type="button" value='Kembali' style="width: 100%;" onclick="document.location.href='?mod=pps&tipe_pps=<?php echo($_GET["tipe_pps"]); ?>'" /></td>
                </tr>
            </table>-->
        </div>
    </div>
    <div class="kelang"></div>
    <div class="panelcontainer" style="width: 100%;">
        <h3>DAFTAR FILE PENDUKUNG YANG SUDAH ADA</h3>
        <div class="bodypanel">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
            <thead>
            <tr class="headertable">
                <th width='40px'>No.</th>
                <th>Nama File</th>
                <th width='150px'>Ekstensi</th>
                <th width='150px'>Ukuran</th>
                <th width='20px'>&nbsp;</th>
                <th width='20px'>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $res = mysql_query("SELECT id_file, id_pengaduan, nama_file, ekstensi, OCTET_LENGTH(file) AS ukuran FROM tbl_file_pengaduan_pesan_saran WHERE id_pengaduan=" . $_GET["id_pengaduan"] . " AND tipe=1");
                $ctr=0;
                while($ds = mysql_fetch_array($res)){
                    $ctr++;
            ?>
                <tr>
                    <td align="center"><?php echo($ctr); ?></td>
                    <td><?php echo($ds["nama_file"]) ?></td>
                    <td align='center'><?php echo($ds["ekstensi"]) ?></td>
                    <td align='center'><?php echo($ds["ukuran"] / 1000 . " KB") ?></td>
                    <td>
                        <img src='image/Upload-48.png' width='18px' class='linkimage' title='Download File' onclick='download(<?php echo($ds["id_file"]); ?>);' />
                    </td>
                    <td>
                        <img src='image/Delete-32.png' width='18px' class='linkimage' title='Hapus File' onclick='hapusfile(<?php echo($ds["id_file"]); ?>);' />
                    </td>
                </tr>
            <?php
                }
            ?>
            </tbody>
            </table>
        </div>
    </div>
    <div class="kelang"></div>
    <div class="panelcontainer" style="width: 100%;">
        <h3>TAMBAH FILE PENDUKUNG PENGADUAN / PESAN DAN SARAN</h3>
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
                    <td width='33%'><input type="button" value='Kembali' style="width: 100%;" onclick="document.location.href='?mod=pps&tipe_pps=<?php echo($_GET["tipe_pps"]); ?>'" /></td>
                </tr>
            </table>
        </div>
    </div>
</form>