<script type="text/javascript">
$(document).ready(function(){
    ambil_tanggal("tgl_bakn");
    ambil_tanggal("tgl_sk_cpns");
    ambil_tanggal("tmt_cpns");
    $( "#dialog_cadis" ).dialog({
        autoOpen: false,
		height: "auto",
		width: 500,
		modal: true,
        show: "fade",
		hide: "fade"
    });
});
function disimpan(){
    jConfirm("Anda yakin akan menyimpan data pengangkatan CPNS ini?", "PERHATIAN", function(r){
       if(r){
            $("#frm").submit();
       } 
    });
}
function catatan(id_riwayat_jabatan){
    $("#dialog_cadis").dialog("open");
}
</script>


<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
          <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href=""></a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span></span></td>
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
		
	</div>
</td>
</tr>
<tr>
     <td><br><div id='footer'></div></td>
 </tr>
 </table>
 


<form name="frm" id="frm" action="php/pengangkatan_cpns/pengangkatan_cpns.php" method="post">
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">DATA PENGANGKATAN CPNS <?php echo(strtoupper(detail_pegawai($_SESSION["id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["id_pegawai"], "nip"))); ?>)</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <?php
		 if(isset($_GET["msg"])){
             if($_GET["msg"] == 1){
                 echo "
                        <div class='alert alert-info' role='alert'>
                            Data pengangkatan CPNS telah disimpan
                        </div>
                 ";
             }
			} 
        ?>
        <?php
            $ds_data = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pengangkatan_cpns WHERE id_pegawai='" . $_SESSION["id_pegawai"] . "'"));
            if($ds_data["status_supervisi"] == 2){
                echo("<button type='button' class='btn btn-sm btn-success' onclick='catatan();'>Lihat Catatan Supervisi</button>");
                echo("<div class='kelang'></div>");
            }
        ?>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='70%'>
                <input type="text" name="no_bakn" id="no_bakn" placeholder=":: No. Persetujuan BKN ::" value="<?php echo($ds_data["no_bakn"]); ?>" />
				
                </td>
                <td width='80%'>
                    <label>Tgl. Persetujuan BKN :</label>
                    <input type="text" name="tgl_bakn" id="tgl_bakn" placeholder=":: Tgl. Persetujuan BKN ::" value="<?php echo($ds_data["tgl_bakn"]); ?>" />
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <label>Pejabat Penetapan :</label>
                    <input type="text" name="pejabat_penetapan" id="pejabat_penetapan" placeholder=":: Pejabat Penetapan ::" value="<?php echo($ds_data["pejabat_penetapan"]); ?>" />
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='70%'>
                    <label>No. SK CPNS :</label>
                    <input type="text" name="no_sk_cpns" id="no_sk_cpns" placeholder=":: No. SK CPNS ::" value="<?php echo($ds_data["no_sk_cpns"]); ?>" />
                </td>
                <td width='80%'>
                    <label>Tgl. SK CPNS :</label>
                    <input type="text" name="tgl_sk_cpns" id="tgl_sk_cpns" placeholder=":: Tgl. SK CPNS ::" value="<?php echo($ds_data["tgl_sk_cpns"]); ?>" />
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='70%'>
                    <label>Pangkat :</label>
                    <select name="id_pangkat" id="id_pangkat">
                        <option value="0">:: Pilih Pangkat ::</option>
                    <?php
                        $res_pg = mysql_query("SELECT * FROM ref_pangkat");
                        while($ds_pg = mysql_fetch_array($res_pg)){
                            if($ds_pg["id_pangkat"] == $ds_data["id_pangkat"])
                                echo("<option selected='selected' value='" . $ds_pg["id_pangkat"] . "'>" . $ds_pg["pangkat"] . " (" . $ds_pg["gol_ruang"] . ")</option>");
                            else
                                echo("<option value='" . $ds_pg["id_pangkat"] . "'>" . $ds_pg["pangkat"] . " (" . $ds_pg["gol_ruang"] . ")</option>");
                        }
                    ?>
                    </select>
                </td>
                <td width='80%'>
                    <label>TMT CPNS :</label>
                    <input type="text" name="tmt_cpns" id="tmt_cpns" placeholder=":: TMT CPNS ::" value="<?php echo($ds_data["tmt_cpns"]); ?>" />
                </td>
            </tr>
        </table>
		<table border="0px" cellspacing='0' cellpadding='0' width='50%'>
            <tr>
                <td width='20%'>
                    <label>Masa Kerja (dalam tahun) :</label>
                    <input type="text" name="mk_tahun" id="mk_tahun" maxlength="2" placeholder=":: INPUT MASA KERJA DALAM TAHUN::" value="<?=$ds_data['mk_tahun'] == "" ? "00" : $ds_data['mk_tahun'];?>" />
                </td>
                <td width='20%'>
                    <label>Masa Kerja (dalam bulan)</label>
                    <input type="text" name="mk_bulan" id="mk_bulan" maxlength="2" placeholder=":: INPUT MASA KERJA DALAM BULAN ::" value="<?=$ds_data['mk_bulan'] == "" ? "00" : $ds_data['mk_bulan'];?>" />
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="kelang"></div>
<div class="panelcontainer panelform" style="width: 100%;">
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <?php
            if($ds_data["status_supervisi"] != 3 || $_SESSION["id_level"] == 12){
        ?>
                <button type="button" class="btn btn-lg btn-success" onclick="disimpan();">Simpan</button>
                <button type="reset" class="btn btn-lg btn-default">Reset</button>
        <?php
            }else{
                echo "
                <div class='alert alert-info' role='alert'>
                            Data pengangkatan CPNS telah di ACC. Data tidak bisa diedit kembali
                        </div>
                ";
            }
        ?>
        
    </div>
</div>
</form>
<!-- DIALOG JQUERY -->
<div id="dialog_cadis" title="Catatan : Revisi / Perbaikan Data Pengangkatan CPNS" style="display: none;">
<?php
    $res_supervisi = mysql_query("SELECT * FROM catatan_pengangkatan_cpns WHERE id_pegawai='" . $_SESSION["simpeg_id_pegawai"] . "'") or die(mysql_error());
	$num = mysql_num_rows($res_supervisi);
	if($num <= 0){
		echo "<center>TIDAK ADA CATATAN SUPERVISI DARI ADMIN SIMPEG</center>";
	}else{	
		$no_ctt = 0;
		while($ds_supervisi = mysql_fetch_array($res_supervisi)){
			$no_ctt++;
			echo("<div class='judullist'>Catatan No : " . $no_ctt . "</div>");
			echo("<div class='isilist'>");
            echo("<div>" . $ds_supervisi["catatan"] . "</div>");
			echo("</div>");
		}
    }	
?>
</div>
<!-- ------------- -->