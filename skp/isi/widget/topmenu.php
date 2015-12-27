<div style="clear: both;"></div>
<div class="linktop">
    <a href="php/logout.php" class="linktopnav"><img src="image/logout.png" style="width:25px; vertical-align:middle;" /> Logout</a>
</div>

<div class="linktop">
    <a href="?mod=pengguna" class="linktopnav"><img src="image/Business Man Blue_32.png" style="width:25px; vertical-align:middle;" /> Profil Pengguna</a>
</div>

<?php
    if($_SESSION["simpeg_id_level"] == 9){
?>
<div class="linktop">
    <a href="php/unset_pegawai.php" class="linktopnav"><img src="image/List-Bullets-Blue-32.png" style="width:25px; vertical-align:middle;" /> Pilih Pegawai</a>
</div>
<?php
    }
?>

<div style="clear: both;"></div>
