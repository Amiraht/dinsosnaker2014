<!-- CONTROLLER -->
<?php
	$id_data = mysql_real_escape_string($_GET['id']);
    $sql_data = "SELECT * FROM tbl_riwayat_pendidikan WHERE id_data_rp ='" . $id_data . "'";
    $res_data = mysql_query($sql_data);
    if(mysql_num_rows($res_data) > 0){
        $ds_data = mysql_fetch_array($res_data);
        $data["id_data"] = $ds_data["id_data_rp"];
        $data["no_ijazah"] = $ds_data["no_ijazah"];
        $data["tgl_ijazah"] = $ds_data["tgl_ijazah"];
		$data["scan"] = $ds_data["scan_ijazah"];
    }else{
        $data["id_data"] = $ds_data["id_data_rp"];
        $data["no_ijazah"] = $ds_data["no_ijazah"];
        $data["tgl_ijazah"] = $ds_data["tgl_ijazah"];
		$data["scan"] = $ds_data["scan_ijazah"];
    }
	
?>
<script type="text/javascript">
	
    var data = <?php echo(json_encode($data)); ?>;
        
    function preload(){
        if(data.scan == "-" || data.scan == "")
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
        window.open("ijazah_uploaded/riwayat_pendidikan/" + data.scan);
    }
    
    
</script>
<!-- END OF JAVASCRIPT PAGE -->

<!-- JAVASCRIPT FROM CHILD -->
<script type="text/javascript">

    function something_wrong(what_is_wrong){
        jAlert(what_is_wrong, "PERHATIAN");
    }
    
    function success(){
        jAlert("Upload File Ijazah Pendidikan Pegawai Sukses !!.", "PERHATIAN", function(r){
            document.location.href="?mod=riwayat_pendidikan_pegawai";
        });
    }
    
</script>
<!-- END OF JAVASCRIPT FROM CHILD -->
<?php
	$ids = mysql_real_escape_string($_GET['id']);
	$sql = "SELECT * FROM tbl_riwayat_pendidikan WHERE id_data_rp = '". $ids ."'";
	$qr = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_array($qr);
?>
<form name="frm" id="frm" action="php/riwayat_pendidikan/upload_ijazah.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="id_data" value="<?=$row['id_data_rp'];?>" />
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">UPLOAD FILE IJAZAH (ID DATA : <?=$row['id_data_rp'];?>)</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <label>Nomor Ijazah :</label>
                    <input type="text" name="no_ijazah" id="no_ijazah" class="form-control" value="<?=$row['no_ijazah'];?>"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label>
                        Upload File Scan SK  :
                        <a href="javascript:lihat_upload();" id="lihat_upload">Lihat</a>
                    </label>
                    <input type="file" name="file" id="file" />
                    *) Upload File Ijazah Pendidikan, File Berekstensi (.pdf).
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <input type="submit" class="btn btn-success btn-lg" value="UPLOAD" style="width:150px;height:50px;"/>
                    <input type="reset" class="btn btn-info btn-lg"  value="RESET" style="width:150px;height:50px;"/>
                    <button type="button" class="btn btn-warning btn-lg" onclick="document.location.href='?mod=riwayat_pendidikan_pegawai';">Kembali</button>
                </td>
            </tr>
        </table>
    </div>
</div>
</form>

<!-- IFRAME. THE FORM WILL BE SUBMITED IN THIS WAY -->
<iframe name="sbm_target" style="display: none;"></iframe>
<!-- END OF IFRAME -->