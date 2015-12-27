<script type="text/javascript">
	function cetak_data(id_p,sumber){
	//var x = '<?php echo "$no_resi"; ?>';
<<<<<<< HEAD
		s = '../../../index.php?mod=loket&opt=cetak_potensial&sumber='+sumber+'&id_p='+id_p;
		alert(s);
		//window.open(s);
		//parent.document.location.href=s;
	}
	
	function cetak_dulu_bro(id, sumber){
		alert("ID : " + id + " sumber : " + sumber);
	}
=======
	s='../../../index.php?mod=loket&opt=cetak_potensial&sumber='+sumber+'&id_p='+id_p;
		parent.window.open(s, '_blank');
		//parent.document.location.href=s;
	}
>>>>>>> 61b16164dbc53b4bcbd8d4faadd081d2b93a07d3
</script>

<?php
include "../../../libraries/dinsos.php";
echo "
<link rel='stylesheet' href='../../../css/button.css' type='text/css' />";
	$id = $_GET['id'];
	$sumber = $_GET['sumber'];
	
	if($sumber=='BPPT')
		{	$perusahaan = mysql_query("
							SELECT 
						a.id,a.nama, a.alamat, b.kecamatan, c.kelurahan,  
						a.notelp, a.kodepos, a.no_akte, a.tgl_akte, 
						 e.`status`,  a.`status` as 'Status Perusahaan', 
						a.pemohon, a.tempat1, a.pengurus, a.tempat2, 
						a.status_milik,a.status_modal,
						'-' as wnilk, '-' as wnipr, '-' as wnalk, '-' as wnapr,
						d.nama_bagian as klui
						FROM bppt a 
						LEFT JOIN t_kecamatan b on a.kecamatan = b.id_kecamatan 
						LEFT JOIN t_kelurahan c ON a.kelurahan = c.id_kelurahan
						LEFT JOIN kbli d ON a.klui = d.kode_bagian 
						LEFT JOIN t_status e ON a.`status` = e.id_status	
								WHERE
									a.id = '$id'
							");}
	else	if($sumber=='BPJS KETENAGAKERJAAN'){
				$perusahaan = mysql_query("
							SELECT
									a.id_perusahaan, a.nama, a.alamat,
									a_k.kecamatan, a_kel.kelurahan,
									a.telpon, a.kode_pos,
									a.nomor_akte,a.tgl_pendirian, 
									a_j.jenis, a_s.status,
									a.nama_pemilik, a.nama_pengurus,
									a.alamat_pemilik, a.alamat_pengurus,a_m.status,a_mod.modal,
									a_tbl.wnilk, a_tbl.wnipr, a_tbl.wnalk, a_tbl.wnapr,c.nama_bagian as klui
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
								WHERE
									a.id_perusahaan = '$id'
							");
		}
	$set = mysql_fetch_array($perusahaan);	
	
?>
	<style>
		input[type='text']
		{
			border:hidden;
		}
	</style>
    
	<table width="100%" border="0" align="center" cellpadding="5" cellspacing="2" style='font-size:12px; text-transform:uppercase'>
	  <tr>
	    <td colspan="7"><h2>DATA PERUSAHAAN</h2>
	      <hr />
	      
	      </td>
      </tr>
	  <tr>
	    <td>NAMA PERUSAHAAN</td>
	    <td width="7px">:</td>
	    <td ><input type='hidden' value='<?php echo $set[0] ?>'>
        				<?php echo $set[1]; ?></td>
	    <td width="5%">&nbsp;</td>
	    <td >NO AKTE PENDIRIAN</td>
	    <td width="7px">:</td>
	    <td align="left" ><?php echo $set[7]; ?></td>
      </tr>
	  <tr>
	    <td>ALAMAT</td>
	    <td>:</td>
	    <td><?php echo $set[2]; ?></td>
	    <td>&nbsp;</td>
	    <td>TANGGAL PENDIRIAN</td>
	    <td>:</td>
	    <td><?php echo $set[8]; ?></td>
      </tr>
	  <tr>
	    <td>KECAMATAN</td>
	    <td>:</td>
	    <td><?php echo $set[3]; ?></td>
	    <td>&nbsp;</td>
	    <td>JENIS USAHA</td>
	    <td>:</td>
	    <td><?php echo $set[9]; ?></td>
      </tr>
	  <tr>
	    <td>KELURAHAN</td>
	    <td>:</td>
	    <td><?php echo $set[4]; ?></td>
	    <td>&nbsp;</td>
	    <td>STATUS USAHA</td>
	    <td>:</td>
	    <td><?php echo $set[10]; ?></td>
      </tr>
	  <tr>
	    <td>No. TELEPON</td>
	    <td>:</td>
	    <td><?php echo $set[5]; ?></td>
	    <td>&nbsp;</td>
	    <td>KLUI</td>
	    <td>:</td>
	    <td><?php echo $set[21]; ?></td>
      </tr>
	  <tr>
	    <td>KODE POS</td>
	    <td>:</td>
	    <td><?php echo $set[6]; ?></td>
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
	    <td colspan="7"><h2>DATA KEPEMILIKAN</h2>
	      <hr />
	      <br /></td>
      </tr>
	  <tr>
	    <td>PEMILIK</td>
	    <td>:</td>
	    <td><?php echo $set[11]; ?></td>
	    <td>&nbsp;</td>
	    <td>STATUS PEMILIK</td>
	    <td>:</td>
	    <td><?php echo $set[15]; ?></td>
      </tr>
	  <tr>
	    <td>ALAMAT PEMILIK</td>
	    <td>:</td>
	    <td><?php echo $set[12]; ?></td>
	    <td>&nbsp;</td>
	    <td>STATUS PERMODALAN</td>
	    <td>:</td>
	    <td><?php echo $set[16]; ?></td>
      </tr>
	  <tr>
	    <td>PENGURUS</td>
	    <td>:</td>
	    <td><?php echo $set[13]; ?></td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
      </tr>
	  <tr>
	    <td>ALAMAT PENGURUS</td>
	    <td>:</td>
	    <td><?php echo $set[14]; ?></td>
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
	    <td colspan="7"><br />
	      <h2>DATA TENAGA KERJA</h2>
	      <hr />
	      <br /></td>
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
	  	$onc="cetak_data('".$id."','".$sumber."')";
	  ?>       
	  <tr>
	    <td height="34">&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
<<<<<<< HEAD
	    <td><input type='button' value='CETAK DATA'  onclick="window.open('../../../index.php?mod=loket&opt=cetak_potensial&sumber=<?=$sumber;?>&id_p=<?=$id;?>');" 
						style='margin-right:5px; float:right;'/></td>
=======
	    <td><input type='button' value='CETAK DATA' onCLick=<?php echo $onc;?> style='margin-right:5px; float:right;'/></td>
>>>>>>> 61b16164dbc53b4bcbd8d4faadd081d2b93a07d3
	    <!--<td><input type='button' value='CETAK DATA EXCEL' onCLick='' style='margin-right:5px;' /></td>-->
      </tr>
    </table>