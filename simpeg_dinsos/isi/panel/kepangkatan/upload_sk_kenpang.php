<!-- CONTROLLER -->
<?php
	$id_data = mysql_real_escape_string($_GET['id_data']);
    $sql_data = "SELECT * FROM tbl_sk_kenpang WHERE id_data ='" . $id_data . "'";
    $res_data = mysql_query($sql_data);
    if(mysql_num_rows($res_data) > 0){
        $ds_data = mysql_fetch_array($res_data);
        $data["id_data"] = $ds_data["id_data"];
        $data["no_sk"] = $ds_data["no_sk"];
        $data["scan_sk"] = $ds_data["scan_sk"];
		$data["no_usul"] = $ds_data["no_usulan_naik_pangkat"];
    }else{
        $data["id_data"] = $ds_data["id_data"];
        $data["no_sk"] = $ds_data["no_sk"];
        $data["scan_sk"] = $ds_data["scan_sk"];
		$data["no_usul"] = $ds_data["no_usulan_naik_pangkat"];
    }
	
?>
<script type="text/javascript">
	
    var data = <?php echo(json_encode($data)); ?>;
        
    function preload(){
        $("#no_bpjs").val(data.no_bpjs);
        if(data.scan_sk == "-" || data.scan_sk == "")
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
        window.open("sk_uploaded/kepangkatan/" + data.scan_sk);
    }
    
    
</script>
<!-- END OF JAVASCRIPT PAGE -->

<!-- JAVASCRIPT FROM CHILD -->
<script type="text/javascript">

    function something_wrong(what_is_wrong){
        jAlert(what_is_wrong, "PERHATIAN");
    }
    
    function success(){
        jAlert("Upload Scan SK Kepangkatan dan update pangkat pegawai sukses !!.", "PERHATIAN", function(r){
            document.location.href="?mod=kenpang_sk_telah_diproses";
        });
    }
    
	function kembali(){
		var id_level = "<?=$_SESSION['simpeg_id_level'];?>";
		if(id_level == 5 || id_level == 12){
			document.location.href='?mod=kenpang_sk_telah_diproses';
		}else{
			document.location.href='?mod=kenpang_daftar_sk_diusulkan';
		}
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
                                <h1><a style="color:#AA9F00;" href="">UPLOAD SCAN SK KEPANGKATAN</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>UPLOAD SCAN SK KEPANGKATAN</span></td>
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
		
		<form name="frm" id="frm" action="php/kpk/upload_sk_kenpang.php" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="no_usul" value="<?=$data['no_usul']; ?>" />
			<div class="panelcontainer panelform" style="width: 100%;">
				<h3 style="text-align: left;">UPLOAD SCAN SK (NO. SK : <?=$data['no_sk']; ?>)</h3>
				<div class="bodypanel bodyfilter" id="bodyfilter">
					<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
						<tr>
							<td>
								<label>Nomor SK Kepangkatan :</label>
								<input type="text" name="no_sk" id="no_sk" class="form-control" />
							</td>
						</tr>
						<tr>
							<td>
								<label>
									Upload File Scan SK  :
									<a href="javascript:lihat_upload();" id="lihat_upload">Lihat</a>
								</label>
								<input type="file" name="scan_sk_kenpang" id="scan_sk_kenpang" />
								*) Upload Scan SK Kenaikan Pangkat Pegawai sebagai pertanda untuk melakukan update data pangkat pada 
									setiap pegawai.
							</td>
						</tr>
					</table>
					<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
						<tr>
							<td>
								<input type="submit" class="btn btn-success btn-lg" value="UPLOAD" style="width:150px;height:50px;"/>
								<input type="reset" class="btn btn-info btn-lg"  value="RESET" style="width:150px;height:50px;"/>
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
 

