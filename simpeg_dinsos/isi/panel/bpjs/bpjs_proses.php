<!-- CONTROLLER -->
<?php
    $sql_data = "SELECT * FROM tbl_bpjs WHERE id_pegawai='" . $_GET["id_pegawai"] . "'";
    $res_data = mysql_query($sql_data);
    if(mysql_num_rows($res_data) > 0){
        $ds_data = mysql_fetch_array($res_data);
        $data["id_pegawai"] = $ds_data["id_pegawai"];
        $data["no_bpjs"] = $ds_data["no_bpjs"];
        $data["scan_bpjs"] = $ds_data["scan_bpjs"];
    }else{
        $data["id_pegawai"] = $_GET["id_pegawai"];
        $data["no_bpjs"] = "";
        $data["scan_bpjs"] = "";
    }
?>
<script type="text/javascript">

    var data = <?php echo(json_encode($data)); ?>;
        
    function preload(){
        $("#no_bpjs").val(data.no_bpjs);
        if(data.scan_bpjs == "")
            $("#lihat_upload").hide();
        else
            $("#lihat_upload").show();
    }

</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">

    $(document).ready(function(){
        preload();
    });
    
    function lihat_upload(){
        window.open("sk_uploaded/bpjs/" + data.scan_bpjs);
    }
    
    function form_submit(){
        $("#frm").submit();
    }
    
</script>
<!-- END OF JAVASCRIPT PAGE -->

<!-- JAVASCRIPT FROM CHILD -->
<script type="text/javascript">

    function something_wrong(what_is_wrong){
        jAlert(what_is_wrong, "PERHATIAN");
    }
    
    function success(){
        jAlert("Data pelaporan BPJS telah disimpan.", "PERHATIAN", function(r){
            document.location.href="?mod=bpjs_daftar";
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
                                <h1><a style="color:#AA9F00;" href="">PROSES DATA BPJS</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>PROSES DATA BPJS</span></td>
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
		<form name="frm" id="frm" action="php/bpjs/bpjs_proses.php" method="post" target="sbm_target" enctype="multipart/form-data">
			<input type="hidden" name="id_pegawai" value="<?php echo($_GET["id_pegawai"]); ?>" />
			<div class="panelcontainer panelform" style="width: 100%;">
				<h3 style="text-align: left;">PROSES DATA BPJS</h3>
				<div class="bodypanel bodyfilter" id="bodyfilter">
					<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
						<tr>
							<td>
								<label>Nomor Kartu BPJS :</label>
								<input type="text" name="no_bpjs" id="no_bpjs" class="form-control" />
							</td>
						</tr>
						<tr>
							<td>
								<label>
									Upload scan Kartu BPJS :
									<a href="javascript:lihat_upload();" id="lihat_upload">Lihat</a>
								</label>
								<input type="file" name="scan_bpjs" id="scan_bpjs" />
								*) kosongkan jika tidak ingin dirubah apabila data nomor BPJS sudah pernah disimpan
							</td>
						</tr>
					</table>
					<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
						<tr>
							<td>
								<button type="button" class="btn btn-success btn-lg" onclick="form_submit();">Simpan</button>
								<button type="reset" class="btn btn-info btn-lg">Reset</button>
								<button type="button" class="btn btn-warning btn-lg" onclick="document.location.href='?mod=bpjs_daftar';">Kembali</button>
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
 
<!-- IFRAME. THE FORM WILL BE SUBMITED IN THIS WAY -->
<iframe name="sbm_target" style="display: none;"></iframe>
<!-- END OF IFRAME -->