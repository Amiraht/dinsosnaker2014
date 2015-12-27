<script type="text/javascript">
function digitalisasi(id){
    document.location.href="?mod=daftar_arsip_digital&id=" + id;
}
</script>


<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
          <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="">PEMINJAMAN ARSIP DIGITAL</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /><a href="./?mod=peminjaman_digital"><span>PEMINJAMAN ARSIP DIGITAL</span></a></td>
                            <td><img  align="right" width="90" height="29" onclick="document.location.href='./'" 
                                onmouseout="this.src='./image/button/KEMBALI.gif'" onmouseover="this.src='./image/button/KEMBALI2.gif'" src="./image/button/KEMBALI.gif"></img>
                                </td>
                        </tr>
                    </table>            
                    </div>
            <br>
        </td>
  </tr>
  <tr>
  	<td>
    <div id='content' style='padding-top:10px;'>	<br>
		

			<fieldset>
				<h3>DAFTAR DATA ARSIP YANG DIPINJAM SECARA DIGITAL</h3>
				<table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
					<thead>
					<tr class="headertable">
						<th width='40px'>No.</th>
						<th width='100px'>Kode Klasifikasi</th>
						<th width='70px'>Indeks</th>
						<th width='100px'>Masalah</th>
						<th>Uraian Masalah</th>
						<th width='70px'>Tahun</th>
						<th width='50px'>Sampul</th>
						<th width='50px'>Boks</th>
						<th width='50px'>Rak</th>
						<th width='100px'>Jenis Arsip</th>
						<th width='100px'>Keterangan</th>
						<th width='20px'>&nbsp;</th>
					</tr>
					</thead>
					<tbody>
					<?php
						$res = mysql_query("SELECT
												a.*, c.unit_kerja, d.masalah, e.jenis_arsip
											FROM
												tbl_peminjaman_arsip f
												LEFT JOIN tbl_arsip_yang_dipinjam g ON f.id_peminjaman = g.id_peminjaman
												LEFT JOIN tbl_benda_arsip a ON g.id_arsip = a.id_arsip
												LEFT JOIN ref_unit_kerja c ON a.id_unit_kerja = c.id_unit_kerja
												LEFT JOIN ref_masalah d ON a.id_masalah  = d.id_masalah
												LEFT JOIN ref_jenis_arsip e ON a.id_jenis_arsip = e.id_jenis_arsip
											WHERE
												f.id_anggota = '" . $_SESSION["id_pengguna"] . "' AND f.id_jenis_peminjaman = 3 AND
												DATEDIFF(CURDATE(), f.tgl_peminjaman) <= 3 AND a.id_arsip IS NOT NULL AND f.status_peminjaman=13
											GROUP BY
												a.id_arsip");
						/*echo("SELECT
												a.*, c.unit_kerja, d.masalah, e.jenis_arsip
											FROM
												tbl_benda_arsip a
												LEFT JOIN ref_unit_kerja c ON a.id_unit_kerja = c.id_unit_kerja
												LEFT JOIN ref_masalah d ON a.id_masalah  = d.id_masalah
												LEFT JOIN ref_jenis_arsip e ON a.id_jenis_arsip = e.id_jenis_arsip
											WHERE
												a.id_unit_kerja = '" . $_SESSION["id_unit_kerja"] . "' " . $whr . "
											ORDER BY
												a.tahun");*/
						$ctr = 0;
						while($ds = mysql_fetch_array($res)){
							$ctr++;
					?>
						<tr>
							<td align='center'><?php echo($ctr); ?></td>
							<td><?php echo($ds["kode_klasifikasi"]); ?></td>
							<td><?php echo($ds["indeks"]); ?></td>
							<td><?php echo($ds["masalah"]); ?></td>
							<td><?php echo($ds["uraian"]); ?></td>
							<td align='center'><?php echo($ds["tahun"]); ?></td>
							<td align='center'><?php echo($ds["sampul"]); ?></td>
							<td align='center'><?php echo($ds["box"]); ?></td>
							<td align='center'><?php echo($ds["rak"]); ?></td>
							<td><?php echo($ds["jenis_arsip"]); ?></td>
							<td><?php echo($ds["keterangan"]); ?></td>
							<td>
								<img src='image/Upload-Blue-48.png' width='18px' class='linkimage' title='Digitalisasi Data Arsip' onclick='digitalisasi(<?php echo($ds["id_arsip"]); ?>);' />
							</td>
						</tr>
					<?php
						}
					?>
					</tbody>
				</table>
			 </fieldset>
			 <br><br/>
			<fieldset>
				<h3>KETERANGAN</h3><br/><br/>
					<div style="text-align: center; font-family: sans-serif; font-size: 12px; font-weight: bold; color: green; text-transform: uppercase;">
						Daftar arsip yang tertera pada peminjaman digital hanya berlaku untuk tiga hari setelah melakukan
						permohonan peminjaman digital pada Kantor Arsip Kota Medan.</div>
			 </fieldset>      
	</div>
</td>
</tr>
<tr>
    <td align="center" valign="middle">
    <div id='menu' style='border:0px solid black;'>
                    <nav>
                            <ul>
                                    <li><img src='./image/list.png'>&nbsp;&nbsp;<a href='./'>BERANDA UTAMA</a></li>
                                    <li><img src='./image/list.png'>&nbsp;&nbsp;<a href='./?mod=latar_belakang'>LATAR BELAKANG</a></li>
                                    <li><img src='./image/list.png'>&nbsp;&nbsp;<a href='./?mod=berita_dan_informasi'>BERITA DAN INFORMASI</a></li>
									<li><img src='./image/list.png'>&nbsp;&nbsp;<a href='./?mod=fdownload'>FILE DOWNLOAD</a></li>
                                </ul>
                    </nav>
    </div>
    </td>
</tr>
<tr>
     <td><br><div id='footer'></div></td>
 </tr>
 </table>
 

