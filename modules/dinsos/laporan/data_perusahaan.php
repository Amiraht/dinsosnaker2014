<script type="text/javascript">	
	function cari_per()
	{
		var x =document.cari_p.cari.value;
		var y =document.cari_p.klui.value;
		var z =document.cari_p.jenis.value;
		var s;
		s='index.php?mod=menu&do=data_perusahaan';	
		if(y != '')
			s=s+'&cari='+x+'&klui='+y+'&jenis='+z;
		document.location.href=s;
	}
	
	function lihat_detail(c)
	{
		var t=document.getElementById("div_detail_"+c);
		if(t.innerHTML != '')
			t.innerHTML = '';
		else
			t.innerHTML='<iframe src="./module/data_perusahaan/detail.php?id='+c+'&hidden=b" width="100%" style="height:800px" frameborder="0" scrolling="no" id="iframe_detail"></iframe>';
	}
</script>

<?php
	$a=$_GET["cari"];
	$b=$_GET["klui"];
	$c=$_GET["jenis"];
	$a = mysql_query("select * from t_jenis_usaha");
	
	$data = mysql_query("select a.id_perusahaan, a.nama, b.jenis, a.nomor_akte, a.alamat from db_jamsostek a, t_jenis_usaha b where a.jenis_usaha=b.id_jenis_usaha order by nama asc limit 0,10");
?>

<table width="1024" border="0" cellspacing="2" cellpadding="5">
  <tr >
    <td colspan="2"><div id='header' style='background:url(../../image/coba/header2.png) no-repeat;'> 
      <table border="0" id='atasan'>
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00;" href="#">DATA PERUSAHAANK</a></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='index.php?mod=menu&do=main'> <span></span> BERANDA UTAMA </a>
                     <span> </span> <img src="../../image/panah.gif" /> <span> </span><a href="" id="linkutama">  DATA PERUSAHAAN</a>
                     </td>
                     	
            </tr>
        </table>
    
    </div>
    </td>
    </tr>
    <tr>
    	<td style="float:right;">
				<img width="90" height="29" 
                    onclick="document.location.href='./index.php?mod=home&opt=main'" 
                    onmouseout="this.src='../../image/button/KEMBALI.gif'" 
                    onmouseover="this.src='../../image/button/KEMBALI2.gif'" 
                    src="../../image/button/KEMBALI.gif">
                </img>
    			</td>
    </tr>
  <tr>
    <td colspan="2">  
    		<div id='content' style=' margin-left:5%; margin-bottom:20px;width:98%;'>
                 <br>
                <fieldset >
                    <legend>FILTER</legend>
                   <form method='POST' name='cari_p'>
                        <table border="0" cellpadding="3">
                        	<tr>
                            	<td>NAMA PERUSAHAAN</td>
                            	<td>&nbsp;</td>
                            	<td><input type='text' name='cari' placeholder='Cari Nama Perusahaan' /></td>
                            	<td width="122">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="149">KLUI</td>
                              <td width="3">:</td>
                              <td width="144"><input type="text" name="klui" placeholder="Jenis Klui" /></td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr id='detail'>
                            <td>JENIS PERUSAHAAN</td>
                             <td>:</td>
                             <td><select name="jenis">
				                      	<?php
											while($a1 = mysql_fetch_array($a))
												{echo"<option value='$a1[0]'>$a1[1]</option>";};
											?>
                             </select>&nbsp;</td>
                                <td><span style="padding-top:5px;">
                                  <input type='submit' value='CARI PERUSAHAAN' onclick="cari_per();" />
                                </span></td>
                            </tr>
                          
                        </table>
                        <br />
                    </form>
                </fieldset>
   		    <br><br>
                <fieldset style='width:90%; margin-left:40px; padding-left:20px;min-height:150px;
                            margin-bottom:20px;'>
                            <legend>Data Perusahaan</legend> 
            <?php            		/*Pencarian*/
			
			$qsrt = mysql_query("select * from db_jamsostek");
			/*=================================================*/
			$batas = 10;
			
			if(empty($_GET["halaman"]))
			{
				$posisi = 0;
				$halaman = 1;
			}
			else
				$posisi = ($halaman - 1) * $batas;
							
			$jmldata = mysql_num_rows($qsrt);
			$jmlhal  = ceil($jmldata/$batas);

			if(!empty($_GET["cari"]))
			{
				$qsrt = mysql_query("select * from db_jamsostek where nama LIKE '%".$_GET["cari"]."' order by nama asc limit ".$posisi.",".$batas."");
			}
			else
				$qsrt = mysql_query("select * from db_jamsostek order by nama asc limit ".$posisi.",".$batas."");
			
			echo '<form name=f2><span style="font:Verdana;font-size:12px; float:left;">';
			echo '<span style=font-family:verdana;font-size:12px> Halaman: 
			<select name=halaman onchange="javascript:Kirim_Cari1();">';
			echo '<option value="'.$halaman.'" selected="selected">'.$halaman.'</option>';
				for($i = 1; $i <= $jmlhal; $i++)
					if ($i!=$halaman)
					{
						echo '<option values="'.$i.'">'.$i.'</option>';
					}
			echo '</option>';
			echo '</select>';
			echo ' dari '.$jmlhal.' Halaman</span>';
			echo '</span></form><br><br><br>';
			
					
		?> 
                           
         <table width='100%'><tr><td style='text-align:right;'><a href='index.php?mod=menu&do=down' >Cetak</a></td></tr></table>
<br>
<table border='1' class='tblisi' style='width:95%; margin-bottom:10px;'>
	<tr>
		<th>NO</th>
		<th>NAMA PERUSAHAAN</th>
		<th>JENIS PERUSAHAAN</th>
		<th>KLUI</th>
		<th>ALAMAT</th>
		<th colspan='2' width='120px'>AKTIVITAS</th>
	</tr>
<?php 
	if(mysql_num_rows($data) == '')
	{
	echo "<tr colspan='7'>
			<td>DATA TIDAK DITEMUKAN</td>
		 </tr>";
	}
	
		$i=1;
		while($set = mysql_fetch_array($data))
		{
		echo "
		<tr>
			<td> $i </td>
			<td> $set[1] </td>
			<td> $set[2] </td>
			<td> $set[3] </td>
			<td> $set[4]</td>
			<td> <a href='index.php?mod=menu&do=down'>CETAK</a> </td>";
	?>
			<td> <a href="./module/data_perusahaan/hapus.php?optss=hapus&id=<?php echo $set[0]; ?>" onClick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
			HAPUS</a></td>
	<?php echo"
		</tr>
		<tr>
			<td id='div_detail_".$set[0]."' colspan='7' style='background:white;'>
			</td>
		</tr>
		";
		$i++;
		}
	?>
    </table><br>
                </fieldset>

      </div></td>
  </tr>
  <tr>
  	<td colspan="2">
    					<nav id='menu'>
						<ul >
							<li><img src='../../image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=menu&do=main'>BERANDA</a></li>
							<li><img src='../../image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=menu&do=daftar'>PENDAFTARAN PERUSAHAAN</a></li>
							<li><img src='../../image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=menu&do=data_perusahaan'>DATA PERUSAHAAN</a></li>
							<li><img src='../../image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=menu&do=potensial'>DATA POTENSIAL</a></li>
							<li><img src='../../image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=menu&do=laporan'>LAPORAN</a></li>
							<li><img src='../../image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=menu&do=profil'>PROFIL USER</a></li>
							<li><img src='../../image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=menu&do=lg'>LOGOUT</a></li>
						</ul>
    	</nav>

    </td>
  </tr>
  <tr>
  	<td colspan="2"><div id='footer'  style='background:url(../../image/coba/footer.png) no-repeat; height:80px; margin-left:8px;'></div>
    </td>
  </tr>
</table>