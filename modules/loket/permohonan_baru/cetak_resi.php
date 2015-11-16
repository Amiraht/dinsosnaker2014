<table id="Table_01" width="1000"  border="0" cellpadding="0" cellspacing="0" align="center">
	<tr>
		<td colspan="2" background="./images/datainput/datainput_01.jpg" width="1000" height="125" ></td>
	</tr>
	<tr>
		<td background="./images/administrator/administrator_02.jpg" width="305" height="325" ></td>
		<td>
         <div style="margin-left:10px;">
        	<div style="line-height:10px;font-size:11px;">
			<?php
			$no_resi = $_GET["id"];
			$data=explode("-",$no_resi);
			$jenis_urus = $data[0];
			
			echo $no_resi;
			$az = "insert into tbl_info_berkas(no_resi,jenis_pengurusan,id_proses_skrg,id_proses_sblm)
				values
			('$no_resi','$jenis_urus','24','23')";
			$bz=mysql_query($az);
			
			$ez = mysql_query("SELECT distinct(
								d.no_resi),
								a.pengurusan,
								d.tgl_masuk_berkas,
								b.nama,
								b.alamat,
								b.nama_pemilik,
								b.alamat_pemilik,
								e.jenis_usaha,
								d.nama_ta
							FROM
								tbl_pengurusan a,
								db_dinsos b,
								tbl_info_berkas c,
								tbl_berkas_imta d,
								t_jenis_usaha e
							WHERE
								c.jenis_pengurusan = a.id_pengurusan
							AND d.id_perusahaan = b.id_perusahaan
							AND b.jenis_usaha = e.id_jenis_usaha
							AND d.no_resi ='".$no_resi."'"
							);
			if($ez){				
				while($set = mysql_fetch_array($ez))
					{
						echo "
						<h1>PEMERINTAH KOTA MEDAN<br>DINAS SOSIAL DAN TENAGA KERJA<br>JLN. K.H. WAHID HASYIM NO. 14<br>20154<H1>
						<HR><br>
						IZIN PERPANJANGAN MEMPERKERJAKAN TENAGA KERJA ASING<br>
						NO. URUT AGENDA : ".$no_resi."<br>
						TANGGAL\t:\t $set[1]<br>
						NAMA PERUSAHAAN\t:\t $set[2]<br>
						ALAMAT PERUSAHAAN\t:\t $set[3]<br>
						NAMA PEMILIK\t:\t $set[4]<br>
						ALAMAT PEMILIK\t:\t $set[5]<br>
						JENIS\t:\t $set[6]<br>
						NAMA PEMOHON\t:\t $set[7]<br>
						<br><br>
						PETUGAS LOKET";
						
					}
					
				}
				else
					echo "tidak terjadi apa-apa";
			?>
			</div>
		</div>
        </td>
	</tr>
    <tr>
    <td colspan="2"><div style="margin-left:50px;"> <img src="./images/panah.gif"  /><a href="./index.php?mod=loket&opt=main" id="linkutama"> BERANDA LOKET</a> 											
    </tr>
	<tr>
		<td colspan="2" background="./images/administrator/administrator_04.jpg" width="1000" height="54" ></td>
	</tr>
</table>