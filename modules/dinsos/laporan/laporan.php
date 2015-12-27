<script type="text/javascript">	
	function laporan1(a)
	{
		var laporan = a;
		if(laporan==1)
		{	var t=document.getElementById("div_detail");
			if(t.innerHTML != '')
				t.innerHTML = '';
				
			else
				t.innerHTML='<iframe src="./modules/dinsos/laporan/potensial.php" width="100%" style="height:1000px" frameborder="0" scrolling="no" id="iframe_detail"></iframe>';
		}
		
		if
		if(laporan==2)
		{	var t=document.getElementById("div_detail");
			if(t.innerHTML != '')
				t.innerHTML = '';
				
			else
				t.innerHTML='<iframe src="./modules/dinsos/laporan/data_perusahaan.php" width="100%" style="height:1000px" frameborder="0" scrolling="no" id="iframe_detail"></iframe>';
		}
		
		if(laporan==3)
		{	var t=document.getElementById("div_detail");
			if(t.innerHTML != '')
				t.innerHTML = '';
				
			else
				t.innerHTML='<iframe src="./modules/dinsos/laporan/rekap.php" width="100%" style="height:1000px" frameborder="0" scrolling="no" id="iframe_detail"></iframe>';
		}
	}
	
	
</script>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
  <tr>
  <td colspan="2"><div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
       <table border="0" id='atasan'>
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00;" href="#"><b>LAPORAN-LAPORAN JAMSOSTEK</b></a></td>
            </tr>
                    <tr>
                  	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='index.php?mod=dinsos&do=main'> <span></span> BERANDA UTAMA </a>
                     <span> </span> <img src="./image/panah.gif" /> <span> </span> <a href=''>LAPORAN-LAPORAN</a>
                     </td>
                     
        </table>
    </div></td>
  </tr>
  </tr>
  <tr><td style="float:right;">
                		<img width="90" height="29" 
				onclick="document.location.href='./index.php?mod=dinsos&do=main'" 
				onmouseout="this.src='./image/button/KEMBALI.gif'" 
				onmouseover="this.src='./image/button/KEMBALI2.gif'" 
				src="./image/button/KEMBALI.gif"></img>
                </td></tr>
  <tr>
 <td>&nbsp;</td>
 </tr>
  <tr>
    <td colspan="2"><div id='content' style='margin-right:5%; margin-bottom:20px; width:99%;'>
            <br><fieldset>
					<legend>FILTER</legend>
			<form  method='POST' name='cari_p' style='min-width:350px; '>
				<table><tr><td>Nama Laporan </td><td><input class ='filter' type='text' name='cari' placeholder='Cari Nama Laporan'></td></tr>
				<tr><td></td><td><input type='button' value='CARI' onClick="cari_per();"></td></tr></table><br />
			</form>
		</fieldset>

					<br><br>
		<fieldset><legend >LIST LAPORAN</legend>
		<br />
		
			<ul>
			<table border=0 >
            	<tr><td><li style="color:#000000"><img src='./image/list.png'>&nbsp;<a href='javascript:laporan1(1);'>Data Potensial Perusahaan</a></li><br/>
                		<li style="color:#000000"><img src='./image/list.png'>&nbsp;<a href='javascript:laporan1(2);'>Data Perusahaan Jamsostek</a></li><br/>
            			<li style="color:#000000"><img src='./image/list.png'>&nbsp;<a href='javascript:laporan1(3);'>Rekapitulasi Data Perusahaan</a></li></td></tr>
				<tr>
					<td id='div_detail' style='background:white;'>
				</td>
				</tr>
            </table>
			</ul>
		</fieldset>
</div></td>
  </tr>
 <!-- <tr>
  		<td align="center" valign="middle" >
   					<nav id='menu'>
						<ul >
							<li><img src='./image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=jamsostek&do=main'>BERANDA</a></li>
							<li><img src='./image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=jamsostek&do=daftar'>PENDAFTARAN PERUSAHAAN</a></li>
							<li><img src='./image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=jamsostek&do=data_perusahaan'>DATA PERUSAHAAN</a></li>
							<li><img src='./image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=jamsostek&do=potensial'>DATA POTENSIAL</a></li>
							<li><img src='./image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=jamsostek&do=laporan'>LAPORAN</a></li>
							<li><img src='./image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=jamsostek&do=profil'>PROFIL USER</a></li>
							<li><img src='./image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=jamsostek&do=lg'>LOGOUT</a></li>
						</ul>
    	</nav>

    </td>
  </tr>-->
  <tr>
    <td colspan='2'><div id='footer'  style='background:url(./image/coba/footer.png) no-repeat; '></div>
</td>
  </tr>
</table>
	
