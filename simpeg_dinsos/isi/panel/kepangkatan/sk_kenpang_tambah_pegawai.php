<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $daftar = array();
    $sql_daftar = "SELECT 
				a.*, b.nama_pegawai, b.nip, c.skpd, d.pangkat, d.gol_ruang, e.jabatan  
			FROM
				tbl_sk_kenpang_detail a
				LEFT JOIN tbl_pegawai b ON a.id_pegawai = b.id_pegawai 
				LEFT JOIN ref_skpd c ON b.id_satuan_organisasi = c.id_skpd
				LEFT JOIN ref_pangkat d ON b.id_pangkat = d.id_pangkat
				LEFT JOIN ref_jabatan e ON b.id_jabatan = e.id_jabatan
			WHERE
				a.id_sk = '". $_GET['id_data'] ."' 
			ORDER BY
			    b.nama_pegawai ASC
		   ";
	
    $res_daftar = mysql_query($sql_daftar);
    while($ds_daftar = mysql_fetch_array($res_daftar)){
        $row_daftar["id_detail"] = $ds_daftar["id_detail"];
		$row_daftar["id_sk"] = $ds_daftar["id_sk"];
        $row_daftar["nama_pegawai"] = $ds_daftar["nama_pegawai"];
        $row_daftar["nip"] = $ds_daftar["nip"];
        $row_daftar["pangkat"] = $ds_daftar["pangkat"];
        $row_daftar["gol_ruang"] = $ds_daftar["gol_ruang"];
        $row_daftar["jabatan"] = $ds_daftar["jabatan"];
        $row_daftar["skpd"] = $ds_daftar["skpd"];
		$row_daftar["status"] = $ds_daftar["status"];
        array_push($daftar, $row_daftar);
    }
    echo("var daftar = " . json_encode($daftar) . ";\n");
?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">
$(document).ready(function(){
	$('#alert_add_sukses').click(function(){
		$(this).fadeOut('slow');
	});
});
</script>
<!-- END OF JAVASCRIPT PAGE -->

<!-- JAVASCRIPT FROM CHILD -->
<script type="text/javascript">

function kembali(){
		var id_level = "<?=$_SESSION['simpeg_id_level'];?>";
		if(id_level == 12){
			 document.location.href="?mod=kenpang_daftar_sk_diusulkan";
		}else{
			 document.location.href="?mod=kenpang_daftar_sk";
		}   
    }

function hapus(id_detail, id_sk){
        jConfirm("Hapus pegawai dari daftar lampiran SK ?", "KONFIRMASI", function(r){
            if(r){
                document.location.href = "php/kpk/hapus_pegawai_sk.php?id_detail=" + id_detail + "&id_sk=" + id_sk;
            }
        });
    }    
</script>
<!-- END OF JAVASCRIPT FROM CHILD -->


<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
          <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="">TAMBAH PEGAWAI KE SK</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>TAMBAH PEGAWAI KE SK KEPANGKATAN</span></td>
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
		
				<form id="frm_add_peg_1" action="php/kpk/sk_kenpang_tambah_pegawai.php" method="POST">
				<input type="hidden" name="id_sk" value="<?=$_GET['id_data'];?>"/>
				<div class="panelcontainer panelform" style="width: 100%;">
					<h3 style="text-align: left;">TAMBAH PEGAWAI</h3>
					<button type="button" class="btn btn-lg btn-success" onclick="kembali();" style="margin-left:15px;margin-top:5px;">
					<span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;Kembali</button>
					<div class="bodypanel bodyfilter" id="bodyfilter">
						 <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td>
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Cari Pegawai berdasarkan NIP" id="nip" name="nip" />
										<span class="input-group-btn">
											<button type="button" class="btn bnt-sm btn-success" onclick="show_auto_search_pegawai('nip');"><span class='glyphicon glyphicon-search'></span>&nbsp;&nbsp;Search</button>
										</span>
									</div>
								</td>
							</tr>
						</table>
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
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td align='left'>
									<input type="submit" class="btn btn-success" id="btn_submit" style="width:120px;height:35px;" value="Tambah" />
									<input type="reset" class="btn btn-warning" style="width:120px;height:35px;" value="Reset" />
								</td>
							</tr>
						</table><br/>
					</div>
				</div>
				</form>
				<div class="kelang"></div>

				<form id="frm_add_peg_2" action="php/kpk/sk_kenpang_tambah_pegawai_2.php" method="POST">
				<input type="hidden" name="id_sk" value="<?=$_GET['id_data'];?>"/>
				<div class="panelcontainer panelform" style="width: 100%;">
					<h3 style="text-align: left;">TAMBAH PEGAWAI BERDASARKAN NO USULAN KEPANGKATAN</h3>
					<button type="button" class="btn btn-lg btn-success" onclick="kembali();" style="margin-left:15px;margin-top:5px;">
					<span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;Kembali</button>
					<div class="bodypanel bodyfilter" id="bodyfilter">
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td>
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Cari Pegawai Berdasarkan No Usulan Kepangkatan" id="nip_11" name="nip_11" />
										<span class="input-group-btn">
											<button type="button" class="btn bnt-sm btn-success" onclick="show_list_pegawai_usulan_kenpang('nip_11');"><span class='glyphicon glyphicon-search'></span>&nbsp;&nbsp;Search</button>
										</span>
									</div>
								</td>
							</tr>
						</table>
					
						<div class="kelang"></div>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td align='left'>
									<input type="submit" class="btn btn-success" id="btn_submit" style="width:120px;height:35px;" value="Tambah" />
									<input type="reset" class="btn btn-warning" style="width:120px;height:35px;" value="Reset" />
								</td>
							</tr>
						</table><br/>
					</div>
				</div>
				</form>
				<div class="kelang"></div>


				<div class="panelcontainer" style="width: 100%;">
					<h3 style="text-align: left;">DAFTAR PEGAWAI DALAM LAMPIRAN SK	</h3>
					<div class="bodypanel">
						<table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
						<thead>
							<tr class="headertable">
								<th width='40px'>No.</th>
								<th width='200px'>Nama Pegawai</th>
								<th width='150px'>NIP</th>
								<th width='150px'>Pangkat</th>
								<th width='200px'>Jabatan</th>
								<th width='200px'>Unit Kerja / SKPD</th>
								<th width='50px'>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
						<script type="text/javascript">
							$.each(daftar, function(i, item){
								var text = "";
								text += "<tr>";
									text += "<td style='text-align: center;'>" + (i+1) + "</td>";
									text += "<td style='text-align: center;'>" + item.nama_pegawai + "</td>";
									text += "<td style='text-align: center;'>" + item.nip + "</td>";
									text += "<td style='text-align: center;'>" + item.pangkat + " (" + item.gol_ruang + ")</td>";
									text += "<td style='text-align: center;'>" + item.jabatan + "</td>";
									text += "<td style='text-align: center;'>" + item.skpd + "</td>";
									text += "<td style='text-align: center;'><button type='button' title='Hapus Data' class='btn btn-sm btn-success' style='width: 100%;' onclick='hapus(" + item.id_detail + ", "+ item.id_sk +");'><span class='glyphicon glyphicon-trash'></span></button></td>";
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
 

