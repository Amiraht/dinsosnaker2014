<?php
#koneksi
include "./libraries/dinsos.php";
$conn = mysqli_connect("localhost", "root", "", "db_disnakersos");
#akhir-koneksi
 
#ambil data kecamatan
$query = "SELECT id_kecamatan, kecamatan FROM t_kecamatan ORDER BY kecamatan";
$sql = mysqli_query($conn, $query);
$arrkecamatan = array();
while ($row = mysqli_fetch_assoc($sql)) {
	$arrkecamatan [ $row['id_kecamatan'] ] = $row['kecamatan'];
}

	$id_per = $_GET[id];
	$sumber = $_GET[sumber];
	
	if($sumber=='BPPT')
		{
			$sumber = "db_bppt";
			$datafetch = mysql_query("SELECT
									a.nama, a.alamat, b.kecamatan,
									c.kelurahan, a.notelp, a.kodepos,
									a.nosah, a.tglberdiri, a.jenis,
									a.status, a.kegiatan, a.pemohon,
									a.tempatT, '--' AS pengurus, '--' AS alamatP,
									'--' AS statusmilik, '--' AS statusmodal,
									'--' AS wnip, '--' AS wniw,
									'--' AS wnap, '--' AS wnaw,
									a.kelurahan
									FROM
												$sumber a
														
									LEFT JOIN
												t_kecamatan b ON a.kecamatan = b.id_kecamatan
									LEFT JOIN
												t_kelurahan c ON a.kelurahan = c.id_kelurahan
												
									WHERE a.id=$id_per
									");
		}
	if($sumber=='DINSOSNAKER')
		{
			$sumber = "db_dinsos";
			$datafetch = mysql_query("select * from $sumber where id_perusahaan=$id_per");	
		}
		
	echo $id_per;
	echo $sumber;
	
	$c = mysql_query("select * from t_jenis_usaha order by jenis asc");
	$d = mysql_query("select * from t_status order by status asc");
	$e = mysql_query("select * from t_status_milik order by status asc");
	$f = mysql_query("select * from t_status_modal order by modal asc");
	
	$dataasli = mysql_fetch_array($datafetch);
	
?>
	<script type='text/javascript'>
		$(document).ready(function(){
			 $('#kecamatan').change(function(){
					$.getJSON('fetching2.php',{action:'getKab',kode_prop:$(this).val()},function(json){
						$('#kelurahan').html('');
						$.each(json, function(index,row){
						$('#kelurahan').append('<option value='+row.id_kelurahan+'>'+row.kelurahan+'</option>');
							});
						});
					});
				});
	</script>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
  <tr>
    <td height="124" colspan="2"><div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
          <table border="0" id='atasan'">
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00; href="#">PENDAFTARAN PERUSAHAAN</a></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='index.php?mod=jamsostek&do=main'> <span></span> BERANDA UTAMA </a>
                     <span> </span> <img src="./image/panah.gif" /> <span> </span> PENDAFTARAN PERUSAHAAN
                     </td>
                     	<td style="float:right;">
				<img width="90" height="29" 
                    onclick="document.location.href='./index.php?mod=home&opt=main'" 
                    onmouseout="this.src='./image/button/KEMBALI.gif'" 
                    onmouseover="this.src='./image/button/KEMBALI2.gif'" 
                    src="./image/button/KEMBALI.gif">
                </img>
    			</td>
            </tr>
        </table>
	</div>
	</td>
  </tr>
  <tr>
    <td align="left" valign="middle">
    		<br>
    		 <div id='content' style='margin-left:8% margin-bottom:20px;width:95%;min-height:400px;'><br>
    		   <fieldset style='width:90%; margin-left:40px; padding-left:20px;min-height:50px;margin-bottom:20px;padding-right:20px;'>
					<legend>DAFTAR PERUSAHAAN BARU</legend>
           		 <p>&nbsp;</p>
         <form action='index.php?mod=jamsostek&do=daftar&act=verify' method='post' name='data'>
   		 	<table width="100%" border="0" align="center" cellpadding="5" cellspacing="2" style='font-size:9px;'>
	  <tr>
                 		    <td colspan="7"><h2>DATA PERUSAHAAN</h2><hr>
                 		  </td>
               		    </tr>
                 		  <tr>
                 		    <td width="20%">NAMA PERUSAHAAN</td>
                 		    <td width="7%">:</td>
                 		    <td width="24%">
                            	<input type='text' name="hidden" style='display:none;' value='<?php echo $id_per;?>'>
        						<input type='text' name='nama' value='<?php echo $dataasli[0];?>'/></td>
                 		    <td width="5%">&nbsp;</td>
                 		    <td width="22%">NO AKTE PENDIRIAN</td>
                 		    <td width="2%">:</td>
                 		    <td width="20%"><input type='text' name='no_akte' value='<?php echo $dataasli[6]?>'></td>
						</tr>
                 		  <tr>
                 		    <td>ALAMAT</td>
                 		    <td>:</td>
                 		    <td><input type='text' name='alamat' value='<?php echo $dataasli[1];?>'/></td>
                 		    <td>&nbsp;</td>
                 		    <td>TANGGAL PENDIRIAN</td>
                 		    <td>:</td>
                 		    <td>
                                <input type='date' name='tgl_diri' value='<?php echo $dataasli[7]?>'/></td>
               		    </tr>
                 		  <tr>
                 		    <td>KECAMATAN</td>
                 		    <td>:</td>
                            <td><select id="kecamatan" name="kecamatan" onChange="getKab()" selected=selected>
                            <option value='0'><?php echo $dataasli[2];?></option>
                            <?php
                            foreach ($arrkecamatan as $id_kecamatan=>$kecamatan) {
                                echo "<option value='$id_kecamatan'>$kecamatan</option>";
                            }
                            ?>
		</select>
        </td>
                 		    <td>&nbsp;</td>
                 		    <td>JENIS USAHA</td>
                 		    <td>:</td>
                 		    <td>
                 		      <select name="jns_usaha">
                              	<option value='0'><?php echo $dataasli[8]?></option>
                              		<?php
                            		while($c1 = mysql_fetch_array($c))
										{echo"<option value='$c1[0]'>$c1[1]</option>";};
									?>
               		          </select>
               		    </td>
               		    </tr>
                 		  <tr>
                 		    <td>KELURAHAN</td>
                 		    <td>:</td>
                 		    <td><select id="kelurahan" name="kelurahan" selected=selected>
                            	
                            </select>
                            </td>
                 		    <td>&nbsp;</td>
                 		    <td>STATUS USAHA</td>
                 		    <td>:</td>
                 		    <td><select name="status_per">
                            	<option value='0'><?php echo $dataasli[9]?></option>
                              		<?php
                            		while($d1 = mysql_fetch_array($d))
										{echo"<option value='$d1[0]'>$d1[1]</option>";};
									?>
               		          </select></td>
               		    </tr>
                 		  <tr>
                 		    <td>No. TELEPON</td>
                 		    <td>:</td>
                 		    <td><input type='text' name='telpon' value='<?php echo $dataasli[4]?>' /></td>
                 		    <td>&nbsp;</td>
                 		    <td>KLUI</td>
                 		    <td>:</td>
                 		    <td><input type='text' name='klui' value='<?php echo $dataasli[10]?>'/></td>
               		    </tr>
                 		  <tr>
                 		    <td>KODE POS</td>
                 		    <td>:</td>
                 		    <td><input type='text' name='kd_pos'  value='<?php echo $dataasli[5]?>' /></td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
               		    </tr>
                 		  <tr>
                 		    <td colspan="3">&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
               		    </tr>
                 		  <tr>
                 		    <td colspan="7"><h2>DATA KEPEMILIKAN</h2><hr><br></td>
               		    </tr>
                 		  <tr>
                 		    <td>PEMILIK</td>
                 		    <td>:</td>
                 		    <td><input type='text' name='pemilik' value='<?php echo $dataasli[11]?>' /></td>
                 		    <td>&nbsp;</td>
                 		    <td>STATUS PEMILIK</td>
                 		    <td>:</td>
                 		    <td><select name="status_pemilik">
                            <option value='0'><?php echo $dataasli[15]?>
                 		      <?php
                            		while($e1 = mysql_fetch_array($e))
										{echo"<option value='$e1[0]'>$e1[1]</option>";};
									?>
               		      </select></td>
               		    </tr>
                 		  <tr>
                 		    <td>ALAMAT PEMILIK</td>
                 		    <td>:</td>
                 		    <td><input type='text' name='alamat_pemilik' value='<?php echo $dataasli[12]?>'/></td>
                 		    <td>&nbsp;</td>
                 		    <td>STATUS PERMODALAN</td>
                 		    <td>:</td>
                 		    <td><select name="status_modal">
                 		      <option value='0'><?php echo $dataasli[16]?> </option>
							  <?php
                            		while($f1 = mysql_fetch_array($f))
										{echo"<option value='$f1[0]'>$f1[1]</option>";};
									?>
               		      </select></td>
               		    </tr>
                 		  <tr>
                 		    <td>PENGURUS</td>
                 		    <td>:</td>
                 		    <td><input type='text' name='pengurus' value='<?php echo $dataasli[13]?>'/></td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
               		    </tr>
                 		  <tr>
                 		    <td>ALAMAT PENGURUS</td>
                 		    <td>:</td>
                 		    <td><input type='text' name='alamat_pengurus' value='<?php echo $dataasli[14]?>''/></td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
               		    </tr>
                 		  <tr>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
               		    </tr>
                 		  <tr>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
               		    </tr>
						  <tr>
                 		    <td colspan="7"><br><h2>DATA TENAGA KERJA</h2><hr><br></td>
               		    </tr>
                 		  <tr>
                 		    <td>T.K WNI PRIA</td>
                 		    <td>:</td>
                 		    <td><input type='text' name='wnip' value='<?php echo $dataasli[17]?>'/></td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
               		    </tr>
                 		  <tr>
                 		    <td>T.K WNI WANITA</td>
                 		    <td>:</td>
                 		    <td><input type='text' name='wniw' value='<?php echo $dataasli[18]?>'/></td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
               		    </tr>
                 		  <tr>
                 		    <td>T.K WNA PRIA</td>
                 		    <td>:</td>
                 		    <td><input type='text' name='wnap' value='<?php echo $dataasli[19]?>' /></td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
               		    </tr>
                 		  <tr>
                 		    <td>T.K WNA WANITA</td>
                 		    <td>:</td>
                 		    <td><input type='text' name='wnaw'  value='<?php echo $dataasli[20]?>'/></td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
               		    </tr>
                 		  <tr>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>	<input type='submit' value='DAFTAR PERUSAHAAN' style='margin-right:5px;'></td>
               		    </tr>
           		  </table>
                 		<br>
                 			</form>
               </fieldset>
             </div>
    &nbsp;</td>
  </tr>
  <tr>
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
  </tr>
  <tr>
      <td colspan="2"><div id='footer'  style='background:url(./image/coba/footer.png) no-repeat; '>
</div></td>
  </tr>
</table>