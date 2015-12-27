<script type="text/javascript">
$(document).ready(function(){
// here is where we call the CKEditor & hold it with CKFinder =================================
	   var editor = CKEDITOR.replace("pesan");
	   CKFinder.setupCKEditor(editor, "ckfinder") ;
//=============================================================================================

    $( "#btn_pesan_edit" ).click(function(){
        var tujuan = $("#tujuan").val();
        var pesan = $("#pesan").val();
        if(tujuan == ""){
            jAlert("Maaf, input harus lengkap. Semua input wajib diisi !!", "PERHATIAN");
			return false;
        }else{
            
			$("#frm_edit_pesan").submit();
					
        }
       
    });
});
</script>
<script type="text/javascript">
	function terkirim(){
		document.location.href = "?mod=ucapan_jabatan_terkirim";
	}
</script>
<?php
	$idp = isset($_GET['id_pesan']) ? $_GET['id_pesan'] : "";
	$id_pesan = mysql_real_escape_string($idp);
	
	$sql = "SELECT 
				a.*, b.nip as 'ndari', b.nama_pegawai as 'nmdari', c.username as 'tnip', c.nama as 'tnama' 
				FROM tbl_ucapan_naik_jabatan a
				LEFT JOIN tbl_pegawai b ON a.dari = b.id_pegawai
				LEFT JOIN tbl_pengguna c ON a.tujuan = c.username
			WHERE 
				a.id_pesan = '".$id_pesan."'
	";
	
	$query = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_array($query);
?>
<form name="frm_edit_pesan" id="frm_edit_pesan" action="php/ucapan/ucapan_jabatan_edit.php" method="POST">
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">EDIT PESAN UCAPAN SELAMAT KENAIKAN JABATAN (ID DATA : <?=$row['id_pesan'];?>)</h3>
	<?php
		if(isset($_GET['code']) && isset($_GET['mode'])){
			if($_GET['code'] == '1' && $_GET['mode'] == 'edit'){
				print "<div class='alert alert-success' role='alert' id='alert_add_sukses'>";		
				print "<center><img src='image/icn_alert_success.png' width='18px;' />&nbsp;&nbsp;";
				print "Pesan Ucapan Kenaikan Jabatan telah di edit.<br/></center>";
				print "</div><br/>";
			}else if($_GET['code'] == '2' && $_GET['mode'] == 'edit'){
				print "<div class='alert alert-warning' role='alert' id='alert_add_sukses'>";		
				print "<center><img src='image/icn_alert_warning.png' width='18px;' />&nbsp;&nbsp;";
				print "Pesan ucapan gagal di edit, terjadi kesalahan proses!!.<br/></center>";
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
					<label>Pesan Dikirimkan Ke :</label>
                    <span style="font-size:14px; color:green;"><?=$row['tnama']." ( ".$row['tnip']." )";?></span>
					<input type="hidden" name="tujuan" id="tujuan" value="<?=$row['tnip'];?>" />
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
					<input type="hidden" name="dari" id="dari" value="<?=$_SESSION["simpeg_id_pegawai"];?>" />
					<input type="hidden" name="id_pesan" id="id_pesan" value="<?=$row['id_pesan'];?>" />
                    <label>Isi Pesan Ucapan :</label>
                    <textarea name="pesan" id="pesan" ><?=$row['pesan_teks'];?></textarea>
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td style="text-align: left;">
                    <input type="submit" value="SIMPAN UBAH" style="width: 150px; height: 40px;" id="btn_pesan_edit" class="btn btn-success"/>
                    <input type="reset" value="RESET" style="width: 150px; height: 40px;" class="btn btn-warning"/>
                </td>
            </tr>
        </table>
    </div>
</div>
</form>