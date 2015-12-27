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
	var konfirm = confirm("Anda yakin akan menghapus data file ini?");
	if(konfirm){
		document.location.href = "php/hapus_file_surat_keluar.php?id=" + id + "&id_surat_masuk=<?php echo($_GET["id"]); ?>&redir=<?php echo($_GET["redir"]); ?>";
		 //alert("hapus");
	}else{
		// do nothing
	}
           
}
</script>

        <h3>INPUT FILE BUKTI / PENDUKUNG SURAT KELUAR</h3><br/>
           
			<form name="frm" action="php/file_surat_keluar.php" method="post" enctype="multipart/form-data">
				 <input type="hidden" name="saya" value="1" />
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
						<td width='20%'>ID Surat</td>
						<td width='10px'>:</td>
						<td><input type="text" name="id_surat" value="<?php echo($_GET["id"]); ?>" readonly="readonly"/></td>
					</tr>
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
							<input type="hidden" name="status" value="4" />
							<b>File Final Surat Keluar (Berkas-Berkas yang sudah ditanda tangani)</b>
						</td>
					</tr>
				</table>
            <br />
            
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
					<td>&nbsp;</td>
                <?php
                    $redir = "?mod=";
                    if(isset($_GET["redir"])){
                        $redir = "?mod=" . $_GET["redir"] . "&id=" . $_GET["id"];
                    }
                ?>
                    <td width='35%'><input type="submit" value='Simpan' style="width: 80%;" />&nbsp;</td>
                    <td width='35%'><input type="reset" value='Reset' style="width: 80%;" />&nbsp;</td>
                </tr>
            </table>
</form><br/>
<fieldset>
<legend><h3>DAFTAR FILE BUKTI / PENDUKUNG SURAT KELUAR</h3></legend>

<?php
    $res = mysql_query("SELECT * FROM myapp_filetable_suratkeluar WHERE id_surat_keluar='" . $_GET["id"] . "' AND status = 4");
    while($ds = mysql_fetch_array($res)){
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
?>

</fieldset>