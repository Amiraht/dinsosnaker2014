<?php unset($_SESSION["simpeg_id_pegawai"]); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#expand").click(function(){
            $("#bodyfilter").slideToggle(800);
        });
    });
    function lanjut(id){
        document.location.href="php/set_pegawai.php?id=" + id + "&mod=";
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
                                <h1><a style="color:#AA9F00;" href="">SUPERVISI DATA PEGAWAI</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>SUPERVISI DATA PEGAWAI</span></td>
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
		<form name="frm" action="?mod=<?php echo($_GET["mod"]); ?>" method="POST">
			<div class="panelcontainer" style="width: 100%;">
				<h3><div style="display: block; float: left;"><div style="clear: both;"></div>FILTER DATA PENCARIAN</div><input type="button" value="+" style="float: right; display: block; font-weight: bold;" id="expand" /><div style="clear: both;"></div></h3>
				<div class="bodypanel bodyfilter" id="bodyfilter">
					<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
						<tr>
							<td width='50%'>
								<input type="text" name="nama_pegawai" placeholder="Cari Nama Pegawai" title="Nama Pegawai" value="<?=isset($_POST["nama_pegawai"]) ? $_POST["nama_pegawai"] : ""; ?>" />
							</td>
							<td>
								<input type="text" name="nip" placeholder="Cari NIP Pegawai" title="NIP Pegawai" value="<?=isset($_POST["nip"]) ? $_POST["nip"] : ""; ?>" />
							</td>
						</tr>
					</table>
					<div class="kelang"></div>
					<table border="0px" cellspacing='0' cellpadding='0' width='20%'>
						<tr>
							<td width='50%'><input type="submit" value='Filter' style="width: 100%;" /></td>
							<td width='50%'><input type="reset" value='Reset' style="width: 100%;" /></td>
						</tr>
					</table>
				</div>
			</div>
			</form>
			<div class="kelang"></div>
			<div class="panelcontainer" style="width: 100%;">
				<h3 style="text-align: left;">DAFTAR PEGAWAI DI SKPD <?php echo(strtoupper(nama_skpd($_SESSION["id_skpd"]))); ?> YANG PERLU SUPERVISI DATA</h3>
				<div class="bodypanel">
				<table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
					<thead>
						<tr class="headertable">
							<th width='40px'>No.</th>
							<th width='150px'>Nama Pegawai</th>
							<th width='150px'>NIP</th>
							<th width='100px'>Status Kepegawaian</th>
							<th width='170px'>Jenis Kepegawaian</th>
							<th width='120px'>Kedudukan Pegawai</th>
							<th width='100px'>Jenis Kelamin</th>
							<th width='70px'>Tgl. Lahir</th>
							<th>Alamat</th>
							<th width='20px'>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$whr = " AND a.nama_pegawai LIKE '%" . $_POST["nama_pegawai"] . "%' AND a.nip LIKE '%" . $_POST["nip"] . "%' ";
						
						$res = mysql_query("SELECT
												a.id_pegawai, a.nama_pegawai, a.nip, a.gelar_depan, a.gelar_belakang,
												b.status_kepegawaian, c.jenis_kepegawaian, d.kedudukan_kepegawaian,
												e.jenis_kelamin, a.alamat, a.tanggal_lahir
											FROM
												tbl_pegawai a 
												LEFT JOIN ref_status_kepegawaian b ON a.id_status_kepegawaian = b.id_status_kepegawaian 
												LEFT JOIN ref_jenis_kepegawaian c ON a.id_jenis_kepegawaian = c.id_jenis_kepegawaian 
												LEFT JOIN ref_kedudukan_kepegawaian d ON a.id_kedudukan_kepegawaian = d.id_kedudukan_kepegawaian 
												LEFT JOIN ref_jenis_kelamin e ON a.id_jenis_kelamin = e.id_jenis_kelamin 
												LEFT JOIN ref_skpd f ON a.id_satuan_organisasi = f.id_skpd
												
												LEFT JOIN tbl_pengangkatan_cpns i ON a.id_pegawai = i.id_pegawai
												LEFT JOIN tbl_pengangkatan_pns j ON a.id_pegawai = j.id_pegawai
											WHERE
												(a.id_status_kepegawaian = 1 OR a.id_status_kepegawaian = 4) AND f.id_skpd LIKE '" . $_SESSION["id_skpd"] . "%' AND
												(
													i.status_supervisi = 1 OR i.status_supervisi = 2 OR
													j.status_supervisi = 1
												)
												" . $whr . "
											GROUP BY
												a.id_pegawai
											ORDER BY
												a.nama_pegawai") or die(mysql_error());
						$no = 0;
						
						while($ds = mysql_fetch_array($res)){
							$no++;
							
				 ?>
							<tr>
								<td align='center'><?php echo($no); ?></td>
								<td><?php echo($ds["nama_pegawai"]); ?></td>
								<td align='center'><?php echo($ds["nip"]); ?></td>
								<td align='center'><?php echo($ds["status_kepegawaian"]); ?></td>
								<td><?php echo($ds["jenis_kepegawaian"]); ?></td>
								<td align='center'><?php echo($ds["kedudukan_kepegawaian"]); ?></td>
								<td align='center'><?php echo($ds["jenis_kelamin"]); ?></td>
								<td align='center'><?php echo($ds["tanggal_lahir"]); ?></td>
								<td><?php echo($ds["alamat"]); ?></td>
								<td>
									<img src='image/Text-Signature-32.png' width='18px' class='linkimage' title='Lanjut Untuk melakukan supervisi data' onclick='lanjut(<?php echo($ds["id_pegawai"]); ?>);' />
								</td>
							</tr>
				<?php
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
