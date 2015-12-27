<script type="text/javascript">
function jlhfile(){
    var jlh = $("#jlh_file").val();
    $("#panelupload").html("");
    var isi = "<br/>";
    for(var i=1; i<=jlh; i++){
        isi += "<tr>";
            isi += "<td align='center'>" + i + "</td>";
            isi += "<td colspan='3'>";
                isi += "<input type='file' name='file_" + i + "' /><br/><br/>";
            isi += "</td>";
        isi += "</tr>"
    }
    $("#panelupload").html(isi);
}
</script>


<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
          <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="">TAMBAH PESAN DAN SARAN</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>TAMBAH PESAN DAN SARAN</span></td>
                            <td><img  align="right" width="90" height="29" onclick="document.location.href='./?mod=pps&tipe_pps=<?=$_GET["tipe_pps"];?>'" 
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
		

<form name="frm" action="php/tambah_pps.php" method="post" enctype="multipart/form-data">
    <fieldset>
        <input type="hidden" name="tipe_pps" value="<?php echo($_GET["tipe_pps"]); ?>" />
        <legend><h3>TAMBAH DATA PENGADUAN / PESAN DAN SARAN</h3></legend>
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td>
                        <textarea name="pengaduan" cols='100' rows='10'></textarea>
                    </td>
                </tr>
            </table>
    </fieldset><br/>   
    <fieldset>
        <legend><h3>FILE PENDUKUNG PENGADUAN / PESAN DAN SARAN</h3></legend>
       
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='70px'>Jumlah File</td>
                    <td width='10px'>:</td>
                    <td width='100px'><input type="text" id="jlh_file" name="jlh_file" value="0" /></td>
                    <td>
                        <input type="button" value="OK" onclick="jlhfile();" style='width:80px;'/>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <b>isikan jumlah file dan klik tombol OK. Maka akan muncul input untuk file upload
                        sejumlah yang anda isikan</b>
                    </td>
                </tr>
                <tbody id="panelupload">
				</tbody>
            </table>
        
  </fieldset><br/>
   
            <table border="0px" cellspacing='0' cellpadding='0' width='40%'>
                <tr>
                    <td width='33%'><input type="submit" value='Simpan' style="width: 100%;" /></td>
                    <td width='33%'><input type="reset" value='Reset' style="width: 100%;" /></td>
                </tr>
            </table>
     
</form>
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
 

