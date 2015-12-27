<?php
	session_start();
	include "../../../php/koneksi.php";
	include "../../../method/function.php";
	
	$id_surat_masuk = anti_injection($_GET['id_surat_masuk']);
	$id_disposisi = anti_injection($_GET['id_disposisi']);
	
?>
<!-- DIALOG -->
	<fieldset>
		<legend><h3>Lanjutkan Surat Ke Staf Yang Dituju <?=" (ID Surat: ".$id_surat_masuk.")";?></h3></legend>
		<form name="frm" action="../../../php/proses_ulang_surat_masuk.php" method="OST">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <input type="hidden" name="id_surat_masuk" value="<?=$id_surat_masuk;?>" id="id_surat_masuk" />
                <input type="hidden" name="id_disposisi" value="<?=$id_disposisi;?>" id="id_disposisi" />
                <?php
                    if($_SESSION["id_level"] <> 7){
                        $res_ldb = mysql_query("SELECT
                                    	b.*
                                    FROM
                                    	myapp_reftable_levelpengguna a
                                    	LEFT JOIN myapp_maintable_pengguna b ON a.id = b.id_level
                                    WHERE
                                    	a.atasan = " . $_SESSION["atasan"] . " AND a.urutan = 4");
                        while($ds_ldb = mysql_fetch_array($res_ldb)){
                ?>
                <tr>
                    <td><input type="checkbox" name="id_level_tujuan_<?php echo($ds_ldb["id"]); ?>" /></td>
                    <td style="text-transform: capitalize;"><?php echo($ds_ldb["nama"]); ?></td>
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
                    </td>
                </tr>
				<tr>
					<td> &nbsp;&nbsp;</td>
                    <td> &nbsp;&nbsp;</td>
					<td><textarea name="catatan_<?php echo($ds_ldb["id"]); ?>" id="catatan_<?php echo($ds_ldb["id"]); ?>" rows='25' cols='30'></textarea></td>
				</tr>	
                <?php
                        }
                    }else{
                ?>
                <tr>
                    <td colspan="2">Pada Bidang : </td>
                    <td>
                        <select name="bidang" id="bidang" style="text-transform: capitalize;" onchange="kestaff(this.value);">
                            <option value="0">:: Pilih Bidang ::</option>
                        <?php
                            $res_bidang = mysql_query("SELECT 
                                                        	*, REPLACE(a.level,'kepala ','') AS bidang
                                                        FROM
                                                        	myapp_reftable_levelpengguna a
                                                        WHERE 
                                                        	urutan = 2");
                            while($ds_bidang = mysql_fetch_array($res_bidang)){
                                echo("<option value='" . $ds_bidang["id"] . "'>" . $ds_bidang["bidang"] . "</option>");
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tbody id="staff"></tbody>
                <?php
                    }
                ?>
                <tr>
					<td>Catatan Disposisi</td>
					<td> : </td>
                    <td>
					<textarea name="catatan" placeholder="JIKA SURAT MASUK DIKEMBALIKAN KE KEPALA BIDANG, TULIS CATATANNYA DISINI" cols='55' rows='9'></textarea>
					</td>
                </tr>
				<tr>
					<td> &nbsp;&nbsp;</td><td> &nbsp;&nbsp;</td><td> &nbsp;&nbsp;</td>
				</tr>
                <tr>
					<td> &nbsp;&nbsp;</td>
                    <?php
                        $kata = "Kembalikan Ke Kepala Bidang";
                        if($_SESSION["id_level"] == 7)
                            $kata = "Alihkan Ke Sekretaris";
                    ?>
					<td> &nbsp;&nbsp;</td>
                    <td> <input type="submit" name="terus" value='Kirim Disposisi'/>
                     <input type="submit" name="tolak" value='<?php echo($kata); ?>' style="display: none;"/></td>
                </tr>
                <tr>
					<td> &nbsp;&nbsp;</td>
					<td> &nbsp;&nbsp;</td>
                    <td> <input type="submit" value='Proses Dengan Balasan Surat' name="balas" style="display: none;" />
                    <input type="submit" value='Selesai Tanpa Balasan' name="selesai" style="display: none;" /></td>
                </tr>
                <tr>
                    <td colspan="3" style='color:green;font-family:verdana;font-size:13px;'>
                        Jika ingin memproses surat ini dengan membuat balasan surat, klik <b>"Proses Dengan Balasan Surat"</b> dan akan dialihkan
                        ke halaman data surat balasan. Tetapi jika surat ini tidak perlu diproses, klik <b>"Selesai Tanpa Balasan"</b> dan
                        data surat masuk akan diserahkan ke login Arsip
                    </td>
                </tr>
            </table>
     </form>
	</fieldset> 

<!-- END OF DIALOG -->