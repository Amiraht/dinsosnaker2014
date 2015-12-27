<script type="text/javascript">

</script>
<?php
    $ds = mysql_fetch_array(mysql_query("SELECT * FROM myapp_nonlogintable_filedownload WHERE id='" . $_GET["id"] . "'"));
?>
<form name="frm" action="php/cp_tambah_file_download.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo($_GET["id"]); ?>" />
    <div class="panelcontainer" style="width: 100%;">
        <h3>INPUT DATA FILE DOWNLOAD</h3>
        <div class="bodypanel" id="bodyfilter">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='20%'>Judul</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="judul" value="<?php echo($ds["judul"]); ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Deskripsi</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="deskripsi" value="<?php echo($ds["deskripsi"]); ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>
                        Upload File<br />
                        <?php
                            if(isset($_GET["id"])){
                        ?>
                                <span class="footnote">*) Kosongkan jika tidak ingin berubah</span>
                        <?php
                            }
                        ?>
                    </td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="file" name="isi" value="" />
                    </td>
                </tr>
            </table>
            <div class="kelang"></div>
            <table border="0px" cellspacing='0' cellpadding='0' width='40%'>
                <tr>
                    <td width='33%'><input type="submit" value='Simpan' style="width: 100%;" /></td>
                    <td width='33%'><input type="reset" value='Reset' style="width: 100%;" /></td>
                    <td width='33%'><input type="button" value='Kembali' style="width: 100%;" onclick="document.location.href='?mod=cp_file_download'" /></td>
                </tr>
            </table>
        </div>
    </div>
</form>