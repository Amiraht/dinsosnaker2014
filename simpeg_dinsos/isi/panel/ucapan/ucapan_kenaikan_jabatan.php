<script type="text/javascript">
$(document).ready(function(){
// here is where we call the CKEditor & hold it with CKFinder =================================
	   var editor = CKEDITOR.replace("pesan");
	   CKFinder.setupCKEditor(editor, "ckfinder") ;
//=============================================================================================

    $( "#btn_kirim_pesan" ).click(function(){
        var tujuan = $("#tujuan").val();
        var pesan = $("#pesan").val();
        if(tujuan == ""){
            jAlert("Maaf, input harus lengkap. Semua input wajib diisi !!", "PERHATIAN");
			return false;
        }else{
           $("#frm_pesan").submit();
        }
       
    });
});
</script>
<script type="text/javascript">
	function terkirim(){
		document.location.href = "?mod=ucapan_jabatan_terkirim";
	}

</script>
<form name="frm_pesan" id="frm_pesan" action="php/ucapan/ucapan_jabatan.php" method="POST">
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">KIRIM PESAN UCAPAN SELAMAT KENAIKAN JABATAN</h3>
	<?php
		if(isset($_GET['code']) && isset($_GET['mode'])){
			if($_GET['code'] == '1' && $_GET['mode'] == 'add'){
				print "<div class='alert alert-success' role='alert' id='alert_add_sukses'>";		
				print "<center><img src='image/icn_alert_success.png' width='18px;' />&nbsp;&nbsp;";
				print "Pesan Ucapan Kenaikan Jabatan Berhasil Dikirimkan.<br/></center>";
				print "</div><br/>";
			}else if($_GET['code'] == '2' && $_GET['mode'] == 'add'){
				print "<div class='alert alert-warning' role='alert' id='alert_add_sukses'>";		
				print "<center><img src='image/icn_alert_warning.png' width='18px;' />&nbsp;&nbsp;";
				print "Pesan ucapan gagal terkirim, dicoba lagi !!.<br/></center>";
				print "</div><br/>";
			}
		}
	?>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <input type="button" value="Pesan Terkirim" onclick="terkirim();" />
        <div class="kelang"></div>
		<table border="0px" cellspacing='0' cellpadding='0' width='50%'>
            <tr>
                <td>
					<label>Pilih NIP Pegawai Yang Ingin Anda Kirim Pesan:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder=":: Cari NIP Pegawai yang ingin anda kirim ::" id="tujuan" name="tujuan" />
                        <span class="input-group-btn">
                            <button type="button" class="btn bnt-sm btn-success" onclick="show_auto_search_pegawai('tujuan');"><span class='glyphicon glyphicon-search'></span>&nbsp;&nbsp;Search</button>
                        </span>
                    </div>
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
					<input type="hidden" name="dari" id="dari" value="<?=$_SESSION["simpeg_id_pegawai"];?>" />
                    <label>Isi Pesan Ucapan :</label>
                    <textarea name="pesan" id="pesan" placeholder=":: Tulis Pesan Ucapan Anda Disini ::"></textarea>
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td style="text-align: left;">
                    <input type="submit" value="KIRIM" style="width: 150px; height: 40px;" id="btn_kirim_pesan" class="btn btn-success"/>
                    <input type="reset" value="RESET" style="width: 150px; height: 40px;" class="btn btn-warning"/>
                </td>
            </tr>
        </table>
    </div>
</div>
</form>