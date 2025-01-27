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

</script>
<script type="text/javascript" src="./libraries/main.js"></script>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
        <td >
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="./?mod=posisi_surat_masuk_kabid">SURAT MASUK KABID</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='<?=$url_main;?>'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>SURAT MASUK KABID</span>
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
		
    <input type="button" value="+" style="float: right; display: block; font-weight: bold;" id="expand" />
	<fieldset>
        <legend><h3>FILTER DATA PENCARIAN</h3></legend>
		<form name="frm" action="?mod=<?=($_GET["mod"]); ?>" method="POST">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='20%'>Nomor Register</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="id" value="<?=isset($_POST["id"]) ? $_POST["id"] : ""; ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Nomor Surat</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="no_surat" value="<?=isset($_POST["no_surat"]) ? $_POST["no_surat"] : ""; ?>" /></td>
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
	</fieldset><br/><br/>   

<fieldset>
    <legend><h3>DAFTAR SURAT MASUK YANG DITERIMA</h3></legend>
    
   <table border="1" width="100%" align="left" cellpadding="5" cellspacing="1" class='tblisi'>
       
        <tr>
            <td>&nbsp;</td>
            <td>No.</td>
            <td>No. Register</td>
            <td>No. Surat</td>
            <td>Tgl. Surat</td>
            <td>Tgl. Terima</td>
            <td>Perihal</td>
            <td>Unit Pengirim</td>
            <td>Asal Disposisi</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>

    <?php
        $whr = "";
        if(isset($_POST["id"]) && $_POST["id"] <> "")
            $whr .= " AND a.noreg = '" . $_POST["id"] . "'";
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
            
			$batas = 10;
			$halaman = $_GET["halaman"];
			
			if(empty($halaman))
			{
				$posisi = 0;
				$halaman = 1;
			}
			else
				$posisi = ($halaman - 1) * $batas;	
			
        $res = mysql_query("SELECT 
                            	a.*, b.unit_kerja, c.status AS kondisi, d.level AS asal, c.id AS id_disposisi
                            FROM 
                            	myapp_maintable_suratmasuk a
                            	LEFT JOIN myapp_reftable_unitkerja b ON a.id_skpd_pengirim = b.id_unit_kerja
                            	LEFT JOIN myapp_disptable_suratmasuk c ON a.id = c.id_surat_masuk
                            	LEFT JOIN myapp_reftable_levelpengguna d ON c.id_level_asal = d.id
                            WHERE
                            	c.id_level_tujuan = '" . $_SESSION["id_level"] . "' AND c.status < 3 " . $whr . "
                            ORDER BY 
                            	id ASC limit ".$posisi.",".$batas."") or die(mysql_error());
								
		
			$jlh_data = mysql_num_rows($res);
				 
			
			$jmlhal  = ceil($jlh_data / $batas);
			
			echo '<form name=f2><span style="font:Verdana;font-size:12px; float:left;">';
			echo '<span style=font-family:verdana;font-size:12px> Halaman: 
			<select name="halaman" onchange="paging();">';
				for($i = 1; $i <= $jmlhal; $i++)
				{
					if ($i == $halaman)
					{
						echo '<option values="'.$i.'" selected>'.$i.'</option>';
					}
					
					else
					{
						echo '<option values="'.$i.'">'.$i.'</option>';
					}
				}
					
			echo '</select>';
			echo ' dari '.$jmlhal.' Halaman</span>';
			echo '</span></form><br><br><br>';								
									
        $ctr = 0;
        while($ds = mysql_fetch_array($res)){
            $ctr++;
            echo("<tr>");
                $kondisi = "belumdibaca";
                if($ds["kondisi"] == 2)
                    $kondisi = "telahdibaca";
                echo("<td align='center'><div class='lampu " . $kondisi . "' id='kondisi_" . $ds["id"] . "'>&nbsp;</div></td>");
                echo("<td align='center'>" . $ctr . "</td>");
                echo("<td align='center'>" . no_register($ds["noreg"]) . "</td>");
                echo("<td>" . $ds["no_surat"] . "</td>");
                echo("<td>" . tglindonesia($ds["tgl_surat"]) . "</td>");
                echo("<td>" . tglindonesia($ds["tgl_terima"]) . "</td>");
                echo("<td>" . $ds["perihal_surat"] . "</td>");
                echo("<td>" . $ds["unit_kerja"] . "</td>");
                echo("<td>" . $ds["asal"] . "</td>");
                echo("<td align='center'>");
                    echo("<img src='image/information_32.png' width='18px' class='linkimage' title='Detail Surat Masuk' onclick='lihat_detail_sm(" . $ds["id"] . ", " . $ds["id_disposisi"] . ");'>");
                echo("</td>");
                echo("<td align='center'>");
                    echo("<img src='image/icon-disposisi.png' width='18px' class='linkimage' title='Daftar catatan disposisi' onclick='lihat_cadis_sm(" . $ds["id"] . ", " . $ds["id_disposisi"] . ");'>");
                echo("</td>");
                echo("<td align='center'>");
                    echo("<img src='image/Attachment-32.png' width='18px' class='linkimage' title='File yang dilampirkan' onclick='lihat_file_sm(" . $ds["id"] . ", " . $ds["id_disposisi"] . ");'>");
                echo("</td>");
                echo("<td align='center'>");
                    echo("<img src='image/send_32.png' width='18px' class='linkimage' title='Lanjutkan Disposisi' onclick='munculDisposisi(" . $ds["id"] . ", " . $ds["id_disposisi"] . ");'>");
                echo("</td>");
            echo("</tr>");
			echo "
					<tr id='div_if'>
						<span style='display:none;' id='load_text'></span>
						<td colspan='13'> <div id='div_cek_".$ds["id"]."'></div>
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
 

