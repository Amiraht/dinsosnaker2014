<div class="panelcontainer" style="width: 100%;">
    <h3>MENU SURAT MASUK</h3>
    <div class="bodypanel">
        <li class="menubar"><a href="?mod=posisi_surat_masuk_kasubbid">Proses Surat Masuk</a></li>
        <li class="menubar"><a href="?mod=proses_ulang_surat_masuk">Proses Lagi Surat Masuk Yang Telah Naik</a></li>
        <li class="menubar"><a href="?mod=riwayat_surat_masuk">Riwayat Penerimaan Surat Masuk</a></li>
        <li class="menubar"><a href="?mod=lacak_surat_masuk">Detail Posisi Surat Masuk</a></li>
        <li class="menubar"><a href="?mod=manajemen_surat_keluar_1">Manajemen Data Surat Keluar</a></li>
        <li class="menubar"><a href="?mod=riwayat_surat_keluar">Riwayat Penerimaan Surat Keluar</a></li>
        <li class="menubar"><a href="?mod=posisi_surat_keluar_kasubbid">Proses Surat Keluar</a></li>
        
        <li class="menubar"><a href="?mod=laporan_kasubbid">Laporan - Laporan</a></li>
        
        <!--<li class="menubar"><a href="?mod=laporan_rekap_sm">Laporan Rekap Surat Masuk</a></li>
        <li class="menubar"><a href="?mod=laporan_rekap_sk">Laporan Rekap Surat Keluar</a></li>-->
        <?php
            if($_SESSION["id_level"] == 7){
        ?>
        <!--<li class="menubar"><a href="?mod=laporan_rekap_skd">Laporan Rekap Surat Keluar Telah Diserahkan/Dikirim</a></li>
        <li class="menubar"><a href="?mod=laporan_rekap_nomor">Laporan Penomoran Surat Keluar BKD</a></li>-->
        <?php
            }
        ?>
        <li class="menubar"><a href="?mod=nl_latar_belakang">Latar Belakang</a></li>
        <li class="menubar"><a href="?mod=nl_berita_dan_informasi">Berita Dan Informasi</a></li>
        <li class="menubar"><a href="?mod=nl_file_download">File Download</a></li>
    </div>
</div>