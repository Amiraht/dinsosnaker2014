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
    });
    
    function simpan(){
		var no_sk = $("#no_sk").val();
		if(no_sk == ''){
			 jAlert("Maaf No SK Kosong !!", "PERHATIAN");
		}
    }
    
    function kembali(){
        document.location.href="?mod=kenpang_daftar_sk";
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


<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
          <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="">TAMBAH SK KEPANGKATAN</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>TAMBAH SK KEPANGKATAN</span></td>
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
		
			<form name="frm" id="frm" action="php/kpk/daftar_sk_tambah.php" method="post">
			<div class="panelcontainer panelform" style="width: 100%;">
				<h3 style="text-align: left;">TAMBAH SK PENGUSULAN KENAIKAN PANGKAT</h3><br/>
				<button type="button" class="btn btn-lg btn-success" onclick="kembali();" style="margin-left:15px;margin-top:5px;">
				<span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;Kembali</button>
				<div class="bodypanel bodyfilter" id="bodyfilter">
					<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
						<tr>
							<td>
								<label>NO. SK :</label>
								<input type="text" style='width:90%;' name="no_sk" id="no_sk" class="form-control" placeholder=":: INPUT NO SK KENAIKAN PANGKAT ::"/>
							</td>
							<td>
								<label>Tgl. SK :</label>
								<input type="text" style='width:90%;' name="tgl_sk" id="tgl_sk" class="form-control" placeholder=":: INPUT TANGGAL SK KENAIKAN PANGKAT ::"/>
							</td>
						</tr>
						<tr>
							<td>
								<label>Nama Pejabat Penandatangan :</label>
								<input type="text" style='width:90%;' name="nama_ttd_sk" id="nama_ttd_sk" class="form-control" placeholder=":: INPUT NAMA PEJABAT PENANDATANGAN ::"/>
							</td>
							<td>
								<label>NIP Pejabat Penandatangan :</label>
								<input type="text" style='width:90%;' name="nip_ttd_sk" id="nip_ttd_sk" class="form-control" placeholder=":: INPUT NIP PEJABAT PENANDATANGAN ::"/>
							</td>
						</tr>
						<tr>
							<td>
								<label>Jabatan Pejabat Penandatangan :</label>
								<input type="text" style='width:90%;' name="jabatan_ttd_sk" id="jabatan_ttd_sk" class="form-control" placeholder=":: JABATAN PEJABAT PENANDATANGAN SK ::"/>
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
								<input type="submit" value="SIMPAN" style="width: 150px; height: 40px;" class="btn btn-success"/>
								<input type="reset" value="RESET" style="width: 150px; height: 40px;" class="btn btn-info"/>
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
 