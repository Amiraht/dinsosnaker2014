<?php
include "../../../libraries/dinsos.php";
echo "
<link rel='stylesheet' href='../../../css/button.css' type='text/css' />";
	$id = $_GET['id'];
	$sumber = $_GET['sumber'];


	$perusahaan = mysql_query("
							SELECT
									a.id_perusahaan, a.nama, a.alamat,
									a_k.kecamatan, a_kel.kelurahan,
									a.telpon, a.kode_pos,
									a.nomor_akte,a.tgl_pendirian, 
									a_j.jenis, a_s.status,
									a.nama_pemilik, a.alamat_pemilik,
									a.nama_pengurus, a.alamat_pengurus,a_m.status,a_mod.modal,
									a_tbl.wnilk, a_tbl.wnipr, a_tbl.wnalk, a_tbl.wnapr,c.nama_bagian,a.klui
								FROM
									db_dinsos a
									LEFT JOIN t_jenis_usaha a_j ON a.jenis_usaha = a_j.id_jenis_usaha
									LEFT JOIN t_status_milik a_m ON a.id_status_pemilik = a_m.id_status
									LEFT JOIN t_status_modal a_mod ON a.id_status_permodalan = a_mod.id_status
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
<script type="text/javascript">
	function cetak_data(id_p){	
		//var x = '<?php echo "$no_resi"; ?>';
		s = '../../../index.php?mod=loket&opt=cetak&id_p='+id_p;
		window.open(s);
		//parent.document.location.href=s;
		//alert('Cetak ini '+id_p);
	}
	
	
</script>
	<style>
		input[type='text']
		{
			border:hidden;
		}
	</style>
    
	<table width="100%" border="0" align="center" cellpadding="5" cellspacing="2" style='font-size:12px; font-family:Arial; text-transform:uppercase;'>
	  <tr>
	    <td colspan="7"><h3>DATA PERUSAHAAN</h3>
	      <hr />
	      
	      <br/></td>
      </tr>
	  <tr>
	    <td>NAMA PERUSAHAAN</td>
	    <td width="7%">:</td>
	    <td colspan="5" ><input type='hidden' value='<?php echo $set[0] ?>'>
        				<?php echo $set[1]; ?></td>
      </tr>
	  <tr>
	    <td>ALAMAT</td>
	    <td>:</td>
	    <td colspan="5"><?php echo $set[2]; ?></td>
      </tr>
	  <tr>
	    <td>KECAMATAN</td>
	    <td>:</td>
	    <td colspan="5"><?php echo $set[3]; ?></td>
      </tr>
	  <tr>
	    <td>KELURAHAN</td>
	    <td>:</td>
	    <td colspan="5"><?php echo $set[4]; ?></td>
      </tr>
	  <tr>
	    <td>No. TELEPON</td>
	    <td>:</td>
	    <td colspan="5"><?php echo $set[5]; ?></td>
      </tr>
	  <tr>
	    <td>KODE POS</td>
	    <td>:</td>
	    <td colspan="5"><?php echo $set[6]; ?></td>
      </tr>
	  <tr>
	    <td >NO AKTE PENDIRIAN</td>
	    <td width="7%">:</td>
	    <td colspan="5" "><?php echo $set[7]; ?></td>
      </tr>
	  <tr>
	    <td>TANGGAL PENDIRIAN</td>
	    <td>:</td>
	    <td colspan="5"><?php echo $set[8]; ?></td>
      </tr>
	  <tr>
	    <td>JENIS USAHA</td>
	    <td>:</td>
	    <td colspan="5"><?php echo $set[9]; ?></td>
      </tr>
	  <tr>
	    <td>STATUS USAHA</td>
	    <td>:</td>
	    <td colspan="5"><?php echo $set[10]; ?></td>
      </tr>
	  <tr>
	    <td>KLUI</td>
	    <td>:</td>
	    <td colspan="5"><?php echo $set[21]; ?></td>
      </tr>
	  <tr>
	    <td colspan="7"><h3>DATA KEPEMILIKAN</h3>
	      <hr />
	      </td>
      </tr>
	  <tr>
	    <td>PEMILIK</td>
	    <td>:</td>
	    <td colspan="5"><?php echo $set[11]; ?></td>
      </tr>
	  <tr>
	    <td>ALAMAT PEMILIK</td>
	    <td>:</td>
	    <td colspan="5"><?php echo $set[12]; ?></td>
      </tr>
	  <tr>
	    <td>PENGURUS</td>
	    <td>:</td>
	    <td colspan="5"><?php echo $set[13]; ?></td>
      </tr>
	  <tr>
	    <td>ALAMAT PENGURUS</td>
	    <td>:</td>
	    <td colspan="5"><?php echo $set[14]; ?></td>
      </tr>
	  <tr>
	    <td>STATUS PEMILIK</td>
	    <td width="7%">:</td>
	    <td colspan="5"><?php echo $set[15]; ?></td>
      </tr>
	  <tr>
	    <td>STATUS PERMODALAN</td>
	    <td>:</td>
	    <td colspan="5"><?php echo $set[16]; ?></td>
      </tr>      <tr>
	    <td colspan="7"><br />
	      <h3>DATA TENAGA KERJA</h3>
	      <hr />
	      </td>
      </tr>
	  <tr>
	    <td>T.K WNI PRIA</td>
	    <td>:</td>
	    <td><?php echo $set[17]; ?></td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
      </tr>
	  <tr>
	    <td>T.K WNI WANITA</td>
	    <td>:</td>
	    <td><?php echo $set[18]; ?></td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
      </tr>
	  <tr>
	    <td>T.K WNA PRIA</td>
	    <td>:</td>
	    <td><?php echo $set[19]; ?></td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
      </tr>
	  <tr>
	    <td>T.K WNA WANITA</td>
	    <td>:</td>
	    <td><?php echo $set[20]; ?></td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
      </tr>
      <?php
		$enc = base64_encode(base64_encode(base64_encode($id)));
	  	$onc="cetak_data('".$enc."')";
	  ?>      
	  <tr>
	    <td height="34">&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td width="5%">&nbsp;</td>
	    <td>&nbsp;</td>
	    <td width="2%">&nbsp;</td>
		<td>&nbsp;</td>
      </tr><br/><br/>
	  <tr>
		 <td>
			<a href='' title='Cetak Data' onClick=<?=$onc;?> ><img src='../../../image/printer.png' width='65px' height='60px' /></a>	
		 </td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
	  </tr>
    </table>      