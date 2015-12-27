<?php
	$a = mysql_query("select * from t_jenis_usaha order by jenis asc");
	$b = mysql_query("select * from t_status order by status asc");
	$c = mysql_query("select * from t_status_milik order by status asc");
	$d = mysql_query("select * from t_status_modal order by modal asc");
	$g = mysql_query("select kode_bagian, nama_bagian from kbli order by nama_bagian asc");
	//$conn = mysqli_connect("localhost", "root", "", "db_disnakersos");

	#ambil data kecamatan
	$query = "SELECT id_kecamatan, kecamatan FROM t_kecamatan WHERE id<=21 ORDER BY kecamatan";
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
		var i =document.cari_p.stat_milik.value;
		var j =document.cari_p.rekap.value;
		var s;
		s='index.php?mod=jamsostek&do=data_perusahaan_lap';	
		s=s+'&cari='+a+'&usaha='+b+'&modal='+c+'&jenis='+d+'&kel='+e+'&kec='+f+'&tgl='+g+'&klui='+h+'&stat_milik='+i+'&rekap='+j;
		document.location.href=s;
	}
	
	function lihat_detail(c,d)
	{
		var t=document.getElementById("div_detail_"+c);
		if(t.innerHTML != '')
			t.innerHTML = '';
		else
			t.innerHTML='<iframe src="./modules/jamsos/data_perusahaan/detail2.php?id='+c+'&sumber='+d+'&hidden=b" width="100%" style="height:1000px" frameborder="0" scrolling="no" id="iframe_detail"></iframe>';
	}
	
	function edit(c,d)
	{
		var t=document.getElementById("div_detail_"+c);
		if(t.innerHTML != '')
			t.innerHTML = '';
		else
			t.innerHTML='<iframe src="./modules/jamsos/data_perusahaan/edit.php?id='+c+'&sumber='+d+'&hidden=b" width="100%" style="height:1300px" frameborder="0" scrolling="no" id="iframe_detail"></iframe>';
	}
	
	function Kirim_cari1()
	{
		var a ='<?php echo $_GET["cari"] ?>';
		var b='<?php echo $_GET["usaha"] ?>';
		var c ='<?php echo $_GET["modal"] ?>';	
		var d ='<?php echo $_GET["jenis"] ?>';
		var e ='<?php echo $_GET["kel"] ?>';
		var f ='<?php echo $_GET["kec"] ?>';
		var g ='<?php echo $_GET["tgl"] ?>';
		var h ='<?php echo $_GET["klui"] ?>';
		var i ='<?php echo $_GET["stat_milik"] ?>';
		var s;
		var halaman = document.f2.halaman.value;
		//alert(halaman);
		
		s = 'index.php?mod=jamsostek&do=data_perusahaan_lap';	
		if(a != '')
			s=s+'&cari='+a;
		if(b != '')
			s=s+'&usaha='+b;
		if(c != '')
			s=s+'&modal='+b;
		if(d != '')
			s=s+'&jenis='+d;
		if(e != '')
			s=s+'&kel='+e;
		if(f != '')
			s=s+'&kec='+f;
		if(g != '')
			s=s+'&tgl='+g;
		if(h != '')
			s=s+'&klui='+h;	
		if(i != '')
			s=s+'&stat_milik='+i;																													
		s=s+'&halaman='+halaman;
		document.location.href=s;
	}
</script>

<?php
	$filter = "nama LIKE '%" . $_GET["cari"] . "%' ";
						if(isset($_GET["jenis"]) && $_GET["jenis"] != "0")
							$filter .= "AND jenis_usaha = '" . $_GET["jenis"] . "'";
						if(isset($_GET["modal"]) && $_GET["modal"] != "0")
							$filter .= "AND id_status_permodalan = '" . $_GET["modal"] . "'";
						if(isset($_GET["stat_milik"]) && $_GET["stat_milik"] != "0")
							$filter .= "AND id_status_pemilik = '" . $_GET["stat_milik"] . "'";
						if(isset($_GET["usaha"]) && $_GET["usaha"] != "0")
							$filter .= "AND id_status_perusahaan = '" . $_GET["usaha"] . "'";
						if(isset($_GET["kec"]) && $_GET["kec"] != "0")
							$filter .= "AND kec = '" . $_GET["kec"] . "'";
						if(isset($_GET["kel"]) && $_GET["kel"] != "0")
							$filter .= "AND kel = '" . $_GET["kel"] . "'";
						if(isset($_GET["tgl"]) && $_GET["tgl"] != "0" && $_GET["tgl"] != "")
							$filter .= "AND tgl_pendirian = '" . $_GET["tgl"] . "'";
						if(isset($_GET["klui"]) && $_GET["klui"] != "" && $_GET["klui"] != "0")
							$filter .= "AND klui = '" . $_GET["klui"] . "'";
							
	//$data2 = "select * from db_jamsostek where $filter order by nama";
	//$sql = mysql_query($data2);

?>
<style type="text/css">
<!--
.style1 {color: #999999}
-->
</style>


<table width="1024" border="0" cellspacing="1" cellpadding="5">
  <tr >
    <td colspan="2"><div id='header' style='background:url(./image/coba/header2.png) no-repeat;'> 
      <table border="0" id="atasan">
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00;" href="#"><b> REKAP DATA PERUSAHAAN</b></a></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='index.php?mod=jamsostek&do=laporan'> <span></span> LAPORAN-LAPORAN </a>
                     <span> </span> <img src="./image/panah.gif" /> <span> </span> LAPORAN DATA PERUSAHAAN
                     </td>
                     	
            </tr>
        </table>
    
    </div>
    </td>
    </tr>
    <tr><td style="float:right; margin-right:1%">
				<img width="90" height="29" 
                    onclick="document.location.href='index.php?mod=jamsostek&do=laporan'" 
                    onmouseout="this.src='./image/button/KEMBALI.gif'" 
                    onmouseover="this.src='./image/button/KEMBALI2.gif'" 
                    src="./image/button/KEMBALI.gif">
                </img>
    			</td></tr>
  <tr><td>&nbsp;</td></tr>
  <tr>
    <td colspan="2">  
    		<div id="content" style=" margin-left:2%; margin-bottom:20px;width:97%;">
                 <br>
                <fieldset >
                    <legend>FILTER</legend>
                   <form method='POST' name='cari_p'>
                        <table border="0" cellpadding="3">    
                        	<tr>
                            	<td width="243">JENIS LAPORAN</td>
                            	<td width="148"><select name="rekap" id='rekap'>
                        	    				<option value="0">DETAIL</option>
                                                <option value="1">REKAPITULASI</option>
                                                </select></td>
                            	<td width="201"></td>
                            	<td width="233"></td>
                            </tr>                                         
                        	<tr>
                            	<td width="243">NAMA PERUSAHAAN</td>
                            	<td width="148"><input type='text' name='cari' placeholder='Nama Perusahaan' /></td>
                            	<td width="201">TANGGAL PENDAFTARAN</td>
                            	<td width="233"><input type='date' name='tgl'>
                           	    <span class="style1">format tanggal : yyyy-mm-dd</span></td>
                            </tr>
                        	<tr>
                        	  <td>KLUI</td>
                        	  <td><select name='klui'/>
									<option value='0'>SEMUA</option>
									<?php
									while($g1 = mysql_fetch_array($g))
										{echo"<option value='$g1[0]'>$g1[1]</option>";};
									?>
								</select>							  </td>
                        	  <td>STATUS KANTOR</td>
                        	  <td><select name="stat_usaha">
                        	    <option value="0">SEMUA</option>
                        	    <?php
									while($b1 = mysql_fetch_array($b))
										{echo"<option value='$b1[0]'>$b1[1]</option>";};
									?>
                      	    </select></td>
                   	      </tr>
                        	<tr>
                        	  <td>KECAMATAN</td>
                        	  <td><select name="kecamatan" id='kecamatan'>
                        	    <option value="0">SEMUA</option>
                        	    <?php 
									 foreach ($arrkecamatan as $id_kecamatan=>$kecamatan) {
										echo "<option value='$id_kecamatan'>$kecamatan</option>";
									}
								?>
                      	    </select></td>
                        	  <td>STATUS PEMILIK</td>
                        	  <td><select name="stat_milik">
                        	    <option value="0">SEMUA</option>
                        	    <?php 
									while($c1 = mysql_fetch_array($c))
										{echo"<option value='$c1[1]'>$c1[1]</option>";};
								?>
                      	    </select></td>
                   	      </tr>
                        	<tr>
                        	  <td>KELURAHAN</td>
                        	  <td><select name="kelurahan" id='kelurahan'>
                        	    <option value="0">SEMUA</option>
                      	    </select></td>
                        	  <td>STATUS MODAL</td>
                        	  <td><select name="stat_modal">
                        	    <option value="0">SEMUA</option>
                        	    <?php 
									while($d1 = mysql_fetch_array($d))
										{echo"<option value='$d1[0]'>$d1[1]</option>";};
								?>
                      	    </select></td>
                   	      </tr>
                        	<tr>
                        	  <td>JENIS PERUSAHAAN</td>
                        	  <td><select name="jenis">
                        	    <option value='0'>SEMUA</option>
                        	    <?php
											while($a1 = mysql_fetch_array($a))
												{echo"<option value='$a1[0]'>$a1[1]</option>";};
											?>
                      	    </select></td>
                        	  <td>&nbsp;</td>
                        	  <td>&nbsp;</td>
                      	  </tr>
                            <tr id='detail'>
                            <td colspan="4"><br/><p align="center">
                              <input type='button' value='CARI PERUSAHAAN' onclick="cari_per();" /></p>
                            </span></td>
                            </tr>
                        </table>
                     <br />
                    </form>
                </fieldset>
   		    <br><br>
            <fieldset>
            <legend>DATA PERUSAHAAN</legend> 
 <?php
    

			$jlh_data = mysql_query("select count(id_perusahaan) as jumlah from db_jamsostek where $filter");
							
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
			 
			if($_GET["rekap"]=='1')
			{
				echo 'HASIL REKAPITULASI = '.$jmldata ;
			}
			else
			{
			
			
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
				//echo $data2;
				$data = "SELECT
									a.id_perusahaan, a.nama, a.alamat,
									a_k.kecamatan, a_kel.kelurahan,
									a.telpon, a.kode_pos,
									a.nomor_akte,a.tgl_pendirian, 
									a_j.jenis, a_s.status,
									a.nama_pemilik, a.nama_pengurus,
									a.alamat_pemilik, a.alamat_pengurus,a_m.status,a_mod.modal,
									a_tbl.wnilk, a_tbl.wnipr, a_tbl.wnalk, a_tbl.wnapr, c.nama_bagian ,a.klui
								FROM
									db_jamsostek a
									LEFT JOIN t_jenis_usaha a_j ON a.jenis_usaha = a_j.id_jenis_usaha
									LEFT JOIN t_status_milik a_m ON a.id_status_pemilik = a_m.id_status
									LEFT JOIN t_status_modal a_mod ON a.id_status_permodalan = a_mod.id_status
									LEFT JOIN t_status a_s ON a.id_status_perusahaan = a_s.id_status
									LEFT JOIN t_kecamatan a_k ON a.kec = a_k.id_kecamatan
									LEFT JOIN t_kelurahan a_kel ON a.kel = a_kel.id_kelurahan
									LEFT JOIN tbl_tenagakerja_jamsos a_tbl ON a.id_perusahaan = a_tbl.id_perusahaan
									LEFT JOIN kbli c ON a.klui = c.kode_bagian
									where $filter
									order by nama asc 
									limit ".$posisi.",".$batas."";
				$graa = mysql_query($data);
				
				
				/*		if(isset($_GET["jenis"]) && $_GET["jenis"] != "0")
							$filter .= "AND jenis_usaha = '" . $_GET["jenis"] . "'";
						if(isset($_GET["modal"]) && $_GET["modal"] != "0")
							$filter .= "AND id_status_permodalan = '" . $_GET["modal"] . "'";
						if(isset($_GET["stat_milik"]) && $_GET["stat_milik"] != "0")
							$filter .= "AND id_status_pemilik = '" . $_GET["stat_milik"] . "'";
						if(isset($_GET["usaha"]) && $_GET["usaha"] != "0")
							$filter .= "AND id_status_perusahaan = '" . $_GET["usaha"] . "'";
						if(isset($_GET["kec"]) && $_GET["kec"] != "0")
							$filter .= "AND kec = '" . $_GET["kec"] . "'";
						if(isset($_GET["kel"]) && $_GET["kel"] != "0")
							$filter .= "AND kel = '" . $_GET["kel"] . "'";
						if(isset($_GET["tgl"]) && $_GET["tgl"] != "0" && $_GET["tgl"] != "")
							$filter .= "AND tgl_pendirian = '" . $_GET["tgl"] . "'";
						if(isset($_GET["klui"]) && $_GET["klui"] != "" && $_GET["klui"] != "0")
							$filter .= "AND klui = '" . $_GET["klui"] . "'";	*/			
				
		$ref='./modules/jamsos/laporan/print_excel.php?';

		$ref=$ref.'cari='.$_GET["cari"];
			if(isset($_GET["jenis"]))
			$jenis=$_GET["jenis"];
			else
			$jenis=0;
		$ref=$ref.'&jenis_usaha='.$jenis;
			if(isset($_GET["modal"]))
			$modal=$_GET["modal"];
			else
			$modal=0;		
		
		$ref=$ref.'&modal='.$modal;
			if(isset($_GET["stat_milik"]))
			$stat_milik=$_GET["stat_milik"];
			else
			$stat_milik=0;		
		
		$ref=$ref.'&stat_milik='.$stat_milik;
			if(isset($_GET["usaha"]))
			$usaha=$_GET["usaha"];
			else
			$usaha=0;		
		
		$ref=$ref.'&usaha='.$usaha;
			if(isset($_GET["kec"]))
			$kec=$_GET["kec"];
			else
			$kec=0;		
		
		$ref=$ref.'&kec='.$kec;
			if(isset($_GET["kel"]))
			$kel=$_GET["kel"];
			else
			$kel=0;		
		
		$ref=$ref.'&kel='.$kel;
		
			if(isset($_GET["tgl"]))
			$tgl=$_GET["tgl"];
			else
			$tgl=0;		
		$ref=$ref.'&tgl='.$tgl;
		
			if(isset($_GET["klui"]))
			$klui=$_GET["klui"];
			else
			$klui=0;		
		
		$ref=$ref.'&klui='.$klui;
	
		
		$ref=$ref.'&posisi='.$posisi;
		$ref=$ref.'&lim='.$batas;
						
	?> 
							   
			 <table width='100%'><tr><td style='text-align:right;'>
			 <a href='<?php echo $ref; ?>'>CETAK</a></td></tr></table> 
			 <br>
				<table border='1' class='tblisi' style='width:100%; margin-bottom:10px;'>
					 <tr>
						<th height="27px">NO</th>
						<th>NAMA PERUSAHAAN</th>
						<th>JENIS PERUSAHAAN</th>
						<th>KLUI</th>
						<th>ALAMAT</th>
						<th colspan='3' width='120px'>AKTIVITAS</th>
					</tr>
	<?php 
		if(mysql_num_rows($graa) == '')
		{
		echo "<tr>
				<td  colspan='7' style='text-align:center;'>DATA TIDAK DITEMUKAN</td>
			 </tr>";
		}
		
			$i=1;
			while($set = mysql_fetch_array($graa))
			{
			echo "
			<tr>
				<td> ".($posisi+$i)."</td>
				<td> $set[1] </td>
				<td> $set[9] </td>
				<td> $set[21] </td>
				<td> $set[2]</td>
				<td style='text-align:center;' width='35px'><p align='center'> <a href='javascript:lihat_detail($set[0],\"JAMSOSTEK\");'>LIHAT DETAIL</a></p> </td>";
			echo"
			</tr>
			<tr>
				<td id='div_detail_".$set[0]."' colspan='8' style='background:white;'>
				</td>
			</tr>
			";
			$i++;
			}
		}
	?>
    		</table>
    <br>
    </fieldset>
    </div></td>
  </tr>
  <tr>
  	<td colspan="2"><div id='footer'  style='background:url(./image/coba/footer.png) no-repeat; height:80px; margin-left:8px;'></div>
    </td>
  </tr>
</table>