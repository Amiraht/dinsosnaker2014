<table width="1024" height='100%'border="0" cellspacing="2" cellpadding="5" style="background:#FFF; border-collapse:collapse;">
  <tr>
    <td>
    	<div id='headerdepan' style="background:url(./image/coba/header.png) no-repeat;">
        <table border="0" style="float:right; margin-top:70px; font-size:18px; font-weight:bold;">
        	<tr>
		         <td style="text-align:right; padding-right:10px; height:20px;"><a style="color:#AA9F00;" href="./?mod=">LOGIN SKPD</a></td>
            </tr>
        </table>
        </div>
     </td>
  <tr>
   <td>
   <div id='content' style='margin-left:5%;width:90%;min-height:350px;'>
	<table width="90%" border='0px' style='margin-left: 48px;height:400px;'>
	<?php
		// set to determine the main page of disnakersos
		$beranda_utama = "";
		
		switch($_SESSION['id_level']){
				case "11" :
							$beranda_utama = "../index.php?mod=kabidwasnaker&opt=utama";
							break;
				case "12" :
							$beranda_utama = "../index.php?mod=kasiwasnaker&opt=utama";
							break;
				case "20" :
							$beranda_utama = "../index.php?mod=kasihubsaker&opt=utama";
							break;
				case "22" :
							$beranda_utama = "../index.php?mod=kabidlatih&opt=utama";
							break;
				case "23" :
							$beranda_utama = "../index.php?mod=kasilatih&opt=utama";
							break;
				case "4"  :
							$beranda_utama = "../index.php?mod=kabidhubsaker&opt=utama";
							break;
				case "5"  :
							$beranda_utama = "../index.php?mod=kasi&opt=utama";
							break;
				case "7"  :
							$beranda_utama = "../index.php?mod=kabidpentaker&opt=utama";
							break;
				case "8"  :
							$beranda_utama = "../index.php?mod=kasipentaker&opt=utama";
							break;
		}
	?>
	<tr>
		<td width='40%' style="background:url(./image/coba/samping.png) top no-repeat"></td>
		<td style="padding-left:30px;" id='menudepan'>  
        	 <!--<img src='./image/list.png'><a href="?mod=">!!! Pengaturan Masalah Dan Sub Masalah</a><br/><br/>-->
			<img src='./image/list.png'>&nbsp;<a href="?mod=peminjaman" class="menu">PROSES PEMINJAMAN LUAR</a><br/><br/>
			<img src='./image/list.png'>&nbsp;<a href="?mod=pps&tipe_pps=2" class="menu">PESAN DAN SARAN</a><br/><br/>
			<img src='./image/list.png'>&nbsp;<a href="?mod=pps&tipe_pps=1" class="menu">PENGADUAN</a><br/><br/>
			<img src='./image/list.png'>&nbsp;<a href="?mod=mnu_ikm" class="menu">PENGISIAN INDEKS KEPUASAN MASYARAKAT</a><br/><br/>
			<img src='./image/list.png'>&nbsp;<a href="?mod=file_download&id=1" class="menu">FILE DOWNLOAD</a><br/><br/>
			<img src='./image/list.png'>&nbsp;<a href="?mod=pin_dig" class="menu">PEMINJAMAN DIGITAL</a><br/><br/>
			<img src='./image/list.png'>&nbsp;<a href="?mod=latar_belakang&id=2" class="menu">KATA SAMBUTAN KEPALA KANTOR</a><br/><br/>
			<img src='./image/list.png'>&nbsp;<a href="?mod=data_arsip" class="menu">INPUT DATA ARSIP</a><br/><br/>
			<img src='./image/list.png'>&nbsp;<a href="?mod=data_digital_arsip" class="menu">DIGITALISASI ARSIP</a><br/><br/>
			<img src='./image/list.png'>&nbsp;<a href="?mod=file_download&id=2" class="menu">PANDUAN PENGGUNAAN</a><br/><br/>
			<img src='./image/list.png'>&nbsp;<a href="?mod=file_download&id=3" class="menu">BERITA DAN INFORMASI</a><br/><br/>
			<img src='./image/list.png'>&nbsp;<a href="?mod=latar_belakang&id=1" class="menu">LATAR BELAKANG</a><br/><br/>
			<img src='./image/list.png'>&nbsp;<a href="?mod=laporan_arsip" class="menu">LAPORAN ARSIP</a><br/><br/>
			<img src='./image/list.png'>&nbsp;<a href="<?=$beranda_utama;?>"  class="menu">BERANDA UTAMA</a><br /><br />
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