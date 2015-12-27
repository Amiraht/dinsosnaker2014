<?php
    include("../php/koneksi.php");
    include("../php/fungsi.php");
    
    $res = mysql_query("SELECT * FROM myapp_reftable_jenissurat WHERE id_masalah='" . $_GET["id_masalah"] . "' ORDER BY kode ASC");
    while($ds = mysql_fetch_array($res)){
?>
        <option value="<?php echo($ds["id_jenis_surat"]) ?>">(.<?php echo($ds["kode"]) ?>) <?php echo($ds["jenis_surat"]) ?></option>
<?php
    }
?>