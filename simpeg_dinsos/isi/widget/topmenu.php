<div class="linktop">
<span style="float:left; font-family:verdana; font-size:12px; margin-bottom:15px;">

</span>
</div>
<div style="clear: both;"></div>
<div class="linktop">
    <a href="php/logout.php" class="linktopnav"><img src="image/logout.png" style="width:25px; vertical-align:middle;" title="Log out Sistem"/> Logout</a>
</div>

<div class="linktop">
   <a href='<?=($_SESSION["simpeg_id_level"] == 1) ? "?mod=pengguna" : "?mod=";?>' class='linktopnav'><img src='image/Business Man Blue_32.png' style='width:25px; vertical-align:middle;' title="Profil Pengguna"/> Profil Pengguna</a>	
  <!--  <a href="" class="linktopnav"><img src="image/Business Man Blue_32.png" style="width:25px; vertical-align:middle;" /> Profil Pengguna</a>-->
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