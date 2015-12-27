
<?php
    include("../php/koneksi.php");
    include("../php/fungsi.php");
    bacaDispSK($_GET["id_disposisi"]);
    $res = mysql_query("SELECT * FROM myapp_filetable_suratkeluar WHERE id_surat_keluar='" . $_GET["id"] . "'") or die(mysql_error());
    while($ds = mysql_fetch_array($res)){
?>
        <div class="judullist"><?php echo($ds["nama_file"]) ?> - <i><?php echo(konversiJenisFileSK($ds["status"])) ?></i></div>
        <div class="isilist">
            <?php echo($ds["keterangan"]) ?>
            <div style="clear: both;"></div>
            <a class="linktambahan" target="_blank" href="uploaded/sk/<?php echo($ds["nama_file"]) ?>">Download</a>
            <div style="clear: both;"></div>
        </div>
<?php
    }
?>