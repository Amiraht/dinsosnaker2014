<table width="1024" border="0" cellspacing="2" cellpadding="5">
  <tr>
    <td height="124" colspan="2">
		<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
          <table border="0" id='atasan'">
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00; href="#">DATA PERUSAHAAN</a></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='index.php?mod=jamsostek&do=main'> <span></span> BERANDA UTAMA </a>
                     <span> </span> <img src="./image/panah.gif" /> <span> </span> <a href="javascript:history.back()">PENCARIAN PERUSAHAAN</a>
                      <span> </span> <img src="./image/panah.gif" /> <span> </span> DATA PERUSAHAAN
                     </td>
                     	<td style="float:right;">
				<img width="90" height="29" 
                    onclick="document.location.href='./index.php?mod=jamsostek&do=main'" 
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
			width:90%;
            position:relative;'><br>
              <table width='100%' border='0px';>
                    <tr>
                  	
                     </tr>
			    </table>
			<fieldset style='width:90%; margin-left:40px; padding-left:20px;min-height:50px;margin-bottom:20px;'>
				<legend>DATA DETAIL PERUSAHAAN</legend>
                <br>
<?php
	$id = $_GET['id'];
	$perusahaan = mysql_query("
						SELECT
								a.id_perusahaan, a.nama, a.alamat,
								a_k.kecamatan, a_kel.kelurahan,
								a.telpon, a.kode_pos,
								a.nomor_akte,a.tgl_pendirian, 
								a_j.jenis, a_s.status,
								a.nama_pemilik, a.nama_pengurus,
								a.alamat_pemilik, a.alamat_pengurus,a_m.status,a_mod.modal,
								b.wnilk, b.wnipr, b.wnalk, b.wnapr, c.nama_bagian
							FROM
								db_jamsostek a
								LEFT JOIN t_jenis_usaha a_j ON a.jenis_usaha = a_j.id_jenis_usaha
								LEFT JOIN t_status_milik a_m ON a.id_status_pemilik = a_m.id_status
								LEFT JOIN t_status_modal a_mod ON a.id_status_permodalan = a_mod.id_status
								LEFT JOIN t_status a_s ON a.id_status_perusahaan = a_s.id_status
								LEFT JOIN t_kecamatan a_k ON a.kec = a_k.id_kecamatan
								LEFT JOIN t_kelurahan a_kel ON a.kel = a_kel.id_kelurahan
								LEFT JOIN tbl_tenagakerja_jamsos b ON b.id_perusahaan = a.id_perusahaan
								LEFT JOIN kbli c ON a.klui = c.kode_bagian
							WHERE
								a.id_perusahaan = '$id'
								
					");

	$set = mysql_fetch_array($perusahaan);
?>
	<style>
		input[type='text']
		{
			border:hidden;
		}
		table,td,tr
		{
			padding-bottom:10px;
			text-transform:uppercase;
			font-size:12px;
		}
	</style>
    
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
	    <td colspan="5"><input type='hidden' value='<?php echo $set[0] ?>'>
        				<?php echo $set[1]; ?></td>
	    </tr>
	  <tr>
	    <td><p>ALAMAT</p></td>
	    <td>:</td>
	    <td colspan="5"><?php echo $set[2]; ?>
	      </td>
	    </tr>
	  <tr>
	    <td><p>KECAMATAN</p></td>
	    <td>:</td>
	    <td colspan="5"><?php echo $set[3]; ?></td>
	    </tr>
	  <tr>
	    <td><p>KELURAHAN</p></td>
	    <td>:</td>
	    <td colspan="5"><?php echo $set[4]; ?></td>
	    </tr>
	  <tr>
	    <td><p>No. TELEPON</p></td>
	    <td>:</td>
	    <td colspan="5"><?php echo $set[5]; ?></td>
	    </tr>
	  <tr>
	    <td><p>KODE POS</p></td>
	    <td>:</td>
	    <td colspan="5"><?php echo $set[6]; ?></td>
	    </tr>
	  <tr>
	    <td width="25%">NO AKTE PENDIRIAN</td>
	    <td width="2%">:</td>
	    <td colspan="5"><?php echo $set[7]; ?></td>
	    </tr>
	  <tr>
	    <td>TANGGAL PENDIRIAN</td>
	    <td>:</td>
	    <td colspan="5"><?php echo $set[8]; ?></td>
	    </tr>
	  <tr>
	    <td>JENIS USAHA</td>
	    <td>:</td>
	    <td colspan="5"><?php echo $set[9]; ?></td>
	    </tr>
	  <tr>
	    <td>STATUS USAHA</td>
	    <td>:</td>
	    <td colspan="5"><?php echo $set[10]; ?></td>
	    </tr>
	  <tr>
	    <td>KLUI</td>
	    <td>:</td>
	    <td colspan="5"><?php echo $set[21]; ?></td>
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
	    <td colspan="5"><?php echo $set[11]; ?></td>
	    </tr>
	  <tr>
	    <td>ALAMAT PEMILIK</td>
	    <td>:</td>
	    <td colspan="5"><?php echo $set[12]; ?></td>
	    </tr>
	  <tr>
	    <td>PENGURUS</td>
	    <td>:</td>
	    <td colspan="5"><?php echo $set[13]; ?></td>
	    </tr>
	  <tr>
	    <td>ALAMAT PENGURUS</td>
	    <td>:</td>
	    <td colspan="5"><?php echo $set[14]; ?></td>
	    </tr>
	  <tr>
	    <td>STATUS PEMILIK</td>
	    <td>:</td>
	    <td colspan="5"><?php echo $set[15]; ?></td>
	    </tr>
	  <tr>
	    <td>STATUS PERMODALAN</td>
	    <td>:</td>
	    <td colspan="5"><?php echo $set[16]; ?></td>
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
	    <td width="24%"><?php echo $set[17]; ?></td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
      </tr>
	  <tr>
	    <td>T.K WNI WANITA</td>
	    <td>:</td>
	    <td><?php echo $set[18]; ?></td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
      </tr>
	  <tr>
	    <td>T.K WNA PRIA</td>
	    <td>:</td>
	    <td><?php echo $set[19]; ?></td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
      </tr>
	  <tr>
	    <td>T.K WNA WANITA</td>
	    <td>:</td>
	    <td><?php echo $set[20]; ?></td>
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
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
      </tr>
    </table>
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