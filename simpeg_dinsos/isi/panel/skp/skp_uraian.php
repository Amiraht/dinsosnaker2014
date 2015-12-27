<script type="text/javascript">
function realisasi(id_uraian_skp){
    //document.location.href="?mod=skp_realisasi&id_skp=<?php echo($_GET["id"]); ?>&id_uraian_skp=" + id_uraian_skp;
    alert("Maaf, Konten ini telah dipindahkan ke modul lain");
}
function tambah(){
    <?php
        $ds_udh_acc = mysql_fetch_array(mysql_query("SELECT * FROM tbl_skp WHERE id_skp='" . $_GET["id"] . "'"));
        if($ds_udh_acc["status_supervisi"] == 3){
    ?>
            jAlert("Maaf, SKP ini sudah di ACC (terima) oleh Pejabat Penilai. Data SKP tidak bisa dirubah kembali", "PERHATIAN");
    <?php
        }else{
    ?>
            document.location.href='?mod=skp_uraian_tambah&id_skp=<?php echo($_GET["id"]); ?>&id_uraian_skp=0';
    <?php
        }
    ?>
}
function edit(id_uraian_skp){
    <?php
        $ds_udh_acc = mysql_fetch_array(mysql_query("SELECT * FROM tbl_skp WHERE id_skp='" . $_GET["id"] . "'"));
        if($ds_udh_acc["status_supervisi"] == 3){
    ?>
            jAlert("Maaf, SKP ini sudah di ACC (terima) oleh Pejabat Penilai. Data SKP tidak bisa dirubah kembali", "PERHATIAN");
    <?php
        }else{
    ?>
            document.location.href='?mod=skp_uraian_tambah&id_skp=<?php echo($_GET["id"]); ?>&id_uraian_skp=' + id_uraian_skp;
    <?php
        }
    ?>
}
function hapus(id_uraian_skp){
    <?php
        $ds_udh_acc = mysql_fetch_array(mysql_query("SELECT * FROM tbl_skp WHERE id_skp='" . $_GET["id"] . "'"));
        if($ds_udh_acc["status_supervisi"] == 3){
    ?>
            jAlert("Maaf, SKP ini sudah di ACC (terima) oleh Pejabat Penilai. Data SKP tidak bisa dirubah kembali", "PERHATIAN");
    <?php
        }else{
    ?>
            jConfirm("Anda yakin akan menghapus data uraian target SKP ini?", "PERHATIAN", function(r){
                if(r){
                    document.location.href="php/skp/skp_uraian_hapus.php?id_skp=<?php echo($_GET["id"]); ?>&id_uraian_skp=" + id_uraian_skp;
                }
            });
    <?php
        }
    ?>
}
</script>
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">DATA SKP <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nip"))); ?>)</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <?php
            $ds = mysql_fetch_array(mysql_query("SELECT
                                	a.*, b.nama_pegawai AS nama_pegawai_penilai, b.nip AS nip_penilai, 
                                	c.nama_pegawai AS nama_pegawai_atasan_penilai, c.nip AS nip_atasan_penilai,
                                	d.pangkat AS pangkat_penilai, d.gol_ruang AS gol_ruang_penilai,
                                	e.pangkat AS pangkat_atasan_penilai, e.gol_ruang AS gol_ruang_atasan_penilai,
                                	f.skpd AS skpd_penilai, g.skpd AS skpd_atasan_penilai,
                                	h.jabatan AS jabatan_penilai, i.jabatan AS jabatan_atasan_penilai
                                FROM
                                	tbl_skp a
                                	LEFT JOIN tbl_pegawai b ON a.id_pegawai_penilai = b.id_pegawai
                                	LEFT JOIN tbl_pegawai c ON a.id_atasan_pegawai_penilai = c.id_pegawai
                                	LEFT JOIN ref_pangkat d ON b.id_pangkat = d.id_pangkat
                                	LEFT JOIN ref_pangkat e ON c.id_pangkat = e.id_pangkat
                                	LEFT JOIN ref_skpd f ON b.id_satuan_organisasi = f.id_skpd
                                	LEFT JOIN ref_skpd g ON c.id_satuan_organisasi = g.id_skpd
                                	LEFT JOIN ref_jabatan h ON b.id_jabatan = h.id_jabatan
                                	LEFT JOIN ref_jabatan i ON c.id_jabatan = i.id_jabatan
                                WHERE
                                	a.id_skp='" . $_GET["id"] . "'
                                ORDER BY
                                	a.dari ASC
                                "));
        ?>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='150px'>Periode</td>
                <td width='5px'>:</td>
                <td style="text-transform: uppercase;"><b><?php echo(tglindonesia($ds["dari"]) . " S/D " . tglindonesia($ds["sampai"])); ?></b></td>
                <td width='150px'>&nbsp;</td>
                <td width='5px'>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Pejabat Penilai</td>
                <td>:</td>
                <td style="text-transform: uppercase;">
                    <b>
                        <?php echo($ds["nama_pegawai_penilai"]); ?><br />
                        NIP : <?php echo($ds["nip_penilai"]); ?><br />
                        Pangkat : <?php echo($ds["pangkat_penilai"]); ?><br />
                        Jabatan : <?php echo($ds["jabatan_penilai"]); ?><br />
                        SKPD : <?php echo($ds["skpd_penilai"]); ?>
                    </b>
                </td>
                
                <td>Atasan Pejabat Penilai</td>
                <td>:</td>
                <td style="text-transform: uppercase;">
                    <b>
                        <?php echo($ds["nama_pegawai_atasan_penilai"]); ?><br />
                        NIP : <?php echo($ds["nip_atasan_penilai"]); ?><br />
                        Pangkat : <?php echo($ds["pangkat_atasan_penilai"]); ?><br />
                        Jabatan : <?php echo($ds["jabatan_atasan_penilai"]); ?><br />
                        SKPD : <?php echo($ds["skpd_atasan_penilai"]); ?>
                    </b>
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="kelang"></div>
<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">URAIAN DATA SKP PEGAWAI <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nip"))); ?>)</h3>
    <div class="bodypanel">
        <input type="button" value="Kembali" onclick="document.location.href='?mod=skp_target';" />
        <input type="button" value="Tambah Data Uraian SKP" onclick="tambah();" />
        <input type="button" value="Cetak Output Target SKP" onclick="window.open('cetak/cetak_target_skp.php?id_skp=<?php echo($_GET["id"]); ?>');" />
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
            <tr class="headertable">
                <th width='40px'>No.</th>
                <th>Kegiatan / Tugas Jabatan</th>
                <th width='50px'>AK</th>
                <th width='150px'>Kuantitas / Output</th>
                <th width='150px'>Kualitas / Mutu</th>
                <th width='150px'>Waktu (Bulan)</th>
                <th width='150px'>Biaya</th>
                <th width='20px'>&nbsp;</th>
                <th width='20px'>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $res = mysql_query("SELECT
                                	a.*, b.satuan_waktu
                                FROM
                                	tbl_uraian_skp a
                                    LEFT JOIN ref_satuan_waktu b ON a.id_satuan_waktu = b.id_satuan_waktu
                                WHERE
                                	a.id_skp = '" . $_GET["id"] . "'");
            $no = 0;
            while($ds = mysql_fetch_array($res)){
                $no++;
                echo("<tr>");
                    echo("<td align='center'>" . $no . "</td>");
                    echo("<td>" . $ds["kegiatan"] . "</td>");
                    echo("<td align='center'>" . ($ds["ak"] * $ds["kuantitas"]) . "</td>");
                    echo("<td align='center'>" . $ds["kuantitas"] . " " . $ds["satuan_kuantitas"] . "</td>");
                    echo("<td align='center'>" . $ds["kualitas"] . " %</td>");
                    echo("<td align='center'>" . $ds["waktu"] . " " . $ds["satuan_waktu"] . "</td>");
                    echo("<td align='center'>" . number_format($ds["biaya"], 0, ".", ",") . "</td>");
                    echo("<td>
                            <img src='image/Edit-32.png' width='18px' class='linkimage' title='Edit data target kegiatan' onclick='edit(" . $ds["id_uraian_skp"] . ")' />
                         </td>");
                    echo("<td>
                            <img src='image/Delete-32.png' width='18px' class='linkimage' title='Hapus data target kegiatan' onclick='hapus(" . $ds["id_uraian_skp"] . ")' />
                         </td>");
                echo("</tr>");
            }
        ?>
        </tbody>
        </table>
    </div>
</div>