<!-- CONTROLLER -->
<?php

    /* Hasil filter data pegawai */
    $pegawai = array();
    $sql_pegawai = "SELECT
                    	aa.id_lhkpn, aa.no_nhk, aa.tgl_lapor, aa.jenis_form, a.id_pegawai, a.nama_pegawai, a.nip,
                    	b.pangkat, b.gol_ruang,
                    	c.jabatan, d.skpd
                    FROM
                    	tbl_pegawai a
                    	LEFT JOIN tbl_lhkpn aa ON a.id_pegawai = aa.id_pegawai
                    	LEFT JOIN ref_pangkat b ON aa.id_pangkat = b.id_pangkat
                    	LEFT JOIN ref_jabatan c ON aa.id_jabatan = c.id_jabatan
                    	LEFT JOIN ref_skpd d ON aa.id_skpd = d.id_skpd
                    WHERE
                    	aa.id_pegawai = '" . $_GET["id_pegawai"] . "'
                    ORDER BY
                    		aa.id_lhkpn ASC";
    //echo($sql_pegawai);
    $res_pegawai = mysql_query($sql_pegawai) or die(mysql_error());
    $no_pegawai = 0;
    while($ds_pegawai = mysql_fetch_array($res_pegawai)){
        $no_pegawai++;
        $row_pegawai["no"] = $no_pegawai;
        $row_pegawai["id_lhkpn"] = $ds_pegawai["id_lhkpn"];
        $row_pegawai["no_nhk"] = $ds_pegawai["no_nhk"];
        $row_pegawai["tgl_lapor"] = tglindonesia($ds_pegawai["tgl_lapor"]);
        $row_pegawai["jenis_form"] = $ds_pegawai["jenis_form"];
        $row_pegawai["id_pegawai"] = $ds_pegawai["id_pegawai"];
        $row_pegawai["nama_pegawai"] = $ds_pegawai["nama_pegawai"];
        $row_pegawai["nip"] = $ds_pegawai["nip"];
        $row_pegawai["pangkat"] = $ds_pegawai["pangkat"];
        $row_pegawai["gol_ruang"] = $ds_pegawai["gol_ruang"];
        $row_pegawai["jabatan"] = $ds_pegawai["jabatan"];
        $row_pegawai["skpd"] = $ds_pegawai["skpd"];
        array_push($pegawai, $row_pegawai);
    }
    
?>

<script type="text/javascript">

    var pegawai = <?php echo(json_encode($pegawai)); ?>;
    
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">

    function reload_saya(){
        document.location.href = "?mod=lhkpn_proses_riwayat&id_pegawai=<?php echo($_GET["id_pegawai"]); ?>";
    }
    
    function tambah(){
        document.location.href = "?mod=lhkpn_proses_tambah&id_pegawai=<?php echo($_GET["id_pegawai"]); ?>";
    }
    
    function edit(id_lhkpn){
        document.location.href = "?mod=lhkpn_proses_edit&id_lhkpn=" + id_lhkpn;
    }
    
    function hapus(id_lhkpn){
        jConfirm("Anda yakin akan menghapus data LHKPN ini?", "PERHATIAN", function(r){
            if(r){
                $.ajax({
                    url : "php/lhkpn/lhkpn_proses_hapus.php",
                    type : "post",
                    dataType : "text",
                    data : "id_lhkpn=" + id_lhkpn,
                    success : function(r){
                        reload_saya();
                    }
                });
            }
        });
    }

</script>
<!-- END JAVASCRIPT PAGE -->


<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
          <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="">RIWAYAT LHKPN</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>RIWAYAT LHKPN</span></td>
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
						<h3 style="text-align: left;">RIWAYAT PELAPORAN LHKPN</h3>
						<div class="bodypanel">
							<button type="button" class="btn btn-success" onclick="tambah();"><span class='glyphicon glyphicon-plus'></span>&nbsp;&nbsp;Tambah</button>
							<div class="kelang"></div>
							<table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
								<thead>
									<tr class="headertable">
										<th width='40px'>No.</th>
										<th width='200px'>NO. NHK</th>
										<th width='100px'>JENIS LHKPN</th>
										<th width='100px'>TGL. PELAPORAN</th>
										<th>SKPD / Unit Kerja</th>
										<th width='200px'>JABATAN</th>
										<th width='150px'>PANGKAT</th>
										<th width='90px'>&nbsp;</th>
										<th width='90px'>&nbsp;</th>
									</tr>
								</thead>
								<tbody>
								<script type="text/javascript">
									$.each(pegawai, function(i, item){
										document.write("<tr>");
											document.write("<td align='center'>" + item.no+ "</td>");
											document.write("<td align='center'>" + item.no_nhk + "</td>");
											if(item.jenis_form == 1)
												document.write("<td align='center'>A</td>");
											else if(item.jenis_form == 2)
												document.write("<td align='center'>B</td>");
											document.write("<td align='center'>" + item.tgl_lapor + "</td>");
											document.write("<td>" + item.skpd + "</td>");
											document.write("<td>" + item.jabatan + "</td>");
											document.write("<td align='center'>" + item.pangkat+ " (" + item.gol_ruang + ")</td>");
											document.write("<td><button type='button' class='btn btn-sm btn-info' style='width: 100%;' onclick='edit(" + item.id_lhkpn + ");'><span class='glyphicon glyphicon-edit'></span>&nbsp;&nbsp;Edit</button></td>");
											document.write("<td><button type='button' class='btn btn-sm btn-warning' style='width: 100%;' onclick='hapus(" + item.id_lhkpn + ");'><span class='glyphicon glyphicon-trash'></span>&nbsp;&nbsp;Hapus</button></td>");
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
 
