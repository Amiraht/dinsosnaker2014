<?php
	$query = mysql_query("UPDATE tbl_ucapan_ultah_pegawai SET lihat = '2' WHERE tujuan = '".$_SESSION['id_pegawai']."'");
?>


<table width="1024" border="0" cellspacing="2" cellpadding="5">
    <tr> 
      <!-- Header -->
          <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="">UCAPAN ULANG TAHUN</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>UCAPAN ULANG TAHUN (PEGAWAI)</span></td>
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
		<div class="panelcontainer" style="width: 100%;">
				<h3 style="text-align: left;">Daftar Ucapan Ulang Tahun Masuk Buat <?=$username;?></h3>
				<div class="bodypanel">
				<?php
					$sql = "SELECT a.* , b.nama_pegawai as 'dari' 
					
							FROM tbl_ucapan_ultah_pegawai a
							LEFT JOIN tbl_pegawai b ON a.dari = b.id_pegawai
							WHERE 
								a.tujuan = '". $_SESSION['id_pegawai'] ."' 
								ORDER BY tgl_post DESC";
								
					$res = mysql_query($sql);
					
					$no = 1;
					while($ds = mysql_fetch_array($res)){
						echo("<div class='judul_berita'>Ucapan ke - " . $no . "</div>");
						echo("<div class='tgl_berita'>Dikirim oleh ". ($ds["dari"] == "" ? "Admin Simpeg /SKPD" : $ds["dari"] ) ." pada : " . tglindonesia($ds["tgl_submit"]) . "</div>");
						echo("<div class='intro_berita'>" . $ds["pesan"] . "</div>");
						echo("<div class='kelang_border'></div><br/>");
						$no++;
					}
				?>
				</div>
	    </div>
	</div>
</td>
</tr>
<tr>
     <td><br><div id='footer'></div></td>
 </tr>
 </table>
 

