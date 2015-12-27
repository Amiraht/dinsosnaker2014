<?php
	
	include "../php/koneksi.php";
	include "../php/fungsi.php";
	
	$id_usulan = mysql_real_escape_string($_GET['id_usulan']);
	$no_usul = getNoUsulFromUsulanCuti($id_usulan);
	
	$sql = "SELECT * FROM tbl_usulan_cuti WHERE id_usulan = '". $id_usulan ."'";
	
	$query = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_array($query);
	
	echo "<table border='0' cellspacing='4' cellpadding='4' style='font-size:12px;'>	
			<tr>
				<td style='font-weight:bold;'>NO USULAN &nbsp;&nbsp;</td>
				<td>	:	&nbsp;&nbsp;</td>
				<td> ". $no_usul ."</td>	
			</tr>
			<tr>
				<td style='font-weight:bold;'>TGL USULAN &nbsp;&nbsp;</td>
				<td>	:	&nbsp;&nbsp;</td>
				<td> ". tglindonesia($row['tgl_usulan']) ."</td>	
			</tr>	
			<tr>
				<td style='font-weight:bold;'>PEJABATAN PENANDATANGAN USULAN &nbsp;&nbsp;</td>
				<td>	:	&nbsp;&nbsp;</td>
				<td> ". $row['pejabat_usulan'] ."</td>	
			</tr>
		</table><br/>		
	";
	
	echo "<center><span style='font-size:14px; font-weight:bold;' >DAFTAR NAMA PEGAWAI YANG DIUSULKAN</span></center>";
	echo "<center><table border='1' cellspacing='4' cellpadding='4' style='font-size:12px;'>";
	echo "
			<tr>
				<td style='font-weight:bold;'><center>No</center></td>
				<td style='font-weight:bold;'><center>NIP Pegawai</center></td>
				<td style='font-weight:bold; width='100px;'><center>Nama Pegawai</center></td>
				<td style='font-weight:bold;' width='120px;'><center>Pangkat (Gol.Ruang)</center></td>
				<td style='font-weight:bold;' width='100px;'><center>Unit Kerja/SKPD</center></td>
				<td style='font-weight:bold;' width='80px;'><center>Lama Cuti (hari)</center></td>
				<td style='font-weight:bold;' width='100px;'><center>Jenis Cuti</center></td>
			</tr>
	";
	$no = 1;
	echo "<tbody>";	
	
	// hardcode cuy untuk string sql kedua
	$ql = "SELECT 
				a.*, b.nip, b.nama_pegawai, c.skpd, d.pangkat, d.gol_ruang, e.jenis_cuti
			FROM
				tbl_usulan_cuti a
				LEFT JOIN tbl_pegawai b ON a.id_pegawai = b.id_pegawai
				LEFT JOIN ref_skpd c ON b.id_satuan_organisasi = c.id_skpd
				LEFT JOIN ref_pangkat d ON b.id_pangkat = d.id_pangkat
				LEFT JOIN ref_jenis_cuti e ON a.id_jenis_cuti = e.id_jenis_cuti
			WHERE
				a.no_usulan = '". $no_usul ."' AND a.diproses = '0' 
			ORDER BY
			    b.nama_pegawai ASC
		   ";
		   
	$qr = mysql_query($ql) or die(mysql_error());
	
	while($data = mysql_fetch_array($qr)){
		// normalisasi data
		$skpd = ($data['skpd'] == '') ? '-' : $data['skpd'];
		$panggol = ($data['pangkat'] == '' && $data['gol_ruang'] == '') ? '-' : $data['pangkat'] . " (" . $data['gol_ruang'] . ") ";
		$nnip = ($data['nip'] == '') ? 'NIHIL' : $data['nip'];
		$fullname = ($data['nama_pegawai'] == '') ? 'NIHIL' : $data['nama_pegawai'];
		
		
		echo "<tr>
			<td><center>".$no."</center></td>
			<td><center>".$nnip."</center></td>
			<td><center>".$fullname."</center></td>
			<td><center>". $panggol ."</center></td>
			<td><center>".$skpd."</center></td>
			<td><center>".$data['lama']."</center></td>
			<td><center>".$data['jenis_cuti']."</center></td>
		</tr>";		
		$no++;
	}
	echo "</tbody>";
	
	echo "</table></center>";
	
	// tutup koneksi
	mysql_close();
