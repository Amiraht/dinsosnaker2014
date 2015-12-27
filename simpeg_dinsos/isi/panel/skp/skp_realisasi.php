<script type="text/javascript">
function tambah(){
    <?php
        $res_blm_acc = mysql_query("SELECT * FROM tbl_uraian_realisasi_skp WHERE id_uraian_skp = '" . $_GET["id_uraian_skp"] . "' AND (status_supervisi = 1 OR status_supervisi = 2)");
        if(mysql_num_rows($res_blm_acc) == 0){
    ?>
            document.location.href='?mod=skp_realisasi_tambah&id_skp=<?php echo($_GET["id_skp"]); ?>&id_uraian_skp=<?php echo($_GET["id_uraian_skp"]); ?>&id_uraian_realisasi_skp=0';
    <?php
        }else{
    ?>
            jAlert("Maaf, masih ada data penilaian yang belum di ACC (terima) oleh pejabat penilai", "PERHATIAN");
    <?php
        }
    ?>
}
function edit(id_uraian_realisasi_skp){
    document.location.href='?mod=skp_realisasi_tambah&id_skp=<?php echo($_GET["id_skp"]); ?>&id_uraian_skp=<?php echo($_GET["id_uraian_skp"]); ?>&id_uraian_realisasi_skp=' + id_uraian_realisasi_skp;
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
                                	a.id_skp='" . $_GET["id_skp"] . "'
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
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">URAIAN TARGET SKP</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
    <?php
        $ds_target = mysql_fetch_array(mysql_query("SELECT
                                	a.*, b.satuan_waktu
                                FROM
                                	tbl_uraian_skp a
                                    LEFT JOIN ref_satuan_waktu b ON a.id_satuan_waktu = b.id_satuan_waktu
                                WHERE
                                	a.id_uraian_skp = '" . $_GET["id_uraian_skp"] . "'"));
    ?>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='150px'>Kegiatan</td>
                <td width='5px'>:</td>
                <td width='300px' style="text-transform: uppercase;"><b><?php echo($ds_target["kegiatan"]); ?></b></td>
                
                <td width='150px'>Kualitas</td>
                <td width='5px'>:</td>
                <td style="text-transform: uppercase;"><b><?php echo($ds_target["kualitas"]); ?> %</b></td>
            </tr>
            <tr>
                <td width='150px'>AK</td>
                <td width='5px'>:</td>
                <td style="text-transform: uppercase;"><b><?php echo($ds_target["ak"] * $ds_target["kuantitas"]); ?></b></td>
                
                <td width='150px'>Waktu</td>
                <td width='5px'>:</td>
                <td style="text-transform: uppercase;"><b><?php echo($ds_target["waktu"] . " " . $ds_target["satuan_waktu"]); ?></b></td>
            </tr>
            <tr>
                <td width='150px'>Kuantitas</td>
                <td width='5px'>:</td>
                <td style="text-transform: uppercase;"><b><?php echo($ds_target["kuantitas"] . " " . $ds_target["satuan_kuantitas"]); ?></b></td>
                
                <td width='150px'>Biaya</td>
                <td width='5px'>:</td>
                <td style="text-transform: uppercase;"><b><?php echo(number_format($ds_target["biaya"], 0, ".", ",")); ?></b></td>
            </tr>
        </table>
    </div>
</div>
<div class="kelang"></div>
<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">DATA URAIAN REALISASI SKP PEGAWAI <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nip"))); ?>)</h3>
    <div class="bodypanel">
        <input type="button" value="Kembali" onclick="document.location.href='?mod=penilaian_skp_uraian&id=<?php echo($_GET["id_skp"]); ?>';" />
        <input type="button" value="Tambah Data Uraian Realisasi SKP" onclick="tambah();" />
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
            <thead>
                <tr class="headertable">
                    <th width='5px'>&nbsp;</th>
                    <th width='40px'>No.</th>
                    <th>Bulan Ke</th>
                    <th width='200px'>Angka Kredit</th>
                    <th width='200px'>Kuantitas / Output</th>
                    <th width='200px'>Kualitas / Mutu</th>
                    <th width='200px'>Waktu</th>              
                    <th width='200px'>Biaya</th>
                    <th width='20px'>&nbsp;</th>
                    <!--<th width='20px'>&nbsp;</th>-->
                </tr>
            </thead>
            <tbody>
            <?php
                $res_realisasi = mysql_query("SELECT * FROM tbl_uraian_realisasi_skp WHERE id_uraian_skp='" . $_GET["id_uraian_skp"] . "' ORDER BY id_uraian_realisasi_skp ASC");
                $no=0;
                while($ds_realisasi = mysql_fetch_array($res_realisasi)){
                    $no++;
                    echo("<tr>");
                        echo("<td align='center'>" . status_supervisi($ds_realisasi["status_supervisi"]) . "</td>");
                        echo("<td align='center'>" . $no . "</td>");
                        echo("<td align='center'>Bulan Ke : " . $no . "</td>");
                        echo("<td align='center'>" . ($ds_target["ak"] * $ds_realisasi["kuantitas"]) . "</td>");
                        echo("<td align='center'>" . $ds_realisasi["kuantitas"] . " " . $ds_target["satuan_kuantitas"] . "</td>");
                        echo("<td align='center'>" . $ds_realisasi["kualitas"] . " %</td>");
                        echo("<td align='center'>" . $ds_realisasi["waktu"] . " " . $ds_target["satuan_waktu"] . "</td>");
                        echo("<td align='center'>" . number_format($ds_realisasi["biaya"], 0, ".", ",") . "</td>");
                        echo("<td>
                            <img src='image/Edit-32.png' width='18px' class='linkimage' title='Edit data realisasi kegiatan' onclick='edit(" . $ds_realisasi["id_uraian_realisasi_skp"] . ")' />
                         </td>");
                    /*echo("<td>
                            <img src='image/Delete-32.png' width='18px' class='linkimage' title='Hapus data realisasi kegiatan' onclick='delete(" . $ds_realisasi["id_uraian_realisasi_skp"] . ")' />
                         </td>");*/
                    echo("</tr>");
                }
            ?>
            </tbody>
        </table>
    </div>
</div>