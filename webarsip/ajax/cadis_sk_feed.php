<div>
<?php
    include("../php/koneksi.php");
    include("../php/fungsi.php");
    bacaDispSK($_GET["id_disposisi"]);
    $sql = "SELECT
            	b.level AS level_asal, c.level AS level_tujuan, a.catatan, a.tgl_disposisi, 
                c.urutan AS urutan_tujuan, d.nama AS nama_tujuan,
            	e.urutan AS urutan_asal, f.nama AS nama_asal, a.keadaan
            FROM
            	myapp_disptable_suratkeluar a
            	LEFT JOIN myapp_reftable_levelpengguna b ON a.id_level_asal = b.id
            	LEFT JOIN myapp_reftable_levelpengguna c ON a.id_level_tujuan = c.id
            	LEFT JOIN myapp_maintable_pengguna d ON a.id_pengguna_tujuan = d.id
            	LEFT JOIN myapp_reftable_levelpengguna e ON a.id_level_asal = e.id
            	LEFT JOIN myapp_maintable_pengguna f ON a.id_pengguna_asal = f.id
            WHERE
            	a.id_surat_keluar = '" . $_GET["id"] . "'";
    $res = mysql_query($sql);
    while($ds = mysql_fetch_array($res)){
        $nama_asal = "";
        if($ds["urutan_asal"] == 4)
            $nama_asal = " [[ " . $ds["nama_asal"] . " ]]";
            
        $nama_tujuan = "";
        if($ds["urutan_tujuan"] == 4)
            $nama_tujuan = " [[ " . $ds["nama_tujuan"] . " ]]";
?>
   
	 <div style='color:green;font-size:14px;font-family:verdana;'> <?php echo($ds["level_asal"] . $nama_asal); ?>&nbsp;&nbsp;==>&nbsp;&nbsp;
		<?php echo($ds["level_tujuan"] . $nama_tujuan); ?></div>
    <div class="isilist" style='margin-top:5px;margin-bottom:5px;'>
        <div><?php if($ds["catatan"]<>""){echo($ds["catatan"]);}else{echo("<i>.:: tidak ada catatan ::.</i>");} ?></div>
        <div style='font-size:12px;font-family:verdana;'><?php echo(konversiKeadaanSK($ds["keadaan"])); ?> --- <?php echo($ds["tgl_disposisi"]); ?></div>
    </div><br/>
<?php
    }
?>
</div>