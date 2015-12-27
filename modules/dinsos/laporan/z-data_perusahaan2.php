<table width="1024" border="0" cellspacing="2" cellpadding="5">
  <tr>
     <td colspan="2"><div id='header' style='background:url(../../image/coba/header2.png) no-repeat;'>
       <table border="0" id='atasan'>
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00; href="#">DATA POTENSIAL JAMSOSTEK</a></td>
            </tr>
                    <tr>
                  	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='index.php?mod=menu&do=main'> <span></span> BERANDA UTAMA </a>
                     <span> </span> <img src="../../image/panah.gif" /> <span> </span> DATA POTENSIAL
                     </td>
                     <td style="float:right;">
                		<img width="90" height="29" 
				onclick="document.location.href='./index.php?mod=home&opt=main'" 
				onmouseout="this.src='../../image/button/KEMBALI.gif'" 
				onmouseover="this.src='../../image/button/KEMBALI2.gif'" 
				src="../../image/button/KEMBALI.gif"></img>
                </td>
        </table>
    </div></td>
  </tr>
  <tr>
   
  </tr>
  <tr>
    <td colspan="2">
    		<div id='content' style='
			margin-left:5%;
			margin-bottom:20px;
			width:90%;'>
            <br>
            <br>
               <fieldset style='width:100%; padding-left:20px; min-height:50px; margin-bottom:20px; padding-right:20px'>
					<legend >DATA PERUSAHAAN</legend>
                    <br>
					
<table class='tblisi' width='100%' cellpadding='5'>
				<tr>
					<th>&nbsp;&nbsp;&nbsp;NO</th>
					<th>NAMA PERUSAHAAN</th>
					<th>JENIS PERUSAHAAN</th>
					<th>KLUI</th>
					<th>ALAMAT</th>
					<th>AKTIFITAS</th>
				</tr>
<?php 

			$query = mysql_query("select a.id_perusahaan, a.nama, b.jenis_usaha, a.nomor_akte, a.alamat from db_jamsostek a , jenis_usaha b where a.jenis_usaha=b.id_jenis_usaha"); 
				
			if(mysql_num_rows($query) == '')
				{
				echo "<tr>
						<td>DATA TIDAK DITEMUKAN</td>
					 </tr>";
				}
				?>

			
			<?php 
				if(mysql_num_rows($query) == '')
				{
				echo "<tr>
						<td colspan='6'>DATA TIDAK DITEMUKAN</td>
					 </tr>";
				}
				
					$i=1;
					while($set = mysql_fetch_array($query))
					{
					echo "
					<tr>
						<td> $i </td>
						<td> $set[1] </td>
						<td> $set[2] </td>
						<td> --- </td>
						<td> $set[4]</td>
						<td> <a href='./module/output_download.php?id=$set[0];'>CETAK</a> </td>
					</tr>
					";
					$i++;
					}

				?>
			</table>
            <br>
            </fieldset>	
</div>
    
    
    </td>
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
    </td>
  </tr>
  <tr>
  	<td colspan="2">
    	<div id='footer'  style='background:url(../../image/coba/footer.png) no-repeat;'></div>
    </td>
  </tr>
</table>
		
