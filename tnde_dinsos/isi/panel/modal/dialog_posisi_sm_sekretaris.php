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
	<legend><h3>Disposisikan Surat ke Bidang</h3></legend>

		<form name="frm" action="../../../php/posisi_surat_masuk_sekretaris.php" method="POST">
			<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <input type="hidden" name="id_surat_masuk" value="<?=$id_surat_masuk;?>" id="id_surat_masuk" />
                <input type="hidden" name="id_disposisi" value="<?=$id_disposisi;?>" id="id_disposisi" />
                <?php
                    $res_ldb = mysql_query("SELECT * FROM myapp_reftable_levelpengguna WHERE (atasan='1' AND id <> 2) OR atasan='" . $_SESSION["id_level"] . "'");
                    while($ds_ldb = mysql_fetch_array($res_ldb)){
                ?>
                <tr>
                    <td><input type="checkbox" name="id_level_tujuan_<?php echo($ds_ldb["id"]); ?>" /></td>
                    <td style="text-transform: capitalize;"><?php echo($ds_ldb["level"]); ?></td>
                    <td>
                        <select onchange="pilihkalimat(<?php echo($ds_ldb["id"]); ?>, this.value);">
                            <option value="">:: Pilih Kalimat Disposisi ::</option>
                        <?php
                            $rkd = mysql_query("SELECT * FROM myapp_constable_kalimatdisposisi");
                            while($dkd = mysql_fetch_array($rkd)){
                                echo("<option>" . $dkd["kalimat"] . "</option>");
                            }
                        ?>
                        </select>
                        <br />
                        <textarea name="catatan_<?php echo($ds_ldb["id"]); ?>" id="catatan_<?php echo($ds_ldb["id"]); ?>"></textarea>
                    </td>
                </tr>  
                <?php
                    }
                ?>
                <tr>
                    <td colspan="3"><textarea name="catatan" placeholder="JIKA SURAT MASUK DITERUSKAN KE KEPALA BADAN, TULIS CATATANNYA DISINI"></textarea></td>
                </tr>
            </table>
            <div class="kelang"></div>
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='50%'><input type="submit" name="kabid" value='Kirim Disposisi' style="width: 100%;" /></td>
                    <td width='50%'><input type="submit" name="kaban" value='Teruskan Ke Kepala Badan' style="width: 100%;" /></td>
                </tr>
                <tr>
                    <td width='50%'><input type="submit" name="selesai" value='Selesai Dengan Surat Ini' style="width: 100%;" /></td>
                </tr>
            </table>
        </div>
    </div>
</form>
</div>
<!-- END OF DIALOG -->