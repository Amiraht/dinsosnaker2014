<script type="text/javascript">
function lanjut(id_riwayat_pangkat){
    document.location.href="?mod=spv_riwayat_jabatan_proses&id_riwayat_jabatan=" + id_riwayat_pangkat;
}
</script>
<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">DATA RIWAYAT JABATAN <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nip"))); ?>)</h3>
    <div class="bodypanel">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
            <tr class="headertable">
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
                                	a.id_pegawai='" . $_SESSION["simpeg_id_pegawai"] . "' AND status_supervisi = 1
                                ORDER BY
                                	a.tmt ASC");
            $no = 0;
            while($ds = mysql_fetch_array($res)){
                $no++;
                echo("<tr>");
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
                            <img src='image/Text-Signature-32.png' width='18px' class='linkimage' title='Edit' onclick='lanjut(" . $ds["id_riwayat_jabatan"] . ");' />
                        </td>");
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