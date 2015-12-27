<?php
	session_start();
	include "../../../php/koneksi.php";
	include "../../../method/function.php";
	
	$id_surat_masuk = anti_injection($_GET['id_surat_masuk']);
	$id_disposisi = anti_injection($_GET['id_disposisi']);
	
?>
<!-- DIALOG -->
<fieldset>
	<legend><h3>PROSES SURAT</h3></legend>
		<form name="frm" action="../../../php/posisi_surat_masuk_staff.php" method="POST">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <input type="hidden" name="id_surat_masuk" value="<?=$id_surat_masuk;?>" id="id_surat_masuk" />
                <input type="hidden" name="id_disposisi" value="<?=$id_disposisi;?>" id="id_disposisi" />
                <tr>
					<td> Input Catatan </td>
					<td> : </td>
                    <td><textarea name="catatan" placeholder="JIKA SURAT MASUK DIKEMBALIKAN KE KEPALA SUB BIDANG, TULIS CATATANNYA DISINI" cols='55' rows='9'>
					</textarea></td>
                </tr>
            </table><br/>
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
				   <td>&nbsp;</td>
                    <td>
                        <input type="submit" value='Kembalikan ke Kasubbid' name="tolak" style="width: 100%;" />
                    </td>
                    <td><input type="submit" value='Surat Telah Selesai Diproses' name="selesai" style="width: 100%;" /></td>
                </tr>
                <tr>
				    <td>&nbsp;</td>
                    <td colspan="2" style='color:green;font-size:13px;font-family:verdana;'>
                        Jika surat telah diproses, klik tombol <b>Surat Telah Selesai Diproses</b> dan surat akan
                        dideteksi sebagai surat yang telah selesai diproses. Dan jika ingin membuat balasan untuk surat
                        dapat dilakukan melalui menu <b>Proses Pembuatan Surat Keluar</b>
                    </td>
                </tr>
            </table>
    
		</form>
</fieldset>
<!-- END OF DIALOG -->