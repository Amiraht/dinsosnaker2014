<?php
#koneksi
include "../../../libraries/dinsos.php";
$conn = mysqli_connect("localhost", "root", "", "db_disnakersos");
#akhir-koneksi
 
#ambil data kecamatan
$query = "SELECT id_kecamatan, kecamatan FROM t_kecamatan ORDER BY kecamatan";
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
								b.wnilk, b.wnipr, b.wnalk, b.wnapr, c.nama_bagian, a.klui, 
								a.jenis_usaha, a.id_status_perusahaan,a.id_status_pemilik,
								a.id_status_permodalan,a.kec,a.kel
							FROM
								db_jamsostek a
								LEFT JOIN t_jenis_usaha a_j ON a.jenis_usaha = a_j.id_jenis_usaha
								LEFT JOIN t_status_milik a_m ON a.id_status_pemilik = a_m.id_status
								LEFT JOIN t_status_modal a_mod ON a.id_status_permodalan = a_mod.id_status
								LEFT JOIN t_status a_s ON a.id_status_perusahaan = a_s.id_status
								LEFT JOIN t_kecamatan a_k ON a.kec = a_k.id_kecamatan
								LEFT JOIN t_kelurahan a_kel ON a.kel = a_kel.id_kelurahan
								LEFT JOIN tbl_tenagakerja_jamsos b ON b.id_perusahaan = a.id_perusahaan
								LEFT JOIN kbli c ON a.klui = c.kode_bagian
							WHERE
								a.id_perusahaan = '$id'
							");
	$set = mysql_fetch_array($perusahaan);	
?>
<html>
	<head>
		<title>Manipulasi Combobox dengan Ajax-JQuery</title>
		<style type="text/css">
		span.inputan { display:block; margin-bottom:5px; }
		span.inputan label { float:left; display:block; width:200px;}
		option{max-width:250px;}
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
	<table width="100%" border="0" align="center" cellpadding="5" cellspacing="2" style='font-size:9px;'>
	  <tr>
                 		    <td colspan="7"><h2>DATA PERUSAHAAN</h2><hr>
                 		  </td>
               		    </tr>
                 		  <tr>
                 		    <td width="20%">NAMA PERUSAHAAN</td>
                 		    <td width="7%">:</td>
                 		    <td width="24%">
                            	<input type='text' name="hidden" style='display:none;'value='<?php echo $set[0] ?>'>
        						<input type='text' name='nama' value="<?php echo $set[1]; ?>"/></td>
                 		    <td width="5%">&nbsp;</td>
                 		    <td width="22%">NO AKTE PENDIRIAN</td>
                 		    <td width="2%">:</td>
                 		    <td width="20%"><input type='text' name='no_akte' value="<?php echo $set[7]; ?>"></td>
						</tr>
                 		  <tr>
                 		    <td>ALAMAT</td>
                 		    <td>:</td>
                 		    <td><input type='text' name='alamat'value='<?php echo $set[2]; ?>'/></td>
                 		    <td>&nbsp;</td>
                 		    <td>TANGGAL PENDIRIAN</td>
                 		    <td>:</td>
                 		    <td>
                                <input type='date' name='tgl_diri' value='<?php echo $set[8]; ?>'/></td>
               		    </tr>
                 		  <tr>
                 		    <td>KECAMATAN</td>
                 		    <td>:</td>
                            <td><select id="kecamatan" name="kecamatan">
                            <option value="<?php echo $set[27]; ?>"><?php echo $set[3]; ?></option>
                            <?php
                            foreach ($arrkecamatan as $id_kecamatan=>$kecamatan) {
                                echo "<option value='$id_kecamatan'>$kecamatan</option>";
                            }
                            ?>
		</select>
        </td>
                 		    <td>&nbsp;</td>
                 		    <td>JENIS USAHA</td>
                 		    <td>:</td>
                 		    <td>
                 		      <select name="jns_usaha">
							  <option value='<?php echo $set[23] ?>'><?php echo $set[9]; ?></option>
                              		<?php
                            		while($c1 = mysql_fetch_array($c))
										{echo"<option value='$c1[0]'>$c1[1]</option>";};
									?>
               		          </select>
               		    </td>
               		    </tr>
                 		  <tr>
                 		    <td>KELURAHAN</td>
                 		    <td>:</td>
                 		    <td><select id="kelurahan" name="kelurahan">
								<option value='<?php echo $set[28]; ?>'><?php echo $set[4]; ?></option>
		</select>
                            </td>
                 		    <td>&nbsp;</td>
                 		    <td>STATUS USAHA</td>
                 		    <td>:</td>
                 		    <td><select name="status_per">
								<option value='<?php echo $set[24]; ?>'><?php echo $set[10]; ?></option>
                              		<?php
                            		while($d1 = mysql_fetch_array($d))
										{echo"<option value='$d1[0]'>$d1[1]</option>";};
									?>
               		          </select></td>
               		    </tr>
                 		  <tr>
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
               		    </tr>
                 		  <tr>
                 		    <td>KODE POS</td>
                 		    <td>:</td>
                 		    <td><input type='text' name='kd_pos'  value="<?php echo $set[6]; ?>"/></td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
               		    </tr>
                 		  <tr>
                 		    <td colspan="3">&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
               		    </tr>
                 		  <tr>
                 		    <td colspan="7"><h2>DATA KEPEMILIKAN</h2><hr><br></td>
               		    </tr>
                 		  <tr>
                 		    <td>PEMILIK</td>
                 		    <td>:</td>
                 		    <td><input type='text' name='pemilik' value="<?php echo $set[11]; ?>"/></td>
                 		    <td>&nbsp;</td>
                 		    <td>STATUS PEMILIK</td>
                 		    <td>:</td>
                 		    <td><select name="status_pemilik">
								<option value='<?php echo $set[25]?>'><?php echo $set[15] ?></option>
                 		      <?php
                            		while($e1 = mysql_fetch_array($e))
										{echo"<option value='$e1[0]'>$e1[1]</option>";};
									?>
               		      </select></td>
               		    </tr>
                 		  <tr>
                 		    <td>ALAMAT PEMILIK</td>
                 		    <td>:</td>
                 		    <td><input type='text' name='alamat_pemilik' value="<?php echo $set[12]; ?>"/></td>
                 		    <td>&nbsp;</td>
                 		    <td>STATUS PERMODALAN</td>
                 		    <td>:</td>
                 		    <td><select name="status_modal">
								<option value='<?php echo $set[26]?>'><?php echo $set[16] ?></option>
                 		    
                 		      <?php
                            		while($f1 = mysql_fetch_array($f))
										{echo"<option value='$f1[0]'>$f1[1]</option>";};
									?>
               		      </select></td>
               		    </tr>
                 		  <tr>
                 		    <td>PENGURUS</td>
                 		    <td>:</td>
                 		    <td><input type='text' name='pengurus' value="<?php echo $set[13]; ?>"/></td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
               		    </tr>
                 		  <tr>
                 		    <td>ALAMAT PENGURUS</td>
                 		    <td>:</td>
                 		    <td><input type='text' name='alamat_pengurus' value="<?php echo $set[14]; ?>"/></td>
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
                 		    <td colspan="7"><br><h2>DATA TENAGA KERJA</h2><hr><br></td>
               		    </tr>
                 		  <tr>
                 		    <td>T.K WNI PRIA</td>
                 		    <td>:</td>
                 		    <td><input type='text' name='wnip' value="<?php echo $set[17]; ?>"/></td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
               		    </tr>
                 		  <tr>
                 		    <td>T.K WNI WANITA</td>
                 		    <td>:</td>
                 		    <td><input type='text' name='wniw' value="<?php echo $set[18]; ?>"/></td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
               		    </tr>
                 		  <tr>
                 		    <td>T.K WNA PRIA</td>
                 		    <td>:</td>
                 		    <td><input type='text' name='wnap' value="<?php echo $set[19]; ?>" /></td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
                 		    <td>&nbsp;</td>
               		    </tr>
                 		  <tr>
                 		    <td>T.K WNA WANITA</td>
                 		    <td>:</td>
                 		    <td><input type='text' name='wnaw' value="<?php echo $set[20]; ?>" /></td>
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