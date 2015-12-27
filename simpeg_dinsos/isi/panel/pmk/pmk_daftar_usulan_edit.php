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
<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">
	$(document).ready(function(){
        ambil_tanggal("tgl_usulan");
		
		$('#btn_edit').click(function(){
			var no_usulan = $("#no_usulan").val();
			var tgl_usulan = $("#tgl_usulan").val();
			if(no_usulan == ''){
				jAlert("Maaf, field nomor surat usul harus diisi !!", "PERINGATAN");
				return false;
			}else if(tgl_usulan == ''){
				jAlert("Maaf, field tanggal surat usul tidak boleh kosong !!", "PERHATIAN");
				return false;
			}else{
				$("#notifikasi").html("");
				$.post("php/pmk/pmk_daftar_usulan_edit.php",
						$("#frm_edit_usul_pmk").serialize(),
						function(data){
							$("#notifikasi").show();
							$("#notifikasi").html(data);
						}
				);
				return false;
			}
		});
    });
    
 
    function kembali(){
        document.location.href="?mod=pmk_daftar_usulan";
    }
    
</script>
<!-- END OF JAVASCRIPT PAGE -->

<!-- JAVASCRIPT FROM CHILD -->
<script type="text/javascript">

    function something_wrong(what_is_wrong){
        jAlert(what_is_wrong, "PERHATIAN");
    }
    
    function success(){
        jAlert("Edit Surat Usulan Penyesuaian Masa Kerja Berhasil", "KONFIRMASI", function(r){
            document.location.href="?mod=pmk_daftar_usulan";
        });
    }

</script>
<!-- END OF JAVASCRIPT FROM CHILD -->
<?php
		$id_usul = mysql_real_escape_string($_GET['id_usulan']);
		$sql = " SELECT	a.*, b.pangkat, b.gol_ruang, b.id_pangkat 
						FROM tbl_usulan_pmk a
							LEFT JOIN ref_pangkat b ON a.id_pangkat_pejabat_pengusul = b.id_pangkat 
						WHERE a.id_usulan = '". $id_usul ."'";
						
		$query = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_array($query);
	?>
<form name="frm_edit_usul_pmk" id="frm_edit_usul_pmk" action="" method="POST">
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">EDIT DATA USULAN PENYESUAIAN MASA KERJA (ID DATA : <?=$row['id_usulan']; ?>)</h3><br/>
	<div id="notifikasi" style='display:none;'>
	</div><br/>
	<button type="button" class="btn btn-lg btn-success" onclick="kembali();" style="margin-left:15px;margin-top:5px;">
	<span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;Kembali</button>
    <div class="bodypanel bodyfilter" id="bodyfilter">
	
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
                    <label>NO. Surat Usulan :</label>
					<input type="hidden" id="id_usulan" name="id_usulan" value="<?=$row['id_usulan'];?>" />
					<input type="hidden" id="no_us" name="no_us" value="<?=$row['no_usulan'];?>" />
                    <input type="text" name="no_usulan" id="no_usulan" class="form-control" value="<?=$row['no_usulan']; ?>" />
                </td>
                <td>
                    <label>Tgl. Surat Usulan :</label>
                    <input type="text" name="tgl_usulan" id="tgl_usulan" class="form-control" value="<?=$row['tgl_usulan']; ?>" />
                </td>
            </tr>
            <tr>
                <td width='50%'>
                    <label>Nama Pejabat Penandatangan Usulan :</label>
                    <input type="text" name="pengusul" id="pengusul" class="form-control" value="<?=$row['pejabat_pengusul'];?>" />
                </td>
                <td>
                   <label>NIP Pejabat Pengusul :</label>
				   <input type="text" name="nip_pengusul" id="nip_pengusul" class="form-control" value="<?=$row['nip_pejabat_pengusul'];?>" />
                </td>
            </tr>
			<tr>
				 <td width="50%">
                    <label>Jabatan Pejabat Penandatangan : </label>
                    <input type="text" name="jabatan_ttd" id="jabatan_ttd" class="form-control" value="<?=$row['jabatan_penandatangan'];?>" />
                </td>
                <td>
                    <label>Pangkat Pejabat Penandatangan :</label>
                    <!--<input type="text" name="id_pangkat" id="id_pangkat" class="form-control" value="<? echo $row['id_pangkat'];?>" readonly="readonly"/>
					!--->
					<select name="id_pangkat" id="id_pangkat" class="form-control">
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
                     <input type="submit" value="SIMPAN UBAH" style="width: 170px; height: 40px;" class="btn btn-lg btn-success" id="btn_edit"/>
					 <input type="reset" value="RESET" style="width: 150px; height: 40px;" class="btn btn-lg btn-info"/>
			   </td>
            </tr>
        </table>
    </div>
</div>
</form>
<div class="kelang"></div>
<iframe src="" style="display: none;" id="sbm_target" name="sbm_target"></iframe>