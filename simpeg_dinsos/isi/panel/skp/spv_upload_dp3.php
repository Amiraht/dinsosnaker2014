<script type="text/javascript">
function lanjut(id_skp){
    document.location.href = "?mod=spv_upload_dp3_proses&id_skp=" + id_skp;
}
</script>
<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">PILIH PEGAWAI YANG AKAN DISUPERVISI UPLOAD HASIL PENILAIAN</h3>
    <div class="bodypanel">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
            <tr class="headertable">
                <th width='40px'>No.</th>
                <th width='200px'>NIP</th>
                <th width='250px'>Nama Pegawai</th>
                <th width='250px'>Jabatan</th>
                <th>Periode</th>
                <th width='20px'>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $res = mysql_query("SELECT
                                	a.id_pegawai, a.nama_pegawai, a.nip,
                                	b.pangkat, b.gol_ruang,
                                	c.jabatan, d.skpd,
                                	e.dari, e.sampai, e.id_skp
                                FROM
                                	tbl_pegawai a
                                	LEFT JOIN ref_pangkat b ON a.id_pangkat = b.id_pangkat
                                	LEFT JOIN ref_jabatan c ON a.id_jabatan = c.id_jabatan
                                	LEFT JOIN ref_skpd d ON a.id_satuan_organisasi = d.id_skpd
                                	LEFT JOIN tbl_skp e ON a.id_pegawai = e.id_pegawai
                                	LEFT JOIN tbl_skp_dp3_upload f ON e.id_skp = f.id_skp
                                WHERE
                                	1 AND e.id_pegawai_penilai = '" . $_SESSION["simpeg_id_pegawai"] . "' AND f.status_supervisi = 1
                                GROUP BY
                                		a.id_pegawai
                                ORDER BY
                                		a.nama_pegawai ASC");
            $no = 0;
            while($ds = mysql_fetch_array($res)){
                $no++;
                echo("<tr>");
                    echo("<td align='center'>" . $no . "</td>");
                    echo("<td align='center'>" . $ds["nip"] . "</td>");
                    echo("<td align='center'>" . $ds["nama_pegawai"] . "</td>");
                    echo("<td align='center'>" . $ds["jabatan"] . "</td>");
                    echo("<td align='center'>" . tglindonesia($ds["dari"]) . " S/D " . tglindonesia($ds["sampai"]) . "</td>");
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