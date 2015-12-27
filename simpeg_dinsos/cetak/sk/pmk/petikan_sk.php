<?php

	include "../../../php/koneksi.php";
	include "../../../php/fungsi.php";
	
	$id_surat = mysql_real_escape_string($_GET['id_surat']);
	$id_usul =  getNoUsulanSkPMK($id_surat);
	$html = "";
	
	$sql = "SELECT 
				a.*, b.*, c.nama_pegawai, c.nip, c.gelar_depan, c.gelar_belakang, d.pangkat, d.gol_ruang,
				e.gapok, e.terbilang, c.tempat_lahir, c.tanggal_lahir, g.skpd
					FROM tbl_sk_pmk a
					LEFT JOIN tbl_detail_usul_pmk b ON a.id_usulan = b.id_usulan
					LEFT JOIN tbl_pegawai c ON b.nip = c.nip
					LEFT JOIN ref_pangkat d ON c.id_pangkat = d.id_pangkat
					LEFT JOIN ref_gapok e ON c.id_pangkat = e.id_pangkat
					
					LEFT JOIN ref_skpd g ON c.id_satuan_organisasi = g.id_skpd
				WHERE	
					a.id_surat = '".$id_surat."' AND b.id_usulan = '".$no_usul."' 
					 
				ORDER BY
					c.nama_pegawai ASC;
				";
				// optional tbl_pengangkatan_cpns diganti dengan tbl pns
				
	$query = mysql_query($sql) or die(mysql_error());
	
	
while($row = mysql_fetch_array($query)){	
	
	// variabel
	$gd = ($row['gelar_depan'] == "") ? "&nbsp;" : $row['gelar_depan']."&nbsp;";
	$gb = ($row['gelar_belakang'] == "") ? "&nbsp;" : "&nbsp;".$row['gelar_belakang'];
	$np = ($row['nama_pegawai'] == "") ? "&nbsp;" : $row['nama_pegawai'];
	$fullname = $gd . $np . $gb;	
	
	$html .= "<center><span style='font-size:14px; font-weight:bold;'>";
	$html .= "PEMERINTAH KOTA MEDAN<br/>";
	
	$html	.= " PETIKAN<br/>";
	$html	.= "KEPUTUSAN WALIKOTA MEDAN<br/>";
	$html	.= "NOMOR :"; 
	$html	.="</span>";
	$html	.="</center><br/>";	
	$html	.= "<center><span style='font-size:14px; font-weight:bold;'>";
		$html	.= "TENTANG<br/>";
		$html	.= "PENINJAUAN MASA KERJA PNS DI LINGKUNGAN PEMERINTAH KOTA MEDAN<br/>";
		$html	.= "</span>";
	$html	.= "</center><br/>";	
	$html	.= "<center><span style='font-size:14px; font-weight:bold;'>";
		$html	.= "WALIKOTA MEDAN<br/>";
		$html	.= "</span>";
	$html	.= "</center><br/><br/>
		<table border='0' cellspacing='2' cellpadding='3' width='100%'>";
	$html	.= "<tr>";
		$html	.= "<td width='20%'>Menimbang</td>";
		$html	.= "<td> : </td>";
		$html	.= "<td> a. </td>";
		$html	.= "<td width='60%'>bahwa Pegawai Negeri Sipil yang namanya tersebut dalam keputusan ini telah memenuhi syarat dan";
			$html	.= "dipandang perlu diberikan Peninjauan Masa Kerja;</td>";
	$html	.= "</tr>";
	$html	.= "<tr>";
		$html	.= "<td width='20%'>&nbsp;&nbsp;&nbsp;</td>";
		$html	.= "<td></td>";
		$html	.= "<td> b. </td>";
		$html	.= "<td>bahwa peninjauan masa kerja PNS ybs telah mendapat pertimbangan teknis Kepala Kantor Regional VI BKN";
		$html	.= "dengan Nomor : ".$row['no_persetujuan']." tanggal ".$row['tgl_persetujuan'].".</td>";
	$html	.= "</tr>";
	$html .= "<tr>
		<td width='20%'>Mengingat</td>
		<td> : </td>
		<td> 1. </td>
		<td>Undang-undang (drt) Nomor 8 Tahun 1956 jo PP Nomor 22 Tahun 1973;</td>
	</tr>";
	$html .= "<tr>
		<td width='20%'>&nbsp;&nbsp;&nbsp;</td>
		<td></td>
		<td> 2. </td>
		<td>Undang-undang Nomor 8 Tahun 1974 jo Undang-undang Nomor 43 Tahun 1999;</td>
	</tr>";
	
	$html .= "<tr>
		<td width='20%'>&nbsp;&nbsp;&nbsp;</td>
		<td></td>
		<td> 3. </td>
		<td>Undang-undang Nomor 32 Tahun 2004;</td>
	</tr>";
	$html .= "<tr>
		<td width='20%'>&nbsp;&nbsp;&nbsp;</td>
		<td></td>
		<td> 4. </td>
		<td>Peraturan Pemerintah Nomor 7 Tahun 1977 jo Peraturan Pemerintah Nomor 22 Tahun 2013;</td>
	</tr>";
	$html .= "<tr>
		<td width='20%'>&nbsp;&nbsp;&nbsp;</td>
		<td></td>
		<td> 5. </td>
		<td>Peraturan Pemerintah Nomor 11 Tahun 2002;</td>
	</tr>";
	$html .= "<tr>
		<td width='20%'>&nbsp;&nbsp;&nbsp;</td>
		<td></td>
		<td> 6. </td>
		<td>Peraturan Pemerintah Nomor 12 Tahun 2002 tentang Perubahan atas PP Nomor 99 Tahun 2000;</td>
	</tr>";
	$html .= "<tr>
		<td width='20%'>&nbsp;&nbsp;&nbsp;</td>
		<td></td>
		<td> 7. </td>
		<td>Peraturan Pemerintah Nomor 41 Tahun 2007;</td>
	</tr>";
	
	$html .= "<tr>
		<td width='20%'>&nbsp;&nbsp;&nbsp;</td>
		<td></td>
		<td> 8. </td>
		<td>Peraturan Daerah Kota Medan Nomor 3 Tahun 2009 sebagaimana telah diubah dengan Perda Kota Medan
		Nomor 2 Tahun 2011;</td>
	</tr>";
	$html .= "<tr>
		<td width='20%'>&nbsp;&nbsp;&nbsp;</td>
		<td></td>
		<td> 9. </td>
		<td>Peraturan Walikota Medan Nomor 01 Tahun 2011.</td>
	</tr>
	</table><br/>";

	$html .= "<center><span style='font-size:14px; font-weight:bold;'>
		MEMUTUSKAN<br/>
	</span>
	</center><br/>";	

	$html .= "<table border='0' cellspacing='2' cellpadding='3' width='100%'>";
	$html .= "<tr>
			<td>MENETAPKAN</td>
			<td> : </td>
			<td colspan='4'></td>
		</tr>";
	$html	.= "<tr>
			<td>PERTAMA</td>
			<td> : </td>
			<td colspan='4'><span style='float:left;'>Pegawai Negeri Sipil Nomor urut : 1</span></td>
		</tr>";
	$html .="<tr>
			<td width='20%'>&nbsp;&nbsp;&nbsp;</td>
			<td> : </td>
			<td> 1. </td>
			<td> N a m a </td>
			<td> : </span></td>
			<td style='width:55%;'>".$fullname."</td>
		</tr>";
	$html .= "<tr>
			<td width='20%'>&nbsp;&nbsp;&nbsp;</td>
			<td> : </td>
			<td> 2. </td>
			<td> NIP </td>
			<td> : </td>
			<td style='width:55%;'>".$row['nip']."</td>
		</tr>";
		$html .= "<tr>
			<td width='20%'>&nbsp;&nbsp;&nbsp;</td>
			<td> : </td>
			<td> 3. </td>
			<td> Tempat/Tanggal Lahir </td>
			<td> : </td>
			<td style='width:55%;'>".$row['tempat_lahir'].", ".$row['tanggal_lahir']."</td>
		</tr>";
		$html .="<tr>
			<td width='20%'>&nbsp;&nbsp;&nbsp;</td>
			<td> : </td>
			<td> 4. </td>
			<td> Pangkat/Gol. Ruang/TMT </td>
			<td> : </td>
			<td style='width:55%;'>".$row['pangkat']."(".$row['gol_ruang'].") / ".$row['tmt']."</td>
		</tr>";
		$html .= "<tr>
			<td width='20%'>&nbsp;&nbsp;&nbsp;</td>
			<td> : </td>
			<td> 5. </td>
			<td> Masa Kerja Lama </td>
			<td> : </td>
			<td style='width:55%;'>-</td>
		</tr>";
		$html .= "<tr>
			<td width='20%'>&nbsp;&nbsp;&nbsp;</td>
			<td> : </td>
			<td> 6. </td>
			<td> Gaji Pokok Lama </td>
			<td> : </td>
			<td style='width:55%;'>".$row['gapok']."</td>
		</tr>";
		$html .= "<tr>
			<td width='20%'>&nbsp;&nbsp;&nbsp;</td>
			<td> : </td>
			<td> 7. </td>
			<td> Unit Kerja </td>
			<td> : </td>
			<td style='width:55%;'>".$row['skpd']."</td>
		</tr>";
		$html .= "<tr>
			<td width='20%'>&nbsp;&nbsp;&nbsp;</td>
			<td> : </td>
			<td> 8. </td>
			<td> Keterangan </td>
			<td> : </td>
			<td style='width:55%;'>".$row['pengalaman']."</td>
		</tr>";
		$html .= "<tr>";
		$html .= "<td width='20%'>&nbsp;&nbsp;&nbsp;</td>";
		$html	.= "<td></td>";
			$html .=" <td colspan='4'><span style='float:left;'>terhitung mulai tanggal ".$row['tmt']." diberikan Peninjauan Masa Kerja dengan masa kerja golongan baru 26 tahun";
	$html .= "02 bulan, diberikan gaji pokok sebesar ".$row['gapok']." (".($row['terbilang'] == "") ? "-" : $row['terbilang'].")";
	$html .= "ditambah penghasilan lainnya yang sah berdasarkan Peraturan Perundang-undangan yang berlaku.</span></td>";
		$html .= "</tr>";
		$html .="<tr>
			<td>KEDUA</td>
			<td> : </td>
			<td colspan='4'><span style='float:left;'>Kenaikan gaji yang akan datang pada tanggal : 01-05-2017 (Jika telah memenuhi syarat-syarat untuk itu).</span></td>
		</tr>
		<tr>
			<td>KETIGA</td>
			<td> : </td>
			<td colspan='4'><span style='float:left;'>Apabila dikemudian hari ternyata terdapat kekeliruan dalam Keputusan ini, akan diadakan perbaikan dan
			perhitungan kembali sebagaimana mestinya.</span></td>
		</tr>
		<tr>
			<td>KEEMPAT</td>
			<td> : </td>
			<td colspan='4'><span style='float:left;'>Asli Petikan Keputusan ini diberikan kepada yang bersangkutan untuk diketahui dan dipergunakan sebagaimana
			mestinya.</span></td>
		</tr>
		</table><br/>

	<span style='float:right;margin-right:30px;'>
		Ditetapkan Di : &nbsp;Medan<br/>
		Pada Tanggal  : &nbsp;  	
	</span><br/><br/>


	<span style='float:left; margin-left:35px;'>
		Sesuai dengan aslinya : <br/>
		KEPALA BADAN KEPEAWAIAN KOTA MEDAN <br/>
		KOTA MEDAN <br/><br/><br/><br/><br/>
		
		LAHUM, SH, MM<br/>
		Pembina Utama Muda<br/>
		NIP. 19581231 198602 1 027
	</span>
	<span style='float:right;margin-rigth:35px;'>
		a.n. W A L I K O T A  M E D A N<br/>
		SEKRETARIS DAERAH <br/><br/>
		<center>d.t.o</center><br/><br/>
		Ir. SYAIFUL BAHRI<br/>
		Pembina Utama Madya<br/>
		NIP. 19591108 199203 1 004
	</span><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
	
}
echo $html;



	