<script type="text/javascript">
	
	function validate(){
		var no_surat = $('#no_surat').val();
		if(no_surat == ""){
			alert('Maaf data surat masih kosong !!');
		}
		
		return false;
	}
</script>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
<tr >
    <td colspan="2"><div id='header' style='background:url(./image/coba/header2.png) no-repeat;'> 
      <table border="0" id='atasan'>
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00;" href="#"><b>INPUT SURAT MASUK</b></a></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;">
				  <img src="./image/panah.gif"  /><a href="./" id="linkutama"> BERANDA LOGIN LOKET</a> 
                   <img src="./image/panah.gif"  /><a href="" id="linkutama"> INPUT SURAT MASUK</a> 
                 </td>
                
            </tr>
        </table> 
    </div>
    </td>
</tr>
<tr>
 <td style="float:right;">
					<img width="90" height="29" 
						onclick="document.location.href='./index.php?mod=loket&opt=main'" 
						onmouseout="this.src='./image/button/KEMBALI.gif'" 
						onmouseover="this.src='./image/button/KEMBALI2.gif'" 
						src="./image/button/KEMBALI.gif">
					</img>
    			</td>
</tr>
<tr><td>&nbsp; </td></tr>
<tr>
	<td>
		<div id='content' style='margin-right:10px; margin-bottom:20px;width:98%;'>
				 <fieldset>	
	<legend><h3>INPUT SURAT MASUK</h3></legend>	
	   <form name="frm" action="./modules/loket/surat_masuk/php/input_surat.php" method="POST" id="frm_input_sm">
       
            <table border="0px" cellspacing='4' cellpadding='0' width='100%'>
                <tr>
                    <td width='20%'>Nomor Surat</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="no_surat" id="no_surat"/></td>
                </tr>
                <tr>
                    <td width='20%'>Tanggal Surat</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="tgl_surat" id="tgl_surat" /></td>
                </tr>
                <tr>
                    <td width='20%'>Tanggal Terima</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="tgl_terima" id="tgl_terima" /></td>
                </tr>
                <tr>
                    <td width='20%'>Perihal</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="perihal_surat" id="perihal"/></td>
                </tr>
                <tr>
                    <td width='20%'>Pengirim</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="pengirim_surat" id="pengirim_surat"/></td>
                </tr>
                <tr>
                    <td width='20%'>Alamat Pengirim</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="alamat_pengirim" id="alamat_pengirim"/></td>
                </tr>
                <tr>
                    <td width='20%'>Judul Surat</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="judul_surat" id="judul_surat"/></td>
                </tr>
                <tr>
                    <td width='20%'>Deskripsi Surat</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="deskripsi_surat" /></td>
                </tr>
                <tr>
                    <td width='20%'>Catatan Tambahan</td>
                    <td width='10px'>:</td>
                    <td><textarea name="catatan" rows='5' cols='40'>
					</textarea></td>
                </tr>
                <tr>
                    <td width='20%'>SKPD / Unit Pengirim</td>
                    <td width='10px'>:</td>
                    <td>
                        <select name="id_skpd_pengirim">
                            <option value="0">[.. Pilih SKPD Pengirim ..]</option>
                        <?php
						/*	
                            $res_skpd = mysql_query("SELECT * FROM myapp_reftable_unitkerja ORDER BY unit_kerja ASC");
                            while($ds_skpd = mysql_fetch_array($res_skpd)){
                                echo("<option value='" . $ds_skpd["id_unit_kerja"] . "'>" . $ds_skpd["unit_kerja"] . "</option>");
                            }
						*/	
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
						/*
                            $res_masalah= mysql_query("SELECT * FROM myapp_reftable_masalah ORDER BY kode_masalah ASC");
                            while($ds_masalah = mysql_fetch_array($res_masalah)){
                                echo("<option value='" . $ds_masalah["id_masalah"] . "'>(" . $ds_masalah["kode_masalah"] . ") " . $ds_masalah["masalah"] . "</option>");
                            }
						*/	
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
                    <td width='20%'>Harus Selesai Pada<br /><span style='color:red;'>*) Kosongkan jika tidak perlu ditindak lanjuti</span></td>
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
                    <td width='50%'><input type="submit" value='Simpan' style="width: 100%;"  onclick="validate();"/></td>
                    <td width='50%'><input type="reset" value='Reset' style="width: 100%;" /></td>
                </tr>
            </table>
       
	 </form>
   </fieldset>	
		
		</div>
</td>
	</tr>

 <tr>
  	<td colspan="2"><div id='footer'  style='background:url(./image/coba/footer_new.png) no-repeat; height:80px; margin-left:8px;'></div>
    </td>
  </tr>
</table>
  
  