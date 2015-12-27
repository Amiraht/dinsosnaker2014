<?php
	$data = array();
	$id_data = mysql_real_escape_string($_GET['id_data']);
    $sql_data = "SELECT * FROM tbl_sk_kenpang WHERE id_data ='" . $id_data . "'";
    $res_data = mysql_query($sql_data);
    if(mysql_num_rows($res_data) > 0){
        $ds_data = mysql_fetch_array($res_data);
        $data["id_data"] = $ds_data["id_data"];
        $data["no_sk"] = $ds_data["no_sk"];
        $data["scan_sk"] = $ds_data["scan_sk"];
		$data["no_usul"] = $ds_data["no_usulan_naik_pangkat"];
    }
?>

<script type="text/javascript">
	function hapus(id_file , id_data){
		 jConfirm("Hapus data lampiran pegawai dengan ID "+ id_file +" ini ?", "PERHATIAN", function(r){
            if(r){
                document.location.href = "php/kpk/hapus_berkas_sk_detail.php?id_file=" + id_file + "&id_data=" + id_data;
            }
        });
	}
	
	function print(id_file){
		window.open('cetak/sk/kepangkatan/print_uploaded_sk.php?id_file='+id_file);
	}
	
	function download(filename){
		window.open('sys_files/scan_sk_kenpang/' + filename);
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
                                <h1><a style="color:#AA9F00;" href="">SIMPAN BERKAS SK KEPANGKATAN</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>SIMPAN BERKAS SK KEPANGKATAN</span></td>
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
		
		<form name="frm" id="frm" action="php/kpk/simpan_berkas_sk_kenpang.php" method="POST" enctype="multipart/form-data" target="_blank">
			<input type="hidden" name="no_usul" value="<?=$data['no_usul']; ?>" />
			<div class="panelcontainer panelform" style="width: 100%;">
				<h3 style="text-align: left;">UPLOAD DAN SIMPAN FILE SK (NO. SK : <?=$data['no_sk']; ?>)</h3>
				<?php
					if(isset($_GET['notif'])){
						if($_GET['notif'] == 1){	
							//echo "sukses";
							echo "<div class='alert alert-success' role='alert' id='alert_add_sukses'>";
							echo "<center><img src='image/icn_alert_success.png' width='18px;' />&nbsp;&nbsp;";
							echo "Data Berhasil Dihapus.</center>";
							echo "</div>";
						}else if($_GET['notif'] == 2){
							echo "<div class='alert alert-warning' role='alert' id='alert_add_sukses'>";
							echo "<center><img src='image/icn_alert_warning.png' width='18px;' />&nbsp;&nbsp;";
							echo "Hapus Data Gagal, terjadi kesalahan.</center>";
							echo "</div>";
						}
					}
				?>
				<div class="bodypanel bodyfilter" id="bodyfilter">
					<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
						<tr>
							<td>
								<label>Nomor SK Kepangkatan :</label>
								<input type="text" name="no_sk" id="no_sk" class="form-control" value="<?=$data['no_sk'];?>" readonly="readonly"/>
							</td>
						</tr>
						<tr>
							<td>
								<label>
									Upload File Scan SK  :
								</label>
								<input type="file" name="filename" id="filename" />
								*) File SK harus berekstensi Microsoft Excel (.xls) atau (.xlsx).
							</td>
						</tr>
					</table>
					<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
						<tr>
							<td>
								<input type="submit" class="btn btn-success btn-lg" value="UPLOAD" style="width:150px;height:44px;"/>
								<button type="button" class="btn btn-warning btn-lg" onclick="document.location.href='?mod=kenpang_daftar_sk_diusulkan';">Kembali</button>
							</td>
						</tr>
					</table>
				</div>
			</div>
			</form>
			<div class="kelang"></div>
			<div class="kelang"></div>
			<div class="panelcontainer" style="width: 100%;">
				<h3 style="text-align: left;">DAFTAR SK PENGUSULAN KENAIKAN PANGKAT YANG DIUSULKAN KE BKD</h3>
				
				<div class="bodypanel">
				<button type="button" class="btn btn-success" onclick="document.location.href='?mod=kenpang_daftar_sk_diusulkan';">
				<span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;Kembali</button>
				
				<div class="kelang"></div>
				<table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
					<thead>
						<tr class="headertable">
							<th width='40px'>No.</th>
							<th>No. Persetujuan</th>
							<th>Tgl. Persetujuan</th>
							<th width='100px'>NIP Pegawai</th>
							<th width='200px'>Pendidikan Pegawai</th>
							<th width='200px'>Jabatan Pegawai</th>
							<th width='200px'>Unit Kerja / SKPD</th>
							<th width='50px'>&nbsp;</th>
							<th width='50px'>&nbsp;</th>
							<th width='50px'>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$q = "SELECT * FROM tbl_scan_sk_kenpang WHERE no_sk = '".$data['no_sk']."' ORDER BY id_files ASC";
					$ex = mysql_query($q) or die(mysql_error());
					$no = 1;
					while($dt = mysql_fetch_array($ex)){	
						 echo   "<tr>";
						 echo       "<td style='text-align: center;'>".$no."</td>";
						 echo       "<td style='text-align: center;'>".$dt['no_persetujuan']."</td>";
						 echo		"<td style='text-align: center;'>".$dt['tgl_persetujuan']."</td>";
						 echo       "<td style='text-align: center;'>". $dt['nip'] ."</td>";
						 echo       "<td style='text-align: center;'>".$dt['pendidikan']."</td>";
						 echo       "<td style='text-align: center;'>".$dt['jabatan']."</td>";
						 echo       "<td style='text-align: center;'>".$dt['skpd']."</td>";
						 echo		"<td style='text-align: center;'><button type='button' title='Hapus Data' class='btn btn-sm btn-success' style='width: 100%;' onclick='hapus(".$dt['id_files'].", ".$data['id_data'].");'><span class='glyphicon glyphicon-trash'></span></button></td>";
						 echo		"<td style='text-align: center;'><button type='button' class='btn btn-sm btn-info' style='width: 100%;' title='Print Preview Daftar Pegawai Pada File SK' onclick='print(".$dt['id_files'].");'><span class='glyphicon glyphicon-print'></span></button></td>";				
						
						 echo		"<td style='text-align: center;'><a href='sys_files/scan_sk_kenpang/". $dt['filename'] ."' target='_blank'><img src='image/download_large.png' width='35' height='35' title='Download File SK'></a></td>";				
						 echo	"</tr>";
						$no++;
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
 