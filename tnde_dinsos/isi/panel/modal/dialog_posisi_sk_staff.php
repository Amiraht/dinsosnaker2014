<?php
	session_start();
	include "../../../php/koneksi.php";
	include "../../../method/function.php";
	
	$id_surat_masuk = anti_injection($_GET['id_surat_masuk']);
	$id_disposisi = anti_injection($_GET['id_disposisi']);
	
?>
<!-- DIALOG -->
<fieldset>
	<legend><h3>Lanjutkan Disposisi Surat Keluar</h3></legend>
		<form name="frm" action="../../../php/posisi_surat_keluar_staff.php" method="POST">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <input type="hidden" name="id_surat_keluar" value="<?=$id_surat_masuk;?>" id="id_surat_keluar" />
                <input type="hidden" name="id_disposisi" value="<?=$id_disposisi;?>" id="id_disposisi" />
                <tr>
					<td> Input Catatan </td>
					<td> : </td>
                    <td><textarea name="catatan" cols='55' rows='9'></textarea></td>
                </tr>  
            </table><br/></br/>
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>	
					<td>&nbsp;</td>
					<td>&nbsp;</td>
                    <td>
                        <input type="submit" name="terima" value='Lanjutkan Disposisi Keatas'/> &nbsp;&nbsp;
                        <input type="submit" name="benerin" value='Perbaikan Data Dan Lanjutkan Keatas'/>
                    </td>
                </tr>
            </table>
		</form>
</fieldset>
<!-- END OF DIALOG -->