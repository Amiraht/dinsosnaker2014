<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
        <td >
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00"; href="./"></a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='<?=$url_main;?>'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" />KONFIRMASI SISTEM<span></span>
               
                        </tr>
                    </table>            
                    </div>
            <br>
        </td>
  </tr>
  <tr>
  	<td>
    <div id='content' style='padding-top:10px;'>	<br>
		<center>
<fieldset style="width: 600px; margin: 50px 0px;">
    <legend><h3 style="text-align:left;">KONFIRMASI SISTEM</h3></legend>
	<span style='font-weight:bold;font-size:14px;font-family:verdana;'>
    <?php
		$pesan = anti_injection($_GET["pesan"]);
        $ds_info = mysql_fetch_array(mysql_query("SELECT * FROM myapp_consttable_info WHERE id = '" . $pesan . "'"));
        echo($ds_info["info"]);
        $id_tambahan = "";
        if(isset($_GET["id"]))
			$id = anti_injection($_GET["id"]);
            $id_tambahan .= "&id=" . $id;
        if(isset($_GET["id_disposisi"]))
			$id_dis = anti_injection($_GET["id_disposisi"]);	
            $id_tambahan .= "&id_disposisi=" . $id_dis;
    ?>
	</span>
        <div style='margin-top:25px;'>
        <?php
			if(isset($_GET["redir"])){
				if($_GET["redir"] == "logout"){
        ?>
					<input type="button" style='width:120px;height:35px;' value="OK" onclick="document.location.href='php/nonlogin/logout.php';" />
        <?php
				}else{
        ?>
					<input type="button" style='width:120px;height:35px;' value="OK" onclick="document.location.href='?mod=<?php echo($_GET["redir"] . $id_tambahan) ?>';" />
        <?php   
				}
			}	
        ?>
        </div>
    
</fieldset>  
</center>
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
    <td>
    <div id='footer' style='font-weight:bold;font-size:13px;font-family:verdana;'>
		
    </div>
    </td>
 </tr>
 </table>
