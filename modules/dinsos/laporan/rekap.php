<?php
	$a=$_GET["cari"];
	$b=$_GET["klui"];
	$c=$_GET["jenis"];
	$a = mysql_query("select * from t_jenis_usaha");
	
	$data = mysql_query("select count(*) as 'Total Perusahaan' from db_jamsostek");
?>

<table width="1024" border="0" cellspacing="2" cellpadding="5">
  <tr >
    <td colspan="2"><div id='header' style='background:url(../../image/coba/header2.png) no-repeat;'> 
      <table border="0" id='atasan'">
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00; href="#">DATA PERUSAHAAN JAMSOSTEK</a></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='index.php?mod=menu&do=main'> <span></span> BERANDA UTAMA </a>
                     <span> </span> <img src="../../image/panah.gif" /> <span> </span> DATA PERUSAHAAN
                     </td>
                     	<td style="float:right;">
				<img width="90" height="29" 
                    onclick="document.location.href='./index.php?mod=home&opt=main'" 
                    onmouseout="this.src='../../image/button/KEMBALI.gif'" 
                    onmouseover="this.src='../../image/button/KEMBALI2.gif'" 
                    src="../../image/button/KEMBALI.gif">
                </img>
    			</td>
            </tr>
        </table>
    
    </div>
    </td>
  <tr>
    <td colspan="2">  
    		<div id='content' style=' margin-left:5%; margin-bottom:20px;width:90%;'>
                 <br>
                <fieldset style='width:90%; margin-left:40px; padding-left:20px; min-height:50px; margin-bottom:20px; font-size: 12px; font-family: 'Segoe UI Light';'>
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
		TOTAL DATA PERUSAHAAN TERDAFTAR DI JAMSOSTEK : <?php $hasil=mysql_fetch_array($data); echo $hasil[0];?>
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