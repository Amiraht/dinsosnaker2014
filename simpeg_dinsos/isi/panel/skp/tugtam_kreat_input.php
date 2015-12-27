<script type="text/javascript">
$(document).ready(function(){
   $( "#dialog_cadis" ).dialog({
        autoOpen: false,
		height: 540,
		width: 900,
		modal: true,
        show: "fade",
		hide: "fade"
    }); 
});
function catatan(bulan){
    $("#dialog_cadis").dialog("open");
}
</script>
<input type="button" value="Kembali" onclick="document.location.href='?mod=tugtam_kreat_input_pilih_periode';" />
<input type="button" value="Lihat Catatan Keberatan" onclick="catatan();" />
<div class="kelang"></div>
<form name="frm_tugas_tambahan" id="frm_tugas_tambahan" action="php/skp/tugas_tambahan_tambah.php" method="post">
<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">ISI DATA TUGAS TAMBAHAN <?php echo(strtoupper(detail_pegawai($_GET["id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_GET["id_pegawai"], "nip"))); ?>)</h3>
    <div class="bodypanel">
    <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
        <tr>
            <td width='95%'>
                <input type="hidden" name="id_skp" value="<?php echo($_GET["id_skp"]); ?>" />
                <input type="hidden" name="id_pegawai" value="<?php echo($_GET["id_pegawai"]); ?>" />
                <input type="text" name="tugas_tambahan" id="tugas_tambahan" placeholder=":: Tugas Tambahan ::" value="" />
            </td>
            <td style="text-align: left;">
                <input type="submit" value="TAMBAH" style="height: 30px;" />
            </td>
        </tr>
    </table>
    <div class="kelang"></div>
    <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
            <tr class="headertable">
                <th width='40px'>No.</th>
                <th>Tugas Tambahan</th>
                <th width='20px'>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $res_tugas_tambahan = mysql_query("SELECT * FROM tbl_skp_tugas_tambahan WHERE id_skp='" . $_GET["id_skp"] . "'");
            $no_tugas_tambahan = 0;
            while($ds_tugas_tambahan = mysql_fetch_array($res_tugas_tambahan)){
                $no_tugas_tambahan++;
                echo("<tr>");
                    echo("<td  align='center'>" . $no_tugas_tambahan . "</td>");
                    echo("<td>" . $ds_tugas_tambahan["tugas_tambahan"] . "</td>");
                    echo("<td>
                            <img src='image/Delete-32.png' width='18px' class='linkimage' title='Hapus data tugas tambahan' onclick='document.location.href=\"php/skp/tugas_tambahan_hapus.php?id_skp_tugas_tambahan=" . $ds_tugas_tambahan["id_skp_tugas_tambahan"] . "&id_skp=" . $_GET["id_skp"] . "&id_pegawai=" . $_GET["id_pegawai"] . "\"' />
                         </td>");
                echo("</tr>");
            }
        ?>
        </tbody>
    </table>
    </div>
</div>
</form>
<div class="kelang"></div>
<form name="frm_kreatifitas" id="frm_kreatifitas" action="php/skp/kreatifitas_tambah.php" method="post">
<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">ISI DATA KREATIFITAS <?php echo(strtoupper(detail_pegawai($_GET["id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_GET["id_pegawai"], "nip"))); ?>)</h3>
    <div class="bodypanel">
    <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
        <tr>
            <td width='95%'>
                <input type="hidden" name="id_skp" value="<?php echo($_GET["id_skp"]); ?>" />
                <input type="hidden" name="id_pegawai" value="<?php echo($_GET["id_pegawai"]); ?>" />
                <input type="text" name="kreatifitas" id="kreatifitas" placeholder=":: Kreatifitas ::" value="" />
            </td>
            <td style="text-align: left;">
                <input type="submit" value="TAMBAH" style="height: 30px;" />
            </td>
        </tr>
    </table>
    <div class="kelang"></div>
    <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
            <tr class="headertable">
                <th width='40px'>No.</th>
                <th>Kreatifitas</th>
                <th width='20px'>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $res_tugas_tambahan = mysql_query("SELECT * FROM tbl_skp_kreatifitas WHERE id_skp='" . $_GET["id_skp"] . "'");
            $no_tugas_tambahan = 0;
            while($ds_tugas_tambahan = mysql_fetch_array($res_tugas_tambahan)){
                $no_tugas_tambahan++;
                echo("<tr>");
                    echo("<td align='center'>" . $no_tugas_tambahan . "</td>");
                    echo("<td>" . $ds_tugas_tambahan["kreatifitas"] . "</td>");
                    echo("<td>
                            <img src='image/Delete-32.png' width='18px' class='linkimage' title='Hapus data tugas tambahan' onclick='document.location.href=\"php/skp/kreatifitas_hapus.php?id_skp_kreatifitas=" . $ds_tugas_tambahan["id_skp_kreatifitas"] . "&id_skp=" . $_GET["id_skp"] . "&id_pegawai=" . $_GET["id_pegawai"] . "\"' />
                         </td>");
                echo("</tr>");
            }
        ?>
        </tbody>
    </table>
    </div>
</div>
</form>
<!-- DIALOG JQUERY -->
<div id="dialog_cadis" title="Catatan : Keberatan Tentang Tugas Tambahan Dan Kreatifitas" style="display: none;">
<?php
    $res = mysql_query("SELECT
                        	a.catatan, b.nip AS nip_asal, b.nama_pegawai AS nama_asal,
                        	c.nip AS nip_tujuan, c.nama_pegawai AS nama_tujuan
                        FROM
                        	tbl_tugtam_kreat_catatan a
                        	LEFT JOIN tbl_pegawai b ON a.id_asal = b.id_pegawai
                        	LEFT JOIN tbl_pegawai c ON a.id_tujuan = c.id_pegawai
                        WHERE
                        	a.id_skp = '" . $_GET["id_skp"] . "'
                        ORDER BY
                        	a.id_skp_catatan ASC
                        ");
    while($ds = mysql_fetch_array($res)){
        echo("<div class='judullist'>" . $ds["nama_asal"] . " (NIP : " . $ds["nip_asal"] . ")</div>");
        echo("<div class='isilist'>");
            echo("<div>" . $ds["catatan"] . "</div>");
        echo("</div>");
    }
?>
</div>
<!-- ------------- -->