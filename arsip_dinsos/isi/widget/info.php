<center>
<div class="panelcontainer" style="width: 600px; margin: 50px 0px;">
    <h3 style="text-align:left;">INFORMASI</h3>
    <div class="bodypanel info" style="text-align:left;">
    <?php
        $ds_info = mysql_fetch_array(mysql_query("SELECT * FROM myapp_consttable_info WHERE id='" . $_GET["pesan"] . "'"));
        echo($ds_info["info"]);
        $id_tambahan = "";
        if(isset($_GET["id"]))
            $id_tambahan .= "&id=" . $_GET["id"];
        if(isset($_GET["id_disposisi"]))
            $id_tambahan .= "&id_disposisi=" . $_GET["id_disposisi"];
    ?>
        <div style="text-align: right;">
        <?php
            if($_GET["redir"] == "logout"){
        ?>
            <input type="button" value="OK" onclick="document.location.href='php/logout.php';" />
        <?php
            }else{
        ?>
            <input type="button" value="OK" onclick="document.location.href='?mod=<?php echo($_GET["redir"] . $id_tambahan) ?>';" />
        <?php   
            }
        ?>
        </div>
    </div>
</div>
</center>