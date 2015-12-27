<?php
	if (isset($_GET['eror']))
	{
?>
		<script type="text/javascript">
			document.location="login.php";
		</script>
<?php
	}
?>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
  <tr>
    <td><div id='headerdepan' style='background:url(./image/coba/header.png) no-repeat;'>
      <table border="0" style="float:right; margin-top:70px; font-size:23px; font-weight:bold;">
        	<tr>
		         <td style="text-align:right; padding-right:10px; height:20px;"> <a style='color:#AA9F00;' href='./'>LOGIN SISTEM</a></td>
            </tr>
        </table>
		</div></td>
  </tr>
  <tr>
    <td>
     <div id='content' style='
        margin-left:5%;
        width:90%;
        min-height:350px;'
        >
		
			<form action="php/nonlogin/login.php" method='POST'>
			<table width="90%" border='0px' style='margin-left: 48px; height:310px;'>
				
					<tr>
								<td rowspan='6' width='40%' style="background:url(./image/coba/samping.png) top no-repeat; height:200px;">
                                </td>
							<td width='15%' height="84">&nbsp;</td>
							<td>&nbsp;</td>
					</tr>
					
					<tr>
							  <td height="33"><label>Username</label></td>
							  <td><input name="username" type="text" maxlength="20" placeholder="Username" /></td>
					</tr>
					
					<tr>
							  <td height="28"><label>Password</label></td>
							  <td><input type="password" name="password" placeholder="Password" /></td>
					</tr>
			<?php
				if(isset($_GET['fail']) && $_GET['fail'] == 1){
					echo "<tr>
							<td>&nbsp;</td>
							<td><span style='color:red;font-family:verdana;font-size:14px;'>Maaf, Login gagal !!</span><br/></td>
						</tr>";
						
				}	
			?>	
					
							<tr>
							  <td height="80">&nbsp;</td>
							<td><a>
							    <input type="submit" value='LOGIN'style='width:130px;' />
							  </a></td>
						</tr>
			  
				<tr height="30%">
							<td height="33" ><!--<input type="button" value='EDIT PASSWORD' onclick="document.location.href='./index.php?mod=umum&do=edit'" />--></td>
							<td ><a></a></td>
			  </tr>		
				
				
			</table>
			</form>
            </div>
    </td>
  </tr>
   <tr>
    <td>
        
    <div id='menu' style='border:0px solid black; 
        margin-left:8px;'>
                <table border='0px' width='100%' height='20px'>
                    <tr>
                        <td align="center" valign="middle" >
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
                        </td>
                    </tr>
                </table>
        </div>
   </td>
   </tr>
  <tr>
    <td><div id='footer'>
</div></td>
  </tr>
</table>