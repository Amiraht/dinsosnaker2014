<?php
    $spv_tugtam = 0;
    $spv_kreat = 0;
?>
<input type="button" value="Kembali" onclick="document.location.href='?mod=tugtam_kreat_lihat_pilih_periode&id_pegawai=<?php echo($_GET["id_pegawai"]); ?>';" />
<div class="kelang"></div>
<form name="frm_tugas_tambahan" id="frm_tugas_tambahan" action="php/skp/tugas_tambahan_tambah.php" method="post">
<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">ISI DATA TUGAS TAMBAHAN <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nip"))); ?>)</h3>
    <div class="bodypanel">
    <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
            <tr class="headertable">
                <th width='40px'>No.</th>
                <th>Tugas Tambahan</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $res_tugas_tambahan = mysql_query("SELECT * FROM tbl_skp_tugas_tambahan WHERE id_skp='" . $_GET["id_skp"] . "'");
            $no_tugas_tambahan = 0;
            while($ds_tugas_tambahan = mysql_fetch_array($res_tugas_tambahan)){
                $spv_tugtam = $ds_tugas_tambahan["status_supervisi"];
                $no_tugas_tambahan++;
                echo("<tr>");
                    echo("<td  align='center'>" . $no_tugas_tambahan . "</td>");
                    echo("<td>" . $ds_tugas_tambahan["tugas_tambahan"] . "</td>");
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
    <h3 style="text-align: left;">ISI DATA KREATIFITAS <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nip"))); ?>)</h3>
    <div class="bodypanel">
    <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
            <tr class="headertable">
                <th width='40px'>No.</th>
                <th>Kreatifitas</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $res_tugas_tambahan = mysql_query("SELECT * FROM tbl_skp_kreatifitas WHERE id_skp='" . $_GET["id_skp"] . "'");
            $no_tugas_tambahan = 0;
            while($ds_tugas_tambahan = mysql_fetch_array($res_tugas_tambahan)){
                $spv_kreat = $ds_tugas_tambahan["status_supervisi"];
                $no_tugas_tambahan++;
                echo("<tr>");
                    echo("<td align='center'>" . $no_tugas_tambahan . "</td>");
                    echo("<td>" . $ds_tugas_tambahan["kreatifitas"] . "</td>");
                echo("</tr>");
            }
        ?>
        </tbody>
    </table>
    </div>
</div>
</form>
<div class="kelang"></div>
<?php
    if($spv_tugtam == 1 || $spv_kreat == 1){
?>
<form name="frm_spv" id="frm_spv" action="php/skp/tugtam_kreat_lihat.php" method="post">
<input type="hidden" name="id_skp" value="<?php echo($_GET["id_skp"]); ?>" />
<div class="panelcontainer panelform" style="width: 100%;">
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <textarea placeholder="Catatan Keberatan" name="catatan"></textarea>
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td style="text-align: left;">
                    <input type="submit" name="terima" value="TERIMA" style="width: 150px; height: 40px;" />
                    <input type="submit" name="tolak" value="KEBERATAN" style="width: 150px; height: 40px;" />
                </td>
            </tr>
        </table>
    </div>
</div>
</form>
<?php
    }
?>