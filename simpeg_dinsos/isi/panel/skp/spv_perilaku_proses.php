<script type="text/javascript">
$(document).ready(function(){
    $( "#helper_tugas_tambahan" ).dialog({
        autoOpen: false,
		height: "auto",
		width: "800",
		modal: true,
        show: "fade",
		hide: "fade"
    }); 
    $( "#helper_kreatifitas" ).dialog({
        autoOpen: false,
		height: "auto",
		width: "1300",
		modal: true,
        show: "fade",
		hide: "fade"
    });
});
function show_tugas_tambahan(){
    $("#hlp_tugas_tambahan").val(0);
    $( "#helper_tugas_tambahan" ).dialog("open");
}
function show_kreatifitas(){
    $("#hlp_kreatifitas").val(0);
    $( "#helper_kreatifitas" ).dialog("open");
}
function pilih_tugas_tambahan(){
    $("#tugas_tambahan").val($("#hlp_tugas_tambahan").val());
    $( "#helper_tugas_tambahan" ).dialog("close");
}
function pilih_kreatifitas(){
    $("#kreatifitas").val($("#hlp_kreatifitas").val());
    $( "#helper_kreatifitas" ).dialog("close");
}
</script>
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">DATA PERIODE <?php echo(strtoupper(detail_pegawai($ds["id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($ds["id_pegawai"], "nip"))); ?>)</h3>
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
            </tr>
            <tr>
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
<?php
    $ds_skp = mysql_fetch_array(mysql_query("SELECT * FROM tbl_skp_perilaku WHERE id_skp='" . $_GET["id_skp"] . "'"));
?>
<form name="frm" id="frm" action="php/skp/spv_perilaku_proses.php" method="post">
<input type="hidden" name="id_skp" value="<?php echo($_GET["id_skp"]); ?>" />
<input type="hidden" name="id_tujuan" value="<?php echo($ds["id_pegawai"]); ?>" />
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">ISI DATA PENILAIAN PERILAKU PEGAWAI <?php echo(strtoupper(detail_pegawai($ds["id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($ds["id_pegawai"], "nip"))); ?>)</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <input type="button" value="Kembali" onclick="document.location.href='?mod=spv_perilaku';" />
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <b>
                    Status supervisi atasan pejabat penilai :
                    <i>
                    <?php
                        switch($ds_skp["status_supervisi"]){
                            case 1 :
                                echo("Belum di supervisi");
                                break;
                            case 2 :
                                echo("Perlu perbaikan");
                                break;
                            case 3 :
                                echo("Diterima");
                                break;
                        }
                    ?>
                    </i>
                    
                    </b>
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0'>
            <tr>
                <td width='150px'><b>ORIENTASI PELAYANAN</b></td>
                <td width='300px' style="text-align: justify;">
                    Sikap dan perilaku kerja PNS dalam memberikan pelayanan terbaik kepada
                    yang dilayani antara lain meliputi masyarakat, atasan, rekan sekerja,
                    unit kerja terkait, dan/atau instansi lain
                </td>
                <td width='200px'>
                    <input type="text" name="orientasi_pelayanan" id="orientasi_pelayanan" placeholder=":: Orientasi Pelayanan ::" value="<?php echo($ds_skp["orientasi_pelayanan"]); ?>" />
                </td>
                
                <td>&nbsp;</td>
                
                <td width='100px'><b>DISIPLIN</b></td>
                <td width='300px' style="text-align: justify;">
                    Kesanggupan PNS untuk mentaati kewajiban dan menghindari larangan yang
                    ditentukan dalam peraturan per-uu-an dan/atau peraturan kedinasan yang
                    apabila tidak ditaati atau dilanggar dijatuhi hukuman disiplin
                </td>
                <td width='200px'>
                    <input type="text" name="disiplin" id="disiplin" placeholder=":: Disiplin ::" value="<?php echo($ds_skp["disiplin"]); ?>" />
                </td>
            </tr>
            <tr>
                <td><b>INTEGRITAS</b></td>
                <td style="text-align: justify;">
                    Kemampuan untuk bertindak sesuai dengan nilai, norma
                    dan etika dalam organisasi
                </td>
                <td>
                    <input type="text" name="integritas" id="integritas" placeholder=":: Integritas ::" value="<?php echo($ds_skp["integritas"]); ?>" />
                </td>
                
                <td>&nbsp;</td>
                
                <td><b>KERJA SAMA</b></td>
                <td style="text-align: justify;">
                    Kemauan dan kemampuan PNS untuk bekerjasama dgn rekan sekerja, atasan,
                    bawahan dalam unit kerjanya serta instansi lain dlm menyelesaikan suatu
                    tugas dan tanggung jawab yang ditentukan, sehingga mencapai daya guna dan
                    hasil guna yang sebesar-besarnya
                </td>
                <td>
                    <input type="text" name="kerja_sama" id="kerja_sama" placeholder=":: Kerja Sama ::" value="<?php echo($ds_skp["kerja_sama"]); ?>" />
                </td>
            </tr>
            <tr>
                <td><b>KOMITMEN</b></td>
                <td style="text-align: justify;">
                    Kemauan dan kemampuan untuk menyelaraskan sikap dan tindakan PNS yang mewujudkan
                    tujuan organisasi dengan mengutamakan kepentingan dinas daripada kepentingan diri
                    sendiri, seseorang, dan/atau golongan
                </td>
                <td>
                    <input type="text" name="komitmen" id="komitmen" placeholder=":: Komitmen ::" value="<?php echo($ds_skp["komitmen"]); ?>" />
                </td>
                
                <td>&nbsp;</td>
                
                <td><b>KEPEMIMPINAN</b></td>
                <td style="text-align: justify;">
                    Kemampuan dan kemauan PNS untuk memotivasi dan mempengaruhi bawahan atau orang
                    lain yg berkaitan dgn bidang tugasnya demi tercapainya tujuan organisasi
                </td>
                <td>
                    <input type="text" name="kepemimpinan" id="kepemimpinan" placeholder=":: Kepemimpinan ::" value="<?php echo($ds_skp["kepemimpinan"]); ?>" />
                </td>
            </tr>
        </table><br />
        <?php
            if($ds_skp["status_supervisi"] == 1){
        ?>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <textarea name="catatan" placeholder="Catatan Supervisi"></textarea>
                </td>
            </tr>
            <tr>
                <td style="text-align: left;">
                    <input name="terima" type="submit" value="TERIMA" style="width: 150px; height: 40px;" />
                    <input name="tolak" type="submit" value="TOLAK" style="width: 150px; height: 40px;" />
                </td>
            </tr>
        </table>
        <?php
            }
        ?>
    </div>
</div>
</form>
<div class="kelang"></div>
<?php
    $ds_tambahan = mysql_fetch_array(mysql_query("SELECT * FROM tbl_skp_tambahan WHERE id_skp='" . $_GET["id_skp"] . "'"));
?>
<form name="frm_tugas_tambahan" id="frm_tugas_tambahan" action="php/skp/tugas_tambahan_tambah.php" method="post">
<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">DATA TUGAS TAMBAHAN <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nip"))); ?>)</h3>
    <div class="bodypanel">
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
                            <img src='image/Delete-32.png' width='18px' class='linkimage' title='Hapus data tugas tambahan' onclick='document.location.href=\"php/skp/tugas_tambahan_hapus.php?id_skp_tugas_tambahan=" . $ds_tugas_tambahan["id_skp_tugas_tambahan"] . "&id_skp=" . $_GET["id"] . "\"' />
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
    <h3 style="text-align: left;">DATA KREATIFITAS <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nip"))); ?>)</h3>
    <div class="bodypanel">
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
                            <img src='image/Delete-32.png' width='18px' class='linkimage' title='Hapus data tugas tambahan' onclick='document.location.href=\"php/skp/kreatifitas_hapus.php?id_skp_kreatifitas=" . $ds_tugas_tambahan["id_skp_kreatifitas"] . "&id_skp=" . $_GET["id"] . "\"' />
                         </td>");
                echo("</tr>");
            }
        ?>
        </tbody>
    </table>
    </div>
</div>
</form>
<!-- DIALOG JQUERY ------------------------------------------------------------------------------------------------- -->
<div id="helper_tugas_tambahan" title="BANTUAN : TUGAS TAMBAHAN" style="display: none;">
<div class="panelcontainer panelform" style="width: 100%;">
    <div class="bodypanel">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <select id="hlp_tugas_tambahan">
                        <option value="0">:: Pilih Kriteria Tugas Tambahan ::</option>
                        <option value="1">Tugas tambahan yang dilakukan dalam satu tahun sebanyak 1 (satu) sampai 3 (tiga) kegiatan</option>
                        <option value="2">Tugas tambahan yang dilakukan dalam satu tahun sebanyak 4 (empat) sampai 6 (enam) kegiatan</option>
                        <option value="3">Tugas tambahan yang dilakukan dalam satu tahun sebanyak 7 (tujuh) kegiatan atau lebih</option>
                    </select>
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='40%'>
            <tr>
                <td style="text-align: left;">
                    <input type="button" value="OK" style="width: 80px; height: 40px;" onclick="pilih_tugas_tambahan();" />
                </td>
            </tr>
        </table>
    </div>
</div>
</div>

<div id="helper_kreatifitas" title="BANTUAN : KREATIFITAS" style="display: none;">
<div class="panelcontainer panelform" style="width: 100%;">
    <div class="bodypanel">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <select id="hlp_kreatifitas">
                        <option value="0">:: Pilih Kriteria Kreatifitas ::</option>
                        <option value="3">Apabila hasil yang ditemukan merupakan sesuatu yang baru dan bermanfaat bagi unit kerjanya dan dibuktikan dengan surat keterangan yang ditandatangani oleh kepala unit kerja setingkat eselon II</option>
                        <option value="6">Apabila hasil yang ditemukan merupakan sesuatu yang baru dan bermanfaat bagi organisasinya serta dibuktikan dengan surat keterangan yang ditandatangani oleh PPK</option>
                        <option value="12">Apabila hasil yang ditemukan merupakan sesuatu yang baru dan bermanfaat bagi Negara dengan penghargaan yang diberikan oleh Presiden</option>
                    </select>
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='40%'>
            <tr>
                <td style="text-align: left;">
                    <input type="button" value="OK" style="width: 80px; height: 40px;" onclick="pilih_kreatifitas();" />
                </td>
            </tr>
        </table>
    </div>
</div>
</div>
<!-- --------------------------------------------------------------------------------------------------------------- -->