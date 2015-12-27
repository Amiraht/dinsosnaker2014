<?php error_reporting(0);?>
<?php session_start(); ?>
<div>
<?php
    include("../php/koneksi.php");
    include("../php/fungsi.php");
    bacaDisp($_GET["id_disposisi"]);
    if($_SESSION["id_level"] == 1 || $_SESSION["id_level"] == 2 || $_SESSION["id_level"] == 18 || $_SESSION["id_level"] == 19 || $_SESSION["id_level"] == 24){
        $sql = "SELECT
                	b.level AS level_asal, c.level AS level_tujuan, a.catatan, a.tgl_disposisi, c.urutan, d.nama
                FROM
                	myapp_disptable_suratmasuk a
                	LEFT JOIN myapp_reftable_levelpengguna b ON a.id_level_asal = b.id
                	LEFT JOIN myapp_reftable_levelpengguna c ON a.id_level_tujuan = c.id
                    LEFT JOIN myapp_maintable_pengguna d ON a.id_pengguna_tujuan = d.id
                WHERE
                	a.id_surat_masuk = '" . $_GET["id"] . "'";
    }else{
        $tmbh = "(";
        /*if($_SESSION["id_level"] >= 3 AND $_SESSION["id_level"] <= 17){
            $tmbh = " (a.id_level_asal='" . $_SESSION["id_level"] . "' OR a.id_level_tujuan='" . $_SESSION["id_level"] . "')";
        }else if($_SESSION["id_level"] >= 20 AND $_SESSION["id_level"] <= 25){
            $tmbh = " (a.id_pengguna_asal='" . $_SESSION["id_pengguna"] . "' OR a.id_pengguna_tujuan='" . $_SESSION["id_pengguna"] . "')";
        }*/
        //echo($tmbh . "<br>" . $_SESSION["atasan"] . "<br>" . $_SESSION["id_level"]);
        
        // PERTAMA CARI URUTANNYA
        $ds_urutan = mysql_fetch_array(mysql_query("SELECT * FROM myapp_reftable_levelpengguna WHERE id='" . $_SESSION["id_level"] . "'"));
        //echo($ds_urutan["urutan"] . "<br><br>");
        $urutan = $ds_urutan["urutan"];
        
        if($urutan == 2){
            // CARI BAWAHANNYA DULU
            $tmbh .= "(a.id_level_asal=2 AND a.id_level_tujuan=" . $_SESSION["id_level"] . ") OR  (a.id_level_asal=" . $_SESSION["id_level"] . " AND a.id_level_tujuan=2)";
            $res_bawahan = mysql_query("SELECT * FROM myapp_reftable_levelpengguna WHERE atasan='" . $_SESSION["id_level"] . "' AND urutan=3");
            while($ds_bawahan = mysql_fetch_array($res_bawahan)){
                //echo($ds_bawahan["id"] . "<br>");
                $tmbh .= " OR ";
                $tmbh .= "(a.id_level_asal=" . $_SESSION["id_level"] . " AND a.id_level_tujuan=" . $ds_bawahan["id"] . ")";
                $tmbh .= " OR ";
                $tmbh .= "(a.id_level_asal=" . $ds_bawahan["id"] . " AND a.id_level_tujuan=" . $_SESSION["id_level"] . ")";
                
                $res_staff = mysql_query("SELECT * FROM myapp_reftable_levelpengguna WHERE atasan='" . $_SESSION["id_level"] . "' AND urutan=4");
                while($ds_staff = mysql_fetch_array($res_staff)){
                    $tmbh .= " OR ";
                    $tmbh .= "(a.id_level_asal=" . $ds_bawahan["id"] . " AND a.id_level_tujuan=" . $ds_staff["id"] . ")";
                    $tmbh .= " OR ";
                    $tmbh .= "(a.id_level_asal=" . $ds_staff["id"] . " AND a.id_level_tujuan=" . $ds_bawahan["id"] . ")";
                    $tmbh .= " OR ";
                    $tmbh .= "(a.id_level_asal=7 AND a.id_level_tujuan=" . $ds_staff["id"] . ")";
                    $tmbh .= " OR ";
                    $tmbh .= "(a.id_level_asal=2 AND a.id_level_tujuan=7)";
                }
            }
        }else if($urutan == 3){
            $tmbh .= "(a.id_level_asal=2 AND a.id_level_tujuan=" . $_SESSION["atasan"] . ") OR  (a.id_level_asal=" . $_SESSION["atasan"] . " AND a.id_level_tujuan=2)";
            $tmbh .= " OR ";
            $tmbh .= "(a.id_level_asal=" . $_SESSION["atasan"] . " AND a.id_level_tujuan=" . $_SESSION["id_level"] . ") OR  (a.id_level_asal=" . $_SESSION["id_level"] . " AND a.id_level_tujuan=" . $_SESSION["atasan"] . ")";
            
            $res_staff = mysql_query("SELECT * FROM myapp_reftable_levelpengguna WHERE urutan=4");
            while($ds_staff = mysql_fetch_array($res_staff)){
                $tmbh .= " OR ";
                $tmbh .= "(a.id_level_asal=" . $_SESSION["id_level"] . " AND a.id_level_tujuan=" . $ds_staff["id"] . ")";
                $tmbh .= " OR ";
                $tmbh .= "(a.id_level_asal=" . $ds_staff["id"] . " AND a.id_level_tujuan=" . $_SESSION["id_level"] . ")";
                $tmbh .= " OR ";
                $tmbh .= "(a.id_level_asal=7 AND a.id_level_tujuan=" . $ds_staff["id"] . ")";
                $tmbh .= " OR ";
                $tmbh .= "(a.id_level_asal=2 AND a.id_level_tujuan=7)";
            }
        }else if($urutan == 4){
            $res_staff = mysql_query("SELECT * FROM myapp_reftable_levelpengguna WHERE atasan='" . $_SESSION["atasan"] . "' AND urutan=3");
            $ctr = 0;
            while($ds_staff = mysql_fetch_array($res_staff)){
                $ctr++;
                if($ctr > 1)
                    $tmbh .= " OR ";
                $tmbh .= "(a.id_pengguna_asal=" . $_SESSION["id_pengguna"] . " AND a.id_level_tujuan=" . $ds_staff["id"] . ")";
                $tmbh .= " OR ";
                $tmbh .= "(a.id_level_asal=" . $ds_staff["id"] . " AND a.id_pengguna_tujuan=" . $_SESSION["id_pengguna"] . ")";
            }
            $res_kasubbid_asal = mysql_query("SELECT * FROM myapp_disptable_suratmasuk WHERE id_surat_masuk = '" . $_GET["id"] . "' AND id_pengguna_tujuan = '" . $_SESSION["id_pengguna"] . "'");
            while($ds_kasubbid_asal = mysql_fetch_array($res_kasubbid_asal)){
                $tmbh .= " OR ";
                $tmbh .= "(a.id_level_asal=" . $ds_kasubbid_asal["id_level_asal"] . " AND a.id_level_tujuan=" . $_SESSION["atasan"] . ")";
                $tmbh .= " OR ";
                $tmbh .= "(a.id_level_asal=" . $_SESSION["atasan"] . " AND a.id_level_tujuan=" . $ds_kasubbid_asal["id_level_asal"] . ")";
            }
            $res_kasubbid_tujuan = mysql_query("SELECT * FROM myapp_disptable_suratmasuk WHERE id_surat_masuk = '" . $_GET["id"] . "' AND id_pengguna_asal = '" . $_SESSION["id_pengguna"] . "'");
            while($ds_kasubbid_tujuan = mysql_fetch_array($res_kasubbid_tujuan)){
                $tmbh .= " OR ";
                $tmbh .= "(a.id_level_asal=" . $ds_kasubbid_tujuan["id_level_tujuan"] . " AND a.id_level_tujuan=" . $_SESSION["atasan"] . ")";
                $tmbh .= " OR ";
                $tmbh .= "(a.id_level_asal=" . $_SESSION["atasan"] . " AND a.id_level_tujuan=" . $ds_kasubbid_tujuan["id_level_tujuan"] . ")";
            }
            
            $tmbh .= " OR ";
            $tmbh .= "(a.id_level_asal=2 AND a.id_level_tujuan=" . $_SESSION["atasan"] . ") OR  (a.id_level_asal=" . $_SESSION["atasan"] . " AND a.id_level_tujuan=2)";
            
            $tmbh .= " OR ";
            $tmbh .= "(a.id_level_asal=7 AND a.id_pengguna_tujuan=" . $_SESSION["id_pengguna"] . ")";
            $tmbh .= " OR ";
            $tmbh .= "(a.id_level_asal=2 AND a.id_level_tujuan=7)";
        }
        $tmbh .= ")";
        //echo("<br><br>");
        //echo($tmbh);
        $sql = "SELECT
                	b.level AS level_asal, c.level AS level_tujuan, a.catatan, a.tgl_disposisi, c.urutan, d.nama, e.nama AS nama_asal, b.urutan AS 'asal'
                FROM
                	myapp_disptable_suratmasuk a
                	LEFT JOIN myapp_reftable_levelpengguna b ON a.id_level_asal = b.id
                	LEFT JOIN myapp_reftable_levelpengguna c ON a.id_level_tujuan = c.id
                    LEFT JOIN myapp_maintable_pengguna d ON a.id_pengguna_tujuan = d.id
                    LEFT JOIN myapp_maintable_pengguna e ON a.id_pengguna_asal = e.id
                WHERE
                	a.id_surat_masuk = '" . $_GET["id"] . "' AND " . $tmbh . "
                ORDER BY
                    a.id ASC";
    }
    //echo($sql);
    $res = mysql_query($sql);
    while($ds = mysql_fetch_array($res)){
        $nama_asal = "";
        if($ds["asal"] == 4)
            $nama_asal = " [[ " . $ds["nama_asal"] . " ]]";
            
        $nama = "";
        if($ds["urutan"] == 4)
            $nama = " [[ " . $ds["nama"] . " ]]";
?>
    <div style='color:green;font-size:14px;font-family:verdana;'> <?php echo($ds["level_asal"] . $nama_asal); ?>&nbsp;&nbsp;==>&nbsp;&nbsp;
		<?php echo($ds["level_tujuan"] . $nama); ?></div>
    <div class="isilist" style='margin-top:5px;margin-bottom:5px;'>
        <div><?php if($ds["catatan"]<>""){echo($ds["catatan"]);}else{echo("<i>.:: tidak ada catatan ::.</i>");} ?></div>
        <div style='font-size:12px;font-family:verdana;'><?php echo($ds["tgl_disposisi"]); ?></div>
    </div><br/>
<?php
    }
?>
</div><br/>
<?php
    if($_SESSION["id_level"] == 18){
			$id_surat = mysql_real_escape_string(strip_tags($_GET['id']));
			//$salt = "dokumenresmidinsos2014";
			$link = md5(md5($id_surat));
?>
    <input type="button" style="font-family: sans-serif; font-size: 9pt;" value="Cetak Lembar Disposisi" onclick="window.open('lembar_disposisi.php?id=<?php echo($link); ?>');" />
<?php
    }
?>