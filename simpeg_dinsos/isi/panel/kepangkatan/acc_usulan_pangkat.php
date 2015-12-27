<!-- CONTROLLER -->
<script type="text/javascript">
<?php
	$daftar = array();
    $sql_daftar = "SELECT
                    	a.id_pegawai, a.nama_pegawai, a.nip, a.gelar_depan, a.gelar_belakang,
                    	b.status_kepegawaian, c.jenis_kepegawaian, d.kedudukan_kepegawaian,
                    	e.jenis_kelamin, a.alamat, a.tanggal_lahir, f.skpd, g.pangkat, g.gol_ruang, h.jabatan,
                        i.id_detail , i.id_usulan, i.status, i.catatan 
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
		$row_daftar["id_usulan"] = $ds_daftar["id_usulan"];
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

  
    $pangkat = array();
    $sql_pangkat = "SELECT * FROM ref_pangkat";
    $res_pangkat = mysql_query($sql_pangkat);
    while($ds_pangkat = mysql_fetch_array($res_pangkat)){
        $row_pangkat["id_pangkat"] = $ds_pangkat["id_pangkat"];
        $row_pangkat["gol_ruang"] = $ds_pangkat["gol_ruang"];
        $row_pangkat["pangkat"] = $ds_pangkat["pangkat"];
        array_push($pangkat, $row_pangkat);
    }
    echo("var pangkat = " . json_encode($pangkat) . ";\n");
    
?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">

    $(document).ready(function(){
       // ambil_tanggal("tgl_usulan");
		$("#alert_add_sukses").click(function(){
			$(this).fadeOut('slow');
		});
		
		$("#cadis").dialog({
			autoOpen: false,
			height: 350,
			width: 600,
			modal: true,
			show: "fade",
			hide: "fade"
		});
		
		$("#dialog_cadis").dialog({
			autoOpen: false,
			height: 450,
			width: 650,
			modal: true,
			show: "fade",
			hide: "fade"
		});
    });

    function kembali(){
        document.location.href="?mod=daftar_usulan_kpk_sedang_diproses";
    }
	
	function terima_surat(id_usulan){
		jConfirm("Terima data surat usulan pencantuman gelar ini ?", "PERHATIAN", function(r){
            if(r){
                document.location.href = "php/kpk/terima_usulan_kenpang.php?id_usulan=" + id_usulan;
            }
        });	
	}
	
	function tolak_surat(id_usulan){
		jConfirm("Tolak data surat usulan pencantuman gelar ini ?", "PERHATIAN", function(r){
            if(r){
                document.location.href = "php/kpk/tolak_usulan_kenpang.php?id_usulan=" + id_usulan;
            }
        });	
	}
	
	function terima(id_detail, id_usulan){
		jConfirm("Terima data usulan pegawai?", "PERHATIAN", function(r){
            if(r){
                document.location.href = "php/kpk/terima_pegawai_kenpang.php?id=" + id_detail + "&id_usulan=" + id_usulan;
            }
        });		
	}
	
	function tolak(id_detail, id_usulan){
		$("#id_detail").val(id_detail);
		$("#id_usulan").val(id_usulan);
		$("#dialog_cadis").dialog("open");
	}
	
     function lihat_catatan(id_detail){
		$("#cadis").dialog("open");
			$.ajax({
					type: "GET",
					url: "ajax/catatan_pegawai_usulan_kenpang.php",
					data: "id_detail=" + id_detail,
					success: function(dt){
						$("#cadis").html(dt);
					}
			});	
		
    }
</script>
<!-- END OF JAVASCRIPT PAGE -->

	<?php
		$id = mysql_real_escape_string($_GET['id_usulan']); // prevent sql injection
		$qs = "SELECT * FROM tbl_usulan_pangkat WHERE id_usulan = '". $id ."'";
		$exec = mysql_query($qs) or die(mysql_error());
		$row = mysql_fetch_array($exec);

	?>
	

<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
          <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="">ACC SURAT USULAN KEPANGKATAN</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>ACC SURAT USULAN KEPANGKATAN</span></td>
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
				<div class="panelcontainer panelform" style="width: 100%;">

					<h3 style="text-align: left;">SUPERVISI SURAT USULAN KENAIKAN PANGKAT (ID DATA : <?=$row['id_usulan'];?>)</h3>
					<?php
						if(isset($_GET['code']) && isset($_GET['name'])){
							$name = base64_decode($_GET['name']);
							if($_GET['code'] == 1){	
								//echo "sukses";
								echo "<div class='alert alert-success' role='alert' id='alert_add_sukses' title='Klik Blok Notif ini untuk menghilangkan notifikasi'>";
								echo "<center><img src='image/icn_alert_success.png' width='18px;' />&nbsp;&nbsp;";
								echo "Anda Menerima Saudara/i <b>".$name."</b> ke dalam usulan Kenaikan Pangkat</b>.</center>";
								echo "</div>";
							}else if($_GET['code'] == 2){
								echo "<div class='alert alert-danger' role='alert' id='alert_add_sukses'  title='Klik Blok Notif ini untuk menghilangkan notifikasi'>";
								echo "<center><img src='image/icn_alert_warning.png' width='18px;' />&nbsp;&nbsp;";
								echo "Anda baru saja menambahkan catatan penolakan pada saudara/i ".$name."</b>.</center>";
								echo "</div>";
							}
						}else if(isset($_GET['notif'])){
							if($_GET['notif'] == 1){
								echo "<div class='alert alert-success' role='alert' id='alert_add_sukses' title='Klik Blok Notif ini untuk menghilangkan notifikasi'>";
								echo "<center><img src='image/icn_alert_success.png' width='18px;' />&nbsp;&nbsp;";
								echo "Data usulan Kenaikan Pangkat ini diterima.</center>";
								echo "</div>";
							}else{
								echo "<div class='alert alert-warning' role='alert' id='alert_add_sukses'  title='Klik Blok Notif ini untuk menghilangkan notifikasi'>";
								echo "<center><img src='image/icn_alert_warning.png' width='18px;' />&nbsp;&nbsp;";
								echo "Data usulan Kenaikan Pangkat ini telah ditolak.</center>";
								echo "</div>";
							}
						}	
					?>
					<button type="button" class="btn btn-lg btn-success" onclick="kembali();" style="margin-left:15px;margin-top:5px;">
					<span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;Kembali</button>
					<div class="bodypanel bodyfilter" id="bodyfilter">
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td>
									<label>NO. Surat Usulan :</label>
									<input type="hidden" name="id_usulan" id="id_usulan" value="<?=$row['id_usulan'];?>"/>
									<input type="hidden" name="no_usulan_lama" id="no_usulan_lama" value="<?=$row['no_usulan'];?>" />
									<input type="text" style='width:90%;' name="no_usulan" id="no_usulan" class="form-control" value="<?=$row['no_usulan'];?>" readonly="readonly"/>
								</td>
								<td>
									<label>Tgl. Surat Usulan :</label>
									<input type="text" style='width:90%;' name="tgl_usulan" id="tgl_usulan" class="form-control" value="<?=$row['tgl_usulan'];?>" readonly="readonly"/>
								</td>
							</tr>
						</table>
						<div class="kelang"></div>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td align='left'>
									<button type="button" class="btn btn-success" onclick="terima_surat('<?=$_GET['id_usulan'];?>');">Terima Surat</button>
									<button type="button" class="btn btn-warning" onclick="tolak_surat('<?=$_GET['id_usulan'];?>');">Tolak Surat</button>
								</td>
							</tr>
						</table><br/>
						<span style="font-weight:bold;">NB : Sebelum anda menerima atau menolak data surat ini, sebaiknya terlebih dahulu supervisi daftar pegawai yang diusulkan, setelah semua sudah terasa valid, baru anda bisa mengklik terima atau tolak data surat ini.</span>
					</div>
				</div>
				<div class="kelang"></div>
				<div class="panelcontainer" style="width: 100%;">
					<h3 style="text-align: left;">DAFTAR PEGAWAI YANG DIUSULKAN</h3>
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
								<th width='50px'>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
						<script type="text/javascript">
							$.each(daftar, function(i, item){
								var text = "";
								var id_usulan = "<?=$_GET["id_usulan"];?>";
								text += "<tr>";
									text += "<td style='text-align: center;'>" + (i+1) + "</td>";
									text += "<td style='text-align: center;'>" + item.nama_pegawai + "</td>";
									text += "<td style='text-align: center;'>" + item.nip + "</td>";
									text += "<td style='text-align: center;'>" + item.pangkat + " (" + item.gol_ruang + ")</td>";
									text += "<td style='text-align: center;'>" + item.jabatan + "</td>";
									text += "<td style='text-align: center;'>" + item.skpd + "</td>";
								if(item.status == 1 && item.catatan == ""){	
									text += "<td style='text-align: center;'><button type='button' title='Tolak' class='btn btn-sm btn-warning' style='width: 100%;' onclick='tolak(" + item.id_detail + ", "+ id_usulan +");'>Tolak&nbsp;<span class='glyphicon glyphicon-cog'></span></button></td>";
								 text += "<td style='text-align: center;'><button type='button' title='Terima' class='btn btn-sm btn-success' style='width: 100%;' onclick='terima(" + item.id_detail + ", "+ id_usulan +");'>Terima&nbsp;<span class='glyphicon glyphicon-cog'></span></button></td>";
								 }else if(item.status == 3){
									 text += "<td style='text-align: center;'><span style='color:green;'>Telah di ACC</span></td>";
									 text += "<td style='text-align: center;'><button type='button' title='Tolak' class='btn btn-sm btn-warning' style='width: 100%;' onclick='tolak(" + item.id_detail + ", "+ id_usulan +");'>Tolak&nbsp;<span class='glyphicon glyphicon-cog'></span></button></td>";
								 
								 }else if(item.status == 1 && item.catatan != ""){
									text += "<td><img src='image/icon-disposisi.png' width='18px' class='linkimage' title='Lihat Catatan Penolakan' onclick='lihat_catatan("+  item.id_detail +");'/></td>";
									 text += "<td style='text-align: center;'><button type='button' title='Terima' class='btn btn-sm btn-success' style='width: 100%;' onclick='terima(" + item.id_detail + ", "+ id_usulan +");'>Terima&nbsp;<span class='glyphicon glyphicon-cog'></span></button></td>";
								 
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
 

<!-- DIALOG JQUERY -->
<div id="dialog_cadis" title="CATATAN PENOLAKAN PEGAWAI USULAN " style="display: none;">
<form name="frm_add_supervisi_pg" id="frm_add_supervisi_pg" action="php/kpk/catatan_usulan_kenpang.php" method="POST">
<input type="hidden" id="id_textbox" />
<div class="panelcontainer" style="width: 100%;">
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
				<input type="hidden" name="id_detail" id="id_detail" />
				<input type="hidden" name="id_usulan" id="id_usulan" />
                <label>Masukan Catatan Penolakan ( *opsional )</label>
				<textarea name="catatan" id="catatan" placeholder=":: Masukan Catatan Penolakan Jika Pegawai Yang bersangkutan ditolak usulannya (opsional) ::"></textarea>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='20%'>
            <tr>
                <td width='50%'><input type="submit" value="Konfirmasi Penolakan" style="height: 30px; width: 140px;" class="btn btn-sm btn-success" /></td>
            </tr>
        </table>
    </div>
</div>
</form>
</div>
<!-- ------------- -->
<div id="cadis" title="LIHAT CATATAN SUPERVISI PEGAWAI" style="display: none;">
</div>