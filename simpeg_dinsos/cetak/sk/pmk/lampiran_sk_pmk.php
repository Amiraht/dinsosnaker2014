<?php
	include "../../../php/koneksi.php";
	include "../../../php/fungsi.php";
	
	if(isset($_GET['no_usul'])){
		$no_usul = mysql_real_escape_string($_GET['no_usul']);
		$id_surat = mysql_real_escape_string($_GET['id_surat']);
	}else{
		$id_surat = mysql_real_escape_string($_GET['id_surat']);
		$no_usul = getNoUsulSkPmk($id_surat);
	}	
	
	$sql = "SELECT * FROM tbl_sk_pmk WHERE id_surat = '$id_surat'";
	$qwr = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_array($qwr);
	

echo "<table border='0' cellspacing='0' cellpadding='3' width='50%'>
	<tr>
		&nbsp;&nbsp;&nbsp;
	</tr>
</table>
<table border='0' cellspacing='0' cellpadding='3' width='50%' style='font-size:14px; font-weight:bold;float:right;margin-bottom:15px;'>
	<tr>
		<td>DAFTAR</td>
		<td> : </td>
		<td>LAMPIRAN&nbsp;&nbsp;&nbsp;KEPUTUSAN&nbsp;&nbsp;&nbsp;WALIKOTA&nbsp;&nbsp;&nbsp;MEDAN</td>
	</tr>
	<tr>
		<td>NOMOR</td>
		<td> : </td>
		<td>".$row['no_sk']."</td>
	</tr>
	<tr>
		<td>TANGGAL</td>
		<td> : </td>
		<td>".tglindonesia($row['tgl_surat'])."</td>
	</tr>
</table>

<table border='1' cellspacing='0' cellpadding='2' width='100%'>
	<tr>
		<td rowspan='2'><center>No.</center></td>
		<td rowspan='2'><center>Persetujuan Kepala Kantor Reg. VI BKN</center></td>
		<td rowspan='2'><center>Nama, Tempat dan Tanggal Lahir</center></td>
		<td rowspan='2'><center>NIP</center></td>
		<td rowspan='2'><center>Pangkat/Gol.Ruang dan TMT</center></td>
		<td colspan='2'><center>MK Gol Lama</center></td>
		<td rowspan='2'><center>Gaji Pokok Lama (Rp.)</center></td>
		<td rowspan='2'><center>Pengalaman Bekerja</center></td>
		<td colspan='2'><center>Penambahan Masa Kerja</center></td>
		<td colspan='2'><center>MK Gol Baru</center></td>
		<td rowspan='2'><center>Gaji Pokok Baru (Rp.)</center></td>
		<td rowspan='2'><center>Unit Kerja</center></td>
		<td rowspan='2'><center>TMT</center></td>
	</tr>
	<tr>
		<td>Thn</td>
		<td>Bln</td>
		<td>Thn</td>
		<td>Bln</td>
		<td>Thn</td>
		<td>Bln</td>
	</tr>
	<tr>
		<td><center>1</center></td>
		<td><center>2</center></td>
		<td><center>3</center></td>
		<td><center>4</center></td>
		<td><center>5</center></td>
		<td><center>6</center></td>
		<td><center>7</center></td>
		<td><center>8</center></td>
		<td><center>9</center></td>
		<td><center>10</center></td>
		<td><center>11</center></td>
		<td><center>12</center></td>
		<td><center>13</center></td>
		<td><center>14</center></td>
		<td><center>15</center></td>
		<td><center>16</center></td>
	</tr>";
	
		$q = "SELECT 
				a.*, b.*, c.nama_pegawai, c.nip, c.tempat_lahir, c.tanggal_lahir,
				c.gelar_depan, c.gelar_belakang, d.skpd, e.pangkat, e.gol_ruang
				FROM 
					tbl_sk_pmk a
					LEFT JOIN tbl_detail_usul_pmk b ON a.no_usul_pmk = b.no_usulan
					LEFT JOIN tbl_pegawai c ON b.nip = c.nip
					LEFT JOIN ref_skpd d ON c.id_satuan_organisasi = d.id_skpd
					LEFT JOIN ref_pangkat e ON c.id_pangkat = e.id_pangkat
				WHERE
					b.no_usulan = '".$no_usul."' 
				ORDER BY
					c.nama_pegawai ASC";
					
		$ex = mysql_query($q) or die(mysql_error());
		$no = 1;
		while($data = mysql_fetch_array($ex)){
			$gd = ($data['gelar_depan'] == "") ? "&nbsp;" : $data['gelar_depan']."&nbsp;";
			$gb = ($data['gelar_belakang'] == "") ? "&nbsp;" : "&nbsp;".$data['gelar_belakang'];
			$nama = ($data['nama_pegawai'] == "") ? "-" : $data['nama_pegawai'];
			$fullname = $gd . $nama . $gb;
			$p = $data['pangkat']."(".$data['gol_ruang'].")";
			
			echo "<tr>";
			echo "<td><center>".$no."</center></td>";
			echo "<td><center>".$data['no_persetujuan']."</center></td>";
			echo "<td><center>".$fullname."<br/>".$data['tempat_lahir']."<br/>".$data['tanggal_lahir']."</center></td>";
			echo "<td><center>".$data['nip']."</center></td>";
			echo "<td><center>".$p."<br/>".tglindonesia($data['tmt'])."</center></td>";
			echo "<td><center>-</center></td>";
			echo "<td><center>-</center></td>";
			echo "<td><center>-</center></td>";
			echo "<td><center>".$data['pengalaman']."</center></td>";
			echo "<td><center>".$data['tambah_mk_tahun']."</center></td>";
			echo "<td><center>".$data['tambah_mk_bulan']."</center></td>";
			echo "<td><center>-</center></td>";
			echo "<td><center>-</center></td>";
			echo "<td><center>-</center></td>";
			echo "<td><center>".$data['skpd']."</center></td>";
			echo "<td><center>".tglindonesia($data['tmt'])."</center></td>";
			echo "</tr>";
			$no++;
		}

echo "</table>";
