<?php

	$id_berita = mysql_real_escape_string(trim(strip_tags($_GET["id_berita_informasi"])));

    $ds = mysql_fetch_array(mysql_query("SELECT * FROM tbl_berita_informasi WHERE id_berita_informasi='" . $id_berita . "'"));
?>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
          <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href=""> DETAIL BERITA DAN INFORMASI </a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> 
								<span>BERANDA UTAMA</span></a>
                                 <span> </span> <img src="./image/panah.gif" /> <span> DETAIL BERITA DAN INFORMASI </span></td>
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
			<h3 style="text-align: left;"><?php echo(strtoupper($ds["judul"])); ?></h3>
			<div class="bodypanel">
				<input type="button" value="Kembali" onclick="document.location.href='?mod=berita_dan_informasi_list';" />
				<div class="kelang"></div>
				<div class="intro_berita"><?php echo($ds["isi"]); ?></div>
			</div>
		</div>
	</div>
</td>
</tr>
<tr>
     <td><br><div id='footer'></div></td>
 </tr>
 </table>
 



