<script type="text/javascript">
$(document).ready(function(){
// here is where we call the CKEditor & hold it with CKFinder =================================
	   var editor = CKEDITOR.replace("isi");
	   CKFinder.setupCKEditor( editor, 'ckfinder' ) ;
	
    	$("#cari_gambar").click(function(){
    		CKFinder.popup( 'ckfinder', null, null, get_image );
    	});
//=============================================================================================
});
</script>
<?php
    $ds = mysql_fetch_array(mysql_query("SELECT * FROM myapp_nonlogintable_latarbelakang WHERE id='1'"));
?>
<form name="frm" action="php/cp_latar_belakang.php" method="post">
    <input type="hidden" name="id" value="<?php echo($_GET["id"]); ?>" />
    <div class="panelcontainer" style="width: 100%;">
        <h3>LATAR BELAKANG</h3>
        <div class="bodypanel" id="bodyfilter">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td colspan="3">
                        <textarea cols="50" rows="10" id="isi" name="isi"><?php echo($ds["isi"]); ?></textarea>
                    </td>
                </tr>
            </table>
            <div class="kelang"></div>
            <table border="0px" cellspacing='0' cellpadding='0' width='40%'>
                <tr>
                    <td width='33%'><input type="submit" value='Simpan' style="width: 100%;" /></td>
                    <td width='33%'><input type="reset" value='Reset' style="width: 100%;" /></td>
                </tr>
            </table>
        </div>
    </div>
</form>