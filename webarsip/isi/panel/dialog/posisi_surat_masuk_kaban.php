<?php
	session_start();
	
	include "../../../php/koneksi.php";
	include "../../../php/fungsi.php";
	include "../../../php/sqli.php";
	
	$id_surat_masuk = anti_injection($_GET['id_surat_masuk']);
	$id_disposisi = anti_injection($_GET['id_disposisi']);
	
?>
<script src='../../../libraries/jquery-1.4.3.js'></script>

<script type="text/javascript">
	
function pilihkalimat(id, kalimat){
    $("#catatan_" + id).val(kalimat);
}

</script>
<!-- DIALOG -->
<fieldset>
	<legend><h3>Lanjutkan Surat Ke Kepala Bidang Yang Dituju</h3></legend>
	 <form name="frm" action="../../../php/posisi_surat_masuk_kaban.php" method="POST">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <input type="hidden" name="id_surat_masuk" value="" id="id_surat_masuk" />
                <input type="hidden" name="id_disposisi" value="" id="id_disposisi" />
                <?php
					$str = "SELECT * FROM myapp_reftable_levelpengguna WHERE atasan='" . $_SESSION["id_level"] . "' AND id <> 2";
                    $res_ldb = mysqli_query($con, $str);
                    while($ds_ldb = mysqli_fetch_array($res_lab)){
                ?>
						<tr>
							<td width='5px'><input type="checkbox" name="id_level_tujuan_<?php echo($ds_ldb["id"]); ?>" /></td>
							<td style="text-transform: capitalize;"><?php echo($ds_ldb["level"]); ?></td>
						</tr>  
                <?php
                    }
					
					mysqli_close($con);
                ?>
                <tr>
                    <td colspan="3">
                        <select onchange="pilihkalimat(1, this.value);">
                            <option value="">:: Pilih Kalimat Disposisi ::</option>
                        <?php
                            $rkd = mysqli_query($con , "SELECT * FROM myapp_constable_kalimatdisposisi");
                            while($dkd = mysqli_fetch_array($rkd)){
                                echo("<option>" . $dkd["kalimat"] . "</option>");
                            }
							
							mysqli_close($con);
                        ?>
                        </select>
                        <br />
                        <textarea name="catatan"  id="catatan_1" placeholder=":: TULIS CATATAN UNTUK SEKRETARIS DISINI ::" rows='25' cols='30'></textarea>
                    </td>
                </tr>
            </table>
            <br/>
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='50%'><input type="submit" value='Kembalikan ke Sekretaris Untuk Didisposisikan' style="width: 100%;" /></td>
                </tr>
            </table>
	</form>
</fieldset>
<!-- END OF DIALOG -->