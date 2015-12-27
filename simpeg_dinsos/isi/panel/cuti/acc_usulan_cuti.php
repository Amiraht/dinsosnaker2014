
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
       // ambil_tanggal("tgl_usulan");
		$( "#dialog_pegawai" ).dialog({
			autoOpen: false,
			height: 600,
			width: 800,
			modal: true,
			show: "fade",
			hide: "fade"
		});
		
		$("#btn_view").click(function(){
				var id_usulan = "<?=mysql_real_escape_string($_GET['id_usulan']); ?>";
				$("#dialog_pegawai").dialog("open");
					$.ajax({
							type: "GET",
							url: "ajax/usulan_cuti_daftar_diusulkan.php",
							data: "id_usulan=" + id_usulan,
							success: function(r){
										$("#dialog_pegawai").html(r);
									}
						});	
		});
    });
  
    function kembali(){
        document.location.href="?mod=cuti_daftar_usulan_proses";
    }
	
	// function untuk melakukan proses ACC
	function acc(mode, id_usulan){
		
		if(mode == 1){
			jConfirm("ACC Surat Usulan Cuti ini ?", "PERHATIAN", function(r){
				if(r){
					document.location.href="php/cuti/konfirmasi_usulan_cuti.php?mode="+mode+"&id_usulan="+id_usulan;
				} 
			});
			
		}else{
			jConfirm("Tolak Surat Usulan Cuti ini ?", "PERHATIAN", function(r){
				if(r){
					$("#frm").submit();
				} 
			});
		}
	}
    
</script>
<!-- END OF JAVASCRIPT PAGE -->
	<?php
		$id = mysql_real_escape_string($_GET['id_usulan']); // prevent sql injection
		$qs = "SELECT * FROM tbl_usulan_cuti WHERE id_usulan = '". $id ."'";
		$exec = mysql_query($qs) or die(mysql_error());
		$row = mysql_fetch_array($exec);

	?>


<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
          <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="">ACC SURAT USULAN CUTI</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>ACC SURAT USULAN CUTI</span></td>
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
							
			<form name="frm" id="frm" action="php/cuti/konfirmasi_usulan_cuti.php?mode=2" method="POST">
				<div class="panelcontainer panelform" style="width: 100%;">

					<h3 style="text-align: left;">ACC SURAT USULAN IZIN CUTI (NO USUL : <?=$row['no_usulan'];?>)</h3>

					<button type="button" class="btn btn-lg btn-success" onclick="kembali();" style="margin-left:15px;margin-top:5px;">
					<span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;Kembali</button>
					<div class="bodypanel bodyfilter" id="bodyfilter">
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td width='50%'>
									<label>NO. Surat Usulan :</label>
									<input type="hidden" name="id_usulan" id="id_usulan" value="<?=$row['id_usulan'];?>"/>
									<input type="text" name="no_usulan" id="no_usulan" class="form-control" value="<?=$row['no_usulan'];?>" readonly="readonly"/>
								</td>
								<td>
									<label>Tgl. Surat Usulan :</label>
									<input type="text" name="tgl_usulan" id="tgl_usulan" class="form-control" value="<?=$row['tgl_usulan'];?>" readonly="readonly"/>
								</td>
							</tr>
							<tr>
								<td width='50%'>
									<label>Pejabat Penandatangan Usulan :</label>
									<input type="text" name="jabatan_ttd" id="jabatan_ttd" class="form-control" value="<?=$row['pejabat_usulan'];?>" readonly="readonly"/>
								</td>
								<td>
									<label>Lampiran Data Pegawai :</label>
									<button type="button" class="btn btn-success" id="btn_view">&nbsp;&nbsp;Lampiran Daftar Pegawai</button>
								</td>	
							</tr>
						</table>
						<div class="kelang"></div>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<td>
								<label>Masukan Catatan Penolakan (*opsional)</label>
								<textarea name="catatan" id="catatan" placeholder=":: Masukan Catatan Penolakan Jika ada Usulan ditolak (opsional) ::"></textarea>
							</td>
						</table>
						 <div class="kelang"></div>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td align='left'>
									<button type="button" class="btn btn-lg btn-success" onclick="acc(1, <?=$row['id_usulan'];?>);"><span class='glyphicon glyphicon-floppy-disk'></span>&nbsp;&nbsp;Terima</button>
									<button type="button" class="btn btn-lg btn-warning" onclick="acc(2, <?=$row['id_usulan'];?>);"><span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;Tolak</button>
								
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
 


<div class="kelang"></div>
<!-- DIALOG JQUERY -->
<div id="dialog_pegawai" title="DAFTAR PEGAWAI USULAN CUTI" style="display: none;">
    
</div>
<!-- ------------- -->