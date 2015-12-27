<?php $_SESSION["bypass_id_level"] = $_GET["id_level"]; ?>
<?php $_SESSION["bypass_atasan"] = $_GET["atasan"]; ?>
<script type="text/javascript">
$(document).ready(function(){
    $("#dialog_form_disp").dialog({
            autoOpen: false,
			height: 500,
			width: 700,
			modal: true,
            show: "fade",
			hide: "fade"
        });
});
function munculDisposisi(id_surat_masuk, id_disposisi){
    $("#id_surat_masuk").val(id_surat_masuk);
    $("#id_disposisi").val(id_disposisi);
    $("#dialog_form_disp").dialog("open");
}

</script>
<div class="panelcontainer" style="width: 100%;">
    <h3>DAFTAR SURAT MASUK YANG DITERIMA</h3>
    <div class="bodypanel">
    <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
        <tr class="headertable">
            <th width='5px'>&nbsp;</th>
            <th width='40px'>No.</th>
            <th width='200px'>No. Surat</th>
            <th width='100px'>Tgl. Surat</th>
            <th width='100px'>Tgl. Terima</th>
            <th>Perihal</th>
            <th width='250px'>Unit Pengirim</th>
            <th width='150px'>Asal Disposisi</th>
            <th width='20px'>&nbsp;</th>
            <th width='20px'>&nbsp;</th>
            <th width='20px'>&nbsp;</th>
            <th width='20px'>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
    <?php
        $res = mysql_query("SELECT 
                            	a.*, b.unit_kerja, c.status AS kondisi, d.level AS asal, c.id AS id_disposisi
                            FROM 
                            	myapp_maintable_suratmasuk a
                            	LEFT JOIN myapp_reftable_unitkerja b ON a.id_skpd_pengirim = b.id_unit_kerja
                            	LEFT JOIN myapp_disptable_suratmasuk c ON a.id = c.id_surat_masuk
                            	LEFT JOIN myapp_reftable_levelpengguna d ON c.id_level_asal = d.id
                            WHERE
                            	c.id_level_tujuan = '" . $_SESSION["bypass_id_level"] . "' AND c.status < 3
                            ORDER BY 
                            	id ASC");
        $ctr = 0;
        while($ds = mysql_fetch_array($res)){
            $ctr++;
            echo("<tr>");
                $kondisi = "belumdibaca";
                if($ds["kondisi"] == 2)
                    $kondisi = "telahdibaca";
                echo("<td align='center'><div class='lampu " . $kondisi . "' id='kondisi_" . $ds["id"] . "'>&nbsp;</div></td>");
                echo("<td align='center'>" . $ctr . "</td>");
                echo("<td>" . $ds["no_surat"] . "</td>");
                echo("<td>" . tglindonesia($ds["tgl_surat"]) . "</td>");
                echo("<td>" . tglindonesia($ds["tgl_terima"]) . "</td>");
                echo("<td>" . $ds["perihal_surat"] . "</td>");
                echo("<td>" . $ds["unit_kerja"] . "</td>");
                echo("<td>" . $ds["asal"] . "</td>");
                echo("<td align='center'>");
                    echo("<img src='image/information_32.png' width='18px' class='linkimage' title='Detail Surat Masuk' onclick='lihat_detail_sm(" . $ds["id"] . ", " . $ds["id_disposisi"] . ");'>");
                echo("</td>");
                echo("<td align='center'>");
                    echo("<img src='image/icon-disposisi.png' width='18px' class='linkimage' title='Daftar catatan disposisi' onclick='lihat_cadis_sm(" . $ds["id"] . ", " . $ds["id_disposisi"] . ");'>");
                echo("</td>");
                echo("<td align='center'>");
                    echo("<img src='image/Attachment-32.png' width='18px' class='linkimage' title='File yang dilampirkan' onclick='lihat_file_sm(" . $ds["id"] . ", " . $ds["id_disposisi"] . ");'>");
                echo("</td>");
                echo("<td align='center'>");
                    echo("<img src='image/send_32.png' width='18px' class='linkimage' title='Lanjutkan Disposisi' onclick='munculDisposisi(" . $ds["id"] . ", " . $ds["id_disposisi"] . ");'>");
                echo("</td>");
            echo("</tr>");
        }
    ?>
        </tbody>
    </table>
    </div>
</div>
<!-- DIALOG -->
<div id="dialog_form_disp" title="Lanjutkan Surat Ke Staf Yang Dituju">
<form name="frm" action="phpbypass/posisi_surat_masuk_kasubbid.php" method="post">
    <div class="panelcontainer" style="width: 100%;">
        <div class="bodypanel">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <input type="hidden" name="id_surat_masuk" value="" id="id_surat_masuk" />
                <input type="hidden" name="id_disposisi" value="" id="id_disposisi" />
                <?php
                    $res_ldb = mysql_query("SELECT
                                	b.*
                                FROM
                                	myapp_reftable_levelpengguna a
                                	LEFT JOIN myapp_maintable_pengguna b ON a.id = b.id_level
                                WHERE
                                	a.atasan = " . $_SESSION["bypass_atasan"] . " AND a.urutan = 4");
                    while($ds_ldb = mysql_fetch_array($res_ldb)){
                ?>
                <tr>
                    <td width='5px'><input type="checkbox" name="id_level_tujuan_<?php echo($ds_ldb["id"]); ?>" /></td>
                    <td width='30%' style="text-transform: capitalize;"><?php echo($ds_ldb["nama"]); ?></td>
                    <td><textarea name="catatan_<?php echo($ds_ldb["id"]); ?>" style="display: none;"></textarea></td>
                </tr>  
                <?php
                    }
                ?>
                <tr>
                    <td colspan="3"><textarea name="catatan" placeholder="JIKA SURAT MASUK DIKEMBALIKAN KE KEPALA BIDANG, TULIS CATATANNYA DISINI"></textarea></td>
                </tr>
            </table>
            <div class="kelang"></div>
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='50%'><input type="submit" name="terus" value='Kirim Disposisi' style="width: 100%;" /></td>
                    <td width='50%'><input type="submit" name="tolak" value='Kembalikan Ke Kepala Bidang' style="width: 100%;" /></td>
                </tr>
                <!--<tr>
                    <td width='50%'><input type="submit" value='Proses Dengan Balasan Surat' name="balas" style="width: 100%;" /></td>
                    <td width='50%'><input type="submit" value='Selesai Tanpa Balasan' name="selesai" style="width: 100%;" /></td>
                </tr>-->
                <tr>
                    <td colspan="2">
                        Jika ingin memproses surat ini dengan membuat balasan surat, klik <b>"Proses Dengan Balasan Surat"</b> dan akan dialihkan
                        ke halaman data surat balasan. Tetapi jika surat ini tidak perlu diproses, klik <b>"Selesai Tanpa Balasan"</b> dan
                        data surat masuk akan diserahkan ke login Arsip
                    </td>
                </tr>
            </table>
        </div>
    </div>
</form>
</div>
<!-- END OF DIALOG -->