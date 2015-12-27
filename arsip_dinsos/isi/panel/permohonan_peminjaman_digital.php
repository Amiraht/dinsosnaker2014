<script type="text/javascript">
function pinjam(id_arsip){
    document.location.href="php/push_pin_dig.php?id_arsip=" + id_arsip;
}
function hapus(id_arsip_dipinjam){
    document.location.href="php/del_pin_dig.php?id=" + id_arsip_dipinjam;
}
function batal(){
    jConfirm("Anda yakin akan membatalkan peminjaman ini?", "PERHATIAN", function(r){
        if(r){
            document.location.href="php/batal_pin_dig.php";
        }
    });
}
</script>
<input type="button" value="Selesai" style="padding: 5px 20px; text-transform: uppercase;" onclick="document.location.href='?mod=pin_dig';" />
<input type="button" value="Batalkan Peminjaman" style="padding: 5px 20px; text-transform: uppercase;" onclick="batal();" />
<div class="kelang"></div>
<div class="panelcontainer" style="width: 100%;">
    <h3>PILIH ARSIP YANG AKAN DIPINJAM SECARA DIGITAL</h3>
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
            <th width='20px'>&nbsp;</th>
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
                                    LEFT JOIN tbl_arsip_yang_dipinjam f ON (a.id_arsip = f.id_arsip AND f.id_peminjaman = '" . $_SESSION["id_pin_dig"] . "')
                                WHERE
                                    (SELECT COUNT(*) FROM tbl_file_arsip_digital WHERE id_surat_masuk = a.id_arsip) > 0
                                    AND f.id_arsip IS NULL
                                ORDER BY
                                	a.tahun");
            /*echo("SELECT
                                	a.*, c.unit_kerja, d.masalah, e.jenis_arsip
                                FROM
                                	tbl_benda_arsip a
                                	LEFT JOIN ref_unit_kerja c ON a.id_unit_kerja = c.id_unit_kerja
                                	LEFT JOIN ref_masalah d ON a.id_masalah  = d.id_masalah
                                	LEFT JOIN ref_jenis_arsip e ON a.id_jenis_arsip = e.id_jenis_arsip
                                WHERE
                                	a.id_unit_kerja = '" . $_SESSION["id_unit_kerja"] . "' " . $whr . "
                                ORDER BY
                                	a.tahun");*/
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
                <td>
                    <img src='image/Button Next_32.png' width='18px' class='linkimage' title='Pinjam Digital Arsip' onclick='pinjam(<?php echo($ds["id_arsip"]); ?>);' />
                </td>
            </tr>
        <?php
            }
        ?>
        </tbody>
    </table>
    </div>
</div>
<!-- ------------------------------------ -->
<div class="kelang"></div>
<div class="panelcontainer" style="width: 100%;">
    <h3>DAFTAR ARSIP YANG DIPINJAM SECARA DIGITAL</h3>
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
            <th width='20px'>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $res = mysql_query("SELECT
                                	f.id_arsip_dipinjam, a.*, c.unit_kerja, d.masalah, e.jenis_arsip
                                FROM
                                	tbl_benda_arsip a
                                	LEFT JOIN ref_unit_kerja c ON a.id_unit_kerja = c.id_unit_kerja
                                	LEFT JOIN ref_masalah d ON a.id_masalah  = d.id_masalah
                                	LEFT JOIN ref_jenis_arsip e ON a.id_jenis_arsip = e.id_jenis_arsip
                                    LEFT JOIN tbl_arsip_yang_dipinjam f ON a.id_arsip = f.id_arsip
                                WHERE
                                    (SELECT COUNT(*) FROM tbl_file_arsip_digital WHERE id_surat_masuk = a.id_arsip) > 0
                                    AND f.id_peminjaman = '" . $_SESSION["id_pin_dig"] . "'
                                ORDER BY
                                	a.tahun");
            /*echo("SELECT
                                	a.*, c.unit_kerja, d.masalah, e.jenis_arsip
                                FROM
                                	tbl_benda_arsip a
                                	LEFT JOIN ref_unit_kerja c ON a.id_unit_kerja = c.id_unit_kerja
                                	LEFT JOIN ref_masalah d ON a.id_masalah  = d.id_masalah
                                	LEFT JOIN ref_jenis_arsip e ON a.id_jenis_arsip = e.id_jenis_arsip
                                WHERE
                                	a.id_unit_kerja = '" . $_SESSION["id_unit_kerja"] . "' " . $whr . "
                                ORDER BY
                                	a.tahun");*/
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
                <td>
                    <img src='image/Delete-32.png' width='18px' class='linkimage' title='Batal Pinjam Digital Arsip' onclick='hapus(<?php echo($ds["id_arsip_dipinjam"]); ?>);' />
                </td>
            </tr>
        <?php
            }
        ?>
        </tbody>
    </table>
    </div>
</div>