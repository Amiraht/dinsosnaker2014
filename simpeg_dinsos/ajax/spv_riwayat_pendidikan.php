<?php
    include("../php/koneksi.php");
    include("../php/fungsi.php");
	
	$id_data = mysql_real_escape_string($_GET['id_data']);
	
	$nip = get_nip_riwayat_pendidikan($id_data);
	
	$sql = "SELECT
                     a.id_data_rp as 'id_data', a.nip, b.nama_pegawai, c.tingkat_pendidikan , a.tempat_pendidikan, 
                     a.k_a_tempat_pendidikan as 'kepala' ,a.nilai, a.no_ijazah, a.tgl_ijazah
                        FROM
                        	tbl_riwayat_pendidikan a
                        	LEFT JOIN tbl_pegawai b ON a.nip = b.nip
                        	LEFT JOIN ref_tingkat_pendidikan c ON a.id_tingkat_pendidikan = c.id_tingkat_pendidikan
                        WHERE
                        	a.nip = '". $nip ."' 
                        ORDER BY
                        	c.id_tingkat_pendidikan ASC
                        ";
	
    $res = mysql_query($sql);
	
    echo "<div class='judullist'>Daftar Riwayat Pendidikan " . detail_pegawai_by_nip($nip, "nama_pegawai") . " (NIP : " . $nip . ")</div><br/>";
    
	echo "<table border='1' cellspacing='0' cellpadding='3'>";
	echo "<tr>
			 <td><center><b>No</center></b></td>
			 <td><center><b>Tingkat Pendidikan</center></b></td>	
			 <td><center><b>Tempat Pendidikan</center></b></td>
			 <td><center><b>Nama Kepala Tempat Pendidikan</center></b></td>
			 <td><center><b>Nilai/Index</center></b></td>
			 <td><center><b>No. Ijazah</center></b></td>
			 <td width='100px;'><center><b>Tgl. Ijazah</center></b></td>
		  </tr>	
	";
	$no = 1;
	while($row = mysql_fetch_array($res)){
		echo "<tr>
			 <td><center>". $no ."</center></td>
			 <td><center>". $row['tingkat_pendidikan'] ."</center></td>	
			 <td><center>". $row['tempat_pendidikan'] ."</center></td>
			 <td><center>". ($row['kepala'] == "" ? "-" : $row['kepala']) ."</center></td>
			 <td><center>". $row['nilai'] ."</center></td>
			 <td><center>". $row['no_ijazah'] ."</center></td>
			 <td><center>". tglindonesia($row['tgl_ijazah']) ."</center></td>
		  </tr>	
		";
		$no++;
	}
	echo "</table>";
?>