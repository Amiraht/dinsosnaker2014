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
		         <td style="text-align:right; padding-right:10px; height:20px;"> <a style='color:#AA9F00;' href='./'>LOGIN PENGGUNA</a></td>
            </tr>
        </table>
		</div></td>
  </tr>
  <tr>
    <td>
     <div id='content' style='margin-left:5%; width:90%;min-height:350px;'>
		
			<form name="frmlogin" action="php/login.php" method="post">
				<table width="90%" border='0px' style='margin-left: 48px; height:310px;'>
					<tr>
								<td rowspan='6' width='40%' style="background:url(./image/coba/samping.png) top no-repeat; height:200px;">
                                </td>
								<td width='15%' height="84">&nbsp;</td>
								<td>&nbsp;</td>
					</tr>
                <?php
                    if(isset($_GET["err_code"])){
                ?>
                    <tr>
                        <td colspan="3"><span style='err-msg'><?php echo($_GET["err_code"]) ?></span></td>
                    </tr>
                <?php
                    }else if(isset($_GET["galog"]) && $_GET["galog"] == 1){
				?>
					<tr>
                        <td colspan="3"><span class="err-msg">* Maaf, username dan password tidak ditemukan..</span></td>
                    </tr>
					
				<?php		
					}
                ?>
					<tr>
						<td width='20%'>Username</td>
						<td width='10px'>:</td>
						<td><input type="text" name="username" /></td>
					</tr>
					<tr>
						<td>Password</td>
						<td>:</td>
						<td><input type="password" name="password" /></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td><a><input type="submit" value='LOGIN' style='width:130px;' class="btn btn-lg btn-success"/></a></td>
					</tr>
				</table>
			</form>	
		
     </div>
    </td>
  </tr>
   <tr>
    <td>
        
    <div id='menu' style='border:0px solid black; margin-left:8px;'>
                <table border='0px' width='100%' height='20px'>
                    <tr>
                        <td align="center" valign="middle" >
                        <nav>
                                <ul>
                                    <li><img src='./image/list.png'>&nbsp;&nbsp;<a href='./'>BERANDA UTAMA</a></li>
                                    <li><img src='./image/list.png'>&nbsp;&nbsp;<a href='./?mod=latar_belakang'>LATAR BELAKANG</a></li>
                                    <li><img src='./image/list.png'>&nbsp;&nbsp;<a href='./?mod=berita_dan_informasi'>BERITA DAN INFORMASI</a></li>
									<li><img src='./image/list.png'>&nbsp;&nbsp;<a href='./?mod=fdownload'>FILE DOWNLOAD</a></li>
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


