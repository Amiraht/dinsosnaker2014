<script type="text/javascript">
    $(document).ready(function(){
        $("#expand").click(function(){
            $("#bodyfilter").slideToggle(800);
        });
    });
    function lanjut(id){
        document.location.href="php/set_pegawai.php?id=" + id;
    }
    function hapus(id){
        jConfirm("Anda yakin akan menghapus data pegawai ini?", "PERHATIAN", function(r){
           if(r){
                document.location.href="php/hapus_pegawai.php?id_pegawai=" + id;
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
                                <h1><a style="color:#AA9F00;" href="">DATA PEGAWAI</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>DATA PEGAWAI</span></td>
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
			 <form name="frm" action="?mod=<?php echo $mod = (isset($_GET["mod"])) ? $_GET["mod"] : ""; ?>" method="post">
				<div class="panelcontainer" style="width: 100%;">
					<h3><div style="display: block; float: left;"><div style="clear: both;"></div>FILTER DATA PENCARIAN</div><input type="button" value="+" style="float: right; display: block; font-weight: bold;" id="expand" /><div style="clear: both;"></div></h3>
					<div class="bodypanel bodyfilter" id="bodyfilter">
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td>
									<input type="text" style='width:90%;' name="nama_pegawai" placeholder="Cari Nama Pegawai" title="Nama Pegawai" value="" />
								</td>
								<td>
									<input type="text"  style='width:90%;' name="nip" placeholder="Cari NIP Pegawai" title="NIP Pegawai" value="" />
								</td>
							</tr>
						</table>
						<div class="kelang"></div>
						<table border="0px" cellspacing='0' cellpadding='0' width='20%'>
							<tr>
								<td><input type="submit" class="btn btn-success" value='Filter' style="width: 100%;" /></td>
								<td><input type="reset" class="btn btn-info" value='Reset' style="width: 100%;" /></td>
							</tr>
						</table>
					</div>
				</div>
				</form>
				<div class="kelang"></div>
				<div class="kelang"></div>
				<div class="panelcontainer" style="width: 100%;">
					<h3 style="text-align: left;">DAFTAR PEGAWAI DI LINGKUNGAN PEMERINTAHAN KOTA MEDAN</h3>
					<div class="bodypanel">
					<input type="button" value="Tambah Data Pegawai" onclick="document.location.href='?mod=tambah_pegawai';" />
					<div class="kelang"></div>
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
								<th width='20px'>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$whr = ""; // inisialisasi varibel
							if(isset($_POST["nip"])){
								$whr = " AND a.nip LIKE '%" . $_POST["nip"] . "%' ";
							}else if(isset($_POST["nama_pegawai"])){
								$whr = " AND a.nama_pegawai LIKE '%" . $_POST["nama_pegawai"] . "%' ";
							}else if(isset($_POST["nip"]) && isset($_POST["nama_pegawai"])){
								$whr = " AND a.nama_pegawai LIKE '%" . $_POST["nama_pegawai"] . "%' AND a.nip LIKE '%". $_POST["nip"] ."%' ";
							}else{
								$whr = "";
							}
							
							$res = mysql_query("SELECT
													a.id_pegawai, a.nama_pegawai, a.nip, a.gelar_depan, a.gelar_belakang,
													b.status_kepegawaian, c.jenis_kepegawaian, d.kedudukan_kepegawaian,
													e.jenis_kelamin, a.alamat, a.tanggal_lahir
												FROM
													tbl_pegawai a, ref_status_kepegawaian b, ref_jenis_kepegawaian c, ref_kedudukan_kepegawaian d,
													ref_jenis_kelamin e 
													
												WHERE
													(a.id_status_kepegawaian = 1 OR a.id_status_kepegawaian = 4) AND 
													a.id_status_kepegawaian = b.id_status_kepegawaian AND 
													a.id_jenis_kepegawaian = c.id_jenis_kepegawaian AND 
													a.id_kedudukan_kepegawaian = d.id_kedudukan_kepegawaian AND 
													a.id_jenis_kelamin = e.id_jenis_kelamin 
													" . $whr . "
												ORDER BY
													a.nama_pegawai") or die(mysql_error());
							$diload = 0;
							if(mysql_num_rows($res) <= 1000){
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
										<img src='image/Text-Signature-32.png' width='18px' class='linkimage' title='Lanjut Untuk Memanajemen Data Pegawai' onclick='lanjut(<?php echo($ds["id_pegawai"]); ?>);' />
									</td>
									<td>
										<img src='image/Delete-32.png' width='18px' class='linkimage' title='Hapus Data Pegawai' onclick='hapus(<?php echo($ds["id_pegawai"]); ?>);' />
									</td>
								</tr>
							<?php
								}
								$diload = 1;
							}else {
								$diload = 0;
							}
						?>
						</tbody>
					</table>
					<?php
						if($diload == 0){
					?>
						<div class="kelang"></div>
						<div class="alert alert-info" role="alert">
							<strong>Maaf !!!</strong> Data yang di load lebih dari 1000 record. Harap lakukan filter terhadap pencarian
							pegawai
						</div>
					<?php
						}
					?>
					</div>
				</div>
	</div>
</td>
</tr>
<tr>
     <td><br><div id='footer'></div></td>
 </tr>
 </table>
 


