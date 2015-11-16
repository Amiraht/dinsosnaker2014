<script type="text/javascript">
	function balik(id_per)
	{
		document.location.href='index.php?mod=loket&opt=proses_permohonan&opts=baru';
	}
</script>

<?php
	/*data perusahaan*/
	$aa = $_POST['hidden'];
	$a = $_POST['nama'];$b = $_POST['alamat'];
	$c = $_POST['kecamatan'];$d = $_POST['kelurahan'];$e = $_POST['telpon'];
	$f = $_POST['kd_pos'];$g = $_POST['no_akte'];$h=$_POST['tgl_diri'];
	$i=$_POST['jns_usaha'];$j=$_POST['status_per']; 
	$u = $_POST['klui'];
	
	/*data pemilik*/
	$k = $_POST['pemilik'];$l = $_POST['alamat_pemilik'];
	$m = $_POST['pengurus'];$n = $_POST['alamat_pengurus'];
	$o = $_POST['status_pemilik'];$p = $_POST['status_modal'];
	
	
	/*data tenaga kerja*/
	$q = $_POST['wnip'];$r = $_POST['wniw'];
	$s = $_POST['wnap'];$t = $_POST['wnaw'];
	
		$str_per= 
			"$a/$b/$c/$d/$e/$f/$g/$h/$i/$j/$u/$k/$l/$m/$n/$o/$p";
			
		$str_tng=
			"$q/$r/$s/$t";
	
	if(!isset($c))
		$c = 0;
	if(!isset($d))
		$d = 0;
	if(!isset($i))
		$i = 0;
	if(!isset($j))
		$j = 0;
	if(!isset($o))
		$o = 0;
	if(!isset($p))
		$p = 0;
	if(!isset($u) || $u == "")
		$u = 0;
	
	$kecamatan=mysql_query("select kecamatan from t_kecamatan where id_kecamatan=$c");
	$kelurahan=mysql_query("select kelurahan from t_kelurahan where id_kelurahan=$d");
	$jenis=mysql_query("select jenis from t_jenis_usaha where id_jenis_usaha=$i");
	$perusahaan=mysql_query("select status from t_status where id_status=$j");
	$milik=mysql_query("select status from t_status_milik where id_status=$o");
	$modal=mysql_query("select modal from t_status_modal where id_status=$p");
	$klui=mysql_query("select nama_bagian from kbli where kode_bagian=$u");
	
	$data1 = mysql_fetch_array($kecamatan);
	$data2 = mysql_fetch_array($kelurahan);
	$data3 = mysql_fetch_array($jenis);
	$data4 = mysql_fetch_array($perusahaan);
	$data5 = mysql_fetch_array($milik);
	$data6 = mysql_fetch_array($modal);
	$data7 = mysql_fetch_array($klui);
		
?>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
  <tr>
    <td height="124" colspan="2">
		<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
          <table border="0" id='atasan'">
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00; href="#">PENDAFTARAN, UPDATE DAN VERIFIKASI PERUSAHAAN</a></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='index.php?mod=dinsos&do=main'> <span></span> BERANDA UTAMA LOGIN PENDAFTARAAN </a>
                     <span> </span> <img src="./image/panah.gif" /> <span> </span> <a href="index.php?mod=dinsos&do=daftar">PENDAFTARAN, UPDATE DAN VERIFIKASI PERUSAHAAN</a>
                      <span> </span> <img src="./image/panah.gif" /> <span> </span> VERIFIKASI
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
    <td colspan="2">
    <!-- Content -->
    <div id='content' style='
			margin-left:5%;
			margin-bottom:20px;
			width:90%;
            position:relative;'><br>
            <br>
			<fieldset style='width:90%; margin-left:40px; padding-left:20px;min-height:50px;margin-bottom:20px;'>
				<legend>DATA DETAIL PERUSAHAAN</legend>
                <br>

	<style>
		input, select, textarea
		{
			border:hidden;
			cursor:pointer;
			resize:none;
		}
		select:focus,input:focus, textarea:focus
		{
			border:1px solid black;
			cursor:text;
			background:#F0F0F0;
		}
		table,td,tr
		{
			padding-bottom:10px;
			text-transform:uppercase;
			font-size:12px;
		}
	</style>
    <form action="./index.php?mod=dinsos&do=daftar&act=validate" method='post'>
	<table width="100%" border="0" align="center" cellpadding="5px">
	  <tr>
	    <td colspan="7"><h2>DATA PERUSAHAAN</h2>
	      <hr />
	      <br />
	      <p>&nbsp;</p></td>
      </tr>
	  <tr>
	    <td width="25%"><p>NAMA PERUSAHAAN</p></td>
	    <td width="2%">:</td>
	    <td colspan="5">
	      <input type="hidden" name="hidden" value="<?php echo $aa;?>">
	      <?php echo $a;?></td>
	    </tr>
	  <tr>
	    <td><p>ALAMAT</p></td>
	    <td>:</td>
	    <td colspan="5"><?php echo $b; ?>
	      </td>
	    </tr>
	  <tr>
	    <td><p>KECAMATAN</p></td>
	    <td>:</td>
	    <td colspan="5">
	      <input type='hidden' name='kecamatan' value='<?php echo $c;?>'>
	      <?php echo $data1[0]; ?></td>
	    </tr>
	  <tr>
	    <td><p>KELURAHAN</p></td>
	    <td>:</td>
	    <td colspan="5">
	      <input type='hidden' name='kelurahan' value='<?php echo $d;?>'>
	      <?php echo $data2[0]; ?></td>
	    </tr>
	  <tr>
	    <td><p>No. TELEPON</p></td>
	    <td>:</td>
	    <td colspan="5"><?php echo $e; ?></td>
	    </tr>
	  <tr>
	    <td><p>KODE POS</p></td>
	    <td>:</td>
	    <td colspan="5"><?php echo $f; ?></td>
	    </tr>
	  <tr>
	    <td>NO AKTE PENDIRIAN</td>
	    <td width="2%">:</td>
	    <td colspan="5"><?php echo $g; ?></td>
	    </tr>
	  <tr>
	    <td>TANGGAL PENDIRIAN</td>
	    <td>:</td>
	    <td colspan="5"><?php echo $h; ?></td>
	    </tr>
	  <tr>
	    <td>JENIS USAHA</td>
	    <td>:</td>
	    <td colspan="5"><input type='hidden' name='jns_usaha' value='<?php echo $j;?>' />
	      <?php echo $data3[0]; ?></td>
	    </tr>
	  <tr>
	    <td>STATUS USAHA</td>
	    <td>:</td>
	    <td colspan="5"><input type='hidden' name='status_per' value='<?php echo $j;?>' />
	      <?php echo $data4[0]; ?></td>
	    </tr>
	  <tr>
	    <td>KLUI</td>
	    <td>:</td>
	    <td colspan="5"><?php echo $data7[0]; ?></td>
	    </tr>
	  <tr>
	    <td colspan="3">&nbsp;</td>
	    <td width="5%">&nbsp;</td>
	    <td width="22%">&nbsp;</td>
	    <td width="2%">&nbsp;</td>
	    <td width="20%">&nbsp;</td>
      </tr>
	  <tr>
	    <td colspan="7"><h2>DATA KEPEMILIKAN</h2>
	      <hr />
	      <br /></td>
      </tr>
	  <tr>
	    <td>PEMILIK</td>
	    <td>:</td>
	    <td colspan="5"><?php echo $k; ?></td>
	    </tr>
	  <tr>
	    <td>ALAMAT PEMILIK</td>
	    <td>:</td>
	    <td colspan="5"><?php echo $l; ?></td>
	    </tr>
	  <tr>
	    <td>PENGURUS</td>
	    <td>:</td>
	    <td colspan="5"><?php echo $m; ?></td>
	    </tr>
	  <tr>
	    <td>ALAMAT PENGURUS</td>
	    <td>:</td>
	    <td colspan="5"><?php echo $n; ?></td>
	    </tr>
	  <tr>
	    <td>STATUS PEMILIK</td>
	    <td>:</td>
	    <td colspan="5"><input type='hidden' name='status_pemilik' value='<?php echo $o;?>' />
	      <?php echo $data5[0]; ?></td>
	    </tr>
	  <tr>
	    <td>STATUS PERMODALAN</td>
	    <td>:</td>
	    <td colspan="5"><input type='hidden' name='status_modal' value='<?php echo $p;?>' />
	      <?php echo $data6[0]; ?></td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td width="24%">&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
      <tr>
	    <td colspan="7"><br />
	      <h2>DATA TENAGA KERJA</h2>
	      <hr />
	      <br /></td>
      </tr>
	  <tr>
	    <td>T.K WNI PRIA</td>
	    <td>:</td>
	    <td><?php echo $q; ?></td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
      </tr>
	  <tr>
	    <td>T.K WNI WANITA</td>
	    <td>:</td>
	    <td><?php echo $r; ?></td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
      </tr>
	  <tr>
	    <td>T.K WNA PRIA</td>
	    <td>:</td>
	    <td><?php echo $s; ?></td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
      </tr>
	  <tr>
	    <td>T.K WNA WANITA</td>
	    <td>:</td>
	    <td><?php echo $t; ?></td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
      </tr>
	  <tr>
	    <td height="34">&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <!--<td><button><a id='editlala' href="javascript:history.back()" style="color:#FFF;">EDIT DATA</a></button></td>-->
	    <td>
			<input type='hidden' name='dataper' value='<?php echo $str_per; ?>'>
			<input type='hidden' name='datatng' value='<?php echo $str_tng; ?>'>
		</td>
        <!--<td><input type='button' value='EDIT DATA' onClick='balik()'>-->
	    <td><input type="submit" value="SIMPAN DATA" /></td>
      </tr>
    </table>
    </form>
      <br>
   </fieldset>
	<br>
	</div>
    </td>
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
    <td><div id='footer'  style='background:url(./image/coba/footer.png) no-repeat;'>
</div>
</td>
  </tr>
</table>		