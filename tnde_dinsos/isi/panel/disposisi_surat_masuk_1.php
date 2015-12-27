<script type="text/javascript">
function disposisi(id){
	var konfirm = confirm("Anda yakin akan mendisposisikan data surat masuk ini?");
	if(konfirm){
			var tujuan_disposisi = $("#tujuan_disposisi_" + id).val();
            var catatan = $("#catatan_" + id).val();
            //alert("KE : " + tujuan_disposisi + "\nCatatan : " + catatan);
            document.location.href = "php/disposisi_surat_masuk_1.php?id=" + id + "&tujuan_disposisi=" + tujuan_disposisi + "&catatan=" + catatan;
	}else{
		// do nothing
	}
}
</script>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
        <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="./?mod=disposisi_surat_masuk_1">DISPOSISI SURAT MASUK</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='<?=$url_main;?>'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>DISPOSISI SURAT MASUK</span></td>
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
	<fieldset>
		<legend><h3>DAFTAR SURAT MASUK YANG AKAN DIDISPOSISIKAN KE BIDANG</h3></legend>
    
    <?php
        $res = mysql_query("SELECT 
                            	a.*, b.unit_kerja
                            FROM 
                            	myapp_maintable_suratmasuk a
                            	LEFT JOIN myapp_reftable_unitkerja b ON a.id_skpd_pengirim = b.id_unit_kerja
                            WHERE
                                status = 1
                            ORDER BY 
                            	id ASC");
        $ctr = 0;
        while($ds = mysql_fetch_array($res)){
            $ctr++;
           
            ?>
            <table border="0px" cellspacing='3' cellpadding='2' width='100%'>
			
                <tr>
                    <td rowspan="7" width='25px' style="background-color: green; color: white;"><center><?php echo($ctr); ?></center></td>
                    <td>Nomor Surat</td>
                    <td width='10px'>:</td>
                    <td><span class="detail"><?php echo($ds["no_surat"]); ?></span></td>
                </tr>
                <tr>
                    <td>Tanggal Surat</td>
                    <td width='10px'>:</td>
                    <td><span class="detail"><?php echo($ds["tgl_surat"]); ?></span></td>
                </tr>
                <tr>
                    <td>Tanggal Terima</td>
                    <td width='10px'>:</td>
                    <td><span class="detail"><?php echo($ds["tgl_terima"]); ?></span></td>
                </tr>
                <tr>
                    <td>Perihal</td>
                    <td width='10px'>:</td>
                    <td><span class="detail"><?php echo($ds["perihal_surat"]); ?></span></td>
                </tr>
                <tr>
					<td></td>
					<td></td>
                    <td>
                    <select id="tujuan_disposisi_<?php echo($ds["id"]); ?>" style='width:200px;'>
                        <option value="0">[.. Pilih Tujuan Disposisi ..]</option>
                    <?php
                        $res_ldb = mysql_query("SELECT * FROM myapp_reftable_levelpengguna WHERE atasan='" . $_SESSION["id_level"] . "'");
                        while($ds_ldb = mysql_fetch_array($res_ldb)){
                            echo("<option value='" . $ds_ldb["id"] . "'>" . $ds_ldb["level"] . "</option>");
                        }
                    ?>
                    </select>
                    </td>
                </tr><br/>
                <tr>
					<td></td>
					<td></td>
                    <td>
                        <textarea id="catatan_<?php echo($ds["id"]); ?>" placeholder=" :: Berikan Catatan Pada Disposisi ::" rows='9' cols='30'></textarea>
                    </td>
                </tr><br/><br/>
                <tr>
					<td></td>
					<td></td>
                    <td>
                        <input type="button" value="Kirim Disposisi" onclick="disposisi(<?php echo($ds["id"]) ?>);" />
                    </td>
                </tr>
            </table>
            <?php
            
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
