<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $pegawai = array();
    $sql_peg = "SELECT * FROM tbl_pegawai WHERE id_satuan_organisasi = '". $_SESSION["simpeg_id_skpd"] ."' ORDER BY nama_pegawai ASC";
    $res_peg = mysql_query($sql_peg);
    while($ds_pangkat = mysql_fetch_array($res_peg)){
        $row_pangkat["nip"] = $ds_pangkat["nip"];
        $row_pangkat["nama"] = $ds_pangkat["nama_pegawai"];
        array_push($pegawai, $row_pangkat);
    }
    echo("var pegawai = " . json_encode($pegawai) . ";\n");
	
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
	
	// generate JSON untuk data SKPD
	$skpd = array();
    $sql_skpd = "SELECT * FROM ref_skpd ";
    $res_skpd = mysql_query($sql_skpd);
    while($ds_skpd = mysql_fetch_array($res_skpd)){
        $row_skpd["id_skpd"] = $ds_skpd["id_skpd"];
        $row_skpd["skpd"] = $ds_skpd["skpd"];
        array_push($skpd, $row_skpd);
    }
    echo("var skpd = " . json_encode($skpd) . ";\n");
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
        jAlert("Data surat usulan penyesuaian masa kerja telah disimpan", "KONFIRMASI", function(r){
            document.location.href="?mod=pmk_daftar_usulan";
        });
    }

</script>
<!-- END OF JAVASCRIPT FROM CHILD -->

<form name="frm" id="frm" action="php/pmk/pmk_daftar_usulan_tambah.php" method="POST">
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">TAMBAH SURAT USULAN PENYESUAIAN MASA KERJA </h3>
	<button type="button" class="btn btn-lg btn-success" onclick="kembali();" style="margin-left:15px;margin-top:5px;">
	<span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;Kembali</button>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
                    <label>NO. Surat Usulan :</label>
                    <input type="text" name="no_usulan" id="no_usulan" class="form-control" placeholder=":: INPUT NOMOR SURAT USULAN ::" />
                </td>
                <td>
                    <label>Tgl. Surat Usulan :</label>
                    <input type="text" name="tgl_usulan" id="tgl_usulan" class="form-control" />
                </td>
            </tr>
            <tr>
                <td width='50%'>
                    <label>Nama Pejabat Penandatangan Usulan :</label>
                    <input type="text" name="pengusul" id="pengusul" class="form-control" placeholder=":: INPUT NAMA PEJABAT PENANDATANGAN USULAN ::"/>
                </td>
                <td>
                   <label>NIP Pejabat Penandatangan :</label>
				   <input type="text" name="nip_pengusul" id="nip_pengusul" class="form-control" placeholder=":: INPUT NIP PEJABAT PENANDATANGAN USULAN ::"/>
                </td>
            </tr>
			<tr>
				 <td width="50%">
                    <label>Jabatan Pejabat Penandatangan : </label>
                    <input type="text" name="jabatan_ttd" id="jabatan_ttd" class="form-control" placeholder=" :: INPUT JABATAN PENANDATANGAN USULAN :: "/>
                </td>
                <td>
                    <label>Pangkat Pejabat Penandatangan :</label>
                     <select name="id_pangkat_ttd" id="id_pangkat_ttd" class="form-control">
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
                     <input type="submit" value="SIMPAN" style="width: 150px; height: 40px;" class="btn btn-lg btn-success"/>
					 <input type="reset" value="RESET" style="width: 150px; height: 40px;" class="btn btn-lg btn-info"/>
			   </td>
            </tr>
        </table>
    </div>
</div>
</form>
<div class="kelang"></div>
<iframe src="" style="display: none;" id="sbm_target" name="sbm_target"></iframe>