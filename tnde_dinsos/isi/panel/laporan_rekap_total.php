
<script type="text/javascript">

function disposisi(id_surat, id_disposisi){
	 var t = document.getElementById("div_cek_"+id_surat);
	 if(t.innerHTML != ''){
		 t.innerHTML = '';
	  }else
		t.innerHTML='<iframe src="./isi/panel/modal/dialog_frm_dsp.php?id_surat_masuk='+id_surat+'&id_disposisi='+id_disposisi+'" width="100%" style="height:1300px" frameborder="0" ' + 
		'scrolling="no" id="iframe_detail"></iframe>';	
	}
	
function kestaff(id_bidang){
    //$("#staff").html(id_bidang);
    $("#staff").html("Loading . . .");
    $.ajax({
        type: "GET",
        url: "ajax/disposisi_kasubbid.php",
        data: "id=" + id_bidang,
        success: function(r){
            //alert(r);
            $("#staff").html(r);
        }
    });
}
</script>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
        <td >
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'">
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00; href="./?mod=laporan_rekap_total">LAPORAN REKAP TOTAL</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='<?=$url_main;?>'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span> </span>LAPORAN REKAP TOTAL
                            <td><img  align="right" width="90" height="29" onclick="document.location.href='<?=$url_main;?>'" 
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
		<?php
    function jumlah_sm_kabid_kasubbid($id_level, $atasan){
        // PERTAMA CARI URUTANNYA
        $ds_urutan = mysql_fetch_array(mysql_query("SELECT * FROM myapp_reftable_levelpengguna WHERE id='" . $id_level . "'"));
        $urutan = $ds_urutan["urutan"];
        
        $tmbh = " (c.id_level_tujuan = '" . $id_level . "' ";
        if($urutan == 2){
            $res_bawahan = mysql_query("SELECT * FROM myapp_reftable_levelpengguna WHERE atasan='" . $id_level . "'");
            while($ds_bawahan = mysql_fetch_array($res_bawahan)){
                $tmbh .= " OR ";
                $tmbh .= " c.id_level_tujuan = '" . $ds_bawahan["id"] . "' ";
                
            }
        }else if($urutan == 3){
            $res_bawahan = mysql_query("SELECT * FROM myapp_reftable_levelpengguna WHERE atasan='" . $atasan . "' AND urutan=4");
            while($ds_bawahan = mysql_fetch_array($res_bawahan)){
                $tmbh .= " OR ";
                $tmbh .= " (c.id_level_asal = '" . $id_level . "' AND c.id_level_tujuan = '" . $ds_bawahan["id"] . "') ";
                $tmbh .= " OR ";
                $tmbh .= " (c.id_level_asal = '" . $ds_bawahan["id"] . "' AND c.id_level_tujuan = '" . $id_level . "') ";
            }
            $res_bawahan_langsung = mysql_query("SELECT * FROM myapp_maintable_pengguna WHERE level_kasubbid='" . $id_level . "'");
            while($ds_bawahan_langsung = mysql_fetch_array($res_bawahan_langsung)){
                $tmbh .= " OR ";
                $tmbh .= " (c.id_level_asal = '7' AND c.id_pengguna_tujuan = '" . $ds_bawahan_langsung["id"] . "') ";
            }
        }
        $tmbh .= " ) ";
        $sql = "SELECT 
                	a.*, b.unit_kerja
                FROM 
                	myapp_maintable_suratmasuk a
                	LEFT JOIN myapp_reftable_unitkerja b ON a.id_skpd_pengirim = b.id_unit_kerja
                    LEFT JOIN myapp_disptable_suratmasuk c ON a.id = c.id_surat_masuk
                WHERE
                	1 AND " . $tmbh . $whr . "
                GROUP BY
                    a.id
                ORDER BY 
                	id DESC";
        $res = mysql_query($sql);
        return mysql_num_rows($res);
    }
    
    function jumlah_sm_staff($id_staff){
        $sql = "SELECT 
                	a.*, b.unit_kerja
                FROM 
                	myapp_maintable_suratmasuk a
                	LEFT JOIN myapp_reftable_unitkerja b ON a.id_skpd_pengirim = b.id_unit_kerja
                    LEFT JOIN myapp_disptable_suratmasuk c ON a.id = c.id_surat_masuk
                WHERE
                	1 AND c.id_pengguna_tujuan = '" . $id_staff . "'
                GROUP BY
                    a.id
                ORDER BY 
                	id DESC";
        //echo($sql);
        $res = mysql_query($sql);
        return mysql_num_rows($res);
    }
?>
<fieldset>
    <legend><h3>REKAPITULASI PENERIMAAN SURAT</h3></legend>

     <table border="1" width="100%" align="left" cellpadding="5" cellspacing="1" class='tblisi'>
        <tr>
            <th width='40px'>No.</th>
            <th>Pejabat / Nama Pegawai</th>
            <th width='100px'>Surat Diterima</th>
            <th width='20px'>&nbsp;</th>
        </tr>
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
                    <td align='center'><?php echo(jumlah_sm_kabid_kasubbid($ds_kabid["id"], $ds_kabid["atasan"])); ?></td>
                    <td>
                        <img src='image/Application-View-Detail-32.png' width='18px' class='linkimage' title='Detail Posisi Surat Masuk' onclick='document.location.href="?mod=lanjut_rekap_total_kabbid_kasubbid&id_level=<?php echo($ds_kabid["id"]); ?>&atasan=<?php echo($ds_kabid["atasan"]); ?>";' />
                    </td>
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
                        <td align='center'><?php echo(jumlah_sm_kabid_kasubbid($ds_kasubbid["id"], $ds_kasubbid["atasan"])); ?></td>
                        <td>
                            <img src='image/Application-View-Detail-32.png' width='18px' class='linkimage' title='Detail Posisi Surat Masuk' onclick='document.location.href="?mod=lanjut_rekap_total_kabbid_kasubbid&id_level=<?php echo($ds_kasubbid["id"]); ?>&atasan=<?php echo($ds_kasubbid["atasan"]); ?>";' />
                        </td>
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
                            <td align='center'><?php echo(jumlah_sm_staff($ds_staff["id"])); ?></td>
                            <td>
                                <img src='image/Application-View-Detail-32.png' width='18px' class='linkimage' title='Detail Posisi Surat Masuk' onclick='document.location.href="?mod=lanjut_rekap_total_staff&id_pengguna=<?php echo($ds_staff["id"]); ?>";' />
                            </td>
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
                    <td align='center'><?php echo(jumlah_sm_kabid_kasubbid($ds_kabid["id"], $ds_kabid["atasan"])); ?></td>
                    <td>
                        <img src='image/Application-View-Detail-32.png' width='18px' class='linkimage' title='Detail Posisi Surat Masuk' onclick='document.location.href="?mod=lanjut_rekap_total_kabbid_kasubbid&id_level=<?php echo($ds_kabid["id"]); ?>&atasan=<?php echo($ds_kabid["atasan"]); ?>";' />
                    </td>
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
                        <td align='center'><?php echo(jumlah_sm_kabid_kasubbid($ds_kasubbid["id"], $ds_kasubbid["atasan"])); ?></td>
                        <td>
                            <img src='image/Application-View-Detail-32.png' width='18px' class='linkimage' title='Detail Posisi Surat Masuk' onclick='document.location.href="?mod=lanjut_rekap_total_kabbid_kasubbid&id_level=<?php echo($ds_kasubbid["id"]); ?>&atasan=<?php echo($ds_kasubbid["atasan"]); ?>";' />
                        </td>
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
                            <td align='center'><?php echo(jumlah_sm_staff($ds_staff["id"])); ?></td>
                            <td>
                                <img src='image/Application-View-Detail-32.png' width='18px' class='linkimage' title='Detail Posisi Surat Masuk' onclick='document.location.href="?mod=lanjut_rekap_total_staff&id_pengguna=<?php echo($ds_staff["id"]); ?>";' />
                            </td>
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
                        <td align='center'><?php echo(jumlah_sm_kabid_kasubbid($ds_kasubbid["id"], $ds_kasubbid["atasan"])); ?></td>
                        <td>
                            <img src='image/Application-View-Detail-32.png' width='18px' class='linkimage' title='Detail Posisi Surat Masuk' onclick='document.location.href="?mod=lanjut_rekap_total_kabbid_kasubbid&id_level=<?php echo($ds_kasubbid["id"]); ?>&atasan=<?php echo($ds_kasubbid["atasan"]); ?>";' />
                        </td>
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
                            <td align='center'><?php echo(jumlah_sm_staff($ds_staff["id"])); ?></td>
                            <td>
                                <img src='image/Application-View-Detail-32.png' width='18px' class='linkimage' title='Detail Posisi Surat Masuk' onclick='document.location.href="?mod=lanjut_rekap_total_staff&id_pengguna=<?php echo($ds_staff["id"]); ?>";' />
                            </td>
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
                                    <li><img src='./image/list.png'>&nbsp;&nbsp;<a href='./'>BERANDA UTAMA</a></li>
                                    <li><img src='./image/list.png'>&nbsp;&nbsp;<a href='./?mod=latar_belakang'>LATAR BELAKANG</a></li>
                                    <li><img src='./image/list.png'>&nbsp;&nbsp;<a href='./?mod=berita_dan_informasi'>BERITA DAN INFORMASI</a></li>
									<li><img src='./image/list.png'>&nbsp;&nbsp;<a href='./?mod=fdownload'>FILE DOWNLOAD</a></li>
									<li><img src='./image/list.png'>&nbsp;&nbsp;<a href='./?mod=login'>PROSES LOGIN</a></li>
                                    <li><img src='./image/list.png'>&nbsp;&nbsp;<a href='./?mod=cpanel_main'>CONTROL PANEL</a></li>
                                </ul>
                    </nav>
    </div>
    </td>
</tr>
<tr>
    <td>
    <div id='footer' style='background:url(./image/coba/footer.png) no-repeat;height:100px;'>
        </div>
     </td>
 </tr>
 </table>
 

