<?php
	// tentukan user level dan alamat kembalinya
	$main = "";
	
	switch($_SESSION["id_level"]){
		case 10 :
				$main = "../index.php?mod=stafkasipentaker&opt=utama";
				break;		
		case 14  :
				$main = "../index.php?mod=stafkasiwasnaker&opt=utama";
				break;
		case 21  :
		case 25  :
				$main = "../index.php?mod=stafkasihubsaker&opt=utama";
				break;
		case 24 :
				$main = "../index.php?mod=stafkasilatih&opt=utama";
				break;
	}
?>
<table width="1024" height='100%'border="0" cellspacing="2" cellpadding="5" style="background:#FFF; border-collapse:collapse;">
  <tr>
    <td>
    	<div id='headerdepan' style="background:url(./image/coba/header.png) no-repeat;">
        <table border="0" style="float:right; margin-top:70px; font-size:18px; font-weight:bold;">
        	<tr>
		         <td style="text-align:right; padding-right:10px; height:20px;"><a style="color:#AA9F00;" href="">BERANDA UTAMA LOGIN STAFF</a></td>
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
			<img src='./image/list.png'>&nbsp;<a href="./?mod=posisi_surat_masuk_staff" class="menu">PROSES SURAT MASUK</a><br /><br />
            <img src='./image/list.png'>&nbsp;<a href="./?mod=riwayat_surat_masuk" class="menu">RIWAYAT PENERIMAAN SURAT MASUK</a><br /><br />
			<img src='./image/list.png'>&nbsp;<a href="./?mod=buat_surat_keluar" class="menu">PROSES PEMBUATAN SURAT KELUAR</a><br /><br />
            <img src='./image/list.png'>&nbsp;<a href="./?mod=manajemen_surat_keluar_1" class="menu">MANAJEMEN DATA SURAT KELUAR</a><br /><br />       
            <img src='./image/list.png'>&nbsp;<a href="./?mod=posisi_surat_keluar_staff" class="menu">PROSES SURAT KELUAR</a><br /><br />
            <img src='./image/list.png'>&nbsp;<a href="./?mod=pengiriman_surat" class="menu">PENGIRIMAN DAN FINALISASI SURAT KELUAR</a><br /><br />          
            <img src='./image/list.png'>&nbsp;<a href="./?mod=pengguna" class="menu">PROFIL USER</a><br /><br />
            <img src='./image/list.png'>&nbsp;<a href="<?=$main;?>"  class="menu">BERANDA UTAMA</a><br /><br />
			
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