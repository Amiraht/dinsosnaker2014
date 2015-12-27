<!-- CONTROLLER -->
<?php
  /* Hasil filter data pegawai */
	if(isset($_POST['tahun'])){
		$pegawai = array();
		$sql_pegawai = "SELECT
                    	aa.id_wajib_lhkpn, a.id_pegawai, a.nama_pegawai, a.nip,
                    	b.pangkat, b.gol_ruang,
                    	c.jabatan, d.skpd
                    FROM
                    	tbl_pegawai a
                    	LEFT JOIN tbl_lhkpn_wajib aa ON (a.id_pegawai = aa.id_pegawai AND aa.tahun = '" . $_POST["tahun"] . "')
                    	LEFT JOIN ref_pangkat b ON aa.id_pangkat = b.id_pangkat
                    	LEFT JOIN ref_jabatan c ON aa.id_jabatan = c.id_jabatan
                    	LEFT JOIN ref_skpd d ON aa.id_skpd = d.id_skpd
                    WHERE
                    	aa.id_pegawai IS NOT NULL
                    ORDER BY
                    		a.nama_pegawai ASC";
		//echo($sql_pegawai);
		$res_pegawai = mysql_query($sql_pegawai);
		$no_pegawai = 0;
		while($ds_pegawai = mysql_fetch_array($res_pegawai)){
			$no_pegawai++;
			$row_pegawai["no"] = $no_pegawai;
			$row_pegawai["id_wajib_lhkpn"] = $ds_pegawai["id_wajib_lhkpn"];
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

    function get_jabatan(){
        var kode_skpd = $("#kode_skpd").val();
        var id_tipe_jabatan = $("#id_tipe_jabatan").val();
        var ldg = "<tr>";
                ldg += "<td style='text-align: center;' colspan='3'>Loading ...</td>";
            ldg += "</tr>";
        $("#daftarjabatan").append(ldg);
        $.ajax({
            type : "post",
            url : "ajax/get_jabatan_json.php",
            data : "kode_skpd=" + kode_skpd + "&id_tipe_jabatan=" + id_tipe_jabatan,
            dataType : "json",
            success : function(r){
                //alert(r);
                $("#daftarjabatan").html("");
                $.each(r, function(i, item){
                    var text = "<tr>";
                            text += "<td style='text-align: center;'><input type='checkbox' class='chkjabatan' nilai='" + item.only_jabatan + "' /></td>";
                            text += "<td style='text-align: center;'>" + (i+1) + "</td>";
                            text += "<td>" + item.jabatan + "</td>";
                        text += "</tr>";
                    $("#daftarjabatan").append(text);
                });
            }
        });
        //alert(kode_skpd);
    }
    
    function cekall(){
        $(".chkjabatan").each(function(){
            if($("#chkall").is(":checked"))
                $(this).prop('checked', true);
            else
                $(this).prop('checked', false);
        });
    }
    
    function simpan_wajib(){
        $("#kode_skpd_input").val("");
        $("#jabatan_list").val("");
        var namjab = "";
        $(".chkjabatan").each(function(){
            if($(this).is(":checked")){
                namjab += $(this).attr("nilai") + "<s>";
            }
        });
        $("#kode_skpd_input").val($("#kode_skpd").val());
        $("#jabatan_list").val(namjab);
        $("#frm").submit();
    }
    
    function filter(){
        $("#frm_filter").submit();
    }
    
    function hapus(id_wajib_lhkpn){
        jConfirm("Anda yakin akan menghapus data ini?", "PERHATIAN", function(r){
            if(r){
                $.ajax({
                    url : "php/lhkpn/lhkpn_pop_wajib.php",
                    type : "post",
                    dataType : "text",
                    data : "id_wajib_lhkpn=" + id_wajib_lhkpn,
                    success : function(r){
                        filter();
                    }
                });
            }
        });
    }
    
</script>
<!-- END OF JAVASCRIPT PAGE -->

<!-- JAVASCRIPT FROM CHILD -->
<script type="text/javascript">

    function something_wrong(what_is_wrong){
        jAlert(what_is_wrong, "PERHATIAN");
    }
    function success(){
        jAlert("Data pegawai yang wajib LHKPN telah disimpan", "PERHATIAN", function(r){
            filter();
        });
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
                                <h1><a style="color:#AA9F00;" href="">DATA WAJIB LHKPN</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>DATA WAJIB LHKPN</span></td>
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
		
					<!-- END OF JAVASCRIPT FROM CHILD -->
					<form name="frmsrc" id="frmsrc" action="?mod=<?php echo($_GET["mod"]); ?>" method="post" target="sbm_target" enctype="multipart/form-data">
					<div class="panelcontainer panelform" style="width: 100%;">
						<h3 style="text-align: left;">SEARCH PEGAWAI YANG AKAN DIMASUKKAN KEDALAM DATA WAJIB LHKPN</h3>
						<div class="bodypanel bodyfilter" id="bodyfilter">
							<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
								<tr>
									<td>
										<label>SKPD :</label>
										<div class="input-group">
											<select name="kode_skpd" id="kode_skpd" class="form-control">
												<option value="all">----- Semua SKPD -----</option>
											<?php
												$sq = "SELECT * FROM ref_skpd ORDER BY skpd ASC";
												$ex = mysql_query($sq) or die(mysql_error());
												while($dt = mysql_fetch_array($ex)){
													echo "<option value='".$dt['kode_skpd']."'>".$dt['skpd']."</option>";
												}
												
											?>	
											</select>
											<span class="input-group-btn">
											  <button class="btn btn-default" type="button" onclick="get_jabatan();"><span class='glyphicon glyphicon-search'></span></button>
											</span>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label>Tipe Jabatan :</label>
										<div class="input-group">
											<select name="id_tipe_jabatan" id="id_tipe_jabatan" class="form-control">
											<?php
												$jq = "SELECT * FROM ref_tipe_jabatan";
												$qr = mysql_query($jq) or die(mysql_error());
												if($jb = mysql_fetch_array($qr)){
													echo "<option value='".$jb['id_tipe_jabatan']."'>".$jb['tipe_jabatan']."</option>";
												}
											?>
											</select>
											<span class="input-group-btn">
											  <button class="btn btn-default" type="button" onclick="get_jabatan();"><span class='glyphicon glyphicon-search'></span></button>
											</span>
										</div>
									</td>
								</tr>
							</table>
							
							<div class="kelang"></div>
							
							<table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtablebackup table-bordered">
								<thead>
									<tr>
										<th width='50px' style="text-align: center;"><input type="checkbox" id="chkall" onclick="cekall();" /></th>
										<th width='50px' style="text-align: center;">NO.</th>
										<th style="text-align: center;">NAMA JABATAN</th>
									</tr>
								</thead>
								<tbody id="daftarjabatan"></tbody>
							</table>
							
							<table border="0px" cellspacing='0' cellpadding='0' width='100%' style="display: none;">
								<tr>
									<td>
										<button type="submit" class="btn btn-success"><span class='glyphicon glyphicon-search'></span>&nbsp;&nbsp;Search</button>
									</td>
								</tr>
							</table>
						</div>
					</div>
					</form>

					<div class="kelang"></div>

					<form name="frm" id="frm" action="php/lhkpn/lhkpn_push_wajib.php" method="post" target="sbm_target" enctype="multipart/form-data">
					<div class="panelcontainer panelform" style="width: 100%;">
						<h3 style="text-align: left;">TAMBAH PEGAWAI YANG DI CEKLIST DIATAS SEBAGAI WAJIB LHKPN</h3>
						<div class="bodypanel bodyfilter" id="bodyfilter">
							<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
								<tr>
									<td>
										<label>Tahun LHKPN :</label>
										<input type="hidden" name="kode_skpd_input" id="kode_skpd_input" />
										<input type="hidden" name="jabatan_list" id="jabatan_list" />
										<input type="text" name="tahun_lhkpn" id="tahun_lhkpn" />
									</td>
								</tr>
							</table>
							<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
								<tr>
									<td align='left'>
										<button type="button" class="btn btn-success" onclick="simpan_wajib();"><span class='glyphicon glyphicon-plus'></span>&nbsp;&nbsp;Tambah</button>
									</td>
								</tr>
							</table>
						</div>
					</div>
					<iframe src="" style="display: none;" id="sbm_target" name="sbm_target"></iframe>
					</form>

					<div class="kelang"></div>

					<div class="panelcontainer" style="width: 100%;">
						<h3 style="text-align: left;">DAFTAR PEGAWAI WAJIB LHKPN TAHUN <?=isset($_POST["tahun"]) ? $_POST["tahun"] : ""; ?></h3>
						<div class="bodypanel">
							<form name="frm_filter" id="frm_filter" action="?mod=<?php echo($_GET["mod"]); ?>" method="post">
								<table border="0px" cellspacing='0' cellpadding='0' width='20%'>
									<tr>
										<td width='50%'>
											<label>Tahun LHKPN :</label>
											<input type="text" name="tahun" id="tahun" class="form-control" placeholder=":::: TAHUN LHKPN ::::" value="<?=isset($_POST["tahun"]) ? $_POST['tahun'] : ""; ?>" />
										</td>
									</tr>
								</table>
								<table border="0px" cellspacing='0' cellpadding='0' width='20%'>
									<tr>
										<td>
											<button type="button" class="btn btn-info" onclick="filter();">Filter Data</button>
										</td>
									</tr>
								</table>
							</form>
							<div class="kelang"></div>
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
											document.write("<td><button type='button' class='btn btn-sm btn-warning' style='width: 100%;' onclick='hapus(" + item.id_wajib_lhkpn + ");'><span class='glyphicon glyphicon-trash'></span>&nbsp;&nbsp;Hapus</button></td>");
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
 

