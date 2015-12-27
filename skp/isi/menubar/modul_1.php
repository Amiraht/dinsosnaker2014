<?php
	// tentukan user level dan alamat kembalinya
	$url_main = "";
	
	switch($_SESSION["id_level"]){
		case 10 :
				$url_main = "../index.php?mod=stafkasipentaker&opt=utama";
				break;		
		case 14  :
				$url_main = "../index.php?mod=stafkasiwasnaker&opt=utama";
				break;
		case 21  :
				$url_main = "../index.php?mod=stafkasihubsaker&opt=utama";
				break;
		case 24 :
				$url_main = "../index.php?mod=stafkasilatih&opt=utama";
				break;
	}
	
?>
<table width="1024" height='100%'border="0" cellspacing="2" cellpadding="5" style="background:#FFF; border-collapse:collapse;">
  <tr>
    <td>
    	<div id='headerdepan' style="background:url(./image/coba/header.png) no-repeat;">
        <table border="0" style="float:right; margin-top:70px; font-size:18px; font-weight:bold;">
        	<tr>
		         <td style="text-align:right; padding-right:10px; height:20px;"><a style="color:#AA9F00;" href="./">PEGAWAI / STAFF</a></td>
            </tr>
        </table>
        </div>
     </td>
  </tr>	 
  <tr>
   <td>
   <div id='content' style='margin-left:5%;width:90%;min-height:350px;'>
	<table width="90%" border='0px' style='margin-left: 48px;height:400px;'>
	<tr>
		<td width='40%' style="background:url(./image/coba/samping.png) top no-repeat"></td>
		<td style="padding-left:30px;" id='menudepan'>  <br/>
			<img src='./image/list.png'>&nbsp;<a href="?mod=skp_target">SKP</a><br/><br/>
			<img src='./image/list.png'>&nbsp;<a href="?mod=penilaian_skp_target">PENILAIAN SKP BULANAN</a><br/><br/>
			<img src='./image/list.png'>&nbsp;<a href="?mod=tugtam_kreat_input_pilih_periode">TUGAS TAMBAHAN DAN KREATIFITAS</a><br/><br/>
			<img src='./image/list.png'>&nbsp;<a href="?mod=perilaku_lihat_pilih_periode">LIHAT DATA PERILAKU</a><br/><br/>
            <img src='./image/list.png'>&nbsp;<a href="?mod=skp_output_pilih_periode">SKP DAN REALISASI SKP</a><br/><br/>
            <img src='./image/list.png'>&nbsp;<a href="?mod=dp3_pilih_periode">PENILAIAN PRESTASI KERJA</a><br/><br/>
			<img src='./image/list.png'>&nbsp;<a href="?mod=upload_dp3_pilih_periode">UPLOAD HASIL PENILAIAN PEGAWAI</a><br/><br/>
			<img src='./image/list.png'>&nbsp;<a href="<?=$url_main;?>"  class="menu">BERANDA UTAMA</a><br /><br />
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
