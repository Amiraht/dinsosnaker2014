
<table width="1024" border="0" cellspacing="2" cellpadding="5">
  <tr>
    <td><div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
      <table border="0" id="atasan">
        	<tr>
		            <td colspan="2" style="text-align:right; padding-right:10px; ">
                 	<h1><a style="color:#AA9F00;" href="./?mod=latar_belakang">LATAR BELAKANG</a></h1>
                    </td>
            </tr>
            <tr>
            	<td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                     <span> </span> <img src="./image/panah.gif" /> <span> </span> LATAR BELAKANG
                     </td>
                <td><img  align="right" width="90" height="29" onclick="document.location.href='./'" 
                    onmouseout="this.src='./image/button/KEMBALI.gif'" onmouseover="this.src='./image/button/KEMBALI2.gif'" src="./image/button/KEMBALI.gif"></img>
                    </td>
            </tr>
        </table>
</div></td>
  </tr>
  <tr>
    <td>
    		<div id='latar' style='padding-top:10px;'>
                <br>
	<fieldset style='width:90%; margin-left:20px; padding-left:20px;min-height:200px; margin-bottom:20px;'>
		<legend >LATAR BELAKANG	</legend>
		<br />
     
        	
			<table>
				
				<tr>
					<td style="font-size:14px">
			<?php
				$hasil_latar = mysql_query("SELECT latar_belakang  from myapp_statictable_latarbelakang where id_latar_belakang = 1");
				$baris_latar = mysql_fetch_array($hasil_latar);
				echo $baris_latar["latar_belakang"];
			?>
					</td>
				</tr>
			</table>
</fieldset>
</div>
  </td>
  </tr>
  <tr>
    <td align="center" valign="middle">
 		<div id='menu' margin-left:'8px;'>
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
	<div id='footer' style='background:url(./image/coba/footer.png) no-repeat; min-height:80px; margin-left:8px;'>
	</div></td>
  </tr>
</table>
