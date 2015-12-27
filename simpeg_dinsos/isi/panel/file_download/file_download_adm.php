<?php
    $tipe_fd = "";
    if($_GET["tipe_fd"] == 1)
        $tipe_fd = "FILE DOWNLOAD";
    else if($_GET["tipe_fd"] == 2)
        $tipe_fd = "TATA CARA PENGGUNAAN";
?>
<script type="text/javascript">
function tambah(){
    document.location.href = "?mod=file_download_adm_tambah&tipe_fd=<?php echo($_GET["tipe_fd"]); ?>&id_file=0";
}
function edit(id_file){
    document.location.href = "?mod=file_download_adm_tambah&tipe_fd=<?php echo($_GET["tipe_fd"]); ?>&id_file=" + id_file;
}
function hapus(id_file){
    jConfirm("Anda yakin akan menghapus data file ini?", "PERHATIAN", function(r){
        if(r){
            document.location.href = "php/file_download/file_download_adm_hapus.php?tipe_fd=<?php echo($_GET["tipe_fd"]); ?>&id_file=" + id_file;
        }
    });
}
function download(id_file){
    window.open("php/file_download/download_now.php?id_file=" + id_file);
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
                                <h1><a style="color:#AA9F00;" href="">FILE DOWNLOAD (ADMINISTRATOR)</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>FILE DOWNLOAD (ADMINISTRATOR)</span></td>
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
				<div class="panelcontainer" style="width: 100%;">
					<h3 style="text-align: left;"><?php echo($tipe_fd); ?></h3>
					<div class="bodypanel">
						<button type="button" class="btn btn-lg btn-info" onclick="tambah();">Tambah Data <?php echo($tipe_fd); ?></button>
						<div class="kelang"></div>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
						<thead>
							<tr class="headertable">
								<th width='40px'>No.</th>
								<th width='250px'>Judul</th>
								<th width='250px'>Nama File</th>
								<th width='100px'>Ekstensi</th>
								<th>Keterangan</th>
								<th width='100px'>Tgl. Upload</th>
								<th width='20px'>&nbsp;</th>
								<th width='20px'>&nbsp;</th>
								<th width='20px'>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$res = mysql_query("SELECT judul, nama_file, ekstensi, keterangan, tanggal, MD5(id_file) AS id_hash FROM tbl_file_download  
												WHERE tipe_fd='" . $_GET["tipe_fd"] . "'") or die(mysql_error());
							$no = 0;
							while($ds = mysql_fetch_array($res)){
								$no++;
								echo("<tr>");
									echo("<td align='center'>" . $no . "</td>");
									echo("<td align='center'>" . $ds["judul"] . "</td>");
									echo("<td align='center'>" . $ds["nama_file"] . "</td>");
									echo("<td align='center'>" . $ds["ekstensi"] . "</td>");
									echo("<td align='center'>" . $ds["keterangan"] . "</td>");
									echo("<td align='center'>" . $ds["tanggal"] . "</td>");
									echo("<td>
											<img src='image/Edit-32.png' width='18px' class='linkimage' title='Edit' onclick='edit(\"" . $ds["id_hash"] . "\");' />
										</td>");
									echo("<td>
											<img src='image/Delete-32.png' width='18px' class='linkimage' title='Hapus' onclick='hapus(\"" . $ds["id_hash"] . "\");' />
										</td>");
									echo("<td>
										<a href='sys_files/file_upload/". $ds['nama_file'] ."' target='_blank'>
											<img src='image/Upload-48.png' width='18px' class='linkimage' title='Download' />
										</a>	
										</td>");
								echo("</tr>");
							}
						?>
						</tbody>
						</table>
					</div>
				</div>
	</div>
</td>
</tr>
<tr>
     <td><br><div id='footer'></div></td>
 </tr>
 </table>
 



