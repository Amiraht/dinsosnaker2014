<script type="text/javascript">	
	function cari_per()
	{
		var y =document.cari_p.cari.value;
		var s;
		s='index.php?mod=umum&do=berita_informasi';	
		if(y != '')
			s=s+'&cari='+y;
		document.location.href=s;
	}
	
	function Kirim_cari1()
	{
		var y ='<?php echo $_GET["cari"] ?>';
		var s;
		var halaman = document.f2.halaman.value;
		//alert(halaman);
		
		s = 'index.php?mod=umum&do=berita_informasi';	
		if(y != '')
			s=s+'&cari='+y;
		s=s+'&halaman='+halaman;
		document.location.href=s;
	}
</script>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
  <tr> <!-- Header -->
        <td >
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id="atasan">
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px;">
                 	<h1><a style="color:#AA9F00;" href="index.php?mod=menu&do=berita_informasi">BERITA DAN INFORMASI</a></h1>
                 </td>
            </tr>
            <tr>
            	<td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='index.php?mod=menu&do=main'> <span></span> BERANDA UTAMA </a>
                     <span> </span> <img src="./image/panah.gif" /> <span> </span> BERITA DAN INFORMASI
                     </td>
                <td><img  align="right" width="90" height="29" onclick="document.location.href='./index.php?mod=home&opt=main'" 
                    onmouseout="this.src='./image/button/KEMBALI.gif'" onmouseover="this.src='./image/button/KEMBALI2.gif'" src="./image/button/KEMBALI.gif"></img>
                    </td>
            </tr>
        </table>
            </div>
            <br>
        </td>
  </tr>
  <tr>
  	<td>
    <div id='content' style='
        padding-top:10px;'
        >
		<br>
		<fieldset style='width:95%; margin-left:20px; padding-left:20px;
	padding-bottom:10px; padding-right:20px;'>
			<legend>FILTER</legend>
			           <form method='POST' name='cari_p'>
                        <table width="100%" border="0" cellpadding="3">
                        	<tr>
                            	<td width="75">Judul Berita</td>
                            	<td width="3">&nbsp;</td>
                            	<td width="144"><input type='text' name='cari'/></td>
                            	<td >&nbsp;</td>
                            </tr>
                            <tr>
                            	<td></td>
                                <td></td>
                                <td><input type='button' value='CARI' onClick="cari_per();"></td>
                                <td>&nbsp;</td>
                                </tr>
                        </table>
		            </form>
          <br/>
 	</fieldset>
		
		<br>
		<fieldset style='width:95%; margin-left:20px; padding-left:20px;min-height:200px;
	padding-bottom:20px; padding-right:20px;'>
			<legend >BERITA DAN INFORMASI</legend>
		<br />
		
	
        <?php
			/*Pencarian*/
			if(!empty($_GET["cari"]))
			{
						$jlh_data = mysql_query("select count(id_berita) as berita from tbl_berita where judul LIKE '%".$_GET["cari"]."%'");	
			}
			else
				$jlh_data = mysql_query("select count(id_berita) as berita from tbl_berita");
			
			$hsl = mysql_fetch_array($jlh_data);
			
			$batas = 10;
			$halaman = $_GET["halaman"];
			
			if(empty($halaman))
			{
				$posisi = 0;
				$halaman = 1;
			}
			else
				$posisi = ($halaman - 1) * $batas;
							
			$jmldata = $hsl[0];
			$jmlhal  = ceil($jmldata/$batas);

			if(!empty($_GET["cari"]))
			{
				$qsrt = mysql_query("select * from tbl_berita where judul LIKE '%".$_GET["cari"]."' order by tanggal desc limit ".$posisi.",".$batas."");
			}
			else
				$qsrt = mysql_query("select * from tbl_berita order by tanggal desc limit ".$posisi.",".$batas."");
			
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
			
					
		?>
			
        <table width="100%" align="left" cellpadding="5" cellspacing="1" class='tblisi'>
        <tr class='judul'>
        	<th width="4%" style='padding-left:5px;'>No<br></th>
            <th width="15%">Judul Berita</th>
            <th width="18%">keterangan</th>
            <th width="26%">Nama File</th>
            <th width="16%">Tanggal</th>
            <th width="21%">Aktivitas</th>
         </tr>
         <?php
		 if(mysql_num_rows($qsrt) == '')
		 {
		 ?>
         <tr id="tbl-content">
         <td colspan="9">Data tidak Ditemukan</td>
         </tr>
         <?php
		 }
		 $i = $posisi + 1;
		 while($bsrt = mysql_fetch_row($qsrt))
		 {
		 ?>
         <tr id="tbl-content" onMouseOver="this.style.cursor='pointer';this.style.backgroundColor='#CCCCCC';" onMouseOut="this.style.backgroundColor='#FFFFFF';">
         	<td align="center"><?php echo ($posisi+$i); ?></td>
            <td align="left"><?php echo $bsrt[1]; ?></td>
            <td align="left"><?php if(strlen($bsrt[2] > 20)) echo substr($bsrt[2], 0, 20).'..'; else echo $bsrt[2]; ?></td>
            <td align="left"><?php echo $bsrt[3]; ?></td>
            <td align="center"><?php echo substr($bsrt["4"],8,2).'-'.substr($bsrt["4"],5,2).'-'.substr($bsrt["4"],0,4); ?></td>
            <td align="center"><a class="menu" href="./modules/nonlogin/fdownload.php?jenis=berita&path=<?php echo $bsrt[3]; ?>" target="_blank">Download</a></td>
         </tr>
         <?php
		 	$i++;
		 }
		 ?>
        </table>
		</fieldset>
</div>
    
    </td>
  </tr>
  <tr>
    <td align="center" valign="middle">
 		<div id='menu' margin-left:'8px;'>
				<nav>
                            <ul>
									<li><img src='./image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=menu&do=main'>BERANDA UTAMA</a></li>
                                    <li><img src='./image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=umum&do=latar_belakang'>LATAR BELAKANG</a></li>
									<li><img src='./image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=umum&do=berita_informasi'>BERITA DAN INFORMASI</a></li>
                                    <li><img src='./image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=umum&do=download'>FILE DOWNLOAD</a></li>
                                    <li><img src='./image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=umum&do=login'>PROSES LOGIN</a></li>
                                    <li><img src='./image/list.png'>&nbsp;&nbsp;<a href='index.php?mod=umum&do=login'>CONTROL PANEL</a></li>
                            </ul>
                    </nav>
		</div>
     </td>
   </tr>
   <tr>
   		<td>
        <div id='footer' style='background:url(./image/coba/footer.png) no-repeat; height:100px; margin-left:8px;'>
            </div>
 	</td>
  </tr>
</table>
