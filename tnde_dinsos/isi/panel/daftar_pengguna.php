<script type="text/javascript">
$(document).ready(function(){
    $("#frm").submit(function(){
        var pass1 = $("#password").val();
        var pass2 = $("#password2").val();
        
        if($("#id_level").val() == 0){
            jAlert("Maaf, Level pengguna harus dipilih", "PERHATIAN");
            return false;
        }else if($("#username").val() == ""){
            jAlert("Maaf, username harus diisi", "PERHATIAN");
            return false;
        }else if(pass1 == ""){
            jAlert("Maaf, Password harus diisi", "PERHATIAN");
            return false;
        }else if(pass1 != pass2){
            jAlert("Maaf, password pertama dengan konfirmasi password harus sama", "PERHATIAN");
            return false;
        }else{
            return true;
        }
    });
});
</script>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
          <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="./?mod=daftar_pengguna">DAFTAR PENGGUNA</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='<?=$url_main;?>'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>DAFTAR PENGGUNA</span></td>
                            <td><img  align="right" width="90" height="29" onclick="document.location.href='./<?=$url_main;?>'" 
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
        <legend><h3>INPUT DATA PENGGUNA BARU</h3></legend>
        <form name="frm_add_pengguna" id="frm_add_pengguna" action="php/daftar_pengguna.php" method="post" enctype="multipart/form-data">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <?php
                    if(isset($_GET["err_code"])){
                ?>
                    <tr>
                        <td colspan="3"><span class="err_msg"><?php echo($_GET["err_code"]) ?></span></td>
                    </tr>
                <?php
                    }
                ?>
                <tr>
                    <td width='20%'>Level Pengguna</td>
                    <td width='10px'>:</td>
                    <td>
                        <select name="id_level" id="id_level">
                            <option value="0">[.. Pilih Level Pengguna ..]</option>
                        <?php
                            $res_skpd = mysql_query("SELECT * FROM myapp_reftable_levelpengguna WHERE id <> 24 ORDER BY level ASC");
                            while($ds_skpd = mysql_fetch_array($res_skpd)){
                                echo("<option value='" . $ds_skpd["id"] . "' style='text-transform:capitalize;'>" . $ds_skpd["level"] . "</option>");
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width='20%'>Username</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="username" id="username" /></td>
                </tr>
                <tr>
                    <td width='20%'>Password</td>
                    <td width='10px'>:</td>
                    <td><input type="password" name="password" id="password" /></td>
                </tr>
                <tr>
                    <td width='20%'>Konfirmasi Password</td>
                    <td width='10px'>:</td>
                    <td><input type="password" name="password2" id="password2" /></td>
                </tr>
                <tr>
                    <td width='20%'>Nama</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="nama" /></td>
                </tr>
                <tr>
                    <td width='20%'>Scan Tanda Tangan / Paraf</td>
                    <td width='10px'>:</td>
                    <td><input type="file" name="ttd" /></td>
                </tr>
                <tr>
                    <td width='20%'>NIP</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="nip" id="nip" /></td>
                </tr>
                <tr>
                    <td width='20%'>Nomor Kontak</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="kontak" id="kontak" /></td>
                </tr>
                <tr>
                    <td width='20%'>Email</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="email" id="email" /></td>
                </tr>
            </table><br/>
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='30%'><input type="submit" value='Simpan' style="width: 30%;" />&nbsp;</td>
                    <td width='30%'><input type="reset" value='Reset' style="width: 30%;" />&nbsp;</td>
                    <td width='30%'><input type="button" value='Kembali' style="width: 100%;" onclick="document.location.href='?mod=cp_pengguna';" /></td>
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
 
