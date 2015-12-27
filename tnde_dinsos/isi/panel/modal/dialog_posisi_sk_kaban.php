<?php
	session_start();
	include "../../../php/koneksi.php";
	include "../../../method/function.php";
	
	$id_surat_keluar = anti_injection($_GET['id_surat_keluar']);
	$id_disposisi = anti_injection($_GET['id_disposisi']);
	$no_din = anti_injection($_GET['no_din']);
	$tgl_din = anti_injection($_GET['tgl_din']);
	
?>
<script src='../../../libraries/jquery-1.4.3.js'></script>
<link type="text/css" href="../../../libraries/development-bundle/themes/base/ui.all.css" rel="stylesheet" />
<script type="text/javascript" src="../../../libraries/development-bundle/ui/ui.core.js"></script>
<script type="text/javascript" src="../../../libraries/development-bundle/ui/ui.datepicker.js"></script>
<script type="text/javascript" src="../../../libraries/development-bundle/ui/i18n/ui.datepicker-id.js"></script>
<script type="text/javascript">
	$("#tgl_nodin").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
</script>
<!-- DIALOG -->
<fieldset>
	<legend><h3>Lanjutkan Disposisi Surat Keluar</h3></legend>
		<form name="frm" action="../../../php/posisi_surat_keluar_kaban.php" method="post">
    
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <input type="hidden" name="id_surat_keluar" value="<?=$id_surat_keluar;?>" id="id_surat_keluar" />
                <input type="hidden" name="id_disposisi" value="<?=$id_disposisi;?>" id="id_disposisi" />
                <tr>
                    <td width='20%'>Nomor Nota Dinas</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="no_nodin" id="no_nodin" value='<?=$no_din;?>' /></td>
                </tr>
                <tr>
                    <td width='20%'>Tanggal Nota Dinas</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="tgl_nodin" id="tgl_nodin" value='<?=$tgl_din;?>'/></td>
                </tr>
                <tr>
                    <td colspan="3"><b>Nomor nota dinas dan tanggal nota dinas diisi jika nota dinas akan ditandatangani oleh anda</b></td>
                </tr>
                <tr>
					<td> Isi Catatan </td>
					<td> : </td>
                    <td><textarea name="catatan" placeholder=" :: CATATAN DISPOSISI :: " cols='55' rows='9'></textarea></td>
                </tr>  
            </table><br/>
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='50%'>
                        <input type="submit" name="terima" value='Selesai Dan Proses Pengiriman' style="width: 100%;" />
                    </td>
                    <td>
                        <input type="submit" name="tolak" value='Perlu Perbaikan' style="width: 100%;" />
                    </td>
                </tr>
            </table>
      </form>
</fieldset>
<!-- END OF DIALOG -->