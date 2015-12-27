<script type="text/javascript">
$(document).ready(function(){
    $("#dialog_form_disp").dialog({
            autoOpen: false,
			height: 500,
			width: 700,
			modal: true,
            show: "fade",
			hide: "fade"
        });
});
function pindah_staff(id_disposisi){
    $("#id_disposisi").val(id_disposisi);
    $("#dialog_form_disp").dialog("open");
}
</script>
<input type="button" value="Kembali" onclick="document.location.href='?mod=lacak_surat_masuk';" style="float: right; display: block; font-weight: bold;"/>
<div class="kelang"></div>
<div class="panelcontainer" style="width: 100%;">
    <h3>DETAIL POSISI DISPOSISI</h3>
    <div class="bodypanel">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
        <tr class="headertable">
            <th width='40px'>No.</th>
            <th width='200px'>Asal Disposisi</th>
            <th width='200px'>Posisi Disposisi</th>
            <th width='150px'>Tgl Disposisi</th>
            <th>Catatan Disposisi</th>
            <th width='100px'>Status</th>
        </tr>
        </thead>
        <tbody>
        <?php
            if($_SESSION["id_level"] == 1 || $_SESSION["id_level"] == 2 || $_SESSION["id_level"] == 18 || $_SESSION["id_level"] == 19 || $_SESSION["id_level"] == 24){
                $sql = "SELECT
                        	a.id, b.urutan AS urutan_asal, b.level AS asal, c.urutan AS urutan_tujuan, c.level AS tujuan,
                            d.nama AS nama_asal, e.nama AS nama_tujuan, a.status, a.tgl_disposisi, a.catatan
                        FROM
                        	myapp_disptable_suratmasuk a
                        	LEFT JOIN myapp_reftable_levelpengguna b ON a.id_level_asal = b.id
                        	LEFT JOIN myapp_reftable_levelpengguna c ON a.id_level_tujuan = c.id
                        	LEFT JOIN myapp_maintable_pengguna d ON a.id_pengguna_asal = d.id
                        	LEFT JOIN myapp_maintable_pengguna e ON a.id_pengguna_tujuan = e.id
                        WHERE
                        	a.id_surat_masuk = '" . $_GET["id"] . "' AND a.status < 3
                         GROUP BY
                            a.id";
            }else{
                if($_SESSION["id_level"] >= 3 AND $_SESSION["id_level"] <= 6){
                    $tmbh = "( a.id_level_asal='" . $_SESSION["id_level"] . "' OR a.id_level_tujuan='" . $_SESSION["id_level"] . "'";
                    $res_bawahan = mysql_query("SELECT * FROM myapp_reftable_levelpengguna WHERE atasan='" . $_SESSION["id_level"] . "'");
                    while($ds_bawahan = mysql_fetch_array($res_bawahan)){
                        $tmbh .= " OR ";
                        $tmbh .= " a.id_level_tujuan = '" . $ds_bawahan["id"] . "' ";
                    }
                    $tmbh .= ")";
                }else if($_SESSION["id_level"] >= 7 AND $_SESSION["id_level"] <= 17){
                    $tmbh = "( a.id_level_asal='" . $_SESSION["id_level"] . "' OR a.id_level_tujuan='" . $_SESSION["id_level"] . "'";
                    $res_bawahan = mysql_query("SELECT * FROM myapp_reftable_levelpengguna WHERE atasan='" . $_SESSION["atasan"] . "' AND urutan=4");
                    while($ds_bawahan = mysql_fetch_array($res_bawahan)){
                        $tmbh .= " OR ";
                        $tmbh .= " (a.id_level_asal = '" . $_SESSION["id_level"] . "' AND a.id_level_tujuan = '" . $ds_bawahan["id"] . "') ";
                        $tmbh .= " OR ";
                        $tmbh .= " (a.id_level_asal = '" . $ds_bawahan["id"] . "' AND a.id_level_tujuan = '" . $_SESSION["id_level"] . "') ";
                    }
                    $res_bawahan_langsung = mysql_query("SELECT * FROM myapp_maintable_pengguna WHERE level_kasubbid='" . $_SESSION["id_level"] . "'");
                    while($ds_bawahan_langsung = mysql_fetch_array($res_bawahan_langsung)){
                        $tmbh .= " OR ";
                        $tmbh .= " (a.id_level_asal = '7' AND a.id_pengguna_tujuan = '" . $ds_bawahan_langsung["id"] . "') ";
                    }
                    $tmbh .= ")";
                }else if($_SESSION["id_level"] >= 20 AND $_SESSION["id_level"] <= 25){
                    $tmbh = " (a.id_pengguna_asal='" . $_SESSION["id_pengguna"] . "' OR a.id_pengguna_tujuan='" . $_SESSION["id_pengguna"] . "')";
                }
                $sql = "SELECT
                        	a.id, b.urutan AS urutan_asal, b.level AS asal, c.urutan AS urutan_tujuan, c.level AS tujuan,
                            d.nama AS nama_asal, e.nama AS nama_tujuan, a.status, a.tgl_disposisi, a.catatan,
                            a.id_level_tujuan
                        FROM
                        	myapp_disptable_suratmasuk a
                        	LEFT JOIN myapp_reftable_levelpengguna b ON a.id_level_asal = b.id
                        	LEFT JOIN myapp_reftable_levelpengguna c ON a.id_level_tujuan = c.id
                        	LEFT JOIN myapp_maintable_pengguna d ON a.id_pengguna_asal = d.id
                        	LEFT JOIN myapp_maintable_pengguna e ON a.id_pengguna_tujuan = e.id
                        WHERE
                        	a.id_surat_masuk = '" . $_GET["id"] . "' AND a.status < 3 AND " . $tmbh . "
                        GROUP BY
                            a.id";
            }
            //echo($sql);
            $res = mysql_query($sql);
            $ctr = 0;
            while($ds = mysql_fetch_array($res)){
                $ctr++;
                $asal = $ds["asal"];
                if($ds["urutan_asal"] == 4)
                    $asal .= " (" . $ds["nama_asal"] . ")";
                
                $tujuan = $ds["tujuan"];
                if($ds["urutan_tujuan"] == 4)
                    $tujuan .= " (" . $ds["nama_tujuan"] . ")";
                
                $status = "";
                if($ds["status"] == 1)
                    $status = "<span style='color: red;'>Belum Dibaca</span>";
                else if($ds["status"])
                    $status = "<span style='color: blue;'>Dibaca</span>";
        ?>
            <tr>
                <td align='center'><?php echo($ctr); ?></td>
                <td><?php echo($asal); ?></td>
                <td>
                    <?php echo($tujuan); ?>
                    <?php
                        if(($_SESSION["id_level"] >= 7 && $_SESSION["id_level"] <= 17) && ($ds["id_level_tujuan"] >= 20 && $ds["id_level_tujuan"] <= 25)){
                    ?>
                        <div style="margin-top: 5px; text-align: center;"><a href="javascript:pindah_staff(<?php echo($ds["id"]); ?>);" class="linkkecil">Pindahkan Ke Staff Lain</a></div>
                    <?php
                        }
                    ?>
                </td>
                <td><?php echo($ds["tgl_disposisi"]); ?></td>
                <td><?php echo($ds["catatan"]); ?></td>
                <td align='center'><?php echo($status); ?></td>
            </tr>
        <?php
            }
        ?>
        </tbody>
        </table>
    </div>
</div>
<div class="kelang"></div>
<div class="kelang"></div>
<div class="panelcontainer" style="width: 100%;">
    <h3>DETAIL POSISI PEMROSESAN</h3>
    <div class="bodypanel">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
        <tr class="headertable">
            <th width='40px'>No.</th>
            <th width='200px'>Asal Pemrosesan</th>
            <th width='200px'>Posisi Pemrosesan</th>
            <th width='150px'>Tgl Diserahkan</th>
            <th>Catatan Pemrosesan</th>
            <th width='100px'>Status</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $res = mysql_query("SELECT
                                	f.id_surat_keluar, f.id_surat_masuk, b.urutan AS urutan_asal,
                                    b.level AS asal, c.urutan AS urutan_tujuan, c.level AS tujuan, 
                                    d.nama AS nama_asal, e.nama AS nama_tujuan, a.status, a.tgl_disposisi, a.catatan
                                FROM
                                	myapp_disptable_suratkeluar a
                                	LEFT JOIN myapp_reftable_levelpengguna b ON a.id_level_asal = b.id
                                	LEFT JOIN myapp_reftable_levelpengguna c ON a.id_level_tujuan = c.id
                                	LEFT JOIN myapp_maintable_pengguna d ON a.id_pengguna_asal = d.id
                                	LEFT JOIN myapp_maintable_pengguna e ON a.id_pengguna_tujuan = e.id
                                	LEFT JOIN myapp_maintable_balasan f ON a.id_surat_keluar = f.id_surat_keluar
                                WHERE
                                	f.id_surat_masuk = '" . $_GET["id"] . "' AND a.status < 3");
            $ctr = 0;
            while($ds = mysql_fetch_array($res)){
                $ctr++;
                $asal = $ds["asal"];
                if($ds["urutan_asal"] == 4)
                    $asal .= " (" . $ds["nama_asal"] . ")";
                
                $tujuan = $ds["tujuan"];
                if($ds["urutan_tujuan"] == 4)
                    $tujuan .= " (" . $ds["nama_tujuan"] . ")";
                    
                $status = "";
                if($ds["status"] == 1)
                    $status = "<span style='color: red;'>Belum Dibaca</span>";
                else if($ds["status"])
                    $status = "<span style='color: blue;'>Dibaca</span>";
        ?>
            <tr>
                <td align='center'><?php echo($ctr); ?></td>
                <td><?php echo($asal); ?></td>
                <td><?php echo($tujuan); ?></td>
                <td><?php echo($ds["tgl_disposisi"]); ?></td>
                <td><?php echo($ds["catatan"]); ?></td>
                <td align='center'><?php echo($status); ?></td>
            </tr>
        <?php
            }
        ?>
        </tbody>
        </table>
    </div>
</div>
<div class="kelang"></div>
<div class="kelang"></div>
<div class="panelcontainer" style="width: 100%;">
    <h3>SURAT HASIL PEMROSESAN YANG AKAN DIKIRIM (MENUNGGU PROSES PENGIRIMAN)</h3>
    <div class="bodypanel">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
        <tr class="headertable">
            <th width='40px'>No.</th>
            <th width='200px'>No. Surat</th>
            <th width='200px'>No. Nota Dinas</th>
            <th width='200px'>Tgl. Surat</th>
            <th width='200px'>Perihal</th>
            <th width='200px'>Tujuan Surat</th>
            <th width='200px'>Penandatangan Surat</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $res = mysql_query("SELECT
                                	a.*, b.ttd
                                FROM
                                	myapp_maintable_suratkeluar a
                                	LEFT JOIN myapp_reftable_ttd b ON a.id_ttd = b.id
                                	LEFT JOIN myapp_maintable_balasan c ON a.id = c.id_surat_keluar
                                WHERE
                                	c.id_surat_masuk = '" . $_GET["id"] . "' AND a.status = 2");
            $ctr = 0;
            while($ds = mysql_fetch_array($res)){
                $ctr++;
        ?>
            <tr>
                <td align='center'><?php echo($ctr); ?></td>
                <td><?php echo($ds["no_surat"]); ?></td>
                <td><?php echo($ds["no_nodin"]); ?></td>
                <td><?php echo($ds["tgl_surat"]); ?></td>
                <td><?php echo($ds["perihal_surat"]); ?></td>
                <td><?php echo($ds["tujuan_surat"]); ?></td>
                <td><?php echo($ds["ttd"]); ?></td>
            </tr>
        <?php
            }
        ?>
        </tbody>
        </table>
    </div>
</div>
<div class="kelang"></div>
<div class="kelang"></div>
<div class="panelcontainer" style="width: 100%;">
    <h3>SURAT HASIL PEMROSESAN YANG TELAH DIKIRIM</h3>
    <div class="bodypanel">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
        <tr class="headertable">
            <th width='40px'>No.</th>
            <th width='200px'>No. Surat</th>
            <th width='200px'>No. Nota Dinas</th>
            <th width='200px'>Tgl. Surat</th>
            <th width='200px'>Perihal</th>
            <th width='200px'>Tujuan Surat</th>
            <th width='200px'>Penandatangan Surat</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $res = mysql_query("SELECT
                                	a.*, b.ttd
                                FROM
                                	myapp_maintable_suratkeluar a
                                	LEFT JOIN myapp_reftable_ttd b ON a.id_ttd = b.id
                                	LEFT JOIN myapp_maintable_balasan c ON a.id = c.id_surat_keluar
                                WHERE
                                	c.id_surat_masuk = '" . $_GET["id"] . "' AND a.status = 3");
            $ctr = 0;
            while($ds = mysql_fetch_array($res)){
                $ctr++;
        ?>
            <tr>
                <td align='center'><?php echo($ctr); ?></td>
                <td><?php echo($ds["no_surat"]); ?></td>
                <td><?php echo($ds["no_nodin"]); ?></td>
                <td><?php echo($ds["tgl_surat"]); ?></td>
                <td><?php echo($ds["perihal_surat"]); ?></td>
                <td><?php echo($ds["tujuan_surat"]); ?></td>
                <td><?php echo($ds["ttd"]); ?></td>
            </tr>
        <?php
            }
        ?>
        </tbody>
        </table>
    </div>
</div>
<!-- DIALOG -->
<div id="dialog_form_disp" title="Pindahkan ke Staff Lain">
<form name="frm" action="php/pindah_staff.php" method="post">
    <div class="panelcontainer" style="width: 100%;">
        <div class="bodypanel">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <input type="hidden" name="id_disposisi" value="" id="id_disposisi" />
                <input type="hidden" name="id_sm" id="id_sm" value="<?php echo($_GET["id"]); ?>" />
                <?php
                    $rstaff = mysql_query("SELECT
                                            	b.*
                                            FROM
                                            	myapp_reftable_levelpengguna a
                                            	LEFT JOIN myapp_maintable_pengguna b ON a.id = b.id_level
                                            WHERE
                                            	a.atasan = " . $_SESSION["atasan"] . " AND a.urutan = 4");
                    while($dstaf = mysql_fetch_array($rstaff)){
                ?>
                <tr>
                    <td>
                        <input type="radio" name="staff" value="<?php echo($dstaf["id"]); ?>" />
                        <?php echo($dstaf["nama"]); ?>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </table>
            <div class="kelang"></div>
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='50%'><input type="submit" value='Pindahkan' name="pindah" style="width: 100%;" /></td>
                    <td width='50%'>&nbsp;</td>
                </tr>
            </table>
        </div>
    </div>
</form>
</div>
<!-- ###### -->