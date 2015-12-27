<script type="text/javascript">
function hapus(id_riwayat_pangkat){
    jConfirm("Anda yakin ingin menghapus data riwayat pangkat ini?", "PERHATIAN", function(r){
        if(r){
            document.location.href="php/riwayat_pangkat/riwayat_pangkat_hapus.php?id_riwayat_pangkat=" + id_riwayat_pangkat;
        }
    });
}
function edit(id_riwayat_pangkat){
    document.location.href="?mod=riwayat_pangkat_edit&id_riwayat_pangkat=" + id_riwayat_pangkat;
}
</script>
<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">DATA RIWAYAT KEPANGKATAN <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nip"))); ?>)</h3>
    <div class="bodypanel">
        <input type="button" value="Tambah Data Riwayat Pangkat" onclick="document.location.href='?mod=riwayat_pangkat_tambah';" />
        <div class="kelang"></div>
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
                <th width='20px'>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $res = mysql_query("SELECT
                                	a.*, b.pangkat, b.gol_ruang, MD5(a.id_riwayat_pangkat) AS id_hash
                                FROM
                                	tbl_riwayat_pangkat a
                                	LEFT JOIN ref_pangkat b ON a.id_pangkat = b.id_pangkat
                                WHERE
                                	a.id_pegawai='" . $_SESSION["simpeg_id_pegawai"] . "'
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
                            <img src='image/Edit-32.png' width='18px' class='linkimage' title='Edit' onclick='edit(\"" . $ds["id_hash"] . "\");' />
                        </td>");
                    echo("<td>
                            <img src='image/Delete-32.png' width='18px' class='linkimage' title='Hapus' onclick='hapus(" . $ds["id_riwayat_pangkat"] . ");' />
                        </td>");
                echo("</tr>");
            }
        ?>
        </tbody>
        </table>
    </div>
</div>