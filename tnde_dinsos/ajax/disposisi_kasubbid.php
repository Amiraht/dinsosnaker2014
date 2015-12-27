<?php
    include("../php/koneksi.php");
    include("../php/fungsi.php");
    
    $res_ldb = mysql_query("SELECT
                	b.*
                FROM
                	myapp_reftable_levelpengguna a
                	LEFT JOIN myapp_maintable_pengguna b ON a.id = b.id_level
                WHERE
                	a.atasan = " . $_GET["id"] . " AND a.urutan = 4");
    while($ds_ldb = mysql_fetch_array($res_ldb)){
?>
    <tr>
        <td width='5px'><input type="checkbox" name="id_level_tujuan_<?php echo($ds_ldb["id"]); ?>" /></td>
        <td width='30%' style="text-transform: capitalize;"><?php echo($ds_ldb["nama"]); ?></td>
        <td>
            <select onchange="pilihkalimat(<?php echo($ds_ldb["id"]); ?>, this.value);">
                <option value="">:: Pilih Kalimat Disposisi ::</option>
            <?php
                $rkd = mysql_query("SELECT * FROM myapp_constable_kalimatdisposisi");
                while($dkd = mysql_fetch_array($rkd)){
                    echo("<option>" . $dkd["kalimat"] . "</option>");
                }
            ?>
            </select>
            <br />
            <textarea name="catatan_<?php echo($ds_ldb["id"]); ?>" id="catatan_<?php echo($ds_ldb["id"]); ?>"></textarea>
        </td>
    </tr>
<?php   
    }
?>