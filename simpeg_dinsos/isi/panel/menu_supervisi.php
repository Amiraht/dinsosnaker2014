 <table width="1024" height='100%'border="0" cellspacing="2" cellpadding="5" style="background:#FFF; border-collapse:collapse;">
  <tr>
    <td>
    	<div id='headerdepan' style="background:url(./image/coba/header.png) no-repeat;">
        <table border="0" style="float:right; margin-top:70px; font-size:18px; font-weight:bold;">
        	<tr>
		         <td style="text-align:right; padding-right:10px; height:20px;"><a style="color:#AA9F00;" href="./?mod=menu_supervisi">SUPERVISI DATA PEGAWAI</a></td>
            </tr>
        </table>
        </div>
     </td>
  <tr>
   <td>
   <div id='content' style='margin-left:5%;width:90%;min-height:350px;'>
	<table width="90%" border='0px' style='margin-left: 48px;height:400px;'>
	<tr>
		<td width='40%' style="background:url(./image/coba/samping.png) top no-repeat"></td>
		<td style="padding-left:30px;" id='menudepan'>  
		<?php
                if(isset($_SESSION["id_pegawai"])){
                    $ds_nama_pegawai_aktif = mysql_fetch_array(mysql_query("SELECT nama_pegawai, nip FROM tbl_pegawai WHERE id_pegawai='" . $_SESSION["id_pegawai"] . "'"));
            ?>
					<img src='./image/list.png'>&nbsp;<a href="#" style="font-weight: bold; text-transform: uppercase;">
					<?php echo($ds_nama_pegawai_aktif["nip"] . "<br />(" . $ds_nama_pegawai_aktif["nama_pegawai"] . ")"); ?></a><br /><br />
					<img src='./image/list.png'>&nbsp;<a href="php/unset_pegawai.php?mod=spv_data_pegawai_pilih_pegawai">Selesai Supervisi</a><br /><br />
					<img src='./image/list.png'>&nbsp;<a href="?mod=spv_pengangkatan_cpns">Data Pengangkatan CPNS</a><br /><br />
					<img src='./image/list.png'>&nbsp;<a href="?mod=spv_pengangkatan_pns">Data Pengangkatan PNS</a><br /><br />
					<img src='./image/list.png'>&nbsp;<a href="?mod=spv_riwayat_pangkat">Riwayat Pangkat</a><br /><br />
					<img src='./image/list.png'>&nbsp;<a href="?mod=spv_riwayat_jabatan">Riwayat Jabatan</a><br /><br />
            <?php
                } else{
            ?>
						<img src='./image/list.png'>&nbsp;<a href="?mod=spv_pilih_pegawai">Pilih Pegawai Yang Akan Disupervisi</a><br /><br />
            <?php
                }
            ?>
			<img src='./image/list.png'>&nbsp;<a href="./"  class="menu">MENU UTAMA</a><br /><br />
        </td>
	</tr>
	</table>
	</div>
    </td>
  </tr>
  <tr>
    <td><br><div id='footer'></div></td>
  </tr>
</table>

			