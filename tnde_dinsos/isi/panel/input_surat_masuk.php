<script type="text/javascript" src="./libraries/jquery.validate.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#frm_input_sm").validate(); // call the jquery validate to validate input user
	
    $("#tgl_surat").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
	
    $("#tgl_terima").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
    $("#harus_selesai").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
});

function loadsubmasalah(id_masalah){
    //alert(id_masalah);
    $("#id_jenis_surat").html("<option value='0'>[.. Pilih Sub Masalah ..]</option>");
    $.ajax({
        type: "GET",
        url: "ajax/submasalah.php",
        data: "id_masalah=" + id_masalah,
        success: function(r){
            //alert(r);
            $("#id_jenis_surat").append(r);
        }
    });
}
</script>
<style type="text/css">
	label.error {
	   color: red; font-size:12px; font-family:verdana;
	}
</style>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
        <td >
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'">
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00; href="./?mod=input_surat_masuk">INPUT SURAT MASUK</a></h1>
                                </td>
                        </tr>
                        <tr>
						<?php
							
						?>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='<?=$url_main;?>'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span> </span>INPUT DATA SURAT MASUK
                            <td><img  align="right" width="90" height="29" onclick="document.location.href='<?=$url_main;?>'" 
                                onmouseout="this.src='./image/button/KEMBALI.gif'" onmouseover="this.src ='./image/button/KEMBALI2.gif'" src="./image/button/KEMBALI.gif"></img>
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
	   <legend><h3>INPUT DATA SURAT MASUK</h3></legend>
       <form name="frm" action="php/input_surat_masuk.php" method="POST" id="frm_input_sm">  
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='20%'>Nomor Surat</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="no_surat" class="required"/></td>
                </tr>
                <tr>
                    <td width='20%'>Tanggal Surat</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="tgl_surat" id="tgl_surat" class="required"/></td>
                </tr>
                <tr>
                    <td width='20%'>Tanggal Terima</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="tgl_terima" id="tgl_terima" class="required"/></td>
                </tr>
                <tr>
                    <td width='20%'>Perihal</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="perihal_surat" class="required"/></td>
                </tr>
                <tr>
                    <td width='20%'>Pengirim</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="pengirim_surat" class="required"/></td>
                </tr>
                <tr>
                    <td width='20%'>Alamat Pengirim</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="alamat_pengirim" class="required"/></td>
                </tr>
                <tr>
                    <td width='20%'>Judul Surat</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="judul_surat" class="required"/></td>
                </tr>
                <tr>
                    <td width='20%'>Deskripsi Surat</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="deskripsi_surat" class="required"/></td>
                </tr>
                <tr>
                    <td width='20%'>Catatan Tambahan</td>
                    <td width='10px'>:</td>
                    <td><textarea name="catatan"></textarea></td>
                </tr>
                <tr>
                    <td width='20%'>SKPD / Unit Pengirim</td>
                    <td width='10px'>:</td>
                    <td>
                        <select name="id_skpd_pengirim">
                            <option value="0">[.. Pilih SKPD Pengirim ..]</option>
                        <?php
                            $res_skpd = mysql_query("SELECT * FROM myapp_reftable_unitkerja ORDER BY unit_kerja ASC");
                            while($ds_skpd = mysql_fetch_array($res_skpd)){
                                echo("<option value='" . $ds_skpd["id_unit_kerja"] . "'>" . $ds_skpd["unit_kerja"] . "</option>");
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width='20%'>Masalah</td>
                    <td width='10px'>:</td>
                    <td>
                        <select name="id_masalah" onchange="loadsubmasalah(this.value);">
                            <option value="0">[.. Pilih Masalah ..]</option>
                        <?php
                            $res_masalah= mysql_query("SELECT * FROM myapp_reftable_masalah ORDER BY kode_masalah ASC");
                            while($ds_masalah = mysql_fetch_array($res_masalah)){
                                echo("<option value='" . $ds_masalah["id_masalah"] . "'>(" . $ds_masalah["kode_masalah"] . ") " . $ds_masalah["masalah"] . "</option>");
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width='20%'>Sub Masalah</td>
                    <td width='10px'>:</td>
                    <td>
                        <select name="id_jenis_surat" id="id_jenis_surat">
                            <option value="0">[.. Pilih Sub Masalah ..]</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width='20%'>Harus Selesai Pada<br /><span class="footnote">*) Kosongkan jika tidak perlu ditindak lanjuti</span></td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="harus_selesai" id="harus_selesai" /></td>
                </tr>
                <tr>
                    <td width='20%'>Indeks</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="indeks" /></td>
                </tr>
                <tr>
                    <td width='20%'>Kode</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="kode" /></td>
                </tr>
            </table>
            <br />
            
            <table border="0px" cellspacing='0' cellpadding='0' width='40%'>
                <tr>
                    <td width='50%'><input type="submit" value='Simpan' style="width: 100%;" /></td>
                    <td width='50%'><input type="reset" value='Reset' style="width: 100%;" /></td>
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
    <td>
    <div id='footer' style='background:url(./image/coba/footer.png) no-repeat;height:100px;'>
        </div>
     </td>
 </tr>
 </table>
