<div class="panelcontainer" style="width: 100%;">
    <h3>MENU APLIKASI</h3>
    <div class="bodypanel">
        <!--<li class="menubar"><a href="?mod=">!!! Pengaturan Masalah Dan Sub Masalah</a></li>-->
        <?php
            if($_SESSION["id_level"] == 2){
        ?>
        <li class="menubar"><a href="?mod=laporan_arsip_1">Rekapitulasi Arsip Yang Belum Didigitalisasi</a></li>
        <li class="menubar"><a href="?mod=laporan_arsip_2">Rekapitulasi Arsip Yang Telah Didigitalisasi</a></li>
        <li class="menubar"><a href="?mod=laporan_arsip_3">Rekapitulasi Daftar Pengumpulan Arsip (DPA)</a></li>
        <li class="menubar"><a href="?mod=laporan_arsip_cetak_kotak_sampul">Cetak Informasi Kotak Dan Sampul</a></li>
        <?php
            }else if($_SESSION["id_level"] == 11){
		?>
        	<li class="menubar"><a href="?mod=laporan_arsip_1">Rekapitulasi Arsip Yang Belum Didigitalisasi</a></li>
       		<li class="menubar"><a href="?mod=laporan_arsip_2_all">Rekapitulasi Arsip Yang Telah Didigitalisasi</a></li>
        	<li class="menubar"><a href="?mod=laporan_arsip_3_all">Rekapitulasi Daftar Pengumpulan Arsip (DPA)</a></li>
        	<li class="menubar"><a href="?mod=laporan_arsip_cetak_kotak_sampul">Cetak Informasi Kotak Dan Sampul</a></li>
            <li class="menubar"><a href="?mod=laporan_arsip_4">Rekapitulasi Peminjaman Digital Yang Pernah Dilakukan</a></li>
        	<li class="menubar"><a href="?mod=laporan_arsip_5">Rekapitulasi Peminjaman Keluar Kantor Arsip Yang Pernah Dilakukan</a></li>
        	<li class="menubar"><a href="?mod=laporan_arsip_6_7&tipe_pps=1">Rekapitulasi Pengaduan Yang Pernah Dilakukan</a></li>
       	    <li class="menubar"><a href="?mod=laporan_arsip_6_7&tipe_pps=2">Rekapitulasi Pesan Dan Saran Yang Pernah Dilakukan</a></li>
        <?php	
			}
        ?>
        
        <li class="menubar"><a href="?mod=laporan_arsip_4">Rekapitulasi Peminjaman Digital Yang Pernah Dilakukan</a></li>
        <li class="menubar"><a href="?mod=laporan_arsip_5">Rekapitulasi Peminjaman Keluar Kantor Arsip Yang Pernah Dilakukan</a></li>
        <li class="menubar"><a href="?mod=laporan_arsip_6_7&tipe_pps=1">Rekapitulasi Pengaduan Yang Pernah Dilakukan</a></li>
        <li class="menubar"><a href="?mod=laporan_arsip_6_7&tipe_pps=2">Rekapitulasi Pesan Dan Saran Yang Pernah Dilakukan</a></li>
    </div>
</div>