<?php
	$id_usulan = mysql_real_escape_string(trim(strip_tags($_GET["id_usulan"])));
?>
<!-- CONTROLLER -->
<script type="text/javascript">
<?php
	// JSON listing daftar pegawai
	$daftar = array();
    $sql_daftar = "SELECT
                    	a.id_pegawai, a.nama_pegawai, a.nip, a.gelar_depan, a.gelar_belakang,
                    	b.status_kepegawaian, c.jenis_kepegawaian, d.kedudukan_kepegawaian,
                    	e.jenis_kelamin, a.alamat, a.tanggal_lahir, f.skpd, g.pangkat, g.gol_ruang, h.jabatan, 
                        i.id_detail, i.status, i.catatan 
                    FROM
                    	tbl_pegawai a
                    	LEFT JOIN ref_status_kepegawaian b ON a.id_status_kepegawaian = b.id_status_kepegawaian
                    	LEFT JOIN ref_jenis_kepegawaian c ON a.id_jenis_kepegawaian = c.id_jenis_kepegawaian
                    	LEFT JOIN ref_kedudukan_kepegawaian d ON a.id_kedudukan_kepegawaian = d.id_kedudukan_kepegawaian
                    	LEFT JOIN ref_jenis_kelamin e ON a.id_jenis_kelamin = e.id_jenis_kelamin
                    	LEFT JOIN ref_skpd f ON a.id_satuan_organisasi = f.id_skpd
                    	LEFT JOIN ref_pangkat g ON a.id_pangkat = g.id_pangkat
                    	LEFT JOIN ref_jabatan h ON a.id_jabatan = h.id_jabatan
                    	INNER JOIN tbl_detail_usulan_pangkat i ON (a.id_pegawai = i.id_pegawai AND i.id_usulan = '" . $_GET["id_usulan"] . "')
                    ORDER BY
                    	i.id_detail ASC";
						
    $res_daftar = mysql_query($sql_daftar);
    while($ds_daftar = mysql_fetch_array($res_daftar)){
		$row_daftar["id_detail"] = $ds_daftar["id_detail"];
        $row_daftar["nama_pegawai"] = $ds_daftar["nama_pegawai"];
        $row_daftar["nip"] = $ds_daftar["nip"];
        $row_daftar["pangkat"] = $ds_daftar["pangkat"];
        $row_daftar["gol_ruang"] = $ds_daftar["gol_ruang"];
        $row_daftar["jabatan"] = $ds_daftar["jabatan"];
        $row_daftar["skpd"] = $ds_daftar["skpd"];
		$row_daftar["status"] = $ds_daftar["status"];
		$row_daftar["catatan"] = $ds_daftar["catatan"];
        array_push($daftar, $row_daftar);
    }
    echo("var daftar = " . json_encode($daftar) . ";\n");
	
?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">

    $(document).ready(function(){
        ambil_tanggal("tgl_usulan");
		
		   // set the catatan supervisi dialog
		$("#cadis").dialog({
			autoOpen: false,
			height: 200,
			width: 650,
			modal: true,
			show: "fade",
			hide: "fade"
		});
		
    });
    
    function simpan(){
		var nip = $("#nip").val();
		var id_pang_baru = $("#id_pangkat_baru").val();
		if(nip == '' || id_pang_baru == 0){
			jAlert("Maaf, mohon ditambahkan NIP dan Pangkat Baru Pegawai Yang Diusulkan !!", "PERHATIAN");
			return false;
		}else{
			$("#frm").submit();
		}	
    }
    
    function kembali(){
        document.location.href="?mod=daftar_kpk";
    }
    
	
	function lihat_catatan(id_detail){
		$("#cadis").dialog("open");
			$.ajax({
					type: "GET",
					url: "ajax/catatan_pegawai_usulan_pangkat.php",
					data: "id_detail=" + id_detail,
					success: function(r){
						$("#cadis").html(r);
					}
			});	
		
    }
	
	function hapus(id_detail){
        jConfirm("Anda yakin akan menghapus data ini?", "PERHATIAN", function(r){
            if(r){
                var id_usulan = <?php echo $id_usulan; ?>;
                document.location.href="php/kpk/pop_list_pegawai_pangkat.php?id_usulan=" + id_usulan + "&id_detail=" + id_detail;
            }
        });
    }
    
    
</script>
<!-- END OF JAVASCRIPT PAGE -->

<?php
	$id_usul = mysql_real_escape_string($_GET['id_usulan']);
	$sql = "SELECT * FROM tbl_usulan_pangkat WHERE id_usulan = '". $id_usul ."'";
	$query = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_array($query);
?>


<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
          <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="">TAMBAH USULAN KENAIKAN PANGKAT</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>TAMBAH USULAN KENAIKAN PANGKAT</span></td>
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
		
			<form name="frm" id="frm" action="php/kpk/usulan_pangkat_push.php" method="POST">
			<div class="panelcontainer panelform" style="width: 100%;">

				<h3 style="text-align: left;">TAMBAH PEGAWAI SURAT USULAN KENAIKAN PANGKAT</h3>
				<div class="bodypanel bodyfilter" id="bodyfilter">
					<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
						<tr>
							<td>
								<div class="input-group">
									<input type="hidden" name="id_usulan" id="id_usulan" value="<?php echo($_GET["id_usulan"]); ?>" />
									<input type="text" class="form-control" placeholder="Search NIP" id="nip" name="nip" />
									<span class="input-group-btn">
										<button type="button" class="btn bnt-sm btn-success" onclick="show_auto_search_pegawai('nip');"><span class='glyphicon glyphicon-search'></span>&nbsp;&nbsp;Search</button>
									</span>
								</div>
							</td>
						</tr>
					</table>
					<div class="kelang"></div>
					<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
						<tr>
							<td width='50%'>
									<label>Jabatan Baru Pegawai Yang Diusulkan :</label>
									<select name="id_jabatan_baru" id="id_jabatan_baru" class="form-control">
										<option value="0">----- Pilih Jabatan -----</option>
									<?php	
										// data untuk daftar jabatan
										$sql_jab = "SELECT * FROM ref_jabatan ORDER BY id_jabatan ASC ";
										$res_jab = mysql_query($sql_jab);
										while($ds_jab = mysql_fetch_array($res_jab)){
											echo "<option value='". $ds_jab["id_jabatan"]."'>".$ds_jab["jabatan"]."</option>";	
										}
									?>	
									</select>
							
							</td>
							<td>
							
									<label>Pangkat Baru Pegawai Yang Diusulkan :</label>
									<select name="id_pangkat_baru" id="id_pangkat_baru" class="form-control">
										<option value="0">----- Pilih Pangkat -----</option>
									<?php
										
											// data untuk daftar pangkat
											$sql_pangkat = "SELECT * FROM ref_pangkat";
											$res_pangkat = mysql_query($sql_pangkat);
											while($ds_pangkat = mysql_fetch_array($res_pangkat)){
												echo "<option value='".$ds_pangkat["id_pangkat"]."'>".$ds_pangkat["pangkat"]." (".$ds_pangkat["gol_ruang"].")</option>";
											}
			  
									?>		
									</select>
							
							</td>
						</tr>
					
					</table> 
					<div class="kelang"></div>
					<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
						<tr>
							<td align='left'>
								<button type="button" class="btn btn-success" onclick="simpan();"><span class='glyphicon glyphicon-floppy-disk'></span>&nbsp;&nbsp;Tambah</button>
								<button type="button" class="btn btn-warning" onclick="kembali();"><span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;Kembali</button>
							</td>
						</tr>
					</table>
				</div>
			</div>
			</form>
			<div class="kelang"></div>
			<div class="panelcontainer" style="width: 100%;">
				<h3 style="text-align: left;">DAFTAR PEGAWAI USULAN KENAIKAN PANGKAT</h3>
				<div class="bodypanel">
					<table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
					<thead>
						<tr class="headertable">
							<th width='40px'>No.</th>
							<th width='200px'>Nama Pegawai</th>
							<th width='150px'>NIP</th>
							<th width='150px'>Pangkat</th>
							<th width='200px'>Jabatan</th>
							<th>SKPD</th>
							<th width='50px'>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
					<script type="text/javascript">
						$.each(daftar, function(i, item){
							var text = "";
							var id_usulan = "<?=$id_usul;?>";
							text += "<tr>";
								text += "<td style='text-align: center;'>" + (i+1) + "</td>";
								text += "<td style='text-align: center;'>" + item.nama_pegawai + "</td>";
								text += "<td style='text-align: center;'>" + item.nip + "</td>";
								text += "<td style='text-align: center;'>" + item.pangkat + " (" + item.gol_ruang + ")</td>";
								text += "<td style='text-align: center;'>" + item.jabatan + "</td>";
								text += "<td style='text-align: center;'>" + item.skpd + "</td>";
							 if(item.status == 1 && item.catatan == ""){	
								text += "<td style='text-align: center;'><button type='button' title='Hapus Data' class='btn btn-sm btn-success' style='width: 100%;' onclick='hapus(" + item.id_detail + ");'><span class='glyphicon glyphicon-trash'></span></button></td>";
							 }else if(item.status == 1 && item.catatan != ""){
								text += "<td><img src='image/icon-disposisi.png' width='18px' class='linkimage' title='Lihat Catatan Penolakan' onclick='lihat_catatan("+  item.id_detail +");'/></td>";
							 }else if(item.status == 3){
								 text += "<td style='text-align: center;'><span style='color:green;'>Telah di ACC</span></td>";
							 }	
							
							text += "</tr>";
							document.write(text);
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
 
<!-- DIALOG --->
<div id="cadis" title="LIHAT CATATAN SUPERVISI PEGAWAI" style="display: none;">
</div>