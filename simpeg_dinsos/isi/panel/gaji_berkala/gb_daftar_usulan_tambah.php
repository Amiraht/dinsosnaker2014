<!-- CONTROLLER -->
<script type="text/javascript">
<?php
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
        ambil_tanggal("tgl_usulan");
    });
    
    function simpan(){
        $("#frm").submit();
    }
    
    function kembali(){
        document.location.href="?mod=gb_daftar_usulan";
    }
    
</script>
<!-- END OF JAVASCRIPT PAGE -->

<!-- JAVASCRIPT FROM CHILD -->
<script type="text/javascript">

    function something_wrong(what_is_wrong){
        jAlert(what_is_wrong, "PERHATIAN");
    }
    
    function success(){
        jAlert("Data surat usulan kenaikan gaji berkala telah disimpan", "PERHATIAN", function(r){
            document.location.href="?mod=gb_daftar_usulan";
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
                                <h1><a style="color:#AA9F00;" href="">TAMBAH SURAT USULAN GAJI BERKALA</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>TAMBAH SURAT USULAN GAJI BERKALA</span></td>
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
	<form name="frm" id="frm" action="php/gaji_berkala/gb_daftar_usulan_tambah.php" method="post">
		<div class="panelcontainer panelform" style="width: 100%;">
			<h3 style="text-align: left;">TAMBAH SURAT USULAN KENAIKAN GAJI BERKALA</h3>
			<?php
					if(isset($_GET['code'])){
						if($_GET['code'] == 1){	
							//echo "sukses";
							echo "<div class='alert alert-success' role='alert' id='alert_add_sukses'>";
							echo "<center><img src='image/icn_alert_success.png' width='18px;' />&nbsp;&nbsp;";
							echo "Data Usulan Kenaikan Gaji Berkala sukses ditambah.</center>";
							echo "</div><br/>";
						}else if($_GET['code'] == 2){
							echo "<div class='alert alert-warning' role='alert' id='alert_add_sukses'>";
							echo "<center><img src='image/icn_alert_warning.png' width='18px;' />&nbsp;&nbsp;";
							echo "Data Usulan Kenaikan Gaji Berkala gagal ditambah, proses error...</center>";
							echo "</div><br/>";
						}
					}	
				?>		
			<div class="bodypanel bodyfilter" id="bodyfilter">
				<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
					<tr>
						<td>
							<label>NO. Surat Usulan :</label>
							<input type="text" name="no_usulan" id="no_usulan" class="form-control" placeholder=" :: INPUT NOMOR USULAN :: " style='width:90%;'/>
						</td>
						<td>
							<label>Tgl. Surat Usulan :</label>
							<input type="text" name="tgl_usulan" id="tgl_usulan" class="form-control" placeholder=" :: INPUT TANGGAL SURAT USULAN :: " style='width:90%;'/>
						</td>
					</tr>
					<tr>
						<td>
							<label>Nama Pejabat Penandatangan :</label>
							<input type="text" name="nama_ttd_usulan" id="nama_ttd_usulan" class="form-control" placeholder=" :: INPUT NAMA PEJABAT PENANDATANGAN :: "  style='width:90%;' />
						</td>
						<td>
							<label>NIP Pejabat Penandatangan :</label>
							<input type="text" name="nip_ttd_usulan" id="nip_ttd_usulan" class="form-control" placeholder=" :: INPUT NIP PEJABAT PENANDATANGAN :: " style='width:90%;'/>
						</td>
					</tr>
					<tr>
						<td>
							<label>Jabatan Pejabat Penandatangan :</label>
							<input type="text" name="jabatan_ttd_usulan" id="jabatan_ttd_usulan" class="form-control" placeholder=" :: INPUT JABATAN PEJABAT PENANDATANGAN :: " style='width:90%;'/>
						</td>
						<td>
							<label>Pangkat Pejabat Penandatangan :</label>
							<select name="id_pangkat_ttd_usulan" id="id_pangkat_ttd_usulan" class="form-control">
								<option value="0">----- Pilih Pangkat -----</option>
								<script type="text/javascript">
								$.each(pangkat, function(i, item){
									document.write("<option value='" + item.id_pangkat + "'>" + item.pangkat + " (" + item.gol_ruang + ")</option>");
								});
								</script>
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
	</div>
</td>
</tr>
<tr>
     <td><br><div id='footer'></div></td>
 </tr>
 </table>
 