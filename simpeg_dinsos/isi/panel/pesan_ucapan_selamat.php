<table width="1024" height='100%'border="0" cellspacing="2" cellpadding="5" style="background:#FFF; border-collapse:collapse;">
  <tr>
    <td>
    	<div id='headerdepan' style="background:url(./image/coba/header.png) no-repeat;">
        <table border="0" style="float:right; margin-top:70px; font-size:18px; font-weight:bold;">
        	<tr>
		         <td style="text-align:right; padding-right:10px; height:20px;"><a style="color:#AA9F00;" href="./?mod=pesan_ucapan_selamat">PESAN UCAPAN SELAMAT</a></td>
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
			 <img src='./image/list.png'>&nbsp;<a href="?mod=ucapan_ultah_personal">Ucapan Selamat Ulang Tahun 
				<?php
					$jum_pesan_ultah = get_pesan_ultah_masuk($_SESSION["id_pegawai"]);
					if($jum_pesan_ultah > 0){
						echo " (<span style='color:red;'>". $jum_pesan_ultah . "</span> pesan masuk)";
					}
				?>
			</a><br /><br />
			 <img src='./image/list.png'>&nbsp;<a href="?mod=ucapan_kenpang_personal">Ucapan Selamat Kenaikan Pangkat
			 <?php
				$jkp = jumlahUcapanKenpangMasuk($_SESSION["username"]);
				if($jkp > 0){
					echo " (<span style='color:red;'>". $jkp . "</span> pesan masuk)";
				}
			 ?>
			 </a><br /><br />
			 <img src='./image/list.png'>&nbsp;<a href="?mod=ucapan_jabatan_personal">Ucapan Selamat Kenaikan Jabatan
			  <?php
				$jnj = jumlahUcapanJabatanMasuk($_SESSION["username"]);
				if($jnj > 0){
					echo " (<span style='color:red;'>". $jnj . "</span> pesan masuk)";
				}
			  ?>
			  </a><br /><br />
		
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
