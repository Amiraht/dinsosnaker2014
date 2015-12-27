<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $daftar = array();
    $sql_daftar = "SELECT
                    	a.id_pegawai, a.nama_pegawai, a.nip, a.gelar_depan, a.gelar_belakang,
                    	b.status_kepegawaian, c.jenis_kepegawaian, d.kedudukan_kepegawaian,
                    	e.jenis_kelamin, a.alamat, a.tanggal_lahir, f.skpd, g.pangkat, g.gol_ruang, h.jabatan,
                        i.id_detail_gaji_berkala, i.id_pi_detali, i.status, i.catatan 
                    FROM
                    	tbl_pegawai a
                    	LEFT JOIN ref_status_kepegawaian b ON a.id_status_kepegawaian = b.id_status_kepegawaian
                    	LEFT JOIN ref_jenis_kepegawaian c ON a.id_jenis_kepegawaian = c.id_jenis_kepegawaian
                    	LEFT JOIN ref_kedudukan_kepegawaian d ON a.id_kedudukan_kepegawaian = d.id_kedudukan_kepegawaian
                    	LEFT JOIN ref_jenis_kelamin e ON a.id_jenis_kelamin = e.id_jenis_kelamin
                    	LEFT JOIN ref_skpd f ON a.id_satuan_organisasi = f.id_skpd
                    	LEFT JOIN ref_pangkat g ON a.id_pangkat = g.id_pangkat
                    	LEFT JOIN ref_jabatan h ON a.id_jabatan = h.id_jabatan
                    	INNER JOIN tbl_usulan_pi_detail i ON (a.id_pegawai = i.id_pegawai AND i.id_usulan = '" . $_GET["id_usulan"] . "')
                    ORDER BY
                    	i.id_detail_gaji_berkala DESC";
						
    $res_daftar = mysql_query($sql_daftar);
    while($ds_daftar = mysql_fetch_array($res_daftar)){
        $row_daftar["id_detail_gaji_berkala"] = $ds_daftar["id_detail_gaji_berkala"];
		$row_daftar["id_detail"] = $ds_daftar["id_pi_detali"];
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
        if(nip == "")
            jAlert("Pilih pegawai yang akan diusulkan dahulu", "PERHATIAN");
        else
            $("#frm").submit();
    }
    
    function hapus(id_detail){
        jConfirm("Anda yakin akan menghapus data ini?", "PERHATIAN", function(r){
            if(r){
                var id_usulan = <?php echo($_GET["id_usulan"]); ?>;
                document.location.href="php/pi/pi_daftar_usulan_pop_diusulkan.php?id_usulan=" + id_usulan + "&id_detail=" + id_detail;
            }
        });
    }
    
    function kembali(){
		var id_level = "<?=$_SESSION['simpeg_id_level'];?>";
		if(id_level == 5){
			document.location.href="?mod=pi_daftar_usulan_proses";
		}else{
			 document.location.href="?mod=pi_daftar_usulan";
		}
       
    }
	
	function lihat_catatan(id_detail){
		$("#cadis").dialog("open");
			$.ajax({
					type: "GET",
					url: "ajax/catatan_pegawai_usulan_pi.php",
					data: "id_detail=" + id_detail,
					success: function(r){
						$("#cadis").html(r);
					}
			});	
		
    }
    
</script>
<!-- END OF JAVASCRIPT PAGE -->

<form name="frm" id="frm" action="php/pi/pi_daftar_usulan_push_diusulkan.php" method="post">
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">TAMBAH PEGAWAI UNTUK DIUSULKAN</h3>
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
<div id="cadis" title="LIHAT CATATAN SUPERVISI PEGAWAI" style="display: none;">
</div>