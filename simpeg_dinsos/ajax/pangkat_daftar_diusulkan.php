<?php
	
	include "../php/koneksi.php";
	include "../php/fungsi.php";
	
	$id_usulan = mysql_real_escape_string($_GET['id_usulan']);
	//$no_usulan = get_no_usulan_pangkat($id_usulan);
	
	$sql = "SELECT 
				a.*,d.pangkat, d.gol_ruang
			FROM
				tbl_usulan_pangkat a
				LEFT JOIN ref_pangkat d ON a.id_pangkat_ttd = d.id_pangkat
			WHERE
				a.id_usulan = '". $id_usulan ."'
		   ";
	
	$query = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_array($query);
	$tgl_usul = ($row['tgl_usulan'] == "") ? "-" : $row['tgl_usulan'];
	echo "<table border='0' cellspacing='4' cellpadding='4' style='font-size:12px;'>	
			<tr>
				<td style='font-weight:bold;'>NO USULAN &nbsp;&nbsp;</td>
				<td>	:	&nbsp;&nbsp;</td>
				<td> ". $row['no_usulan'] ."</td>	
			</tr>
			<tr>
				<td style='font-weight:bold;'>TGL USULAN &nbsp;&nbsp;</td>
				<td>	:	&nbsp;&nbsp;</td>
				<td> ". tglindonesia($tgl_usul) ."</td>	
			</tr>	
			<tr>
				<td style='font-weight:bold;'>NAMA PEJABAT PENGUSUL &nbsp;&nbsp;</td>
				<td>	:	&nbsp;&nbsp;</td>
				<td> ". $row['nama_pejabat_ttd'] ."</td>	
			</tr>
			<tr>
				<td style='font-weight:bold;'>NIP PEJABAT PENGUSUL &nbsp;&nbsp;</td>
				<td>	:	&nbsp;&nbsp;</td>
				<td> ". $row['nip_pejabat_ttd'] ."</td>	
			</tr>
			<tr>
				<td style='font-weight:bold;'>PANGKAT PEJABAT PENGUSUL &nbsp;&nbsp;</td>
				<td>	:	&nbsp;&nbsp;</td>
				<td> ". $row['pangkat'] ." ( ". $row['gol_ruang'] ." )</td>	
			</tr>
			<tr>
				<td style='font-weight:bold;'>JABATAN PEJABAT PENGUSUL &nbsp;&nbsp;</td>
				<td>	:	&nbsp;&nbsp;</td>
				<td> ". $row['jabatan_ttd'] ."</td>	
			</tr>
		</table><br/>		
	";
	
	echo "<center><span style='font-size:14px; font-weight:bold;' >DAFTAR NAMA PEGAWAI YANG DIUSULKAN</span></center>";
	echo "<table border='1' cellspacing='4' cellpadding='4' style='font-size:12px;'>";
	echo "
			<tr>
				<td style='font-weight:bold;'><center>No</center></td>
				<td style='font-weight:bold;'><center>NIP Pegawai</center></td>
				<td style='font-weight:bold;'><center>Nama Pegawai</center></td>
				<td style='font-weight:bold;'><center>Unit Kerja/SKPD</center></td>
				<td style='font-weight:bold;'><center>Pangkat Lama</center></td>
				<td style='font-weight:bold;'><center>Pangkat Baru</center></td>
			</tr>
	";
	$no = 1;
	echo "<tbody>";	
	
	// hardcode cuy untuk string sql kedua
	$ql = "SELECT 
				a.id_pegawai, b.nip, b.nama_pegawai, c.skpd, d.pangkat, d.gol_ruang ,
				e.pangkat as 'PANGKAT_BARU', e.gol_ruang as 'GOLBAR'
			FROM
				tbl_detail_usulan_pangkat a
				LEFT JOIN tbl_pegawai b ON a.id_pegawai = b.id_pegawai
				LEFT JOIN ref_skpd c ON b.id_satuan_organisasi = c.id_skpd
				LEFT JOIN ref_pangkat d ON b.id_pangkat = d.id_pangkat
				LEFT JOIN ref_pangkat e ON a.id_pangkat_baru = e.id_pangkat
			WHERE
				a.id_usulan = '". $id_usulan ."'
			ORDER BY
			    b.nama_pegawai ASC
		   ";
		   
	$qr = mysql_query($ql);
	
	while($data = mysql_fetch_array($qr)){
		// normalisasi data
		$skpd = ($data['skpd'] == '') ? '-' : $data['skpd'];
		$panggol = ($data['pangkat'] == '' && $data['gol_ruang'] == '') ? '-' : $data['pangkat'] . " (" . $data['gol_ruang'] . ") ";
		$nnip = ($data['nip'] == '') ? 'NIHIL' : $data['nip'];
		$fullname = ($data['nama_pegawai'] == '') ? 'NIHIL' : $data['nama_pegawai'];
		$p_baru = ($data['PANGKAT_BARU'] == '' && $data['GOLBAR'] == '') ? '-' : $data['PANGKAT_BARU'] . " (" . $data['GOLBAR'] . ") ";
		
		echo "<tr>
			<td><center> ".$no." </center></td>
			<td><center> ".$nnip." </center></td>
			<td><center> ".$fullname." </center></td>
			<td><center> ".$skpd." </center></td>
			<td><center> ". $panggol ." </center></td>
			<td><center> ".$p_baru." </center></td>
		</tr>";		
		$no++;
	}
	echo "</tbody>";
	
	echo "</table>";
	
	// tutup koneksi
	mysql_close();
