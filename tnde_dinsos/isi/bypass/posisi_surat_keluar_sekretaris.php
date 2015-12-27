<script type="text/javascript">
$(document).ready(function(){
    $("#dialog_form_disp").dialog({
            autoOpen: false,
			height: 250,
			width: 700,
			modal: true,
            show: "fade",
			hide: "fade"
        });
});
function munculDisposisi(id_surat_keluar, id_disposisi){
    $("#id_surat_keluar").val(id_surat_keluar);
    $("#id_disposisi").val(id_disposisi);
    $("#dialog_form_disp").dialog("open");
}

</script>
<div class="panelcontainer" style="width: 100%;">
    <h3>DAFTAR SURAT KELUAR YANG DITERIMA</h3>
    <div class="bodypanel">
    <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
        <tr class="headertable">
            <th width='5px'>&nbsp;</th>
            <th width='40px'>No.</th>
            <th width='200px'>No. Surat</th>
            <th width='90px'>Tgl. Surat</th>
            <th width='90px'>Tgl. Terima</th>
            <th>Perihal</th>
            <th width='200px'>Unit Pengirim</th>
            <th width='150px'>Asal Disposisi</th>
            <th width='100px'>Tipe Disposisi</th>
            <th width='20px'>&nbsp;</th>
            <th width='20px'>&nbsp;</th>
            <th width='20px'>&nbsp;</th>
            <th width='20px'>&nbsp;</th>
            <th width='20px'>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
    <?php
        $res = mysql_query("SELECT 
                            	a.*, b.unit_kerja, c.status AS kondisi, d.level AS asal, c.id AS id_disposisi,
                                c.keadaan, e.id_surat_masuk
                            FROM 
                            	myapp_maintable_suratkeluar a
                            	LEFT JOIN myapp_reftable_unitkerja b ON a.id_skpd_tujuan = b.id_unit_kerja
                            	LEFT JOIN myapp_disptable_suratkeluar c ON a.id = c.id_surat_keluar
                            	LEFT JOIN myapp_reftable_levelpengguna d ON c.id_level_asal = d.id
                                LEFT JOIN myapp_maintable_balasan e ON a.id = e.id_surat_keluar
                            WHERE
                            	c.id_level_tujuan = '2' AND c.status < 3
                            GROUP BY
                                a.id
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
                echo("<td>" . konversiKeadaanSK($ds["keadaan"]) . "</td>");
                echo("<td align='center'>");
                    echo("<img src='image/mail_replay-48.png' width='18px' class='linkimage' title='Data Surat Masuk Yang Dibalas' onclick='lihat_data_yg_dibalas(" . $ds["id_surat_masuk"] . ", " . $ds["id_disposisi"] . ");'>");
                echo("</td>");
                echo("<td align='center'>");
                    echo("<img src='image/information_32.png' width='18px' class='linkimage' title='Detail Surat Keluar' onclick='lihat_detail_sk(" . $ds["id"] . ", " . $ds["id_disposisi"] . ");'>");
                echo("</td>");
                echo("<td align='center'>");
                    echo("<img src='image/icon-disposisi.png' width='18px' class='linkimage' title='Daftar catatan disposisi' onclick='lihat_cadis_sk(" . $ds["id"] . ", " . $ds["id_disposisi"] . ");'>");
                echo("</td>");
                echo("<td align='center'>");
                    echo("<img src='image/Attachment-32.png' width='18px' class='linkimage' title='File yang dilampirkan' onclick='lihat_file_sk(" . $ds["id"] . ", " . $ds["id_disposisi"] . ");'>");
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
<div id="dialog_form_disp" title="Lanjutkan Disposisi Surat Keluar">
<form name="frm" action="phpbypass/posisi_surat_keluar_sekretaris.php" method="post">
    <div class="panelcontainer" style="width: 100%;">
        <div class="bodypanel">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <input type="hidden" name="id_surat_keluar" value="" id="id_surat_keluar" />
                <input type="hidden" name="id_disposisi" value="" id="id_disposisi" />
                <tr>
                    <td><textarea name="catatan" style="display: none;"></textarea></td>
                </tr>  
            </table>
            <div class="kelang"></div>
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='50%'>
                        <input type="submit" name="terima" value='Lanjutkan Disposisi Keatas' style="width: 100%;" />
                    </td>
                    <td>
                        <input type="submit" name="tolak" value='Perlu Perbaikan' style="width: 100%;" />
                    </td>
                </tr>
            </table>
        </div>
    </div>
</form>
</div>
<!-- END OF DIALOG -->