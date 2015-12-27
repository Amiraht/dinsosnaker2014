
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

function munculDisposisi(id_surat_masuk, id_disposisi){
    //$("#id_surat_masuk").val(id_surat_masuk);
    //$("#id_disposisi").val(id_disposisi);
    //$("#dialog_form_disp").dialog("open");
	window.open("./?mod=dialog_laporan_mntkbn&id_surat_masuk="+id_surat_masuk+"&id_disposisi="+id_disposisi+"","Disposisi Surat Masuk","width=1000,height=700");
}
function showDetails(bookURL){
       window.open(bookURL,"bookDetails","width=1000,height=700");
}
</script>
<script type="text/javascript" src="./libraries/main.js"></script>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
          <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="./?mod=laporan_mntkbn">REKAPITULASI SURAT MASUK</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='<?=$url_main;?>'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>REKAPITULASI SURAT MASUK</span></td>
                            <td><img  align="right" width="90" height="29" onclick="document.location.href='<?=$url_main;?>';" 
                                onmouseout="this.src='./image/button/KEMBALI.gif'" onmouseover="this.src='./image/button/KEMBALI2.gif'" src="./image/button/KEMBALI.gif"></img>
                                </td>
                        </tr>
                    </table>            
                    </div>
            <br>
        </th>
  </tr>
  <tr>
  	<td>
    <div id='content' style='padding-top:10px;'>	<br>
	<input type="button" value="+" style="float: right; display: block; font-weight: bold;" id="expand" /><br/><br/>
	<fieldset id='bodyFilter'>
		<legend><h3>FILTER DATA PENCARIAN</h3></legend>
		
        <form name="frm" action="?mod=lacak_surat_masuk" method="post">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='20%'>Nomor Surat</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="no_surat" value="<?php echo($_POST["no_surat"]); ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Tanggal Surat</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="text" name="tgl_surat_dari" id="tgl_surat_dari" class="ufilter" value="<?php echo($_POST["tgl_surat_dari"]); ?>" />
                        S/D
                        <input type="text" name="tgl_surat_sampai" id="tgl_surat_sampai" class="ufilter" value="<?php echo($_POST["tgl_surat_sampai"]); ?>" />
                    </td>
                </tr>
                <tr>
                    <td width='20%'>Tanggal Terima</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="text" name="tgl_terima_dari" id="tgl_terima_dari" class="ufilter" value="<?php echo($_POST["tgl_terima_dari"]); ?>" />
                        S/D
                        <input type="text" name="tgl_terima_sampai" id="tgl_terima_sampai" class="ufilter" value="<?php echo($_POST["tgl_terima_sampai"]); ?>" />
                    </td>
                </tr>
                <tr>
                    <td width='20%'>Perihal</th>
                    <td width='10px'>:</th>
                    <td><input type="text" name="perihal_surat" value="<?php echo($_POST["perihal_surat"]); ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Deskripsi Surat</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="deskripsi_surat" value="<?php echo($_POST["deskripsi_surat"]); ?>" /></td>
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
                    </th>
                </tr>
            </table><br/>
            <table border="0px" cellspacing='0' cellpadding='0' width='40%'>
                <tr>
                    <td width='50%'><input type="submit" value='Filter' style="width: 100%;" /></td>
                    <td width='50%'><input type="reset" value='Reset' style="width: 100%;" /></td>
                </tr>
            </table>
     </form>
</fieldset><br/><br/>	 
	
	<fieldset>
    <legend><h3>REKAPITULASI SURAT MASUK</h3></legend>
    
    <table border="1" width="1000" align="left" cellpadding="5" cellspacing="1" class='tblisi'>
    
        <tr>
            <th width='40px' rowspan="2">No.</th>
            <th width='250px' rowspan="2">No. Surat</th>
            <th width='150px' rowspan="2">Tgl. Surat</th>
            <th width='150px' rowspan="2">Tgl. Terima</th>
            <th width='250px' rowspan="2">Unit Pengirim</th>
            <th rowspan="2">Perihal</th>
            <th colspan="2">Surat Turun</th>
            <th colspan="2">Surat Naik</th>
            <th rowspan="2">Status Surat</th>
            <th rowspan="2">&nbsp;</th>
            <th rowspan="2">&nbsp;</th>
            <th rowspan="2">&nbsp;</th>
            <!--<td width='20px'>&nbsp;</th>-->
        </tr>
        <tr>
            <th>Posisi</th>
            <th>Tanggal</th>
            <th>Posisi</th>
            <th>Tanggal</th>
        </tr>
		 <?php
        $whr = "";
        $sql = "";
        
            if($_POST["no_surat"] <> "")
                $whr .= " AND a.no_surat LIKE '%" . $_POST["no_surat"] . "%'";
            if($_POST["tgl_surat_dari"] <> "" && $_POST["tgl_surat_sampai"] <> "")
                $whr .= " AND a.tgl_surat BETWEEN '" . $_POST["tgl_surat_dari"] . "' AND '" . $_POST["tgl_surat_sampai"] . "'";
            if($_POST["tgl_terima_dari"] <> "" && $_POST["tgl_terima_sampai"] <> "")
                $whr .= " AND a.tgl_terima BETWEEN '" . $_POST["tgl_terima_dari"] . "' AND '" . $_POST["tgl_terima_sampai"] . "'";
            if($_POST["perihal_surat"] <> "")
                $whr .= " AND a.perihal_surat LIKE '%" . $_POST["perihal_surat"] . "%'";
            if($_POST["deskripsi_surat"] <> "")
                $whr .= " AND a.deskripsi_surat LIKE '%" . $_POST["deskripsi_surat"] . "%'";
            if($_POST["id_skpd_pengirim"] <> 0)
                $whr .= " AND a.id_skpd_pengirim = '" . $_POST["id_skpd_pengirim"] . "'";
            
            
            $sql = "SELECT
                    	a.id, a.no_surat AS no_surat_masuk, a.tgl_surat AS tgl_surat_masuk, a.tgl_terima, a.perihal_surat, h.unit_kerja,
                    	f.level AS disposisi_surat_masuk, b.tgl_disposisi AS tgl_disposisi_surat_masuk, b.status AS status_disposisi_surat_masuk,
                    	d.no_surat AS no_surat_keluar, d.tgl_surat AS tgl_surat_keluar,
                    	g.level AS disposisi_surat_keluar, e.tgl_disposisi AS tgl_disposisi_surat_keluar, e.status AS status_disposisi_surat_keluar,
                    	d.status AS status_surat_keluar
                    FROM
                    	myapp_maintable_suratmasuk a
                    	LEFT JOIN(
                    		SELECT a.* FROM myapp_disptable_suratmasuk a
                    		WHERE a.id = (SELECT MAX(id) FROM myapp_disptable_suratmasuk WHERE id_surat_masuk = a.id_surat_masuk)
                    		ORDER BY a.id_surat_masuk
                    	) b ON a.id = b.id_surat_masuk
                    	LEFT JOIN myapp_maintable_balasan c ON a.id = c.id_surat_masuk
                    	LEFT JOIN myapp_maintable_suratkeluar d ON c.id_surat_keluar = d.id
                    	LEFT JOIN (
                    		SELECT a.* FROM myapp_disptable_suratkeluar a
                    		WHERE a.id = (SELECT MAX(id) FROM myapp_disptable_suratkeluar WHERE id_surat_keluar = a.id_surat_keluar)
                    		ORDER BY a.id_surat_keluar
                    	) e ON d.id = e.id_surat_keluar
                    	LEFT JOIN myapp_reftable_levelpengguna f ON b.id_level_tujuan = f.id
                    	LEFT JOIN myapp_reftable_levelpengguna g ON e.id_level_tujuan = g.id
                    	LEFT JOIN myapp_reftable_unitkerja h ON a.id_skpd_pengirim = h.id_unit_kerja
                    WHERE
                    	1 " . $whr . "
                    ORDER BY
                    	a.id
                    ";
        
        //echo($sql);
        $res = mysql_query($sql);
        $ctr = 0;
        $rec = mysql_num_rows($res);
        if($rec < 5000){
            while($ds = mysql_fetch_array($res)){
                $ctr++;
                $status_surat = "";
                echo("<tr>");
                    echo("<td align='center'>" . $ctr . "</td>");
                    echo("<td>" . $ds["no_surat_masuk"] . "</td>");
                    echo("<td>" . tglindonesia($ds["tgl_surat_masuk"]) . "</td>");
                    echo("<td>" . tglindonesia($ds["tgl_terima"]) . "</td>");
                    echo("<td>" . $ds["unit_kerja"] . "</td>");
                    echo("<td>" . $ds["perihal_surat"] . "</td>");
                    if($ds["disposisi_surat_keluar"] == ""){
                        echo("<td>" . $ds["disposisi_surat_masuk"] . "</td>");
                        echo("<td>" . $ds["tgl_disposisi_surat_masuk"] . "</td>");
                        echo("<td align='center'>---</td>");
                        echo("<td align='center'>---</td>");
                        echo("<td align='center'>Proses Turun</td>");
                    }else{
                        echo("<td align='center'>---</td>");
                        echo("<td align='center'>---</td>");
                        echo("<td>" . $ds["disposisi_surat_keluar"] . "</td>");
                        echo("<td>" . $ds["tgl_disposisi_surat_keluar"] . "</td>");
                        //echo("<td>Proses Naik</td>;
                        if($ds["status_surat_keluar"] == 3)
                            echo("<td align='center'>Selesai</td>");
                        else if($ds["status_surat_keluar"] == 2)
                            echo("<td align='center'>Menunggu Pengiriman</td>");
                        else if($ds["status_surat_keluar"] == 1)
                            echo("<td align='center'>Proses Naik</td>");
                    }
                    
                    echo("<td align='center'>");
                        echo("<img src='image/Info-32.png' width='18px' class='linkimage' title='Detail Surat Masuk' onclick='lihat_detail_sm(" . $ds["id"] . ", 0);'>");
                    echo("</td>");
                    echo("<td align='center'>");
                        echo("<img src='image/icon-disposisi.png' width='18px' class='linkimage' title='Daftar catatan disposisi' onclick='lihat_cadis_sm(" . $ds["id"] . ", 0);'>");
                    echo("</td>");
                    echo("<td align='center'>");
                        echo("<img src='image/Attachment-32.png' width='18px' class='linkimage' title='File yang dilampirkan' onclick='lihat_file_sm(" . $ds["id"] . ", 0);'>");
                    echo("</td>");
                  
                echo("</tr>");
				echo "
					<tr id='div_if'>
						<span style='display:none;' id='load_text'></span>
						<td colspan='14'> <div id='div_cek_".$ds["id"]."'></div></td>
					</tr>
					";
            }
        }else{
            echo("<h3>Data yang di load lebih dari 5000 record. Harap lakukan filter</h3>");
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

