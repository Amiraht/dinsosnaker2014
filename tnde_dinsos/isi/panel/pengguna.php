<script type="text/javascript">
$(document).ready(function(){
    $("#frm_a").submit(function(){
        if($("#username").val() == ""){
            jAlert("Maaf, username harus diisi", "PERHATIAN");
            return false;
        }else{
            return true;
        }
    });
    
    $("#frm_b").submit(function(){
        if($("#password").val() != $("#password2").val()){
            jAlert("Maaf, Password dan konfirmasi password harus sama", "PERHATIAN");
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
                                <h1><a style="color:#AA9F00;" href="./?mod=pengguna">PROFIL PENGGUNA</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='<?=$url_main;?>'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>PROFIL PENGGUNA</span></td>
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
	<?php
		$sql = "SELECT * FROM myapp_maintable_pengguna WHERE id = '".$_SESSION['id_pengguna']."'";
		$qry = mysql_query($sql) or die(mysql_error());
		$ds_pengguna = mysql_fetch_array($qry);
	?>
   <fieldset>
        <legend><h3>EDIT DATA PENGGUNA</h3></legend>
          <form name="frm_a" id="frm_a" action="php/edit_pengguna.php" method="POST" enctype="multipart/form-data">
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
                    <td width='20%'>Username</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="username" id="username" value="<?php echo($ds_pengguna["username"]); ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Nama</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="nama" id="nama" value="<?php echo($ds_pengguna["nama"]); ?>" style="display: none;" /><?php echo("<b>" . $ds_pengguna["nama"] . "</b>"); ?></td>
                </tr>
                <tr>
                    <td width='20%'>
                        Scan Tanda Tangan / Paraf<br /><span class="footnote">*) Kosongkan jika tidak ingin berubah</span><br />
                        <a href="ttd/<?php echo($ds_pengguna["ttd"]); ?>" target="_blank">Lihat Scan Tanda Tangan Saat Ini</a>
                    </td>
                    <td width='10px'>:</td>
                    <td><input type="file" name="ttd" /></td>
                </tr>
                <tr>
                    <td width='20%'>NIP</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="nip" id="nip" value="<?php echo($ds_pengguna["nip"]); ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Nomor Kontak</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="kontak" id="kontak" value="<?php echo($ds_pengguna["kontak"]); ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Email</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="email" id="email" value="<?php echo($ds_pengguna["email"]); ?>" /></td>
                </tr><br/><br/>
            <table border="0px" cellspacing='0' cellpadding='0' width='30%'>
                <tr>
                    <td width='30%'><input type="submit" value='Simpan' style="width: 100%;" /></td>
                    <td width='30%'><input type="reset" value='Reset' style="width: 100%;" /></td>
                </tr>
            </table>
       </form>
	</fieldset><br/><br/><br/>   


   <fieldset>
        <legend><h3>UBAH PASSWORD</h3></legend>
        <form name="frm_b" id="frm_b" action="php/ganti_password.php" method="post" enctype="multipart/form-data">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <?php
                    if(isset($_GET["err_code_pwd"])){
                ?>
                    <tr>
                        <td colspan="3"><span class="err_msg"><?php echo($_GET["err_code_pwd"]) ?></span></td>
                    </tr>
                <?php
                    }
                ?>
                <tr>
                    <td width='20%'>Password Lama</td>
                    <td width='10px'>:</td>
                    <td><input type="password" name="password_lama" id="password_lama" /></td>
                </tr>
                <tr>
                    <td width='20%'>Password Baru</td>
                    <td width='10px'>:</td>
                    <td><input type="password" name="password" id="password" /></td>
                </tr>
                <tr>
                    <td width='20%'>Konfirmasi Password Baru</td>
                    <td width='10px'>:</td>
                    <td><input type="password" name="password2" id="password2" /></td>
                </tr><br/>
            <table border="0px" cellspacing='0' cellpadding='0' width='30%'>
                <tr>
                    <td width='30%'><input type="submit" value='Simpan' style="width: 100%;" /></td>
                    <td width='30%'><input type="reset" value='Reset' style="width: 100%;" /></td>
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
 
