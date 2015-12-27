<?php
    $ds = mysql_fetch_array(mysql_query("SELECT * FROM myapp_nonlogintable_latarbelakang WHERE id='1'"));
?>
<div class="panelcontainer" style="width: 100%; text-transform: uppercase;">
    <h3><?php echo($ds["judul"]); ?></h3>
    <div class="bodypanel" style="font-family: sans-serif; font-size: 9pt; text-transform: none;">
        <?php echo($ds["isi"]); ?>
    </div>
</div>