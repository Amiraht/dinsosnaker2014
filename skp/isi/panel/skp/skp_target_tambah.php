<script type="text/javascript">
$(document).ready(function(){
    ambil_tanggal("dari");
    ambil_tanggal("sampai"); 
});
function disimpan(){
    var dari = $("#dari").val();
    var sampai = $("#sampai").val();
    var nip_pejabat_penilai = $("#nip_pejabat_penilai").val();
    var nip_atasan_pejabat_penilai = $("#nip_atasan_pejabat_penilai").val();
    if(dari == "" || sampai == "" || nip_pejabat_penilai == "" || nip_atasan_pejabat_penilai == "")
        jAlert("Maaf! dari, sampai, NIP Pejabat Penilai, dan NIP Atasan Pejabat Penilai harus diisi", "PERHATIAN");
    else{
        $("#frm").submit();
    }
}
</script>
<?php
	$id_skp = mysql_real_escape_string(trim(strip_tags($_GET["id_skp"])));
	
    $ds_skp = mysql_fetch_array(mysql_query("SELECT
                                            	a.*, b.nip AS nip_penilai, c.nip AS nip_atasan_penilai
                                            FROM
                                            	tbl_skp a
                                            	LEFT JOIN tbl_pegawai b ON a.id_pegawai_penilai = b.id_pegawai
                                            	LEFT JOIN tbl_pegawai c ON a.id_atasan_pegawai_penilai = c.id_pegawai
                                            WHERE
                                                id_skp='" . $id_skp . "'"));
?>


<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
          <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="">TAMBAH DATA SKP TARGET</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>TAMBAH DATA SKP TARGET</span></td>
                           <td>&nbsp;&nbsp;</td>
                        </tr>
                    </table>            
                    </div>
            <br>
        </td>
  </tr>
  <tr>
  	<td>
    <div id='content' style='padding-top:10px;'>	<br>
			<form name="frm" id="frm" action="php/skp/skp_target_tambah.php" method="post">
			<input type="hidden" name="id_skp" value="<?php echo($_GET["id_skp"]); ?>" />
			<div class="panelcontainer panelform" style="width: 100%;">
				<h3 style="text-align: left;">DATA SKP PEGAWAI <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nip"))); ?>)</h3>
				<div class="bodypanel bodyfilter" id="bodyfilter">
					<input type="button" value="Kembali" onclick="document.location.href='?mod=skp_target';" />
					<div class="kelang"></div>
					<table border="0px" cellspacing='0' cellpadding='0' width='40%'>
						<tr>
							<td>
								<label>Periode Penilaian (Dari) :</label>
								<input type="text" name="dari" id="dari" placeholder=":: Dari Tanggal ::" title="Dari Tanggal" value="<?php echo($ds_skp["dari"]); ?>" />
							</td>
							<td align='center' width='50px'>S/D</td>
							<td>
								<label>Periode Penilaian (Hingga) :</label>
								<input type="text" name="sampai" id="sampai" placeholder=":: Hingga Tanggal ::" title="Hingga Tanggal" value="<?php echo($ds_skp["sampai"]); ?>" />
							</td>
						</tr>
					</table>
					<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
						<tr>
							<td width='50%'>
								<label>
									NIP Pejabat Penilai :
									<a href="javascript:show_auto_search_pegawai('nip_pejabat_penilai');" class="link_auto_panel input_widget">Search</a>
								</label>
								<input type="text" name="nip_pejabat_penilai" id="nip_pejabat_penilai" placeholder=":: NIP Pejabat Penilai ::" title="NIP Pejabat Penilai" value="<?php echo($ds_skp["nip_penilai"]); ?>" />
							</td>
							<td>
								<label>
									Pejabat Penandatangan Penilaian SKP :
									<a href="javascript:show_auto_search_pegawai('nip_atasan_pejabat_penilai');" class="link_auto_panel input_widget">Search</a>
								</label>
								<input type="text" name="nip_atasan_pejabat_penilai" id="nip_atasan_pejabat_penilai" placeholder=":: NIP Atasan Pejabat Penilai ::" title="NIP Atasan Pejabat Penilai" value="<?php echo($ds_skp["nip_atasan_penilai"]); ?>" />
							</td>
						</tr>
					</table>
					<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
						<tr>
							<td style="text-align: left;">
								<button type="button" class="btn btn-success" onclick="disimpan();">Simpan</button>
								<button type="reset" class="btn btn-default">Reset</button>
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
 



