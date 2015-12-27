<script type="text/javascript">
$(document).ready(function(){
    $("#expand").click(function(){
        $("#bodyFilter").slideToggle(500);
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
function disposisi(id_surat, id_disposisi){
	 var t = document.getElementById("div_cek_"+id_surat);
	 if(t.innerHTML != ''){
		 t.innerHTML = '';
	  }else
		t.innerHTML='<iframe src="./isi/panel/modal/dialog_frm_dsp_sm_kaban.php?id_surat_masuk='+id_surat+'&id_disposisi='+id_disposisi+'" width="100%" style="height:1300px" frameborder="0" ' + 
		'scrolling="no" id="iframe_detail"></iframe>';	
}

</script>
<script type="text/javascript" src="./libraries/main.js"></script>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
        <td >
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'">
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00; href="./"></a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='<?=$url_main;?>'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span> </span>
                            <td><img  align="right" width="90" height="29" onclick="document.location.href='./'" 
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
	    <input type="button" value="+" style="float: right; display: block; font-weight: bold;" id="expand" />
		<fieldset id='bodyFilter'>
		<legend><h3>FILTER DATA PENCARIAN</h3></legend>
		<form name="frm" action="?mod=lacak_surat_masuk" method="post">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='20%'>Nomor Surat</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="no_surat" value="<?=isset($_POST["no_surat"]) ? $_POST['no_surat'] : ""; ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Tanggal Surat</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="text" name="tgl_surat_dari" id="tgl_surat_dari" class="ufilter" value="<?=isset($_POST["tgl_surat_dari"]) ? $_POST["tgl_surat_dari"] : ""; ?>" />
                        S/D
                        <input type="text" name="tgl_surat_sampai" id="tgl_surat_sampai" class="ufilter" value="<?=isset($_POST["tgl_surat_sampai"]) ? $_POST["tgl_surat_sampai"] : ""; ?>" />
                    </td>
                </tr>
                <tr>
                    <td width='20%'>Tanggal Terima</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="text" name="tgl_terima_dari" id="tgl_terima_dari" class="ufilter" value="<?=isset($_POST["tgl_terima_dari"]) ? $_POST["tgl_terima_dari"] : ""; ?>" />
                        S/D
                        <input type="text" name="tgl_terima_sampai" id="tgl_terima_sampai" class="ufilter" value="<?=isset($_POST["tgl_terima_sampai"]) ? $_POST["tgl_terima_sampai"] : ""; ?>" />
                    </td>
                </tr>
                <tr>
                    <td width='20%'>Perihal</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="perihal_surat" value="<?=isset($_POST["perihal_surat"]) ? $_POST["perihal_surat"] : ""; ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Deskripsi Surat</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="deskripsi_surat" value="<?=isset($_POST["deskripsi_surat"]) ? $_POST["deskripsi_surat"] : ""; ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>SKPD / Unit Pengirim</td>
                    <td width='10px'>:</td>
                    <td>
                        <select name="id_skpd_pengirim">
                            <option value="0">[.. Pilih SKPD Pengirim ..]</option>
                        <?php
                            $res_skpd = mysql_query("SELECT * FROM myapp_reftable_unitkerja ORDER BY unit_kerja ASC");
                            while($ds_skpd = mysql_fetch_array($res_skpd)){
                                if($ds_skpd["id_unit_kerja"] == $_POST["id_skpd_pengirim"])
                                    echo("<option selected='selected' value='" . $ds_skpd["id_unit_kerja"] . "'>" . $ds_skpd["unit_kerja"] . "</option>");
                                else
                                    echo("<option value='" . $ds_skpd["id_unit_kerja"] . "'>" . $ds_skpd["unit_kerja"] . "</option>");
                            }
                        ?>
                        </select>
                    </td>
                </tr>
            </table><br/>
            <table border="0px" cellspacing='0' cellpadding='0' width='40%'>
                <tr>
                    <td width='50%'><input type="submit" value='Filter' style="width: 100%;" /></td>
                    <td width='50%'><input type="reset" value='Reset' style="width: 100%;" /></td>
                </tr>
            </table>
	</form>
</fieldset>	<br/><br/>

<fieldset>
    <legend><h3>REKAPITULASI SURAT MASUK</h3></legend>
   
    <table border="1" width="100%" align="left" cellpadding="5" cellspacing="1" class='tblisi'>
      
        <tr class="headertable">
            <th width='40px'>No.</th>
            <th width='200px'>No. Surat</th>
            <th width='100px'>Tgl. Surat</th>
            <th width='100px'>Tgl. Terima</th>
            <th>Perihal</th>
            <th width='250px'>Unit Pengirim</th>
            <th width='100px'>Harus Selesai</th>
            <th width='20px'>&nbsp;</th>
            <th width='20px'>&nbsp;</th>
            <th width='20px'>&nbsp;</th>
            <!--<th width='20px'>&nbsp;</th>-->
        </tr>
       
    <?php
        $whr = "";
        $sql = "";
        if($_SESSION["id_level"]== 1 || $_SESSION["id_level"]== 2 || $_SESSION["id_level"] == 18){
            if(isset($_POST["no_surat"]) && $_POST["no_surat"] <> "")
                $whr .= " AND a.no_surat LIKE '%" . $_POST["no_surat"] . "%'";
            if(isset($_POST["tgl_surat_dari"]) && isset($_POST["tgl_surat_sampai"]) && $_POST["tgl_surat_dari"] <> "" && $_POST["tgl_surat_sampai"] <> "")
                $whr .= " AND a.tgl_surat BETWEEN '" . $_POST["tgl_surat_dari"] . "' AND '" . $_POST["tgl_surat_sampai"] . "'";
            if(isset($_POST["tgl_terima_dari"]) && isset($_POST["tgl_terima_sampai"]) && $_POST["tgl_terima_dari"] <> "" && $_POST["tgl_terima_sampai"] <> "")
                $whr .= " AND a.tgl_terima BETWEEN '" . $_POST["tgl_terima_dari"] . "' AND '" . $_POST["tgl_terima_sampai"] . "'";
            if(isset($_POST["perihal_surat"]) && $_POST["perihal_surat"] <> "")
                $whr .= " AND a.perihal_surat LIKE '%" . $_POST["perihal_surat"] . "%'";
            if(isset($_POST["deskripsi_surat"]) && $_POST["deskripsi_surat"] <> "")
                $whr .= " AND a.deskripsi_surat LIKE '%" . $_POST["deskripsi_surat"] . "%'";
            if(isset($_POST["id_skpd_pengirim"]) && $_POST["id_skpd_pengirim"] <> 0)
                $whr .= " AND a.id_skpd_pengirim = '" . $_POST["id_skpd_pengirim"] . "'";
            
            
            $sql = "SELECT 
                    	a.*, b.unit_kerja
                    FROM 
                    	myapp_maintable_suratmasuk a
                    	LEFT JOIN myapp_reftable_unitkerja b ON a.id_skpd_pengirim = b.id_unit_kerja
                    WHERE
                    	1 " . $whr . "
                    GROUP BY
                        a.id
                    ORDER BY 
                    	id DESC";
        }else{
		
            if(isset($_POST["no_surat"]) && $_POST["no_surat"] <> "")
                $whr .= " AND a.no_surat LIKE '%" . $_POST["no_surat"] . "%'";
            if(isset($_POST["tgl_surat_dari"]) && isset($_POST["tgl_surat_sampai"]) && $_POST["tgl_surat_dari"] <> "" && $_POST["tgl_surat_sampai"] <> "")
                $whr .= " AND a.tgl_surat BETWEEN '" . $_POST["tgl_surat_dari"] . "' AND '" . $_POST["tgl_surat_sampai"] . "'";
            if(isset($_POST["tgl_terima_dari"]) && isset($_POST["tgl_terima_sampai"]) && $_POST["tgl_terima_dari"] <> "" && $_POST["tgl_terima_sampai"] <> "")
                $whr .= " AND a.tgl_terima BETWEEN '" . $_POST["tgl_terima_dari"] . "' AND '" . $_POST["tgl_terima_sampai"] . "'";
            if(isset($_POST["perihal_surat"]) && $_POST["perihal_surat"] <> "")
                $whr .= " AND a.perihal_surat LIKE '%" . $_POST["perihal_surat"] . "%'";
            if(isset($_POST["deskripsi_surat"]) && $_POST["deskripsi_surat"] <> "")
                $whr .= " AND a.deskripsi_surat LIKE '%" . $_POST["deskripsi_surat"] . "%'";
            if(isset($_POST["id_skpd_pengirim"]) && $_POST["id_skpd_pengirim"] <> 0)
                $whr .= " AND a.id_skpd_pengirim = '" . $_POST["id_skpd_pengirim"] . "'";
          
		   
            // PERTAMA CARI URUTANNYA
            $ds_urutan = mysql_fetch_array(mysql_query("SELECT * FROM myapp_reftable_levelpengguna WHERE id='" . $_SESSION["id_level"] . "'"));
            $urutan = $ds_urutan["urutan"];
            
            $tmbh = " (c.id_level_tujuan = '" . $_SESSION["id_level"] . "' ";
            if($urutan == 2){
                $res_bawahan = mysql_query("SELECT * FROM myapp_reftable_levelpengguna WHERE atasan='" . $_SESSION["id_level"] . "'");
                while($ds_bawahan = mysql_fetch_array($res_bawahan)){
                    $tmbh .= " OR ";
                    $tmbh .= " c.id_level_tujuan = '" . $ds_bawahan["id"] . "' ";
                    
                }
            }else if($urutan == 3){
                $res_bawahan = mysql_query("SELECT * FROM myapp_reftable_levelpengguna WHERE atasan='" . $_SESSION["atasan"] . "' AND urutan=4");
                while($ds_bawahan = mysql_fetch_array($res_bawahan)){
                    $tmbh .= " OR ";
                    $tmbh .= " (c.id_level_asal = '" . $_SESSION["id_level"] . "' AND c.id_level_tujuan = '" . $ds_bawahan["id"] . "') ";
                    $tmbh .= " OR ";
                    $tmbh .= " (c.id_level_asal = '" . $ds_bawahan["id"] . "' AND c.id_level_tujuan = '" . $_SESSION["id_level"] . "') ";
                }
                $res_bawahan_langsung = mysql_query("SELECT * FROM myapp_maintable_pengguna WHERE level_kasubbid='" . $_SESSION["id_level"] . "'");
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
        }
        //echo($sql);
        $res = mysql_query($sql);
        $ctr = 0;
        while($ds = mysql_fetch_array($res)){
            $ctr++;
            echo("<tr>");
                echo("<td align='center'>" . $ctr . "</td>");
                echo("<td>" . $ds["no_surat"] . "</td>");
                echo("<td>" . tglindonesia($ds["tgl_surat"]) . "</td>");
                echo("<td>" . tglindonesia($ds["tgl_terima"]) . "</td>");
                echo("<td>" . $ds["perihal_surat"] . "</td>");
                echo("<td>" . $ds["unit_kerja"] . "</td>");
                if($ds["harus_selesai"] == "0000-00-00")
                    echo("<td>[.:: === ::.]</td>");
                else
                    echo("<td>" . $ds["harus_selesai"] . "</td>");
                echo("<td align='center'>");
                    echo("<img src='image/information_32.png' width='18px' class='linkimage' title='Detail Surat Masuk' onclick='lihat_detail_sm(" . $ds["id"] . ", 0);'>");
                echo("</td>");
                echo("<td align='center'>");
                    echo("<img src='image/icon-disposisi.png' width='18px' class='linkimage' title='Daftar catatan disposisi' onclick='lihat_cadis_sm(" . $ds["id"] . ", 0);'>");
                echo("</td>");
                echo("<td align='center'>");
                    echo("<img src='image/Attachment-32.png' width='18px' class='linkimage' title='File yang dilampirkan' onclick='lihat_file_sm(" . $ds["id"] . ", 0);'>");
                echo("</td>");
                /*echo("<td align='center'>");
                    echo("<img src='image/Application-View-Detail-32.png' width='18px' class='linkimage' title='Detail Posisi Surat Masuk' onclick='document.location.href=\"?mod=detail_posisi_surat_masuk&id=" . $ds["id"] . "\"'>");
                echo("</td>");*/
            echo("</tr>");
						echo "
					<tr id='div_if'>
						<span style='display:none;' id='load_text'></span>
						<td colspan='11'> <div id='div_cek_".$ds["id"]."'></div>
					</tr>
					";	
        }
    ?>
  
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

