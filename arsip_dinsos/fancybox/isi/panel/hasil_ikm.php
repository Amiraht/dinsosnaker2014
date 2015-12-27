<script type="text/javascript">
$(document).ready(function(){
    $("#expand").click(function(){
        $("#bodyfilter").slideToggle(500);
    });
    
    $("#tgl_surat_dari").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
    $("#tgl_terima_dari").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
    
    $("#tgl_surat_sampai").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
    $("#tgl_terima_sampai").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
});
</script>
<form name="frm" action="?mod=<?php echo($_GET["mod"]); ?>" method="post">
    <div class="panelcontainer" style="width: 100%;">
        <h3><div style="display: block; float: left;"><div style="clear: both;"></div>FILTER DATA PENCARIAN</div><input type="button" value="+" style="float: right; display: block; font-weight: bold;" id="expand" /><div style="clear: both;"></div></h3>
        <div class="bodypanel" id="bodyfilter">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='10%'>Tahun IKM</td>
                    <td width='10px'>:</td>
                    <td>
                        <?php
                            $tahun = date("Y");
                            if($_POST["tahun"] != "")
                                $tahun = $_POST["tahun"];
                        ?>
                        <input type="text" name="tahun" value="<?php echo($tahun); ?>" />
                    </td>
                </tr>
            </table>
            <div class="kelang"></div>
            <table border="0px" cellspacing='0' cellpadding='0' width='40%'>
                <tr>
                    <td width='50%'><input type="submit" value='Filter' style="width: 100%;" /></td>
                    <td width='50%'><input type="reset" value='Reset' style="width: 100%;" /></td>
                </tr>
            </table>
        </div>
    </div>
</form>
<div class="kelang"></div>
<div class="panelcontainer" style="width: 100%;">
    <h3>REKAPITULASI HASIL SURVEY INDEKS KEPUASAN MASYARAKAT</h3>
    <div class="bodypanel">
    <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
        <tr class="headertable">
            <th width='40px'>No.</th>
            <th>Nama</th>
            <th>SKPD</th>
            <th width='40px'>U1</th>
            <th width='40px'>U2</th>
            <th width='40px'>U3</th>
            <th width='40px'>U4</th>
            <th width='40px'>U5</th>
            <th width='40px'>U6</th>
            <th width='40px'>U7</th>
            <th width='40px'>U8</th>
            <th width='40px'>U9</th>
            <th width='40px'>U10</th>
            <th width='40px'>U11</th>
            <th width='40px'>U12</th>
            <th width='40px'>U13</th>
            <th width='40px'>U14</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $res = mysql_query("SELECT  
                                	a.nama_lengkap, c.unit_kerja, b.*    
                                FROM  
                                	tbl_anggota_arsip a    
                                	INNER JOIN tbl_jawaban_ikm b ON a.id_anggota = b.id_anggota  
                                	LEFT JOIN ref_unit_kerja c ON a.id_unit_kerja = c.id_unit_kerja  
                                WHERE  
                                	YEAR(b.tanggal) = '" . $tahun . "'    
                                ORDER BY  
                                	a.nama_lengkap ASC  ");
            $ctr = 0;
            $nilai = array();
            for($i=0; $i<14; $i++)
                $nilai[$i] = 0;
            while($ds = mysql_fetch_array($res)){
                $ctr++;
        ?>
        <tr>
            <td align='center'><?php echo($ctr); ?></td>
            <td><?php echo($ds["nama_lengkap"]); ?></td>
            <td><?php if($ds["unit_kerja"] != ""){echo($ds["unit_kerja"]);}else{echo("Umum");} ?></td>
            <td align='center'><?php echo($ds["a"]); ?></td>
            <td align='center'><?php echo($ds["b"]); ?></td>
            <td align='center'><?php echo($ds["c"]); ?></td>
            <td align='center'><?php echo($ds["d"]); ?></td>
            <td align='center'><?php echo($ds["e"]); ?></td>
            <td align='center'><?php echo($ds["f"]); ?></td>
            <td align='center'><?php echo($ds["g"]); ?></td>
            <td align='center'><?php echo($ds["h"]); ?></td>
            <td align='center'><?php echo($ds["i"]); ?></td>
            <td align='center'><?php echo($ds["j"]); ?></td>
            <td align='center'><?php echo($ds["k"]); ?></td>
            <td align='center'><?php echo($ds["l"]); ?></td>
            <td align='center'><?php echo($ds["m"]); ?></td>
            <td align='center'><?php echo($ds["n"]); ?></td>
        </tr>
        <?php      
                $nilai[0] += $ds["a"];
                $nilai[1] += $ds["b"];
                $nilai[2] += $ds["c"];
                $nilai[3] += $ds["d"];
                $nilai[4] += $ds["e"];
                $nilai[5] += $ds["f"];
                $nilai[6] += $ds["g"];
                $nilai[7] += $ds["h"];
                $nilai[8] += $ds["i"];
                $nilai[9] += $ds["j"];
                $nilai[10] += $ds["k"];
                $nilai[11] += $ds["l"];
                $nilai[12] += $ds["m"];
                $nilai[13] += $ds["n"];
            }
        ?>
        </tbody>
    </table>
    <div class="kelang"></div>
    <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtablebackup">
        <thead>
        <tr class="headertable">
            <th>&nbsp;</th>
            <th width='40px'>U1</th>
            <th width='40px'>U2</th>
            <th width='40px'>U3</th>
            <th width='40px'>U4</th>
            <th width='40px'>U5</th>
            <th width='40px'>U6</th>
            <th width='40px'>U7</th>
            <th width='40px'>U8</th>
            <th width='40px'>U9</th>
            <th width='40px'>U10</th>
            <th width='40px'>U11</th>
            <th width='40px'>U12</th>
            <th width='40px'>U13</th>
            <th width='40px'>U14</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td align='center'>JUMLAH NILAI PER UNSUR</td>
            <td align='center'><?php echo($nilai[0]); ?></td>
            <td align='center'><?php echo($nilai[1]); ?></td>
            <td align='center'><?php echo($nilai[2]); ?></td>
            <td align='center'><?php echo($nilai[3]); ?></td>
            <td align='center'><?php echo($nilai[4]); ?></td>
            <td align='center'><?php echo($nilai[5]); ?></td>
            <td align='center'><?php echo($nilai[6]); ?></td>
            <td align='center'><?php echo($nilai[7]); ?></td>
            <td align='center'><?php echo($nilai[8]); ?></td>
            <td align='center'><?php echo($nilai[9]); ?></td>
            <td align='center'><?php echo($nilai[10]); ?></td>
            <td align='center'><?php echo($nilai[11]); ?></td>
            <td align='center'><?php echo($nilai[12]); ?></td>
            <td align='center'><?php echo($nilai[13]); ?></td>
        </tr>
        <tr>
            <td align='center'>NRR PER UNSUR</td>
            <?php
                $nrr_per_unsur = array();
                for($i=0; $i<count($nilai); $i++)
                    $nrr_per_unsur[$i] = $nilai[$i] / $ctr;
                
                for($i=0; $i<count($nilai); $i++){
            ?>
                <td align='center'><?php echo($nrr_per_unsur[$i]); ?></td>
            <?php
                }
            ?>
        </tr>
        <tr>
            <td align='center'>NRR TERTIMBANG PER UNSUR</td>
            <?php
                $nrr_tertimbang_per_unsur = array();
                for($i=0; $i<count($nilai); $i++)
                    $nrr_tertimbang_per_unsur[$i] = $nrr_per_unsur[$i] * 0.071;
                
                for($i=0; $i<count($nilai); $i++){
            ?>
                <td align='center'><?php echo($nrr_tertimbang_per_unsur[$i]); ?></td>
            <?php
                }
            ?>
        </tr>
        </tbody>
    </table>
    <div class="kelang"></div>
    <?php
        $nilai_indeks = 0;
        for($i=0; $i<count($nilai); $i++)
            $nilai_indeks += $nrr_tertimbang_per_unsur[$i];
        
        $nilai_ikm = $nilai_indeks * 25;
        
        $huruf_ikm = "";
        if($nilai_ikm >= 25 && $nilai_ikm <= 43.75){
            $huruf_ikm = "D";
        }else if($nilai_ikm >= 43.76 && $nilai_ikm <= 62.50){
            $huruf_ikm = "C";
        }else if($nilai_ikm >= 62.51 && $nilai_ikm <= 81.25){
            $huruf_ikm = "B";
        }else if($nilai_ikm >= 81.26 && $nilai_ikm <= 100){
            $huruf_ikm = "A";
        }
        
    ?>
    <h3>NILAI INDEKS : <?php echo($nilai_indeks); ?></h3>
    <div class="kelang"></div>
    <h3>NILAI IKM : <?php echo($nilai_ikm . " (" . $huruf_ikm . ")"); ?></h3>
    </div>
</div>