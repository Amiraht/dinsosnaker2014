<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $daftar = array();
    $sql_daftar = "SELECT
                    	i.id_cerai, i.no_sp, i.tgl_sp, a.nama_pegawai, a.nip, g.pangkat, g.gol_ruang, h.jabatan, f.skpd,
                        i.status
                    FROM
                    	tbl_pegawai a
                    	LEFT JOIN ref_status_kepegawaian b ON a.id_status_kepegawaian = b.id_status_kepegawaian
                    	LEFT JOIN ref_jenis_kepegawaian c ON a.id_jenis_kepegawaian = c.id_jenis_kepegawaian
                    	LEFT JOIN ref_kedudukan_kepegawaian d ON a.id_kedudukan_kepegawaian = d.id_kedudukan_kepegawaian
                    	LEFT JOIN ref_jenis_kelamin e ON a.id_jenis_kelamin = e.id_jenis_kelamin
                    	LEFT JOIN ref_skpd f ON a.id_satuan_organisasi = f.id_skpd
                    	LEFT JOIN ref_pangkat g ON a.id_pangkat = g.id_pangkat
                    	LEFT JOIN ref_jabatan h ON a.id_jabatan = h.id_jabatan
                    	INNER JOIN tbl_ijin_cerai i ON a.id_pegawai = i.id_pegawai
                    WHERE
                    	(a.id_status_kepegawaian = 1 OR a.id_status_kepegawaian = 4 OR a.id_status_kepegawaian = 3)
                    	AND i.status > 1
                    ORDER BY
                    	i.id_cerai DESC";
    $res_daftar = mysql_query($sql_daftar);
    while($ds_daftar = mysql_fetch_array($res_daftar)){
        $row_daftar["id_cerai"] = $ds_daftar["id_cerai"];
        $row_daftar["no_sp"] = $ds_daftar["no_sp"];
        $row_daftar["tgl_sp"] = tglindonesia($ds_daftar["tgl_sp"]);
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

    function edit(id_cerai){
        document.location.href="?mod=cerai_sk_edit&id_cerai=" + id_cerai;
    }
    
    function hapus(id_cerai){
        jConfirm("Anda yakin akan menghapus data usulan cerai ini?", "PERHATIAN", function(r){
           if(r){
                document.location.href="php/cerai/cerai_daftar_usulan_hapus.php?id_cerai=" + id_cerai;
           } 
        });
    }
    
    function cetak_sp(id_cerai){
        window.open("cetak/sk/cerai/cerai_surat_panggilan.php?id_cerai=" + id_cerai);
    }
    
    function cetak_spp(id_cerai){
        window.open("cetak/sk/cerai/cerai_surat_melakukan_pemeriksaan.php?id_cerai=" + id_cerai);
    }
    
    function cetak_sk(id_cerai){
        window.open("cetak/sk/cerai/cerai_sk.php?id_cerai=" + id_cerai);
    }
    
    function proses_selesai(id_cerai){
        jConfirm("Anda yakin bahwa data ini telah selesai diproses?", "PERHATIAN", function(r){
           if(r){
                document.location.href="php/cerai/cerai_sk_proses_selesai.php?id_cerai=" + id_cerai;
           } 
        });
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
                                <h1><a style="color:#AA9F00;" href="">SK PERCERAIAN</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>SK PERCERAIAN</span></td>
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
						<h3 style="text-align: left;">DAFTAR USULAN CERAI DARI SKPD</h3>
						<div class="bodypanel">
							<div class="kelang"></div>
							<table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
							<thead>
								<tr class="headertable">
									<th width='40px'>No.</th>
									<th>No. Usulan</th>
									<th width='150px'>Tgl. Usulan</th>
									<th width='150px'>Nama Pegawai</th>
									<th width='150px'>NIP</th>
									<th width='150px'>Pangkat</th>
									<th width='150px'>Jabatan</th>
									<th width='150px'>SKPD</th>
									<th width='50px'>&nbsp;</th>
									<th width='50px'>&nbsp;</th>
									<th width='50px'>&nbsp;</th>
									<th width='50px'>&nbsp;</th>
									<th width='50px'>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
							<script type="text/javascript">
								$.each(daftar, function(i, item){
									var txt = "";
									txt += "<tr>";
										txt += "<td style='text-align: center;'>" + (i+1) + "</td>";
										txt += "<td style='text-align: center;'>" + item.no_sp + "</td>";
										txt += "<td style='text-align: center;'>" + item.tgl_sp + "</td>";
										txt += "<td style='text-align: center;'>" + item.nama_pegawai + "</td>";
										txt += "<td style='text-align: center;'>" + item.nip + "</td>";
										txt += "<td style='text-align: center;'>" + item.pangkat + " (" + item.gol_ruang + ")</td>";
										txt += "<td style='text-align: center;'>" + item.jabatan + "</td>";
										txt += "<td style='text-align: center;'>" + item.skpd + "</td>";
										if(item.status == 2){
											txt += "<td style='text-align: center;'><button type='button' class='btn btn-sm btn-success' style='width: 100%;' title='Edit data' onclick='edit(" + item.id_cerai + ");'><span class='glyphicon glyphicon-edit'></span></button></td>";
											txt += "<td style='text-align: center;'><button type='button' class='btn btn-sm btn-success' style='width: 100%;' title='Cetak surat panggilan' onclick='cetak_sp(" + item.id_cerai + ")'><span class='glyphicon glyphicon-print'></span></button></td>";
											txt += "<td style='text-align: center;'><button type='button' class='btn btn-sm btn-success' style='width: 100%;' title='Cetak surat melakukan pemeriksaan' onclick='cetak_spp(" + item.id_cerai + ")'><span class='glyphicon glyphicon-print'></span></button></td>";
											txt += "<td style='text-align: center;'><button type='button' class='btn btn-sm btn-success' style='width: 100%;' title='Cetak SK perceraian' onclick='cetak_sk(" + item.id_cerai + ")'><span class='glyphicon glyphicon-print'></span></button></td>";
											txt += "<td style='text-align: center;'><button type='button' class='btn btn-sm btn-success' style='width: 100%;' title='Proses selesai' onclick='proses_selesai(" + item.id_cerai + ")'><span class='glyphicon glyphicon-cog'></span></button></td>";
										}else{
											txt += "<td>&nbsp;</td>";
											txt += "<td>&nbsp;</td>";
											txt += "<td>&nbsp;</td>";
											txt += "<td>&nbsp;</td>";
											txt += "<td>&nbsp;</td>";
										}
									txt += "</tr>";
									document.write(txt);
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
 


