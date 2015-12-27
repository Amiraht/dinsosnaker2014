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
function lanjut(id){
    document.location.href="?mod=skp_uraian&id=" + id;
}
function catatan(id_skp){
    $("#dialog_cadis").dialog("open");
    $.ajax({
        type: "GET",
        url: "ajax/cadis_spv_skp.php",
        data: "id_skp=" + id_skp,
        success: function(r){
            $("#dialog_cadis").html(r);
        }
    });
}
function tambah(id_skp){
    <?php
        $res_ada_yg_blm_spv = mysql_query("SELECT * FROM tbl_skp WHERE id_pegawai = '" . $_SESSION["simpeg_id_pegawai"] . "' AND (status_supervisi = 1 OR status_supervisi = 2)");
        if(mysql_num_rows($res_ada_yg_blm_spv) > 0){
    ?>
            jAlert("Maaf, masih ada data yang belum disupervisi atau belum direvisi", "PERHATIAN");
    <?php
        }else{
    ?>
            document.location.href='?mod=skp_target_tambah&id_skp=' + id_skp;
    <?php
        }
    ?>
}
function edit(id_skp){
    document.location.href='?mod=skp_target_tambah&id_skp=' + id_skp;
}
</script>
<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">DATA PERIODE PENILAIAN <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nip"))); ?>)</h3>
    <div class="bodypanel">
        <input type="button" value="Tambah Data Periode Penilaian" onclick="tambah(0);" />
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
            <tr class="headertable">
                <th width='5'>&nbsp;</th>
                <th width='40px'>No.</th>
                <th>Periode</th>
                <th width='450px'>Pejabat Penilai</th>
                <th width='450px'>Atasan Pejabat Penilai</th>
                <th width='20px'>&nbsp;</th>
                <th width='20px'>&nbsp;</th>
                <th width='20px'>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $res = mysql_query("SELECT
                                	a.*, b.nama_pegawai AS nama_pegawai_penilai, b.nip AS nip_penilai, 
	                                c.nama_pegawai AS nama_pegawai_atasan_penilai, c.nip AS nip_atasan_penilai
                                FROM
                                	tbl_skp a
                                	LEFT JOIN tbl_pegawai b ON a.id_pegawai_penilai = b.id_pegawai
                                	LEFT JOIN tbl_pegawai c ON a.id_atasan_pegawai_penilai = c.id_pegawai
                                WHERE
                                	a.id_pegawai = '" . $_SESSION["simpeg_id_pegawai"] . "'
                                ORDER BY
                                	a.dari ASC
                                ");
            $no = 0;
            while($ds = mysql_fetch_array($res)){
                $no++;
                echo("<tr>");
                    echo("<td align='center'>" . status_supervisi($ds["status_supervisi"]) . "</td>");
                    echo("<td align='center'>" . $no . "</td>");
                    //echo("<td align='center'>" . $ds["dari"] . "<br/>S/D<br/>" . $ds["dari"] . "</td>");
                    echo("<td align='center'>" . tglindonesia($ds["dari"]) . " S/D " . tglindonesia($ds["sampai"]) . "</td>");
                    echo("<td align='center'>" . $ds["nama_pegawai_penilai"] . " (NIP : " . $ds["nip_penilai"] . ")</td>");
                    echo("<td align='center'>" . $ds["nama_pegawai_atasan_penilai"] . " (NIP : " . $ds["nip_atasan_penilai"] . ")</td>");
                    echo("<td>
                            <img src='image/Edit-32.png' width='18px' class='linkimage' title='Edit Data Periode' onclick='edit(" . $ds["id_skp"] . ")' />
                         </td>");
                    echo("<td>
                            <img src='image/icon-disposisi.png' width='18px' class='linkimage' title='Lihat catatan supervisi' onclick='catatan(" . $ds["id_skp"] . ")' />
                         </td>");
                    echo("<td>
                            <img src='image/Text-Signature-32.png' width='18px' class='linkimage' title='Lanjut Untuk Mengisikan Uraian Kegiatan' onclick='lanjut(" . $ds["id_skp"] . ")' />
                         </td>");
                echo("</tr>");
            }
        ?>
        </tbody>
        </table>
    </div>
</div>
<!-- DIALOG JQUERY -->
<div id="dialog_cadis" title="Catatan : Supervisi SKP" style="display: none;">
    
</div>
<!-- ------------- -->