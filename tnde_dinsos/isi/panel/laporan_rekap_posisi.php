<?php
    function jumlah_sm_kabid_kasubbid($id_level, $atasan){
        // PERTAMA CARI URUTANNYA
        $dibaca = 0;
        $belum_dibaca = 0;
        $sql = "SELECT 
                	a.*, b.unit_kerja, c.status AS disp_stt
                FROM 
                	myapp_maintable_suratmasuk a
                	LEFT JOIN myapp_reftable_unitkerja b ON a.id_skpd_pengirim = b.id_unit_kerja
                    LEFT JOIN myapp_disptable_suratmasuk c ON a.id = c.id_surat_masuk
                WHERE
                	1 AND c.id_level_tujuan = '" . $id_level . "' AND c.status < 3
                GROUP BY
                    a.id
                ORDER BY 
                	id DESC";
        $res = mysql_query($sql);
        while($ds = mysql_fetch_array($res)){
            if($ds["disp_stt"] == 1)
                $belum_dibaca++;
            else if($ds["disp_stt"] == 2)
                $dibaca++;
        }
        $kembali = array($dibaca, $belum_dibaca);
        return $kembali;
    }
    
    function jumlah_sm_staff($id_staff){
        $dibaca = 0;
        $belum_dibaca = 0;
        $sql = "SELECT 
                	a.*, b.unit_kerja, c.status AS disp_stt
                FROM 
                	myapp_maintable_suratmasuk a
                	LEFT JOIN myapp_reftable_unitkerja b ON a.id_skpd_pengirim = b.id_unit_kerja
                    LEFT JOIN myapp_disptable_suratmasuk c ON a.id = c.id_surat_masuk
                WHERE
                	1 AND c.id_pengguna_tujuan = '" . $id_staff . "' AND c.status < 3
                GROUP BY
                    a.id
                ORDER BY 
                	id DESC";
        //echo($sql);
        $res = mysql_query($sql);
        while($ds = mysql_fetch_array($res)){
            if($ds["disp_stt"] == 1)
                $belum_dibaca++;
            else if($ds["disp_stt"] == 2)
                $dibaca++;
        }
        $kembali = array($dibaca, $belum_dibaca);
        return $kembali;
    }
?>

<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
          <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="./?mod=laporan_rekap_posisi">LAPORAN REKAP POSISI</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='<?=$url_main;?>'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>LAPORAN REKAP POSISI</span></td>
                            <td><img  align="right" width="90" height="29" onclick="document.location.href='<?=$url_main;?>';" 
                                onmouseout="this.src='./image/button/KEMBALI.gif'" onmouseover="this.src='./image/button/KEMBALI2.gif'" src="./image/button/KEMBALI.gif"></img>
                                </td>
                        </tr>
                    </table>            
                    </div>
            <br>
        </td>
  </tr>
  <tr>
  	<td>
    <div id='content' style='padding-top:10px;'>	<br>
	<fieldset>
	<legend><h3>REKAPITULASI POSISI SURAT</h3></legend>

     <table border="1" width="100%" align="left" cellpadding="5" cellspacing="1" class='tblisi'>
        <thead>
        <tr>
            <th width='40px' rowspan="2">No.</th>
            <th rowspan="2">Pejabat / Nama Pegawai</th>
            <th width='100px' colspan="3">Surat Masuk</th>
        </tr>
        <tr>
            <th width='100'>Dibaca</th>
            <th width='100'>Belum Dibaca</th>
            <th width='100'>Total</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if($_SESSION["id_level"] == 1 || $_SESSION["id_level"] == 2){
            $res_kabid = mysql_query("SELECT * FROM myapp_reftable_levelpengguna WHERE urutan = 2 AND id <> 2");
            $ctr = 0;
            while($ds_kabid = mysql_fetch_array($res_kabid)){
                $ctr++;
        ?>
                <tr>
                    <td><?php echo($ctr); ?></td>
                    <td style="text-transform: uppercase;"><b><?php echo($ds_kabid["level"]); ?></b></td>
                    <?php $sm = jumlah_sm_kabid_kasubbid($ds_kabid["id"], 0); ?>
                    <td align='center'><?php echo($sm[0]); ?></td>
                    <td align='center'><?php echo($sm[1]); ?></td>
                    <td align='center'><?php echo($sm[0] + $sm[1]); ?></td>
                    <!--<td>
                        <img src='image/Application-View-Detail-32.png' width='18px' class='linkimage' title='Detail Posisi Surat Masuk' onclick='document.location.href="?mod=lanjut_rekap_total_kabbid_kasubbid&id_level=<?php echo($ds_kabid["id"]); ?>&atasan=<?php echo($ds_kabid["atasan"]); ?>";' />
                    </td>-->
                </tr>
        <?php
                $res_kasubbid = mysql_query("SELECT * FROM myapp_reftable_levelpengguna WHERE urutan = 3 AND atasan = '" . $ds_kabid["id"] . "'");
                $ctr_kasubbid = 0;
                while($ds_kasubbid = mysql_fetch_array($res_kasubbid)){
                    $ctr_kasubbid++;
        ?>
                    <tr>
                        <td><?php echo($ctr . ".". $ctr_kasubbid); ?></td>
                        <td style="text-transform: uppercase;">&nbsp;&nbsp;<?php echo($ds_kasubbid["level"]); ?></td>
                        <?php $sm = jumlah_sm_kabid_kasubbid($ds_kasubbid["id"], 0); ?>
                        <td align='center'><?php echo($sm[0]); ?></td>
                        <td align='center'><?php echo($sm[1]); ?></td>
                        <td align='center'><?php echo($sm[0] + $sm[1]); ?></td>
                        <!--<td>
                            <img src='image/Application-View-Detail-32.png' width='18px' class='linkimage' title='Detail Posisi Surat Masuk' onclick='document.location.href="?mod=lanjut_rekap_total_kabbid_kasubbid&id_level=<?php echo($ds_kasubbid["id"]); ?>&atasan=<?php echo($ds_kasubbid["atasan"]); ?>";' />
                        </td>-->
                    </tr>
        <?php
                    $res_staff = mysql_query("SELECT * FROM myapp_maintable_pengguna WHERE level_kasubbid = '" . $ds_kasubbid["id"] . "'");
                    $ctr_staff = 0;
                    while($ds_staff = mysql_fetch_array($res_staff)){
                        $ctr_staff++;
        ?>
                        <tr>
                            <td><?php echo($ctr . ".". $ctr_kasubbid . "." . $ctr_staff); ?></td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo($ds_staff["nama"]); ?></td>
                            <?php $sm = jumlah_sm_staff($ds_staff["id"]); ?>
                            <td align='center'><?php echo($sm[0]); ?></td>
                            <td align='center'><?php echo($sm[1]); ?></td>
                            <td align='center'><?php echo($sm[0] + $sm[1]); ?></td>
                            <!--<td>
                                <img src='image/Application-View-Detail-32.png' width='18px' class='linkimage' title='Detail Posisi Surat Masuk' onclick='document.location.href="?mod=lanjut_rekap_total_staff&id_pengguna=<?php echo($ds_staff["id"]); ?>";' />
                            </td>-->
                        </tr>
        <?php
                    }
                }
            } // AKHIR WHILE
        }else if($_SESSION["id_level"] >= 3 && $_SESSION["id_level"] <= 6){
            $res_kabid = mysql_query("SELECT * FROM myapp_reftable_levelpengguna WHERE urutan = 2 AND id <> 2 AND id='" . $_SESSION["id_level"] . "'");
            $ctr = 0;
            while($ds_kabid = mysql_fetch_array($res_kabid)){
                $ctr++;
        ?>
                <tr>
                    <td><?php echo($ctr); ?></td>
                    <td style="text-transform: uppercase;"><b><?php echo($ds_kabid["level"]); ?></b></td>
                    <?php $sm = jumlah_sm_kabid_kasubbid($ds_kabid["id"], 0); ?>
                    <td align='center'><?php echo($sm[0]); ?></td>
                    <td align='center'><?php echo($sm[1]); ?></td>
                    <td align='center'><?php echo($sm[0] + $sm[1]); ?></td>
                    <!--<td>
                        <img src='image/Application-View-Detail-32.png' width='18px' class='linkimage' title='Detail Posisi Surat Masuk' onclick='document.location.href="?mod=lanjut_rekap_total_kabbid_kasubbid&id_level=<?php echo($ds_kabid["id"]); ?>&atasan=<?php echo($ds_kabid["atasan"]); ?>";' />
                    </td>-->
                </tr>
        <?php
                $res_kasubbid = mysql_query("SELECT * FROM myapp_reftable_levelpengguna WHERE urutan = 3 AND atasan = '" . $ds_kabid["id"] . "'");
                $ctr_kasubbid = 0;
                while($ds_kasubbid = mysql_fetch_array($res_kasubbid)){
                    $ctr_kasubbid++;
        ?>
                    <tr>
                        <td><?php echo($ctr . ".". $ctr_kasubbid); ?></td>
                        <td style="text-transform: uppercase;">&nbsp;&nbsp;<?php echo($ds_kasubbid["level"]); ?></td>
                        <?php $sm = jumlah_sm_kabid_kasubbid($ds_kasubbid["id"], 0); ?>
                        <td align='center'><?php echo($sm[0]); ?></td>
                        <td align='center'><?php echo($sm[1]); ?></td>
                        <td align='center'><?php echo($sm[0] + $sm[1]); ?></td>
                        <!--<td>
                            <img src='image/Application-View-Detail-32.png' width='18px' class='linkimage' title='Detail Posisi Surat Masuk' onclick='document.location.href="?mod=lanjut_rekap_total_kabbid_kasubbid&id_level=<?php echo($ds_kasubbid["id"]); ?>&atasan=<?php echo($ds_kasubbid["atasan"]); ?>";' />
                        </td>-->
                    </tr>
        <?php
                    $res_staff = mysql_query("SELECT * FROM myapp_maintable_pengguna WHERE level_kasubbid = '" . $ds_kasubbid["id"] . "'");
                    $ctr_staff = 0;
                    while($ds_staff = mysql_fetch_array($res_staff)){
                        $ctr_staff++;
        ?>
                        <tr>
                            <td><?php echo($ctr . ".". $ctr_kasubbid . "." . $ctr_staff); ?></td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo($ds_staff["nama"]); ?></td>
                            <?php $sm = jumlah_sm_staff($ds_staff["id"]); ?>
                            <td align='center'><?php echo($sm[0]); ?></td>
                            <td align='center'><?php echo($sm[1]); ?></td>
                            <td align='center'><?php echo($sm[0] + $sm[1]); ?></td>
                            <!--<td>
                                <img src='image/Application-View-Detail-32.png' width='18px' class='linkimage' title='Detail Posisi Surat Masuk' onclick='document.location.href="?mod=lanjut_rekap_total_staff&id_pengguna=<?php echo($ds_staff["id"]); ?>";' />
                            </td>-->
                        </tr>
        <?php
                    }
                }
            } // AKHIR WHILE
        }else if($_SESSION["id_level"] >= 7 && $_SESSION["id_level"] <= 17){
            $res_kasubbid = mysql_query("SELECT * FROM myapp_reftable_levelpengguna WHERE urutan = 3 AND id='" . $_SESSION["id_level"] . "'");
                $ctr_kasubbid = 0;
                while($ds_kasubbid = mysql_fetch_array($res_kasubbid)){
                    $ctr_kasubbid++;
        ?>
                    <tr>
                        <td><?php echo($ctr_kasubbid); ?></td>
                        <td style="text-transform: uppercase;">&nbsp;&nbsp;<?php echo($ds_kasubbid["level"]); ?></td>
                        <?php $sm = jumlah_sm_kabid_kasubbid($ds_kasubbid["id"], 0); ?>
                        <td align='center'><?php echo($sm[0]); ?></td>
                        <td align='center'><?php echo($sm[1]); ?></td>
                        <td align='center'><?php echo($sm[0] + $sm[1]); ?></td>
                        <!--<td>
                            <img src='image/Application-View-Detail-32.png' width='18px' class='linkimage' title='Detail Posisi Surat Masuk' onclick='document.location.href="?mod=lanjut_rekap_total_kabbid_kasubbid&id_level=<?php echo($ds_kasubbid["id"]); ?>&atasan=<?php echo($ds_kasubbid["atasan"]); ?>";' />
                        </td>-->
                    </tr>
        <?php
                    $res_staff = mysql_query("SELECT * FROM myapp_maintable_pengguna WHERE level_kasubbid = '" . $ds_kasubbid["id"] . "'");
                    $ctr_staff = 0;
                    while($ds_staff = mysql_fetch_array($res_staff)){
                        $ctr_staff++;
        ?>
                        <tr>
                            <td><?php echo($ctr_kasubbid . "." . $ctr_staff); ?></td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo($ds_staff["nama"]); ?></td>
                            <?php $sm = jumlah_sm_staff($ds_staff["id"]); ?>
                            <td align='center'><?php echo($sm[0]); ?></td>
                            <td align='center'><?php echo($sm[1]); ?></td>
                            <td align='center'><?php echo($sm[0] + $sm[1]); ?></td>
                            <!--<td>
                                <img src='image/Application-View-Detail-32.png' width='18px' class='linkimage' title='Detail Posisi Surat Masuk' onclick='document.location.href="?mod=lanjut_rekap_total_staff&id_pengguna=<?php echo($ds_staff["id"]); ?>";' />
                            </td>-->
                        </tr>
        <?php
                    }
                }
        }
        ?>
        </tbody>
    </table>
   
</fieldset>
	</div>
</td>
</tr>
<tr>
    <td align="center" valign="middle">
    <div id='menu' style='border:0px solid black;'>
                    <nav>
                            <ul>
                                    <li><img src='./image/list.png'>&nbsp;&nbsp;<a href='<?=$url_main;?>'>BERANDA UTAMA</a></li>
                                    <li><img src='./image/list.png'>&nbsp;&nbsp;<a href='./?mod=latar_belakang'>LATAR BELAKANG</a></li>
                                    <li><img src='./image/list.png'>&nbsp;&nbsp;<a href='./?mod=berita_dan_informasi'>BERITA DAN INFORMASI</a></li>
									<li><img src='./image/list.png'>&nbsp;&nbsp;<a href='./?mod=fdownload'>FILE DOWNLOAD</a></li>
                                </ul>
                    </nav>
    </div>
    </td>
</tr>
<tr>
     <td><br><div id='footer'></div></td>
 </tr>
 </table>
 

