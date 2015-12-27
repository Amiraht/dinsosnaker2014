<script type="text/javascript">
$(document).ready(function(){
    $( "#dialog_cadis" ).dialog({
        autoOpen: false,
		height: 540,
		width: 500,
		modal: true,
        show: "fade",
		hide: "fade"
    });
});
function hapus(id_riwayat_jabatan, status_supervisi){
    <?php
        if($_SESSION["simpeg_id_level"] == 12){
    ?>
            jConfirm("Anda yakin ingin menghapus data riwayat jabatan ini?", "PERHATIAN", function(r){
                if(r){
                    document.location.href="php/riwayat_jabatan/riwayat_jabatan_hapus.php?id_riwayat_jabatan=" + id_riwayat_jabatan;
                }
            });
    <?php
        }else{
    ?>
            if(status_supervisi == 3){
                jAlert("Data ini telah di terima (ACC) oleh admin SKPD. Data tidak bisa dihapus kembali", "PERHATIAN");
            }else{
                jConfirm("Anda yakin ingin menghapus data riwayat jabatan ini?", "PERHATIAN", function(r){
                    if(r){
                        document.location.href="php/riwayat_jabatan/riwayat_jabatan_hapus.php?id_riwayat_jabatan=" + id_riwayat_jabatan;
                    }
                });
            }
    <?php
        }
    ?>
}
function edit(id_riwayat_jabatan, status_supervisi){
    <?php
        if($_SESSION["simpeg_id_level"] == 12){
    ?>
            document.location.href="?mod=riwayat_jabatan_edit&id_riwayat_jabatan=" + id_riwayat_jabatan;
    <?php
        }else{
    ?>
            if(status_supervisi == 3){
                jAlert("Data ini telah di terima (ACC) oleh admin SKPD. Data tidak bisa diedit kembali", "PERHATIAN");
            }else{
                document.location.href="?mod=riwayat_jabatan_edit&id_riwayat_jabatan=" + id_riwayat_jabatan;
            }
    <?php
        }
    ?>
}
function catatan(id_riwayat_jabatan){
    $("#dialog_cadis").dialog("open");
    $.ajax({
        type: "GET",
        url: "ajax/cadis_spv_riwayat_jabatan.php",
        data: "id_riwayat_jabatan=" + id_riwayat_jabatan,
        success: function(r){
            $("#dialog_cadis").html(r);
        }
    });
}
</script>
<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">DATA RIWAYAT JABATAN <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nip"))); ?>)</h3>
    <div class="bodypanel">
        <input type="button" value="Tambah Data Riwayat Jabatan" onclick="document.location.href='?mod=riwayat_jabatan_tambah';" />
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
            <tr class="headertable">
                <th width='5px'>&nbsp;</th>
                <th width='40px'>No.</th>
                <th width='200px'>Jabatan</th>
                <th width='100px'>Tipe Jabatan</th>
                <th width='70px'>Eselon</th>
                <th width='200px'>SKPD / Unit Kerja</th>
                <th width='100px'>TMT</th>
                <th width='100px'>No. SK Jabatan</th>
                <th width='100px'>Tanggal SK Jabatan</th>
                <th>Pejabat Penetapan</th>
                <th width='20px'>&nbsp;</th>
                <th width='20px'>&nbsp;</th>
                <th width='20px'>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $res = mysql_query("SELECT
                                	a.id_riwayat_jabatan, b.jabatan, c.tipe_jabatan,
                                	d.eselon, e.skpd, a.tmt, a.no_sk_jabatan, a.tgl_sk_jabatan,
                                	a.pejabat_penetapan, MD5(a.id_riwayat_jabatan) AS id_hash,
                                    a.status_supervisi
                                FROM
                                	tbl_riwayat_jabatan a
                                	LEFT JOIN ref_jabatan b ON a.id_jabatan = b.id_jabatan
                                	LEFT JOIN ref_tipe_jabatan c ON a.id_tipe_jabatan = c.id_tipe_jabatan
                                	LEFT JOIN ref_eselon d ON a.id_eselon = d.id_eselon
                                	LEFT JOIN ref_skpd e ON a.id_skpd = e.id_skpd
                                WHERE
                                	a.id_pegawai='" . $_SESSION["simpeg_id_pegawai"] . "'
                                ORDER BY
                                	a.tmt ASC");
            $no = 0;
            while($ds = mysql_fetch_array($res)){
                $no++;
                echo("<tr>");
                    echo("<td align='center'>" . status_supervisi($ds["status_supervisi"]) . "</td>");
                    echo("<td align='center'>" . $no . "</td>");
                    echo("<td align='center'>" . $ds["jabatan"] . "</td>");
                    echo("<td align='center'>" . $ds["tipe_jabatan"] . "</td>");
                    echo("<td align='center'>" . $ds["eselon"] . "</td>");
                    echo("<td align='center'>" . $ds["skpd"] . "</td>");
                    echo("<td align='center'>" . tglindonesia($ds["tmt"]) . "</td>");
                    echo("<td align='center'>" . $ds["no_sk_jabatan"] . "</td>");
                    echo("<td align='center'>" . tglindonesia($ds["tgl_sk_jabatan"]) . "</td>");
                    echo("<td align='center'>" . $ds["pejabat_penetapan"] . "</td>");
                    echo("<td>
                            <img src='image/Edit-32.png' width='18px' class='linkimage' title='Edit' onclick='edit(\"" . $ds["id_hash"] . "\", " . $ds["status_supervisi"] . ");' />
                        </td>");
                    echo("<td>
                            <img src='image/Delete-32.png' width='18px' class='linkimage' title='Hapus' onclick='hapus(" . $ds["id_riwayat_jabatan"] . ", " . $ds["status_supervisi"] . ");' />
                        </td>");
                    if($ds["status_supervisi"] == 2){
                        echo("<td>
                            <img src='image/icon-disposisi.png' width='18px' class='linkimage' title='Catatan supervisi' onclick='catatan(" . $ds["id_riwayat_jabatan"] . ");' />
                        </td>");
                    }else{
                        echo("<td>&nbsp;</td>");
                    }
                echo("</tr>");
            }
        ?>
        </tbody>
        </table>
    </div>
</div>
<!-- DIALOG JQUERY -->
<div id="dialog_cadis" title="Catatan : Revisi / Perbaikan Data Riwayat Jabatan" style="display: none;">
    
</div>
<!-- ------------- -->