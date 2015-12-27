<script type="text/javascript">
$(document).ready(function(){
// here is where we call the CKEditor & hold it with CKFinder =================================
	   var editor = CKEDITOR.replace("isi");
	   CKFinder.setupCKEditor(editor, "ckfinder") ;
//=============================================================================================

    $("#frm").submit(function(){
        var judul = frm.judul.value;
        var intro = frm.intro.value;
        var isi = frm.isi.value;
        if(judul == "" || intro == "")
            jAlert("Maaf, input harus lengkap. Semua input harus diisi", "PERHATIAN");
        else{
            jConfirm("Anda yakin akan memposting berita / informasi ini?", "PERHATIAN", function(r){
               if(r){
                    frm.submit();
               }else{
                    return false;
               }
            });
        }
        return false;
    });
});
</script>
<?php
    $ds = mysql_fetch_array(mysql_query("SELECT * FROM tbl_kata_sambutan_kaban"));
?>


<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
          <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="">KATA SAMBUTAN KABAN (ADMIN)</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>KATA SAMBUTAN KABAN</span></td>
                            <td><img  align="right" width="90" height="29" onclick="document.location.href='./'" 
                                onmouseout="this.src='./image/button/KEMBALI.gif'" onmouseover="this.src='./image/button/KEMBALI2.gif'" src="./image/button/KEMBALI.gif"></img>
                                </td>
                        </tr>
                    </table>            
                    </div>
            <br>
        </td>
  </tr>
  <tr>
  	<td>
    <div id='content' style='padding-top:10px;'>	<br>
		
			<form name="frm" id="frm" action="php/kata_sambutan_kaban/kata_sambutan_kaban_adm.php" method="post">
			<div class="panelcontainer panelform" style="width: 100%;">
				<h3 style="text-align: left;">KATA SAMBUTAN KEPALA BADAN</h3>
				<div class="bodypanel bodyfilter" id="bodyfilter">
					<?php
						if(isset($_GET["sukses"])){
							if($_GET["sukses"] == 1){
								echo "<div class='alert alert-success' role='alert'>
									<strong>Selesai!</strong> Data Kata Sambutan Kepala Badan Telah Disimpan
								</div>";
							}
						}	
					?>
					<textarea name="isi" id="isi"><?php echo($ds["kata_sambutan_kaban"]); ?></textarea><br />
					<button type="submit" class="btn btn-lg btn-primary">Simpan</button>
					<button type="reset" class="btn btn-lg btn-default">Reset</button>
				</div>
			</div>
			</form>
	</div>
</td>
</tr>
<tr>
     <td><br><div id='footer'></div></td>
 </tr>
 </table>
 

