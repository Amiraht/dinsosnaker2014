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
        ambil_tanggal("tgl_sk");
    
		$('#btn_tambah').click(function(){
			var no_sk = $('#no_sk').val();
			var tgl_sk = $('#tgl_sk').val();
			if(no_sk == ""){
				jAlert("Maaf, No SK harus diisi !!", "PERHATIAN");
				return false;
			}else if(tgl_sk == ""){
				jAlert("Maaf, Tgl SK harus diisi !!", "PERHATIAN");
				return false;
			}else{
				$("#notifikasi").html("");
				$.post("php/pmk/pmk_daftar_sk_tambah.php",
						$("#frm_sk_tambah").serialize(),
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
        document.location.href="?mod=pmk_daftar_sk";
    }
    
</script>
<!-- END OF JAVASCRIPT PAGE -->

<!-- JAVASCRIPT FROM CHILD -->
<script type="text/javascript">

    function something_wrong(what_is_wrong){
        jAlert(what_is_wrong, "PERHATIAN");
    }
    
    function success(){
        jAlert("Data SK pengusulan kenaikan pangkat telah disimpan", "PERHATIAN", function(r){
            document.location.href="?mod=kenpang_daftar_sk";
        });
    }

</script>
<!-- END OF JAVASCRIPT FROM CHILD -->

<form name="frm_sk_tambah" id="frm_sk_tambah" action="" method="post" target="sbm_target">
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">TAMBAH SK PENINJAUAN MASA KERJA (PMK)</h3><br/>
	<div id="notifikasi" style='display:none;'>
	</div><br/>
	<button type="button" class="btn btn-lg btn-success" onclick="kembali();" style="margin-left:15px;margin-top:5px;">
	<span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;Kembali</button>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
                    <label>NO. SK :</label>
                    <input type="text" name="no_sk" id="no_sk" class="form-control" placeholder=":: INPUT NO SK PENINJAUAN MASA KERJA ::"/>
                </td>
                <td>
                    <label>Tgl. SK :</label>
                    <input type="text" name="tgl_sk" id="tgl_sk" class="form-control" placeholder=":: INPUT TANGGAL SK PENINJAUAN MASA KERJA ::"/>
                </td>
            </tr>
            <tr>
                <td width='50%'>
                    <label>Pejabat Penandatangan :</label>
                    <input type="text" name="nama_ttd_sk" id="nama_ttd_sk" class="form-control" placeholder=":: INPUT NAMA PEJABAT PENANDATANGAN ::"/>
                </td>
                <td>
                    <label>NIP Pejabat Penandatangan :</label>
                    <input type="text" name="nip_ttd_sk" id="nip_ttd_sk" class="form-control" placeholder=":: INPUT NIP PEJABAT PENANDATANGAN ::"/>
                </td>
            </tr>
            <tr>
                <td width='50%'>
                    <label>Jabatan Pejabat Penandatangan :</label>
                    <input type="text" name="jabatan_ttd_sk" id="jabatan_ttd_sk" class="form-control" placeholder=":: JABATAN PEJABAT PENANDATANGAN SK ::"/>
                </td>
                <td>
                    <label>Pangkat Pejabat Penandatangan :</label>
                    <select name="id_pangkat_ttd_sk" id="id_pangkat_ttd_sk" class="form-control">
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
                    <input type="submit" value="SIMPAN" style="width: 150px; height: 40px;" class="btn btn-lg btn-success" id="btn_tambah"/>
					<input type="reset" value="RESET" style="width: 150px; height: 40px;" class="btn btn-lg btn-info"/>
				</td>
            </tr>
        </table>
    </div>
</div>
</form>
<div class="kelang"></div>
<iframe src="" style="display: none;" id="sbm_target" name="sbm_target"></iframe>