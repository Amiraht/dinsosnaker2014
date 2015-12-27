<?php
	session_start();
	include "../../../php/koneksi.php";
	include "../../../method/function.php";
	
	$id_surat_masuk = anti_injection($_GET['id_surat_masuk']);
	$id_disposisi = anti_injection($_GET['id_disposisi']);
	
?>

<script type="text/javascript">
	function pilihkalimat(id, kalimat){
		$("#catatan_" + id).val(kalimat);
	}
</script>
<!-- DIALOG -->
<fieldset>
	<legend><h3>Lanjutkan Surat Ke Kepala Sub Bidang Yang Dituju</h3></legend>
		<form name="frm" action="../../../php/posisi_surat_masuk_kabid.php" method="POST">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <input type="hidden" name="id_surat_masuk" value="<?=$id_surat_masuk;?>" id="id_surat_masuk" />
                <input type="hidden" name="id_disposisi" value="<?=$id_disposisi;?>" id="id_disposisi" />
                <?php
                    $res_ldb = mysql_query("SELECT * FROM myapp_reftable_levelpengguna WHERE atasan='" . $_SESSION["id_level"] . "' AND id <> 2 AND urutan < 4");
                    while($ds_ldb = mysql_fetch_array($res_ldb)){
                ?>
                <tr>
                    <td><input type="checkbox" name="id_level_tujuan_<?=($ds_ldb["id"]); ?>" /></td>
                    <td style="text-transform: capitalize;"><?=($ds_ldb["level"]); ?></td>
                    <td>
                        <select onchange="pilihkalimat(<?=($ds_ldb["id"]); ?>, this.value);">
                            <option value="">:: Pilih Kalimat Disposisi ::</option>
                        <?php
                            $rkd = mysql_query("SELECT * FROM myapp_constable_kalimatdisposisi");
                            while($dkd = mysql_fetch_array($rkd)){
                                echo("<option>" . $dkd["kalimat"] . "</option>");
                            }
                        ?>
                        </select>
                        <br />
                        <textarea name="catatan_<?=($ds_ldb["id"]); ?>" id="catatan_<?=($ds_ldb["id"]); ?>" cols='55' rows='9'>
						</textarea>
                    </td>
                </tr>  
                <?php
                    }
                ?>
                <tr>
					<td> Input Catatan </td>
					<td> : </td>	
                    <td><textarea name="catatan" placeholder="JIKA SURAT MASUK DIKEMBALIKAN KE SEKRETARIS, TULIS CATATANNYA DISINI" cols='55' rows='9'>
					</textarea></td>
                </tr>
            </table><br/>
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
                    <td><input type="submit" name="terus" value='Kirim Disposisi'/>&nbsp;&nbsp;
                    <input type="submit" name="tolak" value='Kembalikan Ke Sekretaris' /></td>
                </tr>
                <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
                    <td><input type="submit" value='Proses Dengan Balasan Surat' name="balas" />&nbsp;&nbsp;
                    <input type="submit" value='Selesai Tanpa Balasan' name="selesai" /></td>
                </tr>
                <tr>
                    <td colspan="3">
                        Jika ingin memproses surat ini dengan membuat balasan surat, klik <b>"Proses Dengan Balasan Surat"</b> dan akan dialihkan
                        ke halaman data surat balasan. Tetapi jika surat ini tidak perlu diproses, klik <b>"Selesai Tanpa Balasan"</b> dan
                        data surat masuk akan diserahkan ke login Arsip
                    </td>
                </tr>
            </table>
		</form>
</fieldset>
<!-- END OF DIALOG -->