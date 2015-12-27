<script type="text/javascript">
	function Kirim_Cari()
	{
		var y ='<?php echo $_GET["halaman"]; ?>';
		var s;
		s='./index.php?mod=cp&opt=berita_informasi&opts=view';
		if(y>1)
			s=s+'&halaman=1';
		if (document.cari_p.cari.value!='')
		{
			s=s+'&cari='+document.cari_p.cari.value;
		}		
		document.location.href=s;
	}
	function Kirim_Cari1()
	{
		var y ='<?php echo $_GET["cari"]; ?>';
		var s;
		s='./index.php?mod=cp&opt=berita_informasi&opts=view';
		if(y != '')
			s=s+'&cari='+y;
		s=s+'&halaman='+document.f2.halaman.value;
		document.location.href=s;
	}

	function Edit_Berita(a)
	{
		var t=document.getElementById("div_edit_type_"+a);
		if(t.innerHTML != '')
			t.innerHTML = '';
		else
			t.innerHTML='<iframe src="./modules/nonlogin/cp/berita/edit_berita.php?id_berita='+a+'" width="800px" height="250px" frameborder="0" scrolling="auto" id="iframe_edit"></iframe>';
	}
	function Tambah_Berita()
	{
	
		var t=document.getElementById("div_tambah_berita");
		var s;
		if (t.innerHTML!='')
		{
			t.innerHTML='';
		}else
		{
			t.innerHTML='<iframe src="./modules/nonlogin/cp/berita/tambah_berita.php" width="900px" height="250px" frameborder="0" scrolling="auto" id="iframe_tambah"></iframe>';
		}
	
	}
</script>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
  <tr> <!-- Header -->
        <td colspan="2"><div id='header' style='background:url(./image/coba/header2.png) no-repeat;'> 
			<table border="0" id="atasan">
        	<tr>
		         <td colspan="2" style="text-align:right; padding-right:10px; "><h1><a style="color:#AA9F00"; href="#">BERITA DAN INFORMASI</a></h1></td>
            </tr>    

            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;">
				 <a href='index.php?mod=cp&opt=main'>CONTROL PANEL</a> <span> </span> <img src="./image/panah.gif" /> <span> </span> BERITA DAN INFORMASI
                 </td>
                <td style="float:right;">
					<img  align="right" width="90" height="29" onclick="document.location.href='./index.php?mod=cp&opt=main'" 
                    onmouseout="this.src='./image/button/KEMBALI.gif'" onmouseover="this.src='./image/button/KEMBALI2.gif'" src="./image/button/KEMBALI.gif"></img>
    			</td>
            </tr>
        </table> 
        
    </div>
    </td>
</tr>
<tr>
	<td>   
    <div id='content' style='margin-left:2%;margin-bottom:20px;width:97%;'>                       
 	<fieldset>
	<legend>FILTER</legend>
    <form method='POST' name='cari_p'>
    <table border="0" cellpadding="2" >
        <tr>
            <td width="140"> JUDUL BERITA </td>
            <td colspan="2"> <input type='text' name='cari' placeholder='Cari Judul Berita'></td>
        </tr>         
        <tr>
        <td ></td>
            <td td colspan="2"><input type='button' value='CARI' onClick="Kirim_Cari();" style='width:60px;'></td>
        </tr>
    </table>
    
    </form>
                
		</fieldset>
		
		<br/>
		<fieldset>
	    <legend>BERITA DAN INFORMASI</legend>
        <a href="javascript:Tambah_Berita();"><img src="./image/button/tambah_kecil.gif" style="border:none" width="110px" height="30px" onMouseOver="this.src='./image/button/tambah_kecil2.gif';" onMouseOut="this.src='./image/button/tambah_kecil.gif';" /></a>
<div id="div_tambah_berita"></div>
		<br />
        <?php
		
			if(!empty($_GET["cari"]))
			{
				$qsrt = mysql_query("select * from tbl_berita where judul LIKE '%".$_GET["cari"]."%'");
			}
			else
				$qsrt = mysql_query("select * from tbl_berita");
				
			$batas = 10;
			$halaman = $_GET["halaman"];
			
			if(empty($halaman))
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
				$qsrt = mysql_query("select * from tbl_berita where judul LIKE '%".$_GET["cari"]."%' order by tanggal desc limit ".$posisi.",".$batas."");
			}
			else
				$qsrt = mysql_query("select * from tbl_berita order by tanggal desc limit ".$posisi.",".$batas."");
			
			echo '<form name=f2><span style="font:Verdana;font-size:12px;">';
			echo '<span style=font-family:verdana;font-size:12px> Halaman: <select name=halaman onchange="javascript:Kirim_Cari1();">';
			echo '<option value="'.$halaman.'" selected="selected">'.$halaman.'</option>';
				for($i = 1; $i <= $jmlhal; $i++)
					if ($i!=$halaman)
					{
						echo '<option values="'.$i.'">'.$i.'</option>';
					}
			echo '</option>';
			echo '</select>';
			echo ' dari '.$jmlhal.' Halaman</span>';
			echo '</span></form>';
					
		?>
        <table border="0" class="tblisi" id="tblisi" style='width:100%; margin-bottom:10px;'>
            <tr>
                <th width="30px" height="20px">NO</th>
                <th>JUDUL BERITA</th>
                <th>KETERANGAN</th>
                <th>NAMA FILE</th>
                <th>TANGGAL</th>
                <th>AKTIVITAS</th>
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
         	<td align="center"><?php echo $i; ?></td>
            <td align="left"><?php echo $bsrt[1]; ?></td>
            <td align="left"><?php if(strlen($bsrt[2] > 20)) echo substr($bsrt[2], 0, 20).'..'; else echo $bsrt[2]; ?></td>
            <td align="left"><?php echo $bsrt[3]; ?></td>
            <td align="center"><?php echo substr($bsrt["4"],8,2).'-'.substr($bsrt["4"],5,2).'-'.substr($bsrt["4"],0,4); ?></td>
            <td align="center"><a href="javascript:Edit_Berita('<?php echo $bsrt[0]; ?>');" class="edit"><img src="./image/button/editdata.gif" title="Klik untuk mengedit data ini" width="16" height="16"></a> <a class="edit" href="./index.php?mod=cp&opt=berita_informasi&opts=validasi&optss=hapus&id_berita=<?php echo $bsrt[0] ?>" onClick="return confirm('Apakah Anda yakin ingin menghapus data ini?' + '\n Judul Berita: ' + '<?php echo $bsrt[1]; ?>' + '\n\n\n' + 'Jika YA silahkan klik OK, Jika TIDAK klik CANCEL.')"><img src="./image/button/deletedata.gif" title="Klik untuk menghapus data ini"  width="16" height="16"></a></td>
         </tr>
         <tr id="tbl-content">
         	<td colspan="10"><div id="div_edit_type_<?php echo $bsrt[0]; ?>"></div></td>
         </tr>
         <?php
		 	$i++;
		 }
		 ?>
        </table>
        </fieldset>
        </td>
        <td background="./images/isi/back_06.jpg" width="32"></td>
        </tr>
        <tr>
        	<td background="./images/isi/back_07.jpg" width="34" height="31"></td>
            <td background="./images/isi/back_08.jpg" height="31"></td>
            <td background="./images/isi/back_09.jpg" width="32" height="31"></td>
        </tr>
	</fieldset>
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
