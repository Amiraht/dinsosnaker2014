<?php
	$id = mysql_real_escape_string(strip_tags(trim($_GET["id"])));
?>
<script type="text/javascript">
function hapusfile(id){
    jConfirm("Anda yakin ingin menghapus file ini?", "PERHATIAN", function(r){
        if(r){
            var id_arsip = <?php echo($id); ?>;
            document.location.href="php/hapus_file_digital_arsip.php?id=" + id + "&id_arsip=" + id_arsip;
        }
    });
}
function download(id){
    window.open("php/download_digitalisasi.php?id=" + id);
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
                                <h1><a style="color:#AA9F00;" href="">DIGITALISASI ARSIP</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>DIGITALISASI ARSIP</span></td>
                            <td><img  align="right" width="90" height="29" onclick="document.location.href='./?mod=digitalisasi_arsip'" 
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
					<legend><h3>DATA ARSIP YANG DIDIGITALISASI</h3></legend>
					<?php
						$res_arsip = mysql_query("SELECT
										a.*, c.unit_kerja, d.masalah, e.jenis_arsip
									FROM
										tbl_benda_arsip a
										LEFT JOIN ref_unit_kerja c ON a.id_unit_kerja = c.id_unit_kerja
										LEFT JOIN ref_masalah d ON a.id_masalah  = d.id_masalah
										LEFT JOIN ref_jenis_arsip e ON a.id_jenis_arsip = e.id_jenis_arsip
									WHERE
										a.id_arsip='" . $id . "'
									ORDER BY
										a.tahun");
						$ds_arsip = mysql_fetch_array($res_arsip);
					?>
					<div class="bodypanel" id="bodyfilter">
						<input type="button" value="Kembali" onclick='document.location.href="?mod=data_digital_arsip";' />
						<div class="kelang"></div>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							 <tr>
								<td width='10%'>Kode Klasifikasi</td>
								<td width='10px'>:</td>
								<td><b><?php echo($ds_arsip["kode_klasifikasi"]); ?></b></td>
							</tr>
							<tr>
								<td width='10%'>Indeks</td>
								<td width='10px'>:</td>
								<td><b><?php echo($ds_arsip["indeks"]); ?></b></td>
							</tr>
							<tr>
								<td width='10%'>Masalah</td>
								<td width='10px'>:</td>
								<td><b><?php echo($ds_arsip["masalah"]); ?></b></td>
							</tr>
							<tr>
								<td width='10%'>Deskripsi</td>
								<td width='10px'>:</td>
								<td><b><?php echo($ds_arsip["uraian"]); ?></b></td>
							</tr>
							<tr>
								<td width='10%'>Tahun</td>
								<td width='10px'>:</td>
								<td><b><?php echo($ds_arsip["tahun"]); ?></b></td>
							</tr>
							<tr>
								<td width='10%'>Sampul</td>
								<td width='10px'>:</td>
								<td><b><?php echo($ds_arsip["sampul"]); ?></b></td>
							</tr>
							<tr>
								<td width='10%'>Kotak</td>
								<td width='10px'>:</td>
								<td><b><?php echo($ds_arsip["box"]); ?></b></td>
							</tr>
							<tr>
								<td width='10%'>Rak</td>
								<td width='10px'>:</td>
								<td><b><?php echo($ds_arsip["rak"]); ?></b></td>
							</tr>
						</table>
				</fieldset>
				<br/><br/>

					<fieldset>
					   <legend><h3>UPLOAD FILE DIGITAL</h3></legend>
						<form name="frm" action="php/upload_digitalisasi.php" method="post" enctype="multipart/form-data">
							<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
								<input type="hidden" name="id_arsip" value="<?php echo $id; ?>" />
								<tr>
									<td><input type="file" name="digital" /></td>
									<td width='100px'>
										<input type="submit" value="Upload" style="width: 100%;" />
									</td>
								</tr>
							</table>
					   </form>
					 </fieldset>
					<br/><br/>
				<fieldset>
					<legend><h3>DAFTAR FILE DIGITAL</h3></legend>
					<table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
						<thead>
						<tr class="headertable">
							<th width='40px'>No.</th>
							<th>Nama File</th>
							<th width='100px'>Ekstensi</th>
							<th width='150px'>Ukuran</th>
							<th width='20px'>&nbsp;</th>
							<th width='20px'>&nbsp;</th>
						</tr>
						</thead>
						<tbody>
						<?php
							$res = mysql_query("SELECT id_file, nama_file, ekstensi, OCTET_LENGTH(file) AS ukuran FROM tbl_file_arsip_digital WHERE id_surat_masuk = '" . $_GET["id"] . "'");
							$ctr = 0;
							while($ds = mysql_fetch_array($res)){
								$ctr++;
						?>
							<tr>
								<td><?php echo($ctr); ?></td>
								<td><?php echo($ds["nama_file"]); ?></td>
								<td align='center'><?php echo($ds["ekstensi"]); ?></td>
								<td align='center'><?php echo(($ds["ukuran"] / 1000) . " Kb"); ?></td>
								<td>
									<img src='image/Upload-48.png' width='18px' class='linkimage' title='Download File' onclick='download(<?php echo($ds["id_file"]); ?>);' />
								</td>
								<td>
									<img src='image/Delete-32.png' width='18px' class='linkimage' title='Hapus File' onclick='hapusfile(<?php echo($ds["id_file"]); ?>);' />
								</td>
							</tr>
						<?php
							}
						?>
						</tbody>
					</table>
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
 
