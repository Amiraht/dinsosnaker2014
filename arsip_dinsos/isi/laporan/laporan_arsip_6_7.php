<script type="text/javascript">
function hapus(id){
    jConfirm("Anda yakin akan menghapus data ini?", "PERHATIAN", function(r){
       if(r){
            //alert("HAPUS " + id);
            document.location.href="php/hapus_pps.php?id=" + id + "&tipe_pps=<?php echo($_GET["tipe_pps"]); ?>";
       } 
    });
}
function tambah(tipe_pps){
    //$.fancybox.open("indexpanel.php?mod=tambah_pps&tipe_pps=" + tipe_pps);
    document.location.href="?mod=tambah_pps&tipe_pps=" + tipe_pps;
}
function edit(id, pengaduan, tipe_pps){
    document.location.href="?mod=edit_pps&id_pengaduan=" + id + "&pengaduan=" + pengaduan + "&tipe_pps=" + tipe_pps;
}
function detail(id){
    window.open("isi/cetak_laporan/detail_pps.php?id=" + id);
}
function cetak(){
    window.open("isi/cetak_laporan/laporan_arsip_6_7.php?tipe_pps=<?php echo($_GET["tipe_pps"]); ?>");
}
</script>
<div class="panelcontainer" style="width: 100%;">
    <h3>
    <?php
        $nama = "";
        switch($_GET["tipe_pps"]){
            case 1 :
                echo("DAFTAR PENGADUAN YANG PERNAH DIBUAT");
                $nama = "Pengaduan";
                break;
            case 2 :
                echo("DAFTAR PESAN DAN SARAN YANG PERNAH DIBUAT");
                $nama = "Pesan Dan Saran";
                break;
        }
    ?>
    </h3>
    <div class="bodypanel">
    <input type="button" value="Cetak" onclick="cetak();" style="padding: 5px 20px;" />
    <div class="kelang"></div>
    <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
        <tr class="headertable">
            <th width='40px'>No.</th>
            <th>Isi</th>
            <th width='120px'>Status</th>
            <th width='250px'>Posisi Disposisi</th>
            <th width='100px'>Tanggal Laporan</th>
            <th width='40px'>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php
        	/* KAKAN ONLY */
			$whr_kakan = "1";
			if($_SESSION["id_unit_kerja"] != 0){
				$whr_kakan = "a.id_anggota = " . $_SESSION["id_pengguna"] . "";
			}
			/* ********** */
            $res = mysql_query(" SELECT  
         		                     a.id_pengaduan, a.pengaduan, b.jabatan AS disposisi_sekarang, a.tgl_pengaduan, a.tipe_disposisi  
                                 FROM  
                                	 tbl_pengaduan_pesan_saran a  
                                	 LEFT JOIN ref_jabatan b ON a.id_jabatan_tujuan = b.id_jabatan  
                                 WHERE  
                                	 " . $whr_kakan . " AND a.tipe_pps = '" . $_GET["tipe_pps"] . "'  
                                 ORDER BY  
                                	 a.id_pengaduan ASC ");
            $ctr = 0;
            while($ds = mysql_fetch_array($res)){
                $ctr++;
        ?>
            <tr>
                <td align='center'><?php echo($ctr); ?></td>
                <td><?php echo($ds["pengaduan"]); ?></td>
                <td align='center'>
                    <?php
                        switch($ds["tipe_disposisi"]){
                            case 1 :
                                echo("Pemrosesan");
                                break;
                            case 2 :
                                echo("Disposisi Hasil");
                                break;
                            case 3 :
                                echo("Selesai Diproses");
                                break;
                        }
                    ?>
                </td>
                <td align='center'><?php echo($ds["disposisi_sekarang"]); ?></td>
                <td align='center'><?php echo($ds["tgl_pengaduan"]); ?></td>
                <td align='center'>
                    <img src='image/View-32.png' width='18px' class='linkimage' title='Edit Isi <?php echo($nama); ?>' onclick='detail(<?php echo($ds["id_pengaduan"]); ?>);' />
                </td>
            </tr>
        <?php
            }
        ?>
        </tbody>
    </table>
</div>