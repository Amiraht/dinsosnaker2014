<script type="text/javascript">
$(document).ready(function(){
    $("#tgl_surat").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
    $("#tgl_terima").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
    $("#harus_selesai").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
});
function hapusFile(id){
    jConfirm("Anda yakin akan menghapus data file ini?", "PERHATIAN", function(r){
        if(r){
            //alert("hapus");
            document.location.href = "php/hapus_file_surat_keluar.php?id=" + id + "&id_surat_masuk=<?php echo($_GET["id"]); ?>&redir=<?php echo($_GET["redir"]); ?>";
        }
    })
}
</script>

  <fieldset>
        <legend><h3>INPUT FILE BUKTI / PENDUKUNG SURAT KELUAR</h3></legend>
        <form name="frm" action="php/file_surat_keluar.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="redir" value="<?php echo($_GET["redir"]); ?>" />
            <input type="hidden" name="id" value="<?php echo($_GET["id"]); ?>" />
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <?php
                if(isset($_GET["err_code"])){
            ?>
                <tr>
                    <td colspan="3"><span class="err_msg"><?php echo($_GET["err_code"]) ?></span></td>
                </tr>
            <?php
                }
            ?>
                <tr>
                    <td width='20%'>Upload File</td>
                    <td width='10px'>:</td>
                    <td><input type="file" name="file" /></td>
                </tr>
                <tr>
                    <td width='20%'>Keterangan File</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="keterangan" /></td>
                </tr>                
                <tr>
                    <td width='20%'>Tipe File</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="radio" name="status" value="1" /> Konsep Surat <span class="footnote">~::(Harus Berformat Word Atau PDF)</span><br />
                        <input type="radio" name="status" value="2" /> Konsep Nota Dinas <span class="footnote">~::(Harus Berformat Word Atau PDF)</span><br />
                        <input type="radio" name="status" value="3" /> Pendukung Surat (lampiran, foto, berkas lainnya)
                    </td>
                </tr>
            </table>
            <br />
            
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                <?php
                    $redir = "?mod=";
                    if(isset($_GET["redir"])){
                        $redir = "?mod=" . $_GET["redir"] . "&id=" . $_GET["id"];
                    }
                ?>
                    <td width='35%'><input type="submit" value='Simpan' style="width: 80%;" />&nbsp;</td>
                    <td width='35%'><input type="reset" value='Reset' style="width: 80%;" />&nbsp;</td>
                    <td width='30%'><input type="button" value='Kembali' style="width: 80%;" onclick="document.location.href='<?php echo($redir); ?>';" /></td>
                </tr>
            </table>
		</form>
	</fieldset><br/><br/>	

<fieldset>	
<legend><h3>DAFTAR FILE BUKTI / PENDUKUNG SURAT KELUAR</h3></legend>

<?php
	$id_sk = $con->real_escape_string($_GET["id"]);
    $res = $con->query("SELECT * FROM myapp_filetable_suratkeluar WHERE id_surat_keluar='" . $id_sk . "'");
	
	$res->data_seek(0);
	
    while($ds = $res->fetch_assoc()){
?>
        <div class="judullist"><?php echo($ds["nama_file"]) ?></div>
        <div class="isilist">
            <?php echo($ds["keterangan"]) ?>
            <div style="clear: both;"></div>
            <a class="linktambahan" href="uploaded/sk/<?php echo($ds["nama_file"]) ?>" target="_blank">Download</a>
            <a class="linktambahan" href="javascript:hapusFile(<?php echo($ds["id"]); ?>);">Hapus</a>
            <div style="clear: both;"></div>
        </div>
<?php
    }
	
	$res->close();
?>
</fieldset>