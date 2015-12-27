<?php
    // MENCARI ID PEMINJAMANNYA
    $id_peminjaman = 0;
    $ds_peminjaman = mysql_fetch_array(mysql_query("SELECT *, DATEDIFF(tgl_jatuh_tempo,CURDATE()) AS sisa_hari FROM tbl_peminjaman_arsip WHERE id_anggota = '" . $_SESSION["id_pengguna"] . "' AND is_dikembalikan = 0 AND status_peminjaman=7 AND id_jenis_peminjaman = 1"));
    $id_peminjaman = $ds_peminjaman["id_peminjaman"];
    //echo($id_peminjaman . "<br>" . "SELECT * FROM tbl_peminjaman_arsip WHERE id_anggota = '" . $_SESSION["id_pengguna"] . "' AND is_dikembalikan = 0 AND status_peminjaman=7");
    if($id_peminjaman == 0)
        header("location:?mod=informasi_perpanjangan_peminjaman");
?>
<input type="button" value="Kembali" onclick="document.location.href='?mod=peminjaman';" />
<div class="kelang"></div>
<div class="panelcontainer" style="width: 100%;">
    <h3>DAFTAR ARSIP YANG DIPINJAM</h3>
    <div class="bodypanel">
    <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
            <tr class="headertable">
                <th width='40px'>No.</th>
                <th width='100px'>Kode Klasifikasi</th>
                <th width='70px'>Indeks</th>
                <th width='100px'>Masalah</th>
                <th>Uraian Masalah</th>
                <th width='70px'>Tahun</th>
                <th width='50px'>Sampul</th>
                <th width='50px'>Boks</th>
                <th width='50px'>Rak</th>
                <th width='100px'>Jenis Arsip</th>
                <th width='100px'>Keterangan</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $res = mysql_query("SELECT
                                	a.*, c.unit_kerja, d.masalah, e.jenis_arsip
                                FROM
                                	tbl_benda_arsip a
                                	LEFT JOIN ref_unit_kerja c ON a.id_unit_kerja = c.id_unit_kerja
                                	LEFT JOIN ref_masalah d ON a.id_masalah  = d.id_masalah
                                	LEFT JOIN ref_jenis_arsip e ON a.id_jenis_arsip = e.id_jenis_arsip
                                    LEFT JOIN tbl_arsip_yang_dipinjam h ON a.id_arsip = h.id_arsip  
                                WHERE
                                	1 AND h.id_peminjaman='" . $id_peminjaman . "'
                                ORDER BY
                                	a.tahun");
            $ctr = 0;
            while($ds = mysql_fetch_array($res)){
                $ctr++;
        ?>
            <tr>
                <td align='center'><?php echo($ctr); ?></td>
                <td><?php echo($ds["kode_klasifikasi"]); ?></td>
                <td><?php echo($ds["indeks"]); ?></td>
                <td><?php echo($ds["masalah"]); ?></td>
                <td><?php echo($ds["uraian"]); ?></td>
                <td align='center'><?php echo($ds["tahun"]); ?></td>
                <td align='center'><?php echo($ds["sampul"]); ?></td>
                <td align='center'><?php echo($ds["box"]); ?></td>
                <td align='center'><?php echo($ds["rak"]); ?></td>
                <td><?php echo($ds["jenis_arsip"]); ?></td>
                <td><?php echo($ds["keterangan"]); ?></td>
            </tr>
        <?php
            }
        ?>
        </tbody>
    </table>
    </div>
</div>
<div class="kelang"></div>
<div class="panelcontainer" style="width: 100%;">
    <h3>DATA PEMINJAMAN</h3>
    <div class="bodypanel" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='10%'>Tanggal Peminjaman</td>
                <td width='10px'>:</td>
                <td><b><?php echo($ds_peminjaman["tgl_peminjaman"]); ?></b></td>
            </tr>
            <tr>
                <td width='10%'>Tanggal Jatuh Tempo</td>
                <td width='10px'>:</td>
                <td><b><?php echo($ds_peminjaman["tgl_jatuh_tempo"]); ?></b></td>
            </tr>
            <tr>
                <td width='10%'>Status Dokumen</td>
                <td width='10px'>:</td>
                <td><b><?php echo($ds_peminjaman["status_dokumen"]); ?></b></td>
            </tr>
            <tr>
                <td width='10%'>Catatan</td>
                <td width='10px'>:</td>
                <td><b><?php echo($ds_peminjaman["catatan2"]); ?></b></td>
            </tr>
        </table>
    </div>
</div>
<div class="kelang"></div>
<div class="panelcontainer" style="width: 100%;">
    <h3>INFORMASI JATUH TEMPO</h3>
    <div class="bodypanel" id="bodyfilter">
    <?php
        if($ds_peminjaman["sisa_hari"] > 3)
            echo("<div style='text-align:center; font-family:sans-serif; font-size:12pt; color:green;'>Jatuh tempo pengembalian anda masih " . $ds_peminjaman["sisa_hari"] . " hari lagi</div>");
        else if($ds_peminjaman["sisa_hari"] >0 && $ds_peminjaman["sisa_hari"] <= 3)
            echo("<div style='text-align:center; font-family:sans-serif; font-size:12pt; color:red;'>Peminjaman anda akan <b>segera jatuh tempo dalam " . $ds_peminjaman["sisa_hari"] . " hari lagi</b>. Segera lakukan perpanjangan jika ingin memperpanjang waktu peminjaman</div>");
        else if($ds_peminjaman["sisa_hari"] == 0)
            echo("<div style='text-align:center; font-family:sans-serif; font-size:12pt; color:red;'>Peminjaman anda <b>jatuh tempo hari ini</b>. Segera melakukan pengembalian</div>");
        else
            echo("<div style='text-align:center; font-family:sans-serif; font-size:12pt; color:red;'>Jatuh tempo pengembalian anda <b>telah lewat " . ($ds_peminjaman["sisa_hari"] * -1) . " hari</b>. Harap segera melapor ke pihak Kantor Arsip Kota Medan</div>");
    ?>
    </div>
</div>