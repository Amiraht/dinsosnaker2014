	<script type='text/javascript' >
	function validasi(av)
	{
		var Check = av.nama_per.value;
		
			if(Check == '' )
			{		
				alert('TOLONG DI ISI TERLEBIH DAHULU');
				return false;
			}
			else
			{return true;}
	}
	
	function tmbh_per(c)
	{
		var t=document.getElementById("div_per_"+c);
		if(t.innerHTML != '')
			t.innerHTML = '';
		else
			t.innerHTML='<iframe src="./module/daftar_perusahaan/a.php?id='+c+'&hidden=b" width="100%" height="1000px" frameborder="0" scrolling="no" id="iframe_per"></iframe>';
	}
	function Kirim_cari1()
		{
			var y ='<?php echo $_GET["cari"] ?>';
			var s;
			var halaman = document.f2.halaman.value;
			//alert(halaman);
			
			s = 'index.php?mod=jamsostek&do=daftar&act=search';	
			if(y != '')
				s=s+'&cari='+y;
			s=s+'&halaman='+halaman;
			document.location.href=s;
		}
</script>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
  <tr>
    <td><div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
      <table border="0" id='atasan'>
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00;" href="#"><b>PENCARIAN DAN PENDAFTARAN PERUSAHAAN</b></a></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='index.php?mod=jamsostek&do=main'> <span></span> BERANDA UTAMA LOGIN JAMSOSTEK </a>
                     <span> </span> <img src="./image/panah.gif" /> <span> </span> PENCARIAN DAN PENDAFTARAN PERUSAHAAN
                     </td>
                     	
            </tr>
        </table>
</div>
</td>
</tr>
<tr><td style="float:right;">
				<img width="90" height="29" 
                    onclick="document.location.href='index.php?mod=jamsostek&do=main'" 
                    onmouseout="this.src='./image/button/KEMBALI.gif'" 
                    onmouseover="this.src='./image/button/KEMBALI2.gif'" 
                    src="./image/button/KEMBALI.gif">
                </img>
    			</td></tr>
  <tr><td>&nbsp;</td></tr>
  <tr>
    <td colspan="2">
    <!-- Content -->
     <div id='content' style='margin-left:2%;margin-bottom:20px;width:98%;'>
        <fieldset>
	    <legend>FILTER</legend>
					<form name='search' action='index.php?mod=jamsostek&do=daftar&act=search' method='post'>
						<table width='100%' style='margin-bottom:10px; font-size: 12px;' border='0'>
							<tr>
							  <td height="25">NAMA PERUSAHAAN</td>
							  <td style='padding-top:0px;, padding-left:10px;'><input name='nama_per' type='text' maxlength="100" /></td>
							  <td style='padding-top:0px;, padding-left:10px;'>&nbsp;</td>
						  </tr>
							<tr>
								<td width="23%" height="25">&nbsp;</td>
								<td width="25%" style='padding-top:0px;'><input type='submit' value='CARI PERUSAHAAN' onclick="validasi(search);" /></td>
								<td width="52%" style='padding-top:0px;'>&nbsp;</td>
							</tr>
						</table>
					</form>
			</fieldset>	
            
		<br>
		<fieldset>
	    
					<legend>DATA PERUSAHAAN</legend>
  	<br>
				<table width="100%" cellpadding="5" class='tblisi'>
									<tr>
                                    	<th>NO</th>
										<th >NAMA PERUSAHAAN</th>
										<th >ALAMAT PERUSAHAAN </th>
                                       <th >KLUI</th> 
										<th >JENIS PERUSAHAAN</th>
										<th >SUMBER DATA PERUSAHAAN</th>
										<th >AKTIVITAS</th>
									</tr>
                                    <tr>
        <!-- ############################################## FETCHING DATA SECTION ############################################-->
      	  <?php
				$nama = $_POST["nama_per"];
				if($nama != '')
				{
					$a = "SELECT result.*
										FROM(
											(
												SELECT
													a.id_perusahaan, a.nama, a.alamat, a_kb.nama_bagian, a_ju.jenis, 'DINSOSNAKER' AS sumber
												FROM
													db_dinsos a
													LEFT JOIN t_jenis_usaha a_ju ON a.jenis_usaha = a_ju.id_jenis_usaha
													LEFT JOIN kbli a_kb ON a.klui = a_kb.kode_bagian
											)
											UNION
											(
												SELECT
													b.id_perusahaan, b.nama, b.alamat, b_kb.nama_bagian, b_ju.jenis, 'JAMSOSTEK' AS sumber
												FROM
													db_jamsostek b
													LEFT JOIN t_jenis_usaha b_ju ON b.jenis_usaha = b_ju.id_jenis_usaha
													LEFT JOIN kbli b_kb ON b.klui = b_kb.kode_bagian
											)
											UNION
											(
											SELECT
													c.id as id_perusahaan, c.nama, c.alamat, kb.nama_bagian, c_ju.jenis, 'BPPT' AS sumber
												FROM
													bppt c
												LEFT join kbli kb ON c.klui = kb.kode_bagian
												LEFT JOIN t_jenis_usaha c_ju ON c.bentuk_badan = c_ju.id_jenis_usaha
											)
										) AS result
										WHERE
											result.nama LIKE '%$nama%'
										ORDER BY
											result.nama ASC ";
					
					$jumlah = "select count(id_perusahaan) from ($a) as fetching";
					$query_row = mysql_query($jumlah);
					$batas = 20;
					$halaman = $_GET["halaman"];
					
					if(empty($halaman))
					{
						$posisi = 0;
						$halaman = 1;
					}
					else
						$posisi = ($halaman - 1) * $batas;
					
					$jmldata = mysql_fetch_array($query_row);
					$jmlhal  = ceil($jmldata[0]/$batas);
					
					$sql = mysql_query("$a limit $posisi,$batas");
					
					/*========================================================================*/
					
					echo '<form name=f2><span style="font:Verdana;font-size:12px; float:left;">';
					echo '<span style=font-family:verdana;font-size:12px> Halaman: 
					<select name=halaman onchange="javascript:Kirim_cari1();">';
						for($i = 1; $i <= $jmlhal; $i++)
						{
							if ($i==$halaman)
							{
								echo '<option values="'.$i.'" selected>'.$i.'</option>';
							}
							
							else
							{
								echo '<option values="'.$i.'">'.$i.'</option>';
							}
						}
							
					echo '</select>';
					echo ' dari '.$jmlhal.' Halaman</span>';
					echo '</span></form><br><br>';
					echo "<br><br><a href='./index.php?mod=jamsostek&do=daftar&act=register'>TAMBAH PERUSAHAAN</a><br><br>";
					
					/*========================================================================*/	
				
					if($query_row > 0)
					{
						$i=1;
						while($set=mysql_fetch_array($sql))
						{
							echo "<tr>
									<td> $i </td>
									<td> $set[1]</td>
									<td> $set[2]</td>
									<td> $set[3] </td>
									<td> $set[4] </td>
									<td> $set[5]</td>
									";
									if($set[5]=='BPPT' || $set[5]=='DINSOSNAKER')
										{echo "<td align='center'> <a href='./index.php?mod=jamsostek&do=daftar&act=register&sumber=$set[5]&id=$set[0]'>DAFTAR PERUSAHAAN</a></td>";}
									else
										echo "<td align='center'> <a href='./index.php?mod=jamsostek&do=detail&id=".$set[0]."'>LIHAT PERUSAHAAN</a></td>";
							echo"	</tr>";
							$i++;
						}
					}
					else
					echo "<script type='text/javascript'>
								alert('Tidak ada Data Perusahaan');
								document.location = 'index.php?mod=jamsostek&do=daftar&act=register';
						</script>
						";
				}
				else
				{
						echo "
									<tr>
										<td colspan='7' style='text-align:center;' cellpadding=5> CARI PERUSAHAAN TERLEBIH DAHULU</td>
									</tr>
									";
				}
        ?>
		</tr>
        </table>
        </fieldset>
	<br>
	</div>
    </td>
<!--  </tr>
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
  </tr>-->
  <tr>
    <td><div id='footer'  style='background:url(./image/coba/footer.png) no-repeat;'>
</div>
</td>
  </tr>
</table>