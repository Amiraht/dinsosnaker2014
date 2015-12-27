<script type="text/javascript">
$(document).ready(function(){
   $( "#dialog_cadis" ).dialog({
        autoOpen: false,
		height: 540,
		width: 900,
		modal: true,
        show: "fade",
		hide: "fade"
    }); 
});
function lanjut(id){
    document.location.href="?mod=skp_uraian&id=" + id;
}
function rat(id){
    document.location.href="?mod=skp_uraian&id=" + id + "&rat=1";
}
function catatan(id_skp){
    $("#dialog_cadis").dialog("open");
    $.ajax({
        type: "GET",
        url: "ajax/cadis_spv_skp.php",
        data: "id_skp=" + id_skp,
        success: function(r){
            $("#dialog_cadis").html(r);
        }
    });
}
function tambah(id_skp){
    <?php
        $res_ada_yg_blm_spv = mysql_query("SELECT * FROM tbl_skp WHERE id_pegawai = '" . $_SESSION["simpeg_id_pegawai"] . "' AND (status_supervisi = 1 OR status_supervisi = 2)");
        if(mysql_num_rows($res_ada_yg_blm_spv) > 0){
    ?>
            /**
             * Uncomment the following line if the supervision procedure is effect at adding new
             * periode
             */
            //jAlert("Maaf, masih ada data yang belum disupervisi atau belum direvisi", "PERHATIAN");
            document.location.href='?mod=skp_target_tambah&id_skp=' + id_skp;
    <?php
        }else{
    ?>
            document.location.href='?mod=skp_target_tambah&id_skp=' + id_skp;
    <?php
        }
    ?>
}
function edit(id_skp){
    document.location.href='?mod=skp_target_tambah&id_skp=' + id_skp;
}
function hapus(id_skp){
    jConfirm("Anda yakin akan menghapus data periode penilaian ini?", "PERHATIAN", function(r){
       if(r){
            document.location.href="php/skp/skp_target_hapus.php?id_skp=" + id_skp;
       } 
    });
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
                                <h1><a style="color:#AA9F00;" href="">DATA SKP TARGET</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /><a href="./?mod=skp_target"><span>DATA SKP TARGET</span></a></td>
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
		<div class="panelcontainer" style="width: 100%;">
				<h3 style="text-align: left;">DATA PERIODE PENILAIAN <?php echo(strtoupper(detail_pegawai($_SESSION["id_pegawai"], "nama_pegawai"))); ?>
				(NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["id_pegawai"], "nip"))); ?>)</h3>
				<div class="bodypanel">
					<input type="button" value="Tambah Data Periode Penilaian" onclick="tambah(0);" class='btn btn-success' />
					<div class="kelang"></div>
					<table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
					<thead>
						<tr class="headertable">
							<th width='5'>&nbsp;</th>
							<th width='40px'>No.</th>
							<th width='55px'>Periode</th>
							<th width='120px'>Pejabat Penilai</th>
							<th width='120px'>Pejabat Penandatangan Penilaian SKP</th>
							<th width='5px'>&nbsp;</th>
							<th width='5px'>&nbsp;</th>
							<th width='5px'>&nbsp;</th>
							<th width='5px'>&nbsp;</th>
							<th width='5px'>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$res = mysql_query("SELECT
												a.*, b.nama_pegawai AS nama_pegawai_penilai, b.nip AS nip_penilai, 
												c.nama_pegawai AS nama_pegawai_atasan_penilai, c.nip AS nip_atasan_penilai
											FROM
												tbl_skp a
												LEFT JOIN tbl_pegawai b ON a.id_pegawai_penilai = b.id_pegawai
												LEFT JOIN tbl_pegawai c ON a.id_atasan_pegawai_penilai = c.id_pegawai
											WHERE
												a.id_pegawai = '" . $_SESSION["id_pegawai"] . "'
											ORDER BY
												a.dari ASC
											") or die(mysql_error());
						$no = 0;
						while($ds = mysql_fetch_array($res)){
							$no++;
							echo("<tr>");
								echo("<td align='center'>" . status_supervisi($ds["status_supervisi"]) . "</td>");
								echo("<td align='center'>" . $no . "</td>");
								//echo("<td align='center'>" . $ds["dari"] . "<br/>S/D<br/>" . $ds["dari"] . "</td>");
								echo("<td align='center'>" . tglindonesia($ds["dari"]) . " S/D " . tglindonesia($ds["sampai"]) . "</td>");
								echo("<td align='center'>" . $ds["nama_pegawai_penilai"] . " (NIP : " . $ds["nip_penilai"] . ")</td>");
								echo("<td align='center'>" . $ds["nama_pegawai_atasan_penilai"] . " (NIP : " . $ds["nip_atasan_penilai"] . ")</td>");
								echo("<td>
										<img src='image/Edit-32.png' width='18px' class='linkimage' title='Edit Data Periode' onclick='edit(" . $ds["id_skp"] . ")' />
									 </td>");
								echo("<td>
										<img src='image/Delete-32.png' width='18px' class='linkimage' title='Hapus Data Periode' onclick='hapus(" . $ds["id_skp"] . ")' />
									 </td>");
								echo("<td>
										<img src='image/icon-disposisi.png' width='18px' class='linkimage' title='Lihat catatan supervisi' onclick='catatan(" . $ds["id_skp"] . ")' />
									 </td>");
								echo("<td>
										<img src='image/Text-Signature-32.png' width='18px' class='linkimage' title='Lanjut Untuk Mengisikan Uraian Kegiatan' onclick='lanjut(" . $ds["id_skp"] . ")' />
									 </td>");
								if($ds["status_supervisi"] == 3){
									echo("<td>
											<img src='image/Application-View-Detail-32.png' width='18px' class='linkimage' title='Lakukan Revisi Akhir Tahun' onclick='rat(" . $ds["id_skp"] . ")' />
										 </td>");
								}else{
									echo("<td>&nbsp;</td>");
								}
								
							echo("</tr>");
						}
					?>
					</tbody>
					</table>
				</div>
			</div>

	</div>
</td>
</tr>

<tr>
     <td><br><div id='footer'></div></td>
 </tr>
 </table>
 



<!-- DIALOG JQUERY -->
<div id="dialog_cadis" title="Catatan : Supervisi SKP" style="display: none;">
    
</div>
<!-- ------------- -->