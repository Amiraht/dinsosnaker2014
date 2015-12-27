<?php
	$main = "";
	
	switch($_SESSION["id_level"]){
		case 12 :
				$main = "../index.php?mod=kasiwasnaker&opt=utama";
				break;		
		case 20  :
				$main = "../index.php?mod=kasihubsaker&opt=utama";
				break;
		case 23  :
				$main = "../index.php?mod=kasilatih&opt=utama";
				break;
		case 8 :
				$main = "../index.php?mod=kasipentaker&opt=utama";
				break;
	}
?>
<table width="1024" height='100%'border="0" cellspacing="2" cellpadding="5" style="background:#FFF; border-collapse:collapse;">
  <tr>
    <td>
    	<div id='headerdepan' style="background:url(./image/coba/header.png) no-repeat;">
        <table border="0" style="float:right; margin-top:70px; font-size:18px; font-weight:bold;">
        	<tr>
		         <td style="text-align:right; padding-right:10px; height:20px;"><a style="color:#AA9F00;" href="">BERANDA UTAMA KEPALA SEKSI (KASI)</a></td>
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
        	 <img src='./image/list.png'>&nbsp;<a href="./?mod=posisi_surat_masuk_kabid" class="menu">PROSES SURAT MASUK</a><br /><br />
            <img src='./image/list.png'>&nbsp;<a href="./?mod=riwayat_surat_masuk" class="menu">RIWAYAT PENERIMAAN SURAT MASUK</a><br /><br />
            <img src='./image/list.png'>&nbsp;<a href="./?mod=lacak_surat_masuk" class="menu">DETAIL POSISI SURAT MASUK</a><br /><br />
			<img src='./image/list.png'>&nbsp;<a href="./?mod=manajemen_surat_keluar_1" class="menu">MANAJEMEN DATA SURAT KELUAR</a><br /><br />  			
            <img src='./image/list.png'>&nbsp;<a href="./?mod=riwayat_surat_keluar" class="menu">RIWAYAT PENERIMAAN SURAT KELUAR</a><br /><br />
			<img src='./image/list.png'>&nbsp;<a href="./?mod=posisi_surat_keluar_kabid" class="menu">PROSES SURAT KELUAR</a><br /><br />
            <img src='./image/list.png'>&nbsp;<a href="./?mod=list_laporan" class="menu">LAPORAN-LAPORAN</a><br /><br />            
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