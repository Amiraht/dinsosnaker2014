<?php
	session_start();
	ob_start();
?>
<table width="1024" height='100%'border="0" cellspacing="2" cellpadding="5" style="background:#FFF; border-collapse:collapse;">
  <tr>
    <td>
    	<div id='headerdepan' style="background:url(./image/coba/header.png) no-repeat;">
        <table border="0" style="float:right; margin-top:70px; font-size:18px; font-weight:bold;">
        	<tr>
		         <td style="text-align:right; padding-right:10px; height:20px;"><a style="color:#AA9F00;" >LAPORAN-LAPORAN</a></td>
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
        <br><br>
<?php
	if($_SESSION["lv"]==3)
	{
?>        
                <img src='./image/list.png'><a href="index.php?mod=loket&opt=data_perusahaan_lap" class="menu"> LAPORAN DATA PERUSAHAAN</a> 
            <br><br>
                <img src='./image/list.png'><a href="index.php?mod=loket&opt=data_potensial_lap" class="menu"> LAPORAN DATA POTENSIAL</a> 
            <br><br>   
                <img src='./image/list.png'><a href="index.php?mod=loket&opt=data_resi_lap" class="menu"> LAPORAN DATA NOMOR RESI</a> 
            <br><br>   
                <img src='./image/list.png'><a href="index.php?mod=loket&opt=lbr_kendali_lap" class="menu"> LAPORAN LEMBAR KENDALI</a> 
            <br><br>              
                <img src='./image/list.png'><a href="index.php?mod=loket&opt=berkas_lengkap_lap" class="menu"> LAPORAN BERKAS YANG HARUS DILENGKAPI</a> 
            <br><br>
                <img src='./image/list.png'><a href="index.php?mod=loket&opt=berkas_sudah_lap" class="menu"> LAPORAN BERKAS YANG SUDAH DILENGKAPI</a> 
            <br><br>   
                <img src='./image/list.png'><a href="index.php?mod=loket&opt=berkas_serah_lap" class="menu"> LAPORAN BERKAS SELESAI BELUM DIAMBIL</a> 
            <br><br>    
                <img src='./image/list.png'><a href="index.php?mod=loket&opt=berkas_selesai_lap" class="menu"> LAPORAN BERKAS YANG SUDAH SELESAI</a> 
            <br><br>    
                <img src='./image/list.png'><a href="index.php?mod=loket&opt=berkas_proses_lap" class="menu"> LAPORAN BERKAS DALAM PROSES</a> 
            <br><br>                                         
                <img src='./image/list.png'><a href="index.php?mod=loket&opt=berkas_monitor" class="menu"> LIHAT PROSES PENGURUSAN</a> 
            <br><br>  
<?php
	}
	elseif($_SESSION["lv"]==17 or $_SESSION["lv"]==16)
	{
?>        
                <img src='./image/list.png'><a href="index.php?mod=loket&opt=data_perusahaan_lap" class="menu"> LAPORAN DATA PERUSAHAAN</a> 
            <br><br>
                <img src='./image/list.png'><a href="index.php?mod=loket&opt=data_potensial_lap" class="menu"> LAPORAN DATA POTENSIAL</a> 
            <br><br>   
                <img src='./image/list.png'><a href="index.php?mod=loket&opt=data_resi_lap" class="menu"> LAPORAN DATA NOMOR RESI</a> 
            <br><br>   
                <img src='./image/list.png'><a href="index.php?mod=loket&opt=lbr_kendali_lap" class="menu"> LAPORAN LEMBAR KENDALI</a> 
            <br><br>              
                <img src='./image/list.png'><a href="index.php?mod=loket&opt=berkas_lengkap_lap" class="menu"> LAPORAN BERKAS YANG HARUS DILENGKAPI</a> 
            <br><br>
                <img src='./image/list.png'><a href="index.php?mod=loket&opt=berkas_sudah_lap" class="menu"> LAPORAN BERKAS YANG SUDAH DILENGKAPI</a> 
            <br><br>   
                <img src='./image/list.png'><a href="index.php?mod=loket&opt=berkas_serah_lap" class="menu"> LAPORAN BERKAS SELESAI BELUM DIAMBIL</a> 
            <br><br>    
                <img src='./image/list.png'><a href="index.php?mod=loket&opt=berkas_selesai_lap" class="menu"> LAPORAN BERKAS YANG SUDAH SELESAI</a> 
            <br><br>    
                <img src='./image/list.png'><a href="index.php?mod=loket&opt=berkas_proses_lap" class="menu"> LAPORAN BERKAS DALAM PROSES</a> 
            <br><br>                                         
                <img src='./image/list.png'><a href="index.php?mod=loket&opt=berkas_monitor" class="menu"> LIHAT PROSES PENGURUSAN</a> 
            <br><br> 
                <img src='./image/list.png'><a href="index.php?mod=loket&opt=berkas_arsip_lap" class="menu"> LAPORAN BERKAS PENGARSIPAN</a> 
            <br><br>   
                <img src='./image/list.png'><a href="index.php?mod=loket&opt=berkas_arsip_sudah_lap" class="menu"> LAPORAN BERKAS SUDAH DIARSIPKAN</a> 
            <br><br>   
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=dpkk_lap" class="menu"> LAPORAN JUMLAH SETORAN DPKK</a> 
            <br><br>  
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=tenaga_lap" class="menu"> LAPORAN JUMLAH TENAGA KERJA</a>       
            <br><br>
   				<img src='./image/list.png'><a href="index.php?mod=loket&opt=imta_lap" class="menu"> LAPORAN PERPANJANGAN IMTA</a> 
            <br><br>  
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=imta_habis_lap" class="menu"> LAPORAN IMTA YANG BELUM MEMPERPANJANG</a> <br><br>
 
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=wl_lap" class="menu"> LAPORAN SK WAJIB LAPOR</a> 
            <br><br>     
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=wl_habis_lap" class="menu"> LAPORAN SK WAJIB LAPOR YANG BELUM MELAPOR</a> 
            <br><br>                                            
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=pengaduan_lap" class="menu"> LAPORAN BERKAS PENGADUAN YANG MASUK</a> 
            <br><br>         
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=pengaduan_proses_lap" class="menu"> LAPORAN BERKAS PENGADUAN SEDANG DIPROSES</a> 
            <br><br>     
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=pengaduan_mediasi_lap" class="menu"> LAPORAN BERKAS PENGADUAN DALAM PROSES MEDIASI</a> 
            <br><br>     
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=pengaduan_mediator_lap" class="menu"> LAPORAN BERKAS PENGADUAN YANG DITANGANI MEDIATOR</a>                 
            <br><br>  
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=pengaduan_selesai_lap" class="menu"> LAPORAN BERKAS PENGADUAN YANG TELAH SELESAI</a> 
            <br><br> 
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=pp_lap" class="menu"> LAPORAN BERKAS PP/PKB YANG MASUK</a> 
            <br><br>         
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=pp_proses_lap" class="menu"> LAPORAN BERKAS PP/PKB SEDANG DIPROSES</a>
            <br><br>      
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=pp_selesai_lap" class="menu"> LAPORAN BERKAS PP/PKB YANG TELAH SELESAI</a> 
            <br><br>   
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=iplk_lap" class="menu"> LAPORAN BERKAS IPLK YANG MASUK</a> 
            <br><br>         
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=iplk_proses_lap" class="menu"> LAPORAN BERKAS IPLK SEDANG DIPROSES</a>
            <br><br>      
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=iplk_selesai_lap" class="menu"> LAPORAN BERKAS IPLK YANG TELAH SELESAI</a> 
            <br><br>                         
<?php
	}
	elseif($_SESSION["lv"]==4)
	{
?>        
                                        
                <img src='./image/list.png'><a href="index.php?mod=loket&opt=berkas_monitor" class="menu"> LIHAT PROSES PENGURUSAN</a> 
            <br><br> 
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=pengaduan_lap" class="menu"> LAPORAN BERKAS PENGADUAN YANG MASUK</a> 
            <br><br>         
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=pengaduan_proses_lap" class="menu"> LAPORAN BERKAS PENGADUAN SEDANG DIPROSES</a> 
            <br><br>     
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=pengaduan_mediasi_lap" class="menu"> LAPORAN BERKAS PENGADUAN DALAM PROSES MEDIASI</a> 
            <br><br>     
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=pengaduan_mediator_lap" class="menu"> LAPORAN BERKAS PENGADUAN YANG DITANGANI MEDIATOR</a>                   
            <br><br>  
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=pengaduan_selesai_lap" class="menu"> LAPORAN BERKAS PENGADUAN YANG TELAH SELESAI</a> 
            <br><br>
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=pp_lap" class="menu"> LAPORAN BERKAS PP/PKB YANG MASUK</a> 
            <br><br>         
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=pp_proses_lap" class="menu"> LAPORAN BERKAS PP/PKB SEDANG DIPROSES</a>
            <br><br>      
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=pp_selesai_lap" class="menu"> LAPORAN BERKAS PP/PKB YANG TELAH SELESAI</a> 
            <br><br>   
<?php
	}
	elseif($_SESSION["lv"]==20 or $_SESSION["lv"]==21)
	{
?>        
                <img src='./image/list.png'><a href="index.php?mod=loket&opt=berkas_monitor" class="menu"> LIHAT PROSES PENGURUSAN</a> 
            <br><br>                                         
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=pp_lap" class="menu"> LAPORAN BERKAS PP/PKB YANG MASUK</a> 
            <br><br>         
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=pp_proses_lap" class="menu"> LAPORAN BERKAS PP/PKB SEDANG DIPROSES</a>
            <br><br>      
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=pp_selesai_lap" class="menu"> LAPORAN BERKAS PP/PKB YANG TELAH SELESAI</a> 
            <br><br>                   
            
<?php
	}
	elseif($_SESSION["lv"]==22 or $_SESSION["lv"]==23 or $_SESSION["lv"]==24)
	{
?>        
                <img src='./image/list.png'><a href="index.php?mod=loket&opt=berkas_monitor" class="menu"> LIHAT PROSES PENGURUSAN</a> 
            <br><br> 
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=iplk_lap" class="menu"> LAPORAN BERKAS IPLK YANG MASUK</a> 
            <br><br>         
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=iplk_proses_lap" class="menu"> LAPORAN BERKAS IPLK SEDANG DIPROSES</a>
            <br><br>      
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=iplk_selesai_lap" class="menu"> LAPORAN BERKAS IPLK YANG TELAH SELESAI</a> 
            <br><br>                  
<?php
	}
	elseif($_SESSION["lv"]==5 or $_SESSION["lv"]==6)
	{
?>        
                                        
                <img src='./image/list.png'><a href="index.php?mod=loket&opt=berkas_monitor" class="menu"> LIHAT PROSES PENGURUSAN</a> 
            <br><br> 
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=pengaduan_lap" class="menu"> LAPORAN BERKAS PENGADUAN YANG MASUK</a> 
            <br><br>         
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=pengaduan_proses_lap" class="menu"> LAPORAN BERKAS PENGADUAN SEDANG DIPROSES</a> 
            <br><br>     
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=pengaduan_mediasi_lap" class="menu"> LAPORAN BERKAS PENGADUAN DALAM PROSES MEDIASI</a> 
            <br><br>     
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=pengaduan_mediator_lap" class="menu"> LAPORAN BERKAS PENGADUAN YANG DITANGANI MEDIATOR</a>                   
            <br><br>  
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=pengaduan_selesai_lap" class="menu"> LAPORAN BERKAS PENGADUAN YANG TELAH SELESAI</a> 
            <br><br>            
<?php
	}
	elseif($_SESSION["lv"]==7 or $_SESSION["lv"]==8 or $_SESSION["lv"]==9 or $_SESSION["lv"]==10)
	{
?>        
                <img src='./image/list.png'><a href="index.php?mod=loket&opt=berkas_monitor" class="menu"> LIHAT PROSES PENGURUSAN</a> 
			<br><br>
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=dpkk_lap" class="menu"> LAPORAN JUMLAH SETORAN DPKK</a> 
            <br><br>  
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=tenaga_lap" class="menu"> LAPORAN JUMLAH TENAGA KERJA</a>       
            <br><br>
            	<img src='./image/list.png'><a href="index.php?mod=loket&opt=imta_lap" class="menu"> LAPORAN PERPANJANGAN IMTA</a> 
            <br><br>  
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=imta_habis_lap" class="menu"> LAPORAN IMTA YANG BELUM MEMPERPANJANG</a> <br><br>
<?php
	}
	elseif($_SESSION["lv"]==11 or $_SESSION["lv"]==12 or $_SESSION["lv"]==13 or $_SESSION["lv"]==14)
	{
?>        
                                                     
                <img src='./image/list.png'><a href="index.php?mod=loket&opt=berkas_monitor" class="menu"> LIHAT PROSES PENGURUSAN</a> 
			<br><br>
            	<img src='./image/list.png'><a href="index.php?mod=loket&opt=dpkk_lap" class="menu"> LAPORAN JUMLAH SETORAN DPKK</a> 
            <br><br>  
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=tenaga_lap" class="menu"> LAPORAN JUMLAH TENAGA KERJA</a>       
            <br><br>
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=wl_lap" class="menu"> LAPORAN SK WAJIB LAPOR</a> 
            <br><br>     
				<img src='./image/list.png'><a href="index.php?mod=loket&opt=wl_habis_lap" class="menu"> LAPORAN SK WAJIB LAPOR YANG BELUM MELAPOR</a> 
            <br><br>                                                                                                                                       
<?php
	}		
	elseif($_SESSION["lv"]==15)
	{
?>                                                
                <img src='./image/list.png'><a href="index.php?mod=loket&opt=berkas_monitor" class="menu"> LIHAT PROSES PENGURUSAN</a> 
            <br><br>                                                                                   
<?php
	}	
	elseif($_SESSION["lv"]==18)
	{
?>                                                
                <img src='./image/list.png'><a href="index.php?mod=loket&opt=berkas_arsip_lap" class="menu"> LAPORAN BERKAS PENGARSIPAN</a> 
            <br><br>   
                <img src='./image/list.png'><a href="index.php?mod=loket&opt=berkas_arsip_sudah_lap" class="menu"> LAPORAN BERKAS SUDAH DIARSIPKAN</a> 
            <br><br>  
<?php
	}			
?>             
<?php
	if($_SESSION["lv"]==3)
	{
		echo"<img src=./image/list.png>&nbsp;<a href=./index.php?mod=loket&opt=main  class=menu>KEMBALI</a><br /><br />";
	}
	if($_SESSION["lv"]==4)
	{
		echo"<img src=./image/list.png>&nbsp;<a href=./index.php?mod=kabidhubsaker&opt=main  class=menu>KEMBALI</a><br /><br />";
	}
	if($_SESSION["lv"]==5)
	{
		echo"<img src=./image/list.png>&nbsp;<a href=./index.php?mod=kasi&opt=main  class=menu>KEMBALI</a><br /><br />";
	}
	if($_SESSION["lv"]==6)
	{
		echo"<img src=./image/list.png>&nbsp;<a href=./index.php?mod=staf&opt=main  class=menu>KEMBALI</a><br /><br />";
	}	
	if($_SESSION["lv"]==7)
	{
		echo"<img src=./image/list.png>&nbsp;<a href=./index.php?mod=kabidpentaker&opt=main  class=menu>KEMBALI</a><br /><br />";
	}
	if($_SESSION["lv"]==8)
	{
		echo"<img src=./image/list.png>&nbsp;<a href=./index.php?mod=kasipentaker&opt=main  class=menu>KEMBALI</a><br /><br />";
	}
	if($_SESSION["lv"]==9)
	{
		echo"<img src=./image/list.png>&nbsp;<a href=./index.php?mod=pemeriksa&opt=main  class=menu>KEMBALI</a><br /><br />";
	}
	if($_SESSION["lv"]==10)
	{
		echo"<img src=./image/list.png>&nbsp;<a href=./index.php?mod=stafkasi&opt=main  class=menu>KEMBALI</a><br /><br />";
	}
	if($_SESSION["lv"]==11)
	{
		echo"<img src=./image/list.png>&nbsp;<a href=./index.php?mod=kabidwasnaker&opt=main  class=menu>KEMBALI</a><br /><br />";
	}
	if($_SESSION["lv"]==12)
	{
		echo"<img src=./image/list.png>&nbsp;<a href=./index.php?mod=kasiwasnaker&opt=main  class=menu>KEMBALI</a><br /><br />";
	}
	if($_SESSION["lv"]==13)
	{
		echo"<img src=./image/list.png>&nbsp;<a href=./index.php?mod=pengawas&opt=main  class=menu>KEMBALI</a><br /><br />";
	}
	if($_SESSION["lv"]==14)
	{
		echo"<img src=./image/list.png>&nbsp;<a href=./index.php?mod=stafkasiwasnaker&opt=main  class=menu>KEMBALI</a><br /><br />";
	}								
	elseif($_SESSION["lv"]==17)
	{
		echo"<img src=./image/list.png>&nbsp;<a href=./index.php?mod=kadis&opt=main  class=menu>KEMBALI</a><br /><br />";
	}
	elseif($_SESSION["lv"]==16)
	{
		echo"<img src=./image/list.png>&nbsp;<a href=./index.php?mod=sekretaris&opt=main  class=menu>KEMBALI</a><br /><br />";
	}	
	elseif($_SESSION["lv"]==15)
	{
		echo"<img src=./image/list.png>&nbsp;<a href=./index.php?mod=kasubag_umum&opt=main  class=menu>KEMBALI</a><br /><br />";
	}
	elseif($_SESSION["lv"]==18)
	{
		echo"<img src=./image/list.png>&nbsp;<a href=./index.php?mod=arsip&opt=main  class=menu>KEMBALI</a><br /><br />";
	}			
elseif($_SESSION["lv"]==20)
	{
		echo"<img src=./image/list.png>&nbsp;<a href=./index.php?mod=kasihubsaker&opt=main  class=menu>KEMBALI</a><br /><br />";
	}	
	elseif($_SESSION["lv"]==21)
	{
		echo"<img src=./image/list.png>&nbsp;<a href=./index.php?mod=stafkasihubsaker&opt=main  class=menu>KEMBALI</a><br /><br />";
	}	
	elseif($_SESSION["lv"]==22)
	{
		echo"<img src=./image/list.png>&nbsp;<a href=./index.php?mod=kabidlatih&opt=main  class=menu>KEMBALI</a><br /><br />";
	}	
	elseif($_SESSION["lv"]==23)
	{
		echo"<img src=./image/list.png>&nbsp;<a href=./index.php?mod=kasilatih&opt=main  class=menu>KEMBALI</a><br /><br />";
	}	
	elseif($_SESSION["lv"]==24)
	{
		echo"<img src=./image/list.png>&nbsp;<a href=./index.php?mod=stafkasilatih&opt=main  class=menu>KEMBALI</a><br /><br />";
	}	
?>
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