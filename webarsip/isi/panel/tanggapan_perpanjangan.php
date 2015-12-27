<?php
    // MENCARI ID PEMINJAMANNYA
    $id_peminjaman = 0;
    $ds_peminjaman = mysql_fetch_array(mysql_query("SELECT *, DATEDIFF(tgl_jatuh_tempo,CURDATE()) AS sisa_hari FROM tbl_peminjaman_arsip WHERE id_anggota = '" . $_SESSION["id_pengguna"] . "' AND is_dikembalikan = 0 AND status_peminjaman=7 AND id_jenis_peminjaman = 1"));
    $id_peminjaman = $ds_peminjaman["id_peminjaman"];
    //echo($id_peminjaman . "<br>" . "SELECT * FROM tbl_peminjaman_arsip WHERE id_anggota = '" . $_SESSION["id_pengguna"] . "' AND is_dikembalikan = 0 AND status_peminjaman=7");
    /*if($id_peminjaman == 0)
        header("location:?mod=informasi_perpanjangan_peminjaman");*/
?>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
          <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="./?mod=finalisasi_surat_keluar">UPLOAD FINAL SURAT KELUAR</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='<?=$url_main;?>'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>UPLOAD FINAL SURAT KELUAR</span></td>
                            <td><img  align="right" width="90" height="29" onclick="document.location.href='./<?=$url_main;?>'" 
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
				<h3>DAFTAR ARSIP YANG DIPINJAM</h3>
				
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
						</tr>
					</thead>
					<tbody>
					<?php
						$res = mysql_query("SELECT
												a.*, c.unit_kerja, d.masalah, e.jenis_arsip
											FROM
												tbl_benda_arsip a
												LEFT JOIN ref_unit_kerja c ON a.id_unit_kerja = c.id_unit_kerja
												LEFT JOIN ref_masalah d ON a.id_masalah  = d.id_masalah
												LEFT JOIN ref_jenis_arsip e ON a.id_jenis_arsip = e.id_jenis_arsip
												LEFT JOIN tbl_arsip_yang_dipinjam h ON a.id_arsip = h.id_arsip  
											WHERE
												1 AND h.id_peminjaman='" . $id_peminjaman . "'
											ORDER BY
												a.tahun") or die(mysql_error());
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
						</tr>
					<?php
						}
					?>
					</tbody>
				</table>
			</fieldset>
			<br/><br/>
			<fieldset>
				<legend><h3>DATA PEMINJAMAN</h3></legend>
					<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
						<tr>
							<td width='10%'>Tanggal Peminjaman</td>
							<td width='10px'>:</td>
							<td><b><?php echo($ds_peminjaman["tgl_peminjaman"]); ?></b></td>
						</tr>
						<tr>
							<td width='10%'>Tanggal Jatuh Tempo</td>
							<td width='10px'>:</td>
							<td><b><?php echo($ds_peminjaman["tgl_jatuh_tempo"]); ?></b></td>
						</tr>
						<tr>
							<td width='10%'>Status Dokumen</td>
							<td width='10px'>:</td>
							<td><b><?php echo($ds_peminjaman["status_dokumen"]); ?></b></td>
						</tr>
						<tr>
							<td width='10%'>Catatan</td>
							<td width='10px'>:</td>
							<td><b><?php echo($ds_peminjaman["catatan2"]); ?></b></td>
						</tr>
					</table>
			</fieldset><br/><br/>
			  
			<fieldset>
				<legend><h3>TANGGAPAN TERHADAP PERMOHONAN PERPANJANGAN</h3></legend>
				<?php
					$res_up = mysql_query("SELECT * FROM tbl_usulan_perpanjangan_digital WHERE id_peminjaman = '" . $id_peminjaman . "'");
					if(mysql_num_rows($res_up) == 0){
						echo("<div style='text-align: center; font-family: sans-serif; font-size: 12px; font-weight: bold; color: black; text-transform: uppercase;'>Anda belum melakukan permohonan perpanjangan</div>");
					}else{
						$ds_up = mysql_fetch_array($res_up);
						switch($ds_up["status"]){
							case 0 :
								echo("<div style='text-align: center; font-family: sans-serif; font-size: 12px; font-weight: bold; color: black; text-transform: uppercase;'>Anda telah melakukan permohonan perpanjangan. Silahkan tunggu tanggapan dari pihak Kantor Arsip Kota Medan</div>");
								break;
							case 1 :
								echo("<div style='text-align: center; font-family: sans-serif; font-size: 12px; font-weight: bold; color: green; text-transform: uppercase;'>Permohonan perpanjangan peminjaman anda telah disetujui oleh pihak Kantor Arsip kota Medan</div>");
								break;
							case 2 :
								echo("<div style='text-align: center; font-family: sans-serif; font-size: 12px; font-weight: bold; color: red; text-transform: uppercase;'>Permohonan perpanjangan peminjaman anda ditolak oleh pihak Kantor Arsip Kota Medan. Silahkan melakukan pengembalian</div>");
								break;
						}
					}
				?>
			 </fieldset>
	</div>
</td>
</tr>
<tr>
    <td align="center" valign="middle">
    <div id='menu' style='border:0px solid black;'>
                    <nav>
                            <ul>
                                    <li><img src='./image/list.png'>&nbsp;&nbsp;<a href='<?=$url_main;?>'>BERANDA UTAMA</a></li>
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
 

