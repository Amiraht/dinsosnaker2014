<script type="text/javascript">
function lanjut(id){
    document.location.href="?mod=perilaku_tanggapi&id_skp=" + id + "&id_pegawai=<?php echo($_GET["id_pegawai"]); ?>";
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
		<div class="panelcontainer" style="width: 100%;">
			<h3 style="text-align: left;">DATA PERIODE PENILAIAN PERILAKU PEGAWAI <?php echo(strtoupper(detail_pegawai($_GET["id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_GET["id_pegawai"], "nip"))); ?>)</h3>
			<div class="bodypanel">
				<table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
				<thead>
					<tr class="headertable">
						<th width='40px'>No.</th>
						<th>Periode</th>
						<th width='450px'>Pejabat Penilai</th>
						<th width='450px'>Atasan Pejabat Penilai</th>
						<th width='20px'>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$res = mysql_query("SELECT
											a.*, b.nama_pegawai AS nama_pegawai_penilai, b.nip AS nip_penilai, 
											c.nama_pegawai AS nama_pegawai_atasan_penilai, c.nip AS nip_atasan_penilai
										FROM
											tbl_skp_perilaku a
											LEFT JOIN tbl_pegawai b ON a.id_pegawai_penilai = b.id_pegawai
											LEFT JOIN tbl_pegawai c ON a.id_atasan_pegawai_penilai = c.id_pegawai
										WHERE
											a.id_pegawai = '" . $_GET["id_pegawai"] . "'
										ORDER BY
											a.dari ASC
										");
					$no = 0;
					while($ds = mysql_fetch_array($res)){
						$no++;
						echo("<tr>");
							echo("<td align='center'>" . $no . "</td>");
							//echo("<td align='center'>" . $ds["dari"] . "<br/>S/D<br/>" . $ds["dari"] . "</td>");
							echo("<td align='center'>" . tglindonesia($ds["dari"]) . " S/D " . tglindonesia($ds["sampai"]) . "</td>");
							echo("<td align='center'>" . $ds["nama_pegawai_penilai"] . " (NIP : " . $ds["nip_penilai"] . ")</td>");
							echo("<td align='center'>" . $ds["nama_pegawai_atasan_penilai"] . " (NIP : " . $ds["nip_atasan_penilai"] . ")</td>");
							echo("<td>
									<img src='image/Text-Signature-32.png' width='18px' class='linkimage' title='Lanjut Untuk Mengisikan Data Hasil Penilaian Perilaku' onclick='lanjut(" . $ds["id_skp_perilaku"] . ")' />
								 </td>");
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
 



