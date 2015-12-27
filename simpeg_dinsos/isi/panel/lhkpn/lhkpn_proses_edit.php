<!-- CONTROLLER -->
<?php
    
    $sql_data = "SELECT * FROM tbl_lhkpn WHERE id_lhkpn='" . $_GET["id_lhkpn"] . "'";
    $res_data = mysql_query($sql_data);
    $ds_data = mysql_fetch_array($res_data);
    $data["id_lhkpn"] = $ds_data["id_lhkpn"];
    $data["id_pegawai"] = $ds_data["id_pegawai"];
    $data["jenis_form"] = $ds_data["jenis_form"];
    $data["tgl_lapor"] = $ds_data["tgl_lapor"];
    $data["no_nhk"] = $ds_data["no_nhk"];
    
?>

<script type="text/javascript">

    var data = <?php echo(json_encode($data)); ?>;
    
    function preload(){
        $("#id_lhkpn").val(data.id_lhkpn);
        $("#id_pegawai").val(data.id_pegawai);
        $("#no_nhk").val(data.no_nhk);
        $("#jenis_form").val(data.jenis_form);
        $("#tgl_lapor").val(data.tgl_lapor);
    }
    
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">

    $(document).ready(function(){
        ambil_tanggal("tgl_lapor");
        preload();
    });
    
    function form_submit(){
        $("#frm").submit();
    }
    
    function kembali(){
        document.location.href="?mod=lhkpn_proses_riwayat&id_pegawai=" + data.id_pegawai;
    }

</script>
<!-- END OF JAVASCRIPT PAGE -->

<!-- JAVASCRIPT FROM CHILD -->
<script type="text/javascript">

    function something_wrong(what_is_wrong){
        jAlert(what_is_wrong, "PERHATIAN");
    }
    function success(){
        jAlert("Data pelaporan LHKPN telah disimpan.", "PERHATIAN", function(r){
            document.location.href="?mod=lhkpn_proses_riwayat&id_pegawai=" + data.id_pegawai;
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
                                <h1><a style="color:#AA9F00;" href="">EDIT LHKPN</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>EDIT LHKPN</span></td>
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
		
			<form name="frm" id="frm" action="php/lhkpn/lhkpn_proses_edit.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id_lhkpn" id="id_lhkpn" />
				<input type="hidden" name="id_pegawai" id="id_pegawai" />
				<div class="panelcontainer panelform" style="width: 100%;">
					<h3 style="text-align: left;">EDIT DATA LHKPN</h3>
					<div class="bodypanel bodyfilter" id="bodyfilter">
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td>
									<label>Nomor NHK :</label>
									<input type="text" name="no_nhk" id="no_nhk" class="form-control" />
								</td>
							</tr>
							<tr>
								<td>
									<label>Jenis Form LHKPN :</label>
									<select name="jenis_form" id="jenis_form" class="form-control">
										<option value="1">Form A (Pertama mengisi LHKPN)</option>
										<option value="2">Form B (Sudah pernah mengisi LHKPN sebelumnya)</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<label>Tanggal Lapor :</label>
									<input type="text" name="tgl_lapor" id="tgl_lapor" class="form-control" />
								</td>
							</tr>
						</table>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td>
									<button type="button" class="btn btn-success btn-lg" onclick="form_submit();">Simpan</button>
									<button type="reset" class="btn btn-info btn-lg">Reset</button>
									<button type="button" class="btn btn-warning btn-lg" onclick="kembali();">Kembali</button>
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
 
