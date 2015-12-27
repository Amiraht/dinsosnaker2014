<script type="text/javascript">
function hapusfile(id){
    jConfirm("Anda yakin ingin menghapus file ini?", "PERHATIAN", function(r){
        if(r){
            var id_arsip = <?php echo($_GET["id"]); ?>;
            document.location.href="php/hapus_file_digital_arsip.php?id=" + id + "&id_arsip=" + id_arsip;
        }
    });
}
function download(id){
    window.open("php/download_digitalisasi.php?id=" + id);
}
</script>
<div class="panelcontainer" style="width: 100%;">
    <h3>DATA ARSIP YANG DIPINJAM SECARA DIGITAL</h3>
    <?php
        $res_arsip = mysql_query("SELECT
                    	a.*, c.unit_kerja, d.masalah, e.jenis_arsip
                    FROM
                    	tbl_benda_arsip a
                    	LEFT JOIN ref_unit_kerja c ON a.id_unit_kerja = c.id_unit_kerja
                    	LEFT JOIN ref_masalah d ON a.id_masalah  = d.id_masalah
                    	LEFT JOIN ref_jenis_arsip e ON a.id_jenis_arsip = e.id_jenis_arsip
                    WHERE
                    	a.id_arsip='" . $_GET["id"] . "'
                    ORDER BY
                    	a.tahun");
        $ds_arsip = mysql_fetch_array($res_arsip);
    ?>
    <div class="bodypanel" id="bodyfilter">
        <input type="button" value="Kembali" onclick='document.location.href="?mod=peminjaman_digital";' />
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
             <tr>
                <td width='10%'>Kode Klasifikasi</td>
                <td width='10px'>:</td>
                <td><b><?php echo($ds_arsip["kode_klasifikasi"]); ?></b></td>
            </tr>
            <tr>
                <td width='10%'>Indeks</td>
                <td width='10px'>:</td>
                <td><b><?php echo($ds_arsip["indeks"]); ?></b></td>
            </tr>
            <tr>
                <td width='10%'>Masalah</td>
                <td width='10px'>:</td>
                <td><b><?php echo($ds_arsip["masalah"]); ?></b></td>
            </tr>
            <tr>
                <td width='10%'>Deskripsi</td>
                <td width='10px'>:</td>
                <td><b><?php echo($ds_arsip["uraian"]); ?></b></td>
            </tr>
            <tr>
                <td width='10%'>Tahun</td>
                <td width='10px'>:</td>
                <td><b><?php echo($ds_arsip["tahun"]); ?></b></td>
            </tr>
            <tr>
                <td width='10%'>Sampul</td>
                <td width='10px'>:</td>
                <td><b><?php echo($ds_arsip["sampul"]); ?></b></td>
            </tr>
            <tr>
                <td width='10%'>Kotak</td>
                <td width='10px'>:</td>
                <td><b><?php echo($ds_arsip["box"]); ?></b></td>
            </tr>
            <tr>
                <td width='10%'>Rak</td>
                <td width='10px'>:</td>
                <td><b><?php echo($ds_arsip["rak"]); ?></b></td>
            </tr>
        </table>
    </div>
</div>
<div class="kelang"></div>
<div class="panelcontainer" style="width: 100%;">
    <h3>DAFTAR FILE DIGITAL</h3>
    <div class="bodypanel">
    <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
        <tr class="headertable">
            <th width='40px'>No.</th>
            <th>Nama File</th>
            <th width='100px'>Ekstensi</th>
            <th width='150px'>Ukuran</th>
            <th width='20px'>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $res = mysql_query("SELECT id_file, nama_file, ekstensi, OCTET_LENGTH(file) AS ukuran FROM tbl_file_arsip_digital WHERE id_surat_masuk = '" . $_GET["id"] . "'");
            $ctr = 0;
            while($ds = mysql_fetch_array($res)){
                $ctr++;
        ?>
            <tr>
                <td align='center'><?php echo($ctr); ?></td>
                <td><?php echo($ds["nama_file"]); ?></td>
                <td align='center'><?php echo($ds["ekstensi"]); ?></td>
                <td align='center'><?php echo(($ds["ukuran"] / 1000) . " Kb"); ?></td>
                <td>
                    <img src='image/Upload-48.png' width='18px' class='linkimage' title='Download File' onclick='download(<?php echo($ds["id_file"]); ?>);' />
                </td>
            </tr>
        <?php
            }
        ?>
        </tbody>
    </table>
</div>