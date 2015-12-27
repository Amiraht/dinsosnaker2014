<?php
	$a = mysql_query("select * from t_jenis_usaha order by jenis asc");
	$b = mysql_query("select * from t_status order by status asc");
	$c = mysql_query("select * from t_status_milik order by status asc");
	$d = mysql_query("select * from t_status_modal order by modal asc");
	$e = mysql_query("select * from kbli order by kode_bagian");
	//$conn = mysqli_connect("localhost", "root", "", "db_disnakersos");

	#ambil data kecamatan
	$query = "SELECT id_kecamatan, kecamatan FROM t_kecamatan WHERE id<'22' ORDER BY kecamatan";
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
		var b =document.cari_p.stat_usaha.value;
		var c =document.cari_p.stat_modal.value;
		var d =document.cari_p.jenis.value;
		var e =document.cari_p.kelurahan.value;
		var f =document.cari_p.kecamatan.value;
		var g =document.cari_p.tgl.value;
		var h =document.cari_p.klui.value;
		var s;
		s='index.php?mod=loket&opt=data_perusahaan';	
		//if(y != '')
		s=s+'&cari='+a+'&usaha='+b+'&modal='+c+'&jenis='+d+'&kel='+e+'&kec='+f+'&tgl='+g+'&klui='+h;
		document.location.href=s;
	}
	
	function lihat_detail(c,d)
	{
		var t=document.getElementById("div_detail_"+c);
		if(t.innerHTML != '')
			t.innerHTML = '';
		else
			t.innerHTML='<iframe src="./modules/loket/data_perusahaan/detail2.php?id='+c+'&sumber='+d+'&hidden=b" width="100%" style="height:1000px; padding-bottom:10px;" frameborder="0" scrolling="yes" id="iframe_detail"></iframe>';
	}
	
	function edit(c,d)
	{
		var t=document.getElementById("div_detail_"+c);
		if(t.innerHTML != '')
			t.innerHTML = '';
		else
			t.innerHTML='<iframe src="./modules/loket/data_perusahaan/edit.php?id='+c+'&sumber='+d+'&hidden=b" width="100%" style=" height:1300px; padding-bottom:10px;" frameborder="0" scrolling="yes" id="iframe_detail"></iframe>';
	}

	function Kirim_Cari()
	{
		var y ='<?php echo $_GET["halaman"]; ?>';
		var s;
		s='index.php?mod=loket&opt=data_perusahaan';
		//s='agenda_masuk.php?opts=view';
		if(y>1)
			s=s+'&halaman=1';
		if (document.fcari.nama.value!='')
		{
			s=s+'&nama='+document.fcari.nama.value;
		}		
		if (document.fcari.klui.value!='')
		{
			s=s+'&klui='+document.fcari.klui.value;
		}
		if (document.fcari.jenis.value!='0')
		{
			s=s+'&jenis='+document.fcari.jenis.value;
		}	
		if (document.fcari.stat_modal.value!='0')
		{
			s=s+'&stat_modal='+document.fcari.stat_modal.value;
		}	
		if (document.fcari.stat_milik.value!='')
		{
			s=s+'&stat_milik='+document.fcari.stat_milik.value;
		}
		if (document.fcari.kecamatan.value!='')
		{
			s=s+'&kecamatan='+document.fcari.kecamatan.value;
		}
		if (document.fcari.kelurahan.value!='')
		{
			s=s+'&kelurahan='+document.fcari.kelurahan.value;
		}
		document.location.href=s;
	}
	function Kirim_Cari1()
	{
		var tgl ='<?php echo $_GET["tgl"]; ?>';
		var nama ='<?php echo $_GET["nama"]; ?>';
		var klui ='<?php echo $_GET["klui"]; ?>';
		var stat_usaha ='<?php echo $_GET["stat_usaha"]; ?>';
		var stat_milik ='<?php echo $_GET["stat_milik"]; ?>';
		var stat_modal ='<?php echo $_GET["stat_modal"]; ?>';
		var jenis ='<?php echo $_GET["jenis"]; ?>';
		var kecamatan ='<?php echo $_GET["kecamatan"]; ?>';
		var kelurahan ='<?php echo $_GET["kelurahan"]; ?>';


		var s;
		s='index.php?mod=loket&opt=data_perusahaan';
		//s='agenda_masuk.php?opts=view';
		if(nama != '')
			s=s+'&nama='+nama;
		if(klui != '')
			s=s+'&klui='+klui;
		if(stat_usaha != '')
			s=s+'&stat_usaha='+stat_usaha;
		if(stat_milik != '')
			s=s+'&stat_milik='+stat_milik;
		if(stat_modal != '')
			s=s+'&stat_modal='+stat_modal;
		if(jenis != '')
			s=s+'&jenis='+jenis;
		if(kecamatan != '')
			s=s+'&kecamatan='+kecamatan;
		if(kelurahan != '')
			s=s+'&kelurahan='+kelurahan;																					
		s=s+'&halaman='+document.f2.halaman.value;
		document.location.href=s;
	}
</script>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
  <tr >
    <td colspan="2"><div id='header' style='background:url(./image/coba/header2.png) no-repeat;'> 
      <table border="0" id='atasan'">
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00; href="#"><b>LIHAT DATA PERUSAHAAN</b></a></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='index.php?mod=loket&opt=main'> <span></span> BERANDA UTAMA LOGIN LOKET </a>
                     <span> </span> <img src="./image/panah.gif" /> <span> </span> LIHAT DATA PERUSAHAAN
                     </td>
                     	
            </tr>
        </table>
    
    </div>
    </td>
    </tr>
    <tr>
 <td style="float:right;">
					<img width="90" height="29" 
						onclick="document.location.href='./index.php?mod=loket&opt=main'" 
						onmouseout="this.src='./image/button/KEMBALI.gif'" 
						onmouseover="this.src='./image/button/KEMBALI2.gif'" 
						src="./image/button/KEMBALI.gif">
					</img>
    			</td>
</tr>
<tr><td>&nbsp; </td></tr>
  <tr>
    <td colspan="2">  
    		<div id='content' style='margin-left:2%; margin-bottom:20px;width:98%;'>
                 <br>
                <fieldset>
                    <legend>FILTER</legend>
                   <form method='POST' name='fcari'>
                        <table border="0" cellpadding="3">
                        	<tr>
                            	<td width="160px">NAMA PERUSAHAAN</td>
                            	
                            	<td>: <input type='text' name='nama' placeholder='Cari Nama Perusahaan' /></td>
                            	<td width="10px">&nbsp;</td>
                                  <td>JENIS PERUSAHAAN</td>
                                  
                                  <td>: <select name="jenis">
                                    <option value='0'>CARI SEMUA</option>
                                    <?php
                                                while($a1 = mysql_fetch_array($a))
                                                    {echo"<option value='$a1[0]'>$a1[1]</option>";};
                                                ?>
                                </select></td>                                
                            </tr>                            
                        	<tr>
                        	  <td>KLUI</td>
                        	  <td>: <select name="klui">
                        	    <option value="0">SEMUA</option>
                        	    <?php
									while($e1 = mysql_fetch_array($e))
										{echo"<option value='$e1[2]'>$e1[2]"."-"."$e1[3]</option>";};
									?>
                              </select></td>                              
                        	  <td>&nbsp;</td>
                        	  <td>STATUS USAHA</td>
                        	  <td>: <select name="stat_usaha">
                        	    <option value="0">SEMUA</option>
                        	    <?php
									while($b1 = mysql_fetch_array($b))
										{echo"<option value='$b1[1]'>$b1[1]</option>";};
									?>
                              </select></td>
                   	      	</tr>
                        	<tr>
                        	  <td>KECAMATAN</td>
                        	  <td>: <select name="kecamatan" id='kecamatan'>
                        	    <option value="0">SEMUA</option>
                        	    <?php 
									 foreach ($arrkecamatan as $id_kecamatan=>$kecamatan) {
										echo "<option value='$id_kecamatan'>$kecamatan</option>";
									}
								?>
                      	    </select></td>
                        	  <td>&nbsp;</td>
                        	  <td>STATUS PEMILIK</td>
                        	  <td>: <select name="stat_milik">
                        	    <option value="0">SEMUA</option>
                        	    <?php 
									while($d1 = mysql_fetch_array($d))
										{echo"<option value='$d1[0]'>$d1[1]</option>";};
								?>
                      	    </select></td>
                   	      </tr>
                        	<tr>
                        	  <td>KELURAHAN</td>
                        	  <td>: 
                        	    <select name="kelurahan" id='kelurahan'>
                                  <option value="0">SEMUA</option>
                                </select></td>
                        	  <td>&nbsp;</td>
                        	  <td>STATUS MODAL</td>
                        	  <td>: 
                        	    <select name="stat_modal">
                                  <option value="0">SEMUA</option>
                                  <?php 
									while($c1 = mysql_fetch_array($c))
										{echo"<option value='$c1[0]'>$c1[1]</option>";};
								?>
                                </select></td>
                        	  
                       	  </tr>
                        	</tr>
                            <tr id='detail' align="center">
                            
                             <td colspan="5">&nbsp;</td></tr>
                            
                            
                      	  </tr>
                            <tr id='detail' align="center">
                            
                             <td colspan="5"  align="center"><span align="center" style="padding-top:5px;">
                               <input type='button' value='CARI PERUSAHAAN' onclick='Kirim_Cari();' />
                             </span></td>
                             
                          </tr>
                          
                        </table>
                        <br />
                    </form>
                </fieldset>
   		    <br><br>
            <fieldset>
            <legend>LIHAT DATA PERUSAHAAN</legend> 
 <?php
 
 	if(!empty($_GET["tgl"]) || !empty($_GET["nama"]) || !empty($_GET["klui"]) || !empty($_GET["jenis"]) || !empty($_GET["stat_milik"]) || !empty($_GET["stat_modal"])  || !empty($_GET["stat_usaha"]) || !empty($_GET["kecamatan"]) || !empty($_GET["kelurahan"])) 
	{
		$up = '';
		$ada = 1;
		if(!empty($_GET["tgl"]))
		{
			if($ada > 1){
				$up = $up." and ";
				}
			$up = $up." tgl_pendirian ='".$_GET["tgl1"]."'";
			$ada++;
		}

		if(!empty($_GET["nama"]))
		{
			if($ada > 1){
				$up = $up." and ";
				}
			$up = $up." nama like '%".$_GET["nama"]."%'";
			$ada++;
		}
		if(!empty($_GET["klui"]))
		{
			if($ada > 1){
				$up = $up." and ";
				}
			$up = $up." klui='".$_GET["klui"]."'";
			$ada++;
		}
		if(!empty($_GET["jenis"]))
		{
			if($ada > 1){
				$up = $up." and ";
				}
			$up = $up." jenis_usaha like '%".$_GET["jenis"]."%'";
			$ada++;
		}
		if(!empty($_GET["stat_milik"]))
		{
			if($ada > 1){
				$up = $up." and ";
				}
			$up = $up." id_status_pemilik like '%".$_GET["stat_milik"]."%'";
			$ada++;
		}
		if(!empty($_GET["stat_modal"]))
		{
			if($ada > 1){
				$up = $up." and ";
				}
			$up = $up." id_status_permodalan like '%".$_GET["stat_modal"]."%'";
			$ada++;
		}
		if(!empty($_GET["stat_usaha"]))
		{
			if($ada > 1){
				$up = $up." and ";
				}
			$up = $up." id_status_perusahaan like '%".$_GET["stat_usaha"]."%'";
			$ada++;
		}
		if(!empty($_GET["kelurahan"]))
		{
			if($ada > 1){
				$up = $up." and ";
				}
			$up = $up." kel like '%".$_GET["kelurahan"]."%'";
			$ada++;
		}
		if(!empty($_GET["kecamatan"]))
		{
			if($ada > 1){
				$up = $up." and ";
				}
			$up = $up." kec like '%".$_GET["kecamatan"]."%'";
			$ada++;
		}										

	}
       	//echo $up;
 	if(!empty($_GET["tgl"]) || !empty($_GET["nama"]) || !empty($_GET["klui"]) || !empty($_GET["jenis"]) || !empty($_GET["stat_milik"]) || !empty($_GET["stat_modal"]) || !empty($_GET["stat_usaha"]) || !empty($_GET["kecamatan"]) || !empty($_GET["kelurahan"])) 
			{
				$jlh_data = mysql_query("select count(id_perusahaan) as jumlah from vw_dinsos where id_perusahaan  is not null and ".$up."");
			}
		else
				$jlh_data = mysql_query("select count(id_perusahaan) as jumlah from vw_dinsos");
							
			$hsl = mysql_fetch_array($jlh_data);
			
			$batas = 20;
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

 	if(!empty($_GET["tgl"]) || !empty($_GET["nama"]) || !empty($_GET["klui"]) || !empty($_GET["jenis"]) || !empty($_GET["stat_milik"]) || !empty($_GET["stat_modal"]) || !empty($_GET["stat_usaha"]) || !empty($_GET["kecamatan"]) || !empty($_GET["kelurahan"])) 
			{
				$qsrt = mysql_query("select id_perusahaan,nama,jenis,klui,alamat,nama_bagian from vw_dinsos where id_perusahaan  is not null and ".$up." order by nama asc limit ".$posisi.",".$batas."");
			}
			else
				$qsrt = mysql_query("select id_perusahaan,nama,jenis,klui,alamat,nama_bagian from vw_dinsos order by nama asc limit ".$posisi.",".$batas."");
	
			echo '<form name=f2><span>';
			echo '<span ><BR>HALAMAN: <select name=halaman onchange="javascript:Kirim_Cari1();">';
			echo '<option value="'.$halaman.'" selected="selected">'.$halaman.'</option>';
				for($i = 1; $i <= $jmlhal; $i++)
					if ($i!=$halaman)
					{
						echo '<option values="'.$i.'">'.$i.'</option>';
					}
			echo '</option>';
			echo '</select>';
			echo ' DARI '.$jmlhal.' HALAMAN </span>';
			echo '</span></form>';
									
?> 
                           
         <table width='100%'><tr><td style='text-align:right;'><!--<a href='index.php?mod=menu&do=down' >Cetak</a>--></td></tr></table>
<br>
<table border='1' class='tblisi' style='width:100%; margin-bottom:10px;'>
	<tr>
		<th>NO</th>
		<th>NAMA PERUSAHAAN</th>
		<th>JENIS PERUSAHAAN</th>
		<th>KLUI</th>
		<th>ALAMAT</th>
		<th colspan='3' >AKTIVITAS</th>
	</tr>
<?php 
	if(mysql_num_rows($qsrt) == '')
	{
	echo "<tr>
			<td  colspan='7'>DATA TIDAK DITEMUKAN</td>
		 </tr>";
	}
	
		$i=1;
		while($set = mysql_fetch_array($qsrt))
		{
		echo "
		<tr>
			<td> ".($posisi+$i)."</td>
			<td> $set[1] </td>
			<td> $set[2] </td>
			<td> $set[3]-$set[5] </td>
			<td> $set[4]</td>
			<td  width='35px'> <a href='javascript:lihat_detail($set[0],\"DINSOSNAKER\");'>LIHAT</a> </td>
			<td align='center' width='35px'> <a href='javascript:edit($set[0],\"DINSOSNAKER\");'>EDIT</a> </td>";
	?>
			<td width='40px'> 
            	<a href="./modules/loket/data_perusahaan/hapus.php?optss=hapus&id=<?php echo $set[0]; ?>" onClick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
			HAPUS</a></td>
	<?php echo"
		</tr>
		<tr>
			<td align='center'   id='div_detail_".$set[0]."' colspan='8' style='background:white;'>
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
  	<td colspan="2"><div id='footer'  style='background:url(./image/coba/footer.png) no-repeat; height:80px; margin-left:8px;'></div>
    </td>
  </tr>
</table>