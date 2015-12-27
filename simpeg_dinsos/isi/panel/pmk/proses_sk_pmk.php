<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    
	// generate JSON untuk data daftar pangkat
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
        document.location.href="?mod=pmk_daftar_sk_proses";
    }
	
	function acc(mode, id_surat){
		if(mode == 2){
			var catatan = $('#catatan').val();
			document.location.href="php/pmk/acc_sk_pmk.php?mode="+mode+"&id_surat="+id_surat+"&catatan="+catatan;
		}else{
			document.location.href="php/pmk/acc_sk_pmk.php?mode="+mode+"&id_surat="+id_surat;
		}	
    }
    
</script>
<!-- END OF JAVASCRIPT PAGE -->

<!-- JAVASCRIPT FROM CHILD -->
<script type="text/javascript">

    function something_wrong(what_is_wrong){
        jAlert(what_is_wrong, "PERHATIAN");
    }
    
    function success(){
        jAlert("Data surat usulan penyesuaian masa kerja telah disimpan", "KONFIRMASI", function(r){
            document.location.href="?mod=pmk_daftar_usulan_diusulkan";
        });
    }

</script>
<!-- END OF JAVASCRIPT FROM CHILD -->
<?php
	$ids = isset($_GET['id_sk']) ? $_GET['id_sk'] : "";
	$id_sk = mysql_real_escape_string($ids);
	$sql = "SELECT * FROM tbl_sk_pmk WHERE status = '2' AND id_surat = '$id_sk'";
	$query = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_array($query);
?>
<form name="frm" id="frm" action="" method="POST">
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">Proses Data SK Penyesuaian Masa Kerja (ID Surat : <?=$row['id_surat'];?>) </h3>
	<?php
		if(isset($_GET['code'])){
			if($_GET['code'] == 2){	
				//echo "sukses";
				echo "<div class='alert alert-success' role='alert' id='alert_add_sukses'>";
				echo "<center><img src='image/icn_alert_success.png' width='18px;' />&nbsp;&nbsp;";
				echo "Data SK PMK telah disetujui.</center>";
				echo "</div>";
			}else if($_GET['code'] == 1){
				echo "<div class='alert alert-warning' role='alert' id='alert_add_sukses'>";
				echo "<center><img src='image/icn_alert_warning.png' width='18px;' />&nbsp;&nbsp;";
				echo "Data SK PMK telah ditolak.</center>";
				echo "</div>";
			}
		}	
	?>		
	<button type="button" class="btn btn-lg btn-success" onclick="kembali();" style="margin-left:15px;margin-top:5px;">
	<span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;Kembali</button>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
                    <label>NO. SK :</label>
                    <input type="text" name="no_sk" id="no_sk" class="form-control" value="<?=$row['no_sk'];?>" readonly="readonly"/>
                </td>
                <td>
                    <label>Tgl. SK :</label>
                    <input type="text" name="tgl_sk" id="tgl_sk" class="form-control" value="<?=$row['tgl_surat'];?>" readonly="readonly"/>
                </td>
            </tr>
            <tr>
                <td width='50%'>
                    <label>Nama Pejabat Penandatangan  :</label>
                    <input type="text" name="pejabat_ttd" id="pejabat_ttd" class="form-control" value="<?=$row['pejabat_ttd'];?>" readonly="readonly"/>
                </td>
                <td>
                   <label>NIP Pejabat Penandatangan :</label>
				   <input type="text" name="nip_pejabat_ttd" id="nip_pejabat_ttd" class="form-control" value="<?=$row['nip_pejabat_ttd'];?>" readonly="readonly"/>
                </td>
            </tr>
			
			<tr>
				 <td width="50%">
                    <label>Jabatan Pejabat Penandatangan : </label>
                    <input type="text" name="jabatan_ttd" id="jabatan_ttd" class="form-control" value="<?=$row['jabatan_ttd_sk'];?>" readonly="readonly"/>
                </td>
			</tr>
			
        </table>
		<div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
					 <label>Catatan Penolakan: </label>
					<textarea style="height:80px;" id="catatan" name="catatan" placeholder="Jika ditolak, isi catatan penolakan ini, jika diterima (ACC) dikosongkan saja"></textarea>
				</td>
            </tr>
        </table>
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td align='left'>
                     <input type="buttom" value="Terima" style="width: 150px; height: 40px;" class="btn btn-lg btn-success" onclick="acc(3, <?=$row['id_surat'];?>);"/>
					 <input type="button" value="Tolak" style="width: 150px; height: 40px;" class="btn btn-lg btn-info"  onclick="acc(2, <?=$row['id_surat'];?>);"/>
			   </td>
            </tr>
        </table>
    </div>
</div>
</form>
<div class="kelang"></div>
<iframe src="" style="display: none;" id="sbm_target" name="sbm_target"></iframe>