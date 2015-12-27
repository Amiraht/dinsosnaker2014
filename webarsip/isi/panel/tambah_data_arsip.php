
<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
          <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="">TAMBAH DATA ARSIP AKTIF</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>TAMBAH DATA ARSIP AKTIF</span></td>
                            <td><img  align="right" width="90" height="29" onclick="document.location.href='./?mod=tambah_data_arsip'" 
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
        <h3>TAMBAH DATA ARSIP AKTIF</h3>
        
		<form name="frm" action="php/tambah_data_arsip.php" method="post">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='10%'>Masalah</td>
                    <td width='10px'>:</td>
                    <td>
                        <select name="id_masalah">
                            <option value="0">[.. Pilih Masalah ..]</option>
                        <?php
                            $res_skpd = mysql_query("SELECT * FROM ref_masalah ORDER BY id_masalah ASC");
                            while($ds_skpd = mysql_fetch_array($res_skpd)){
                                echo("<option value='" . $ds_skpd["id_masalah"] . "'>(" . $ds_skpd["kode_masalah"] . ") " . $ds_skpd["masalah"] . "</option>");
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width='10%'>Tahun</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="text" name="tahun" value="" />
                    </td>
                </tr>
                <tr>
                    <td width='10%'>Deskripsi</td>
                    <td width='10px'>:</td>
                    <td>
                        <textarea name="uraian"></textarea>
                    </td>
                </tr>
                <tr>
                    <td width='10%'>Keterangan</td>
                    <td width='10px'>:</td>
                    <td>
                        <select name="keterangan">
                            <option value="0">[.. Pilih Keterangan ..]</option>
                        <?php
                            $res_skpd = mysql_query("SELECT * FROM ref_keterangan_benda_arsip ORDER BY id_keterangan_benda_arsip ASC");
                            while($ds_skpd = mysql_fetch_array($res_skpd)){
                                    echo("<option value='" . $ds_skpd["keterangan_benda_arsip"] . "'>" . $ds_skpd["keterangan_benda_arsip"] . "</option>");
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width='10%'>Keadaan</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="text" name="keadaan" value="" />
                    </td>
                </tr>
                <tr>
                    <td width='10%'>Sampul</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="text" name="sampul" value="" />
                    </td>
                </tr>
                <tr>
                    <td width='10%'>Kotak</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="text" name="box" value="" />
                    </td>
                </tr>
                <tr>
                    <td width='10%'>Rak</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="text" name="rak" value="" />
                    </td>
                </tr>
                <tr>
                    <td width='10%'>&nbsp;</td>
                    <td width='10px'>&nbsp;</td>
                    <td>
                        <b>Arsip aktif adalah arsip yang belum dikumpulkan oleh pihak Kantor Arsip Pemerintah Kota Medan,
                        tetapi arsip masih berada pada Kantor/Unit Kerja/SKPD yang bersangkutan. Dan ketika berkas arsip
                        telah dikumpulkan, maka kemudian data lokasi penyimpanan arsip (sampul, kotak, rak)
                        akan diinput oleh pihak Kantor Arsip.</b>
                    </td>
                </tr>
            </table><br/>
            <table border="0px" cellspacing='0' cellpadding='0' width='40%'>
                <tr>
                    <td width='33%'><input type="submit" value='Simpan' style="width: 100%;" /></td>
                    <td width='33%'><input type="reset" value='Reset' style="width: 100%;" /></td>
                    <td width='33%'><input type="button" value='Kembali' style="width: 100%;" onclick="document.location.href='?mod=data_arsip';" /></td>
                </tr>
            </table>
		</form>
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
                                </ul>
                    </nav>
    </div>
    </td>
</tr>
<tr>
     <td><br><div id='footer'></div></td>
 </tr>
 </table>
 
