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
		
		$("#expand").click(function(){
			$("#bodyfilter").slideToggle(500);
		});
    });
    
    function simpan(){
		$("#frm").submit();
     }
    
    function kembali(){
        document.location.href="?mod=pmk_daftar_sk";
    }
	
	
</script>
<!-- END OF JAVASCRIPT PAGE -->
<?php
	$id_sk = mysql_real_escape_string(isset($_GET['id_sk']));
	$sql = "SELECT * FROM tbl_sk_pmk WHERE id_surat = '$id_sk'";
	$query = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_array($query);
?>

<form name="frm" id="frm" action="" method="POST" >
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">Cetak Laporan-Laporan SK Peninjauan Masa Kerja (PMK)</h3>	
	<button type="button" class="btn btn-lg btn-success" onclick="kembali();" style="margin-left:15px;margin-top:5px;">
	<span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;Kembali</button>
    <div class="bodypanel bodyfilter" >
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
                    <label>NO. SK :</label>
					<input type="hidden" name="id_surat" value="<?=$row['id_surat'];?>" />
					<input type="hidden" name="no_usul" value="<?=$row['no_usul_pmk'];?>" />
                    <input type="text" name="no_sk" id="no_sk" class="form-control" value="<?=$row['no_sk'];?>" readonly="readonly"/>
                </td>
                <td>
                    <label>Tgl. SK  :</label>
                    <input type="text" name="tgl_sk" id="tgl_sk" class="form-control" value="<?=$row['tgl_surat'];?>" readonly="readonly"/>
                </td>
            </tr>
            <tr>
                <td width='50%'>
                    <label>Nama Pejabat Penandatangan Usulan :</label>
                    <input type="text" name="pejabat_ttd" id="pejabat_ttd" class="form-control" value="<?=$row['pejabat_ttd'];?>" readonly="readonly"/>
                </td>
                <td>
                   <label>NIP Pejabat Penandatangan :</label>
				   <input type="text" name="nip_pejabat" id="nip_pejabat" class="form-control" value="<?=$row['nip_pejabat_ttd'];?>" readonly="readonly"/>
                </td>
            </tr>
			
			<tr>
				 <td width="50%">
                    <label>Jabatan Pejabat Penandatangan : </label>
                    <input type="text" name="jabatan_ttd" id="jabatan_ttd" class="form-control" value="<?=$row['jabatan_ttd_sk'];?>" readonly="readonly"/>
                </td>
			</tr>
			
        </table>
    </div>
</div>
</form>
<div class="kelang"></div>
<form name="frm_cetak_pmk" id="frm_cetak_pmk" action="php/pmk/cetak_laporan_pmk.php" method="POST" target="_blank">
    <div class="panelcontainer" style="width: 100%;">
        <h3><div style="display: block; float: left;"><div style="clear: both;"></div>FORM SETTING FORMAT LAPORAN</div><input type="button" value="+" style="float: right; display: block; font-weight: bold;" id="expand" /><div style="clear: both;"></div></h3>
        <div class="bodypanel" id="bodyfilter">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
					<td>
					 <label>Pilih Format Output File : </label><br/>
					 <input type="radio" name="format" value="1"><img src="image/pdf.png" width="18" height="18" />&nbsp;&nbsp;PDF&nbsp;&nbsp;
					 <input type="radio" name="format" value="2"><img src="image/word.gif" width="16" height="16" />&nbsp;&nbsp;Microsoft Word&nbsp;&nbsp;
					 <input type="radio" name="format" value="3"><img src="image/excel.gif" width="16" height="16" />&nbsp;&nbsp;Microsoft Excel&nbsp;&nbsp;
					</td>
				</tr>
            </table>
			<div class="kelang"></div>
				
			<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
				<tr>
					<td width='50%'>
						<label>Nama File Output : </label>
						<input type="text" name="filename" id="filename" class="form-control" placeholder=":: INPUT NAMA FILE OUTPUT LAPORAN ::" />
					</td>
				</tr>
				<tr>
					<td width='50%'>
						<label>Atur Margin Laporan : </label>
						<input type="hidden" name="id_usul" value="<?=$row['id_usulan'];?>" />
						<input type="hidden" name="no_usul" value="<?=$row['no_usulan'];?>" />
						<input type="text" name="setmargin" id="setmargin" class="form-control" placeholder=":: ATUR UKURAN MARGIN ATAS, BAWAH, KIRI DAN KANAN OUTPUT LAPORAN DIPISAHKAN DENGAN TANDA KOMA contoh (0,20,15,10)::" />
					</td>
				</tr>
				<tr>
					<td width='50%'>
						<label>Jenis Laporan : </label>
						<select class="form-control" name="jenis">
							<option value='0' selected="selected">===== JENIS LAPORAN YANG INGIN DICETAK =====</option>
							<option value='1'> Lampiran SK PMK</option>
							<option value='2'> Petikan SK PMK</option>
							<option value='3'> Usulan PMK</option>
						</select>
					</td>
				</tr>
			</table>
            <div class="kelang"></div>
            <table border="0px" cellspacing='0' cellpadding='0' width='40%'>
                <tr>
                    <td width='50%'><input type="submit" value='PRINT' style="width: 100%; height:35px;" class="btn btn-success" id="btn_submit"/></td>
                    <td width='50%'><input type="reset" value='RESET' style="width: 100%;  height:35px;" class="btn btn-warning"/></td>
                </tr>
            </table>
        </div>
    </div>
</form>
<div class="kelang"></div>
<iframe src="" style="display: none;" id="sbm_target" name="sbm_target"></iframe>