<?php
	$id_usulan = mysql_real_escape_string(trim(strip_tags($_GET["id_usulan"])));
?>
<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $daftar = array();
    $sql_daftar = "SELECT
                    	a.id_pegawai, a.nama_pegawai, a.nip, a.gelar_depan, a.gelar_belakang,
                    	b.status_kepegawaian, c.jenis_kepegawaian, d.kedudukan_kepegawaian,
                    	e.jenis_kelamin, a.alamat, a.tanggal_lahir, f.skpd, g.pangkat, g.gol_ruang, h.jabatan,
                        i.id_detail_gaji_berkala
                    FROM
                    	tbl_pegawai a
                    	LEFT JOIN ref_status_kepegawaian b ON a.id_status_kepegawaian = b.id_status_kepegawaian
                    	LEFT JOIN ref_jenis_kepegawaian c ON a.id_jenis_kepegawaian = c.id_jenis_kepegawaian
                    	LEFT JOIN ref_kedudukan_kepegawaian d ON a.id_kedudukan_kepegawaian = d.id_kedudukan_kepegawaian
                    	LEFT JOIN ref_jenis_kelamin e ON a.id_jenis_kelamin = e.id_jenis_kelamin
                    	LEFT JOIN ref_skpd f ON a.id_satuan_organisasi = f.id_skpd
                    	LEFT JOIN ref_pangkat g ON a.id_pangkat = g.id_pangkat
                    	LEFT JOIN ref_jabatan h ON a.id_jabatan = h.id_jabatan
                    	INNER JOIN tbl_usulan_gaji_berkala_detail i ON (a.id_pegawai = i.id_pegawai AND i.id_usulan = '" . $id_usulan . "')
                    ORDER BY
                    	i.id_detail_gaji_berkala DESC";
    $res_daftar = mysql_query($sql_daftar);
    while($ds_daftar = mysql_fetch_array($res_daftar)){
        $row_daftar["id_detail_gaji_berkala"] = $ds_daftar["id_detail_gaji_berkala"];
        $row_daftar["nama_pegawai"] = $ds_daftar["nama_pegawai"];
        $row_daftar["nip"] = $ds_daftar["nip"];
        $row_daftar["pangkat"] = $ds_daftar["pangkat"];
        $row_daftar["gol_ruang"] = $ds_daftar["gol_ruang"];
        $row_daftar["jabatan"] = $ds_daftar["jabatan"];
        $row_daftar["skpd"] = $ds_daftar["skpd"];
        array_push($daftar, $row_daftar);
    }
    echo("var daftar = " . json_encode($daftar) . ";\n");
?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">

    $(document).ready(function(){
        
    });
    
    function simpan(){
        var nip = $("#nip").val();
        if(nip == "")
            jAlert("Pilih pegawai yang akan diusulkan dahulu", "PERHATIAN");
        else
            $("#frm").submit();
    }
    
    function hapus(id_detail_gaji_berkala){
        jConfirm("Anda yakin akan menghapus data ini?", "PERHATIAN", function(r){
            if(r){
                var id_usulan = <?php echo($_GET["id_usulan"]); ?>;
                document.location.href="php/gaji_berkala/gb_daftar_usulan_pop_diusulkan.php?id_usulan=" + id_usulan + "&id_detail_gaji_berkala=" + id_detail_gaji_berkala;
            }
        });
    }
    
    function kembali(){
        document.location.href="?mod=gb_daftar_usulan";
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
                                <h1><a style="color:#AA9F00;" href="">TAMBAH PEGAWAI USULAN GAJI BERKALA</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>TAMBAH PEGAWAI USULAN GAJI BERKALA</a></h1>
                                </td></span></td>
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
			<form name="frm" id="frm" action="php/gaji_berkala/gb_daftar_usulan_push_diusulkan.php" method="post">
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
								text += "<td style='text-align: center;'><button type='button' title='Hapus Data' class='btn btn-sm btn-success' style='width: 100%;' onclick='hapus(" + item.id_detail_gaji_berkala + ");'><span class='glyphicon glyphicon-trash'></span></button></td>";
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
 

