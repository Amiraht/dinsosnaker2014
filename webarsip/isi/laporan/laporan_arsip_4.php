<script type="text/javascript">
$(document).ready(function(){
    $("#expand").click(function(){
        $("#bodyfilter").slideToggle(500);
    });
    
    $("#tgl_surat_dari").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
    $("#tgl_terima_dari").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
    
    $("#tgl_surat_sampai").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
    $("#tgl_terima_sampai").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
});
function edit(id){
    document.location.href="?mod=edit_data_arsip&id=" + id;
}
function hapus(id){
    jConfirm("Anda yakin akan menghapus data arsip ini?", "PERHATIAN", function(r){
       if(r){
            document.location.href="php/hapus_data_arsip.php?id=" + id;
       } 
    });
}
function detail(id){
    window.open("isi/cetak_laporan/detail_peminjaman_digital.php?id=" + id);
}
function cetak(){
    window.open("isi/cetak_laporan/laporan_arsip_4.php");
}
</script>
<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-transform: uppercase;">Rekapitulasi Peminjaman Digital Yang Pernah Dilakukan</h3>
    <div class="bodypanel">
    <input type="button" value="Cetak" onclick="cetak();" style="padding: 5px 20px;" />
    <div class="kelang"></div>
    <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
        <tr class="headertable">
            <th width='40px'>No.</th>
            <th>Tanggal Peminjaman</th>
            <th width='150px'>Jumlah Dokumen</th>
            <th width='20px'>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $whr = "";
			
            /* KAKAN ONLY */
			$whr_kakan = "1";
			if($_SESSION["id_unit_kerja"] != 0){
				$whr_kakan = "a.id_anggota = " . $_SESSION["id_pengguna"] . "";
			}
			/* ********** */
			
            $res = mysql_query("SELECT
                                	a.*,
                                	(SELECT COUNT(*) FROM tbl_arsip_yang_dipinjam WHERE id_peminjaman = a.id_peminjaman) AS jml_dokumen
                                FROM
                                	tbl_peminjaman_arsip a
                                WHERE
                                	" . $whr_kakan . " AND a.id_jenis_peminjaman = 3");
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
                <td align='center'><?php echo($ds["tgl_peminjaman"]); ?></td>
                <td align='center'><?php echo($ds["jml_dokumen"]); ?> Berkas</td>
                <td>
                    <img src='image/View-32.png' width='18px' class='linkimage' title='Digitalisasi Data Arsip' onclick='detail(<?php echo($ds["id_peminjaman"]); ?>);' />
                </td>
            </tr>
        <?php
            }
        ?>
        </tbody>
    </table>
    </div>
</div>
<!-- ---------------------------------------------- -->