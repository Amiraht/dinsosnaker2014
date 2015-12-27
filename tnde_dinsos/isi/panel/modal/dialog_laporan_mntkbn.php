<?php
	$id_surat_masuk = anti_injection($_GET['id_surat_masuk']);
	$id_disposisi = anti_injection($_GET['id_disposisi']);	
?>
<!-- DIALOG -->
<fieldset>
	<legend><h3>Lanjutkan Surat Ke Kepala Bidang Yang Dituju</h3></legend>

		<form name="frm" action="php/posisi_surat_masuk_kaban.php" method="post">
    
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <input type="hidden" name="id_surat_masuk" value="<?=$id_surat_masuk;?>" id="id_surat_masuk" />
                <input type="hidden" name="id_disposisi" value="<?=$id_disposisi;?>" id="id_disposisi" />
                <?php
                    $res_ldb = mysql_query("SELECT * FROM myapp_reftable_levelpengguna WHERE atasan='" . $_SESSION["id_level"] . "' AND id <> 2");
                    while($ds_ldb = mysql_fetch_array($res_ldb)){
                ?>
                <tr>
                    <td width='5px'><input type="checkbox" name="id_level_tujuan_<?php echo($ds_ldb["id"]); ?>" /></td>
                    <td style="text-transform: capitalize;"><?php echo($ds_ldb["level"]); ?></td>
                </tr>  
                <?php
                    }
                ?>
                <tr>
                    <td colspan="3"><textarea name="catatan" placeholder="TULIS CATATAN UNTUK SEKRETARIS DISINI"></textarea></td>
                </tr>
            </table><br/>
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='50%'><input type="submit" value='Kembalikan ke Sekretaris Untuk Didisposisikan' style="width: 100%;" /></td>
                </tr>
            </table>
		</form>
</fieldset>
<!-- END OF DIALOG -->