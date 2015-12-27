<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $daftar = array();
    $sql_daftar = "SELECT
                    	a.id_pegawai, a.nama_pegawai, a.nip, a.gelar_depan, a.gelar_belakang,
                    	b.status_kepegawaian, c.jenis_kepegawaian, d.kedudukan_kepegawaian,
                    	e.jenis_kelamin, a.alamat, a.tanggal_lahir, f.skpd, g.pangkat, g.gol_ruang, h.jabatan,
                        i.id_detail_gaji_berkala, i.id_usulan_pg_detail, i.status, i.catatan 
                    FROM
                    	tbl_pegawai a
                    	LEFT JOIN ref_status_kepegawaian b ON a.id_status_kepegawaian = b.id_status_kepegawaian
                    	LEFT JOIN ref_jenis_kepegawaian c ON a.id_jenis_kepegawaian = c.id_jenis_kepegawaian
                    	LEFT JOIN ref_kedudukan_kepegawaian d ON a.id_kedudukan_kepegawaian = d.id_kedudukan_kepegawaian
                    	LEFT JOIN ref_jenis_kelamin e ON a.id_jenis_kelamin = e.id_jenis_kelamin
                    	LEFT JOIN ref_skpd f ON a.id_satuan_organisasi = f.id_skpd
                    	LEFT JOIN ref_pangkat g ON a.id_pangkat = g.id_pangkat
                    	LEFT JOIN ref_jabatan h ON a.id_jabatan = h.id_jabatan
                    	INNER JOIN tbl_usulan_pg_detail i ON (a.id_pegawai = i.id_pegawai AND i.id_usulan = '" . $_GET["id_usulan"] . "')
                    ORDER BY
                    	i.id_detail_gaji_berkala DESC";
						
    $res_daftar = mysql_query($sql_daftar);
    while($ds_daftar = mysql_fetch_array($res_daftar)){
        $row_daftar["id_detail_gaji_berkala"] = $ds_daftar["id_detail_gaji_berkala"];
		$row_daftar["id_detail"] = $ds_daftar["id_usulan_pg_detail"];
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
        $("#alert_add_sukses").click(function(){
			$(this).fadeOut('slow');
		});
		
		// set the catatan supervisi dialog
		$("#cadis").dialog({
			autoOpen: false,
			height: 300,
			width: 600,
			modal: true,
			show: "fade",
			hide: "fade"
		});
		
		// set the catatan supervisi dialog
		$("#catatan_supervisi").dialog({
			autoOpen: false,
			height: 350,
			width: 800,
			modal: true,
			show: "fade",
			hide: "fade"
		});
		
    });
    
    function simpan(){
        var nip = $("#nip").val();
        if(nip == "")
            jAlert("Pilih pegawai yang akan diusulkan dahulu", "PERHATIAN");
        else
            $("#frm").submit();
    }
    
   
    function kembali(){
	     document.location.href="?mod=pg_daftar_usulan_proses";
	}
	
	function tolak(id_detail, id_usulan){
		$("#id_detail_pg").val(id_detail);
		$("#id_usulan").val(id_usulan);
		$("#catatan_supervisi").dialog("open");
	}
	
	function terima(id_detail, id_usulan){
		jConfirm("Terima data usulan pegawai?", "PERHATIAN", function(r){
            if(r){
                document.location.href = "php/pg/acc_usulan_pg.php?id=" + id_detail + "&id_usulan=" + id_usulan;
            }
        });		
	}
	
	function terima_surat(id_usulan){
		jConfirm("Terima data surat usulan pencantuman gelar ini ?", "PERHATIAN", function(r){
            if(r){
                document.location.href = "php/pg/terima_usulan_pg.php?id_usulan=" + id_usulan;
            }
        });	
	}
	
	function tolak_surat(id_usulan){
		jConfirm("Tolak data surat usulan pencantuman gelar ini ?", "PERHATIAN", function(r){
            if(r){
                document.location.href = "php/pg/tolak_usulan_pg.php?id_usulan=" + id_usulan;
            }
        });	
	}
	
    function lihat_catatan(id_detail){
		$("#cadis").dialog("open");
			$.ajax({
					type: "GET",
					url: "ajax/catatan_pegawai_usulan_pg.php",
					data: "id_detail=" + id_detail,
					success: function(r){
						$("#cadis").html(r);
					}
			});	
		
    }
</script>
<!-- END OF JAVASCRIPT PAGE -->
<?php
	$id_usul = mysql_real_escape_string($_GET['id_usulan']);
	$sql = "SELECT * FROM tbl_usulan_pg WHERE id_usulan = '". $id_usul ."'";
	$qr = mysql_query($sql) or die(mysql_error());
	$dt = mysql_fetch_array($qr);
?>
<form name="frm" id="frm" action="php/pg/pg_daftar_usulan_push_diusulkan.php" method="post">
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">SUPERVISI DATA USULAN PENCANTUMAN GELAR</h3>
	<?php
		if(isset($_GET['code']) && isset($_GET['name'])){
			$name = base64_decode($_GET['name']);
			if($_GET['code'] == 1){	
				//echo "sukses";
				echo "<div class='alert alert-success' role='alert' id='alert_add_sukses' title='Klik Blok Notif ini untuk menghilangkan notifikasi'>";
				echo "<center><img src='image/icn_alert_success.png' width='18px;' />&nbsp;&nbsp;";
				echo "Anda Menerima Saudara/i <b>".$name."</b> ke dalam usulan Pencantuman Gelar</b>.</center>";
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
				echo "Data usulan pencantuman gelar ini diterima.</center>";
				echo "</div>";
			}else{
				echo "<div class='alert alert-warning' role='alert' id='alert_add_sukses'  title='Klik Blok Notif ini untuk menghilangkan notifikasi'>";
				echo "<center><img src='image/icn_alert_warning.png' width='18px;' />&nbsp;&nbsp;";
				echo "Data usulan pencantuman gelar ini telah ditolak.</center>";
				echo "</div>";
			}
		}	
	?>	
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td align='left'>
                    <button type="button" class="btn btn-success" onclick="kembali();"><span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;Kembali</button>
                </td>
            </tr>
			<tr>
				
			</tr>
        </table>
		<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
                    <label>NO. Surat Usulan :</label>
                    <input type="text" name="no_usulan" id="no_usulan" class="form-control" value="<?=$dt['no_usulan'];?>" readonly="readonly" />
                </td>
                <td>
                    <label>Tgl. Surat Usulan :</label>
                    <input type="text" name="tgl_usulan" id="tgl_usulan" class="form-control" value="<?=$dt['tgl_usulan'];?>" readonly="readonly" />
                </td>
            </tr>
            
        </table>
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td align='left'>
                    <button type="button" class="btn btn-lg btn-success" onclick="terima_surat('<?=$_GET['id_usulan'];?>');">Terima Surat</button>
                    <button type="button" class="btn btn-lg btn-warning" onclick="tolak_surat('<?=$_GET['id_usulan'];?>');">Tolak Surat</button>
                </td>
            </tr>
        </table><br/>
		<span style="font-weight:bold;">NB : Sebelum anda menerima atau menolak data surat ini, sebaiknya terlebih dahulu supervisi daftar pegawai yang diusulkan, setelah semua sudah terasa valid, baru anda bisa mengklik terima atau tolak data surat ini.</span>
    </div>
</div>
</form>

<div class="kelang"></div>

<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">SUPERVISI DAFTAR PEGAWAI USULAN PENCANTUMAN GELAR</h3>
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
				var id_usulan = "<?=$_GET['id_usulan'];?>";
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
<div class="kelang"></div>
<!-- DIALOG JQUERY -->
<div id="catatan_supervisi" title="Catatan Penolakan Pegawai Yang Diusulkan" style="display: none;">
<form name="frm_add_supervisi_pg" id="frm_add_supervisi_pg" action="php/pg/catatan_usulan_pg.php" method="POST">
<input type="hidden" id="id_textbox" />
<div class="panelcontainer" style="width: 100%;">
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
				<input type="hidden" name="id_detail_pg" id="id_detail_pg" />
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
<div id="cadis" title="LIHAT CATATAN SUPERVISI PEGAWAI" style="display: none;">
</div>
<!-- ------------- -->