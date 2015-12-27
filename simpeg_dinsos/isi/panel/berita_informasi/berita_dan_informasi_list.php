

<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
          <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="">DAFTAR BERITA DAN INFORMASI</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>DAFTAR BERITA DAN INFORMASI</span></td>
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
				<h3 style="text-align: left;">BERITA DAN INFORMASI</h3>
				<div class="bodypanel">
				<?php
					$sql = "SELECT * FROM tbl_berita_informasi ORDER BY id_berita_informasi DESC";
					$res = mysql_query($sql);
					while($ds = mysql_fetch_array($res)){
						echo("<div class='judul_berita'>" . $ds["judul"] . "</div>");
						echo("<div class='tgl_berita'>Dipost pada : " . tglindonesia($ds["tgl_post"]) . "</div>");
						echo("<div class='intro_berita'>" . $ds["intro"] . "</div>");
						echo("<div class='selengkapnya_berita'><a href='?mod=berita_dan_informasi_detail&id_berita_informasi=" . $ds["id_berita_informasi"] . "'>Berita Selengkapnya</a></div>");
						echo("<div class='kelang_border'></div>");
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
 



