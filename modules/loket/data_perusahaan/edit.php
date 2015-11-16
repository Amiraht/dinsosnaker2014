<?php
#koneksi
include "../../../libraries/dinsos.php";
//$conn = mysqli_connect("localhost", "root", "", "db_disnakersos");
#akhir-koneksi
 
#ambil data kecamatan
$query = "SELECT id_kecamatan, kecamatan FROM t_kecamatan WHERE id<'22' ORDER BY kecamatan";
$sql = mysqli_query($conn, $query);
$arrkecamatan = array();
while ($row = mysqli_fetch_assoc($sql)) {
	$arrkecamatan [ $row['id_kecamatan'] ] = $row['kecamatan'];
}

#action get kelurahan
if(isset($_GET['action']) && $_GET['action'] == "getKab") {
	$kode_prop = $_GET['kode_prop'];
 
	//ambil data kelurahan
	$query = "SELECT id_kelurahan, kelurahan FROM t_kelurahan WHERE id_kecamatan='$kode_prop' ORDER BY kelurahan";
	$sql = mysqli_query($conn, $query);
	$arrkab = array();
	while ($row = mysqli_fetch_assoc($sql)) {
		array_push($arrkab, $row);
	}
	echo json_encode($arrkab);
	exit;
}
$c = mysql_query("select * from t_jenis_usaha order by jenis asc");
$d = mysql_query("select * from t_status order by status asc");
$e = mysql_query("select * from t_status_milik order by status asc");
$f = mysql_query("select * from t_status_modal order by modal asc");
$g = mysql_query("select kode_bagian,nama_bagian from kbli order by nama_bagian asc");	
	echo "
		<link rel='stylesheet' href='../../../css/button.css' type='text/css' />";
	$id = $_GET["id"];
	$sumber = $_GET["sumber"];
			
	$perusahaan = mysql_query("
							SELECT
									a.id_perusahaan, a.nama, a.alamat,
									a_k.kecamatan, a_kel.kelurahan,
									a.telpon, a.kode_pos,
									a.nomor_akte,a.tgl_pendirian, 
									a_j.jenis, a_s.status,
									a.nama_pemilik, a.nama_pengurus,
									a.alamat_pemilik, a.alamat_pengurus,a_m.status,a_mod.modal,
									a_tbl.wnilk, a_tbl.wnipr, a_tbl.wnalk, a_tbl.wnapr,
									c.nama_bagian, a.klui, 
									a.jenis_usaha, a.id_status_perusahaan,a.id_status_pemilik,
									a.id_status_permodalan,a_k.id_kecamatan, a_kel.id_kelurahan
								FROM
									db_dinsos a
									LEFT JOIN t_jenis_usaha a_j ON a.jenis_usaha = a_j.id_jenis_usaha
									LEFT JOIN t_status_milik a_m ON a.id_status_pemilik = a_m.id_status
									LEFT JOIN t_status_modal a_mod ON a.id_status_permodalan = a_mod.modal
									LEFT JOIN t_status a_s ON a.id_status_perusahaan = a_s.id_status
									LEFT JOIN t_kecamatan a_k ON a.kec = a_k.id_kecamatan
									LEFT JOIN t_kelurahan a_kel ON a.kel = a_kel.id_kelurahan
									LEFT JOIN tbl_tenagakerja_dinsos a_tbl ON a.id_perusahaan = a_tbl.id_perusahaan
									LEFT JOIN kbli c ON a.klui = c.kode_bagian
								WHERE
									a.id_perusahaan = '$id'
							");
	$set = mysql_fetch_array($perusahaan);	
?>
<html>
	<head>
		<title></title>
		<style type="text/css">
		span.inputan { display:block; margin-bottom:5px; }
		span.inputan label { float:left; display:block; width:200px;}
		option{max-width:250px;}
		.style1 {font-family: Arial, Helvetica, sans-serif}
        </style>
        <script type="text/javascript" src="../../../libraries/jquery-1.4.3.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#kecamatan').change(function(){
					$.getJSON('edit.php',{action:'getKab', kode_prop:$(this).val()}, function(json){
						$('#kelurahan').html('');
						$.each(json, function(index, row) {
							$('#kelurahan').append('<option value='+row.id_kelurahan+'>'+row.kelurahan+'</option>');
						});
					});
				});
			});
		</script>
	</head>
	<body>
     <form action="./update_proses.php" method="POST">    
	<table width="100%" border="0" align="center" cellpadding="5" cellspacing="2" style='font-size:12px; font-family:Arial, Helvetica, sans-serif'>
	  <tr>
                 		    <td colspan="7"><h2 class="style1">DATA PERUSAHAAN</h2><hr>                 		  </td>
</tr>
                 		  <tr>
                 		    <td width="20%"><span class="style1 style1">NAMA PERUSAHAAN</span></td>
                 		    <td width="7%"><span class="style1 style1">:</span></td>
<td width="24%">
                            	<span class="style1 style1">
        						<input type='text' name="hidden" style='display:none;'value='<?php echo $set[0] ?>'>
        						<input type='text' name='nama' value="<?php echo strtoupper($set[1]); ?>"/>
                           	</span></td>
                 		    <td width="5%">&nbsp;</td>
                 		    <td width="22%"><span class="style1 style1">NO AKTE PENDIRIAN</span></td>
                 		    <td width="2%"><span class="style1 style1">:</span></td>
                 		    <td width="20%"><input name='no_akte' type='text' class="style1" value="<?php echo $set[7]; ?>"></td>
	  </tr>
                 		  <tr>
                 		    <td><span class="style1 style1">ALAMAT</span></td>
                 		    <td><span class="style1 style1">:</span></td>
                 		    <td><input name='alamat' type='text' class="style1"value='<?php echo $set[2]; ?>'/></td>
                 		    <td>&nbsp;</td>
                 		    <td><span class="style1 style1">TANGGAL PENDIRIAN</span></td>
                 		    <td><span class="style1 style1">:</span></td>
<td>
                            <input name='tgl_diri' type='date' class="style1" value='<?php echo $set[8]; ?>'/></td>
      </tr>
                 		  <tr>
                 		    <td><span class="style1 style1">KECAMATAN</span></td>
                 		    <td><span class="style1 style1">:</span></td>
                            <td><span class="style1 style1">
                              <select id="kecamatan" name="kecamatan">
                                <option value="<?php echo $set[27]; ?>"><?php echo $set[3]; ?></option>
                                <?php
                            foreach ($arrkecamatan as $id_kecamatan=>$kecamatan) {
                                echo "<option value='$id_kecamatan'>$kecamatan</option>";
                            }
                            ?>
                                                  </select>
                            </span>                                                </td>
                            <td>&nbsp;</td>
                 		    <td><span class="style1 style1">JENIS USAHA</span></td>
                 		    <td><span class="style1 style1">:</span></td>
                 		    <td>                 		      <span class="style1 style1">
                 		        <select name="jns_usaha">
                 		                <option value='<?php echo $set[23] ?>'><?php echo $set[9]; ?></option>
                 		          <?php
                            		while($c1 = mysql_fetch_array($c))
										{echo"<option value='$c1[0]'>$c1[1]</option>";};
									?>

               		          </select>
               		        </span>               		          </td>
	  </tr>
                 		  <tr>
                 		    <td><span class="style1 style1">KELURAHAN</span></td>
                 		    <td><span class="style1 style1">:</span></td>
                            <td><span class="style1 style1">
                              <select id="kelurahan" name="kelurahan">
                                <option value='<?php echo $set[28]; ?>'><?php echo $set[4]; ?></option>
                                                  </select>
                            </span>                            </td>
                            <td>&nbsp;</td>
                 		    <td><span class="style1 style1">STATUS USAHA</span></td>
                 		    <td><span class="style1 style1">:</span></td>
                            <td><span class="style1 style1">
                              <select name="status_per">
                                    <option value='<?php echo $set[24]; ?>'><?php echo $set[10]; ?></option>
                                <?php
                            		while($d1 = mysql_fetch_array($d))
										{echo"<option value='$d1[0]'>$d1[1]</option>";};
									?>
                              </select>
                            </span></td>
	  </tr>
                 		    <span class="style1"><span class="style1"></span>
               		          <span class="style1">
           		              <tr>
               		          </span>
               		        
                 		    <span class="style1"></span></span>
                 		  
                 		    <td>No. TELEPON</td>
                 		    <td>:</td>
                 		    <td><input type='text' name='telpon' value="<?php echo $set[5]; ?>" /></td>
                 		    <td>&nbsp;</td>
                 		    <td>KLUI</td>
                 		    <td>:</td>
                 		    <td><select name='klui' selected=selected style='width:100px;'>
								<option value='<?php echo $set[22]; ?>'><?php echo $set[21]; ?><option>
								<?php
									while($g1 = mysql_fetch_array($g))
										{echo"<option value='$g1[0]'>$g1[1]</option>";};
								?>
								
								</td>
               		      <span class="style1"><span class="style1"></span>
           		            <span class="style1">
       		                </tr>
           		            </span>
           		          
               		      <span class="style1"></span></span>
               		    
                 		    <span class="style1"><span class="style1"></span>
               		          <span class="style1">
           		              <tr>
               		          </span>
               		        
                 		    <span class="style1"></span></span>
                 		  
                 		    <td><span class="style1"><span class="style1"></span><span class="style1">KODE POS</span>
                 		    <span class="style1"></span></span>
                 		    </td>
                 		    <td><span class="style1"><span class="style1"></span><span class="style1">:</span>
                 		    <span class="style1"></span></span>
                 		    </td>
                 		    <td><span class="style1"><span class="style1"></span>
               		          <span class="style1">
           		              <input type='text' name='kd_pos'  value="<?php echo $set[6]; ?>"/>
               		          </span>
               		        
                 		    <span class="style1"></span></span>
                 		    </td>
                 		    <td><span class="style1"><span class="style1"></span><span class="style1">&nbsp;</span>
                 		    <span class="style1"></span></span>
                 		    </td>
                 		    <td><span class="style1"><span class="style1"></span><span class="style1">&nbsp;</span>
                 		    <span class="style1"></span></span>
                 		    </td>
                 		    <td><span class="style1"><span class="style1"></span><span class="style1">&nbsp;</span>
                 		    <span class="style1"></span></span>
                 		    </td>
                 		    <td><span class="style1"><span class="style1"></span><span class="style1">&nbsp;</span>
                 		    <span class="style1"></span></span>
                 		    </td>
               		      <span class="style1"><span class="style1"></span>
           		            <span class="style1">
       		                </tr>
           		            </span>
           		          
               		      <span class="style1"></span></span>
               		    
                 		    <span class="style1"><span class="style1"></span>
               		          <span class="style1">
           		              <tr>
               		          </span>
               		        
                 		    <span class="style1"></span></span>
                 		  
                 		    <td colspan="3"><span class="style1"><span class="style1"></span><span class="style1">&nbsp;</span>
                 		    <span class="style1"></span></span>
                 		    </td>
                 		    <td><span class="style1"><span class="style1"></span><span class="style1">&nbsp;</span>
                 		    <span class="style1"></span></span>
                 		    </td>
                 		    <td><span class="style1"><span class="style1"></span><span class="style1">&nbsp;</span>
                 		    <span class="style1"></span></span>
                 		    </td>
                 		    <td><span class="style1"><span class="style1"></span><span class="style1">&nbsp;</span>
                 		    <span class="style1"></span></span>
                 		    </td>
                 		    <td><span class="style1"><span class="style1"></span><span class="style1">&nbsp;</span>
                 		    <span class="style1"></span></span>
                 		    </td>
               		      <span class="style1"><span class="style1"></span>
           		            <span class="style1">
       		                </tr>
           		            </span>
           		          
               		      <span class="style1"></span></span>
               		    
                 		    <span class="style1"><span class="style1"></span>
               		          <span class="style1">
           		              <tr>
               		          </span>
               		        
                 		    <span class="style1"></span></span>
                 		  
                 		    <td colspan="7"><h2><span class="style1"><span class="style1"></span><span class="style1">DATA KEPEMILIKAN</span>
                 		    <span class="style1"></span></span>
                 		    </h2><span class="style1"><span class="style1"></span>
                 		      <span class="style1">
               		          <hr>
                 		      </span>
                 		    
                 		    <span class="style1"></span></span>
                 		      <span class="style1"><span class="style1"></span><span class="style1"><br>
                 		      </span>
                 		      
                 		      <span class="style1"></span></span>
                 		    </td>
               		      <span class="style1"><span class="style1"></span>
           		            <span class="style1">
       		                </tr>
           		            </span>
           		          
               		      <span class="style1"></span></span>
               		    
                 		    <span class="style1"><span class="style1"></span>
               		          <span class="style1">
           		              <tr>
               		          </span>
               		        
                 		    <span class="style1"></span></span>
                 		  
                 		    <td><span class="style1"><span class="style1"></span><span class="style1">PEMILIK</span>
                 		    <span class="style1"></span></span>
                 		    </td>
                 		    <td><span class="style1"><span class="style1"></span><span class="style1">:</span>
                 		    <span class="style1"></span></span>
                 		    </td>
                 		    <td><span class="style1"><span class="style1"></span>
               		          <span class="style1">
           		              <input type='text' name='pemilik' value="<?php echo $set[11]; ?>"/>
               		          </span>
               		        
                 		    <span class="style1"></span></span>
                 		    </td>
                 		    <td><span class="style1"><span class="style1"></span><span class="style1">&nbsp;</span>
                 		    <span class="style1"></span></span>
                 		    </td>
                 		    <td><span class="style1"><span class="style1"></span><span class="style1">STATUS PEMILIK</span>
                 		    <span class="style1"></span></span>
                 		    </td>
                 		    <td><span class="style1"><span class="style1"></span><span class="style1">:</span>
                 		    <span class="style1"></span></span>
                 		    </td>
                 		    <td><span class="style1"><span class="style1"></span>
               		          <span class="style1">
           		              <select name="status_pemilik">
               		          </span>
               		        
                 		    <span class="style1"></span></span>
                 		    
								<option value='<?php echo $set[25]?>'><?php echo $set[15] ?></option>
                 		      <?php
                            		while($e1 = mysql_fetch_array($e))
										{echo"<option value='$e1[0]'>$e1[1]</option>";};
									?>
               		      </select></td>
               		      
          <span class="style1">
          </tr>
            </span>
           		          
      
               		    
                 		  <tr>
                 		    <td><span class="style1 style1">ALAMAT PEMILIK</span></td>
                 		    <td><span class="style1 style1">:</span></td>
                 		    <td><input name='alamat_pemilik' type='text' class="style1" value="<?php echo $set[12]; ?>"/></td>
                 		    <td>&nbsp;</td>
                 		    <td><span class="style1 style1">STATUS PERMODALAN</span></td>
                 		    <td><span class="style1 style1">:</span></td>
                            <td><span class="style1 style1">
                              <select name="status_modal">
                                <option value='<?php echo $set[26]?>'><?php echo $set[16] ?></option>
                                
                                  <?php
                            		while($f1 = mysql_fetch_array($f))
										{echo"<option value='$f1[0]'>$f1[1]</option>";};
									?>
                                </select>
                            </span></td>
	  </tr>
                 		  <tr>
                 		    <td><span class="style1 style1">PENGURUS</span></td>
                 		    <td><span class="style1 style1">:</span></td>
                 		    <td><input name='pengurus' type='text' class="style1" value="<?php echo $set[13]; ?>"/></td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
      </tr>
                 		  <tr>
                 		    <td><span class="style1 style1">ALAMAT PENGURUS</span></td>
                 		    <td><span class="style1 style1">:</span></td>
                 		    <td><input name='alamat_pengurus' type='text' class="style1" value="<?php echo $set[14]; ?>"/></td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
      </tr>
                 		  <tr>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
      </tr>
                 		  <tr>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
      </tr>
						  <tr>
                 		    <td colspan="7"><span class="style1"><br>
                 		    </span>
                 		      <h2 class="style1">DATA TENAGA KERJA</h2><hr>
                 		      <span class="style1"><br>
               		        </span></td>
</tr>
                 		  <tr>
                 		    <td><span class="style1">T.K WNI PRIA</span></td>
                 		    <td><span class="style1">:</span></td>
                 		    <td><input name='wnip' type='text' value="<?php echo $set[17]; ?>"/></td>
                 		    <td><span class="style1"></span></td>
                 		    <td><span class="style1"></span></td>
                 		    <td><span class="style1"></span></td>
                 		    <td><span class="style1"></span></td>
      </tr>
                 		  <tr>
                 		    <td><span class="style1">T.K WNI WANITA</span></td>
                 		    <td><span class="style1">:</span></td>
                 		    <td><input name='wniw' type='text' value="<?php echo $set[18]; ?>"/></td>
                 		    <td><span class="style1"></span></td>
                 		    <td><span class="style1"></span></td>
                 		    <td><span class="style1"></span></td>
                 		    <td><span class="style1"></span></td>
      </tr>
                 		  <tr>
                 		    <td><span class="style1">T.K WNA PRIA</span></td>
                 		    <td><span class="style1">:</span></td>
                 		    <td><input name='wnap' type='text' value="<?php echo $set[19]; ?>" /></td>
                 		    <td><span class="style1"></span></td>
                 		    <td><span class="style1"></span></td>
                 		    <td><span class="style1"></span></td>
                 		    <td><span class="style1"></span></td>
      </tr>
                 		  <tr>
                 		    <td><span class="style1">T.K WNA WANITA</span></td>
                 		    <td><span class="style1">:</span></td>
                 		    <td><input name='wnaw' type='text' value="<?php echo $set[20]; ?>" /></td>
                 		    <td><span class="style1"></span></td>
                 		    <td><span class="style1"></span></td>
                 		    <td><span class="style1"></span></td>
                 		    <td><span class="style1"></span></td>
      </tr>
                 		  <tr>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>	<input type='submit' value='UPDATE PERUSAHAAN' style='margin-right:5px;'></td>
               		    </tr>
           		  </table>
<br>
                 			</form>
               </fieldset>
             </div>
    &nbsp;</td>
  </tr>
	</body>
</html>