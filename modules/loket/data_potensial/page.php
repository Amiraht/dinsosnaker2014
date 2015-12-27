<?php
	$a = mysql_query("select * from t_jenis_usaha order by jenis asc");
	$b = mysql_query("select * from t_status order by status asc");
	$c = mysql_query("select * from t_status_milik order by status asc");
	$d = mysql_query("select * from t_status_modal order by modal asc");

	#ambil data kecamatan
	$query = "SELECT id_kecamatan, kecamatan FROM t_kecamatan WHERE id <=21 ORDER BY kecamatan ";
	$sql = mysqli_query($conn, $query);
	$arrkecamatan = array();
	while ($row = mysqli_fetch_assoc($sql)) {
		$arrkecamatan [ $row['id_kecamatan'] ] = $row['kecamatan'];
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

	<script type="text/javascript">	
	function cari_per()
	{
		var a =document.cari_p.cari.value;
		var b =document.cari_p.kecamatan.value;
		var c =document.cari_p.kelurahan.value;
		var d =document.cari_p.jenis.value;
		var e =document.cari_p.sumber.value;
		var s;
		s='index.php?mod=loket&opt=potensial';	
		//if(y != '')
			s=s+'&cari='+a+'&kec='+b+'&kel='+c+'&jenis='+d+'&sumber='+e;
		document.location.href=s;
	}
	
	function lihat_detail(c,d)
	{
		var t=document.getElementById("div_detail_"+c);
		if(t.innerHTML != '')
			t.innerHTML = '';
		else
			t.innerHTML='<iframe src="./modules/loket/data_potensial/detail.php?id='+c+'&sumber='+d+'&hidden=b" width="100%" height="900px" frameborder="0" scrolling="yes" id="iframe_detail"></iframe>';
	}
	
	function Kirim_cari1()
	{
		var halaman = document.f2.halaman.value;
		var d;
		d='index.php?mod=loket&opt=potensial';
		<?php 
			if(isset($_GET["cari"]))
				echo "d=d+'&cari=".$_GET['cari']."';";
			if(isset($_GET["kec"]))
				echo "d=d+'&kec=".$_GET['kec']."';";
			if(isset($_GET["kel"]))
				echo "d=d+'&kel=".$_GET['kel']."';";
			if(isset($_GET["jenis"]))
				echo "d=d+'&jenis=".$_GET['jenis']."';";				
			if(isset($_GET["sumber"]))
				echo "d=d+'&sumber=".$_GET['sumber']."';";
			
		?>
		
		document.location.href=d+'&halaman='+halaman;
	}
</script>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
  <tr>
     <td colspan="2"><div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
       <table border="0" id="atasan">
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:10px;"><a style="color:#AA9F00"; href="#"><b>DATA POTENSIAL</b></a></td>
            </tr>
                    <tr>
                  	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='index.php?mod=loket&opt=main'> <span></span> BERANDA UTAMA LOGIN LOKET </a>
                     <span> </span> <img src="./image/panah.gif" /> <span> </span> <a href='#'>DATA POTENSIAL</a>
                     </td>
                    
        </table>
    </div></td>
  </tr>
  <tr>
  	 <td style="float:right; padding-right:10px;">
                		<img width="90" height="29" 
				onclick="document.location.href='./index.php?mod=loket&opt=main'" 
				onmouseout="this.src='./image/button/KEMBALI.gif'" 
				onmouseover="this.src='./image/button/KEMBALI2.gif'" 
				src="./image/button/KEMBALI.gif"></img>
                </td>
  </tr>
 <tr>
 <td>&nbsp;</td>
 </tr>
  <tr>
    <td colspan="2">
    		<div id='content' style=' margin-right:5%; margin-bottom:20px;width:98%;'>
             <fieldset >
					<legend>FILTER</legend>
				<form  method='POST' name='cari_p' style='min-width:350px; '>
					<table width="98%">
               	    <tr>
                    	  <td width="186" height="26">Nama Perusahaan</td>
                   	  <td width="280">
           	<input name='cari' type='text'>
							</td>
                   	  </tr>
                    	<tr>
                    	  <td height="26">Sumber Data</td>
                    	  <td><select name="sumber" >
                          	<option value="0">::SEMUA ::</option>
                    	    <option value="BPPT">BPPT</option>
                    	    <option value="BPJS KETENAGAKERJAAN">BPJS KETENAGAKERJAAN</option>
                    	  </select></td>
               	      </tr>
                    	<tr>
                    	  <td height="26">Kecamatan</td>
                    	  <td><select name="kecamatan" id='kecamatan'>
                    	    <option value="0">::SEMUA ::</option>
                    	    <?php 
									 foreach ($arrkecamatan as $id_kecamatan=>$kecamatan) {
										echo "<option value='$id_kecamatan'>$kecamatan</option>";
									}
								?>
                  	    </select></td>
                  	  </tr>
                    	<tr>
                    	  <td height="26">Kelurahan</td>
                    	  <td><select name="kelurahan" id='kelurahan'>
                    	    <option value="0">::SEMUA ::</option>
                  	    </select></td>
                  	  </tr>
                      
                    	<tr>
                    	  <td height="26">Jenis Usaha</td>
                    	  <td>
							<select name="jenis">
                            <option value="0">::SEMUA ::</option>
                    	    
									<?php
									while($a1 = mysql_fetch_array($a))
										{echo"<option value='$a1[1]'>$a1[1]</option>";};
									?>
							</select>&nbsp;
						  </td>
               	      </tr>
                    	<tr>
                    	  <td height="40" valign="middle" colspan="5"><input type='button' value='CARI PERUSAHAAN' onclick="cari_per();" /></td>
                    	  
                   	  </tr>
                    </table>
                  <br>
			</form>
		</fieldset>
        <br>
					   <fieldset >
					<legend >DATA POTENSIAL	</legend>
                    <br>
                        <table width="100%" class='tblisi' cellpadding='5'>
                        <tr style='background:#0d0; font-family: 'Segoe UI Light'; font-size: 12px;'>
                          <th >No</th> 
                    <th >NAMA PERUSAHAAN</th>
                            <th >ALAMAT</th>
                            <th >JENIS PERUSAHAAN</th>
                            <th >SUMBER</th>
                            <th >AKTIVITAS</th>
                          </tr>
                        
                  <?php
				  
						$filter = "db_dinsos.nama IS NULL AND result.nama LIKE '%" . $_GET["cari"] . "%' ";
						if(isset($_GET["sumber"]) && $_GET["sumber"] != "0")
							$filter .= "AND result.sumber = '" . $_GET["sumber"] . "'";
						if(isset($_GET["jenis"]) && $_GET["jenis"] != "0")
							$filter .= "AND result.jenis = '" . $_GET["jenis"] . "'";
						if(isset($_GET["kec"]) && $_GET["kec"] != "0")
							$filter .= "AND result.kec = '" . $_GET["kec"] . "'";
						if(isset($_GET["kel"]) && $_GET["kel"] != "0")
							$filter .= "AND result.kel = '" . $_GET["kel"] . "'";	
					
						$query = "SELECT result.id_perusahaan, result.nama, result.alamat, result.jenis,result.kec,result.kel, result.sumber
									FROM (
										(SELECT
											a.id_perusahaan, a.nama, a.alamat, a_ju.jenis, kec,kel, 'BPJS KETENAGAKERJAAN' AS sumber
										FROM
											db_jamsostek a
											LEFT JOIN t_jenis_usaha a_ju ON a.jenis_usaha = a_ju.id_jenis_usaha
										ORDER BY
											a.nama ASC)
										UNION
										(
										SELECT
											b.id as id_perusahaan , b.nama, b.alamat, c.jenis,kecamatan as kec,kelurahan as kel, 'BPPT' AS sumber
										FROM
											bppt b
											LEFT JOIN t_jenis_usaha c ON b.bentuk_badan = c.id_jenis_usaha
										ORDER BY
											b.nama ASC)
									) AS result
									  LEFT JOIN db_dinsos ON result.nama = db_dinsos.nama
									WHERE
										$filter
									GROUP BY
										result.nama
									ORDER BY
										result.nama";
							
							$jumlah = mysql_query($query);
	
							$batas = 20;
							$halaman = $_GET["halaman"];
							
							if(empty($halaman))
							{
								$posisi = 0;
								$halaman = 1;
							}
							else
								$posisi = ($halaman - 1) * $batas;
						
							$jmldata = mysql_num_rows($jumlah);
							
							$jmlhal  = ceil($jmldata/$batas);
						
							$sql = "SELECT result.id_perusahaan, result.nama, result.alamat, result.jenis,result.kec,result.kel, result.sumber
									FROM (
										(SELECT
											a.id_perusahaan, a.nama, a.alamat, a_ju.jenis, kec,kel, 'BPJS KETENAGAKERJAAN' AS sumber
										FROM
											db_jamsostek a
											LEFT JOIN t_jenis_usaha a_ju ON a.jenis_usaha = a_ju.id_jenis_usaha
										ORDER BY
											a.nama ASC)
										UNION
										(
										SELECT
											b.id as id_perusahaan , b.nama, b.alamat, c.jenis,kecamatan as kec,kelurahan as kel, 'BPPT' AS sumber
										FROM
											bppt b
											LEFT JOIN t_jenis_usaha c ON b.bentuk_badan = c.id_jenis_usaha
										ORDER BY
											b.nama ASC)
									) AS result
									  LEFT JOIN db_dinsos ON result.nama = db_dinsos.nama
									WHERE
										$filter
									GROUP BY
										result.nama
									ORDER BY
										result.nama
									LIMIT ".$posisi.", ".$batas."
							";

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
			echo '</span></form><br><br><br>';
							
							
							
							
							/*===================================================*/
							$result = mysql_query($sql);
							if(mysql_num_rows($result) > 0)
							{
								$i =1;
								while($row = mysql_fetch_array($result))
									{
									echo "<tr>
										<td>".($posisi+$i)."</td>
										<td>$row[1]</td>
										<td>$row[2]</td>
										<td>$row[3]</td>
										<td>$row[6]</td>
										<td width='45px'><a href='javascript:lihat_detail($row[0],\"$row[6]\");'>DETAIL </a></td>
									</tr>
									<tr>
										<td id='div_detail_".$row[0]."' colspan='6' style='background:white;'>
										</td>
									</tr>";
									$i++;
									} 
							}
							else
								echo "<tr>
										<td colspan='6'><h2>TIDAK ADA DATA PERUSAHAAN</h2></td>
									</tr>";
							?>
                      </table>
        </br>
              </fieldset>
</div>
    
    
    </td>
  </tr>
<!--<tr>
  		<td align="center" valign="middle" >
   					<nav id='menu'>
						<ul >
							<li><img src='./image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=loket&opt=main'>BERANDA</a></li>
							<li><img src='./image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=loket&opt=daftar'>PENDAFTARAN PERUSAHAAN</a></li>
							<li><img src='./image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=loket&opt=data_perusahaan'>DATA PERUSAHAAN</a></li>
							<li><img src='./image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=loket&opt=potensial'>DATA POTENSIAL</a></li>
							<li><img src='./image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=loket&opt=laporan'>LAPORAN</a></li>
							<li><img src='./image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=loket&opt=profil'>PROFIL USER</a></li>
							<li><img src='./image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=loket&opt=lg'>LOGOUT</a></li>
						</ul>
    	</nav>

    </td>
  </tr>-->
  <tr>
  	<td colspan="2">
    	<div id='footer'  style='background:url(./image/coba/footer.png) no-repeat;'></div>
    </td>
  </tr>
</table>
		
