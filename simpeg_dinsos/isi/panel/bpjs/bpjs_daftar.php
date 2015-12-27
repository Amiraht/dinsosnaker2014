<!-- CONTROLLER -->
<?php
    /* Ambil semua SKPD */
	$kode_skpd = "";
	$nama = "";
	$nip = "";
	if(isset($_POST['kode_skpd']) && isset($_POST['nama']) && isset($_POST['nip'])){
		$kode_skpd = $_POST['kode_skpd'];
		$nama = $_POST['nama'];
		$nip = $_POST['nip'];
		 /* Hasil filter data pegawai */
		$pegawai = array();
		$whr_pegawai = "";
		$limit = " LIMIT 0, 1000 ";
		if($kode_skpd != "all" ){
			$whr_pegawai .= " AND d.kode_skpd LIKE '" . $kode_skpd . "%' ";
			$limit = "";
		}
	
    $sql_pegawai = "SELECT
                    	a.id_pegawai, a.nama_pegawai, a.nip,
                    	b.pangkat, b.gol_ruang,
                    	c.jabatan, d.skpd
                    FROM
                    	tbl_pegawai a
                    	LEFT JOIN ref_pangkat b ON a.id_pangkat = b.id_pangkat
                    	LEFT JOIN ref_jabatan c ON a.id_jabatan = c.id_jabatan
                    	LEFT JOIN ref_skpd d ON a.id_satuan_organisasi = d.id_skpd
                    WHERE
                    	a.nama_pegawai LIKE '%" . $nama . "%' AND a.nip LIKE '%" . $nip . "%'
                        " . $whr_pegawai . "
                    ORDER BY
                    		a.nama_pegawai ASC
                    " . $limit;
					
		//echo($sql_pegawai);
		$res_pegawai = mysql_query($sql_pegawai);
		$no_pegawai = 0;
		while($ds_pegawai = mysql_fetch_array($res_pegawai)){
			$no_pegawai++;
			$row_pegawai["no"] = $no_pegawai;
			$row_pegawai["id_pegawai"] = $ds_pegawai["id_pegawai"];
			$row_pegawai["nama_pegawai"] = $ds_pegawai["nama_pegawai"];
			$row_pegawai["nip"] = $ds_pegawai["nip"];
			$row_pegawai["pangkat"] = $ds_pegawai["pangkat"];
			$row_pegawai["gol_ruang"] = $ds_pegawai["gol_ruang"];
			$row_pegawai["jabatan"] = $ds_pegawai["jabatan"];
			$row_pegawai["skpd"] = $ds_pegawai["skpd"];
			array_push($pegawai, $row_pegawai);
		}
	}
	
    
?>
<script type="text/javascript">
   
    var pegawai = <?php echo(json_encode($pegawai)); ?>;
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">
function proses(){
    $("#frm").submit();
}

function lanjut(id_pegawai){
    document.location.href = "?mod=bpjs_proses&id_pegawai=" + id_pegawai;
}
</script>
<!-- END OF JAVASCRIPT PAGE -->



<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
          <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="">DAFTAR BPJS</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>DAFTAR BPJS</span></td>
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
			<form name="frm" id="frm" action="?mod=<?php echo($_GET["mod"]); ?>" method="post">
				<div class="panelcontainer" style="width: 100%;">
					<h3>FILTER DATA</h3>
					<div class="bodypanel bodyfilter" id="bodyfilter">
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td width='50%'>
									<label>Nama Pegawai :</label>
									<input type="text" name="nama" id="nama" class="form-control" placeholder=":::: NAMA PEGAWAI ::::" value="<?=$nama; ?>" />
								</td>
								<td width='50%'>
									<label>NIP :</label>
									<input type="text" name="nip" id="nip" class="form-control" placeholder=":::: NIP PEGAWAI ::::" value="<?=$nip; ?>" />
								</td>
							</tr>
						</table>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td width='70%'>
									<label>Pilih SKPD :</label>
									<select name="kode_skpd" id="kode_skpd" class="form-control">
										<option value="all">:::: SEMUA SKPD ::::</option>
										<?php
											$qs = "SELECT * FROM ref_skpd ORDER BY skpd ASC";
											$qr = mysql_query($qs) or die(mysql_error());
											while($skpd = mysql_fetch_array($qr)){
												echo "<option value='".$skpd['kode_skpd']."'>".$skpd['skpd']."</option>";
											}
										?>
									</select>
								</td>
							</tr>
						</table>
						<div class="kelang"></div>
						<table border="0px" cellspacing='0' cellpadding='0' width='20%'>
							<tr>
								<td>
									<button type="button" class="btn btn-success" onclick="proses();">Proses</button>
									<button type="reset" class="btn btn-default">Reset</button>
								</td>
							</tr>
						</table>
					</div>
				</div>
				</form>
				<div class="kelang"></div>
				<div class="panelcontainer" style="width: 100%;">
					<h3 style="text-align: left;">DAFTAR PEGAWAI</h3>
					<div class="bodypanel">
						<table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
							<thead>
								<tr class="headertable">
									<th width='40px'>No.</th>
									<th width='200px'>NAMA PEGAWAI</th>
									<th width='200px'>NIP</th>
									<th>SKPD / Unit Kerja</th>
									<th width='200px'>JABATAN</th>
									<th width='150px'>PANGKAT</th>
									<th width='90px'>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
							<script type="text/javascript">
								$.each(pegawai, function(i, item){
									document.write("<tr>");
										document.write("<td align='center'>" + item.no+ "</td>");
										document.write("<td>" + item.nama_pegawai+ "</td>");
										document.write("<td>" + item.nip+ "</td>");
										document.write("<td>" + item.skpd+ "</td>");
										document.write("<td>" + item.jabatan+ "</td>");
										document.write("<td align='center'>" + item.pangkat+ " (" + item.gol_ruang + ")</td>");
										document.write("<td><button type='button' class='btn btn-sm btn-success' style='width: 100%;' onclick='lanjut(" + item.id_pegawai + ");'><span class='glyphicon glyphicon-cog'></span>&nbsp;&nbsp;Proses</button></td>");
									document.write("</tr>");
								});
							</script>
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
 


