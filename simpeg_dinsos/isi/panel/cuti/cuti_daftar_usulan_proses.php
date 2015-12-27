<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $list_norut = array();
    $sql_list_norut = "SELECT * FROM tbl_usulan_cuti WHERE diproses = '0' ORDER BY id_usulan ASC";
								
    $res_list_norut = mysql_query($sql_list_norut);
    $nomor = 0;
	
    while($ds_list_norut = mysql_fetch_array($res_list_norut)){
        $nomor++;
        $row_norut["nomor"] = $nomor;
		$row_norut["id_usulan"] = $ds_list_norut["id_usulan"];
        $row_norut["no_usulan"] = $ds_list_norut["no_usulan"];
        $row_norut["tgl_usulan"] = tglindonesia($ds_list_norut["tgl_usulan"]);
		$row_norut["pejabat_usulan"] = $ds_list_norut["pejabat_usulan"];
        array_push($list_norut, $row_norut);
    }
	
    echo("var usulan = " . json_encode($list_norut) . ";");

?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">
    function edit_pegawai(no_usulan){
        document.location.href="?mod=cuti_daftar_usulan_edit&no_usulan=" + no_usulan;
    }
    
    function acc(id_usulan){
        jConfirm("Anda yakin akan memproses data usulan ini ?", "PERHATIAN", function(r){
            if(r){
                document.location.href="?mod=acc_usulan_cuti&id_usulan=" + id_usulan;
            }
        });
    }
	
	function hapus(id_usulan){
        jConfirm("Hapus Data Usulan dengan ID "+id_usulan+" ini?", "PERHATIAN", function(r){
            if(r){
                document.location.href="php/cuti/cuti_daftar_usulan_hapus.php?id_usulan=" + id_usulan;
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
                                <h1><a style="color:#AA9F00;" href="">USULAN CUTI SEDANG DIPROSES</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>USULAN CUTI SEDANG DIPROSES</span></td>
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
					<h3 style="text-align: left;">DAFTAR USULAN CUTI YANG SEDANG DIPROSES</h3>
					<div class="bodypanel">
						<button type="button" class="btn btn-info" onclick="document.location.href='?mod=cuti_daftar_ditolak';"><span class='glyphicon glyphicon-minus-sign'></span>&nbsp;&nbsp;Lihat Usulan Yang Ditolak</button>
						<div class="kelang"></div>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
						<thead>
							<tr class="headertable">
								<th width='40px'>No.</th>
								<th width='150px'>No. Usulan</th>
								<th width='100px'>Tgl. Usulan</th>
								<th>Pejabat Penandatangan<br />Usulan</th>
								<th width='80px'>&nbsp;</th>
								<th width='80px'>&nbsp;</th>
								<th width='80px'>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
						<script type="text/javascript">
						var text = "";
						$.each(usulan, function(i, item){
						   text += "<tr>";
								text += "<td style='text-align:center;'>" + item.nomor + "</td>";
								text += "<td style='text-align:center;'>" + item.no_usulan + "</td>";
								text += "<td style='text-align:center;'>" + item.tgl_usulan + "</td>";
								text += "<td style='text-align:center;'>" + item.pejabat_usulan + " Pegawai</td>";
								text += "<td><button type='button' class='btn btn-sm btn-info' style='width:100%;' onclick='edit_pegawai(\"" + item.no_usulan + "\");'>Edit &nbsp;<span class='glyphicon glyphicon-edit'></span></button></td>";
								text += "<td style='text-align: center;'><button type='button' title='Hapus Data' class='btn btn-sm btn-danger' style='width: 100%;' onclick='hapus(" + item.id_usulan + ");'>Hapus &nbsp;<span class='glyphicon glyphicon-trash'></span></button></td>";	
								text += "<td><button type='button' class='btn btn-sm btn-success' style='width:100%;' onclick='acc(\"" + item.id_usulan + "\");'>Proses &nbsp;<span class='glyphicon glyphicon-cog'></span></button></td>";
								 
						  text += "</tr>"; 
						});
						document.write(text);
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
 




