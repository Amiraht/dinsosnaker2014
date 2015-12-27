<script type="text/javascript" src="./libraries/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="./libraries/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="./libraries/jquery.validate.js"></script>
<link rel="stylesheet" type="text/css" href="./libraries/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<style>
	input[type='text'], input[type='date'],select
	{
		width:200px;
		padding: 2px;
	}
</style>
<style type="text/css">
	label.error {
	color: red; padding-left: .5em;
	}
</style>
<script>
	$(document).ready(function(){
	$("#data").validate();
	});
</script>
<script type="text/javascript">
		$(document).ready(function(){
        $("#datepick").datepicker({
					dateFormat  : "yy-mm-dd",        
          changeMonth : true,
          changeYear  : true					
        });
		});
</script>
<script type="text/javascript">
		$(document).ready(function() {
			$("#various1").fancybox({
				'width'				: '90%',
				'height'			: '105%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'overlayShow'	: false,
				'type'				: 'iframe'
			});							
		});
</script>
<?php
#koneksi
include "./libraries/dinsos.php";
$conn = mysqli_connect("localhost", "root", "", "db_disnakersos");
#akhir-koneksi
 
#ambil data kecamatan
$query = "SELECT id_kecamatan, kecamatan FROM t_kecamatan  where id<'22' ORDER BY kecamatan";
$sql = mysqli_query($conn, $query);
$arrkecamatan = array();
while ($row = mysqli_fetch_assoc($sql)) {
	$arrkecamatan [ $row['id_kecamatan'] ] = $row['kecamatan'];
}

	$c = mysql_query("select * from t_jenis_usaha order by jenis asc");
	$d = mysql_query("select * from t_status order by status asc");
	$e = mysql_query("select * from t_status_milik order by status asc");
	$f = mysql_query("select * from t_status_modal order by modal asc");
	$g = mysql_query("select * from kbli order by nama_bagian asc");

	$id_per = $_GET[id];
	$sumber = $_GET[sumber];
	
	if($sumber=='BPPT')
		{
			$sumber = "bppt";
			$datafetch = mysql_query("SELECT
										a.nama, a.alamat, a.kecamatan, a.kelurahan,
										a.notelp, a.kodepos, a.no_akte, a.tgl_akte,
										a.bentuk_badan, a.`status`, a.klui,
										a.pemohon, a.tempat1, a.pengurus, a.tempat2,
										a.status_milik,a.status_modal,
										b.kecamatan, c.kelurahan, d.nama_bagian,
										e.`status`
									FROM
										$sumber a
									LEFT JOIN
										t_kecamatan b on a.kecamatan = b.id_kecamatan
									LEFT JOIN
										t_kelurahan c ON a.kelurahan = c.id_kelurahan
									LEFT JOIN
										kbli d ON a.klui = d.kode_bagian
									LEFT JOIN
										t_status e ON a.`status` = e.id_status											
									WHERE a.id=$id_per");
									
			$dataasli = mysql_fetch_array($datafetch);
		}
	if($sumber=='JAMSOSTEK')
		{
			$sumber = "db_jamsostek";
				$datafetch = mysql_query("SELECT
											a.nama, a.alamat, a.kec, a.kel,
											a.telpon, a.kode_pos, a.nomor_akte, a.tgl_pendirian,
											a.jenis_usaha, a.id_status_perusahaan, a.klui,
											a.nama_pemilik, a.alamat_pemilik, a.nama_pengurus, a.alamat_pengurus,
											a.id_status_pemilik, a.id_status_permodalan,
											b.kecamatan, c.kelurahan, d.nama_bagian, e.`status`
										FROM
											$sumber  a
										LEFT JOIN
											t_kecamatan b ON a.kec = b.id_kecamatan
										LEFT JOIN
											t_kelurahan c ON a.kel = c.id_kelurahan
										LEFT JOIN
											kbli d ON a.klui = d.kode_bagian
										LEFT JOIN
											t_status e ON a.id_status_perusahaan = e.id_status
										where a.id_perusahaan=$id_per");	
			$dataasli = mysql_fetch_array($datafetch);
		}	
		
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
          <table border="0" id='atasan'>
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00;" href="#">PENDAFTARAN, UPDATE DAN VERIFIKASI PERUSAHAAN</a></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='index.php?mod=dinsos&do=main'> <span></span> BERANDA UTAMA LOGIN PENDAFTARAN </a>
                     <span> </span> <img src="./image/panah.gif" /> <span> </span> PENDAFTARAN, UPDATE DAN VERIFIKASI PERUSAHAAN
                     </td>
                     	<td style="float:right;">
				<img width="90" height="29" 
                    onclick="document.location.href='./index.php?mod=dinsos&do=main'" 
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
    		 <div id='content' style='margin-left:8% margin-bottom:20px;width:100%;min-height:400px;'><br>
    		   <fieldset style='width:90%; margin-left:40px; padding-left:20px;min-height:50px;margin-bottom:20px;padding-right:20px;'>
					<legend>DAFTAR PERUSAHAAN BARU</legend>
           		 <p>&nbsp;</p>
         <form action='index.php?mod=dinsos&do=daftar&act=verify' method='post' name='data' id='data'>
   		 	<table width="100%" border="0" align="center" cellpadding="5" cellspacing="2" style='font-size:9px;'>
	  <tr>
                 		    <td colspan="7"><h2>DATA PERUSAHAAN</h2><hr>
                 		  </td>
               		    </tr>
                 		  <tr>
                 		    <td width="22%">NAMA PERUSAHAAN</td>
                 		    <td width="7%">:</td>
                 		    <td colspan="5">
                            	<input type='text' name="hidden" style='display:none;' value='<?php echo $id_per;?>'>
        						<input type='text' name='nama' class="required" value='<?php echo $dataasli[0];?>'/></td>
               		    </tr>
                 		  <tr>
                 		    <td>ALAMAT</td>
                 		    <td>:</td>
                 		    <td colspan="5"><input type='text' name='alamat' class="required" value='<?php echo $dataasli[1];?>'/></td>
               		    </tr>
                 		  <tr>
                 		    <td>KECAMATAN</td>
                 		    <td>:</td>
                            <td><select id="kecamatan" name="kecamatan" class="required" onChange="getKab()" selected=selected style="text-transform:uppercase;">
                            <option value='<?php echo $dataasli[2] ."'>".$dataasli[17];?></option>
                            <?php
                            foreach ($arrkecamatan as $id_kecamatan=>$kecamatan) {
                                echo "<option value='$id_kecamatan'>$kecamatan</option>";
                            }
                            ?>
		</select>
        </td>
                 		    <td>&nbsp;</td>
                 		    </tr>
                 		  <tr>
                 		    <td>KELURAHAN</td>
                 		    <td>:</td>
                 		    <td>
                            	<select id="kelurahan" name="kelurahan" class="required" selected=selected style='text-transform:uppercase;'>
							<option value='<?php echo $dataasli[3]; ?>' ><?php echo $dataasli[18]; ?></option>
                            	
                            </select>
                            </td>
                            </tr>
                 		  <tr>
                 		    <td>No. TELEPON</td>
                 		    <td>:</td>
                 		    <td><input type='text' name='telpon' value='<?php echo $dataasli[4]?>' /></td>
                 		    <td colspan="4">&nbsp;</td>
               		    </tr>
                 		  <tr>
                 		    <td>KODE POS</td>
                 		    <td>:</td>
                 		    <td><input type='text' name='kd_pos'  value='<?php echo $dataasli[5]?>' /></td>
                 		    <td colspan="4">&nbsp;</td>
               		    </tr>
                 		  <tr>
                 		    <td width="22%">NO AKTE PENDIRIAN</td>
                 		    <td width="7%">:</td>
                 		    <td width="24%"><input type='text' name='no_akte' value='<?php echo $dataasli[6]?>' /></td>
                 		    <td colspan="4">&nbsp;</td>
               		    </tr>
                 		  <tr>
                 		    <td>TANGGAL PENDIRIAN</td>
                 		    <td>:</td>
                 		    <td><input type='date' name='tgl_diri' id='datepick' value='<?php echo $dataasli[7]?>'/></td>
                 		    <td colspan="4">&nbsp;</td>
               		    </tr>
                 		  <tr>
                 		   <td>JENIS USAHA</td>
                 		    <td>:</td>
                 		    <td>
                 		      <select name="jns_usaha" selected=selected>
                              
                              		<?php
                            		while($c1 = mysql_fetch_array($c))
										{echo"<option value='$c1[0]'>$c1[1]</option>";};
									?>
               		          </select>
               		    </td>
                 		    <td colspan="4">&nbsp;</td>
               		    </tr>
                 		  <tr>
                 		    <td>STATUS PERUSAHAAN</td>
                 		    <td>:</td>
                 		    <td><select name="status_per" selected=selected> 
                            	<option value='0'><?php echo $dataasli[9]?></option>
                              		<?php
                            		while($d1 = mysql_fetch_array($d))
										{echo"<option value='$d1[0]'>$d1[1]</option>";};
									?>
               		          </select></td>
               		    </tr>
                 		  <tr>
                 		    <td>JENIS KLUI</td>
                 		    <td>:</td>
                 		    <td><select name='klui' selected=selected/>
                            		<option value='<?php echo $dataasli[10]; ?>'><?php echo $dataasli[19]?></option>
                              		<?php
                            		while($g1 = mysql_fetch_array($g))
										{echo"<option value='$g1[2]'>$g1[3]</option>";};
									?>
                            	</select>
                            </td>
                 		    <td colspan="4"><a href="./modules/kbli/?mode=1" id="various1">TAMBAH</a>&nbsp;</td>
               		    </tr>
                 		  <tr>
                 		    <td colspan="3">&nbsp;</td>
                 		    <td colspan="4">&nbsp;</td>
               		    </tr>
                 		  <tr>
                 		    <td colspan="7"><h2>DATA KEPEMILIKAN</h2><hr><br></td>
               		    </tr>
                 		  <tr>
                 		    <td>PEMILIK</td>
                 		    <td>:</td>
                 		    <td colspan="5"><input type='text' name='pemilik' value='<?php echo $dataasli[11]?>' /></td>
               		    </tr>
                 		  <tr>
                 		    <td>ALAMAT PEMILIK</td>
                 		    <td>:</td>
                 		    <td colspan="5"><input type='text' name='alamat_pemilik' value='<?php echo $dataasli[12]?>'/></td>
               		    </tr>
                 		  <tr>
                 		    <td>PENGURUS</td>
                 		    <td>:</td>
                 		    <td colspan="5"><input type='text' name='pengurus' value='<?php echo $dataasli[13]?>'/></td>
               		    </tr>
                 		  <tr>
                 		    <td>ALAMAT PENGURUS</td>
                 		    <td>:</td>
                 		    <td colspan="5"><input type='text' name='alamat_pengurus' value='<?php echo $dataasli[14]?>''/></td>
               		    </tr>
                 		  <tr>
                 		    <td width="22%">STATUS PEMILIK</td>
                 		    <td width="7%">:</td>
                 		    <td colspan="5"><select name="status_pemilik" selected=selected>
                 		      <option value='0'><?php echo $dataasli[15]?>
                 		        <?php
                            		while($e1 = mysql_fetch_array($e))
										{echo"<option value='$e1[0]'>$e1[1]</option>";};
									?>
               		          </option>
               		      </select></td>
               		    </tr>
                 		  <tr>
                 		    <td>STATUS PERMODALAN</td>
                 		    <td>:</td>
                 		    <td colspan="5"><select name="status_modal" selected=selected>
                 		      <option value='0'><?php echo $dataasli[16]?></option>
                 		      <?php
                            		while($f1 = mysql_fetch_array($f))
										{echo"<option value='$f1[0]'>$f1[1]</option>";};
									?>
               		      </select></td>
               		    </tr>
                 		  <tr>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td width="22%">&nbsp;</td>
                 		    <td width="2%">&nbsp;</td>
                 		    <td width="20%">&nbsp;</td>
               		    </tr>
						  <tr>
                 		    <td colspan="7"><br><h2>DATA TENAGA KERJA</h2><hr><br></td>
               		    </tr>
                 		  <tr>
                 		    <td>T.K WNI PRIA</td>
                 		    <td>:</td>
                 		    <td><input type='text' name='wnip' value='--'/></td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
               		    </tr>
                 		  <tr>
                 		    <td>T.K WNI WANITA</td>
                 		    <td>:</td>
                 		    <td><input type='text' name='wniw' value='--'/></td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
               		    </tr>
                 		  <tr>
                 		    <td>T.K WNA PRIA</td>
                 		    <td>:</td>
                 		    <td><input type='text' name='wnap' value='--' /></td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
               		    </tr>
                 		  <tr>
                 		    <td>T.K WNA WANITA</td>
                 		    <td>:</td>
                 		    <td><input type='text' name='wnaw'  value='--'/></td>
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
							<li><img src='./image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=dinsos&do=main'>BERANDA</a></li>
							<li><img src='./image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=dinsos&do=daftar'>PENDAFTARAN PERUSAHAAN</a></li>
							<li><img src='./image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=dinsos&do=data_perusahaan'>DATA PERUSAHAAN</a></li>
							<li><img src='./image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=dinsos&do=potensial'>DATA POTENSIAL</a></li>
							<li><img src='./image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=dinsos&do=laporan'>LAPORAN</a></li>
							<li><img src='./image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=dinsos&do=profil'>PROFIL USER</a></li>
							<li><img src='./image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=dinsos&do=lg'>LOGOUT</a></li>
						</ul>
    	</nav>

    </td>
  </tr>
  <tr>
      <td colspan="2"><div id='footer'  style='background:url(./image/coba/footer.png) no-repeat; '>
</div></td>
  </tr>
</table>