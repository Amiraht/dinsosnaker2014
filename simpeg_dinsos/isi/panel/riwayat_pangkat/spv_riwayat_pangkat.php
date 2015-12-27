<script type="text/javascript">
function lanjut(id_riwayat_pangkat){
    document.location.href="?mod=spv_riwayat_pangkat_proses&id_riwayat_pangkat=" + id_riwayat_pangkat;
}
</script>
<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">DATA RIWAYAT KEPANGKATAN <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nip"))); ?>)</h3>
    <div class="bodypanel">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
            <tr class="headertable">
                <th width='40px'>No.</th>
                <th width='200px'>Pangkat</th>
                <th width='100px'>Gol. Ruang</th>
                <th width='200px'>TMT</th>
                <th width='200px'>No. SK</th>
                <th width='200px'>Tanggal SK</th>
                <th>Pejabat Penetapan</th>
                <th width='20px'>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $res = mysql_query("SELECT
                                	a.*, b.pangkat, b.gol_ruang, MD5(a.id_data) AS id_hash
                                FROM
                                	tbl_riwayat_pangkat a
                                	LEFT JOIN ref_pangkat b ON a.id_pangkat = b.id_pangkat
                                WHERE
                                	a.id_pegawai='" . $_SESSION["simpeg_id_pegawai"] . "' AND status = 1
                                ORDER BY
                                	a.tmt ASC");
            $no=0;
            while($ds=mysql_fetch_array($res)){
                $no++;
                echo("<tr>");
                    echo("<td align='center'>" . $no . "</td>");
                    echo("<td align='center'>" . $ds["pangkat"] . "</td>");
                    echo("<td align='center'>" . $ds["gol_ruang"] . "</td>");
                    echo("<td align='center'>" . tglindonesia($ds["tmt"]) . "</td>");
                    echo("<td align='center'>" . $ds["no_sk"] . "</td>");
                    echo("<td align='center'>" . tglindonesia($ds["tgl_sk"]) . "</td>");
                    echo("<td align='center'>" . $ds["pejabat_penetapan"] . "</td>");
                    echo("<td>
                            <img src='image/Text-Signature-32.png' width='18px' class='linkimage' title='Lanjut' onclick='lanjut(\"" . $ds["id_data"] . "\");' />
                        </td>");
                echo("</tr>");
            }
        ?>
        </tbody>
        </table>
    </div>
</div>