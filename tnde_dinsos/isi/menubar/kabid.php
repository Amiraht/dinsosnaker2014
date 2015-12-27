<div class="panelcontainer" style="width: 100%;">
    <h3>MENU APLIKASI</h3>
    <div class="bodypanel">
        <!--<li class="menubar"><a href="?mod=disposisi_surat_masuk_kabid">Proses Tindak Lanjut Surat Masuk</a></li>
        <li class="menubar"><a href="?mod=hasil_surat_masuk_kabid">Disposisi Hasil Proses Surat Masuk Ke Kepala Badan</a></li>
        <li class="menubar"><a href="?mod=perbaikan_surat_masuk_kabid">Perbaikan Proses Hasil Surat Masuk</a></li>-->
        <?php
            if($_SESSION["id_level"] == 2){
        ?>
            <!--<li class="menubar"><a href="?mod=disposisi_surat_keluar_kabid">Periksa Dan Disposisi Surat Keluar Dari Bidang Ke Kepala Badan</a></li>
            <li class="menubar"><a href="?mod=perbaikan_surat_keluar_kabid">Perbaikan Surat Keluar Dari Kepala Badan Ke Bidang</a></li>-->
            <li class="menubar"><a href="?mod=posisi_surat_masuk_sekretaris">Proses Surat Masuk</a></li>
            <li class="menubar"><a href="?mod=lacak_surat_masuk">Detail Posisi Surat Masuk</a></li>
            <li class="menubar"><a href="?mod=posisi_surat_keluar_sekretaris">Proses Surat Keluar</a></li>
            <li class="menubar"><a href="?mod=riwayat_surat_keluar">Riwayat Penerimaan Surat Keluar</a></li>
            
            <li class="menubar"><a href="?mod=laporan_sekretaris">Laporan - Laporan</a></li>
            
        <?php
                
            }else{
        ?>
            <!--<li class="menubar"><a href="?mod=disposisi_surat_keluar_kabid">Periksa Dan Disposisi Surat Keluar Dari Kasubbid / Kasubbag Ke Sekretaris</a></li>
            <li class="menubar"><a href="?mod=perbaikan_surat_keluar_kabid">Perbaikan Surat Keluar Dari Sekretaris Ke Sub Bidang / Sub Bagian</a></li>-->
            <li class="menubar"><a href="?mod=posisi_surat_masuk_kabid">Proses Surat Masuk</a></li>
            <li class="menubar"><a href="?mod=riwayat_surat_masuk">Riwayat Penerimaan Surat Masuk</a></li>
            <li class="menubar"><a href="?mod=lacak_surat_masuk">Detail Posisi Surat Masuk</a></li>
            <li class="menubar"><a href="?mod=manajemen_surat_keluar_1">Manajemen Data Surat Keluar</a></li>
            <li class="menubar"><a href="?mod=riwayat_surat_keluar">Riwayat Penerimaan Surat Keluar</a></li>
            <li class="menubar"><a href="?mod=posisi_surat_keluar_kabid">Proses Surat Keluar</a></li>
            
            <li class="menubar"><a href="?mod=laporan_kabid">Laporan - Laporan</a></li>
            
        <?php
            }
        ?>
        <li class="menubar"><a href="?mod=nl_latar_belakang">Latar Belakang</a></li>
        <li class="menubar"><a href="?mod=nl_berita_dan_informasi">Berita Dan Informasi</a></li>
        <li class="menubar"><a href="?mod=nl_file_download">File Download</a></li>
    </div>
</div>